<?php
//define('FB_APP_ID','465662550211381');
define('FB_APP_ID', '521672164595139');
?>
<html>
    <head>
        <script type="text/javascript" src="js/jquery-1.10.1.min.js" ></script>
    </head>
    <body>
        <div id="fb-root"></div>

        Fanpage Details
        593574567345823,150696781678371 

        <form>
            <textarea id="fb_page_ids" name="fb_page_ids"rows="20" cols="40">https://www.facebook.com/Raiders,https://www.facebook.com/newyorkgiants,https://www.facebook.com/philadelphiaeagles,https://www.facebook.com/redskins,https://www.facebook.com/ChicagoBears,https://www.facebook.com/DetroitLions,https://www.facebook.com/Packers,https://www.facebook.com/minnesotavikings,https://www.facebook.com/atlantafalcons,https://www.facebook.com/CarolinaPanthers,https://www.facebook.com/neworleanssaints,https://www.facebook.com/tampabaybuccaneers,https://www.facebook.com/arizonacardinals,https://www.facebook.com/Rams,https://www.facebook.com/SANFRANCISCO49ERS,https://www.facebook.com/Seahawks</textarea>
            <br />
            <input type="button" name="getdata" id="getdata" value="Get Information" />
        </form>
        <!--
        <pre>
        https://developers.facebook.com/docs/reference/api/page/
        <br />
        http://www.crashcoder.com/facebook-query-language-fql-tips-and-tricks/
        <br />
        https://developers.facebook.com/docs/reference/fql/
        <br />
        http://stackoverflow.com/questions/15488044/problems-in-fql-query-with-multiple-source-id
        </pre>-->
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
                
		
                /*		FB.getLoginStatus(function(response) {
          if (response.status === 'connected') {
            // the user is logged in and has authenticated your
            // app, and response.authResponse supplies
            // the user's ID, a valid access token, a signed
            // request, and the time the access token 
            // and signed request each expire
            var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;
          } else if (response.status === 'not_authorized') {
            // the user is logged in to Facebook, 
            // but has not authenticated your app
          } else {
            // the user isn't logged in to Facebook.
          }
         });*/
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
                                                                                                                                
                            //res=res.replace();

                            var currDate=new Date();
                            var today=currDate.getFullYear() +'/' + (currDate.getMonth()+1) + '/' + currDate.getDate();
                            //for(var j = 0; j<res.length; j++)
                            for(var j = 0; j<1; j++)
                            {
                                                                        
                                                                        
                                var page_id = res[j];
                                page_id=res[j].replace('www','graph');
                                // alert(page_id);
                                                                        
                                FB.api(page_id+"?fields=name,category,likes,talking_about_count,link,albums.fields(name,count, photos.fields(name, picture)),posts.fields(id,message,created_time,likes,comments,shares,type),videos,events",'GET',
                                {
                                    access_token: access_token_active,
                                },
                                function(response)
                                {
                                                                                                       
                                    //document.write(JSON.stringify(response));
                                    alert(JSON.stringify(response));
                                    var post_types =  {};
                                    //appendtodiv("========================"+page_id+"===============================");
                                    //appendtodiv_all("========================"+page_id+"===============================");
                                    //appendtodiv_all(response.posts.data);
                                    //	alert(JSON.stringify(response.posts.data.length));
                                    var total_pics = 0;
                                    var total_events = 0;
                                    var total_albums = response.albums.data.length;
                                    
                                                                                                               
                                    //                                                                                                                appendtodiv("Name = "+response.name);
                                    //	  						appendtodiv("Category = "+response.category);
                                    //	  						appendtodiv("Fans = "+response.likes);
                                    //	  						appendtodiv("Talking about it = "+response.talking_about_count);
                                    //	  						appendtodiv("Link = "+response.link);
                                    //							appendtodiv("Total Albums = "+total_albums);
                                    //							appendtodiv("Total Pics = "+total_pics);
                                    //							appendtodiv("Total Events = "+total_events);
                                    //							appendtodiv("Total Videos = "+total_videos);
                                    //                                                                                                                appendtodiv(fields);
                                                                                                                
                                    ///alert(page_id);
                                                                                                              
                                   
                                    //                                                                                                                 
                                    //                                                                                                        
                                                                                                               
                                                                                                                
                                    if(response.events)
                                    {
                                        total_events = response.events.data.length;
                                    }
                                    else
                                        {
                                            total_events=0;
                                        }
                                    var total_videos = 0;
                                    if(response.videos)
                                    {
                                        total_videos = response.videos.data.length;
                                    }
                                    else
                                        {
                                            total_videos=0;
                                        }
                                    for(var i = 0; i<response.albums.data.length; i++)
                                    {
                                        if(response.albums.data[i].count)
                                        var x =response.albums.data[i].count;
                                        else
                                            var x=0;
                                        total_pics = total_pics + x;
                                    }
                                    
                              //      alert(total_pics);
                                    
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
                                        //console.log('WEEKS='+weeks_betweens);
                                        //alert(weeks_betweens);
                                        if(weeks_betweens==0)
                                        {
                                            weeks_betweens = 1;	
                                        }
								
                                        for(var i = 0; i<total_posts; i++)
                                        {
                                            var type_post = response.posts.data[i].type;
									
                                            //alert(type_post);
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
								
                                        //alert(JSON.stringify(post_types));
                                    }
							
							
                                    //appendtodiv("Total Posts = "+total_posts);
                                    //appendtodiv("Total Posts per week (average) = "+parseInt(total_posts/weeks_betweens));
                                    //appendtodiv("Total likes of all posts = "+total_likes);
                                    //appendtodiv("Total comments of all posts = "+total_comments);
                                    //appendtodiv("Total shares of all posts = "+total_shares);
                                    /*if(total_likes==0)
                                                                {
                                                                        appendtodiv("Number of likes per post (average) = 0");
                                                                }
                                                                else
                                                                {
                                                                        appendtodiv("Number of likes per post (average) = "+(total_likes/total_posts));
                                                                }
							
							
                                                                if(total_comments==0)
                                                                {
                                                                        appendtodiv("Number of comments per post (average) = 0");
                                                                }
                                                                else
                                                                {
                                                                        appendtodiv("Number of comments per post (average) = "+(total_comments/total_posts));
                                                                }
							
                                                                if(total_shares==0)
                                                                {
                                                                        appendtodiv("Number of shares per post (average) = 0");
                                                                }
                                                                else
                                                                {
                                                                        appendtodiv("Number of shares per post (average) = "+(total_shares/total_posts));
                                                                }*/
                                    //alert(JSON.stringify(post_types));
                                                                                                                
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
                                    //alert(post_types['status']['count']);
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
		
		    
		
                /*	FB.api('/oauth/access_token?client_id=465662550211381&client_secret=a28c37d77337a771a63a2ac4ad9c31a8&grant_type=client_credentials','GET',
                        {},
                                function(response)
                                {
                                        appendtodiv_all(response);
                                        appendtodiv("Name = "+response.name);
                                        appendtodiv("Category = "+response.category);
                                        appendtodiv("Fans = "+response.likes);
                                        appendtodiv("Talking about it = "+response.talking_about_count);
                                        appendtodiv("Link = "+response.link);
                                }
                        ); */
		
                /*FB.api({
            method: 'fql.multiquery',
                queries: {
              //  query1: "SELECT src, pid FROM photo WHERE pid IN (SELECT pid FROM photo_tag WHERE subject IN ('593574567345823','150696781678371')) OR pid IN (SELECT pid FROM photo WHERE aid IN (SELECT aid FROM album WHERE owner IN ('593574567345823','150696781678371') AND type!='profile'))",
        //	details: "SELECT name,page_id,page_url,categories,fan_count,talking_about_count FROM page WHERE page_id IN ('593574567345823','150696781678371')",
        //	video: "SELECT vid,title,owner FROM video WHERE owner IN ('593574567345823','150696781678371')",
        //	album: "SELECT name,size,owner,type FROM album WHERE owner IN ('593574567345823','150696781678371') AND type!='wall' AND type!='profile'",
        posts: "SELECT post_id,created_time,type,source_id,type,message FROM stream WHERE source_id IN ('593574567345823','150696781678371')",
        //	events: "SELECT eid,creator FROM event WHERE creator in ('593574567345823','150696781678371')",
            },
                api_key:'465662550211381',
                apiKey:'465662550211381',
                appId:'465662550211381',
                access_token:'CAAGnhILjZBzUBAO8rxZCeLZCgbHKUp7Buh6yBYHJ0xrdXcvyH6lLIDwM0QRIh0UqSbdgtV7IWmsDc3MShh8SL2ZAaetc793R88KtAwcqF4jagZAh0fW7BV3FCHTNhfCvKamTUrN1EWDbys2o6l9XBEj1GFjrd6eijZBZBvkg7iHLDccMbro4acVR2Fl34frLanrPDYXIDIFEwZDZD',
	
   
    
        }, function(response){
            console.log(response);
                appendtodiv_all(response);
        });*/
		
                /*    FB.api('/593574567345823?fields=name,category,likes,talking_about_count,link,albums.fields(name,count, photos.fields(name, picture)),posts.fields(id,message)','GET',
                        {
                        access_token: 			'CAAGnhILjZBzUBAEb2UTmpcnXTHXxvX7bPc9u1xjPLxuc9B7KJxJaTFFIybYs4PqRVJHvRpjxi9BGz0NgHRLh3ZBERuABaXcJL0IgHrDXlHTyraZAxQ883nC37CKMmPKrSqIzafxcf75kRqTIpaKPYUGaZByLWC0PKgUUa10ImLoiHlUXiqBHlzDX7akYEPU29IudXlf9VQZDZD',
                        },
                                function(response)
                                {
                                        appendtodiv_all(response.posts);
                                        appendtodiv("Name = "+response.name);
                                        appendtodiv("Category = "+response.category);
                                        appendtodiv("Fans = "+response.likes);
                                        appendtodiv("Talking about it = "+response.talking_about_count);
                                        appendtodiv("Link = "+response.link);
                                }
                        );*/
		
                /* FB.api('/593574567345823?fields=albums.limit(5).fields(name, photos.limit(2).fields(name, picture, tags.limit(2)))','GET',
                        {
                        access_token: 			'CAACEdEose0cBAE3TCcBDZCJcfPSAukHDNrdZAjcdR8yYpN3OBeKwgkIRlIQ1jQDPPxZC3W1pZBdpqKnwJZC0NuCXd6DBlfuxgoqjYR0qUnZAeUo14C2kdnZB4csZBHqWC1rdfBqhwZAKs0Vyl8bYwioM3POFwvwDQ3l3rjDPeNIaOwch8uomZARaVlYKlZCFQjzop4ZD',
                        },
                                function(response)
                                {
                                        //alert(JSON.stringify(response.images));
                                //	alert(JSON.stringify(response.data));
	  			
                                        appendtodiv_all(response);
	  			
                                }
                        ); */
            });
        </script>
        <?php
#$data = '{"link":"https://www.facebook.com/testpagemys","name":"Testpage","talking_about_count":0,"likes":2,"category":"Community","id":"593574567345823","posts":{"data":[{"id":"593574567345823_226184934223660","created_time":"2013-11-13T11:42:20+0000"},{"id":"593574567345823_593659404004006","created_time":"2013-11-12T14:09:26+0000"},{"id":"593574567345823_593658850670728","created_time":"2013-11-12T14:07:32+0000"},{"id":"593574567345823_593628854007061","message":"test","created_time":"2013-11-12T12:18:10+0000"},{"id":"593574567345823_593628770673736","message":"I am an old post.","created_time":"2013-11-12T12:17:45+0000"},{"id":"593574567345823_593628754007071","message":"this is 2nd test post","created_time":"2013-11-12T12:17:42+0000"},{"id":"593574567345823_593628620673751","message":"I am an old post.","created_time":"2013-11-12T12:17:09+0000"},{"id":"593574567345823_593628440673769","message":"this is a test post","created_time":"2013-11-12T12:15:55+0000"},{"id":"593574567345823_593574584012488","created_time":"2013-11-12T09:15:35+0000"}],"paging":{"previous":"https://graph.facebook.com/593574567345823/posts?fields=id,message,created_time&access_token=CAAGnhILjZBzUBACaZC4ZCuY0IqOxtkwhQ7TTVIA2w75KmK7hJvG4jJZAJAOsa6pbDqLda35l19XwynnXyQrzlqrUKTTECpduSwqcf5F4an9yGKMIMOzdSC9yPIiVwZAd2jyyDT58iKTBuVk6pbJJe1vdGL5CJasmNw4jY0FQSpGqsPdmknYuNFNykVnZCfIRISYXOLwaGPagZDZD&limit=25&since=1384342940&__previous=1","next":"https://graph.facebook.com/593574567345823/posts?fields=id,message,created_time&access_token=CAAGnhILjZBzUBACaZC4ZCuY0IqOxtkwhQ7TTVIA2w75KmK7hJvG4jJZAJAOsa6pbDqLda35l19XwynnXyQrzlqrUKTTECpduSwqcf5F4an9yGKMIMOzdSC9yPIiVwZAd2jyyDT58iKTBuVk6pbJJe1vdGL5CJasmNw4jY0FQSpGqsPdmknYuNFNykVnZCfIRISYXOLwaGPagZDZD&limit=25&until=1384247734"}},"albums":{"data":[{"name":"test_album","count":2,"id":"593658700670743","created_time":"2013-11-12T14:07:11+0000","photos":{"data":[{"picture":"https://fbcdn-photos-g-a.akamaihd.net/hphotos-ak-frc3/1453519_593658744004072_181899711_s.png","id":"593658744004072","created_time":"2013-11-12T14:07:17+0000"},{"picture":"https://fbcdn-photos-a-a.akamaihd.net/hphotos-ak-ash3/1456106_593659300670683_1300512886_s.jpg","id":"593659300670683","created_time":"2013-11-12T14:09:21+0000"}],"paging":{"cursors":{"after":"NTkzNjU5MzAwNjcwNjgz","before":"NTkzNjU4NzQ0MDA0MDcy"}}}},{"name":"Profile Pictures","count":1,"id":"593575484012398","created_time":"2013-11-12T09:16:59+0000","photos":{"data":[{"picture":"https://fbcdn-photos-e-a.akamaihd.net/hphotos-ak-frc3/1471232_593575530679060_1005377251_s.png","id":"593575530679060","created_time":"2013-11-12T09:17:18+0000"}],"paging":{"cursors":{"after":"NTkzNTc1NTMwNjc5MDYw","before":"NTkzNTc1NTMwNjc5MDYw"}}}}],"paging":{"cursors":{"after":"NTkzNTc1NDg0MDEyMzk4","before":"NTkzNjU4NzAwNjcwNzQz"}}},"events":{"data":[{"name":"Test event","start_time":"2013-11-12","location":"testpage, 143001","id":"226184934223660"}],"paging":{"cursors":{"after":"MjI2MTg0OTM0MjIzNjYw","before":"MjI2MTg0OTM0MjIzNjYw"}}}}';
#$array = json_decode($data);
        echo '<pre>';
#print_r($array);
#$array2 = '[{"id":"593574567345823_594380330598580","created_time":"2013-11-14T10:27:34+0000","type":"link"},{"id":"593574567345823_594380293931917","created_time":"2013-11-14T10:27:29+0000","type":"status"},{"id":"593574567345823_226184934223660","created_time":"2013-11-13T11:42:20+0000","type":"link"},{"id":"593574567345823_593659404004006","created_time":"2013-11-12T14:09:26+0000","type":"photo"},{"id":"593574567345823_593658850670728","created_time":"2013-11-12T14:07:32+0000","type":"photo"},{"id":"593574567345823_593628854007061","message":"test","created_time":"2013-11-12T12:18:10+0000","type":"status","likes":{"data":[{"id":"593574567345823","name":"Testpage"}],"paging":{"cursors":{"after":"NTkzNTc0NTY3MzQ1ODIz","before":"NTkzNTc0NTY3MzQ1ODIz"}}}},{"id":"593574567345823_593628770673736","message":"I am an old post.","created_time":"2013-11-12T12:17:45+0000","type":"status","likes":{"data":[{"id":"100001391356383","name":"Mayank Sood"}],"paging":{"cursors":{"after":"MTAwMDAxMzkxMzU2Mzgz","before":"MTAwMDAxMzkxMzU2Mzgz"}}}},{"id":"593574567345823_593628754007071","message":"this is 2nd test post","created_time":"2013-11-12T12:17:42+0000","type":"status","likes":{"data":[{"id":"593574567345823","name":"Testpage"}],"paging":{"cursors":{"after":"NTkzNTc0NTY3MzQ1ODIz","before":"NTkzNTc0NTY3MzQ1ODIz"}}}},{"id":"593574567345823_593628620673751","message":"I am an old post.","shares":{"count":1},"created_time":"2013-11-12T12:17:09+0000","type":"status","likes":{"data":[{"id":"100001391356383","name":"Mayank Sood"}],"paging":{"cursors":{"after":"MTAwMDAxMzkxMzU2Mzgz","before":"MTAwMDAxMzkxMzU2Mzgz"}}},"comments":{"data":[{"id":"593628620673751_94198089","from":{"category":"Community","name":"Testpage","id":"593574567345823"},"message":"ok this is more cool","can_remove":true,"created_time":"2013-11-14T10:27:29+0000","like_count":0,"user_likes":false}],"paging":{"cursors":{"after":"MQ==","before":"MQ=="}}}},{"id":"593574567345823_593628440673769","message":"this is a test post","created_time":"2013-11-12T12:15:55+0000","type":"status","likes":{"data":[{"id":"593574567345823","name":"Testpage"}],"paging":{"cursors":{"after":"NTkzNTc0NTY3MzQ1ODIz","before":"NTkzNTc0NTY3MzQ1ODIz"}}}},{"id":"593574567345823_593574584012488","created_time":"2013-11-12T09:15:35+0000","type":"status"}]';
#$array2 = '{"link":{"type":"link","count":2,"social":{"likes":0,"shares":0,"comments":0}},"status":{"type":"status","count":7,"social":{"likes":5,"shares":1,"comments":1}},"photo":{"type":"photo","count":2,"social":{"likes":0,"shares":0,"comments":0}}}';
#print_r(json_decode($array2));
        ?>
        <pre>
<div id="append_div_all" style="width:100%; height:auto; float:left; overflow:scroll;">

</div>
        </pre>
        <div id="append_div" style="width:100%; height:auto; float:left; overflow:scroll;">

        </div>
    </body>
</html>