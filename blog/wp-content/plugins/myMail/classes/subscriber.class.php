<?php if (!defined('ABSPATH')) die('not allowed');


class mymail_subscriber {


	private $user_data;
	private $campaign_data;


	public function __construct() {
		
		register_activation_hook  ( MYMAIL_DIR.'/myMail.php', array( &$this, 'activate' ) );

		add_action('init', array( &$this, 'register_post_type' ), 1 );
		add_action('init', array( &$this, 'register_post_status' ), 1 );
		add_action('init', array( &$this, 'setup' ), 1 );

	}


	public function clear_counts() {
		delete_option('mymail_subscribers_count');
	}


	public function setup() {
	
		
		if(mymail_option('register_other') && mymail_option('register_other_lists')){
			add_action('user_register' , array( &$this, 'user_register' ) );
		}
		
		if(mymail_option('register_signup') && mymail_option('register_signup_lists')){
			add_action('user_register' , array( &$this, 'user_register' ) );
			add_action('register_form' , array( &$this, 'register_form' ) );
		}
		
		if(mymail_option('register_comment_form') && mymail_option('register_comment_form_lists')){
			add_action('comment_form_logged_in_after' , array( &$this, 'comment_form_checkbox' ) );
			add_action('comment_form_after_fields' , array( &$this, 'comment_form_checkbox' ) );
			add_action('comment_post' , array( &$this, 'comment_post' ), 10, 2 );
		}
		
		if(mymail_option('subscriber_notification') && mymail_option('subscriber_notification_receviers')){
			add_action('mymail_subscriber_insert', array( &$this, 'subscriber_notification' ) );
		}
		
		if (is_admin()) {

			add_action( 'admin_menu', array( &$this, 'remove_meta_boxs' ) );
			add_filter( 'post_updated_messages', array( &$this, 'updated_messages' ) );
			add_action( 'save_post', array( &$this, 'save_post'), 10, 2 );
			add_filter( 'wp_insert_post_data', array( &$this, 'wp_insert_post_data' ), 99, 2 );
			
			global $pagenow;
			
			if ( 'edit.php' == $pagenow ) {
			
				add_action( 'wp_loaded', array( &$this, 'edit_hook' ) );
				add_action( 'admin_notices', array( &$this, 'admin_notices' ) );

			} else if ( 'post-new.php' == $pagenow ) {
			
				add_action( 'wp_loaded', array( &$this, 'post_new_hook' ) );

			} else if ( 'post.php' == $pagenow ) {
				add_action( 'pre_get_posts', array( &$this, 'post_hook' ) );
				
			} else if ( 'edit-tags.php' == $pagenow ) {
			
				add_action( 'wp_tag_cloud', array( &$this, 'tag_cloud' ), 10, 2 );
				
			}

			//for deleteing large lists highjack this
			add_action( 'check_ajax_referer',  array( &$this, 'check_ajax_referer' ), 10, 2);
			//ajax is everywhere!
			$this->ajax();

		}else {

			add_action("template_redirect", array( &$this, 'front_page'), 1);

		}
		
	}


	public function front_page( ) {
	
		global $post;
		
		if (isset($_GET['confirm'])) {
			if (isset($_GET['k'])) {

				if(mymail_option('homepage') == $post->ID){
					$confirms = get_option( 'mymail_confirms' );
					$data = isset($confirms[$_GET['k']]) ? $confirms[$_GET['k']]: NULL;
					$success = false;
					$form_id = isset($_GET['f']) ? intval($_GET['f']) : 0;

					$target = add_query_arg(array(
							'subscribe' => 1
						), get_permalink( mymail_option('homepage') ));
						
					if ($data) {
	
						$userdata = $data['userdata'];
						$lists = $data['lists'];
						
						$result = $this->insert($userdata['email'], 'subscribed', $userdata, $lists, true, true, NULL, $form_id);
	
						if (is_wp_error( $result )) {
							
							$target = add_query_arg(array(
									'subscribe' => -1
								), $target);
								
							$success = false;
								
						}else{
	
							$success = true;
						}
	
						unset($confirms[$_GET['k']]);
	
						update_option( 'mymail_confirms', $confirms );
						
					}
					
					$forms = mymail_option('forms');
					if(isset($forms[$form_id]) && !empty($forms[$form_id]['confirmredirect'])){
						$target = $forms[$form_id]['confirmredirect'];
					}

					wp_redirect(apply_filters('mymail_confirm_target', $target, $success));
					exit();
				}
			}
		} else if (isset($_GET['delete'])) {
			if (isset($_GET['k'])) {

				if(mymail_option('homepage') == $post->ID){
					$confirms = get_option( 'mymail_confirms' );
					$data = isset($confirms[$_GET['k']]) ? $confirms[$_GET['k']]: NULL;
					if ($data) {
	
						unset($confirms[$_GET['k']]);
	
						update_option( 'mymail_confirms', $confirms );
	
					}
				}

			}
		}
	}


	public function edit_hook( ) {
		if ( isset( $_REQUEST['post_type'] ) && 'subscriber' == $_REQUEST['post_type'] ) {

			add_filter( 'posts_join', array( &$this, 'search_join' ) );
			add_filter( 'posts_where', array( &$this, 'search_where' ) );
			add_filter( 'posts_groupby', array( &$this, 'search_groupby' ) );
			
			add_filter( "manage_edit-subscriber_columns", array( &$this, "columns" ) );
			add_filter( "manage_subscriber_posts_custom_column", array( &$this, "columns_content" ) );
			add_filter( "restrict_manage_posts", array( &$this, "restrict_manage_posts" ) );
			add_filter( "parse_query", array( &$this, "convert_restrict" ) );
			
			add_action( "admin_enqueue_scripts", array( &$this, "edit_style" ) );
			
			if(isset( $_REQUEST['convert_errors'] )){
			
				if($_REQUEST['convert_errors'] && wp_verify_nonce($_REQUEST['_wpnonce'], 'mymail_nonce' )){
					global $wpdb;
					$sql = "UPDATE {$wpdb->posts} SET post_status = 'subscribed' WHERE {$wpdb->posts}.post_type = 'subscriber' AND {$wpdb->posts}.post_status = 'error';";
					$count = $wpdb->query($sql);
					mymail_notice(sprintf(__('%s subscribers have been converted', 'mymail'), '<strong>'.$count.'</strong>'), '', true);
					if($count) mymail_clear_totals();
				}
			}
			

		}
	}
	
	public function admin_notices( ) {
		if ( isset( $_REQUEST['post_type'] ) && 'subscriber' == $_REQUEST['post_type'] && isset( $_REQUEST['post_status'] ) && 'error' == $_REQUEST['post_status'] ) {

			echo '<div class="error"><p><strong><a href="'.add_query_arg(array('convert_errors' => 1, 'post_status' => 'subscribed', '_wpnonce' => wp_create_nonce('mymail_nonce'))).'">'.__('convert all subscribers with error status back to subscribed', 'mymail').'</a></strong></p></div>';
		}
	}


	public function post_hook( ) {
		global $post;
		//only on edit old newsletter and save
		if (isset($post) && 'subscriber' == $post->post_type ) {

			add_filter( "enter_title_here", array( &$this, "title" ) );

			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts_styles' ), 10, 1 );
			add_action( 'dbx_post_sidebar', array( &$this, 'add_ajax_nonce' ) );

			$this->user_data  = get_post_meta( $post->ID, 'mymail-userdata', true );
			$this->campaign_data = get_post_meta( $post->ID, 'mymail-campaigns', true );

		}
	}


	public function post_new_hook( ) {
	
		if ( isset( $_REQUEST['post_type'] ) && 'subscriber' == $_REQUEST['post_type'] ) {
			
			add_filter( "enter_title_here", array( &$this, "title") );
			
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts_styles' ), 10, 1 );
			add_action( 'dbx_post_sidebar', array( &$this, 'add_ajax_nonce' ) );

		}
	}
	
	public function search_join ( $join ){
		global $wpdb;
		
		if ( 'subscriber' == $_REQUEST['post_type'] && !empty($_GET['s'])) {	
			$join .='LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
		}
		
		return $join;
	}
	
