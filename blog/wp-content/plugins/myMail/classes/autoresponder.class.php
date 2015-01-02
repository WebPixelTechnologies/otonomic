<?php if (!defined('ABSPATH')) die('not allowed');

class mymail_autoresponder {

	private $autoresponders = array();
	private $time_based_offset = 300;
	private $custom_tags = array();
	private $packageFeaturesList = array();
	
	public function __construct( ) {
	
		add_action('init', array( &$this, 'register_post_status'));
		
		$this->autoresponders = get_option('mymail_autoresponders', array());
		
		if(is_admin()){
			add_filter('mymail_autoresponder_condition_fields', array( &$this, 'autoresponder_condition_fields'));
			add_filter('user_has_cap', array( &$this, "user_has_cap"), 10 , 3);
			add_action('admin_menu', array( &$this, 'add_autoresponder_menu' ),1 );
			add_action('save_post', array( &$this, 'save_post'), 10, 2);
			add_filter("manage_edit-newsletter_columns", array( &$this, "columns"), 99);
			add_filter("manage_newsletter_posts_custom_column", array( &$this, "columns_content"));
			add_action('wp_loaded', array( &$this, 'edit_hook'));
			add_filter('post_row_actions', array( &$this, 'quick_edit_btns'), 10, 2);
		}
		
		add_action('mymail_autoresponder', array( &$this, 'autoresponder_callback' ), 10, 4);
		
		add_action('mymail_cron', array( &$this, 'time_based_autoresponder'));
		add_action('pre_get_posts', array( &$this, 'pre_get_posts'));
		
		foreach($this->autoresponders as $action => $campaign){
		
			if(in_array($action, array('mymail_subscriber_insert', 'mymail_subscriber_unsubscribed', 'mymail_post_published', 'mymail_site_created', 'mymail_site_upgraded'))){
				foreach($campaign as $campaign_id => $data){

					//register actions for all autoresponder
					add_action(isset($data['hook']) ? $data['hook'] : $data['action'], array( &$this, "addjob_".$campaign_id), 10, 10);

				}
				
			}else{

				//add_action($action, array( &$this, "addjob_".$campaign_id), 10, 10);
				
			}
			
		}
	}
	
	public function __call($name, $arguments) {
		
		$parts = explode('_', $name);
		$func = $parts[0];
		$campaign_id = $parts[1];
		
		if( method_exists( $this, $func ) )
			call_user_func_array( array( &$this, $func ), array( $campaign_id, $arguments ));
			
	}

	public function registerCustomTags() {
		foreach ($this->custom_tags as $ctag) {
			mymail_add_tag($ctag, array(&$this, 'customtag_'.$ctag));
		}
	}

	public function customtag_packageFeaturesList($tag = '', $fallback = '', $campaignID = NULL, $subscriberID = NULL) {

		global $psts;

		if (!$tag) {
			if (isset($this->packageFeaturesList[$this->custom_tags['siteId']])) {
				return $this->packageFeaturesList[$psts->get_level($this->custom_tags['siteId'])];
			} else {
				return '';
			}
		} else {
			$this->packageFeaturesList[$tag] = $fallback;
			return '';
		}
	}

	public function customtag($tag = '', $fallback = '', $campaignID = NULL, $subscriberID = NULL) {
		return isset($this->custom_tags[$tag]) ?
				$this->custom_tags[$tag] : '';
	}

	public function pre_get_posts( $query ) {
	
		if(!isset($query->query_vars['post_type']) || $query->query_vars['post_type'] != 'newsletter') return;
		
		if(!is_admin() && is_archive()){
			$query->set('post_status', array('active', 'finished'));
		}
	
	}

	public function time_based_autoresponder() {
		
		//check wich campaign needs time based action within the next hour
		
		$campaigns = mymail_get_autoresponder_campaigns();
		
		foreach($campaigns as $campaign){
			$data = get_post_meta($campaign->ID, 'mymail-data', true);
			
			if(!isset($data['autoresponder'])) continue;
			if(empty($data['active_autoresponder'])) continue;
			
			$autoresponder = $data['autoresponder'];
			$action = $autoresponder['action'];
			
			if(!in_array($action, array('mymail_autoresponder_timebased'))) continue;
			
			$starttime = strtotime($autoresponder['date'].' '.$autoresponder['time'])-(get_option('gmt_offset')*3600);
			
			//more than an hour in the future
			if($starttime-time() > 3600) continue;
			
			if(isset($autoresponder['endschedule']) && $autoresponder['endschedule']){
				$endtime = strtotime($autoresponder['enddate'].' '.$autoresponder['endtime'])-(get_option('gmt_offset')*3600);
				
				//endtime has passed
				if($endtime-time() < 0){
					
					//disable this autoresponder
					$data['active_autoresponder'] = false;
					$this->post_meta($campaign->ID, 'mymail-data', $data);
					mymail_notice(sprintf(__('Auto responder campaign %s has been finished and is deactivated!', 'mymail'), '<strong>"<a href="post.php?post='.$campaign->ID.'&action=edit">'.$campaign->post_title.'</a>"</strong>'), 'updated', false, 'autoresponder_'.$campaign_id);
					continue;

					
				}
				
			}
			
			switch($action){
				case 'mymail_autoresponder_timebased':
				
					$args = array(
						'campaign_id' => $campaign->ID,
						'action' => $autoresponder['action'],
						'args' => $this->time_based_offset,
						'try' => 1,
					);
					
					wp_schedule_single_event($starttime-$this->time_based_offset, 'mymail_autoresponder', $args);
					
					
				
				break;
				
			}
			
		}
		

	}

