<?php
/************
In searchUsernameInstagram.php
 ************/
$reqdata = urlencode(strtolower($_GET['search_box']));

//Instagram Access Token, Fixed Access Token against an App, Please Change it according to Instagram App
$token = "44171713.10d405b.25e232f920f94ac9907d8c0ea34ce1de";

$url = "https://api.instagram.com/v1/users/search?q=".$reqdata."&access_token=".$token;

//Instagram User Search JSON
$instagram_user_json = @file_get_contents($url);

echo($instagram_user_json);

//Get an user id for function getUserDataInstagram
//$user_id = $instagram_user_json['data'][/*data_no*/]['id'];