	public function search_where ( $where ){
		global $wpdb;
		
		if ( 'subscriber' == $_REQUEST['post_type'] && !empty($_GET['s'])) {	
			
			$search = esc_attr($_GET['s']);
			$customfields = mymail_option('custom_field', array());
			$fields = wp_parse_args(array_keys($customfields),array('firstname', 'lastname'));
			$where = preg_replace(
			"/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
			"(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->posts.".post_name LIKE $1) OR (".$wpdb->postmeta.".meta_value REGEXP '\"(".implode('|', $fields).")\";s:[0-9]+:\".*$search.*\"')", $where );
		}
		
		return $where;
	}
	
	public function search_groupby ( $groupby ){
		global $wpdb;
		
		if ( 'subscriber' == $_REQUEST['post_type'] && !empty($_GET['s'])) {	
			$groupby = " {$wpdb->posts}.ID";
		}
		
		return $groupby;
	}
	
	public function tag_cloud( $return, $args ) {
		
		if ( $args['taxonomy'] == 'newsletter_lists' )
			$return = '';
		
		return $return;
	}
	
	public function check_ajax_referer( $action, $result ) {
		
		if ( isset($_REQUEST['taxonomy']) && $_REQUEST['taxonomy'] == 'newsletter_lists' && $_REQUEST['action'] == 'delete-tag' ){

			$term_id = intval($_REQUEST['tag_ID']);
			$this->bulk_delete_term($term_id);
		}
	}
	
	public function bulk_delete_term( $term_id ) {
		
		//usefull for large lists
		global $wpdb;
		$sql = "DELETE FROM {$wpdb->term_relationships} WHERE term_taxonomy_id = $term_id";
		$wpdb->query($sql);
		
	}
	
	public function title($title) {
		return __('Enter Email here', 'mymail');
	}


	public function add_ajax_nonce( ) {
		wp_nonce_field( 'mymail_nonce', 'mymail_nonce', false );
	}


	public function remove_meta_boxs() {

		remove_meta_box('submitdiv', 'subscriber', 'core');
		remove_meta_box('tagsdiv-newsletter_lists', 'subscriber', 'core' );
	}


	/*----------------------------------------------------------------------*/
	/* AJAX
	/*----------------------------------------------------------------------*/


	private function ajax() {

		add_action('wp_ajax_mymail_get_gravatar', array( &$this, 'ajax_get_gravatar' ) );
		add_action('wp_ajax_mymail_check_email', array( &$this, 'ajax_check_email' ) );
		add_action('wp_ajax_mymail_create_list', array( &$this, 'ajax_create_list' ) );
		add_action('wp_ajax_mymail_get_create_list_count', array( &$this, 'ajax_get_create_list_count' ) );
		
		

	}


	public function ajax_get_gravatar() {

		$return['success'] = false;

		$this->ajax_nonce( json_encode( $return ) );

		$email = esc_attr($_POST['email']);

		$return['success'] = true;
		$return['url'] = $this->get_gravatar_uri($email);

		@header( 'Content-type: application/json' );
		echo json_encode($return);
		exit;

	}


	public function ajax_check_email() {

		$return['success'] = false;

		$this->ajax_nonce( json_encode( $return ) );

		$email = esc_attr($_POST['email']);

		$subscriber = $this->get_by_mail($email);
		$return['exists'] = !!$subscriber && $subscriber->ID != (int) $_POST['id'];
		$return['success'] = true;

		@header( 'Content-type: application/json' );
		echo json_encode($return);
		exit;

	}
	
	public function ajax_create_list() {

		$return['success'] = false;

		$this->ajax_nonce( json_encode( $return ) );

		$name = esc_attr($_POST['name']);
		$campaign_id = intval($_POST['id']);
		$listtype = esc_attr($_POST['listtype']);
		
		$return['success'] = $this->create_list_from_option($name, $campaign_id, $listtype);
		$return['msg'] = $return['success'] ? __('List has been created', 'mymail') : __("Couldn't create List", 'mymail');
		
		@header( 'Content-type: application/json' );
		echo json_encode($return);
		exit;

	}
	
	public function ajax_get_create_list_count() {

		$return['success'] = false;

		$this->ajax_nonce( json_encode( $return ) );

		$campaign_id = intval($_POST['id']);
		$listtype = esc_attr($_POST['listtype']);
		
		$return['count'] = $this->create_list_from_option('', $campaign_id, $listtype, true);
		$return['success'] = true;
		
		@header( 'Content-type: application/json' );
		echo json_encode($return);
		exit;

	}





	private function generateFile($subscribers, $format = 'csv' ) {
		if (!in_array($format, array('csv', 'xls', 'html'))) return false;

		$output = '';
		$data = array();

		$customfields = mymail_option('custom_field', array());
		$merge = array();

		global $wp_post_statuses;

		foreach ($subscribers as $s) {
			$userdata = get_post_meta( $s->ID, 'mymail-userdata', true );
			$data[$s->ID] = array(
				'_email' => $s->post_title,
				'_firstname' => $userdata['firstname'],
				'_lastname' => $userdata['lastname'],
				'_data' => date(get_option('date_format').' '.get_option('time_format'), strtotime($s->post_date)),
				'_status' => $wp_post_statuses[$s->post_status]->label,
			);
			if ($customfields) {
				foreach ($customfields as $id => $cdata) {
					if (!in_array($cdata['name'], $merge)) $merge[] = $cdata['name'];
					$data[$s->ID][$id] = isset($userdata[$id]) ? $userdata[$id] : '';
				}
			}
		}

		$filename = 'subscriber_'.date('Y-m-d-H-i', current_time('timestamp'));

		switch ( $format) {
		case 'csv':
			header('Content-Type: text/csv; name="'.$filename.'.csv"');
			header('Content-Disposition: attachment; filename="'.$filename.'.csv"');
			break;
		case 'html':
			break;

		}

		switch ( $format) {
		case 'csv':

			$output .= implode('; ', array_merge(array(
						mymail_text('email', __('Email', 'mymail')),
						mymail_text('firstname', __('Firstname', 'mymail')),
						mymail_text('email', __('Lastname', 'mymail')),
						__('Date', 'mymail'),
						__('Status', 'mymail'),
					), $merge))."\n";

			foreach ($data as $entryid => $entry) {
				$output .= implode('; ', $entry)."\n";
			}
			break;
		case 'html':
			$output .= '<style>table{border:1px solid #ccc;width:100%;}td,th{border-bottom:1px solid #ccc;padding:2px;}</style><table cellpading="0" cellspacing="0">';
			$output .= '<tr align="left"><th>'.implode('</th><th>', array_merge(array(
						mymail_text('email', __('Email', 'mymail')),
						mymail_text('email', __('Firstname', 'mymail')),
						mymail_text('email', __('Lastname', 'mymail')),
						__('Date', 'mymail'),
						__('Status', 'mymail'),
					), $merge))."</th></tr>\n";

			$i = 0;
			foreach ($data as $entryid => $entry) {
				$output .= '<tr'.(!($i%2) ? ' bgcolor="#f1f1f1"' : '').'><td>'.implode('</td><td>', $entry)."</td></tr>\n";
				$i++;
			}
			break;

		}

		return $output;
	}





	private function ajax_nonce($return = NULL, $nonce = 'mymail_nonce') {
		if (!wp_verify_nonce($_REQUEST['_wpnonce'], $nonce)) {
			die( $return );
		}
	}



