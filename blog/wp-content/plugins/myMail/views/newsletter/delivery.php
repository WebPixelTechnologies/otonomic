<?php 

	$editable = !in_array($post->post_status, array('active', 'finished'));
	if(isset($_GET['showstats']) && $_GET['showstats'] && $post->post_status == 'autoresponder') $editable = false;
	
	$active = isset($this->post_data['active']) ? $this->post_data['active'] : false;
	$autoresponder_active = isset($this->post_data['active_autoresponder']) ? $this->post_data['active_autoresponder'] : false;
	
	$timestamp = (isset($this->post_data['timestamp'])) ? $this->post_data['timestamp'] : current_time('timestamp');
	
	$timestamp = (!$active) ? max(current_time('timestamp')+(60*mymail_option('send_offset')),$timestamp) : $timestamp;
	
	
	$autoresponder = $post->post_status == 'autoresponder';
	
	$current_user = wp_get_current_user();
	
	$totalcount = $this->get_totals_by_id($post_id);
	$totalcount += (isset($this->campaign_data['unsubscribes'])) ? $this->campaign_data['unsubscribes'] : 0;
	
?>
<?php if($editable) : ?>
<?php if(current_user_can('mymail_edit_autoresponders')) :?>
<ul class="category-tabs">
	<li class="<?php if(!$autoresponder) echo 'tabs';?>"><a href="#regular-campaign"><?php _e('Regular Campaign', 'mymail'); ?></a></li>
	<li class="<?php if($autoresponder) echo 'tabs';?>"><a href="#autoresponder"><?php _e('Auto Responder', 'mymail'); ?></a></li>
</ul>
<div id="regular-campaign" class="tabs-panel"<?php if($autoresponder) echo ' style="display:none"';?>>
<?php endif; ?>
<p class="howto" title="<?php echo date(get_option('date_format').' '.get_option('time_format'), current_time('timestamp'))?>">
<?php

	echo sprintf( __("Server Time: %s %s" ,'mymail'), '<span title="'.date(get_option('date_format').' '.get_option('time_format'), current_time('timestamp')).'">'.date('Y-m-d', current_time('timestamp')).'</span>', '<span class="time" data-timestamp="'.current_time('timestamp').'">'.date('H:i', current_time('timestamp')).'</span>'  );
	
	elseif ($post->post_status == 'finished') :
	
	echo sprintf( __("This campaign has been sent on %s. You cannot edit it anymore" ,'mymail'), '<strong>'.date(get_option('date_format').' '.get_option('time_format'), isset($this->campaign_data['finished']) ? $this->campaign_data['finished'] : $this->campaign_data['timestamp']).'</strong>' );
	
	endif;
	
?>
</p>
<?php if($editable):?>
<label>
	<input name="mymail_data[active]" id="mymail_data_active" value="1" type="checkbox" <?php echo ($active) ? 'checked' : '' ?> <?php echo (!$editable) ? ' disabled' : '' ?>> <?php _e('send this campaign', 'mymail') ?>
</label>

<div class="active_wrap<?php  if($active) echo ' disabled'; ?>">
	<div class="active_overlay"></div>
	<?php echo sprintf( _x('on %1$s @ %2$s','send campaign "on" (date) "at" (time)', 'mymail'),
		'<input name="mymail_data[date]" class="datepicker deliverydate inactive" type="text" value="'.date('Y-m-d', $timestamp).'" maxlength="10" readonly'.((!$active || $editable) ? ' disabled' : '').'>',
		'<input name="mymail_data[time]" maxlength="5" class="deliverytime inactive" type="text" value="'.date('H:i', $timestamp).'" '.((!$active || !$editable) ? ' disabled' : '').'> UTC '.((get_option('gmt_offset') > 0) ? '+' : '').' '.get_option('gmt_offset')
	)?>
</div>
<?php if(isset($this->campaign_data['sent']) && $this->campaign_data['sent'] && $totalcount && $post->post_status != 'autoresponder'):
	
	$p = round($this->campaign_data['sent'] / $totalcount * 100);
