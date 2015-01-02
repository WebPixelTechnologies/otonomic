<div class="submitbox" id="submitpost">

<?php do_action('post_submitbox_start'); ?>
<div id="preview-action">
<input type="hidden" name="wp-preview" id="wp-preview" value="" />
</div>
<div class="clear"></div>

<div id="misc-publishing-actions">

	<div id="delete-action">
	<?php
	if ( current_user_can( "delete_post", $post->ID ) ) {
		if ( !EMPTY_TRASH_DAYS )
			$delete_text = __('Delete Permanently', 'mymail');
		else
			$delete_text = __('Move to Trash', 'mymail');
		?>
	<a class="submitdelete deletion" href="<?php echo get_delete_post_link($post->ID); ?>"><?php echo $delete_text; ?></a>
	<?php } ?>
	</div>
	
	<div id="publishing-action">
	<span class="spinner ajax-loading" id="ajax-loading"></span>
	<?php
	if ($post->post_status == 'finished') {
		?>
	<?php if (current_user_can('duplicate_newsletters') && current_user_can('duplicate_others_newsletters', $post->ID)) { ?><a class="button duplicate" href="edit.php?post_type=newsletter&duplicate=<?php echo $post->ID?>&edit=1&_wpnonce=<?php echo wp_create_nonce('mymail_nonce')?>"><?php _e('Duplicate' ,'mymail')?></a> <?php } ?>
		<?php
	}else if ( !in_array( $post->post_status, array('publish', 'future', 'private', 'paused') ) || 0 == $post->ID ) {
		
		if(isset($_GET['showstats']) && $_GET['showstats'] && $post->post_status == 'autoresponder') : ?>
	
	<?php if ($can_publish) { ?><a class="button" href="post.php?post=<?php echo $post->ID?>&action=edit"><?php _e('Edit' ,'mymail')?></a> <?php } ?>

	<?php
		elseif ( $can_publish ) :
			if ($post->post_status == 'active') : ?>
			<a class="button pause" href="edit.php?post_type=newsletter&pause=<?php echo $post->ID?>&edit=1&_wpnonce=<?php echo wp_create_nonce('mymail_nonce')?>"><?php _e('Pause' ,'mymail')?></a>
	<?php	elseif ($post->post_status == 'queued') : ?>
				<?php if($this->campaign_data['sent']) : ?>
			<input name="send_now" type="submit" class="button" value="<?php esc_attr_e('Resume', 'mymail') ?>" />
				<?php else : ?>
			<input name="send_now" type="submit" class="button" value="<?php esc_attr_e('Send now', 'mymail') ?>" />
				<?php endif; ?>
	<?php	elseif ($post->post_status == 'autoresponder') : ?>
			<a href="<?php echo add_query_arg(array('post' => $post->ID, 'action' => 'edit', 'showstats' => 1), ''); ?>" class="button statistics"><?php _e('Statistic', 'mymail'); ?></a>
	<?php	endif;
			if ( !empty($post->post_date_gmt) && time() < strtotime( $post->post_date_gmt . ' +0000' ) ) : ?>
			<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Schedule', 'mymail') ?>" />
			<?php submit_button( __( 'Schedule', 'mymail' ), 'primary', 'publish', false, array( 'accesskey' => 'p' ) ); ?>
	<?php	elseif($post->post_status != 'active') : ?>
			<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Publish', 'mymail') ?>" />
			<?php submit_button( __( 'Save', 'mymail' ), 'primary', 'publish', false, array( 'accesskey' => 'p' ) ); ?>
	<?php	endif;
		else : ?>
			<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Submit for Review', 'mymail') ?>" />
			<?php submit_button( __( 'Submit for Review', 'mymail' ), 'primary', 'publish', false, array( 'accesskey' => 'p' ) ); ?>
	<?php
		endif;
	} else { 
			if ($can_publish && in_array($post->post_status, array('paused', 'queued'))) : ?>
				<?php if(isset($this->campaign_data['sent']) && $this->campaign_data['sent']) : ?>
			<input name="send_now" type="submit" class="button" value="<?php esc_attr_e('Resume', 'mymail') ?>" />
				<?php else : ?>
			<input name="send_now" type="submit" class="button" value="<?php esc_attr_e('Send now', 'mymail') ?>" />
				<?php endif; ?>
	<?php	endif; ?>
			<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Update', 'mymail') ?>" />
			<input name="save" type="submit" class="button-primary" id="publish" tabindex="15" accesskey="p" value="<?php esc_attr_e('Update', 'mymail') ?>" />
	<?php
	} ?>
	</div>
<div class="clear"></div>
</div>

</div>