	public function insert($email, $status = 'subscribed', $userdata = array(), $lists = array(), $overwrite = true, $logit = true, $mergelists = NULL, $form_id = NULL) {

		$email = trim(strtolower($email));
		
		if(!mymail_is_email( $email )) return new WP_Error('invalid_email', __('invalid email address', 'mymail'));
		
		$insert = array(
			'post_title' => $email,
			'post_name' => $this->hash($email),
			'post_status' => in_array($status, array('subscribed', 'unsubscribed', 'hardbounced')) ? $status : 'subscribed',
			'post_type' => 'subscriber',
		);
		
		$userdata = (array) $userdata;
		
		if ($userexists = $this->get_by_mail( $email )) {
			if (!$overwrite) return new WP_Error('user_exists', sprintf(__('user already exists (ID: %d)', 'mymail'), $userexists->ID));
			$insert = wp_parse_args( array( 'ID' => $userexists->ID ), $insert );
			
			//keep old data if no new one is set
			$olduserdata = get_post_meta( $userexists->ID, 'mymail-userdata', true );
			if($olduserdata && is_array($olduserdata)) $userdata = array_merge($olduserdata, $userdata);
		
			//merge lists
			if(is_null($mergelists)) $mergelists = mymail_option('merge_lists');
			if($mergelists) $lists = array_unique(wp_parse_args($lists, wp_get_object_terms($userexists->ID, 'newsletter_lists', array('fields' => 'slugs'))));
			
		}
		
		if(empty( $lists )) return new WP_Error('no_Lists', __('no lists defined', 'mymail'));
		
		try {
		
			$ID = wp_insert_post($insert);
		
		} catch (Exception $e) {
		
			return new WP_Error('exception', $e->getMessage());

		}
		
		if ($ID) {
		
			wp_set_object_terms($ID, $lists, 'newsletter_lists');
			
			unset($userdata['email']);
			
			$userdata['_meta'] = isset($userdata['_meta']) ? $userdata['_meta'] : array();
			
			if(mymail_option('track_users')){
				
				$userdata['_meta'] = wp_parse_args(array(
						'ip' => mymail_get_ip(),
						'confirmip' => mymail_get_ip(),
						'confirmtime' => current_time('timestamp'),
				), $userdata['_meta'] );
				
				$userdata['_meta']['signupip'] = isset($userdata['_meta']['signupip']) ? $userdata['_meta']['signupip'] : mymail_get_ip();
				$userdata['_meta']['signuptime'] = isset($userdata['_meta']['signuptime']) ? $userdata['_meta']['signuptime'] : current_time('timestamp');
			
			}
			$userdata['_meta']['lang'] = mymail_get_lang();
			if(isset($_POST['_referer'])) $userdata['_meta']['referer'] = $_POST['_referer'];
			
			if(!is_null($form_id)) $userdata['_meta']['form'] = $form_id;
			$userdata['_meta']['form'] = isset($userdata['_meta']['form']) ? $userdata['_meta']['form'] : (!is_null($form_id) ? $form_id : 'unknown');

			
			$this->post_meta( $ID, 'mymail-userdata', apply_filters( 'mymail_user_data', $userdata ) ); 
			
			if ($logit){
				$this->add_new('sub');
				do_action('mymail_subscriber_insert', $ID);
			}else{
				do_action('mymail_subscriber_insert_nolog', $ID);
			}
			
			
			return $ID;
		}
		
		return new WP_Error('unknown', __('not able to insert subscriber', 'mymail'));

	}


	//requires valid values, no validation!
	public function rawinsert($ID = NULL, $email, $status = 'subscribed', $userdata = array(), $lists = array(), $autoresponder = true) {

		//use normal import if no bulk import
		if(!defined('MYMAIL_DO_BULKIMPORT')) return $this->insert($email, $status, $userdata, $lists, false, $autoresponder);
		
		global $wpdb, $user_ID;
		
		try {
		
			$post_date = current_time('mysql');
			
			$post_date_gmt = get_gmt_from_date($post_date);
		
			$insert = array('post_status' => $status, 'post_type' => 'subscriber', 'post_author' => $user_ID,
				'post_date' => $post_date, 'post_date_gmt' => $post_date_gmt, 'post_modified' => $post_date, 'post_modified_gmt' => $post_date_gmt,
				'ping_status' => 'closed','comment_status' => 'closed', 'post_parent' => 0,
				'menu_order' => 0, 'to_ping' =>  '', 'pinged' => '', 'post_password' => '',
				'guid' => '', 'post_content_filtered' => '', 'post_excerpt' => '',
				'post_content' => '', 'post_title' => $email, 'post_name' => $this->hash($email));
				
			if(is_null($ID)){
				$success = $wpdb->insert($wpdb->posts, $insert);
				$ID = $wpdb->insert_id;
			}else{
				$success = $wpdb->update($wpdb->posts, $insert, array('ID' => $ID));
			}
		
		} catch (Exception $e) {
		
			return new WP_Error('exception', $e->getMessage());

		}

		if ($ID) {
		
			$this->assign_lists($ID, $lists);
			
			unset($userdata['email']);
			
			$userdata['_meta'] = isset($userdata['_meta']) ? $userdata['_meta'] : array();
			
			//TODO add language to bulk import
			$userdata['_meta']['lang'] = NULL;
			$userdata['_meta']['imported'] = current_time('timestamp');

			update_post_meta( $ID, 'mymail-userdata', apply_filters( 'mymail_user_data', $userdata ) );

			$this->add_new('sub');
			
			if ($autoresponder){
				do_action('mymail_subscriber_insert', $ID);
			}			
			
			return $ID;
		}
		
		return new WP_Error('unknown', __('not able to insert subscriber', 'mymail'));

	}


	public function assign_lists($object_id, $lists) {
		
		//use normal import if no bulk import
		if(!defined('MYMAIL_DO_BULKIMPORT')) wp_set_object_terms($object_id, $lists, 'newsletter_lists');

		global $wpdb;
	
		$object_id = (int) $object_id;
		
		$taxonomy = 'newsletter_lists';
	
		$old_tt_ids =  wp_get_object_terms($object_id, $taxonomy, array('fields' => 'tt_ids', 'orderby' => 'none'));
	
		$tt_ids = array();
		$term_ids = array();
		$new_tt_ids = array();
	
		foreach ( (array) $lists as $term) {
		
			$term_info = term_exists($term, $taxonomy);
			
			$term_ids[] = $term_info['term_id'];
			$tt_id = $term_info['term_taxonomy_id'];
			$tt_ids[] = $tt_id;
	
			if ( $wpdb->get_var( $wpdb->prepare( "SELECT term_taxonomy_id FROM $wpdb->term_relationships WHERE object_id = %d AND term_taxonomy_id = %d", $object_id, $tt_id ) ) )
				continue;
				
			$wpdb->insert( $wpdb->term_relationships, array( 'object_id' => $object_id, 'term_taxonomy_id' => $tt_id ) );
			
			$new_tt_ids[] = $tt_id;
		}
	
		$delete_terms = array_diff($old_tt_ids, $tt_ids);
		
		if ( $delete_terms ) {
			$in_delete_terms = "'" . implode("', '", $delete_terms) . "'";
			$wpdb->query( $wpdb->prepare("DELETE FROM $wpdb->term_relationships WHERE object_id = %d AND term_taxonomy_id IN ($in_delete_terms)", $object_id) );
		}
	
		$t = get_taxonomy($taxonomy);
		
		if (isset($t->sort) && $t->sort ) {
			$values = array();
			$term_order = 0;
			$final_tt_ids = wp_get_object_terms($object_id, $taxonomy, array('fields' => 'tt_ids'));
			foreach ( $tt_ids as $tt_id )
				if ( in_array($tt_id, $final_tt_ids) )
					$values[] = $wpdb->prepare( "(%d, %d, %d)", $object_id, $tt_id, ++$term_order);
			if ( $values )
				if ( false === $wpdb->query( "INSERT INTO $wpdb->term_relationships (object_id, term_taxonomy_id, term_order) VALUES " . join( ',', $values ) . " ON DUPLICATE KEY UPDATE term_order = VALUES(term_order)" ) )
					return new WP_Error( 'db_insert_error', 'Could not insert term relationship into the database', $wpdb->last_error );
		}
	
		wp_cache_delete( $object_id, $taxonomy . '_relationships' );
	
		return $tt_ids;
	}