	public function addjob($campaign_id, $args) {

		global $mymail, $mymail_subscriber;
		$data = get_post_meta($campaign_id, 'mymail-data', true);
		
		if(!isset($data['autoresponder'])) return false;
		
		$autoresponder = $data['autoresponder'];
		
		$inlist = $valid = false;
		
		switch ($autoresponder['action']){

			case 'mymail_site_created':
			case 'mymail_site_upgraded':
			case 'mymail_site_deleted':

				//get subscriber
				$subscriber = get_post($args[1]);
				if(!$subscriber) return false;

				//get site
				$site = get_blog_details($args[0]);
				if (!$site) return false;

				// set up custom tags
				$this->custom_tags['siteId'] = $args[0];
				$this->custom_tags['siteName'] = $site['blogname'];
				$this->registerCustomTags();

				//get campaign
				$campaign = get_post($campaign_id);
				if(!$campaign) return false;

				if($campaign->post_status != 'autoresponder') return false;

				$campaigndata = get_post_meta($campaign_id, 'mymail-data', true);

				if(!$campaigndata['active_autoresponder']) return false;

				$success = $this->autoresponder_to_campaign(
					$campaign_id,
					$autoresponder['amount'] * $autoresponder['unit']
				);

				return $success;

			case 'mymail_post_published':
				
				$new_status = $args[0];
				$old_status = $args[1];
				$post = $args[2];
				
				if('publish' != $new_status) return false;
				if($autoresponder['post_type'] != $post->post_type) return false;
				if($new_status == $old_status || in_array($old_status, array('private'))) return false;
				
				if(isset($autoresponder['terms'])){
					
					$pass = true;
					
					foreach($autoresponder['terms'] as $taxonomy => $term_ids){
						//ignore "any taxonomy"
						if($term_ids[0] == '-1') continue;

						$post_terms = get_the_terms ( $post->ID, $taxonomy );
						
						//no post_terms set but required => give up
						if(!$post_terms) return false;
						
						$pass = $pass && !!count(array_intersect(wp_list_pluck($post_terms, 'term_id'), $term_ids));
						
						if(!$pass) return false;
						
					}
				}
				
				$autoresponder['post_count_status']++;
				
				//if post count is reached
				if(!($autoresponder['post_count_status']%($autoresponder['post_count']+1))){
					
					$success = $this->autoresponder_to_campaign($campaign_id, $autoresponder['amount']*$autoresponder['unit'], $autoresponder['issue']);
					
					if($success){
					
						$newCamp = get_post($success);
						mymail_notice(sprintf(__('New campaign %1$s has been created and is going to be sent in %2$s.', 'mymail'), '<strong>"<a href="post.php?post='.$newCamp->ID.'&action=edit">'.$newCamp->post_title.'</a>"</strong>', '<strong>'.human_time_diff(time()+$autoresponder['amount']*$autoresponder['unit']).'</strong>').' <a href="edit.php?post_type=newsletter&pause=' .$newCamp->ID. '&_wpnonce=' .wp_create_nonce('mymail_nonce'). '">'.__('Pause campaign', 'mymail').'</a>', 'error', true);
						$autoresponder['issue']++;
						
					}

				}else{
					
				}
				
					
				$data['autoresponder'] = $autoresponder;
				$this->post_meta($campaign_id, 'mymail-data', $data, true);
				
				
				break;
				
			case 'mymail_subscriber_unsubscribed':
			case 'mymail_subscriber_insert':
				
				//get subscriber
				$subscriber = get_post($args[0]);
				if(!$subscriber) return false;
				
				//get campaign
				$campaign = get_post($campaign_id);
				if(!$campaign) return false;
				
				if($campaign->post_status != 'autoresponder') return false;
				
				$campaigndata = get_post_meta($campaign_id, 'mymail-data', true);
				
				if(!$campaigndata['active_autoresponder']) return false;
				
				$userdata = get_post_meta($subscriber->ID, 'mymail-userdata', true);
				$userdata['email'] = $subscriber->post_title;
					
				//check if in lists
				$subscriber_lists = wp_get_post_terms($subscriber->ID, 'newsletter_lists', array( 'fields' => 'ids' ));
				$campaign_lists = wp_get_post_terms($campaign->ID, 'newsletter_lists', array( 'fields' => 'ids' ));
				
				foreach($campaign_lists as $list){
					if(in_array($list, $subscriber_lists)){
						$inlist = true;
						break;
					}
				}
				
				//stop if not in list
				if(!$inlist) return false;
				
				if(isset($autoresponder['advanced'])){
					
					$bool = array();
					
					foreach($autoresponder['conditions'] as $condition){
					
						switch($condition['operator']){
							case 'is':
								$bool[] = $userdata[$condition['field']] == $condition['value'];
								break;
							case 'is_not':
								$bool[] = $userdata[$condition['field']] != $condition['value'];
								break;
							case 'contains':
								$bool[] = strpos($userdata[$condition['field']], $condition['value']) !== false;
								break;
							case 'contains_not':
								$bool[] = strpos($userdata[$condition['field']], $condition['value']) === false;
								break;
							case 'begin_with':
								$bool[] = strpos($userdata[$condition['field']], $condition['value']) === 0;
								break;
							case 'end_with':
								$bool[] = !!preg_match('#'.$condition['value'].'$#', $userdata[$condition['field']]);
								break;
							case 'is_less':
								$bool[] = $userdata[$condition['field']] < $condition['value'];
								break;
							case 'is_more':
								$bool[] = $userdata[$condition['field']] > $condition['value'];
								break;
						}
					}
					
					if($autoresponder['operator'] == 'AND'){
						$valid = !in_array(false, $bool);
					}else if($autoresponder['operator'] == 'OR'){
						$valid = in_array(true, $bool);
					}
					
				}else{
					$valid = true;
				}
				
				break;
				
			default:
			
				$inlist = $valid = true;
		}
		
		//add only if valid and in list
		if($valid && $inlist){
					
			$triggertime = ($autoresponder['amount']*$autoresponder['unit'])+time();
			
			if(isset($userdata['_meta'])){
				
				if(isset($userdata['_meta']['confirmtime'])){
				
					$triggertime = ($autoresponder['amount']*$autoresponder['unit'])+$userdata['_meta']['confirmtime']-(get_option('gmt_offset')*3600);
					
				}else if(isset($userdata['_meta']['signuptime'])){
				
					$triggertime = ($autoresponder['amount']*$autoresponder['unit'])+$userdata['_meta']['signuptime']-(get_option('gmt_offset')*3600);
					
				}
			}
			
			//two secondes for script execution
//			if($triggertime-time() < -2) return false;
			
			//reset userdate for this campaign
			if (!empty($subscriber)) {
				$user_campaigndata = get_post_meta($subscriber->ID, 'mymail-campaigns', true);
				if(isset($user_campaigndata[$campaign_id])){

					unset($user_campaigndata[$campaign_id]);
					$this->post_meta($subscriber->ID, 'mymail-campaigns', $user_campaigndata);

				}
			}

			$args = array(
				'campaign_id' => $campaign_id,
				'action' => $autoresponder['action'],
				'args' => $args,
				'try' => 1,
				'triggertime' => $triggertime,
			);
			
			wp_schedule_single_event($triggertime, 'mymail_autoresponder', $args);
			
		}
				
	}

