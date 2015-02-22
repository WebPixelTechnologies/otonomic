<?php

if (!empty($_GET['search_box'])) {
	$Username = $_GET['search_box'];
	$username = str_replace(' ', '', trim($Username)); // sanitization
	
	$url = "https://api.pinterest.com/v3/pidgets/users/".$username."/pins";
	/**********************
        Pinterest User Pin JSON 
        **********************/
        $get = @file_get_contents($url);
        /**************************
        Pinterest User Pin JSON End
        **************************/
        
        $json = json_decode($get, true);				
        
        $json_user_data = "<div class='user_content1' style='display:block;'>";
        if($json['status'] == "failure"){
                $json_user_data .= $json['message'];
        }
        else {
                if(!empty($json['data']['user'])){
                        $json_user_data .= "<div align='center'><img src='".$json['data']['user']['image_small_url']."'/></div>";
                        $json_user_data .= "<div align='center'>".$json['data']['user']['full_name']."</div>";
                }
                if(!empty($json['data']['pins'])){
                        $json_user_data .= "<div class='media_text'>Pins</div>";
                        foreach($json['data']['pins'] as $pin_key => $pin_val) {
                                $json_user_data = $json_user_data."<a class='fancybox-thumbs' href='".$pin_val['images']['237x']['url']."'><img src='".$pin_val['images']['237x']['url']."' alt='' /></a>";
                        }
			$json_user_data .= "<div style='clear:both'></div>";
                }
        }
        $json_user_data .= "</div>";
        
        echo $json_user_data;
}
        
?>
