<script src="js/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
var searchval = $('#search_box').val();
function searchUsernameTwitter(){
        $.get("searchUsernameTwitter.php?search_box="+searchval, function(data){
	        //searchUsernameTwitter JSON(data)
        });
}
function getUserDataTwitter(user_id,screen_name) {
        $.get("getUserDataTwitter.php?user_id="+user_id+"&screen_name="+screen_name, function(data){
	        //getUserDataTwitter JSON(data)
        });
}
function searchUsernameInstagram(){
        $.get("searchUsernameInstagram.php?search_box="+searchval, function(data){
	        //searchUsernameInstagram JSON(data)
        });
}
function getUserDataInstagram(user_id){
        $.get("getUserDataInstagram.php?user_id="+user_id, function(data){
	        //getUserDataInstagram JSON(data)
        });
}
function searchUsernameYoutube(){
        $.get("searchUsernameYoutube.php?search_box="+searchval, function(data){
	        //searchUsernameYoutube JSON(data)
        });
}
function getUserDataYoutube(user_url){
        $.get("getUserDataYoutube.php?user_url="+user_url, function(data){
	        //getUserDataYoutube JSON(data)
        });
}
</script>




<?php
/************
In searchUsernameTwitter.php
************/
$reqdata = urlencode(strtolower($_GET['search_box']));
require_once('twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', 'F5mbOOnXXliK7zEUXt0wg');
define('CONSUMER_SECRET', 'd2jNP2PYZBS8SxEwnwhLR2y0peS64BS8OTRgXLBG8');
define('OAUTH_CALLBACK', 'http://voip.aqbsolutions.com/socialmedia/twitteroauth-master/callback.php');

//Access Token for Twitter, Fixed Access Token against an App for an User, Please Change it according to Twitter App and User
$access_token = array('oauth_token' => '631809411-ojn20dCQiKo6ILwSYjOV4uWS4rddG6UHmiQS5XQ6', 'oauth_token_secret' => 'rpwvVxxlGNJXX9bUrOOw387Wi6jdKHfGK1RCw0HqOEMwx', 'user_id' => '631809411', 'screen_name' => 'koolkallol');

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$content = $connection->get('https://api.twitter.com/1.1/users/search.json?q='.$reqdata."&page=1");
        
//Twitter User Search JSON
$twitter_user_json = json_encode($content);

//Get an user id and screen name for function getUserDataTwitter
$user_id = $twitter_user_json[/*data_no*/]['id'];
$screen_name = $twitter_user_json[/*data_no*/]['scree_nname'];




/************
In getUserDataTwitter.php
************/
require_once('twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', 'F5mbOOnXXliK7zEUXt0wg');
define('CONSUMER_SECRET', 'd2jNP2PYZBS8SxEwnwhLR2y0peS64BS8OTRgXLBG8');
define('OAUTH_CALLBACK', 'http://voip.aqbsolutions.com/socialmedia/twitteroauth-master/callback.php');

//Access Token for Twitter, Fixed Access Token against an App for an User, Please Change it according to Twitter App and User
$access_token = array('oauth_token' => '631809411-ojn20dCQiKo6ILwSYjOV4uWS4rddG6UHmiQS5XQ6', 'oauth_token_secret' => 'rpwvVxxlGNJXX9bUrOOw387Wi6jdKHfGK1RCw0HqOEMwx', 'user_id' => '631809411', 'screen_name' => 'koolkallol');

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$content_tweet = $connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json?user_id='.$_GET['user_id'].'&screen_name='.$_GET['screen_name']."&page=1");
        
//Twitter User Search JSON
$twitter_user_tweet_json = json_encode($content_tweet);




/************
In searchUsernameInstagram.php
************/
$reqdata = urlencode(strtolower($_GET['search_box']));

//Instagram Access Token, Fixed Access Token against an App, Please Change it according to Instagram App
$token = "1004308338.616bd19.7be2b5e0fff24f85b59215f7aa038254";

$url = "https://api.instagram.com/v1/users/search?q=".$reqdata."&access_token=".$token;
        
//Instagram User Search JSON
$instagram_user_json = @file_get_contents($url);

//Get an user id for function getUserDataInstagram
$user_id = $instagram_user_json['data'][/*data_no*/]['id'];




/************
In getUserDataInstagram.php
************/

//Instagram Access Token, Fixed Access Token against an App, Please Change it according to Instagram App
$token = "1004308338.616bd19.7be2b5e0fff24f85b59215f7aa038254";

$url = "hhttps://api.instagram.com/v1/users/".$_GET['user_id']."/media/recent/?access_token=".$token;
        
//Instagram User Search JSON
$instagram_user_media_json = @file_get_contents($url);




/************
In searchUsernameYoutube.php
************/
$reqdata = urlencode(strtolower($_GET['search_box']));

$url = "https://gdata.youtube.com/feeds/api/channels?q=".$reqdata."&start-index=1&max-results=20&v=2&alt=json";
        
//Instagram User Search JSON
$youtube_user_json = @file_get_contents($url);

//Get an user uploaded files url for function getUserDataYoutube
$user_url = urlencode($youtube_user_json['feed']['entry'][/*entry_no*/]['gd$feedLink'][0]['href']."&alt=json");




/************
In getUserDataYoutube.php
************/
$url = $_GET['user_url'];
        
//Instagram User Search JSON
$youtube_user_uploaded_json = @file_get_contents($url);

