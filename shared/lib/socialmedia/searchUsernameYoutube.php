<?php
/************
In searchUsernameYoutube.php
 ************/
$format = isset($_GET['format']) ? $_GET['format'] : 'json';
$reqdata = urlencode(strtolower($_GET['search_box']));

$url = "https://gdata.youtube.com/feeds/api/channels?q=".$reqdata."&start-index=1&max-results=20&v=2&alt=json";

//Instagram User Search JSON
$youtube_user_json = @file_get_contents($url);
$content = json_decode($youtube_user_json);
if($format == 'json') {
    echo($youtube_user_json);
    return;

} else {
    $result = "";
    foreach($content->feed->entry as $item):
        $t = '$t';
        $media = 'media$thumbnail';
        $result .= <<<E
            <div class="media selectable" data-value="{$item->title->{$t}}">
                <a class="pull-left"
                    data-analytics-label: "{$item->title->{$t}}">
                    <img class="media-object" width="48" height="48" src="{$item->{$media}[0]->url}"/>
                </a>

                <div class="media-body">
                    <h4 class="media-heading" data-bind="text: name">
                        {$item->title->{$t}}
                        <span style="color: #BCBCBC; font-size: 16px; font-weight: normal !important;">{$item->title->{$t}} </span>
                    </h4>
                    <span>{$item->summary->{$t}}</span>
                </div>
            </div>
E;

    endforeach;
    echo $result;
}
//Get an user uploaded files url for function getUserDataYoutube
// $user_url = urlencode($youtube_user_json['feed']['entry'][/*entry_no*/]['gd$feedLink'][0]['href']."&alt=json");
