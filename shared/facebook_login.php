<?php 

require_once 'facebook_connect_config.php';
require_once 'facebook-php-sdk/facebook.php';

$facebook = new Facebook(array(
  'appId'  => FACEBOOK_APP_ID,
  'secret' => FACEBOOK_SECRET_KEY,
));

// Get User ID
$user = $facebook->getUser();
if ($user) {
	//$logoutUrl = $facebook->getLogoutUrl();
    header('Location: '.NEXT_PAGE_URL);exit;
} else {
	$loginUrl = $facebook->getLoginUrl(array('redirect_uri' => NEXT_PAGE_URL, 'scope' => 'manage_pages,email,offline_access'));
	header('Location: '.$loginUrl);exit;
}
?>