	public function autoresponder_callback($campaign_id, $action, $args, $try = 1) {
	
		$data = get_post_meta($campaign_id, 'mymail-data', true);
		
		$success = true;
		
		if(isset($data['active_autoresponder']) && $data['active_autoresponder']) {
		
			$success = false;
			
			switch ($action){
				case 'mymail_subscriber_unsubscribed':
					$success = mymail_send_campaign_to_subscriber($campaign_id, $args[0], true, true);
					//pause
					if(mymail_option('send_delay')) usleep(mymail_option('send_delay'));
					break;
				case 'mymail_subscriber_insert':
					$success = mymail_send_campaign_to_subscriber($campaign_id, $args[0], true, false);
				//pause
				if(mymail_option('send_delay')) usleep(mymail_option('send_delay'));
					break;
				case 'mymail_autoresponder_timebased':
					
					if($ID = $this->autoresponder_to_campaign($campaign_id, $args, $data['autoresponder']['issue']++)){
					
						$starttime = strtotime($data['autoresponder']['date'].' '.$data['autoresponder']['time']);
						
						$nextdate = $this->get_next_date($starttime, $data['autoresponder']['interval'], $data['autoresponder']['time_frame'], $data['autoresponder']['weekdays']);
						$data['autoresponder']['timestamp'] = $nextdate;
						
						$data['autoresponder']['date'] = date('Y-m-d', $nextdate);
						$data['autoresponder']['time'] = date('H:i', $nextdate);
						
						$this->post_meta($campaign_id, 'mymail-data', $data, true);
						
						$newCamp = get_post($ID);
						
						mymail_notice(sprintf(__('New campaign %s has been created!', 'mymail'), '<strong>"<a href="post.php?post='.$newCamp->ID.'&action=edit">'.$newCamp->post_title.'</a>"</strong>'), 'error', true, 'autoresponder_'.$campaign_id);
						
						$this->time_based_autoresponder();
						
						do_action('mymail_autoresponder_timebased', $ID);
						
						return true;

						
					}
					
					return false;
						
					break;
				
				default:
					$success = true;


			}
			
			
		}
		
		if ( is_wp_error($success) ) {
		
				//change status to error if email is invalid
			if($success->get_error_code() === 'invalid_email')
				$this->change_status(get_post($args[0]), 'error');
			
		
		}else if(!$success){
		
			//send limit reached
			if(!(mymail_option('send_limit')-get_transient('_mymail_send_period'))){
			
				//try again after limit has been reseted
				$time = get_option('_transient_timeout__mymail_send_period_timeout', time()+60);
				
			//must be a send error
			}else{
				//try again in 60 seconds;
				$time = time()+60;
				$try++;
			}
			
			wp_schedule_single_event($time, 'mymail_autoresponder', array(
				'campaign_id' => $campaign_id,
				'action' => $action,
				'args' => $args,
				'try' => $try,
			));
				
				
		}
		
		return $success;
		
	}
	
