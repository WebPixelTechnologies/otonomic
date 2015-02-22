<?php
/************
In getUserDataInstagram.php
 ************/

//Instagram Access Token, Fixed Access Token against an App, Please Change it according to Instagram App
$token = "44171713.10d405b.25e232f920f94ac9907d8c0ea34ce1de";
$client_id = "10d405b014fd41ac9b20776f26a9d908";

//$url = "https://api.instagram.com/v1/users/".$_GET['user_id']."/media/recent/?access_token=".$token;
$url = "https://api.instagram.com/v1/users/".$_GET['user_id']."/media/recent/?client_id=".$client_id;

//Instagram User Search JSON
$instagram_user_media_json = @file_get_contents($url);
echo $instagram_user_media_json;
// echo json_encode($instagram_user_media_json);