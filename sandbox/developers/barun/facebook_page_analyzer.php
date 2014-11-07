s<?php
define('FB_APP_ID', '214447575282892');
?>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    </head>

    <body>
        <div id="fb-root"></div>

        <p>Fanpage Details</p>

        <form>
            <textarea id="fb_page_ids" name="fb_page_ids"rows="15" cols="140">https://www.facebook.com/Raiders,https://www.facebook.com/newyorkgiants,https://www.facebook.com/philadelphiaeagles,https://www.facebook.com/redskins,https://www.facebook.com/ChicagoBears,https://www.facebook.com/DetroitLions,https://www.facebook.com/Packers,https://www.facebook.com/minnesotavikings,https://www.facebook.com/atlantafalcons,https://www.facebook.com/CarolinaPanthers,https://www.facebook.com/neworleanssaints,https://www.facebook.com/tampabaybuccaneers,https://www.facebook.com/arizonacardinals,https://www.facebook.com/Rams,https://www.facebook.com/SANFRANCISCO49ERS,https://www.facebook.com/Seahawks
            </textarea>
            <br />
            <input type="button" name="getdata" id="getdata" value="Get Information" />
        </form>

        <script type="text/javascript">
            var access_token_active = '';
            function weeks_between(date1, date2) {
                // The number of milliseconds in one week
                var ONE_WEEK = 1000 * 60 * 60 * 24 * 7;
                // Convert both dates to milliseconds
                var date1_ms = date1.getTime();
                var date2_ms = date2.getTime();
                // Calculate the difference in milliseconds
                var difference_ms = Math.abs(date1_ms - date2_ms);
                // Convert back to weeks and return hole weeks
                //return Math.floor(difference_ms / ONE_WEEK);
                return difference_ms / ONE_WEEK;
            }

            function appendtodiv(data)
            {
                $('#append_div').append(data);
                $('#append_div').append('<br />');
            }
   
            function appendtodiv_all(data)
            {
                $('#append_div_all').append(JSON.stringify(data));
                $('#append_div_all').append('<br />');
            }

            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '<?php echo FB_APP_ID; ?>',
                    status     : true,
                    cookie     : true,
                    xfbml      : true  
                });

                //  $(document).trigger('fbload');  //  <---- THIS RIGHT HERE TRIGGERS A CUSTOM EVENT CALLED 'fbload'
            };


            // Load the SDK asynchronously
            (function(){
                // If we've already installed the SDK, we're done
                if (document.getElementById('facebook-jssdk')) {return;}

                // Get the first script element, which we'll use to find the parent node
                var firstScriptElement = document.getElementsByTagName('script')[0];

                // Create a new script element and set its id
                var facebookJS = document.createElement('script'); 
                facebookJS.id = 'facebook-jssdk';

                // Set the new script's source to the source of the Facebook JS SDK
                facebookJS.src = '//connect.facebook.net/en_US/all.js';

                // Insert the Facebook JS SDK into the DOM
                firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
            }());
 
   
            $(document).on('click',"#getdata",function(){
                var str = $("#fb_page_ids").val();
                var res = str.split(",");
                
                FB.login(function(response){
                    if (response.authResponse)
                    {
                                                                       
                        var access_token =   FB.getAuthResponse()['accessToken'];
                        access_token_active =  access_token;
			
                        if(res.length>0 && str!="")
                        {                                            
                            $("#append_div").empty();
                            $("#append_div_all").empty();
                                                               
                            var fields='Report_Date,Name,Category,Fans,Talking_About_It,Link,Total_Albums,Total_Pics,Total_Events,Total_Videos,STATUS_weekly_posts,STATUS_likes/post,STATUS_shares/post,STATUS_comments/post,IMAGE_weekly_posts,IMAGE_likes/post,IMAGE_shares/post,IMAGE_comments/post,LINK_weekly_posts,LINK_likes/post,LINK_shares/post,LINK_comments/post';   
                            appendtodiv(fields);
                                                                                                                                
                            var currDate = new Date();
                            var today = currDate.getFullYear() +'/' + (currDate.getMonth()+1) + '/' + currDate.getDate();

                            for(var j = 0; j<res.length; j++)
                            //for(var j = 0; j<1; j++)
                            {
                                var page_id = res[j];
                                page_id = res[j].replace('www','graph');

                                FB.api(page_id+"?fields=name,category,likes,talking_about_count,link,albums.fields(name,count, photos.fields(name, picture)),posts.fields(id,message,created_time,likes,comments,shares,type),videos,events",'GET',
                                {
                                    access_token: access_token_active
                                },

                                function(response)
                                {
                                    var post_types =  {};

                                    var total_events=0;
                                    if(response.events)
                                    {
                                        total_events = response.events.data.length;
                                    }

                                    var total_videos = 0;
                                    if(response.videos)
                                    {
                                        total_videos = response.videos.data.length;
                                    }

                                    var total_pics = 0;
                                    var total_albums = response.albums.data.length;
                                    for(var i = 0; i<response.albums.data.length; i++)
                                    {
                                        var x = 0;
                                        if(response.albums.data[i].count) {
                                            x = response.albums.data[i].count;
                                        }
                                        total_pics = total_pics + x;
                                    }
                                    
                                    s='';
                                    s+= '"' + today +  '","'+response.name +'","' + response.category + '","' + response.likes + '","' + response.talking_about_count + '","' + response.link + '","' + total_albums + '","' + total_pics + '","' + total_events + '","' + total_videos + '",';
                                    
                                    var total_posts = response.posts.data.length;
                                    var total_likes = 0;
                                    var total_shares = 0;
                                    var total_comments = 0;
							
                                    var weeks_betweens = 1;

                                    if(total_posts>0)
                                    {                                                            
                                        var currentdate = new Date(); 
                                        var created_time = response.posts.data[total_posts-1].created_time;                                                               
                                        var created_time_script = new Date(created_time); 
                                        var currentdate = new Date();
                                        weeks_betweens = weeks_between(created_time_script,currentdate);

                                        if(weeks_betweens==0)
                                        {
                                            weeks_betweens = 1;	
                                        }
								
                                        for(var i = 0; i<total_posts; i++)
                                        {
                                            var type_post = response.posts.data[i].type;
									
                                            if(post_types[type_post])
                                            {
                                                post_types[type_post]['count'] = post_types[type_post]['count'] + 1;
                                            }
                                            else
                                            {
                                                //	post_types.push(type_post);
                                                post_types[type_post] = {};
                                                post_types[type_post]['type'] = type_post;
                                                post_types[type_post]['count'] = 1;
                                                post_types[type_post]['social'] = {};
                                                post_types[type_post]['social']['likes'] = 0;
                                                post_types[type_post]['social']['shares'] = 0;
                                                post_types[type_post]['social']['comments'] = 0;
                                            }
                                            if(response.posts.data[i].likes)
                                            {
                                                total_likes = total_likes + response.posts.data[i].likes.data.length;
                                                post_types[type_post]['social']['likes']	= post_types[type_post]['social']['likes'] + response.posts.data[i].likes.data.length;
                                            }
                                            if(response.posts.data[i].shares)
                                            {
                                                total_shares = total_shares + response.posts.data[i].shares.count;	
                                                post_types[type_post]['social']['shares']	= post_types[type_post]['social']['shares'] + response.posts.data[i].shares.count;
                                            }
                                            if(response.posts.data[i].comments)
                                            {
                                                total_comments = total_comments + response.posts.data[i].comments.data.length;	
                                                post_types[type_post]['social']['comments']	= post_types[type_post]['social']['comments'] + response.posts.data[i].comments.data.length;
                                            }
                                        }
                                    }

                                    if(post_types.hasOwnProperty('status'))
                                    {
                                        s += '"'+post_types['status']['count']/weeks_betweens+'"';
                                        s+=',';
                                        s += '"'+post_types['status']['social']['likes']/post_types['status']['count']+'"';
                                        s+=','
                                        s += '"' + post_types['status']['social']['shares']/post_types['status']['count'] + '"';
                                        s+=',';
                                        s += '"' + post_types['status']['social']['comments']/post_types['status']['count'] + '"';
                                        s+=',';

                                    }
                                    else
                                    {
                                        s +='"0","0","0","0",';
                                    }

                                    if(post_types.hasOwnProperty('photo'))
                                    {
                                        s += '"' + post_types['photo']['count']/weeks_betweens + '"';
                                        s+=',';
                                        s += '"' + post_types['photo']['social']['likes']/post_types['photo']['count'] + '"';
                                        //console.log('photo=' +  post_types['photo']['social']['likes'] + '/' + post_types['photo']['count']);
                                        s+=','
                                        s += '"' + post_types['photo']['social']['shares']/post_types['photo']['count'] + '"';
                                        s+=',';
                                        s += '"' + post_types['photo']['social']['comments']/post_types['photo']['count'] + '"';
                                        s+=',';

                                    }
                                    else
                                    {
                                        s +='"0","0","0","0",';
                                    }

                                    if(post_types.hasOwnProperty('link'))
                                    {
                                        s += '"' + post_types['link']['count']/weeks_betweens + '"';
                                        s+=',';
                                        s += '"' + post_types['link']['social']['likes']/post_types['link']['count'] + '"';
                                        s+=','
                                        s += '"' + post_types['link']['social']['shares']/post_types['link']['count'] + '"';
                                        s+=',';
                                        s += '"' + post_types['link']['social']['comments']/post_types['link']['count'] + '"';                                                               }
                                    else
                                    {
                                        s +='"0","0","0","0"';
                                    }
                                    //console.log(s);
                                    appendtodiv(s);
                                }
                            );
                            }
                        }
                        else
                        {
                            alert('Please enter page id');	
                        }
                    }
                    else
                    {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                });
            });
        </script>

        <pre>
            <div id="append_div_all">
            </div>
        </pre>

        <div id="append_div">
        </div>
    </body>
</html>