	private function get_next_date($starttime, $interval, $time_frame, $weekdays) {
		
							//eg +3 weeks
		$nextdate = strtotime('+'.$interval.' '.$time_frame, $starttime);
		
		if(count($weekdays) < 7 && count($weekdays)){
			
			$dayofweek = date('w', $nextdate);
			
			while(!in_array($dayofweek, $weekdays)){

				//try next day
				$nextdate = strtotime('+1 day', $nextdate);
				$dayofweek = date('w', $nextdate);

			}
			
		}
		
		return $nextdate;
		
	}
	
	public function add_autoresponder_menu() {
		if(!current_user_can('edit_newsletters')) return;
		global $submenu;
		$submenu['edit.php?post_type=newsletter'][11] = array(
			__('Autoresponder', 'mymail'),
			'mymail_edit_autoresponders',
			'edit.php?post_status=autoresponder&post_type=newsletter',
		);
		ksort($submenu['edit.php?post_type=newsletter']);
		
	}
	
	public function autoresponder_condition_fields($fields) {
		
		if ($customfield = mymail_option('custom_field')) {
			foreach ($customfield as $field => $data) {
				$fields[$field] = $data['name'];
			}
		}
		return $fields;
	}
	
	public function user_has_cap($capabilities, $cap, $name) {
		global $post;
		if(!$post) return $capabilities;
		
		if($post->post_status == 'autoresponder' && $post->post_type == 'newsletter'){
			if(isset($cap[0])){
				if('edit_newsletter' == $cap[0]){ 
					$capabilities['edit_newsletter'] = current_user_can('mymail_edit_autoresponder');
				}
				if('edit_others_newsletters' == $cap[0]){ 
					$capabilities['edit_others_newsletters'] = current_user_can('mymail_edit_others_autoresponders');
				}
			}
		}
		return $capabilities;
	}
	
	public function register_post_status() {
		if(!is_admin() || current_user_can('mymail_edit_autoresponders'))
			register_post_status('autoresponder', array(
					'label' => __('Autoresponder', 'mymail'),
					'public' => !is_admin(),
					'exclude_from_search' => true,
					'show_in_admin_all_list' => false,
					'label_count' => _n_noop(__('Autoresponder', 'mymail') . ' <span class="count">(%s)</span>', __('Autoresponders', 'mymail') . ' <span class="count">(%s)</span>')
			));
	}
	
	
	public function columns($columns) {
		
		global $wp_query;
		if(!isset($wp_query->query['post_status']) || $wp_query->query['post_status'] != 'autoresponder') return $columns;
		
		$columns['total'] = __('Sent', 'mymail');
		
		return $columns;
		
	}


