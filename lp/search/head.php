<?php 
if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']=='localhost') {
	define('LOCALHOST', 1);
//	define('ZINK_APP_FOLDER', '/page2site/');
//	define('FULL_PATH', 'http://localhost/page2site/');
	define('ZINK_APP_FOLDER', '/');
	define('FULL_PATH', 'http://p2s.test/');
    define('FACEBOOK_APP_ID', '160571960685147');
    
} else {
	define('LOCALHOST', 0);
	define('ZINK_APP_FOLDER', '/code/');
//	define('FULL_PATH', 'http://www.page2site.com/code/');
	define('FULL_PATH', 'http://builder.page2site.com/');
    define('FACEBOOK_APP_ID', '334469486646650');
}
define('PAGE2SITE_FOLDER', ZINK_APP_FOLDER);

if(LOCALHOST) {
	define('SMT2', false);
	define('CLICKTALE', false);
	define('GOOGLE_ANALYTICS_CODE', 'UA-38760141-1');
} else {
	define('SMT2', false);
	define('CLICKTALE', false);
	define('GOOGLE_ANALYTICS_CODE', 'UA-37736198-1');
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Page2site. Love at First Site</title>

<meta name="description" content="" >
<meta name="keywords" content="" >
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="shortcut icon" href="/images/favicon.png" />

<meta property="og:title" content="Page2site - your 1 click website">
<meta property="og:type" content="website">
<meta property="og:url" content="http://www.page2site.com/">
<meta property="og:image" content="http://www.page2site.com/images/logo.png">
<meta property="og:site_name" content="Page2site">
<meta property="fb:admins" content="19717048">
<meta property="og:description" content="Convert your Facebook page into a free website - with 1 click">
<meta property="fb:app_id" content="334469486646650">

<meta property="og:email" content="info@page2site.com">
<meta property="og:phone_number" content="+972-50-400-6203">
<meta property="og:fax_number" content="+972-532-570-0386">
    
<!-- Start CSS -->
<link href="css/tipsy.css" rel="stylesheet" type="text/css" media="all" >

<style type="text/css">
.sidebar-post img { width:64px; height:64px;}
.feature-img {width: 92%;}
#main-content #form_name {width: 400px;margin-right: 7px;height: 18px;}
.slide-feature-narrow { width:250px;margin:0 27px 0 0;}
.slide-feature-narrow last { margin-right:0;}
.slide-feature-narrow img { width:100%;}
.slide-content {margin-right:27px;width:310px;}
.anythingSlider .img-mask {overflow:hidden;height:313px;}
#plans thead small { font-size:0.4em;}
#table-rows {margin-top:127px;}
.clear-cell { border:0;background-color:white;}
.center { text-align:center;}
#response {background-color: #006BD1;}
#logo a { background-position-y:15px; background-position-x:3px;}
.tweet_avatar img { border: none;}
.slide-feature-narrow .img-mask { overflow: hidden;height: 313px;}
.fb_iframe_widget iframe { z-index: 10;}
</style>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">

<style type="text/css">
    a.fanpage {height: 50px; width: 50px; display: inline-block}
    .tb img.media-object {width: 50px;}
    .tb h4 {font-size: 12px;font-weight}
    .search_results {
        overflow: auto;
        max-height: 320px;
        /*overflow-y: scroll;*/
        width: 740px;
        margin: 0px;
        border: 1px solid #bbb;
        padding: 10px;
        box-shadow: 4px 4px 7px #ddd;
        background-color:white;
        margin-left: auto;
        margin-right: auto;
        position:relative;
    }
    .tb .media {width: 230px;float: left;margin: 0 0 10px;min-height:80px;}
    .tb .media p {padding:0;margin-bottom:0;color:#999;line-height:1em;}
    .tb .media-address {font-size:0.8em;margin:5px 0;}
    .tb .media-body {margin-left: 5px;width:140px;}
    #stage-wrap{height:393px;}
</style>

<!--[if IE 6]> <link href="css/ie6.css" type="text/css" rel="stylesheet" media="all" /> <![endif]--><!--[if IE 7]> <link href="css/ie7.css" type="text/css" rel="stylesheet" media="all" /> <![endif]--><!--[if IE 9]> <link href="css/ie9.css" type="text/css" rel="stylesheet" media="all" /> <![endif]--><!-- End CSS --><!-- Start Javascript --><!--[if IE 6]> <script src="js/DD_belatedPNG.js"></script> <script> DD_belatedPNG.fix('.ie6fix'); /* Add this class to any PNG that needs to have transparency fixed for IE 6 */ </script> <![endif]-->
<link rel="stylesheet" type="text/css" href="css/fancybox/jquery.fancybox.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">window.jQuery || document.write('<script src="js/jquery-1.7.2.min.js"><\/script>');</script>

<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.jsonp-2.4.0.min.js"></script>

<script src="js/jquery.tipsy.js" type="text/javascript"></script>

<script src="js/bootstrap-modal.js" type="text/javascript"></script>

<!-- fancybox js/css end -->
	<!-- START Google Analytics -->
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  var pluginUrl =
		  '//www.google-analytics.com/plugins/ga/inpage_linkid.js';
		 _gaq.push(['_require', 'inpage_linkid', pluginUrl]);

	  _gaq.push(['_setAccount', '<?= GOOGLE_ANALYTICS_CODE;?>']);
	  _gaq.push(['_setDomainName', 'page2site.com']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	<!-- END Google Analytics -->
	
	<script>
	  function trackEvent(category, action, label) {
			if(typeof(_gaq) != 'undefined') {
				_gaq.push(['_trackEvent', category, action, label])
			}
		}
	</script>
</head>