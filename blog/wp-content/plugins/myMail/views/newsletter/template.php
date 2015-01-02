<?php

	$editable = !in_array($post->post_status, array('active', 'finished'));
	if(isset($_GET['showstats']) && $_GET['showstats'] && $post->post_status == 'autoresponder') $editable = false;
	
	$modules = $this->replace_colors($this->templateobj->get_modules_html());
	
	$campaign_data = get_post_meta( $post->ID, 'mymail-campaign', true );
	
	$templates = $this->templateobj->get_templates();
	
	$files = array();
	
	foreach($templates as $slug => $data){
		$files[$slug] = $this->templateobj->get_files($slug);
	}
	
	//templateswitcher was used
	if(isset($_REQUEST['template']) && current_user_can('mymail_change_template')){
		$this->set_template($_REQUEST['template'], $this->get_file() , true);
	//saved campaign
	}else if(isset($this->details['template'])){
		$this->set_template($this->details['template'], $this->get_file(), true);
	}
?>
<?php if($editable) : ?>
<div id="optionbar" class="optionbar">
	<ul class="alignleft">
		<li class="no-border-left"><a class="mymail-icon undo disabled" title="<?php _e('undo', 'mymail') ?>">&nbsp;</a></li>
		<li><a class="mymail-icon redo disabled" title="<?php _e('redo', 'mymail') ?>">&nbsp;</a></li>
		<?php if(!empty($modules)) : ?>
		<li><a class="mymail-icon clear-modules" title="<?php _e('remove modules', 'mymail') ?>">&nbsp;</a></li>
		<?php endif; ?>
		<?php if(current_user_can('mymail_see_codeview')) :?>
		<li><a class="mymail-icon code" title="<?php _e('toggle HTML/code view', 'mymail') ?>">&nbsp;</a></li>
		<?php endif; ?>
		<li class="no-border-right"><a class="mymail-icon preview" title="<?php _e('preview', 'mymail') ?>">&nbsp;</a></li>
		<?php if($templates && current_user_can('mymail_save_template')) : ?>
	</ul>
	<ul class="alignright">
		<li class=""><a class="mymail-icon save-template" title="<?php _e('save template', 'mymail') ?>">&nbsp;</a>
			<div class="dropdown">
				<div class="ddarrow"></div>
				<div class="inner">
					<h4><?php _e('Save Template', 'mymail') ?></h4>
					<p>
						<label><?php _e('Name', 'mymail'); ?><br><input type="text" class="widefat" id="new_template_name" placeholder="<?php _e('template name', 'mymail'); ?>" value="<?php echo ($this->get_file() != 'index.html' ? $files[$this->get_template()][$this->get_file()]['label'] : ''); ?>"></label>
						<?php if(!empty($modules)) : ?>
						<label><input type="checkbox" id="new_template_modules" checked> <?php _e('include modules', 'mymail'); ?></label>
						<?php endif; ?>
						<label><input type="checkbox" id="new_template_overwrite"> <?php _e('overwrite if exists', 'mymail'); ?></label>
					</p>
					<p class="foot">
						<span class="spinner" id="new_template-ajax-loading"></span>
						<button class="button-primary save-template"><?php _e('Save', 'mymail'); ?></button>
					</p>
				</div>
			</div>
		</li>
		<?php endif; ?>
		<?php if($templates && current_user_can('mymail_change_template')) : 
				$single = count($templates) == 1;
		?>
		<li class="current_template <?php if($single) echo 'single';?>"><span class="change_template" title="<?php echo sprintf(__('Your currently working with %s', 'mymail'), '&quot;'.$files[$this->get_template()][$this->get_file()]['label'].'&quot;' ); ?>"><?php echo $files[$this->get_template()][$this->get_file()]['label']; ?></span>
			<div class="dropdown">
				<div class="ddarrow"></div>
				<div class="inner">
					<h4><?php _e('Change Template', 'mymail') ?></h4>
					<ul>
						<?php
						$current = $this->get_template().'/'.$this->get_file();
						foreach($templates as $slug => $data){
						?>
							<li><?php if(!$single): ?><a class="template"><?php echo $data['name']?></a><?php endif; ?>
								<ul <?php if($this->get_template() == $slug) echo ' style="display:block"'?>>
						<?php
							foreach($files[$slug] as $name => $data){
								$value = $slug.'/'.$name;
							?>
								<li><a class="file<?php if($current == $value) echo ' active';?>" <?php if($current != $value) echo 'href="http://'.add_query_arg( array( 'template' => $slug, 'file' => $name, 'message' => 2), $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]).'"';?>><?php echo $data['label']?></a></li>
							<?php 
							}
							?>
								</ul>
							</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</li>
		<?php endif; ?>
	</ul>
	
