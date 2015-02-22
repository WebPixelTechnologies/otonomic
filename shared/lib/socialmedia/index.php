<?php 
session_start();
require_once('twitteroauth-master/twitteroauth/twitteroauth.php');
require_once('twitteroauth-master/config.php');
?>

<html>
 <head>
  <title> Social Media User Search </title>

  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.fancybox-thumbs.css">

  <script src="js/1.10.2/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.fancybox.js"></script>
  <script type="text/javascript" src="js/jquery.fancybox-thumbs.js"></script>

  <?php
  if(isset($_SESSION['access_token']) && isset($_SESSION['searchq'])) {
        $access_token = $_SESSION['access_token'];
        unset($_SESSION['access_token']);
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $content = $connection->get('https://api.twitter.com/1.1/users/search.json?q='.$_SESSION['searchq']."&page=1");
        
        /*********************** 
        Twitter User Search JSON 
        ***********************/
        $twitter_user_json = json_encode($content);
        /*************************** 
        Twitter User Search JSON End
        ***************************/
        
        //echo "<script type='text/javascript'>$('#search_box').val('".$_SESSION['searchq']."');$('#form1').submit();</script>";
  }
?>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#form1").submit(function(e){
				$('#populate_list').html('<div id="loading-div">Loading...</div>');
				e.preventDefault();
				var searchval = $('#search_box').val();
				//Function like searchUsernameTwitter
				if($("#radio1").is(":checked")) {
					window.location.href = "./twitteroauth-master/index.php?searchq="+searchval;
				}
				//Function like searchUsernameInstagram
				if($("#radio2").is(":checked")) {
					$.get("instagram.php?search_box="+searchval, function(data){
						$('#populate_list').html(data);
					});	
				}
				//Function like getUserDataPinterest
				if($("#radio3").is(":checked")) {
					$.get("pinterest.php?search_box="+searchval, function(data){
						$('#populate_list').html(data);
					});	
				}
				//Function like searchUsernameYoutube
				if($("#radio4").is(":checked")) {
					$.get("youtube.php?search_box="+searchval, function(data){
						$('#populate_list').html(data);
					});	
				}
			});

			$('.fancybox-thumbs').fancybox({
                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : true,
                arrows    : false,
                nextClick : true,                

                helpers : {
                    thumbs : {
                        width  : 50,
                        height : 50
                    }
                }
            });
});

	function getUserDataInstagram(user_id) {
				
				$.get("user_info.php?search="+user_id, function(data){
					//$('#user_content_'+user_id).after(data);
					$('#user_content1_'+user_id).html(data);
					$('#user_content1_'+user_id).toggle();
				});
			}
			
        function getUserDataYoutube(userurl,user_id) {
				
				$.get("youtubedetails.php?searchurl="+userurl, function(data){
					$('#user_content1_'+user_id).html(data);
					$('#user_content1_'+user_id).toggle();
				});
			}

	function next_media(div_id, user_id, next_url) {

				$.get("user_next_media.php?search="+next_url+"&uid="+user_id, function(data){
					$('#media_'+div_id).remove();
					$('#media_thumbs_'+div_id).append(data);
					//$('#user_content1_'+user_id).html(data);
					//$('#user_content1_'+user_id).toggle();
				});
			}

	function twitter_details(user_id) {
				
					$('#user_content1_'+user_id).toggle();
			}
			
			</script>

 </head>

 <body>
	<form class="form-wrapper cf" id="form1" method="post" action="">
		<input type="text" name="search_box" id="search_box" placeholder="Search user..." value="<?php if(isset($_SESSION['searchq'])) echo $_SESSION['searchq']; ?>" required />
		<button type="submit" name="sub">Search</button>

		<input type="radio" name="radiog_lite" id="radio1" class="css-checkbox" checked="checked"/>
		<label for="radio1" class="css-label"  id="option_1"><img src="img/twitter-icon.jpg" title="Twitter"></label>

		<input type="radio" name="radiog_lite" id="radio2" class="css-checkbox" />
		<label for="radio2" class="css-label" id="option_2"><img src="img/instagram-icon.png" title="Instagram"></label>

		<input type="radio" name="radiog_lite" id="radio3" class="css-checkbox" />
		<label for="radio3" class="css-label" id="option_3"><img src="img/pinterest-icon.png" title="Pinterest"></label>

		<input type="radio" name="radiog_lite" id="radio4" class="css-checkbox" />
		<label for="radio4" class="css-label" id="option_4"><img src="img/youtube-icon.gif" title="YouTube"></label>

		<input type="radio" name="radiog_lite" id="radio5" class="css-checkbox" />
		<label for="radio5" class="css-label" id="option_5"><img src="img/linkedin-icon.png" title="LinkedIn"></label>
	</form>

	<div id="populate_list">
		<?php 
		
			if(isset($content)) {
			//echo "<pre>";
			//print_r($content);
			//echo "</pre>";

			foreach($content as $content_key=>$content_val) {
				$contentdetail = "";
				if(isset($content_val->id)) {
			        $content_tweet = $connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json?user_id='.$content_val->id.'&screen_name='.$content_val->screen_name);
			        
			        /**********************
                                Twitter User Tweet JSON 
                                **********************/
                                $twitter_user_tweet_json = json_encode($content_tweet);
                                /**************************
                                Twitter User Tweet JSON End
                                **************************/
        
				if(!empty($content_val->name)) {
				$contentdetail = $contentdetail."<div>Full Name: ".$content_val->name."</div>";
				}
				$contentdetail = $contentdetail."<div>Screen Name: ".$content_val->screen_name."</div>";
				if(!empty($content_val->location)) {
				$contentdetail = $contentdetail."<div>Location:".$content_val->location."</div>";
				}
				if(!empty($content_val->description)) {
				$contentdetail = $contentdetail."<div>Description: ".$content_val->description."</div>";
				}
				
				$contentdetail = $contentdetail."<div>Followers: ".$content_val->followers_count."</div>";				
				$contentdetail = $contentdetail."<div>Friends: ".$content_val->friends_count."</div>";
				$contentdetail = $contentdetail."<div>Favourites: ".$content_val->favourites_count."</div>";				
				$contenttweet = "";
				if(!empty($content_tweet) && is_array($content_tweet)) {
				         $contenttweet = $contenttweet."<div style='text-align:center;font-size:18px;'>Tweets (".count($content_tweet).")</div>";
				         foreach($content_tweet as $content_tweetkey=>$content_tweetval) {
				                if(!empty($content_tweetval->retweeted_status->user)) {
				                        if(!empty($content_tweetval->retweeted_status->user->name)) {
				                        $contenttweet = $contenttweet."<div style='padding:10px;'><div style='float:left;width:65px;'><img src = '".$content_tweetval->retweeted_status->user->profile_image_url."'></div><div style='float:left;width:395px;'><div><span style='font-size:14px;font-weight:bold;'>".$content_tweetval->retweeted_status->user->name."</span> <span style='font-style:10px;color:#CCC;'>@".$content_tweetval->retweeted_status->user->screen_name."</span>";
				                        }
				                        else {
				                        $contenttweet = $contenttweet."<div style='padding:10px;'><div style='float:left;width:65px;'><img src = '".$content_tweetval->retweeted_status->user->profile_image_url."'></div><div style='float:left;width:395px;'><div>".$content_tweetval->retweeted_status->user->screen_name;
				                        }
				                        $contenttweet = $contenttweet."<span style='float:right;'>".date('D, jS M, y', strtotime($content_tweetval->created_at))."</span>";
				                        $contenttweet = $contenttweet."</div>";
				                }
				                else {
				                        if(!empty($content_tweetval->user->name)) {
				                        $contenttweet = $contenttweet."<div style='padding:10px;'><div style='float:left;width:65px;'><img src = '".$content_tweetval->user->profile_image_url."'></div><div style='float:left;width:395px;'><div><span style='font-size:14px;font-weight:bold;'>".$content_tweetval->user->name."</span> <span style='font-style:10px;color:#CCC;'>@".$content_tweetval->user->screen_name."</span>";
				                        }
				                        else {
				                        $contenttweet = $contenttweet."<div style='padding:10px;'><div style='float:left;width:65px;'><img src = '".$content_tweetval->user->profile_image_url."'></div><div style='float:left;width:395px;'><div>".$content_tweetval->user->screen_name;
				                        }
				                        $contenttweet = $contenttweet."<span style='float:right;'>".date('D, jS M, y', strtotime($content_tweetval->created_at))."</span>";
				                        $contenttweet = $contenttweet."</div>";
				                }
				                
				                $contenttweet = $contenttweet."<div style='word-wrap:break-word;'>".$content_tweetval->text."</div>";
				                $contenttweet = $contenttweet."</div><div style='clear:both;'></div></div>";
				         }
				}
				
				if(!empty($content_val->name)) {
				$showname = $content_val->name;
				}
				else {
				$showname = $content_val->screen_name;
				}

				echo "<div id='".$content_val->id."' class='user_content' onClick='twitter_details(".$content_val->id.")'><div class='user_image'><img src='".$content_val->profile_image_url."' style='width: 75px;'></div><div class='user_name'>".$showname."</div><div style='clear: both'></div></div><div id='user_content1_".$content_val->id."' class='user_content1'>".$contentdetail.$contenttweet."</div>";
				}
				}
			}
			
		
		?>
	</div>
	
 </body>
</html>

