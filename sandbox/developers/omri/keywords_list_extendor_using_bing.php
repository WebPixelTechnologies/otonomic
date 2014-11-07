<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
<div id="fb-root"></div>

<p>List of Keywords</p>

<form>
    <textarea id="input" name="input" rows="15" cols="140">
    yoga
    shiatsu
    </textarea>
    <br />
    <input type="button" name="getdata" id="getdata" value="Get relevant keywords" />
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

function write_output(data) {
    console.log(data);
    appendtodiv(data+"\n");
}

function sleep(ms) {
    var unixtime_ms = new Date().getTime();
    while(new Date().getTime() < unixtime_ms + ms) {}
}

var res;
var j;

function run(j) {
    setTimeout(function() { run_inner(j); },
            j*200);
}

function run_inner(j) {
    var original_keyword = res[j].trim();
    if(!original_keyword) { return; }

    var query_url = get_query_url(original_keyword);
    var new_keywords = get_related_keywords(original_keyword);

}

function get_query_url(query) {
    // return "http://api.bing.com/osjson.aspx?query="+query+"&callback=?";
    return "http://api.bing.com/osjson.aspx";
}

function get_related_keywords(query) {
    /*
    $.getJSON(url, null, function(result){
                add_new_keywords(result);
            }
    );
    */

    $.ajax({
        url: "http://api.bing.com/osjson.aspx",

        // the name of the callback parameter, as specified by the YQL service
        jsonp: "callback",

        // tell jQuery we're expecting JSONP
        dataType: "jsonp",

        // tell YQL what we want and that we want JSON
        data: {
            query: query
        },

        // work with the response
        success: function( response ) {
            console.log( response ); // server response
        }
    });
}

function add_new_keywords(data) {
    if(!data[1]) { return false; }

    var new_keywords = data[1];
    var l = new_keywords.length;

    for(var i=0; i<l; i++) {
        appendtodiv(original_keyword + ", " + new_keywords[i]);
    }

    return new_keywords;
}

$(document).on('click',"#getdata",function(){
    var str = $("#input").val();
    res = str.split("\n");

    var fields='Original Keywords, Suggested Keyword';
    appendtodiv(fields);

    for(j = 0; j<res.length; j++)
    {
        run(j);
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