	public function columns_content($column) {
	
		global $post, $wpdb;
		
		if($post->post_status != 'autoresponder') return $column;

		$campaign = get_post_meta($post->ID, 'mymail-campaign', true);
		$data = get_post_meta($post->ID, 'mymail-data', true);
		
		$specialcamp = !in_array($data['autoresponder']['action'], array('mymail_subscriber_insert', 'mymail_subscriber_unsubscribed')) && false;
		
		switch ($column) {

			case "status":
		
				$active = isset($data['active_autoresponder']) && $data['active_autoresponder'] ? 'active' : 'inactive';
				$is_active = $active == 'active';
				
				include(MYMAIL_DIR.'/includes/autoresponder.php');
			
				echo '<span class="mymail-icon '.$active.'"></span> '.($is_active ? __('active', 'mymail') : __('inactive', 'mymail')).'<br>';
				
				echo '<span class="autoresponder-'.$active.'">';
				
				$autoresponder = $data['autoresponder'];
				
				if(!in_array($autoresponder['action'], array('mymail_autoresponder_timebased'))){

					echo sprintf(__('send %1$s %2$s %3$s', 'mymail'), ($autoresponder['amount'] ? '<strong>'.$autoresponder['amount'].'</strong> '.$mymail_autoresponder_info['units'][$autoresponder['unit']] : __('immediately', 'mymail')), __('after', 'mymail'), ' <strong>'.$mymail_autoresponder_info['actions'][$autoresponder['action']]['label'].'</strong>');
					
				}else{
				
					$time_frame_names = array(
						'hour' => __('hour(s)', 'mymail'),
						'day' => __('day(s)', 'mymail'),
						'week' => __('week(s)', 'mymail'),
						'month' => __('month(s)', 'mymail'),
					);

					echo sprintf(__('send every %1$s %2$s', 'mymail'), '<strong>'.$autoresponder['interval'].'</strong>', '<strong>'.$time_frame_names[$autoresponder['time_frame']].'</strong>');
					echo '<br>'.sprintf(__('next campaign in %s', 'mymail'), '<strong title="'.date(get_option('date_format').' '.get_option('time_format'), $autoresponder['timestamp']).'">'.human_time_diff($autoresponder['timestamp'], current_time('timestamp')).'</strong>');
					
					if(isset($autoresponder['endtimestamp']))
						echo '<br>'.sprintf(__('until %s', 'mymail'), ' <strong>'.date(get_option('date_format').' '.get_option('time_format'), $autoresponder['endtimestamp']).'</strong>');
					if(count($autoresponder['weekdays']) < 7){
						global $wp_locale;
						$start_at = get_option('start_of_week');
						$days = array();
						for($i = $start_at; $i < 7+$start_at; $i++){
							$j = $i;
							if(!isset($wp_locale->weekday[$j])) $j = $j-7;
							if(in_array($j, $autoresponder['weekdays'])) $days[] = '<span title="'.$wp_locale->weekday[$j].'">'.substr($wp_locale->weekday[$j],0,2).'</span>';
						}

						echo '<br>'.sprintf(_x('only on %s', 'only one [weekdays]', 'mymail'), ' <strong>'.implode(', ', $days).'</strong>');
					}
					
				}
				
				$lists = wp_get_post_terms($post->ID, 'newsletter_lists', array("fields" => "names"));
				
				echo (!empty($lists))
					? '<br>'.(!$specialcamp ? __('in one of these lists', 'mymail') : __('Lists', 'mymail')).':<br><strong>'.implode('</strong>, <strong>', $lists).'</strong>'
					: '<br><span class="mymail-icon warning"></span> '.__('no lists selected', 'mymail');
					
				
				if(isset($autoresponder['advanced'])){
					$fields = apply_filters('mymail_autoresponder_condition_fields', array(
						'email' => mymail_text('email'),
						'firstname' => mymail_text('firstname'),
						'lastname' => mymail_text('lastname'),
					));
					
					echo '<br>'.__('only if', 'mymail').'<br>';
					
					$conditions = array();
					
					foreach($autoresponder['conditions'] as $condition){
						if(!isset($fields[$condition['field']])){
							echo '<span class="mymail-icon warning"></span> '.sprintf(__('%s is missing!', 'mymail'), '"'.$condition['field'].'"').'<br>';
							continue;
						}
						$conditions[] = '<strong>'.$fields[$condition['field']].'</strong> '.$mymail_autoresponder_info['operators'][$condition['operator']].' "<strong>'.$condition['value'].'</strong>"';
					}
					
					echo implode('<br>'.__(strtolower($autoresponder['operator']), 'mymail').' ', $conditions);
						
				}
				echo '</span>';
						
				
				if ( (current_user_can('mymail_edit_autoresponders') && (get_current_user_id() == $post->post_author || current_user_can('mymail_edit_others_autoresponders') ) ) ) {
					$jobs = $this->get_job_count( $post->ID );
					echo '<div class="row-actions">';
					$actions = array();
						if ($active != 'active') {
							$actions['activate'] = '<a class="start" href="?post_type=newsletter&activate=' . $post->ID . (isset($_REQUEST['post_status']) ? '&post_status='.$_REQUEST['post_status'] : '' ) . '&_wpnonce=' . wp_create_nonce('mymail_nonce') . '" title="' . __('activate', 'mymail') . '">' . __('activate', 'mymail') . '</a>&nbsp;';
						} else {
							$actions['deactivate'] = '<a class="start" href="?post_type=newsletter&deactivate=' . $post->ID . (isset($_REQUEST['post_status']) ? '&post_status='.$_REQUEST['post_status'] : '' ) . '&_wpnonce=' . wp_create_nonce('mymail_nonce') . '" title="' . __('deactivate', 'mymail') . '">' . __('deactivate', 'mymail') . '</a>&nbsp;';
						}
						if($jobs && !in_array($autoresponder['action'], array('mymail_autoresponder_timebased')))
							$actions['flushjobs'] = '<a class="start" onclick="return confirm(\''.esc_html(__('You are about to delete all upcoming jobs for this auto responder.', 'mymail')).'\');" href="?post_type=newsletter&flushjobs=' . $post->ID . (isset($_REQUEST['post_status']) ? '&post_status='.$_REQUEST['post_status'] : '' ) . '&_wpnonce=' . wp_create_nonce('mymail_nonce') . '" title="' . __('remove all future jobs', 'mymail') . '">' . sprintf( _n( 'remove %d upcoming job', 'remove %d upcoming jobs', $jobs, 'mymail'), $jobs) . '</a>&nbsp;';
					echo implode(' | ', $actions);
					echo '</div>';
				}
			
			break;
			
		case "total":
			echo (!empty($campaign) && !$specialcamp) ? number_format_i18n($campaign['sent']) : '&ndash;';
			
			if(!empty($campaign['errors'])) echo '&nbsp;<a href="edit.php?post_status=error&post_type=subscriber" class="errors" title="'.sprintf(__('%d emails have not been sent', 'mymail'), count($campaign['errors'])).'">(+'.count($campaign['errors']).')</a>';
			break;
		case "open":
			if (isset($campaign['opens']) && !$specialcamp) {
				$opens = $campaign['opens'];
				$sent = max($opens, $campaign['sent']);
				echo number_format_i18n($opens) . '/<span class="tiny">' . number_format_i18n($sent) . '</span>';
				echo "<br><span title='" . __('open rate', 'mymail') . "' class='nonessential' style='padding:0;'>";
				echo ($opens && $sent) ? ' (' . (round($opens / $sent * 100, 2)) . '%)' : ' (0%)';
				echo "</span>";
			} else {
				echo '&ndash;';
			}
			break;

		case "click":
			if (isset($campaign['totaluniqueclicks']) && !$specialcamp) {
				$clicks = $campaign['totaluniqueclicks'];
				$opens = max($clicks, $campaign['opens']);
				echo number_format_i18n($clicks);
				echo "<br><span title='" . __('click rate', 'mymail') . "' class='nonessential' style='padding:0;'>";
				echo ($clicks && $opens) ? ' (' . (round($clicks / $opens * 100, 2)) . '%)' : ' (0%)';
				echo "</span>";
			} else {
				echo '&ndash;';
			}
			break;

		case "unsubs":
			if (isset($campaign['unsubscribes']) && !$specialcamp) {
				$unsubscribes = $campaign['unsubscribes'];
				$opens = max($unsubscribes, $campaign['opens']);
				echo number_format_i18n($unsubscribes);
				echo "<br><span title='" . __('unsubscribe rate', 'mymail') . "' class='nonessential' style='padding:0;'>";
				echo ($unsubscribes && $opens) ? ' (' . (round($unsubscribes / $opens * 100, 2)) . '%)' : ' (0%)';
				echo "</span>";
			} else {
				echo '&ndash;';
			}
			break;

		case "bounces":
			if (isset($campaign['hardbounces']) && !$specialcamp) {
				$bounces = $campaign['hardbounces'];
				$sent = max($bounces, $campaign['sent']);
				echo number_format_i18n($bounces);
				echo "<br><span title='" . __('bounce rate', 'mymail') . "' class='nonessential' style='padding:0;'>";
				echo ($bounces) ? ' (' . (round($bounces / ($sent+$bounces) * 100, 2)) . '%)' : ' (0%)';
				echo "</span>";
			} else {
				echo '&ndash;';
			}
			break;

		}
	}
	
