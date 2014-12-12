<?php
// define('FB_APP_ID', '214447575282892');
switch($_SERVER['HTTP_HOST']) {
    case "localhost":
        $fb_app_id = '160571960685147';
        break;

    case "otonomic.test":
        $fb_app_id = '286934271328156';
        break;

    case "otonomic.com":
        define('FB_APP_ID', '');
        break;
}

if(isset($_GET['FB_APP_ID'])) {
    $fb_app_id = $_GET['FB_APP_ID'];
}

define('FB_APP_ID', $fb_app_id);


/*
 * This code gets a list of URLs of Facebook fan pages, and queries them to extract relevant stats, e.g. # of posts, # of photos, posting frequency etc.
 * The code makes Javascript Ajax calls for each facebook page, and outputs the results as a text string that can then be copied and read as a CSV file.
 */
?>

<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
<div id="fb-root"></div>

<h2>Fanpage Details</h2>
<p>Insert a list of addresses of facebook fan pages you wish to turn into sites. Each page should be in a new row.</p>

<form>
    <textarea id="fb_page_ids" name="fb_page_ids"rows="15" cols="140">
https://www.facebook.com/ManoloMendezDressage
https://www.facebook.com/aqha1</textarea>
    <br />
    <input type="button" name="getdata" id="getdata" value="Get Information" />
    <div id="queries-left-div"></div>
    <div id="queries-errors-div"></div>
    <div id="queries-left-list-div"></div>
</form>

<script type="text/javascript">
    var query_status;
    var queries_left;
    var queries_errors = 0;

    function get_query_url(page_url) {
        return page_url;
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

    function csvencode(str) {
        return '"' + str + '"';
    }

    function get_data(page_graph_url, index) {

        page_id = page_graph_url.replace('http:', '').replace('https:','').replace('//www.facebook.com/','');

        (function(index2) {
            jQuery.getJSON('http://wp.otonomic.com/migration/index.php?theme=dreamspa&facebook_id='+page_id,
                function(response) {
                    if(response.site_url) {
                        output = [index, page_graph_url, response.site_url];
                        write_output(output);

                        query_status[index2] = 2;

                    } else {
                        query_status[index2] = 3;

                        if(typeof(response.error)!=="undefined" && typeof(response.error.code)!=="undefined" && response.error.code>600) {
                            alert(response.error.message);
                        }
                    }

                    queries_left--;
                    $('#queries-left-div').html(queries_left + ' queries left.');

                    if(typeof(query_status)!=="undefined") {
                        $('#queries-left-list-div').html(
                            query_status.map(function(elem, idx) {
                                return (elem<2) ? idx : null;
                            }).join(', ')
                        );
                    } else {
                        queries_errors++;
                        $('#queries-errors-div').html(queries_errors + " errors.");
                        console.log('Error setting query status for element #'+index2);
                        console.log(response);
                    }

                }
            );
        }) (index);
    }

    function write_output(data) {
        // console.log(data);
        appendtodiv(data+"\n");
    }

    var res;
    var j;

    function run(j) {
        setTimeout(function() { run_inner(j); },
            Math.floor(j/590)*600*1000 + j*100); // Limit rate to 590 in 600 seconds
    }

    function run_inner(j) {
        record = res[j].split(",");

        if(record.length == 2) {
            page_graph_url = get_query_url(record[1]);

        } else {
            page_graph_url = get_query_url(record[0]);
        }
        query_status[j] = 1;
        get_data(page_graph_url, j);
    }

    jQuery(document).on('click',"#getdata",function(){
        var str = $("#fb_page_ids").val();
        res = str.split("\n");

        if(res.length > 0) {
            query_status = Array.apply(null, Array(res.length)).map(Number.prototype.valueOf,0);
            keywords = Array.apply(null, Array(res.length)).map(String.prototype.valueOf,"");
            queries_left = res.length;
            $('#queries-left-div').html(queries_left + ' queries left.');

            $("#append_div").empty();
            $("#append_div_all").empty();

            var fields = 'Fanpage Url,Site Url';
            appendtodiv(fields);

            for(j = 0; j<res.length; j++) {
                run(j);
            }

        } else {
            alert('Please enter page id');
        }
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