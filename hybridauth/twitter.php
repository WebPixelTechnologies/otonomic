<?php
	session_start(); 

	// config and includes
        require_once( "Hybrid/Auth.php" );
        $config = 'config.php';
        
	try{
                if(isset($_GET['social']) && $_GET['social'] != ""){
                    $social_media_type = $_GET['social'];
                }
                else{
                    $social_media_type = 'Twitter';
                }
                
                if($social_media_type == "OpenID"){
                    $parameters = array(
                        "openid_identifier" => $_GET['openid_identifier']
                    );
                }
                
		// hybridauth EP
                if(isset($parameters) && !empty($parameters)){
                    $hybridauth = new Hybrid_Auth( $config, $parameters );
                }else{
                    $hybridauth = new Hybrid_Auth( $config );
                }
                
		$twitter = $hybridauth->authenticate($social_media_type);
                
                /* Searialized array containing session access token that can 
                 be used to access user profile data from backend. 
                  Use restoreSessionData() to restore that same user session
                 */
                $session_data = $hybridauth->getSessionData();

		// return TRUE or False <= generally will be used to check if the user is connected to twitter before getting user profile, posting stuffs, etc..
		$is_user_logged_in = $twitter->isUserConnected();

		// get the user profile 
		$user_profile = $twitter->getUserProfile();
                // $user_profile_data is the array that is to be saved in the database.
                $user_profile_data = (array) $user_profile;
                
		$twitter->logout(); 
                ?>
<script language="javascript"> 
	if(  window.opener ){
//                window.opener.parent.$('#authorize_<?= $social_media_type; ?>').addClass('connected');
//		window.opener.parent.$('#authorize_<?= $social_media_type; ?>').append('<img class="social-check" src="images/social-check.png">');
                window.opener.parent.userConnected('<?= $social_media_type; ?>','<?= $session_data ?>');
	}
	window.self.close();
</script>
<?php
	}
	catch( Exception $e ){  
		// In case we have errors 6 or 7, then we have to use Hybrid_Provider_Adapter::logout() to 
		// let hybridauth forget all about the user so we can try to authenticate again.

		// Display the received error,
		// to know more please refer to Exceptions handling section on the userguide
		switch( $e->getCode() ){ 
			case 0 : echo "Unspecified error."; break;
			case 1 : echo "Hybridauth configuration error."; break;
			case 2 : echo "Provider not properly configured."; break;
			case 3 : echo "Unknown or disabled provider."; break;
			case 4 : echo "Missing provider application credentials."; break;
			case 5 : echo "Authentication failed. " 
					  . "The user has canceled the authentication or the provider refused the connection."; 
				   break;
			case 6 : echo "User profile request failed. Most likely the user is not connected "
					  . "to the provider and he should to authenticate again."; 
				   $twitter->logout();
				   break;
			case 7 : echo "User not connected to the provider."; 
				   $twitter->logout();
				   break;
			case 8 : echo "Provider does not support this feature."; break;
		} 

		// well, basically your should not display this to the end user, just give him a hint and move on..
//		echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

//		echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";
                                ?>
                <script language="javascript"> 
                        window.self.close();
                </script>
                <?php
	}