?>
<p>
	<div class="progress paused"><span class="bar" style="width:<?php echo $p ?>%"></span><span>&nbsp;<?php echo sprintf(__('%1$s of %2$s sent', 'mymail'), $this->campaign_data['sent'], $totalcount)?></span><var><?php echo $p ?>%</var></div>
</p>
<?php endif;?>
<?php if(current_user_can('mymail_edit_autoresponders')) :?>
</div>
<div id="autoresponder" class="tabs-panel"<?php if(!$autoresponder) echo ' style="display:none"';?>>
	<?php
		$autoresponderdata = isset($this->post_data['autoresponder']) ? $this->post_data['autoresponder'] : array('operator' => '', 'action' => 'mymail_subscriber_insert', 'unit' => '');
		include_once(MYMAIL_DIR.'/includes/autoresponder.php');
	?>
	<label>
		<input name="mymail_data[active_autoresponder]" id="mymail_data_autoresponder_active" value="1" type="checkbox" <?php checked($autoresponder_active, true) ?> <?php echo (!$editable) ? ' disabled' : '' ?>> <?php _e('send this auto responder', 'mymail') ?>
	</label>
	
	<div id="autoresponder_wrap" class="autoresponder-<?php echo $autoresponderdata['action'] ?>">
		<div class="autoresponder_active_wrap<?php  if($autoresponder_active) echo ' disabled'; ?>">
			<div class="autoresponder_active_overlay"></div>
		<p class="autoresponder_time">
		<input type="text" class="small-text" name="mymail_data[autoresponder][amount]" value="<?php echo isset($autoresponderdata['amount']) ? $autoresponderdata['amount'] : 1?>">
	
			<select name="mymail_data[autoresponder][unit]">
			<?php
				foreach($mymail_autoresponder_info['units'] as $value => $name){
					echo '<option value="'.$value.'"'.selected($autoresponderdata['unit'], $value, false).'>'.$name.'</option>';
				}
			?>
			</select>
				<span class="autoresponder_after"><?php _e('after', 'mymail'); ?></span>
				<span class="autoresponder_before"><?php _e('before', 'mymail'); ?></span>
			</p>
			<p>	
		<select class="widefat" name="mymail_data[autoresponder][action]" id="mymail_autoresponder_action">
		<?php
			foreach($mymail_autoresponder_info['actions'] as $id => $action){
				echo '<option value="'.$id.'"'.selected($autoresponderdata['action'], $id, false).'>'.$action['label'].'</option>';
			}
		?>
		</select>
		</p>
		
		
		<div class="mymail_autoresponder_more autoresponderfield-mymail_subscriber_insert autoresponderfield-mymail_subscriber_unsubscribed">
		<label>
			<input name="mymail_data[autoresponder][advanced]" id="mymail_autoresponder_advanced_check" value="1" type="checkbox" <?php echo (isset($autoresponderdata['advanced']) && $autoresponderdata['advanced']) ? 'checked' : '' ?> <?php echo (!$editable) ? ' disabled' : '' ?>> <?php _e('only if', 'mymail') ?>
		</label>
				<div id="mymail_autoresponder_advanced" <?php if(!isset($autoresponderdata['advanced']) || !$autoresponderdata['advanced']) { echo 'style="display:none"';}?>>
					<p>
					<select class="widefat" name="mymail_data[autoresponder][operator]">
						<option value="OR"<?php selected($autoresponderdata['operator'], 'OR')?> title="<?php _e('or', 'mymail'); ?>"><?php _e('one of the conditions is true', 'mymail'); ?></option>
						<option value="AND"<?php selected($autoresponderdata['operator'], 'AND')?> title="<?php _e('and', 'mymail'); ?>"><?php _e('all of the conditions are true', 'mymail'); ?></option>
					</select>
					</p>
					<?php 
						
						if(!isset($autoresponderdata['conditions'])) $autoresponderdata['conditions'] = array(
							array(
								'field' => '',
								'operator' => '',
								'value' => '',
							)
						);
						
						$fields = apply_filters('mymail_autoresponder_condition_fields', array(
							'email' => mymail_text('email'),
							'firstname' => mymail_text('firstname'),
							'lastname' => mymail_text('lastname'),
						));
						
						foreach($autoresponderdata['conditions'] as $i => $condition){
							if(!isset($condition['field'])) $condition['field'] = '';
							if(!isset($condition['operator'])) $condition['operator'] = '';
							?>
					<div class="mymail_autoresponder_condition" id="mymail_autoresponder_condition_<?php echo $i;?>">
						<select name="mymail_data[autoresponder][conditions][<?php echo $i;?>][field]">
						<?php foreach( $fields as $value => $name ){
							echo '<option value="'.$value.'"'.selected($condition['field'], $value, false).'>'.$name.'</option>';
						}?>
						</select>
						<select name="mymail_data[autoresponder][conditions][<?php echo $i;?>][operator]">
						<?php foreach( $mymail_autoresponder_info['operators'] as $value => $name ){
							echo '<option value="'.$value.'"'.selected($condition['operator'], $value, false).'>'.$name.'</option>';
						}?>
						</select><br>
						<input type="text" class="widefat" name="mymail_data[autoresponder][conditions][<?php echo $i;?>][value]" value="<?php echo esc_attr($condition['value']) ?>">
						<div><a class="remove-condition" title="<?php _e('remove condition', 'mymail'); ?>"><?php _e('remove', 'mymail'); ?></a></div>
					</div>	
							<?php
						}
					?>
					 <a class="add-condition" title="<?php _e('add condition', 'mymail'); ?>"><?php _e('add condition', 'mymail'); ?></a>
			 	</div>
	 	</div>
			
			<?php $pts = get_post_types( array( 'public' => true ), 'object' ); 
					
				$autoresponderdata['post_type'] = isset($autoresponderdata['post_type']) ? $autoresponderdata['post_type'] : 'post';
				$autoresponderdata['post_count'] = isset($autoresponderdata['post_count']) ? $autoresponderdata['post_count'] : 0;
				$autoresponderdata['post_count_status'] = isset($autoresponderdata['post_count_status']) ? $autoresponderdata['post_count_status'] : 0;
				$autoresponderdata['issue'] = isset($autoresponderdata['issue']) ? $autoresponderdata['issue'] : 1;
				
			?>
	 	
	 	<div class="mymail_autoresponder_more autoresponderfield-mymail_post_published">
			<p>
			<?php
				$count = '<input type="text" name="mymail_data[autoresponder][post_count]" class="small-text" value="'.$autoresponderdata['post_count'].'">';
				$type = '<select id="autoresponder-post_type" name="mymail_data[autoresponder][post_type]">';
					foreach($pts as $pt => $data){
						if(in_array($pt, array('attachment', 'newsletter'))) continue;
						$type .= '<option value="'.$pt.'"'.selected($autoresponderdata['post_type'], $pt, false).'>'.$data->labels->singular_name.'</option>';
					}
				$type .= '</select>';
				echo sprintf( __('create a new campaign every time a new %s has been published', 'mymail'), $type );
				?>
			</p>
			
			<div id="autoresponderfield-mymail_post_published_advanced">
				<div id="autoresponder-taxonomies">
				<?php
				$taxes = $this->get_post_term_dropdown($autoresponderdata['post_type'], false, true, isset($autoresponderdata['terms']) ? $autoresponderdata['terms'] : array());
				if($taxes){
					echo sprintf(__('only if in %s', 'mymail'), $taxes);
				}
				?>
				</div>
				<p>
				<?php
					echo sprintf( _n('always skip %s release', 'always skip %s releases', $autoresponderdata['post_count'], 'mymail'), $count );
					?>
				</p>
			</div>
	 	</div>
	 	
	 	<div class="mymail_autoresponder_more autoresponderfield-mymail_autoresponder_timebased">
			<p>
			<?php
				$autoresponderdata['interval'] = isset($autoresponderdata['interval']) ? $autoresponderdata['interval'] : 1;
				$autoresponderdata['time_frame'] = isset($autoresponderdata['time_frame']) ? $autoresponderdata['time_frame'] : 'day';

				
				$timestamp = (isset($autoresponderdata['date']) && isset($autoresponderdata['time'])) ? strtotime($autoresponderdata['date'].' '.$autoresponderdata['time']) : current_time('timestamp');
				
				$interval = '<br><input type="text" name="mymail_data[autoresponder][interval]" class="small-text" value="'.$autoresponderdata['interval'].'">';
				$time_frame = '<select name="mymail_data[autoresponder][time_frame]">';
				$values = array(
					'hour' => __('hour(s)', 'mymail'),
					'day' => __('day(s)', 'mymail'),
					'week' => __('week(s)', 'mymail'),
					'month' => __('month(s)', 'mymail'),
				);
				foreach($values as $i => $value){
					$time_frame .= '<option value="'.$i.'"'.selected($autoresponderdata['time_frame'], $i, false).'>'.$value.'</option>';
				}
				$time_frame .= '</select>';
				echo sprintf( _x('create a new campaign every %1$s%2$s', 'every [x] [timeframe] starting [startdate]', 'mymail'), $interval, $time_frame );
			?>
			<?php
				echo '<h4>'.__('next schedule', 'mymail').'</h4>'.sprintf( _x('on %1$s @ %2$s','send campaign "on" (date) "at" (time)', 'mymail'),
		'<input name="mymail_data[autoresponder][date]" class="datepicker deliverydate inactive" type="text" value="'.date('Y-m-d', $timestamp).'" maxlength="10" readonly>',
		'<input name="mymail_data[autoresponder][time]" maxlength="5" class="deliverytime inactive" type="text" value="'.date('H:i', $timestamp).'"> UTC '.((get_option('gmt_offset') > 0) ? '+' : '').' '.get_option('gmt_offset'));

				$autoresponderdata['endschedule'] = isset($autoresponderdata['endschedule']) ? $autoresponderdata['endschedule'] : false;

			?>
			</p>
	 		<p>
				<label><input type="checkbox" name="mymail_data[autoresponder][endschedule]" class="mymail_autoresponder_timebased-end-schedule" <?php checked($autoresponderdata['endschedule']); ?> value="1"> <?php _e('end schedule', 'mymail'); ?></label>
				<div class="mymail_autoresponder_timebased-end-schedule-field" <?php if(!$autoresponderdata['endschedule']) echo ' style="display:none"';?>>
