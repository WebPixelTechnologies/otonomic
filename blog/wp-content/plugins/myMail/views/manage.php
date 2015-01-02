<?php 
	global $mymail_manage;
	
	$currentpage = isset($_GET['tab']) ? $_GET['tab'] : 'import';
	$currentstep = isset($_GET['step']) ? intval($_GET['step']) : 1;
	
?>
<div class="wrap">
<div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
<h2 class="nav-tab-wrapper">
	
	<a class="nav-tab <?php echo ('import' == $currentpage) ? 'nav-tab-active' : '' ?>" href="edit.php?post_type=newsletter&page=mymail_subscriber-manage&tab=import"><?php _e('Import', 'mymail')?></a>
	
	<?php if(current_user_can('mymail_export_subscribers')) : ?>
	<a class="nav-tab <?php echo ('export' == $currentpage) ? 'nav-tab-active' : '' ?>" href="edit.php?post_type=newsletter&page=mymail_subscriber-manage&tab=export"><?php _e('Export', 'mymail')?></a>
	<?php endif;?>
	
	<a class="nav-tab <?php echo ('pending' == $currentpage) ? 'nav-tab-active' : '' ?>" href="edit.php?post_type=newsletter&page=mymail_subscriber-manage&tab=pending"><?php _e('Pending', 'mymail')?></a>
	
	<?php if(current_user_can('delete_subscribers') && current_user_can('delete_others_subscribers')) : ?>
	<a class="nav-tab <?php echo ('delete' == $currentpage) ? 'nav-tab-active' : '' ?>" href="edit.php?post_type=newsletter&page=mymail_subscriber-manage&tab=delete"><?php _e('Delete', 'mymail')?></a>
	<?php endif;?>
	
</h2>
<?php wp_nonce_field( 'mymail_nonce', 'mymail_nonce', false ); ?>

<?php if('import' == $currentpage && current_user_can('mymail_import_subscribers')) : ?>

	
	
	<div class="step1">
		<p class="howto"><?php _e('upload you subscribers as comma-separated list (CSV)', ''); ?></p>
		<div class="upload-method">
			<h2><?php _e('Upload', 'mymail'); ?></h2>
			<form enctype="multipart/form-data" method="post" action="<?php echo admin_url('admin-ajax.php?action=mymail_import_subscribers_upload_handler'); ?>">
			
			<?php $mymail_manage->media_upload_form(); ?>
			
			</form>
		</div>
		<div class="upload-method-or">
			<?php _e('or', 'mymail'); ?>
		</div>
		<div class="upload-method">
			<h2><?php _e('Paste', 'mymail'); ?></h2>
			<textarea id="paste-import" class="widefat" rows="13" placeholder="<?php _e('paste your list here', 'mymail'); ?>">
