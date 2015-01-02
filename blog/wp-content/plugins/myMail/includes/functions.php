<?php

function mymail_option($option, $fallback = NULL) {
	global $mymail_options;
	return isset($mymail_options[$option]) ? $mymail_options[$option] : $fallback;
	//return apply_filters('mymail_option', (isset($mymail_options[$option]) ? $mymail_options[$option] : $fallback), $option, $fallback);
}


function mymail_options() {
	global $mymail_options;
	return $mymail_options;
}


function mymail_text($option, $fallback = '') {
	$text = mymail_option('text');
	return apply_filters('mymail_text', (isset($text[$option]) ? $text[$option] : $fallback), $option, $fallback);
}


function mymail_update_option( $option, $value ) {
	global $mymail_options;
	$mymail_options[$option] = $value;
	update_option('mymail_options', $mymail_options);
}


function mymail_send( $headline, $content, $to = '', $replace = array(), $attachments = array(), $template = 'notification.html', $headers = NULL ) {

	if(empty($to)){
		$current_user = wp_get_current_user();
		$to = $current_user->user_email;	
	}
	
	
	$defaults = array('notification' => '');
	
	$replace = apply_filters( 'mymail_send_replace', wp_parse_args( $replace, $defaults ) );
	
	require_once MYMAIL_DIR . '/classes/mail.class.php';

	$mail = mymail_mail::get_instance();
	
	//extract the header if it's allready Mimeencoded
	if(!empty($headers)){
		if(is_string($headers)){
			$headerlines = explode("\n", trim($headers));
			foreach($headerlines as $header){
				$parts = explode(':', $header, 2);
				$key = trim($parts[0]);
				$value = trim($parts[1]);
				
				//if fom is set, use it!
				if('from' == strtolower($key)){
					if(preg_match('#(.*)?<([^>]+)>#',$value, $matches)){
						$mail->from = trim($matches[2]);
						$mail->from_name = trim($matches[1]);
					}else{
						$mail->from = $value;
						$mail->from_name = '';
					}
				}else if(!in_array(strtolower($key), array('content-type'))){
					$mail->headers[$key] = trim($value);
				}
			}
		}else if(is_array($headers)){
			foreach($headers as $key => $value){
				$mail->mailer->addCustomHeader($key, $value);
			}
		}
	}
	
	$mail->to = $to;
	$mail->subject = $headline;
	$mail->attachments = $attachments;
	
	return $mail->send_notification( $content, $headline, $replace, false, $template );
}


function mymail_wp_mail($to, $subject, $message, $headers = '', $attachments = array(), $template = 'notification.html' ){
	return mymail_send( $subject, $message, $to, array(), $attachments, $template, $headers );
}

function mymail_send_campaign_to_subscriber( $campaign, $subscriber, $track = false, $forcesend = false, $force = false ) {

	global $mymail;
	
	return $mymail->send_campaign_to_subscriber( $campaign, $subscriber, $track, $forcesend, $force );

}


function mymail_form( $id = 0, $tabindex = 100, $echo = true, $classes = '' ) {
	require_once MYMAIL_DIR.'/classes/form.class.php';

	
	$mymail_form = new mymail_form();
	$form = $mymail_form->form($id, $tabindex, $classes);
	
	if ($echo) {
		echo $form;
	} else {
		return $form;
	}
}


function mymail_get_active_campaigns( $args = '' ) {
	$defaults = array(
		'post_status' => 'active',
	);
	$r = wp_parse_args( $args, $defaults );

	return mymail_get_campaigns ($r);
}


function mymail_get_paused_campaigns( $args = '' ) {
	$defaults = array(
		'post_status' => 'paused',
	);
	$r = wp_parse_args( $args, $defaults );

	return mymail_get_campaigns ($r);
}


function mymail_get_queued_campaigns( $args = '' ) {
	$defaults = array(
		'post_status' => 'queued',
	);
	$r = wp_parse_args( $args, $defaults );

	return mymail_get_campaigns ($r);
}


function mymail_get_draft_campaigns( $args = '' ) {
	$defaults = array(
		'post_status' => 'draft',
	);
	$r = wp_parse_args( $args, $defaults );

	return mymail_get_campaigns ($r);
}


function mymail_get_finished_campaigns( $args = '' ) {
	$defaults = array(
		'post_status' => 'finished',
	);
	$r = wp_parse_args( $args, $defaults );

	return mymail_get_campaigns ($r);
}


function mymail_get_pending_campaigns( $args = '' ) {
	$defaults = array(
		'post_status' => 'pending',
	);
	$r = wp_parse_args( $args, $defaults );

	return mymail_get_campaigns ($r);
}

function mymail_get_autoresponder_campaigns( $args = '' ) {
	$defaults = array(
		'post_status' => 'autoresponder',
	);
	$r = wp_parse_args( $args, $defaults );

	return mymail_get_campaigns ($r);
}