	public function subscribe( $email, $userdata = array(), $lists = array(), $double_opt_in = NULL, $overwrite = true, $mergelists = NULL, $template = 'notification.html', $form_id = 0 ) {
	
		if(!mymail_is_email( $email )) return new WP_Error('invalid_email', __('invalid email address', 'mymail'));
		if(empty( $lists )) return new WP_Error('no_Lists', __('no lists defined', 'mymail'));
		
		if(!is_array($lists)) $lists = array($lists);
		
		$userdata = wp_parse_args( $userdata, array(
			'email' => $email,
			'firstname' => '',
			'lastname' => '',
		));
		
		$userdata['_meta'] = array();

		$forms = mymail_option('forms');
		$form = isset($forms[$form_id]) ? $forms[$form_id] : $forms[0];
		
		$userdata['_meta']['lang'] = mymail_get_lang();
		$userdata['_meta']['form'] = $form_id;
		$userdata['_meta']['referer'] = isset($_POST['_referer']) ? $_POST['_referer'] : NULL;
		
		$userexists = $this->get_by_mail( $email );

		if(!$overwrite && $userexists) return new WP_Error('subscriber_exists', __('subscriber already exists', 'mymail'));
		
		if(is_null($double_opt_in)) $double_opt_in = isset($form['double_opt_in']);
		$baselink = get_permalink( mymail_option('homepage') );
		
		//merge lists
		if(is_null($mergelists)) $mergelists = mymail_option('merge_lists');
		if($mergelists && $userexists) $lists = array_unique(wp_parse_args($lists, wp_get_object_terms($userexists->ID, 'newsletter_lists', array('fields' => 'slugs'))));
		
		if(!$baselink) $baselink = site_url();
		
		if ($double_opt_in) {
		
			//send confirmation email
			return $this->send_confirmation( $baselink, $email, $userdata, $lists, array(), $template, $form_id );
			
		} else {
			
			unset($userdata['email']);
			//subscribe user
			$result = $this->insert( $email, 'subscribed', $userdata, $lists, $overwrite, true, NULL, $form_id );
			
			if(is_wp_error( $result )){
				return $result;
			}else{
				return $result;
			}
		}
		
		return false;
	}
	
	
	
	public function unsubscribe($hash_or_id, $campaign_id = NULL, $logit = true) {

		if(!$hash_or_id) return false;
		
		if (is_integer($hash_or_id)) {
		
			$user = get_post($hash_or_id);
			
		} else if(mymail_is_email(trim($hash_or_id))){

			$email = strtolower(trim($hash_or_id));
			
			$user = $this->get_by_mail($email);
			$user = get_posts(array(
				'post_type' => 'subscriber',
				'name' => $user->hash,
				'posts_per_page' => 1,
				'post_status' => 'any',
			));
			$user = array_shift($user);
			if($user->post_title != $email) $user = false;
			
		} else {

			$user = get_posts(array(
				'post_type' => 'subscriber',
				'name' => $hash_or_id,
				'posts_per_page' => 1,
				'post_status' => 'any',
			));
			
			$user = array_shift($user);
		}
					do_action('mymail_subscriber_unsubscribed', $user->ID, $campaign_id);
		
		
		if ($user && in_array($user->post_status, array('subscribed', 'unsubscribed', 'hardbounced'))) {

			if ($this->change_status($user, 'unsubscribed')) {
			
				if (!is_null($campaign_id)) {
	
					wp_cache_delete( $campaign_id, 'post' . '_meta' );
					$campaign_data = get_post_meta($campaign_id, 'mymail-campaign', true);
					wp_cache_delete( $user->ID, 'post' . '_meta' );
					$usercampaigndata = get_post_meta($user->ID, 'mymail-campaigns', true);

				}
	
				if (isset($campaign_data)) {
					$campaign_data['unsubscribes']++;
					$this->post_meta($campaign_id, 'mymail-campaign', $campaign_data);
					
				}
				
				if(!empty($campaign_data['original_campaign'])){
					$orig_campaign_id = intval($campaign_data['original_campaign']);
					$orig_campaign_data = get_post_meta($orig_campaign_id, 'mymail-campaign', true);
					$orig_campaign_data['unsubscribes']++;
					$this->post_meta($orig_campaign_id, 'mymail-campaign', $orig_campaign_data);
					
				}else{
					$orig_campaign_data = false;
				}
				
				if (isset($usercampaigndata)) {
					$usercampaigndata[$campaign_id]['unsubscribe'] = time();
					$this->post_meta($user->ID, 'mymail-campaigns', $usercampaigndata);
				}

				if ($logit){
					$this->add_new('unsub');
					do_action('mymail_subscriber_unsubscribed', $user->ID, $campaign_id);
					if($orig_campaign_data) do_action('mymail_subscriber_unsubscribed', $user->ID, $orig_campaign_id);
				}
						
				mymail_clear_totals();

			}

			return true;
		}

		return false;

	}


	public function send_confirmation($baselink, $email, $userdata = array(), $lists = array(), $confirm_array = array(), $template = 'notification.html', $formid = 0) {

		$email = trim($email);
		
		if (!mymail_is_email($email)) return false;

		$userdata['email'] = $email;

		$hash = $this->hash($email);
		
		$forms = mymail_option('forms');
		$form = isset($forms[$formid]) ? $forms[$formid] : $forms[0];

		$confirms = get_option( 'mymail_confirms', array() );
		
		if(mymail_option('track_users'))
			$userdata['_meta'] = array(
				'ip' => mymail_get_ip(),
				'signupip' => mymail_get_ip(),
				'signuptime' => current_time('timestamp'),
			);
			
		$userdata['_meta']['lang'] = mymail_get_lang();
		$userdata['_meta']['form'] = $formid;
		if(isset($_POST['_referer'])) $userdata['_meta']['referer'] = $_POST['_referer'];

		$confirms[$hash] = wp_parse_args( $confirm_array,  array(
			'timestamp' => time(),
			'userdata' => $userdata,
			'lists' => $lists,
			'template' => $template,
			'try' => 0,
			'last' => time(),
			'form' => $formid,
		));
		
		$link = htmlentities(add_query_arg(array(
			'confirm' => '',
			'k' => $hash,
			'f' => $formid,
		), $baselink));
		
		require_once MYMAIL_DIR.'/classes/mail.class.php';
		
		$mail = mymail_mail::get_instance();
		
		$mail->to = $email;
		$mail->reply_to = mymail_option('reply_to', false);
		$mail->subject = $form['text']['subscription_subject'];
		
		if(isset($form['vcard'])){
			$filename = !empty($form['vcard_filename']) ? $form['vcard_filename'] : 'vCard.vcf';
			$mail->attachments[] = MYMAIL_UPLOAD_DIR.'/'.$filename;
		}

		$text = $form['text']['subscription_text'];

		if (strpos($text, '{link}') == -1) {
			$text .= "\n{link}";
		}
		
		if(isset($userdata['_meta'])) unset($userdata['_meta']);
		
		$userdata['emailaddress'] = $email;
		$userdata['email'] = '<a href="mailto:'.$email.'">'.$email.'</a>';
		$userdata['fullname'] = trim(@$userdata['firstname'].' '.@$userdata['lastname']);
		
		$result = $mail->send_notification(nl2br($text), $form['text']['subscription_headline'], wp_parse_args( array( 'link' => '<a href="'.$link.'">'. $form['text']['subscription_link'].'</a>' ), $userdata) , true, $template );
		
		if($result) update_option( 'mymail_confirms' , $confirms );

		return $result;

	}