<?php
				$timestamp = max($timestamp, (isset($autoresponderdata['enddate']) && isset($autoresponderdata['endtime'])) ? strtotime($autoresponderdata['enddate'].' '.$autoresponderdata['endtime']) : $timestamp);
				
				echo sprintf( _x('on %1$s @ %2$s','send campaign "on" (date) "at" (time)', 'mymail'),
		'<input name="mymail_data[autoresponder][enddate]" class="datepicker deliverydate inactive" type="text" value="'.date('Y-m-d', $timestamp).'" maxlength="10" readonly>',
		'<input name="mymail_data[autoresponder][endtime]" maxlength="5" class="deliverytime inactive" type="text" value="'.date('H:i', $timestamp).'"> UTC '.((get_option('gmt_offset') > 0) ? '+' : '').' '.get_option('gmt_offset'));
				?>
				<span class="description"><?php _e('set an end date for your campaign', 'mymail'); ?></span>
				</div>
				
			</p>
			<p>
			<?php
				$autoresponderdata['weekdays'] = isset($autoresponderdata['weekdays']) ? $autoresponderdata['weekdays'] : array();
				
				global $wp_locale;
				
				echo __('send campaigns only on these weekdays', 'mymail').'<br>';
				$start_at = get_option('start_of_week');
				
				for($i = $start_at; $i < 7+$start_at; $i++){
					$j = $i;
					if(!isset($wp_locale->weekday[$j])) $j = $j-7;
					echo '<label title="'.$wp_locale->weekday[$j].'"><input name="mymail_data[autoresponder][weekdays][]" type="checkbox" value="'.$j.'" '.checked((in_array($j, $autoresponderdata['weekdays']) || !$autoresponderdata['weekdays']), true, false).'> '.substr($wp_locale->weekday[$j],0,2).'</label> ';
				}
			?>
			</p>
	 	</div>
	 	
	 	<div class="mymail_autoresponder_more autoresponderfield-mymail_post_published autoresponderfield-mymail_autoresponder_timebased">
	 			
	 			<p>
				<?php
					$issue = '<input type="text" id="mymail_autoresponder_issue" name="mymail_data[autoresponder][issue]" class="small-text" value="'.$autoresponderdata['issue'].'">';
					echo sprintf( __('Next issue: %s', 'mymail'), $issue );
				?>
				</p>
				<p class="description">
				<?php
					echo sprintf( __('Use the %s tag to display the current issue in the campaign', 'mymail'), '<code>{issue}</code>' );
				?>
				</p>
	 	</div>
	 	<div class="mymail_autoresponder_more autoresponderfield-mymail_post_published">
				<p class="description">
				<?php
					echo sprintf( _n('%1$s matching %2$s has been published', '%1$s matching %2$s have been published', $autoresponderdata['post_count_status'], 'mymail'), '<strong>'.$autoresponderdata['post_count_status'].'</strong>', '<strong><a href="edit.php?post_type='.$autoresponderdata['post_type'].'">'._n($pts[$autoresponderdata['post_type']]->labels->singular_name, $pts[$autoresponderdata['post_type']]->labels->name, $autoresponderdata['post_count_status']).'</a></strong>');
					?>
				<br><label><input type="checkbox" name="post_count_status_reset" value="1"> <?php _e('reset counter', 'mymail'); ?></label>
				</p>
				<input type="hidden" name="mymail_data[autoresponder][post_count_status]" value="<?php echo $autoresponderdata['post_count_status'] ?>">

	 	</div>
		
		<?php do_action('mymail_autoresponder_more') ?>
		
		
	</div>
	</div>
	</div>