</div>
<div id="editbar">
	<a class="cancel top-cancel" href="#">&#10005;</a>
	<h2></h2> <span class="spinner" id="editbar-ajax-loading"></span>
	
	<div class="type single">
		<div class="clearfix clear alignright">
			<a class="replace-image" href="#"><?php _e('replace with image', 'mymail') ?></a>
		</div>
		<input class="input live" value="">
		<div class="clear clearfix">
			<a href="#" class="single-link-content"><?php _e('convert to link', 'mymail'); ?></a>
		</div>
		<div id="single-link">
			<div class="clearfix">
					<label class="block"><div class="left"><?php _e('Link', 'mymail') ?></div><div class="right"><input class="input singlelink" value="" placeholder="<?php _e('insert URL', 'mymail'); ?>"></div></label>
			</div>
			<div class="link-wrap">
				<div class="postlist">
				</div>
			</div>
		</div>
	</div>
	
	<div class="type btn">
		
		<div id="button-type-bar" class="nav-tab-wrapper hide-if-no-js">
			<a class="nav-tab nav-tab-active" href="#image_button"><?php _e('Image Button', 'mymail'); ?></a>
			<a class="nav-tab" href="#text_button" data-type="dynamic"><?php _e('Text Button', 'mymail'); ?></a>
		</div>
		<div id="image_button" class="tab">
		<?php $this->templateobj->buttons( ); ?>
		<div class="clearfix">
				<label class="block"><div class="left"><?php _e('Alt Text', 'mymail') ?></div><div class="right"><input class="input buttonalt" value="" placeholder="<?php _e('image description', 'mymail'); ?>"></div></label>
		</div>
		</div>
		<div id="text_button" class="tab" style="display:none">
		<div class="clearfix">
				<label class="block"><div class="left"><?php _e('Button Label', 'mymail') ?></div><div class="right"><input class="input buttonlabel" value="" placeholder="<?php _e('button label', 'mymail'); ?>"></div></label>
		</div>
		</div>
		
		<div class="clearfix">
				<label class="block"><div class="left"><?php _e('Link Button (required)', 'mymail') ?></div><div class="right"><input class="input buttonlink" value="" placeholder="<?php _e('insert URL', 'mymail'); ?>"></div></label>
		</div>
		<div class="link-wrap">
			<div class="postlist">
			</div>
		</div>
		<?php 
	?>
	</div>
	
	<div class="type multi">
	
	</div>
	
	<div class="type img">
		<div>
		<div class="left">
			<div class="imagewrap">
			<img src="" alt="" class="imagepreview">
			</div>
		</div>
		<div class="right">
			<div class="imagelist">
			</div>
			<p>
				<a class="mymail-btn add_image"><?php ((!function_exists( 'wp_enqueue_media' )) ? _e('Upload', 'mymail') : _e('Media Manager', 'mymail'))?></a>
				<a class="mymail-btn reload"><?php _e('Reload', 'mymail') ?></a>
				<a class="mymail-btn add_image_url"><?php _e('Insert from URL', 'mymail') ?></a>
			</p>
		</div>
		<br class="clear">
		</div>
		<p class="clearfix">
			<div class="imageurl-popup">
				<label class="block"><div class="left"><?php _e('Image URL', 'mymail') ?></div><div class="right"><input class="input imageurl" value="" placeholder="http://example.com/image.jpg"></div></label>
			</div>
				<label class="block"><div class="left"><?php _e('Alt Text', 'mymail') ?></div><div class="right"><input class="input imagealt" value="" placeholder="<?php _e('image description', 'mymail'); ?>"></div></label>
				<label class="block"><div class="left"><?php _e('Link image to the this URL', 'mymail') ?></div><div class="right"><input class="input imagelink" value="" placeholder="<?php _e('insert URL', 'mymail'); ?>"></div></label>
		</p>
		<br class="clear">
	</div>
	
	<div class="type auto">
	
		<div id="embedoption-bar" class="nav-tab-wrapper hide-if-no-js">
			<a class="nav-tab nav-tab-active" href="#static_embed_options" data-type="static"><?php _e('static', 'mymail'); ?></a>
			<a class="nav-tab" href="#dynamic_embed_options" data-type="dynamic"><?php _e('dynamic', 'mymail'); ?></a>
			<a class="nav-tab" href="#rss_embed_options" data-type="rss"><?php _e('RSS', 'mymail'); ?></a>
		</div>
		
		<div id="static_embed_options" class="tab">
			<p class="editbarinfo"><?php _e('Select a post', 'mymail') ?></p>
			<p class="alignleft">
				<label title="<?php _e('use the excerpt if exists otherwise use the content', 'mymail'); ?>"><input type="radio" name="embed_options_content" class="embed_options_content" value="excerpt" checked> <?php _e('excerpt', 'mymail'); ?> </label>
				<label title="<?php _e('use the content', 'mymail'); ?>"><input type="radio" name="embed_options_content" class="embed_options_content" value="content"> <?php _e('full content', 'mymail'); ?> </label>
			</p>
			<p id="post_type_select" class="alignright">
			<?php 
				$pts = get_post_types( array( 'public' => true ), 'objects' );
				foreach($pts as $pt => $data){
					if(in_array($pt, array('attachment', 'newsletter'))) continue;
			?>
			<label><input type="checkbox" name="post_types[]" value="<?php echo $pt ?>" <?php checked($pt == 'post', true); ?>> <?php echo $data->labels->name ?> </label>
			<?php
				}
			?>
			</p>
			<div class="postlist">
			</div>
		</div>
		
		<div id="dynamic_embed_options" class="clear tab" style="display:none;">
			<div class="right">
			<h4>&hellip;</h4>
			</div>
			<div class="left">
			<p>
			
			<?php
			$content = '<select id="dynamic_embed_options_content"><option value="excerpt">'.__('the excerpt', 'mymail').'</option><option value="content">'.__('the full content', 'mymail').'</option></select>';
			
			$relative = '<select id="dynamic_embed_options_relative" class="check-for-posts">';
			$relativenames = array(
				-1 => __('the latest', 'mymail'),
				-2 => __('the second latest', 'mymail'),
				-3 => __('the third latest', 'mymail'),
				-4 => __('the fourth latest', 'mymail'),
				-5 => __('the fifth latest', 'mymail'),
				-6 => __('the sixth latest', 'mymail'),
				-7 => __('the seventh latest', 'mymail'),
				-8 => __('the eighth latest', 'mymail'),
				-9 => __('the ninth latest', 'mymail'),
				-10 => __('the tenth latest', 'mymail'),
				-11 => __('the eleventh latest', 'mymail'),
				-12 => __('the twelfth latest', 'mymail'),
			);
			
			foreach($relativenames as $key => $name){
				$relative .= '<option value="'.$key.'">'.$name.'</option>';
			}
			
			$relative .= '</select>';
			$post_types = '<select id="dynamic_embed_options_post_type">';
			foreach($pts as $pt => $data){
				if(in_array($pt, array('attachment', 'newsletter'))) continue;
				$post_types .= '<option value="'.$pt.'">'.$data->labels->singular_name.'</option>';
			}
			$post_types .= '</select>';
			
			echo sprintf(_x('Insert %1$s of %2$s %3$s', 'Insert [excerpt] of [latest] [post]','mymail'), $content, $relative, $post_types); ?>

			</p>
			<div id="dynamic_embed_options_cats"></div>
			</div>
			<p class="description clear"><?php _e('dynamic content get replaced with the proper content as soon as the campaign get send. Check the quick preview to see the current status of dynamic elements', 'mymail'); ?></p>
		</div>
		
		<div id="rss_embed_options" class="tab">
			
			<div id="rss_input">
			<p>
				<?php _e('Enter feed URL', 'mymail') ?><br>
				<label><input type="text" id="rss_url" class="widefat" placeholder="http://example.com/feed.xml" value=""></label>
			</p>
				<ul id="recent_feeds">
			<?php if($recent_feeds = get_option('mymail_recent_feeds')) :
					echo '<li><strong>'.__('Recent Feeds', 'mymail').'</strong></li>';
				foreach($recent_feeds as $title => $url){
					echo '<li><a href="'.$url.'">'.$title.'</a></li>';
				}
			endif; ?>
				</ul>
			</div>
				
			<div id="rss_more" style="display:none;">
				<div class="alignright"><a href="#" class="rss_change"><?php _e('change', 'mymail'); ?></a></div>
				<div class="rss_info"></div>
				<p class="editbarinfo clear">&nbsp;</p>
				<p class="alignleft">
					<label title="<?php _e('use the excerpt if exists otherwise use the content', 'mymail'); ?>"><input type="radio" name="embed_options_content_rss" class="embed_options_content_rss" value="excerpt" checked> <?php _e('excerpt', 'mymail'); ?> </label>
					<label title="<?php _e('use the content', 'mymail'); ?>"><input type="radio" name="embed_options_content_rss" class="embed_options_content_rss" value="content"> <?php _e('full content', 'mymail'); ?> </label>
				</p>
				<div class="postlist">
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="buttons clearfix">
		<button class="button button-primary button-large save"><?php _e('Insert', 'mymail') ?></button>
		<button class="button button-large cancel"><?php _e('Cancel', 'mymail') ?></button>
		<label title="<?php _e('use HighDPI/Retina ready images if available', 'mymail'); ?>"><input type="checkbox" class="highdpi"> <?php _e('HighDPI/Retina ready', 'mymail'); ?></label>
		<a class="remove"><?php _e('remove element', 'mymail') ?></a>
	</div>
	<input type="hidden" class="imagewidth">
	<input type="hidden" class="imageheight">
	<input type="hidden" class="factor" value="1">
