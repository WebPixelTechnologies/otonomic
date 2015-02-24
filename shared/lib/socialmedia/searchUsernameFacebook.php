<?php
/************
In searchUsernameFacebook.php
 ************/
$format = isset($_GET['format']) ? $_GET['format'] : 'json';

$reqdata = urlencode(strtolower($_GET['search_box']));

//Facebook Access Token.
$token = "CAAUlWzuUGiYBAO7BZA8ek15RMSy8LNdD38wWlO9ssi6fPjdUFl3dSdxiB6eddwtZBWEEied2cPV8UmYH9zTqr1x2hhJCtRx60w0ZA4tdHziZAZCBzEUEFSFsMLXDnZCTZAQW3RETBAbtto9sIhiDjvwnIxeVSrbYY9ICTfOvLlxniqjnNWDK3tuxwTRBcUzQWvIxA3ZCeVBQgkYcYUE7V08p";

$url = "https://graph.facebook.com/search?q=".$reqdata."&type=page&access_token=".$token;

//User Search JSON
$user_json = @file_get_contents($url);
$content = json_decode($user_json);

if($format == 'json') {
    echo($user_json);
    return;

} else {
    $result = "";
    foreach($content->data as $item):
        $result .= <<<E
            <div class="media selectable" data-value="{$item->name}">
                <a class="pull-left"
                    data-analytics-label: "{$item->name}">
                    <img class="media-object" width="48" height="48" src="https://graph.facebook.com/{$item->id}/picture?type=large"/>
                </a>

                <div class="media-body">
                    <h4 class="media-heading" data-bind="text: name">
                        {$item->name}
                        <span style="color: #BCBCBC; font-size: 16px; font-weight: normal !important;">{$item->category} </span>
                    </h4>
                </div>
            </div>
E;

    endforeach;
    echo $result;
}