function mymail_get_campaigns( $args = '' ) {
	$defaults = array(
		'post_type' => 'newsletter',
		'post_status' => 'any',
		'orderby' => 'modified',
		'order' => 'DESC',
		'posts_per_page' => -1,
	);
	$r = wp_parse_args( $args, $defaults );

	$query = new WP_Query( $r );
	return $query->posts;
}


function mymail_list_newsletter( $args = '' ) {
	$defaults = array(
		'title_li' => __('Newsletters', 'mymail'),
		'post_type' => 'newsletter',
		'post_status' => array('finished', 'active'),
		'echo' => 1,
	);
	$r = wp_parse_args( $args, $defaults );

	extract( $r, EXTR_SKIP );

	$output = '';

	// sanitize, mostly to keep spaces out
	$r['exclude'] = preg_replace('/[^0-9,]/', '', $r['exclude']);

	// Allow plugins to filter an array of excluded pages (but don't put a nullstring into the array)
	$exclude_array = ( $r['exclude'] ) ? explode(',', $r['exclude']) : array();
	$r['exclude'] = implode( ',', apply_filters('mymail_list_newsletter_excludes', $exclude_array) );

	$newsletters = get_posts($r);

	if ( !empty($newsletters) ) {
		if ( $r['title_li'] )
			$output .= '<li class="pagenav">' . $r['title_li'] . '<ul>';

		foreach ($newsletters as $newsletter) {
			$output .= '<li class="newsletter_item newsletter-item-'.$newsletter->ID.'"><a href="'.get_permalink($newsletter->ID).'">'.$newsletter->post_title.'</a></li>';
		}

		if ( $r['title_li'] )
			$output .= '</ul></li>';
	}

	$output = apply_filters('mymail_list_newsletter', $output, $r);

	if ( $r['echo'] )
		echo $output;
	else
		return $output;
}


function mymail_ip2Country( $ip = '', $get = 'code' ) {

	if (!mymail_option('trackcountries')) return 'unknown';

	try{

		
		if ( empty($ip) ) 
			$ip = mymail_get_ip( );
	
		require_once  MYMAIL_DIR.'/classes/libs/Ip2Country.php';
		$i = new Ip2Country();
		$code = $i->get($ip, $get);
		
		if(!$code){
			$code = mymail_ip2City($ip, $get ? 'country_'.$get : NULL);
		}
		return ($code) ? $code : 'unknown';
		
	} catch (Exception $e) {
		return 'error';
	}
}

function mymail_ip2City( $ip = '', $get = NULL ) {

	if (!mymail_option('trackcities')) return 'unknown';

	try{

		if ( empty($ip) )
			$ip = mymail_get_ip( );
	
		require_once  MYMAIL_DIR.'/classes/libs/Ip2City.php';
		$i = new Ip2City();
		$code = $i->get($ip, $get);
	
		return ($code) ? $code : 'unknown';
		
	} catch (Exception $e) {
		return 'error';
	}

}


function mymail_get_ip( ) {
	$ip = '';
	foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
		if (array_key_exists($key, $_SERVER) === true){
			foreach (explode(',', $_SERVER[$key]) as $ip){
				$ip = trim($ip); // just to be safe

				if (mymail_validate_ip($ip)){
					return $ip;
				}
			}
		}
	}	
	return $ip;
}


function mymail_validate_ip($ip) {
	if (strtolower($ip) === 'unknown')
		return false;
 
	// generate ipv4 network address
	$ip = ip2long($ip);
 
	// if the ip is set and not equivalent to 255.255.255.255
	if ($ip !== false && $ip !== -1) {
		// make sure to get unsigned long representation of ip
		// due to discrepancies between 32 and 64 bit OSes and
		// signed numbers (ints default to signed in PHP)
		$ip = sprintf('%u', $ip);
		// do private network range checking
		if ($ip >= 0 && $ip <= 50331647) return false;
		if ($ip >= 167772160 && $ip <= 184549375) return false;
		if ($ip >= 2130706432 && $ip <= 2147483647) return false;
		if ($ip >= 2851995648 && $ip <= 2852061183) return false;
		if ($ip >= 2886729728 && $ip <= 2887778303) return false;
		if ($ip >= 3221225984 && $ip <= 3221226239) return false;
		if ($ip >= 3232235520 && $ip <= 3232301055) return false;
		if ($ip >= 4294967040) return false;
	}
	return true;
}

function mymail_get_lang( $fallback = false ) {

	return isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtolower(substr(trim($_SERVER['HTTP_ACCEPT_LANGUAGE']), 0, 2)) : $fallback;

}


