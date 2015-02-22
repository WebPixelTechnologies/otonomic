<?php
/************
In getUserDataTwitter.php
************/
require_once('twitteroauth-master/twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', 'F5mbOOnXXliK7zEUXt0wg');
define('CONSUMER_SECRET', 'd2jNP2PYZBS8SxEwnwhLR2y0peS64BS8OTRgXLBG8');
// define('OAUTH_CALLBACK', '/plugins/admin_panel/lib/socialmedia/twitteroauth-master/callback.php');
define('OAUTH_CALLBACK', '/wp-content/mu-plugins/otonomic-first-session/includes/admin_panel/lib/socialmedia/twitteroauth-master/callback.php');

//Access Token for Twitter, Fixed Access Token against an App for an User, Please Change it according to Twitter App and User
$access_token = array('oauth_token' => '631809411-ojn20dCQiKo6ILwSYjOV4uWS4rddG6UHmiQS5XQ6', 'oauth_token_secret' => 'rpwvVxxlGNJXX9bUrOOw387Wi6jdKHfGK1RCw0HqOEMwx', 'user_id' => '631809411', 'screen_name' => 'koolkallol');

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$content_tweet = $connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json?user_id='.$_GET['user_id'].'&screen_name='.$_GET['screen_name']."&page=1");

//Twitter User Search JSON
$twitter_user_tweet_json = json_encode($content_tweet);
echo $twitter_user_tweet_json;