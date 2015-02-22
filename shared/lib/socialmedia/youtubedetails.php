<?php
if (!empty($_GET['searchurl'])) {
	//$Userurl = $_GET['searchurl'];
	$userurl = $_GET['searchurl'];
        
        $url = $userurl;
        
        /*****************************
        YouTube User Search Files JSON 
        *****************************/
        $get = @file_get_contents($url);
        /*********************************
        Youtube User Search Files JSON End
        *********************************/
        
        $json = json_decode($get,true);
        
	$json_data = "";

	if(isset($json['feed']['entry'])){
		foreach($json['feed']['entry'] as $user)
		{
			$json_data = $json_data."<div style='padding:5px;'><div style='float:left;width:140px;'><a href='".$user['media$group']['media$content'][0]['url']."' target='_blank'><img src=".$user['media$group']['media$thumbnail'][0]['url']." /></a></div><div style='float:left;width:325px;'><a href='".$user['media$group']['media$player']['url']."' style='text-decoration:none;' target='_blank'>".$user['title']['$t']."</a></div><div style='clear: both'></div></div>";
		}
		echo $json_data;
	}
	else{
		echo "No Videos Found";
	}
}
?>
