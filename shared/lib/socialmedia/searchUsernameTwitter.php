<?php
/************
In searchUsernameTwitter.php
 ************/
$format = isset($_GET['format']) ? $_GET['format'] : 'json';

$reqdata = urlencode(strtolower($_GET['search_box']));
require_once('twitteroauth-master/twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', 'F5mbOOnXXliK7zEUXt0wg');
define('CONSUMER_SECRET', 'd2jNP2PYZBS8SxEwnwhLR2y0peS64BS8OTRgXLBG8');
define('OAUTH_CALLBACK', 'http://voip.aqbsolutions.com/socialmedia/twitteroauth-master/callback.php');

//Access Token for Twitter, Fixed Access Token against an App for an User, Please Change it according to Twitter App and User
$access_token = array(
    'oauth_token' => '631809411-ojn20dCQiKo6ILwSYjOV4uWS4rddG6UHmiQS5XQ6',
    'oauth_token_secret' => 'rpwvVxxlGNJXX9bUrOOw387Wi6jdKHfGK1RCw0HqOEMwx',
    'user_id' => '631809411',
    'screen_name' => 'koolkallol'
);

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
$content = $connection->get('https://api.twitter.com/1.1/users/search.json?q='.$reqdata."&page=1");

//Twitter User Search JSON
$twitter_user_json = json_encode($content);

if($format == 'json') {
    echo($twitter_user_json);
    return;

} else {
    $result = "";
    foreach($content as $item):
        $result .= <<<E
            <div class="media selectable" data-value="{$item->screen_name}">
                <a class="pull-left"
                    data-analytics-label: "{$item->name}">
                    <img class="media-object" src="{$item->profile_image_url}"/>
                </a>

                <div class="media-body">
                    <h4 class="media-heading" data-bind="text: name">
                        {$item->name}
                        <span style="color: #BCBCBC; font-size: 16px; font-weight: normal !important;">{$item->screen_name} </span>
                    </h4>
                    <span>{$item->description}</span>
                </div>
            </div>
E;

    endforeach;
    echo $result;
}

//Get an user id and screen name for function getUserDataTwitter
//$user_id = $twitter_user_json[/*data_no*/]['id'];
//$screen_name = $twitter_user_json[/*data_no*/]['screen_name'];
