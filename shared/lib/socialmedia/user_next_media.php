<?php

	if (!empty($_GET['search']) && !empty($_GET['uid'])) {
		$next_url = $_GET['search'];
		$uid = $_GET['uid'];
		
		//Instagram Access Token
		$token = "1004308338.616bd19.7be2b5e0fff24f85b59215f7aa038254";

		/*****************************
                Instagram User Media JSON Next
                *****************************/
		//$get = @file_get_contents("https://api.instagram.com/v1/users/".$uid."/media/recent?access_token=".$token."&max_id=".$next_url."&count=8");
		$get = @file_get_contents("https://api.instagram.com/v1/users/".$uid."/media/recent?access_token=".$token."&max_id=".$next_url);
		/*********************************
                Instagram User Media JSON Next End
                *********************************/

		$recent_media_json = json_decode($get);

		//echo "<pre>";
		//print_r($json);
		//die();

		if(!empty($recent_media_json->data)){
			$json_user_data = '';
			foreach($recent_media_json->data as $recent_media_key => $recent_media_val) {
				 //$json_user_data = $json_user_data."<div class='media_thumb'><img src='".$recent_media_val->images->thumbnail->url."'></div>";		

				 $json_user_data = $json_user_data."<a class='fancybox-thumbs' href='".$recent_media_val->images->standard_resolution->url."'><img src='".$recent_media_val->images->thumbnail->url."' alt='' /></a>";
			}

			if(isset($recent_media_json->pagination->next_url)) {
				$json_user_data = $json_user_data."<div id='media_".$uid."' class='load-more'><a class='next-media' href='javascript:void(0);' onclick='next_media(\"".$uid."\",\"".$uid."\",\"".$recent_media_json->pagination->next_max_id."\")'><img src='img/lm.png'></div>";
			}

			echo $json_user_data;
		}

	}

?>