	public function quick_edit_btns($actions, $post) {
		if ($post->post_type != 'newsletter' || $post->post_status != 'autoresponder')
			return $actions;
		
		$post_data = get_post_meta($post->ID, 'mymail-data', true);
		
		$actions['statistics'] = '<a class="statistics" href="post.php?post='.$post->ID.'&action=edit&showstats=1" title="' . sprintf( __('See stats of Campaign %s', 'mymail'), '“'.$post->post_title.'”' ) . '">' . __('Statistics', 'mymail') . '</a>';
			
		return $actions;
	}
	
	
	public function save_post($post_id, $post) {

		if (isset($_POST['mymail_data']) && $post->post_type == 'newsletter') {
		
			$is_autoresponder = !!$_POST['mymail_is_autoresponder'];
			
			if($is_autoresponder){
				
				$save = get_post_meta($post_id, 'mymail-data', true);
			
				$currenttime = current_time('timestamp');

				$save['active'] = false;
				$save['active_autoresponder'] = isset($_POST['mymail_data']['active_autoresponder']) && current_user_can('publish_newsletters');
				
				if ($post->post_status != 'autoresponder') {
					$this->change_status($post, 'autoresponder');
				}
				
				if (isset($_POST['mymail_data']['autoresponder'])){
				
					if(!isset($save['autoresponder'])) $save['autoresponder'] = array('post_type' => NULL);
					
					if(isset($_POST['mymail_data']['autoresponder']['post_type']) &&
					$_POST['mymail_data']['autoresponder']['post_type'] != $save['autoresponder']['post_type']) $_POST['post_count_status_reset'] = 1;

					$save['autoresponder'] = $_POST['mymail_data']['autoresponder'];
					
					$save['autoresponder']['amount'] = max(0, floatval($save['autoresponder']['amount']));
					
					if(isset($save['autoresponder']['terms'])){
						
						foreach($save['autoresponder']['terms'] as $taxonomy => $term_ids){
							$save['autoresponder']['terms'][$taxonomy] = array_unique($term_ids);
							if(in_array('-1', $term_ids)) $save['autoresponder']['terms'][$taxonomy] = array('-1');
						}
						
					}
					
					if(in_array($save['autoresponder']['action'], array('mymail_subscriber_insert', 'mymail_subscriber_unsubscribed'))){
						if(isset($save['autoresponder']['terms'])) unset($save['autoresponder']['terms']);
						if(isset($_POST['mymail_data']['list_conditions'])){
							unset($_POST['mymail_data']['list_conditions']);
							mymail_notice('<strong>'.__('List conditions are ignored in subscriber based autoresponders!', 'mymail').'</strong>', 'error', true);
						}
					}else{
						unset($save['autoresponder']['advanced']);
						unset($save['autoresponder']['operator']);
						unset($save['autoresponder']['conditions']);
					}
					
					if(in_array($save['autoresponder']['action'], array('mymail_autoresponder_timebased'))){
						
						$save['autoresponder']['interval'] = max(1, intval($save['autoresponder']['interval']));
					
						$save['autoresponder']['timestamp'] = max($currenttime+$this-time_based_offset, strtotime($save['autoresponder']['date'] . ' ' . $save['autoresponder']['time']));
						
						$save['autoresponder']['weekdays'] = (isset($save['autoresponder']['weekdays']) ? $save['autoresponder']['weekdays'] : array(date('w', $save['autoresponder']['timestamp'])));
						
						$save['autoresponder']['timestamp'] = $this->get_next_date($save['autoresponder']['timestamp'], 0, $save['autoresponder']['time_frame'], $save['autoresponder']['weekdays']);

						$save['autoresponder']['date'] = date('Y-m-d', $save['autoresponder']['timestamp']);
						$save['autoresponder']['time'] = date('H:i', $save['autoresponder']['timestamp']);
						
						if(isset($save['autoresponder']['endschedule']) && $save['autoresponder']['endschedule']){
							$save['autoresponder']['endtimestamp'] = max($save['autoresponder']['timestamp'], strtotime($save['autoresponder']['enddate'] . ' ' . $save['autoresponder']['endtime']));
							
							$save['autoresponder']['enddate'] = date('Y-m-d', $save['autoresponder']['endtimestamp']);
							$save['autoresponder']['endtime'] = date('H:i', $save['autoresponder']['endtimestamp']);
						}
						$this->flushjobs_autoresponder($post_id, true);
						$this->time_based_autoresponder();
						
					}else{
					}
					
					if(isset($_POST['post_count_status_reset'])) $save['autoresponder']['post_count_status'] = 0;
					
				}

				$this->post_meta($post_id, 'mymail-data', $save, true);
				
				$save['active_autoresponder'] ? $this->add($post) : $this->remove($post);
		
				
			}
		}
	}
	
	
	public function add($post) {
	
		$data = get_post_meta($post->ID, 'mymail-data', true);
		
		$autoresponder = $data['autoresponder'];
		
		if(!isset($autoresponder['advanced'])){
			unset($autoresponder['operator']);
			unset($autoresponder['conditions']);
		}
		
		include(MYMAIL_DIR.'/includes/autoresponder.php');
		
		$autoresponder['hook'] = $mymail_autoresponder_info['actions'][$autoresponder['action']]['hook'];
		
		if(!isset($this->autoresponders[$autoresponder['action']])) $this->autoresponders[$autoresponder['action']] = array();
		
		$this->autoresponders[$autoresponder['action']][$post->ID] = $autoresponder;
		
		update_option('mymail_autoresponders', $this->autoresponders);
	}
	