</div>
<div id="mymail_type_preview"></div>
<?php 

	else :
	
	$stats['total'] = isset($this->campaign_data['totalclicks']) ? $this->campaign_data['totalclicks'] : 0;
	$stats['clicks'] = isset($this->campaign_data['clicks']) ? $this->campaign_data['clicks'] : array();
	
?>
<div id="mymail_click_stats" data-stats='<?php echo json_encode($stats);?>'></div>
<textarea id="content" name="content" class="hidden" autocomplete="off"><?php echo $post->post_content ?></textarea>
<textarea id="excerpt" name="excerpt" class="hidden" autocomplete="off"><?php echo $post->post_excerpt ?></textarea>
<?php 
	endif;
?>
<iframe id="mymail_iframe" src="<?php echo admin_url('admin-ajax.php?action=mymail_get_template&id='.$post->ID.'&template='.$this->get_template().'&file='.$this->get_file().'&_wpnonce='.wp_create_nonce('mymail_nonce').'&editorstyle='.($editable).'&nocache='.time())?>" width="100%" height="1000" scrolling="no" frameborder="0"></iframe>
<div id="mymail_campaign_preview" style="display:none;"><div class="mymail_campaign_preview device-full">
	<div class="device-list optionbar">
		<ul>
			<li><a data-size="full" class="mymail-icon device-full">&nbsp;</a></li>
			<li><a data-size="320x480" class="mymail-icon device-320x480">&nbsp;</a></li>
			<li><a data-size="480x320" class="mymail-icon device-480x320">&nbsp;</a></li>
		</ul>
	</div>
	<div class="device-wrap">
		<div class="preview-frame">
		<iframe id="mymail_campaign_preview_iframe" src="" width="100%" scrolling="auto" frameborder="0"></iframe>
		</div>
	</div>
	<p class="device-info"><?php _e('Your email may look different on mobile devices', 'mymail'); ?></p>
