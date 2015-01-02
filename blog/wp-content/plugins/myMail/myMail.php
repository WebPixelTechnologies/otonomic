<?php 
/*
Plugin Name: MyMail - Email Newsletter Plugin for WordPress
Plugin URI: http://revaxarts-themes.com/?t=mymail
Plugin Slug: myMail/myMail.php
Description: advanced Newsletter Plugin for WordPress. Create, Send and Track your Newsletter Campaigns
Version: 1.6.6.3
Author: revaxarts.com
Author URI: http://revaxarts.com
Text Domain: mymail
*/

define('MYMAIL_VERSION', '1.6.6.3');
define('MYMAIL_DIR', WP_PLUGIN_DIR.'/myMail');
define('MYMAIL_URI', plugins_url().'/myMail');
define('MYMAIL_SLUG', 'myMail/myMail.php');

$upload_folder = wp_upload_dir();

define('MYMAIL_UPLOAD_DIR', trailingslashit( $upload_folder['basedir'] ) . 'myMail');
define('MYMAIL_UPLOAD_URI', trailingslashit( $upload_folder['baseurl'] ) . 'myMail');

require_once MYMAIL_DIR.'/includes/functions.php';
require_once MYMAIL_DIR.'/classes/mymail.class.php';
require_once MYMAIL_DIR.'/classes/settings.class.php';
require_once MYMAIL_DIR.'/classes/subscriber.class.php';
require_once MYMAIL_DIR.'/classes/manage.class.php';
require_once MYMAIL_DIR.'/classes/templates.class.php';
require_once MYMAIL_DIR.'/classes/widget.class.php';
require_once MYMAIL_DIR.'/classes/autoresponder.class.php';
require_once MYMAIL_DIR.'/classes/shortcodes.class.php';

global $mymail_options, $mymail, $mymail_subscriber, $mymail_templates, $mymail_settings, $mymail_manage, $mymail_autoresponder, $mymail_notices, $mymail_mytags, $mymail_mystyles;

$mymail_options = get_option( 'mymail_options', array() );

$mymail = new mymail();

$mymail_subscriber = new mymail_subscriber();

$mymail_templates = new mymail_templates();

$mymail_autoresponder = new mymail_autoresponder();

$mymail_manage = new mymail_manage();

$mymail_settings = new mymail_settings();

add_action( 'widgets_init', create_function( '', 'register_widget( "mymail_signup" );register_widget( "mymail_list_newsletter" );' ) );

if(mymail_option('system_mail')){

	if(function_exists('wp_mail')){
	
		function mymail_wpmail_notice(){
			echo '<div class="error"><p>function <strong>wp_mail</strong> already exists from a different plugin! Please disable it before using MyMails wp_mail alternative!</p></div>';
		}
		add_action('admin_notices', 'mymail_wpmail_notice');
		
	}else{
		
		function wp_mail( $to, $subject, $message, $headers = '', $attachments = array() ) {
			
			if(is_array($headers)) $headers = implode("\r\n", $headers)."\r\n";
			//only if content type is not html
			if(!preg_match('#content-type:(.*)text/html#i', $headers)){
				$message = str_replace(array('<br>', '<br />', '<br/>'), "\n", $message);
				$message = preg_replace('/(?:(?:\r\n|\r|\n)\s*){2}/s', "\n", $message);
				$message = wpautop($message, true);
			}
			$template = mymail_option('system_mail_template', 'notification.html');
			if(!is_array($attachments)) $attachments = array($attachments);
			return mymail_wp_mail( $to, $subject, $message, $headers, $attachments, $template );
		
		}
		
		
		function mymail_password_reset_link_fix($message, $key){
			$str = network_site_url("wp-login.php?action=rp&key=$key");
			
			return str_replace('<'.$str, $str, $message);
			
		}
		
		add_filter('retrieve_password_message', 'mymail_password_reset_link_fix', 10, 2);

	}
}


//Update Class
if(!class_exists('Envato_Plugin_Update'))
	require_once MYMAIL_DIR.'/classes/update.class.php';