	public function remove($post) {
	
		$data = get_post_meta($post->ID, 'mymail-data', true);
		
		$autoresponder = $data['autoresponder'];
		
		if(isset($this->autoresponders[$autoresponder['action']][$post->ID])) unset($this->autoresponders[$autoresponder['action']][$post->ID]);
		
		if(empty($this->autoresponders[$autoresponder['action']])) unset($this->autoresponders[$autoresponder['action']]);
		
		update_option('mymail_autoresponders', $this->autoresponders);
	}
	
	
	public function edit_hook() {
		if (isset($_REQUEST['post_type']) && 'newsletter' == $_REQUEST['post_type']) {
		
				//activate campaign
			if (isset($_REQUEST['activate'])) {
				if (wp_verify_nonce($_REQUEST['_wpnonce'], 'mymail_nonce')) {
					if ($id = $this->activate_autoresponder(intval($_REQUEST['activate']))) {
						$status = (isset($_REQUEST['post_status'])) ? '&post_status='.$_REQUEST['post_status'] : '';
						(isset($_REQUEST['edit'])) ? wp_redirect('post.php?post=' . $id . '&action=edit') : wp_redirect('edit.php?post_type=newsletter'.$status);
					}
				}

				//deactivate campaign
			} else if (isset($_REQUEST['deactivate'])) {
				if (wp_verify_nonce($_REQUEST['_wpnonce'], 'mymail_nonce')) {
					if ($id = $this->deactivate_autoresponder(intval($_REQUEST['deactivate']))) {
						$status = (isset($_REQUEST['post_status'])) ? '&post_status='.$_REQUEST['post_status'] : '';
						(isset($_REQUEST['edit'])) ? wp_redirect('post.php?post=' . $id . '&action=edit') : wp_redirect('edit.php?post_type=newsletter'.$status);
					}
				}

			} else if (isset($_REQUEST['flushjobs'])) {
				if (wp_verify_nonce($_REQUEST['_wpnonce'], 'mymail_nonce')) {
					if ($id = $this->flushjobs_autoresponder(intval($_REQUEST['flushjobs']))) {
						$status = (isset($_REQUEST['post_status'])) ? '&post_status='.$_REQUEST['post_status'] : '';
						(isset($_REQUEST['edit'])) ? wp_redirect('post.php?post=' . $id . '&action=edit') : wp_redirect('edit.php?post_type=newsletter'.$status);
					}
				}

			}


		}
	}
	
	public function change_status($post, $new_status, $silent = false) {
		if (!$post)
			return false;

		if ($post->post_status == $new_status)
			return true;

		$old_status = $post->post_status;

		global $wpdb;

		if ($wpdb->update($wpdb->posts, array('post_status' => $new_status), array('ID' => $post->ID))) {
			if (!$silent) wp_transition_post_status($new_status, $old_status, $post);
			return true;
		}

		return false;

	}
	
	
	private function activate_autoresponder($id) {
		$post = get_post($id);
		$post_meta = get_post_meta($id, 'mymail-data', true);
		$post_meta['active_autoresponder'] = true;
		$this->add($post);
		
		if($this->post_meta($id, 'mymail-data', $post_meta, true)){
			$this->time_based_autoresponder();
			return true;
		};
		
		return false;
	}
	
