<?php

$format = isset($_GET['format']) ? $_GET['format'] : 'json';

$api_key = 'AIzaSyCuPWpsfD6E4dq28aSHcrstLHEksxJO7Ac';
$reqdata = urlencode(strtolower($_GET['search_box']));

$url = "https://www.googleapis.com/plus/v1/people/?query=".$reqdata."&key=".$api_key;
$google_user = @file_get_contents($url);

$content = json_decode($google_user);
//print_r($content);

if($format == 'json') {
    echo($google_user);
    return;

} else {
    $result = "";
    foreach($content->items as $item):
        $result .= <<<E
            <div class="media selectable" data-value="{$item->displayName}">
                <a class="pull-left"
                    data-analytics-label: "{$item->displayName}">
                    <img class="media-object" width="48" height="48" src="{$item->image->url}"/>
                </a>

                <div class="media-body">
                    <h4 class="media-heading" data-bind="text: name">
                        {$item->displayName}
                        <span style="color: #BCBCBC; font-size: 16px; font-weight: normal !important;">{$item->displayName} </span>
                    </h4>
                </div>
            </div>
E;

    endforeach;
    echo $result;
}
?>