function mymail_subscribe( $email, $userdata = array(), $lists = array(), $double_opt_in = NULL, $overwrite = true, $mergelists = NULL, $template = 'notification.html') {

	global $mymail_subscriber;
	
	return $mymail_subscriber->subscribe( $email, $userdata, $lists, $double_opt_in, $overwrite, $mergelists, $template );
	
}

//users email, hash or ID
function mymail_unsubscribe( $email_hash_id, $campaign_id = NULL, $logit = true ) {
	global $mymail_subscriber;
	
	return $mymail_subscriber->unsubscribe($email_hash_id, $campaign_id, $logit);
}



function mymail_get_subscribed_subscribers( $args = '' ) {
	$defaults = array(
		'post_status' => 'subscribed',
	);
	$r = wp_parse_args( $args, $defaults );

	return mymail_get_subscribers ($r);
}


function mymail_get_unsubscribed_subscribers( $args = '' ) {
	$defaults = array(
		'post_status' => 'unsubscribed',
	);
	$r = wp_parse_args( $args, $defaults );

	return mymail_get_subscribers ($r);
}


function mymail_get_hardbounced_subscribers( $args = '' ) {
	$defaults = array(
		'post_status' => 'hardbounced',
	);
	$r = wp_parse_args( $args, $defaults );

	return mymail_get_subscribers ($r);
}


function mymail_get_subscribers( $args = array() ) {
	$defaults = array(
		'post_type' => 'subscriber',
		'post_status' => 'subscribed',
		'orderby' => 'modified',
		'order' => 'ASC',
		'posts_per_page' => -1,
	);
	$args = wp_parse_args( $args, $defaults );

	$query = new WP_Query( $args );

	return $query->posts;
}


function mymail_get_subscribers_emails( $status = 'subscribed' ) {

	global $wpdb;
	
	$sql = "SELECT post_title as email FROM $wpdb->posts WHERE post_type = 'subscriber'";
	
	if($status != 'any'){
		if(!is_array($status)) $status = array($status);
		$sql .= " AND post_status = ('".implode(' OR ', $status)."')";
	}
	$result = $wpdb->get_col($sql);
	
	return $result;
	
}


function mymail_get_new_subscribers( ) {
	if ($t = mymail_option('subscribers_count')) {
		return $t['new'];
	};
	return 0;
}


function mymail_get_new_unsubscribers( ) {

	if ($t = mymail_option('subscribers_count')) {
		return $t['unsub'];
	};
	return 0;
}

function mymail_clear_totals( $lists = '' , $optimize = false) {

	$totals = array();
	
	if(!empty($lists)){
		
		if($totals = get_transient( 'mymail_totals' )){
		
			$ids = array();
			foreach($lists as $list){
				$term = get_term_by('slug', $list, 'newsletter_lists');
				
				$id[] = $term->term_id;
				foreach($totals as $key => $value){
					if(strpos($key, '_'.$term->term_id)) unset($totals[$key]);
				}
				
			}
			
		}
		
	}
	set_transient( 'mymail_totals' , $totals );
	return true;
	
}

function mymail_clear_cache( $part = '' , $optimize = false) {

	global $wpdb;
	$wpdb->query("DELETE FROM `$wpdb->options` WHERE `$wpdb->options`.`option_name` LIKE '_transient_timeout_mymail_".$part."%'");
	$wpdb->query("DELETE FROM `$wpdb->options` WHERE `$wpdb->options`.`option_name` LIKE '_transient_mymail_".$part."%'");
	//optimize DB
	if($optimize) $wpdb->query("OPTIMIZE TABLE `$wpdb->options`");
	return true;
	
}

function mymail_notice($text, $type = '', $once = false, $key = NULL){
	
	if(!$type) $type = 'updated';
	
	global $mymail_notices;
	
	$mymail_notices = get_option( 'mymail_notices' , array());
	
	$key = (!$key) ? uniqid('mymail_') : 'mymail_'.$key;

	$mymail_notices[$key] = array(
		'text' => $text,
		'type' => $type,
		'once' => $once,
	);

	update_option( 'mymail_notices', $mymail_notices );
	
	return $key;
	
}


function mymail_remove_notice($key){
	
	global $mymail_notices;
	
	$mymail_notices = get_option( 'mymail_notices' , array());
	
	if(isset($mymail_notices['mymail_'.$key])) {
		unset($mymail_notices['mymail_'.$key]);
		return update_option( 'mymail_notices', $mymail_notices );
	}
	
	return false;
	
}

function mymail_is_email($email){

	// First, we check that there's one @ symbol, and that the lengths are right
	if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
			// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
			return false;
	}
	// Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
			if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
				 return false;
			}
	}
	if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) {
				 return false; // Not enough parts to domain
			}
			for ($i = 0; $i < sizeof($domain_array); $i++) {
				 if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
					return false;
				 }
			}
	}

	return true;
	
}