	public function create_list_from_option($name, $campaign_id, $option = 'open', $countonly = false) {
	
		if(!current_user_can('mymail_assign_lists') || !current_user_can('mymail_edit_lists')) return false;
		
		global $wpdb, $mymail;
		
		$campaign = get_post($campaign_id);
		
		if(!$campaign || $campaign->post_type != 'newsletter' || $campaign->post_status == 'autoresponder') return false;
		
		$name = esc_attr($name);
		$lists = wp_get_post_terms($campaign->ID, 'newsletter_lists', array("fields" => "ids"));
		$term_taxonomy_ids = wp_list_pluck(get_terms( 'newsletter_lists', array('fields' => 'all', 'include' => $lists)), 'term_taxonomy_id');
		
		$query = "SELECT {$wpdb->posts}.ID FROM {$wpdb->posts} INNER JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id) LEFT JOIN {$wpdb->postmeta} AS meta ON ({$wpdb->posts}.ID = meta.post_id AND meta.meta_key = 'mymail-campaigns') LEFT JOIN {$wpdb->postmeta} AS data ON ({$wpdb->posts}.ID = data.post_id AND data.meta_key = 'mymail-userdata') WHERE ( {$wpdb->term_relationships}.term_taxonomy_id IN (".implode(',', $term_taxonomy_ids ).") ) AND {$wpdb->posts}.post_type = 'subscriber' AND ({$wpdb->posts}.post_status IN ('subscribed'))";

		switch($option){
			case 'open':
				$query .= " AND (meta.meta_value REGEXP 'i:{$campaign->ID};a:[0-9]+:{s:4:\"sent\";(i|d):[0-9]+;s:4:\"open\";(i|d):[0-9]+;')";
				break;
			case 'open_not_click':
				$query .= " AND (meta.meta_value REGEXP 'i:{$campaign->ID};a:[0-9]+:{s:4:\"sent\";(i|d):[0-9]+;s:4:\"open\";(i|d):[0-9]+;' AND meta.meta_value NOT REGEXP 'i:{$campaign->ID};a:[0-9]+:{s:4:\"sent\";(i|d):[0-9]+;s:4:\"open\";(i|d):[0-9]+;s:10:\"firstclick\";(i|d):[0-9]+;s:11:\"totalclicks\";(i|d):[0-9]+')";
				break;
			case 'click':
				$query .= " AND meta.meta_value REGEXP 'i:{$campaign->ID};a:[0-9]+:{s:4:\"sent\";(i|d):[0-9]+;s:4:\"open\";(i|d):[0-9]+;s:10:\"firstclick\";(i|d):[0-9]+;s:11:\"totalclicks\";(i|d):[0-9]+'";
				break;
			case 'not_open':
				$query .= " AND (meta.meta_value REGEXP 'i:{$campaign->ID};a:[0-9]+:{s:4:\"sent\";' AND meta.meta_value NOT REGEXP 'i:{$campaign->ID};a:[0-9]+:{s:4:\"sent\";(i|d):[0-9]+;s:4:\"open\";(i|d):[0-9]+;')";
				break;
			case 'not';
				$query .= " AND (meta.meta_value NOT REGEXP 'i:{$campaign->ID};a:[0-9]+:{s:4:\"sent\";' OR meta.meta_value IS NULL )";
				break;
			case 'all';
			default:
				$query .= " AND meta.meta_value REGEXP 'i:{$campaign->ID};a:[0-9]+:{s:4:\"sent\";'";
				break;
			}
			
			
		//add "only if"
		$campaign_data = get_post_meta($campaign->ID, 'mymail-data', true);
		if(!empty($campaign_data['list'])) $query .= $mymail->get_sql_by_condition($campaign_data['list'], 'data');
		
		$query .= " GROUP BY {$wpdb->posts}.ID ORDER BY {$wpdb->posts}.ID";
		
		$result = mysql_query($query, $wpdb->dbh);
		
		if($countonly) return mysql_num_rows($result);
		
		$ids = array();
		
		//foreach subscribers
		while ($subscriber = @mysql_fetch_object($result)) {
			$ids[] = $subscriber->ID;
		}
				
		//remove filter for form addition
		global $mymail;
		remove_action('created_newsletter_lists', array( &$mymail, 'created_newsletter_lists'), 10, 2);
		
		$options = array(
			'all' => __('who have received', 'mymail'),
			'not' => __('who have not received', 'mymail'),
			'open' => __('who have opened', 'mymail'),
			'open_not_click' => __('who have opened but not clicked', 'mymail'),
			'click' => __('who have opened and clicked', 'mymail'),
			'not_open' => __('who have not opened', 'mymail'),
		);
		//create term
		$term = wp_insert_term($name, 'newsletter_lists', array(
			'description'=> sprintf(_x('A segment of all %1$s of %2$s created %3$s', 'segment of all [recipients] from campaign [campaign]', 'mymail'), $options[$option], '"'.$campaign->post_title.'"', date_i18n(get_option('date_format').' '.get_option('time_format'))),
			'slug' => 'segment-'.$option.'-of-'.$campaign->ID,
		));
		if(is_wp_error($term)){
			$term_taxonomy_id = $term->error_data['term_exists'];
			//delete all existing releationships
			mysql_query("DELETE FROM {$wpdb->term_relationships} WHERE term_taxonomy_id = $term_taxonomy_id", $wpdb->dbh);
		}else{
			$term_taxonomy_id = $term['term_taxonomy_id'];
		}
		
		$chunks = array_chunk($ids, 1000);
		
		foreach($chunks as $chunk){
			
			$sql = "INSERT INTO {$wpdb->term_relationships} (`object_id`, `term_taxonomy_id`) VALUES ('".implode("', '".$term_taxonomy_id."'), ('", $chunk)."', '".$term_taxonomy_id."');";
			mysql_query($sql, $wpdb->dbh);
		}
		
		$this->trigger_update_post_term_count(array($term_taxonomy_id));
		
		mysql_free_result($result);
		return true;
		
	}



	public function get($ID) {
	
		if(!is_numeric($ID)) return false;
		$post = get_post($ID);
		if(!$post) return false;
		if($post->post_type != 'subscriber') return false;
		
		$user_data = get_post_meta( $post->ID, 'mymail-userdata', true );
		
		if(!is_array($user_data)) $user_data = array();
		
		$lists = get_the_terms($post->ID, 'newsletter_lists');
		
		$user_data['_lists'] = array();
		if(!empty($lists)){
			foreach($lists as $i => $list){
				$user_data['_lists'][] = array(
					'id' => intval($list->term_id),
					'name' => $list->name,
					'slug' => $list->slug,
				);
			}
		}
		
		$first_name = isset($user_data['firstname']) ? $user_data['firstname'] : '';
		$last_name = isset($user_data['lastname']) ? $user_data['lastname'] : '';
		
		return (object) wp_parse_args($user_data, array(
			'ID' => $post->ID,
			'email' => $post->post_title,
			'hash' => $post->post_name,
			'status' => $post->post_status,
			'firstname' => $first_name,
			'lastname' => $last_name,
			'fullname' => trim($first_name.' '.$last_name),
		));
		
		
	}



	public function get_by_mail($mail) {
		
		$post = get_page_by_title($mail, 'OBJECT', 'subscriber');
		
		return ($post && $post->post_type == 'subscriber') ? $this->get($post->ID) : false;
	}


	public function get_by_hash($hash) {
		
		$post = get_page_by_path($hash, 'OBJECT', 'subscriber');
		
		return ($post && $post->post_type == 'subscriber') ? $this->get($post->ID) : false;
	}


	/*----------------------------------------------------------------------*/
	/* Custom Post Type
	/*----------------------------------------------------------------------*/


	public function register_post_type() {

		register_post_type('subscriber', array(

				'labels' => array(
					'name' => __('Subscribers', 'mymail'),
					'singular_name' => __('Subscriber', 'mymail'),
					'add_new' => __('Add New', 'mymail'),
					'add_new_item' => __('Add New Subscriber', 'mymail'),
					'edit_item' => __('Edit Subscriber', 'mymail'),
					'new_item' => __('New Subscriber', 'mymail'),
					'all_items' => __('Subscribers', 'mymail'),
					'view_item' => __('View Subscribers', 'mymail'),
					'search_items' => __('Search Subscribers', 'mymail'),
					'not_found' => __('No Subscriber found', 'mymail'),
					'not_found_in_trash' => __('No Subscriber found in Trash', 'mymail'),
					'parent_item_colon' => '',
					'menu_name' => __('Subscriber', 'mymail')
				),

				'public' => false,
				'can_export' => false,
				'show_ui' => true,
				'has_archive' => false,
				'exclude_from_search' => true,
				'hierarchical' => false,
				'capability_type' => 'subscriber',
				'map_meta_cap' => true,
				'rewrite' => true,
				'supports' => array('title'),
				'show_in_menu' => 'edit.php?post_type=newsletter',
				'register_meta_box_cb' => array( &$this, 'add_meta_boxes' ),
				'taxonomies' => array( 'newsletter_lists' )

			)

		);
		$labels = array(
			'name' => _x( 'Lists', 'taxonomy general name', 'mymail' ),
			'singular_name' => _x( 'List', 'taxonomy singular name', 'mymail' ),
			'search_items' => __( 'Search Lists', 'mymail' ),
			'popular_items' => __( 'Popular Lists', 'mymail' ),
			'all_items' => __( 'All Lists', 'mymail' ),
			'edit_item' => __( 'Edit List', 'mymail' ),
			'update_item' => __( 'Update List', 'mymail' ),
			'add_new_item' => __( 'Add New List', 'mymail' ),
			'new_item_name' => __( 'New List Name', 'mymail' ),
			'separate_items_with_commas' => __( 'Separate Lists with commas', 'mymail' ),
			'add_or_remove_items' => __( 'Add or remove Lists', 'mymail' ),
			'choose_from_most_used' => __( 'Choose List', 'mymail' ),
			'menu_name' => __( 'Lists', 'mymail' )
		);

		register_taxonomy( 'newsletter_lists', array(
				'subscriber',
				'newsletter'
			), array(
				'public' => false,
				'hierarchical' => false,
				'labels' => $labels,
				'show_ui' => true,
				'update_count_callback' => array( &$this, 'update_post_term_count' ),
				'show_in_nav_menus' => true,
				'show_tagcloud' => false,
				'query_var' => true,
				'capabilities' => array(
					'manage_terms' => 'mymail_edit_lists',
					'edit_terms' => 'mymail_edit_lists',
					'delete_terms' => 'mymail_delete_lists',
					'assign_terms' => 'mymail_assign_lists',
					
				),
			) );
	}