	private function deactivate_autoresponder($id) {
		$post = get_post($id);
		$post_meta = get_post_meta($id, 'mymail-data', true);
		$post_meta['active_autoresponder'] = false;
		$this->remove($post);
		
		if($this->post_meta($id, 'mymail-data', $post_meta, true)){
			//$this->flushjobs_autoresponder($id);
			$this->time_based_autoresponder();
			return true;
		};
		
		return false;
	}
	
	private function flushjobs_autoresponder($id, $silence = false) {
	
		$crons = get_option('cron');
		
		$count = 0;
		
		foreach($crons as $timestamp => $hook){
			if(!is_array($hook)) continue;
			foreach($hook as $hash => $args){
				if($hash == 'mymail_autoresponder'){
					foreach($args as $job){
						if(isset($job['args']['campaign_id']) && $job['args']['campaign_id'] == $id){
							$count++;
						}
						unset($crons[$timestamp]);
					}
				}
			}
		}
		
		update_option('cron', $crons);
		
		if(!$silence && $count) mymail_notice(sprintf(_n( '%d job deleted', '%d jobs deleted', $count, 'mymail'), $count), NULL, true, 'autorespond-deleted');
		
		return true;
	}
	
	private function autoresponder_to_campaign($id, $timeoffset, $issue = '') {
		$post = get_post($id);
		if($post->post_status != 'autoresponder') return false;
		$id = $post->ID;
		
		$lists = wp_get_post_terms($post->ID, 'newsletter_lists', array("fields" => "slugs"));
		$meta = get_post_meta($post->ID, 'mymail-data', true);
		$meta['active_autoresponder'] = $meta['autoresponder'] = $meta['date'] = $meta['time'] = $meta['timestamp'] = NULL;
		
		$meta['active'] = true;
		$currenttime = current_time('timestamp');

		$meta['timestamp'] = max($currenttime, $currenttime+$timeoffset);

		$meta['date'] = date('Y-m-d', $meta['timestamp']);
		$meta['time'] = date('H:i', $meta['timestamp']);
		
		unset($post->ID);
		unset($post->guid);
		unset($post->post_name);
		unset($post->post_date);
		unset($post->post_date_gmt);
		unset($post->post_modified);
		unset($post->post_modified_gmt);
		
		$post->post_status = 'queued';
		
		//set "issue"
		$post->post_title = str_replace('{issue}', $issue, $post->post_title);
		$meta = str_replace('{issue}', $issue, $meta);
		
		require_once MYMAIL_DIR . '/classes/placeholder.class.php';
			
		//$placeholder = new mymail_placeholder($meta['subject']);
		//$meta['subject']
		
		$placeholder = new mymail_placeholder($post->post_content);

		$placeholder->clear_placeholder();
		$post->post_content = $placeholder->get_content(false, array('issue' => $issue), true);
		
		//remove the KSES filter which strips "unwanted" tags and attributes
		remove_filter('content_save_pre', 'wp_filter_post_kses');

		$newID = wp_insert_post($post);
		
		if ($newID) {
		
			$campaign_data = get_post_meta($post->ID, 'mymail-campaign', true);
			
			$campaign_data = wp_parse_args(array(
					'total' => 0,
					'sent' => 0,
					'opens' => 0,
					'totalclicks' => 0,
					'totaluniqueclicks' => 0,
					'clicks' => array(),
					'hardbounces' => 0,
					'unsubscribes' => 0,
					'countries' => array(),
					'cities' => array(),
					'errors' => array(),
					'timestamp' => NULL
				), $campaign_data
			);
			
			$campaign_data['original_campaign'] = $id;
		
			$this->post_meta($newID, 'mymail-data', $meta);
			$this->post_meta($newID, 'mymail-campaign', $campaign_data);
			wp_set_object_terms($newID, $lists, 'newsletter_lists');
			
			return $newID;
		}
		
		return false;
	}
	
	private function get_job_count($id) {
	
		$crons = get_option('cron');
		
		$count = 0;
		
		foreach($crons as $timestamp => $hook){
			if(!is_array($hook)) continue;
			foreach($hook as $hash => $args){
				if($hash == 'mymail_autoresponder'){
					foreach($args as $job){
						if(isset($job['args']['campaign_id']) && $job['args']['campaign_id'] == $id){
							$count++;
						}
					}
				}
			}
		}
		
		return $count;
		
	}
	
	private function post_meta($post_id, $meta_key, $data, $unique = false) {
		return update_post_meta($post_id, $meta_key, $data);
		
		//old
		$meta_value = get_post_meta($post_id, $meta_key, true);

		/* If a new meta value was added and there was no previous value, add it. */
		if ($data && '' == $meta_value) {
			return add_post_meta($post_id, $meta_key, $data, true);
			/* If the new meta value does not match the old value, update it. */
		} elseif ($data && $data != $meta_value) {
			return update_post_meta($post_id, $meta_key, $data);
			/* If there is no new meta value but an old value exists, delete it. */
		} elseif ('' == $data && $meta_value) {
			return delete_post_meta($post_id, $meta_key, $meta_value);
		}
	}


}


?>