justin.case@<?php echo $_SERVER['HTTP_HOST']?>; Justin; Case; Custom;
john.doe@<?php echo $_SERVER['HTTP_HOST']?>; John; Doe
jane.roe@<?php echo $_SERVER['HTTP_HOST']?>; Jane; Roe
			</textarea>
		</div>
	
		<br class="clear">
		
	</div>

	<h2 id="import-status"></h2>
	<div class="step2">
	</div>
	<div id="wordpress-users">
		<h2><?php _e('WordPress Users', 'mymail'); ?></h2>
		<form id="import_wordpress" method="post">
			<?php 
			
			global $wp_roles;
			$roles = $wp_roles->get_names();
			
			if(!empty($roles)) :?>
			<div id="wordpress-user-roles">
			<h4><?php _e('Import WordPress users with following roles', 'mymail'); ?></h4>
			<p><label><input type="checkbox" class="wordpress-users-toggle" checked> <?php _e('toggle all', 'mymail'); ?></label></p>
			<ul>
			<?php 
			$i = 0;
			foreach($roles as $role => $name){
				if(!($i%8) && $i) echo '</ul><ul>';
				?>
				<li><label><input type="checkbox" name="roles[]" value="<?php echo $role ?>" checked> <?php echo $name ?></label></li>
				<?php
				$i++; 
			}
			?>
			</ul>
			</div>
			<div id="wordpress-user-meta">
			<?php 
				global $wpdb;
				$exclude = array('comment_shortcuts', 'first_name', 'last_name', 'nickname', 'use_ssl', 'default_password_nag', 'dismissed_wp_pointers', 'rich_editing', 'show_admin_bar_front', 'show_welcome_panel', 'admin_color', 'screen_layout_dashboard', 'screen_layout_newsletter');
				$meta_values = $wpdb->get_col("SELECT meta_key FROM {$wpdb->usermeta} WHERE meta_value NOT LIKE '%{%}%' AND meta_key NOT LIKE '{$wpdb->prefix}%' AND meta_key NOT IN ('".implode("', '", $exclude)."') GROUP BY meta_key ASC");

			?>
			<h4><?php _e('Use following meta values', 'mymail'); ?></h4>
			<p><label><input type="checkbox" class="wordpress-users-toggle"> <?php _e('toggle all', 'mymail'); ?></label></p>
			<ul>
			<?php 
			foreach($meta_values as $i => $meta_value){
				if(!($i%8) && $i) echo '</ul><ul>';
				?>
				<li><label><input type="checkbox" name="meta_values[]" value="<?php echo $meta_value ?>"> <?php echo $meta_value ?></label></li>
				<?php 
			}
			?>
			</ul>
			</div>
			<?php endif;?>
			<div class="clearfix clear">
			<input type="submit" class="button button-primary button-large" value="<?php _e('Next Step', 'mymail'); ?> →">
			</div>
		</form>
	</div>
	