Envato_Plugin_Update::add(mymail_option('purchasecode'), array(
	'remote_url' => "http://update.revaxarts-themes.com",
	'version' => MYMAIL_VERSION,
	'plugin_slug' => MYMAIL_SLUG,
));



/*
function my_attachment($element){
	$path = 'path_to_file.pdf';
	$element->attachments = array('filename.pdf' => $path);
}
add_action('mymail_presend','my_attachment' );

function change_signup_location(){
	global $mymail_subscriber;
	remove_action('comment_form_logged_in_after' , array( $mymail_subscriber, 'comment_form_checkbox' ) );
	remove_action('comment_form_after_fields' , array( $mymail_subscriber, 'comment_form_checkbox' ) );
	add_action('comment_form_after' , array( $mymail_subscriber, 'comment_form_checkbox' ) );
}

add_action('init','change_signup_location', 99 );


//	adding a custom style to every mail

/*
function mystyle_function($color = 'black'){
	return 'a{color:'.$color.' !important}';
}
mymail_add_style('mystyle_function', 'red');


//	adding a dynamic tags
//	use: {mytag:option|fallback}

/*
function mytag_function($option, $fallback, $campaignID = NULL, $subscriberID = NULL){
	return 'My Tag: Option: '.$option."; Fallback: ".$fallback."; campaign ID: ".$campaignID."; subscriber ID: ".$subscriberID."<br>";
}
mymail_add_tag('mytag', 'mytag_function');


//	new error on form submit

/*
function mymail_submit_errors($errors){
	$errors[] = 'new error';
	return  $errors;
}
add_filter( 'mymail_submit_errors', 'mymail_submit_errors' );

*
//	adding additional form elements

/*

function mymail_form_fields($fields, $formid, $form){
	$pos = count($fields) - 1;
	$fields = array_slice($fields, 0, $pos, true) +
	array("fieldID" => "Fieldcontent") +
	array_slice($fields, $pos, count($fields) - 1, true) ;
	return $fields;
}
add_filter( 'mymail_form_fields', 'mymail_form_fields', 10, 3 );


//	adding salutation based on gender

function mymail_define_salutation ($id){
	
	$user_data = get_post_meta( $id, 'mymail-userdata', true );
	if(!$user_data) return false;
	
	if($user_data['gender'] == 'male'){
		$user_data['salutation'] = "Sehr geehrter Herr";
	}else if($user_data['gender'] == 'female'){
		$user_data['salutation'] = "Sehr geehrte Frau";
	}else{
		$user_data['salutation'] = "Hallo";
	}
	
	update_post_meta( $id, 'mymail-userdata', $user_data );
	
	
}
add_action('mymail_subscriber_insert', 'mymail_define_salutation');

later
	add_action( 'profile_update', 'my_profile_update', 10, 2 );

	function my_profile_update( $user_id, $old_user_data ) {
		
		$user_info = get_userdata($user_id);
		$subscriber = mymail_get_subscriber($old_user_data->user_email, 'email');
		if($subscriber){
			
			global $mymail_subscriber;
			
			$userdata = $subscriber;
			
			$usermeta = get_user_meta($user_id);
			unset($userdata->ID);
			unset($userdata->email);
			unset($userdata->hash);
			unset($userdata->status);
			unset($userdata->fullname);
			unset($userdata->_lists);
			
			$userdata->firstname = !empty($usermeta['first_name']) ? $usermeta['first_name'][0] : $userdata->firstname;
			$userdata->lastname = !empty($usermeta['last_name']) ? $usermeta['last_name'][0] : $userdata->lastname;
			
			if($old_user_data->user_email == $user_info->data->user_email){
 				$ID = $mymail_subscriber->insert($user_info->data->user_email, $subscriber->status, $userdata, array(), true, false, true);
			}
		}
	}

*/



add_action('widgets_init', 'add_concerned_user');
function add_concerned_user()
{
	// $concerned_user_list = get_term_by('slug', 'concerned-user', 'newsletter_lists');
	// mymail_subscribe('io+a1@neuronq.ro', ['custom' => 42], [$concerned_user_list]);
}

?>