<?php endif;?>
<p>
	<input type="text" value="<?php echo $current_user->user_email ?>" autocomplete="off" id="mymail_testmail" class="widefat">
	<button type="button" value="" class="button mymail_spamscore" title="<?php _e('check your spam score', 'mymail'); ?> (beta)">Spam Score <sub>beta</sub></button>
	<span class="spinner" id="delivery-ajax-loading"></span>
	<input type="button" value="<?php _e('Send Test', 'mymail') ?>" class="button mymail_sendtest">
	
	<div id="spam_score_progress">
	<div class="progress"><span class="bar" style="width:1%"></span></div>
	<div class="score"></div>
	</div>

	
</p>
	

<?php elseif ($post->post_status == 'active') : ?>
	<p>
	<?php echo sprintf( __('This campaign has been started on %1$s, %2$s ago', 'mymail'), '<br><strong>'.date(get_option('date_format').' '.get_option('time_format'), $this->post_data['timestamp']), human_time_diff(current_time('timestamp'), $this->post_data['timestamp']).'</strong>'); ?>
	</p>
<?php if($totalcount && $post->post_status != 'autoresponder') {
	$p = round($this->campaign_data['sent'] / $totalcount * 100);
?>
	<div class="progress"><span class="bar" style="width:<?php echo $p ?>%"></span><span>&nbsp;<?php echo sprintf(__('%1$s of %2$s sent', 'mymail'), $this->campaign_data['sent'], $totalcount)?></span><var><?php echo $p ?>%</var></div>
<?php } ?>
<?php elseif ($post->post_status == 'autoresponder') : ?>
	<p>
	<?php echo sprintf(__('You have to %s to change the delivery settings', 'mymail'), '<a href="post.php?post='.$post_id.'&action=edit">'.__('switch to the edit mode', 'mymail').'</a>'); ?>
	</p>
<?php endif;

	if(!empty($this->campaign_data['original_campaign'])) :
		$orig_id = intval($this->campaign_data['original_campaign']);
		if(current_user_can('edit_newsletter') && current_user_can('edit_others_newsletters', $orig_id)) :
	 ?>
			<p><?php echo sprintf(__('This campaign is based on an %s', 'mymail'), '<a href="post.php?post='.$orig_id.'&action=edit&showstats=1">'.__('auto responder campaign', 'mymail').'</a>'); ?>
			</p>
	<?php
		endif;
		
	endif;
?>
<input type="hidden" id="mymail_is_autoresponder" name="mymail_is_autoresponder" value="<?php echo $autoresponder?>">