	public function register_post_status() {


		register_post_status( 'subscribed' , array(
				'label'	=> __( 'Subscribed', 'mymail' ),
				'public'   => true,
				'exclude_from_search' => false,
				'show_in_admin_all_list' => true,
				'label_count' => _n_noop( __( 'Subscribed', 'mymail' ).' <span class="count">(%s)</span>', __( 'Subscribed', 'mymail' ).' <span class="count">(%s)</span>' ),
			) );

		register_post_status( 'unsubscribed' , array(
				'label'	=> __( 'Unsubscribed', 'mymail' ),
				'public'   => true,
				'exclude_from_search' => false,
				'show_in_admin_all_list' => true,
				'label_count' => _n_noop( __( 'Unsubscribed', 'mymail' ).' <span class="count">(%s)</span>', __( 'Unsubscribed', 'mymail' ).' <span class="count">(%s)</span>' ),
			) );

		register_post_status( 'hardbounced' , array(
				'label'	=> __( 'Hardbounced', 'mymail' ),
				'public'   => false,
				'exclude_from_search' => false,
				'show_in_admin_all_list' => false,
				'label_count' => _n_noop( __( 'Hardbounced', 'mymail' ).' <span class="count">(%s)</span>', __( 'Hardbounced', 'mymail' ).' <span class="count">(%s)</span>' ),
			) );
			
		register_post_status( 'error' , array(
				'label'	=> __( 'Error', 'mymail' ),
				'public'   => false,
				'exclude_from_search' => false,
				'show_in_admin_all_list' => false,
				'label_count' => _n_noop( __( 'Error', 'mymail' ).' <span class="count">(%s)</span>', __( 'Error', 'mymail' ).' <span class="count">(%s)</span>' ),
			) );

	}