<?php elseif('export' == $currentpage && current_user_can('mymail_export_subscribers')) :?>
	
		<h2 class="export-status"><?php _e('Export Subscribers', 'mymail') ?></h2>
		<?php
		global $wpdb;
		
		$lists = get_terms('newsletter_lists', array('hide_empty' => true));
		
		$no_list = $wpdb->get_var("SELECT COUNT(DISTINCT a.ID) FROM {$wpdb->posts} a LEFT JOIN {$wpdb->users} u ON (a.post_author = u.ID) WHERE a.post_type IN('subscriber') AND a.ID NOT IN (SELECT object_id FROM {$wpdb->term_relationships} tr LEFT JOIN {$wpdb->term_taxonomy} tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id) WHERE taxonomy = 'newsletter_lists')");
	
		if(!empty($lists) || $no_list) : ?>
		
		<div class="step1">
		<form method="post" id="export-subscribers">
		<?php wp_nonce_field('mymail_nonce'); ?>
		
		<?php if(!empty($lists)) :?>
		<h3>
		<?php _e('which are in one of these lists', 'mymail'); ?>:
		</h3>
		<ul>
		<?php 
		foreach($lists as $list){
			?>
			<li><label><input type="checkbox" name="lists[]" value="<?php echo $list->term_id?>" data-count="<?php echo $list->count?>" checked> <?php echo $list->name. ' <span class="small">('.$list->count.')</span>'?></label></li>
			<?php 
		}
		?>
		</ul>
		<?php endif; ?>
		
		<?php if($no_list) :?>
		<ul>
			<li><label><input type="checkbox" name="nolists" value="1" checked> <?php echo __('subscribers not assigned to a list', 'mymail').' <span class="small">('.$no_list.')</span>'?></label></li>
		</ul>
		<?php endif; ?>
		<h3>
		<?php _e('and have one of these statuses', 'mymail'); ?>:<br>
		</h3>
		<p>
			<label><input type="checkbox" name="status[]" value="subscribed" checked> <?php _e('subscribed', 'mymail'); ?> </label> 
			<label><input type="checkbox" name="status[]" value="unsubscribed" checked> <?php _e('unsubscribed', 'mymail'); ?> </label> 
			<label><input type="checkbox" name="status[]" value="hardbounced" checked> <?php _e('hardbounced', 'mymail'); ?> </label> 
			<label><input type="checkbox" name="status[]" value="error" checked> <?php _e('error', 'mymail'); ?> </label> 
			<label><input type="checkbox" name="status[]" value="trash" checked> <?php _e('trash', 'mymail'); ?> </label> 
		</p>
		<p>
			<label><input type="checkbox" name="header" value="1"> <?php _e('include header', 'mymail'); ?> </label> 
		</p>
		<p>
			<label><?php _e('Date Format', 'mymail') ?>: 
			<select name="dateformat">
				<option value="0">timestamp - (<?php echo current_time('timestamp') ?>)</option>
				<option value="<?php $d = get_option('date_format').' '.get_option('time_format'); echo $d ?>">
				<?php echo $d.' - ('.date($d, current_time('timestamp')).')'; ?>
				</option>
				<option value="<?php $d = get_option('date_format'); echo $d ?>">
				<?php echo $d.' - ('.date($d, current_time('timestamp')).')'; ?>
				</option>
				<option value="<?php $d = 'Y-d-m H:i:s'; echo $d ?>">
				<?php echo $d.' - ('.date($d, current_time('timestamp')).')'; ?>
				</option>
				<option value="<?php $d = 'Y-d-m'; echo $d ?>">
				<?php echo $d.' - ('.date($d, current_time('timestamp')).')'; ?>
				</option>
			</select>
			</label>
		</p>
		<p>
			<label><?php _e('Output Format', 'mymail') ?>: 
			<select name="outputformat">
				<option value="csv" selected><?php _e('CSV', 'mymail'); ?></option>
				<option value="html" ><?php _e('HTML', 'mymail'); ?></option>
			</select>
			</label>
		</p>
		<p>
			<label><?php _e('CharSet', 'mymail') ?>: 
			<?php $charsets = array(
				'UTF-8' => 'Unicode 8',
				'ISO-8859-1' => 'Western European',
				'ISO-8859-2' => 'Central European',
				'ISO-8859-3' => 'South European',
				'ISO-8859-4' => 'North European',
				'ISO-8859-5' => 'Latin/Cyrillic',
				'ISO-8859-6' => 'Latin/Arabic',
				'ISO-8859-7' => 'Latin/Greek',
				'ISO-8859-8' => 'Latin/Hebrew',
				'ISO-8859-9' => 'Turkish',
				'ISO-8859-10' => 'Nordic',
				'ISO-8859-11' => 'Latin/Thai',
				'ISO-8859-13' => 'Baltic Rim',
				'ISO-8859-14' => 'Celtic',
				'ISO-8859-15' => 'Western European revision',
				'ISO-8859-16' => 'South-Eastern European',
			)?>
			<select name="encoding">
				<?php foreach( $charsets as $code => $region ){ ?>
				<option value="<?php echo $code; ?>"><?php echo $code; ?> - <?php echo $region; ?></option>
				<?php }?>
			</select>
			</label>
		</p>
		<p>
			<label><?php _e('MySQL Server Performance', 'mymail') ?>: 
			<select name="performance" class="performance">
				<option value="100"><?php _e('low', 'mymail'); ?></option>
				<option value="500" selected><?php _e('normal', 'mymail'); ?></option>
				<option value="1000"><?php _e('high', 'mymail'); ?></option>
				<option value="2000"><?php _e('super high', 'mymail'); ?></option>
				<option value="5000"><?php _e('super extreme high', 'mymail'); ?></option>
			</select>
			</label>
		</p>
		<h3>
		<?php _e('Define order and included columns', 'mymail'); ?>:<br>
		</h3>
		<?php 
			$columns = array();
		$customfields = mymail_option('custom_field', array());
		
		$columns = array(
			'email' => mymail_text('email'),
			'firstname' => mymail_text('firstname'),
			'lastname' => mymail_text('lastname'),
		);
		$meta = array(
			'_status' => __('Status', 'mymail'),
			'_ip' => __('IP Address', 'mymail'),
			'_signuptime' => __('Signup Date', 'mymail'),
			'_signupip' => __('Signup IP', 'mymail'),
			'_confirmtime' => __('Confirm Date', 'mymail'),
			'_confirmip' => __('Confirm IP', 'mymail'),
		);
		?>
		<ul class="export-order">
			<li><input type="checkbox" name="column[]" value="_number"> #</li>
		<?php foreach( $columns as $id => $name ){ ?>
			<li><input type="checkbox" name="column[]" value="<?php echo $id ?>" checked> <?php echo $name ?></li>
		<?php } ?>
		<?php foreach( $customfields as $id => $data ){ ?>
			<li><input type="checkbox" name="column[]" value="<?php echo $id ?>" checked> <?php echo $data['name'] ?></li>
		<?php } ?>
			<li><input type="checkbox" name="column[]" value="_listnames" checked> <?php echo __('Listnames', 'mymail') ?></li>
		<?php foreach( $meta as $id => $name ){ ?>
			<li><input type="checkbox" name="column[]" value="<?php echo $id ?>"> <?php echo $name ?></li>
		<?php } ?>
		</ul>
		
		<p>
			<input class="button button-large button-primary" type="submit" value="<?php _e('Download Subscribers', 'mymail') ?>" />
		</p>
		</form>
		</div>
		<div class="step2">
		</div>
	<?php else : ?>
		<p><?php _e('no subscriber found', 'mymail'); ?></p>
	
	<?php endif;?>
	
	