function mymail_get_subscriber($id_email_or_hash, $type = null){
	global $mymail_subscriber;
	
	$id_email_or_hash = trim($id_email_or_hash);
	
	if(!is_null($type)){
		if($type == 'email'){
			return $mymail_subscriber->get_by_mail($id_email_or_hash);
		}else if($type == 'hash'){
			return $mymail_subscriber->get_by_hash($id_email_or_hash);
		}
	}
	
	if(is_numeric($id_email_or_hash)){
		return $mymail_subscriber->get($id_email_or_hash);
	}else if(preg_match('#[0-9a-f]{32}#', $id_email_or_hash)){
		return $mymail_subscriber->get_by_hash($id_email_or_hash);
	}else if(mymail_is_email($id_email_or_hash)){
		return $mymail_subscriber->get_by_mail($id_email_or_hash);
	}
	return false;
}

function mymail_add_tag($tag, $callbackfunction){

	if(is_array($callbackfunction)){
	
		if(!method_exists($callbackfunction[0], $callbackfunction[1])) return false;

	}else{
	
		if(!function_exists($callbackfunction)) return false;
		
	}
	
	global $mymail_mytags;
	
	if(!isset($mymail_mytags)) $mymail_mytags = array();
		
	$mymail_mytags[$tag] = $callbackfunction;
		
	return true;
	
}

function mymail_remove_tag($tag){

	global $mymail_mytags;
	
	if(isset($mymail_mytags[$tag])) unset($mymail_mytags[$tag]);
		
	return true;
	
}

function mymail_add_style($callbackfunction){

	if(is_array($callbackfunction)){
	
		if(!method_exists($callbackfunction[0], $callbackfunction[1])) return false;

	}else{
	
		if(!function_exists($callbackfunction)) return false;
		
	}
	
	global $mymail_mystyles;
	
	if(!isset($mymail_mystyles)) $mymail_mystyles = array();
	
	$args = func_get_args();
	$args = array_slice($args, 1);
		
	$mymail_mystyles[] = call_user_func_array($callbackfunction, $args);
		
	return true;
	
}


function mymail_require_filesystem($redirect = '', $method = '', $showform = true) {
	
	global $wp_filesystem;
	
	if (!function_exists( 'request_filesystem_credentials' )){
		
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		
	}
	
	ob_start();
	
	if ( false === ($credentials = request_filesystem_credentials($redirect, $method)) ) {
		$data = ob_get_contents();
		ob_end_clean();
		if ( ! empty($data) ){
			include_once( ABSPATH . 'wp-admin/admin-header.php');
			echo $data;
			include( ABSPATH . 'wp-admin/admin-footer.php');
			exit;
		}
		return false;
	}
	
	if(!$showform){
		return false;
	}

	
	if ( ! WP_Filesystem($credentials) ) {
		request_filesystem_credentials($redirect, $method, true); // Failed to connect, Error and request again
		$data = ob_get_contents();
		ob_end_clean();
		if ( ! empty($data) ) {
			include_once( ABSPATH . 'wp-admin/admin-header.php');
			echo $data;
			include( ABSPATH . 'wp-admin/admin-footer.php');
			exit;
		}
		return false;
	}
	
	return true;

}

if(!function_exists('http_negotiate_language')) :
function http_negotiate_language( $supported, $http_accept_language = 'auto' ) {
	
	if ($http_accept_language == "auto") $http_accept_language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : ''; 

	preg_match_all("/([[:alpha:]]{1,8})(-([[:alpha:]|-]{1,8}))?" . 
				"(\s*;\s*q\s*=\s*(1\.0{0,3}|0\.\d{0,3}))?\s*(,|$)/i", 
				$http_accept_language, $hits, PREG_SET_ORDER); 

	// default language (in case of no hits) is the first in the array 
	$bestlang = $supported[0]; 
	$bestqval = 0; 

	foreach ($hits as $arr) { 
		// read data from the array of this hit 
		$langprefix = strtolower ($arr[1]); 
		if (!empty($arr[3])) { 
			$langrange = strtolower ($arr[3]); 
			$language = $langprefix . "-" . $langrange; 
		} 
		else $language = $langprefix; 
		$qvalue = 1.0; 
		if (!empty($arr[5])) $qvalue = floatval($arr[5]); 
	  
		// find q-maximal language  
		if (in_array($language,$supported) && ($qvalue > $bestqval)) { 
			$bestlang = $language; 
			$bestqval = $qvalue; 
		} 
		// if no direct hit, try the prefix only but decrease q-value by 10% (as http_negotiate_language does) 
		else if (in_array($langprefix,$supported) && (($qvalue*0.9) > $bestqval)) { 
			$bestlang = $langprefix; 
			$bestqval = $qvalue*0.9; 
		} 
	}
	
	return $bestlang;

}
endif;



?>