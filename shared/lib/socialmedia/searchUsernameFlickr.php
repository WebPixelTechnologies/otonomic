<?php
/************
In searchUsernameInstagram.php
 ************/
$format = isset($_GET['format']) ? $_GET['format'] : 'json';

$reqdata = urlencode(strtolower($_GET['search_box']));

//Instagram Access Token, Fixed Access Token against an App, Please Change it according to Instagram App
$key = "b5245e9b9cbaeecee26ea278bfa20253";
$params = array(
	'api_key'	=> $key,
        'username' => $reqdata,
	'method'	=> 'flickr.people.findByUsername',
	'format'	=> 'php_serial',
);
$base_url = "https://api.flickr.com/services/rest/?";
$url = $base_url.http_build_query($params);

$flickr_user_json = @file_get_contents($url);
$content = unserialize($flickr_user_json);
if($content['stat'] == 'ok'){
    $params = array(
            'api_key'	=> $key,
            'user_id'       => $content['user']['id'],
            'method'	=> 'flickr.people.getInfo',
            'format'	=> 'json',
            'nojsoncallback' => 1
    );
    $url = $base_url.http_build_query($params);
    $user_content = @file_get_contents($url);
}

$user_content = json_decode($user_content);
//print_r($user_content);
    
if($format == 'json') {
    echo $user_content;
    return;

} else {
    $result = "";
    
//    foreach($content->data as $item):
    if($user_content->stat == 'ok'){
        $result .= <<<E
            <div class="media selectable" data-value="{$user_content->person->username->_content}">
                <a class="pull-left"
                    data-analytics-label: "{$user_content->person->username->_content}">
                    <!--<img class="media-object" width="48" height="48" src=""/>-->
                </a>

                <div class="media-body">
                    <h4 class="media-heading" data-bind="text: name">
                        {$user_content->person->realname->_content}
                        <span style="color: #BCBCBC; font-size: 16px; font-weight: normal !important;">{$user_content->person->username->_content} </span>
                    </h4>
                    <span>{$user_content->person->description->_content}</span>
                </div>
            </div>
E;
    }
//    endforeach;
    echo $result;
}

//Get an user id for function getUserDataInstagram
//$user_id = $instagram_user_json['data'][/*data_no*/]['id'];
