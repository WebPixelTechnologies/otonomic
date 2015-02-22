<?php

if (!empty($_GET['search'])) {
	$Userid = $_GET['search'];
	//$userid = strtolower($Userid); // sanitization
	
	//Instagram Access Token
        $token = "1004308338.616bd19.7be2b5e0fff24f85b59215f7aa038254";
        
        //$url = "https://api.instagram.com/v1/users/search?q=".$username."&access_token=".$token;
	$url = "https://api.instagram.com/v1/users/".$Userid."/?access_token=".$token;
	//$recent_media_url = "https://api.instagram.com/v1/users/".$Userid."/media/recent/?access_token=".$token."&count=8";
	$recent_media_url = "https://api.instagram.com/v1/users/".$Userid."/media/recent/?access_token=".$token;
	
        /***********************
        Instagram User Info JSON 
        ***********************/
	$get = @file_get_contents($url);
	/***************************
        Instagram User Info JSON End
        ***************************/	
	
    $json = json_decode($get);

	if($json->data->counts->media > 0) {
	
	/************************
        Instagram User Media JSON 
        ************************/
	$get_recent_media = @file_get_contents($recent_media_url);
	/****************************
        Instagram User Media JSON End
        ****************************/
        
	$recent_media_json = json_decode($get_recent_media);
	}

	//echo "<pre>";
	//print_r($json);
	//die();

	$json_user_data = "";

	if(!empty($json->data)){
		/*foreach($json->data as $user)
		{
			//if($user->username == $username)
			//{
				//return $user->id;
				//return $user->username;
				$json_user_data = $json_user_data."<div id='user_content_".$user->id."' class='user_content1'><span>".$user->full_name."</span></div>";
			//}
		}*/
		//$json_user_data = $json_user_data."<div id='user_content1_".$json->data->id."' class='user_content1'>";
		if(!empty($json->data->full_name)) {
		$json_user_data = $json_user_data."<div>Full Name: ".$json->data->full_name."</div>";
		}
		if(!empty($json->data->bio)) {
		$json_user_data = $json_user_data."<div>Biography: ".$json->data->bio."</div>";
		}
		if(!empty($json->data->website)) {
		$json_user_data = $json_user_data."<div>Website: ".$json->data->website."</div>";
		}
		
		$json_user_data = $json_user_data."<div>Followed by: ".$json->data->counts->followed_by."</div>";		
		$json_user_data = $json_user_data."<div>Follows: ".$json->data->counts->follows."</div>";
		
		//$json_user_data = $json_user_data."</div>";

		if(isset($recent_media_json->data) && !empty($recent_media_json->data)) {
			$json_user_data = $json_user_data."<div class='media_text'>Media</div><div id='media_thumbs_".$json->data->id."'>";
			foreach($recent_media_json->data as $recent_media_key => $recent_media_val) {
				 //$json_user_data = $json_user_data."<div class='media_thumb'><img src='".$recent_media_val->images->thumbnail->url."'></div>";		

				 $json_user_data = $json_user_data."<a class='fancybox-thumbs' href='".$recent_media_val->images->standard_resolution->url."'><img src='".$recent_media_val->images->thumbnail->url."' alt='' /></a>";
			}
			$json_user_data = $json_user_data."</div>";

			if(isset($recent_media_json->pagination->next_url)) {
				//$json_user_data = $json_user_data."<div id='media_".$json->data->id."' style='clear: both;'><a class='next-media' href='javascript:void(0);' onclick='next_media(\"".$json->data->id."\",\"".$json->data->id."\",\"".$recent_media_json->pagination->next_max_id."\")'>Next &raquo;</div>";

				$json_user_data = $json_user_data."<div id='media_".$json->data->id."' class='load-more'><a class='next-media' href='javascript:void(0);' onclick='next_media(\"".$json->data->id."\",\"".$json->data->id."\",\"".$recent_media_json->pagination->next_max_id."\")'><img src='img/lm.png'></div>";
			}
			
		}

		$json_user_data = $json_user_data."<div style='clear: both'></div>";

		echo $json_user_data;
	}
	else{
		echo "No records found";
	}

    //return '00000000'; // return this if nothing is found
}

//echo getInstaID('aliciakeys'); // this should print 20979117

?>
