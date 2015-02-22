<?php

if (!empty($_GET['search_box'])) {
	$Username = $_GET['search_box'];
	$username = urlencode(strtolower($Username)); // sanitization
	
        //Instagram Access Token
        $token = "1004308338.616bd19.7be2b5e0fff24f85b59215f7aa038254";
        
        $url = "https://api.instagram.com/v1/users/search?q=".$username."&access_token=".$token;
        
        /*************************
        Instagram User Search JSON 
        *************************/
        $get = @file_get_contents($url);
        /*****************************
        Instagram User Search JSON End
        *****************************/

        $json = json_decode($get);
	
	//echo "<pre>";
	//print_r($json);
	//die();
	$json_data = "";

	if(!empty($json->data)){
		foreach($json->data as $user)
		{
			//if($user->username == $username)
			//{
				//return $user->id;
				//return $user->username;
				$json_data = $json_data."<div id='user_content_".$user->id."' class='user_content' onClick='getUserDataInstagram(".$user->id.")'><div class='user_image'><img src=".$user->profile_picture." style='width: 100px;'></div><div class='user_name'>".$user->username."</div><div style='clear: both'></div></div><div id='user_content1_".$user->id."' class='user_content1'></div>";
			//}
		}
		echo $json_data;
	}
	else{
		echo "No records found";
	}

    //return '00000000'; // return this if nothing is found
}

//echo getInstaID('aliciakeys'); // this should print 20979117

?>