<?php elseif('pending' == $currentpage) :?>

		<h2><?php _e('Pending Subscribers', 'mymail') ?></h2>
		
		<?php $confirms = get_option( 'mymail_confirms' );
		
		$customfields = mymail_option('custom_field', array());
		
		if(isset($_REQUEST['action'])){
		
			switch($_REQUEST['action']){
				case 'delete':
					if (wp_verify_nonce($_REQUEST['_wpnonce'], 'delete-pending')) {
					
						$hash = esc_attr($_GET['hash']);
						
						if(isset($confirms[$hash])){
						?>
<div class="error"><p><?php echo sprintf(__('Pending subscriber %s removed from the list', 'mymail'), '<strong>'.$confirms[$hash]['userdata']['email'].'</strong>'); ?></p></div>
						<?php
							unset($confirms[$hash]);
							update_option('mymail_confirms', $confirms);
						
						}
					}
					break;
					
				case 'resend':
					if (wp_verify_nonce($_REQUEST['_wpnonce'], 'resend-pending')) {
					
						$hash = esc_attr($_GET['hash']);
						
						if(isset($confirms[$hash])){
						
							global $mymail;
							if($mymail->resend_confirmation($hash, true)){
						?>
<div class="updated"><p><?php echo sprintf(__('Confirmation sent to %s', 'mymail'), '<strong>'.$confirms[$hash]['userdata']['email'].'</strong>'); ?></p></div>
						<?php
						
							}else{
								
							}
						}
					}
					break;
					
				case 'bulk-delete':
					if (wp_verify_nonce($_REQUEST['bulk-action'], 'bulk-action')) {
					
						$hashes = (array) $_POST['pending'];
						$count = 0;
						
						foreach($hashes as $hash){
							if(isset($confirms[$hash])){
								unset($confirms[$hash]);
								$count++;
							}
						}
						?>
<div class="error"><p><?php echo sprintf(__('%s Pending subscribers removed from the list', 'mymail'), '<strong>'.$count.'</strong>'); ?></p></div>
						<?php
						update_option('mymail_confirms', $confirms);

					}
					break;
					
				case 'bulk-resend':
					if (wp_verify_nonce($_REQUEST['bulk-action'], 'bulk-action')) {
					
						$hashes = (array) $_POST['pending'];
						$count = 0;
						
						global $mymail;
						
						foreach($hashes as $hash){
							if(isset($confirms[$hash])){
								if($mymail->resend_confirmation($hash, true)){
									$count++;
								}
							}
						}
						?>
<div class="error"><p><?php echo sprintf(__('%s confirmations sent', 'mymail'), '<strong>'.$count.'</strong>'); ?></p></div>
						<?php
						
					}
					break;
					
			}
		}
		
		if(!empty($confirms)) :
		
		?>
		<p><?php _e('following subscribers didn\'t confirm there subscription yet', 'mymail'); ?></p>
		
		
		<form method="post">
		<?php wp_nonce_field( 'bulk-action', 'bulk-action', false ); ?>
		<div class="alignleft actions bulkactions">
			<select name="action">
			<option value="-1" selected="selected"><?php _e('Bulk Actions', 'update'); ?></option>
			<option value="bulk-delete"><?php _e('delete', 'mymail'); ?></option>
			<option value="bulk-resend"><?php _e('resend confirmation', 'mymail') ?></option>
			</select>
			<input type="submit" name="" id="doaction" class="button action" value="Apply">
		</div>
		<table class="wp-list-table widefat fixed">
			<thead><tr><td width="4%">#</td><td width="4%"><input type="checkbox" name="pending[]" class="selectall" value="0"></td><td><?php echo mymail_text('email') ?></td><td><?php _e('Userdata', 'mymail'); ?></td><td><?php echo mymail_text('lists') ?></td><td><?php _e('Signup Time', 'mymail'); ?></td><td><?php _e('IP Address', 'mymail'); ?></td></tr></thead>
		<tbody>
		<?php 
			$confirms = array_reverse($confirms);
			
			$i = 1;
			$forms = mymail_option('forms');
				foreach($confirms as $hash => $data){
					$form = isset($data['form']) && isset($forms[$data['form']]) ? $forms[$data['form']] : $forms[0];
				?>
			<tr class="<?php echo ($i%2 ? 'alternate' : '')?>"><td><?php echo $i++ ?></td><td><input type="checkbox" name="pending[]" value="<?php echo $hash ?>"></td>
			<td><strong><a href="mailto:<?php echo $data['userdata']['email']?>"><?php echo $data['userdata']['email']?></a></strong><br>
				<div class="row-actions">
				<span class="resend"><a title="<?php _e('send the confirmation message to this subscriber', 'mymail'); ?>" href="edit.php?post_type=newsletter&page=mymail_subscriber-manage&tab=pending&action=resend&hash=<?php echo $hash ?>&_wpnonce=<?php echo wp_create_nonce('resend-pending')?>">
				<?php _e('resend confirmation', 'mymail'); ?></a> | </span>
				<span class="trash"><a class="submitdelete" title="<?php _e('delete this subscriber from the pending list', 'mymail'); ?>" href="edit.php?post_type=newsletter&page=mymail_subscriber-manage&tab=pending&action=delete&hash=<?php echo $hash ?>&_wpnonce=<?php echo wp_create_nonce('delete-pending')?>">
				<?php _e('delete', 'mymail'); ?></a></span>
				</div>
			</td>
			<td><?php 
				foreach($data['userdata'] as $key => $value){
					if(in_array($key, array('email', '_meta'))) continue;
					echo '<div><strong>'.mymail_text($key, (isset($customfields[$key]) ? $customfields[$key]['name'] : $key)).'</strong>: '.$value.'</div>';
					
				}
			?></td>
			<td><?php 
				foreach($data['lists'] as $list){
					$obj = get_term_by('slug', $list, 'newsletter_lists');
					echo ($obj) 
						? '<div><a href="edit-tags.php?action=edit&taxonomy=newsletter_lists&tag_ID='.$obj->term_id.'&post_type=newsletter">'.$obj->name.'</a></div>'
						: '<div>'.$list.'</div>';
					
				}
			?></td>
			<td><strong><?php echo sprintf(__('%s ago', 'mymail'), human_time_diff($data['timestamp'])); ?></strong><br>
			<span class="small"><?php echo date_i18n(get_option('date_format').' '.get_option('time_format'), $data['timestamp']+(get_option('gmt_offset')*3600)) ?><br><?php echo sprintf(__('via form %s', 'mymail'), '"<strong>'.$form['name'].'</strong>"');
			?></span>
			</td>
			<td><?php
				if(isset($data['userdata']['_meta']) && isset($data['userdata']['_meta']['ip'])) echo $data['userdata']['_meta']['ip'];
			?></td>
			</tr>
			
		<?php }?>
		</tbody>
			<tfoot><tr class="<?php echo ($i%2 ? 'alternate' : '')?>"><td width="4%">#</td><td width="4%"><input type="checkbox" name="pending[]" class="selectall" value="0"></td><td><?php echo mymail_text('email') ?></td><td><?php _e('Userdata', 'mymail'); ?></td><td><?php echo mymail_text('lists') ?></td><td><?php _e('Signup Time', 'mymail'); ?></td><td><?php _e('IP Address', 'mymail'); ?></td></tr></tfoot>
		</table>
		</form>
		<?php else : ?>
		
		<p><?php _e('currently no pending subscribers', 'mymail'); ?></p>
		
		<?php endif; ?>


