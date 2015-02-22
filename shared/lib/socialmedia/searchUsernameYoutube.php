<?php
/************
In searchUsernameYoutube.php
 ************/
$reqdata = urlencode(strtolower($_GET['search_box']));

$url = "https://gdata.youtube.com/feeds/api/channels?q=".$reqdata."&start-index=1&max-results=20&v=2&alt=json";

//Instagram User Search JSON
$youtube_user_json = @file_get_contents($url);

echo $youtube_user_json;

//Get an user uploaded files url for function getUserDataYoutube
// $user_url = urlencode($youtube_user_json['feed']['entry'][/*entry_no*/]['gd$feedLink'][0]['href']."&alt=json");
