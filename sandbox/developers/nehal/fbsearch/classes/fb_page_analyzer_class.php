<?php
// define('FB_APP_ID', '214447575282892');
define('FB_APP_ID', '160571960685147');
?>

<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
<div id="fb-root"></div>

<h2>Fanpage Details</h2>
<p>Insert a list of addresses of facebook fan pages you wish to examine. Each page should be in a new row.</p>

<form>
    <textarea id="fb_page_ids" name="fb_page_ids"rows="15" cols="140">
        https://www.facebook.com/ManoloMendezDressage
        https://www.facebook.com/aqha1
    </textarea>
    <br />
    <input type="button" name="getdata" id="getdata" value="Get Information" />
</form>

<script type="text/javascript">

    function download_file(data_array) {
        // var fname = "IJGResults";

        var csvContent = "data:text/csv;charset=utf-8,";
        data_array.forEach(function(infoArray, index){
            dataString = infoArray.join(",");
            csvContent += dataString+ "\n";
        });

        var encodedUri = encodeURI(csvContent);
        window.open(encodedUri);
    }

    function get_total_events(response) {
        if(x = response.events) {
            return x.data.length;
        }
        return 0;
    }

    function get_total_videos(response) {
        if(x = response.videos) {
            return x.data.length;
        }
        return 0;
    }

    function get_total_albums(response) {
        if(x = response.albums) {
            return x.data.length;
        }
        return 0;
    }

    function get_total_posts(response) {
        if(x = response.posts) {
            return x.data.length;
        }
        return 0;
    }

    function get_total_pictures(response) {
        if(!response.albums) {
            return 0;
        }

        var total_pics = 0;

        for(var i = 0; i<response.albums.data.length; i++)
        {
            var x = 0;
            if(response.albums.data[i].count) {
                x = response.albums.data[i].count;
            }
            total_pics = total_pics + x;
        }
        return total_pics;
    }

    function get_last_post_date(response) {
        if(!(x = response.posts)) {
            return null;

        }

        return x.data[0].created_time;
    }

    function calc_post_type_stats(data, posting_period_in_weeks) {
        var number_posts = data.count || 0;

        data.posts_per_week = 0;
        data.likes_per_post = 0;
        data.shares_per_post = 0;
        data.comments_per_post = 0;

        if(number_posts) {
            data.posts_per_week = number_posts / posting_period_in_weeks;
            data.likes_per_post = data.total_likes / number_posts;
            data.shares_per_post = data.total_shares / number_posts;
            data.comments_per_post = data.total_comments / number_posts;
        }

        return data;
    }

    function init_empty_stat(type_post) {
        data = {};
        data.type = type_post;
        data.count = 0;
        data.total_likes = 0;
        data.total_shares = 0;
        data.total_comments = 0;
        return data;
    }

    function get_graph_url(page_url) {
        if(page_url.indexOf('facebook.com')) {
            return page_url.replace('www','graph').trim();
        } else {
            return 'http://graph.facebook.com/'+page_url.trim();
        }
    }

    function parse_post(post) {
        post.likes = post.likes ? post.likes.data.length : 0;
        post.shares = post.shares ? post.shares.count : 0;
        post.comments = post.comments ? post.comments.data.length : 0;
        return post;
    }









    function init_facebook() {
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
    }

    var access_token_active = '';

    function diff_days(date1, date2) {
        var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
        return diffDays = Math.round(Math.abs((date1.getTime() - date2.getTime())/(oneDay)));
    }

    function diff_weeks(date1, date2) {
        return diff_days(date1, date2)/7;
    }

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

    function appendDataToDiv(div, data)
    {
        return div.append(data+'<br/>');
    }

    function appendtodiv(data)
    {
        appendDataToDiv($('#append_div'), data);
    }

    function appendtodiv_all(data)
    {
        appendDataToDiv($('#append_div_all'), JSON.stringify(data));
    }

    function calc_page_stats(response) {
        stats = {};
        stats.post_type = {};
        stats.total_likes = 0;
        stats.total_shares = 0;
        stats.total_comments = 0;
        stats.post_type['status'] = init_empty_stat('status');
        stats.post_type['photo'] = init_empty_stat('photo');
        stats.post_type['link'] = init_empty_stat('link');

        stats.total_events = get_total_events(response);
        stats.total_videos = get_total_videos(response);
        stats.total_albums = get_total_albums(response);
        stats.total_pictures = get_total_pictures(response);
        stats.total_posts = get_total_posts(response);
        stats.last_post_date = get_last_post_date(response);

        if(stats.total_posts > 0)
        {
            posts = response.posts.data;

            var first_post_time = new Date(posts[0].created_time);
            var last_post_time = new Date(posts[posts.length-1].created_time);
            stats.posting_period_in_weeks = diff_weeks(first_post_time, last_post_time);

            for(var i = 0; i<stats.total_posts; i++)
            {
                post = parse_post(posts[i]);

                if(!stats.post_type[post.type]) {
                    stats.post_type[post.type] = init_empty_stat(post.type);
                }

                stats.total_likes += post.likes;
                stats.post_type[post.type].total_likes += post.likes;

                stats.total_shares += post.shares;
                stats.post_type[post.type].total_shares += post.shares;

                stats.total_comments += post.comments;
                stats.post_type[post.type].total_comments += post.comments;

                stats.post_type[post.type].count += 1;
            }
        }

        stats.post_type['status'] = calc_post_type_stats(stats.post_type['status'], stats.posting_period_in_weeks);
        stats.post_type['photo'] = calc_post_type_stats(stats.post_type['photo'], stats.posting_period_in_weeks);
        stats.post_type['link'] = calc_post_type_stats(stats.post_type['link'], stats.posting_period_in_weeks);

        return stats;
    }

    function get_post_type_stats_array(data) {
        return output = [data.count, data.posts_per_week.toFixed(2), data.likes_per_post.toFixed(2), data.shares_per_post.toFixed(2), data.comments_per_post.toFixed(2)];
    }

    function get_and_parse_facebook_data(page_graph_url) {
        page_graph_url = page_graph_url.replace('http:', 'https:');
        FB.api(page_graph_url+"?fields=name,category,category_list,likes,talking_about_count,link,location,albums.fields(name,count, photos.fields(name, picture)),posts.limit(100).fields(id,message,created_time,likes,comments,shares,type),videos,events",
                'GET',
                { access_token: access_token_active },
                function(response)
                {
                    var currDate = new Date();
                    var today = currDate.getFullYear() +'/' + (currDate.getMonth()+1) + '/' + currDate.getDate();
                    var category_list;

                    if(response.id) {
                        stats = calc_page_stats(response);
                        category_list = JSON.stringify(response.category_list);
                        category_list = '"' + category_list.replace(/"/g, "'") + '"';
                        output = [today, '"'+response.name+'"', response.id, response.category, category_list, response.likes, response.talking_about_count, response.link, stats.total_albums, stats.total_pictures, stats.total_events, stats.total_videos, stats.total_posts, stats.posting_period_in_weeks, stats.last_post_date];
                        output = output.concat(response.location.country,response.location.city,response.location.street);

                        output = output.concat(get_post_type_stats_array(stats.post_type['status']));
                        output = output.concat(get_post_type_stats_array(stats.post_type['photo']));
                        output = output.concat(get_post_type_stats_array(stats.post_type['link']));

                        write_output(output);
                    }
                }
        );
    }

    function write_output(data) {
        console.log(data);
        appendtodiv(data+"\n");
    }

    function sleep(ms) {
        var unixtime_ms = new Date().getTime();
        while(new Date().getTime() < unixtime_ms + ms) {}
    }

    init_facebook();

    var res;
    var j;

    function run(j) {
        setTimeout(function() { run_inner(j); },
                j*300);
    }

    function run_inner(j) {
        page_graph_url = get_graph_url(res[j]);
        get_and_parse_facebook_data(page_graph_url);
    }

    $(document).on('click',"#getdata",function(){
        var str = $("#fb_page_ids").val();
        res = str.split("\n");

        FB.login(function(response){
            if (response.authResponse)
            {
                var access_token =   FB.getAuthResponse()['accessToken'];
                access_token_active =  access_token;

                if(res.length>0)
                {
                    $("#append_div").empty();
                    $("#append_div_all").empty();

                    var fields = 'Report_Date,Name,Facebook_id,Category,Category List,Fans,Talking_About_It,Link,Total_Albums,Total_Pictures,Total_Events,Total_Videos,Total_Posts,Posting period [weeks],Last Post Date,'
                            + 'Country,City,Street,'
                            + 'Total_Posts_Status,Status_weekly_posts,Status_likes/post,Status_shares/post,Status_comments/post,'
                            + 'Total_Posts_Photo,Photo_weekly_posts,Photo_likes/post,Photo_shares/post,Photo_comments/post,'
                            + 'Total_Posts_Status,Link_weekly_posts,Link_likes/post,Link_shares/post,Link_comments/post';
                    appendtodiv(fields);

                    for(j = 0; j<res.length; j++)
                    {
                        run(j);
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