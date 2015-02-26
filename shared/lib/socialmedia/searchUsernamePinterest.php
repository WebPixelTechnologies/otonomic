<?php

$format = isset($_GET['format']) ? $_GET['format'] : 'json';

$reqdata = urlencode(strtolower($_GET['search_box']));

$url = 'https://api.pinterest.com/v3/pidgets/users/'.$reqdata.'/pins/';

$pinterest_user_json = @file_get_contents($url);
$content = json_decode($pinterest_user_json);

//print_r($content);

if($format == 'json') {
    echo $pinterest_user_json;
    return;

} else {
    $result = "";
    
    if(@$content->status == 'success'){
        $user_data = $content->data->user;
        $result .= <<<E
            <div class="media selectable" data-value="{$user_data->full_name}">
                <a class="pull-left"
                    data-analytics-label: "{$user_data->full_name}">
                    <img class="media-object" width="48" height="48" src="{$user_data->image_small_url}"/>
                </a>

                <div class="media-body">
                    <h4 class="media-heading" data-bind="text: name">
                        {$user_data->full_name}
                        <span style="color: #BCBCBC; font-size: 16px; font-weight: normal !important;">{$user_data->profile_url} </span>
                    </h4>
                    <span>{$user_data->about}</span>
                </div>
            </div>
E;
    }
    echo $result;
}

?>
