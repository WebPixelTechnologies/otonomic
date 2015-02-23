<?php
/************
In searchUsernameInstagram.php
 ************/
$format = isset($_GET['format']) ? $_GET['format'] : 'json';

$reqdata = urlencode(strtolower($_GET['search_box']));

//Instagram Access Token, Fixed Access Token against an App, Please Change it according to Instagram App
$token = "44171713.10d405b.25e232f920f94ac9907d8c0ea34ce1de";

$url = "https://api.instagram.com/v1/users/search?q=".$reqdata."&access_token=".$token;

//Instagram User Search JSON
$instagram_user_json = @file_get_contents($url);
$content = json_decode($instagram_user_json);

if($format == 'json') {
    echo($instagram_user_json);
    return;

} else {
    $result = "";
    foreach($content->data as $item):
        $result .= <<<E
            <div class="media selectable" data-value="{$item->username}">
                <a class="pull-left"
                    data-analytics-label: "{$item->username}">
                    <img class="media-object" width="48" height="48" src="{$item->profile_picture}"/>
                </a>

                <div class="media-body">
                    <h4 class="media-heading" data-bind="text: name">
                        {$item->full_name}
                        <span style="color: #BCBCBC; font-size: 16px; font-weight: normal !important;">{$item->username} </span>
                    </h4>
                    <span>{$item->bio}</span>
                </div>
            </div>
E;

    endforeach;
    echo $result;
}

//Get an user id for function getUserDataInstagram
//$user_id = $instagram_user_json['data'][/*data_no*/]['id'];
