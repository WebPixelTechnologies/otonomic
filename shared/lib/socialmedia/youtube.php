<?php
if (!empty($_GET['search_box'])) {
	$Username = $_GET['search_box'];
	$username = urlencode(strtolower($Username)); // sanitization
        
        $url = "https://gdata.youtube.com/feeds/api/channels?q=".$username."&start-index=1&max-results=20&v=2&alt=json";
        
        /***********************
        YouTube User Search JSON 
        ***********************/
        $get = @file_get_contents($url);
        /***************************
        Youtube User Search JSON End
        ***************************/
        
        $json = json_decode($get,true);
	$json_data = "";

	if(isset($json['feed']['entry'])){
		foreach($json['feed']['entry'] as $user)
		{
		        $userurl = urlencode($user['gd$feedLink'][0]['href']."&alt=json");
		        $userid = $user['author'][0]['yt$userId']['$t'];
		        
			$json_data = $json_data."<div id='user_content_".$user['author'][0]['yt$userId']['$t']."' class='user_content' onClick='getUserDataYoutube(\"".$userurl."\",\"".$userid."\")'><div class='user_image'><img src=".$user['media$thumbnail'][0]['url']." style='width: 100px;'></div><div class='user_name'>".$user['title']['$t']."</div><div style='clear: both'></div></div><div id='user_content1_".$user['author'][0]['yt$userId']['$t']."' class='user_content1'></div>";
		}
		echo $json_data;
	}
	else{
		echo "No records found";
	}
}
?>
