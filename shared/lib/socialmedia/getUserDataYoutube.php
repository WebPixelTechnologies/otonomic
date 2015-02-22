<?php
/************
In getUserDataYoutube.php
 ************/
$url = $_GET['user_url'];

//Instagram User Search JSON
$youtube_user_uploaded_json = @file_get_contents($url);
