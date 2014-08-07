    <div id="fb-root"></div>
    <script src="https://connect.facebook.net/en_US/all.js"></script>
    <script>
    	FB.init({appId: '<?php echo FACEBOOK_APP_ID; ?>', status: true, cookie: true,xfbml: true});        

        /*
        window.fbAsyncInit = function() {
            FB.init({appId: '<?php echo FACEBOOK_APP_ID; ?>', status: true, cookie: true,xfbml: true});        
        };
*/

    	// Load the SDK Asynchronously
    	(function() {
    	var e = document.createElement('script'); e.async = true;
    	e.src = document.location.protocol 
    	+ '//connect.facebook.net/en_US/all.js';
    	document.getElementById('fb-root').appendChild(e);
    	}());

        /*
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo FACEBOOK_APP_ID; ?>";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        */
        //window.fbAsyncInit();
    </script>
    
    <script type="text/javascript">
    	var user_facebook_id;
    	
        jQuery(document).ready(function($){
            $("#connect").bind('click',checkConnectedWithFacebook);
            
            $('#example').modal({
                keyboard: true,
                show : false
            });

            $(".site-item a").bind('click', function() {
                page_name = $('a.page_name', this).html();
            	trackEvent('Create site', 'Self page', page_name);
            
            });
        });

        function checkConnectedWithFacebook(){
        	trackEvent('Facebook', 'Click connect with facebook', '#connect');

        	FB.getLoginStatus(function(response) {
        	    if (response.status === 'connected') {
        	    	user_facebook_id = response.authResponse.userID;
        	      	getPages();

       	        } else {
        	    		FB.login(function (response) {
        	    			if(response.authResponse) {
        	    				// user is logged in
        	    				user_facebook_id = response.authResponse.userID;
        	    				getPages();
        	    				
        	    			} else {
        	    				// user could not log in
        	    				console.log('User cancelled login or did not fully authorize.');
        	    				alert('Please sign in to your Facebook account to start using Page2Site.');
        	    			}
        	    		}, {scope: 'publish_stream,email,manage_pages,offline_access,user_location,user_about_me,user_photos,user_events,user_videos,user_likes'});
        	    }
        	});

            return false;
        }

        function connectFacebook(){
            FB.login(function(response){
                if(response.status == 'connected'){
    				// user is logged in
    				user_facebook_id = response.authResponse.userID;
                	getPages();
                }else{
                    alert('Please sign in to your Facebook account to start using Page2Site.');
                }
            }, {
                scope: 'publish_stream,email,manage_pages,offline_access,user_location,user_about_me,user_photos,user_events,user_videos,user_likes'
            });
        }

        function getPages(){
        	trackEvent('Facebook', 'Approved facebook app', 'approved');

        	FB.api('/me/permissions', { limit: 100 }, function(response) {
                console.log(response);
            });
        	
        	FB.api('/me/accounts', { limit: 100 }, function(response) {
                if(response.data != undefined){
                    populatePages(response.data);
                } else{
                    alert('No Pages found');
                }
                return false;
            });
        }

        function populatePages(pages){
            var $dom = $(".domHide").clone();
            var isAnyPageFound = false;
            $("#example .modal-body").html('');

            // Add personal site
            $(".page_name", $dom).html('My personal profile').attr('href','<?php echo FULL_PATH; ?>sites/add/type:fb_personal');
            $(".page_image", $dom).attr('href','<?php echo FULL_PATH; ?>sites/add/type:fb_personal')
            if(user_facebook_id) {
            	user_image_url = 'http://graph.facebook.com/'+user_facebook_id+'/picture?type=square';
            } else {
                user_image_url = 'http://profile.ak.fbcdn.net/hprofile-ak-ash4/c178.0.604.604/s50x50/252231_1002029915278_1941483569_n.jpg';
            }
            $(".media-object",$dom).attr('src',user_image_url);
            $("#example .modal-body").append($dom.html());

            // Add pages
            $.each(pages, function(index, value){
                if(value.category != 'Application'){
                    isAnyPageFound = true;
                    $(".page_name", $dom).html(value.name).attr('href','<?php echo FULL_PATH; ?>sites/add/fbid:'+value.id);
                    $(".page_image", $dom).attr('href','<?php echo FULL_PATH; ?>sites/add/fbid:'+value.id)
                    $(".media-object",$dom).attr('src','http://graph.facebook.com/'+value.id+'/picture?type=small');
                    $("#example .modal-body").append($dom.html());
                }
            });

            
            if(isAnyPageFound){
                $('#example').modal('show');
            }else{
                window.location = '<?php echo FULL_PATH; ?>sites/add/type:fb_personal';
            }
        }
    </script>


    <div class="tb">
        <div id="example" class="modal hide fade in" style="display: none;z-index:10001;">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Create a site for:</h3>
            </div>
            <div class="modal-body">                    
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>
        </div>
        <div class="domHide" style="display: none">
            <div class="media site-item">
                <a href="#" target="_blank" class="page_image" style="float: left">
                    <img class="media-object" src="" height="24" width="24">
                </a>
                <div class="media-body pull-left" style="float: left;margin-left: 10px">
                    <p class="media-heading">                    
                    <a href="#" target="_blank" class="page_name"></a>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>