<?php elseif('delete' == $currentpage && current_user_can('delete_subscribers') && current_user_can('delete_others_subscribers')) :?>
	
		<h2 class="delete-status"><?php _e('Delete Subscribers', 'mymail') ?></h2>
		<?php
		global $wpdb;
		
		$lists = get_terms('newsletter_lists', array('hide_empty' => true));
		
		$no_list = $wpdb->get_var("SELECT COUNT(DISTINCT a.ID) FROM {$wpdb->posts} a LEFT JOIN {$wpdb->users} u ON (a.post_author = u.ID) WHERE a.post_type IN('subscriber') AND a.ID NOT IN (SELECT object_id FROM {$wpdb->term_relationships} tr LEFT JOIN {$wpdb->term_taxonomy} tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id) WHERE taxonomy = 'newsletter_lists')");
	
		if(!empty($lists) || $no_list) : ?>
		
		<div class="step1">
		<form method="post" id="delete-subscribers">
		<?php wp_nonce_field('mymail_nonce'); ?>
		
		<?php if(!empty($lists)) :?>
		<h3>
		<?php _e('which are in one of these lists', 'mymail'); ?>:
		</h3>
		<ul>
		<?php 
		foreach($lists as $list){
			?>
			<li><label><input type="checkbox" name="lists[]" value="<?php echo $list->term_id?>" data-count="<?php echo $list->count?>"> <?php echo $list->name. ' <span class="small">('.$list->count.')</span>'?></label></li>
			<?php 
		}
		?>
		</ul>
		<?php endif; ?>
		
		<?php if($no_list) :?>
		<ul>
			<li><label><input type="checkbox" name="nolists" value="1"> <?php echo __('subscribers not assigned to a list', 'mymail').' <span class="small">('.$no_list.')</span>'?></label></li>
		</ul>
		<?php endif; ?>
		<h3>
		<?php _e('and have one of these statuses', 'mymail'); ?>:<br>
		</h3>
		<p>
			<label><input type="checkbox" name="status[]" value="subscribed" checked> <?php _e('subscribed', 'mymail'); ?> </label> 
			<label><input type="checkbox" name="status[]" value="unsubscribed" checked> <?php _e('unsubscribed', 'mymail'); ?> </label> 
			<label><input type="checkbox" name="status[]" value="hardbounced" checked> <?php _e('hardbounced', 'mymail'); ?> </label> 
			<label><input type="checkbox" name="status[]" value="error" checked> <?php _e('error', 'mymail'); ?> </label> 
			<label><input type="checkbox" name="status[]" value="trash" checked> <?php _e('trash', 'mymail'); ?> </label> 
		</p>
		<p>
			<label><input type="checkbox" name="remove_lists" value="1"> <?php _e('remove selected lists', 'mymail'); ?> </label> 
		</p>
		<p>
			<input class="button button-large button-primary" type="submit" value="<?php _e('Delete Subscribers permanently', 'mymail') ?>" />
		</p>
		</form>
		</div>
	<?php else : ?>
		<p><?php _e('no subscriber found', 'mymail'); ?></p>
	
	<?php endif;?>
	
<?php else : ?>
	
	<h2><?php _e('You do not have sufficient permissions to access this page.', 'mymail') ?></h2>
	
<?php endif;?>

	<div id="progress" class="progress"><span class="bar" style="width:0%"><span></span></div>


<div id="ajax-response"></div>
<br class="clear">
</div>