	public function columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"avatar" => '',
			"title" => __("Email", 'mymail'),
			"name" => __("Name", 'mymail'),
			"lists" => __("Lists", 'mymail'),
			"emails" => __("Emails", 'mymail'),
			"status" => __("Status", 'mymail'),
			"date" => __("Date", 'mymail'),
		);
		return $columns;
	}
	
	
	
	public function columns_content($column) {
		global $post;
		switch ($column) {
		case "avatar":
			
			echo '<div class="mymail-avatar-40" style="background-image:url('.$this->get_gravatar_uri($post->post_title, 80).')"</div>';
				
			break;
		case "name":
			$userdata = get_post_meta( $post->ID, 'mymail-userdata', true );
			
			echo trim((isset($userdata['firstname']) ? $userdata['firstname'] : '').' '.(isset($userdata['lastname']) ? $userdata['lastname'] : ''));
				
			break;
		case "lists":
		
			$list_obj = wp_get_object_terms($post->ID, 'newsletter_lists');
			if($list_obj){
				foreach($list_obj as $list){
					$lists[] = '<a href="edit-tags.php?action=edit&taxonomy=newsletter_lists&tag_ID='.$list->term_id.'&post_type=newsletter">'.$list->name.'</a>';
				}
				echo implode(', ', $lists);
				
			}else{
				_e('no lists selected', 'mymail');
			}
			break;
		case "emails":
			$count = 0;
			if ($campaigndata = get_post_meta( $post->ID, 'mymail-campaigns', true )) {
				foreach ($campaigndata as $campaign) {
					if (isset($campaign['sent'])) $count++;
				}
			}
			echo $count;
			break;
		case "status":
			$status = get_post_status_object($post->post_status);
			echo $status->label;
			break;
		}
	}


	public function restrict_manage_posts() {
		global $wp_query;
		$taxonomy = 'newsletter_lists';
		$taxonomy_obj = get_taxonomy($taxonomy);
		
		wp_dropdown_categories(array(
			'show_option_all' => sprintf(__("Show all %s", 'mymail'), $taxonomy_obj->label),
			'taxonomy' => $taxonomy,
			'name' => $taxonomy,
			'orderby' => 'name',
			'selected' => isset($wp_query->query['newsletter_lists']) ? $wp_query->query['newsletter_lists'] : '',
			'hierarchical' => false,
			'depth' => 1,
			'show_count' => true,
			'hide_empty' => true,
		));
	}
	
	public function convert_restrict($query) {
		$taxonomy = 'newsletter_lists';
		
		$q_vars = &$query->query_vars;
		if (isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
			
		}
	}
	
		
	public function updated_messages( $messages ) {

		global $post_id;
		global $post;

		if ($post->post_type != 'subscriber') return $messages;

		$messages['subscriber'] = array(
			0 => '',
			1 => __('Subscriber updated.', 'mymail'),
			2 => __('Custom field updated.', 'mymail'),
			3 => __('Custom field deleted.', 'mymail'),
			4 => __('Subscriber updated.', 'mymail'),
			5 => isset($_GET['revision']) ? sprintf( __('Subscriber restored to revision from %s', 'mymail'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('Subscriber updated.', 'mymail'), esc_url( get_permalink($post_id) ) ),
			7 => __('Subscriber saved.', 'mymail'),
			8 => sprintf( __('Subscriber submitted.', 'mymail'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_id) ) ) ),
			9 => 'Subscriber scheduled for: <strong>'.date_i18n( _x( 'M j, Y @ G:i', 'localized date format', 'mymail' ), strtotime( $post->post_date )).'</strong>.',
			10 => sprintf( __('Subscriber draft updated.', 'mymail'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_id) ) ) ),
		);

		return $messages;
	}


	public function remove_quick_edit( $actions ) {
		unset($actions['inline hide-if-no-js']);
		return $actions;
	}


	/*----------------------------------------------------------------------*/
	/* Meta Boxes
	/*----------------------------------------------------------------------*/



	public function add_meta_boxes() {
		add_meta_box('mymail_subscriber_submitdiv', __('Save', 'mymail'), array( &$this, 'subscriber_submitdiv' ), 'subscriber', 'side', 'high');
		add_meta_box('mymail_lists', __('Lists', 'mymail'), array( &$this, 'subscriber_lists'), 'subscriber', 'side', 'low');
		if(mymail_option('track_users')) add_meta_box('mymail_subscriber_meta', __('Meta', 'mymail'), array( &$this, 'subscriber_meta'), 'subscriber', 'side', 'low');
		add_meta_box('mymail_subscriber_data', __('Master Data', 'mymail'), array( &$this, 'subscriber_data' ), 'subscriber', 'normal', 'high');
		add_meta_box('mymail_subscriber_stats', __('Statistics', 'mymail'), array( &$this, 'subscriber_stats' ), 'subscriber', 'normal', 'low');
	}


	public function subscriber_submitdiv($post) {
		global $action;

		$post_type = $post->post_type;
		$post_type_object = get_post_type_object($post_type);
		$can_publish = current_user_can($post_type_object->cap->publish_posts);
		include MYMAIL_DIR.'/views/subscriber/submit.php';
	}


	public function subscriber_lists() {
		global $post;
		global $post_id;
		include MYMAIL_DIR . '/views/subscriber/lists.php';
	}
	
	public function subscriber_meta() {
		global $post;
		global $post_id;
		include MYMAIL_DIR . '/views/subscriber/meta.php';
	}


	public function subscriber_data() {
		global $post;
		include MYMAIL_DIR.'/views/subscriber/data.php';
	}


	public function subscriber_stats() {
		global $post;
		include MYMAIL_DIR.'/views/subscriber/stats.php';
	}



	/*----------------------------------------------------------------------*/
	/* Styles & Scripts
	/*----------------------------------------------------------------------*/


	public function admin_scripts_styles($hook) {

		global $post;
		if ( $post->post_type == 'subscriber' ) {
			if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
			
				wp_dequeue_script( 'autosave' );

				wp_enqueue_script('jquery');
				wp_register_script('mymail_subscriber-script', MYMAIL_URI.'/assets/js/subscriber-script.js', array('jquery'), MYMAIL_VERSION);
				wp_enqueue_script('mymail_subscriber-script');
				wp_register_style( 'mymail_subscriber-style', MYMAIL_URI . '/assets/css/subscriber-style.css', array( ), MYMAIL_VERSION );
				wp_enqueue_style( 'mymail_subscriber-style' );
				wp_localize_script( 'mymail_subscriber-script', 'mymailL10n', array(
						'invalid_email' => __( "this isn't a valid email address!", 'mymail' ),
						'email_exists' => __( "this email address allready exists!", 'mymail' ),
					) );
			}
		}
	}



	public function edit_style() {
	?>
	<style>
		.column-avatar{width:46px;}
		.column-emails{width:50px;text-align:right;}
		.column-status{width:100px;}
		.mymail-avatar-40{
			width:40px;
			height:40px;
			padding: 2px;
			border: 1px solid #D3D6DB;
			box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
			-moz-box-shadow: 0px 1px 3px rgba(0,0,0,0.1);
			-webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
			background-color: #FFF;
			background-position: center center;
			background-repeat: no-repeat;
			background-size: 40px 40px;
			margin-bottom: 4px;
		}
	</style>
	<?php
	}



	/*----------------------------------------------------------------------*/
	/* Save Methods
	/*----------------------------------------------------------------------*/



	public function wp_insert_post_data($data, $post) {

		if ($data['post_type'] != 'subscriber') return $data;
		
		$data['post_name'] = $this->hash($data['post_title']);
		$data['post_title'] = trim(strtolower($data['post_title']));

		if ($data['post_status'] == 'publish') $data['post_status'] = 'subscribed';
		if ($data['post_status'] == 'private') $data['post_status'] = 'unsubscribed';
		
		if (isset($_POST['unsubscribe']) && stripslashes($_POST['unsubscribe']) == __('Unsubscribe', 'mymail')) {

			$data['post_status'] = 'unsubscribed';

		} else if (isset($_POST['subscribe']) && stripslashes($_POST['subscribe']) == __('Subscribe', 'mymail')) {

			$data['post_status'] = 'subscribed';
				
		} else if (isset($_POST['hardbounce']) && stripslashes($_POST['hardbounce']) == __('Subscribe', 'mymail')) {

			$data['post_status'] = 'hardbounced';

		}
			
		mymail_clear_totals();

		return $data;

	}


	public function trigger_update_post_term_count( $terms = array() ) {
		
		if(empty($terms) || !is_array( $terms )){
			$terms = get_terms('newsletter_lists',array(
				'hide_empty' => false,
			));
			
			$terms = wp_list_pluck( $terms, 'term_taxonomy_id');
		}
		
		$taxonomy = get_taxonomy( 'newsletter_lists' );
			
		$this->update_post_term_count ( $terms, $taxonomy );
	}


	public function update_post_term_count( $terms, $taxonomy ) {
	
		global $wpdb;

		$object_types = (array) $taxonomy->object_type;

		foreach ( $object_types as &$object_type )
			list( $object_type ) = explode( ':', $object_type );

		$object_types = array_unique( $object_types );

		if ( $object_types )
			$object_types = esc_sql( array_filter( $object_types, 'post_type_exists' ) );

		foreach ( (array) $terms as $term ) {
			$count = 0;

			do_action( 'edit_term_taxonomy', $term, $taxonomy );
			if ( $object_types )
				$count += (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships, $wpdb->posts WHERE $wpdb->posts.ID = $wpdb->term_relationships.object_id AND post_status = 'subscribed' AND post_type IN ('" . implode("', '", $object_types ) . "') AND term_taxonomy_id = %d", $term ) );

			$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
			do_action( 'edited_term_taxonomy', $term, $taxonomy );
		}


	}


	public function save_post($post_id, $post) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		if ( $post->post_type != 'subscriber' )
			return $post_id;

		
		if(isset($_POST['original_post_status']) && $_POST['original_post_status'] == 'auto-draft' && in_array($post->post_status, array( 'subscribed' ))){
			do_action('mymail_subscriber_insert', $post_id);
		}
		
		if ( isset( $_POST['mymail_data'] ) ) {

			$save = array( );

			$save['firstname'] = esc_attr($_POST['mymail_data']['firstname']);
			$save['lastname'] = esc_attr($_POST['mymail_data']['lastname']);

			if ($customfield = mymail_option('custom_field')) {
				foreach ($customfield as $field => $data) {
					if (isset($_POST['mymail_data'][$field])) $save[$field] = esc_attr($_POST['mymail_data'][$field]);
				}
			}
			
			if(mymail_option('track_users')){

				(isset($_POST['mymail_data']['_meta']))
					? $save['_meta'] = $_POST['mymail_data']['_meta']
					: $save['_meta'] = array(
								'ip' => '',
								'signupip' => '',
								'signuptime' => time(),
								'confirmip' => '',
								'confirmtime' => time(),
								'lang' => false,
							);
			}

			$this->post_meta( $post_id, 'mymail-userdata', $save, true );


		}

	}


	/*----------------------------------------------------------------------*/
	/* Plugin Activation / Deactivation
	/*----------------------------------------------------------------------*/



	public function activate( ) {
		
		global $wpdb;
		
		if (is_network_admin() && is_multisite()) {
		
			$old_blog = $wpdb->blogid;
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
		
		}else{
		
			$blogids = array(false);
			
		}
		
		foreach ($blogids as $blog_id) {
		
			if($blog_id) switch_to_blog( $blog_id );
			
			$this->register_post_status();
			$this->register_post_type();
			
			if (!term_exists(__('Wordpress Users', 'mymail'), 'newsletter_lists'))
				wp_insert_term(__('Wordpress Users', 'mymail'), 'newsletter_lists', array('slug' => 'wordpress-users'));
			
			mymail_clear_totals();
			
		}
		
		if($blog_id) switch_to_blog($old_blog);
		
	}


	public function import_users( ) {

		$wp_users = $this->get_all_wp_users();

		if (!term_exists(__('Wordpress Users', 'mymail'), 'newsletter_lists')) wp_insert_term(__('Wordpress Users', 'mymail'), 'newsletter_lists', array('slug' => 'wordpress-users'));

		foreach ($wp_users as $user) {
			$this->insert($user->user_email, 'subscribed',  array(
				'firstname' => $user->first_name,
				'lastname' => $user->last_name,
				'_meta' => array(
					'ip' => mymail_get_ip(),
					'signupip' => mymail_get_ip(),
					'signuptime' => current_time('timestamp'),
					'confirmip' => mymail_get_ip(),
					'confirmtime' => current_time('timestamp'),
				)
			), mymail_option('newusers', array()), true, false );

		}

	}


	public function user_register($id) {

		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'register'){
			//stop if not option
			if(!isset($_POST['user_newsletter_signup'])) return false;
			
			$lists = mymail_option('register_signup_lists');
		
		}else{
		
			$lists = mymail_option('register_other_lists');
			
		}
		if (empty($lists)) return false;

		$user = get_userdata($id);
		$email = $user->data->user_email;
		
		$form_id = 0;
		$forms = mymail_option('forms');
		$form = isset($forms[$form_id]) ? $forms[$form_id] : $forms[0];
		
		$subscriber_exists = $this->get_by_mail($email);
		
		if($subscriber_exists && !mymail_option('update_subscribers')) return false;
		
		$first_name = get_user_meta( $id, 'first_name', true );
		$last_name = get_user_meta( $id, 'last_name', true );

		if (!$first_name) $first_name = $user->data->display_name;
		
		$double_opt_in = isset($form['double_opt_in']);
		
		if ($double_opt_in && !$subscriber_exists && mymail_option('register_other_confirmation')) {
		
			$baselink = get_permalink( mymail_option('homepage') );
			if(!$baselink) $baselink = site_url();
			
			$res = $this->send_confirmation(
					$baselink,
					$email,
					array(
						'firstname' => $first_name,
						'lastname' => $last_name,
					),
					$lists, false, $form['template'], $form_id );
					
		} else {

			$this->insert($user->user_email, 'subscribed',  array(
					'firstname' => $first_name,
					'lastname' => $last_name,
				), $lists, true );
				
		};
				

	}


	public function register_form( ) {
	?>
	<p><label for="user_newsletter_signup"><input name="user_newsletter_signup" type="checkbox" id="user_newsletter_signup" value="1" <?php checked( mymail_option('register_signup_checked') ); ?> /> <?php echo mymail_text('newsletter_signup'); ?></label><br><br></p>
	<?php
	}
	
	
	public function comment_form_checkbox( ) {
	
		$commenter = wp_get_current_commenter();
		
		if(!empty($commenter['comment_author_email'])){
			if($this->get_by_mail($commenter['comment_author_email'])) return false;
		}
		
		$field = '<p class="comment-form-newsletter-signup">';
		$field .= '<label for="mymail_newsletter_signup"><input name="newsletter_signup" type="checkbox" id="mymail_newsletter_signup" value="1" '.checked( mymail_option('register_comment_form_checked'), true, false ).'/> '.mymail_text('newsletter_signup').'</label>';
		$field .= '</p>';
		
		echo apply_filters( "comment_form_field_newsletter_signup", $field ) . "\n";
		
	}

	public function comment_post( $comment_ID, $comment_approved ) {
		
		if(isset($_POST['newsletter_signup']) && in_array($comment_approved.'', mymail_option('register_comment_form_status', array()))){
		
			$comment = get_comment($comment_ID);
			
			if(!$this->get_by_mail($comment->comment_author_email)){

			
				$lists = apply_filters('mymail_comment_post_lists', mymail_option('register_comment_form_lists', array()), $comment, $comment_approved );
				$user_data = apply_filters('mymail_comment_post_userdata', array('firstname' => $comment->comment_author), $comment, $comment_approved );
				
				mymail_subscribe( $comment->comment_author_email, $user_data, $lists );
				
			}
			
		}
	}


	/*----------------------------------------------------------------------*/
	/*
	/*----------------------------------------------------------------------*/

	public function subscriber_notification($id){
		
		if(defined('MYMAIL_DO_BULKIMPORT') && MYMAIL_DO_BULKIMPORT) return false;
		
		$subscriber = mymail_get_subscriber($id);
		
		if(!$subscriber) return false;
		
		$template = mymail_option('subscriber_notification_template', 'notification.html');
		
		$subject = __('A new user has subscribed to your newsletter!','mymail');
		
		$message = '<h4>'.sprintf(__('%s has joined', 'mymail'), '<a href="'.admin_url('post.php?post='.$id.'&action=edit').'">'.(($subscriber->fullname) ? $subscriber->fullname.' - ' : '').$subscriber->email.'</a>').'</h4>';
		
		$message .= '<table style="width:100%;table-layout:fixed">';
		
		$fields = array(
			'email' => mymail_text('email'),
			'firstname' => mymail_text('firstname'),
			'lastname' => mymail_text('lastname'),
		);
		if ($customfield = mymail_option('custom_field')) {
			foreach ($customfield as $field => $data) {
				$fields[$field] = $data['name'];
			}
		}
		foreach($fields as $fieldid => $field ){
			if(empty($subscriber->{$fieldid})) continue;
			$message .= '<tr><td height="20" style="border-top:1px solid #ccc;height:30px"><strong>'.$field.':</strong> '.$subscriber->{$fieldid}.'</td></tr>';
		}
		$message .= '<tr><td height="30" style="border-top:1px solid #ccc;height:30px"><strong>'.__('Lists', 'mymail').':</strong> '.(implode(', ', wp_list_pluck((array) $subscriber->_lists, 'name' ))).'</td></tr>';
		
		$message .= '</table>';
		
		
		$message = '<table style="width:100%;table-layout:fixed"><tr><td width="80" valign="top" align="right"><a href="'.admin_url('post.php?post='.$id.'&action=edit').'"><img src="'.$this->get_gravatar_uri($subscriber->email, 80).'" width="80" height="80"></a></td><td width="24">&nbsp;</td><td valign="top">'.$message.'</td></tr></table>';

		$loc = mymail_ip2City();
		if($loc != 'unknown'){
			$message .= '<table style="width:100%;table-layout:fixed">';
			$message .= '<tr><td colspan="2">&nbsp;</td></tr><tr><td><img src="https://maps.googleapis.com/maps/api/staticmap?markers='.$loc->latitude.','.$loc->longitude.'&zoom=4&size=276x200&visual_refresh=true&sensor=false" width="276"></td><td><img src="https://maps.googleapis.com/maps/api/staticmap?markers='.$loc->latitude.','.$loc->longitude.'&zoom=8&size=276x200&visual_refresh=true&sensor=false" width="276"></td></tr><tr><td colspan="2">&nbsp;</td></tr>';
			$message .= '</table>';
		}
		
		$subject = apply_filters('subscriber_notification_subject', $subject, $subscriber);
		$message = apply_filters('subscriber_notification_message', $message, $subscriber);
		$template = apply_filters('subscriber_notification_template', $template, $subscriber);
		
		$replace = (array) $subscriber;
		
		if(isset($replace['_meta'])) unset($replace['_meta']);
		if(isset($replace['_lists'])) unset($replace['_lists']);

		return mymail_send( $subject, 
			$message,
			explode(',', mymail_option('subscriber_notification_receviers')), $replace, array(),
			$template
		);
		
	}
	

	public function add_new($type = 'sub', $dayoffset = 0) {

		$counts = get_option( 'mymail_subscribers_count', array() );
		$today = floor(current_time('timestamp')/86400)-$dayoffset;

		if (!isset($counts[$today]))
			$counts[$today] = array('sub' => 0, 'unsub' => 0, 'click' => 0);

		$counts[$today][$type]++;
		
		return update_option( 'mymail_subscribers_count', $counts );

	}


	public function get_gravatar_uri($email, $size = 120) {
		$email = strtolower( trim( $email ) );
		$hash = md5( $email );
		//create a number from 01 to 09 based on the email address
		$id = '0'.(round(abs(crc32 ( $hash ))%9)+1);
		$default = MYMAIL_URI.'/assets/img/icons/user'.$id.'.png';
		
		$image = get_avatar( $email, $size, $default );
		preg_match("#src='([^']+)'#", $image, $match);
		
		if(!empty($match[1])){
			$url = $match[1];
		}else{
			$url = (is_ssl() ? 'https' : 'http')."://". ($id%2). "gravatar.com/avatar/" . $hash . "?d=" . urlencode( $default ) . "&s=".$size;
		}
		return $url;
	}


	/*----------------------------------------------------------------------*/
	/* Privates
	/*----------------------------------------------------------------------*/

	
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


	private function hash( $str ) {
		for ($i = 0; $i < 10; $i++) {
			$str = sha1( $str );
		}
		return md5($str);
	}


	private function post_meta( $post_id, $meta_key, $data, $unique = false ) {

		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If a new meta value was added and there was no previous value, add it. */
		if ( $data && '' == $meta_value ) {
			add_post_meta( $post_id, $meta_key, $data, true );
			/* If the new meta value does not match the old value, update it. */
		} elseif ( $data && $data != $meta_value ) {
			update_post_meta( $post_id, $meta_key, $data );
			/* If there is no new meta value but an old value exists, delete it. */
		} elseif ( '' == $data && $meta_value ) {
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}
	}


}


?>