</div></div>
<textarea id="content" name="content" class="hidden" autocomplete="off"></textarea>
<textarea id="modules" class="hidden" autocomplete="off"><?php echo $modules ?></textarea>
<textarea id="head" name="head" class="hidden" autocomplete="off"><?php echo isset($this->post_data['head']) ? $this->post_data['head'] : $this->templateobj->get_head(); ?></textarea>
<div id="module-codeview">
<a class="cancel top-cancel" href="#">&#10005;</a>
<h2><?php _e('HTML of', ''); ?> &quot;<span></span>&quot;</h2>
<textarea id="module-codeview-textarea" class="hiddens" autocomplete="off"></textarea>
<div class="buttons alignright">
	<a class="button button-primary save"><?php _e('Save', 'mymail'); ?></a> <?php _e('or', 'mymail'); ?> <a href="#" class="cancel"><?php _e('Cancel', 'mymail'); ?></a>
</div>
</div>
<div id="mymail_editor_holder"><?php

function mymail_mce_before_init($mceInit, $editor_id){

	$mceInit['wpautop'] = false;
	$mceInit['remove_linebreaks'] = false;
	$mceInit['apply_source_formatting'] = true;
	$mceInit['editor_height'] = 315;
	$mceInit['theme_advanced_buttons1'] = 'formatselect,bold,italic,underline,strikethrough,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,|,undo,redo,|,link,unlink,|,removeformat,fullscreen';
	return $mceInit;
}
function mymail_quicktags_settings($qtInit, $editor_id){
	$qtInit['buttons'] = 'strong,em,link,block,del,img,ul,ol,li,spell,close';
	return $qtInit;
}
add_filter('tiny_mce_before_init', 'mymail_mce_before_init', 99, 2);
add_filter('teeny_mce_before_init', 'mymail_mce_before_init', 99, 2);
add_filter('quicktags_settings', 'mymail_quicktags_settings', 99, 2);

wp_editor('', 'mymail-editor', array('wpautop' => false, 'media_buttons' => false, 'textarea_rows' => 18,'teeny' => true, 'quicktags' => true) ); 
?></div>
