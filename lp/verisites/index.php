<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <title>Create and Update Website from Facebook Page</title>

    <meta name="title" content="Create and Update Website from Facebook Page" />
    <meta name="type" content="website" />
    <meta name="description" content="Have a Facebook Page and looking to make a website? Verisites is an easy way to create and update a beautiful website from Facebook Pages." />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <meta name="ROBOTS" content="NOARCHIVE" /> <!--Prevents browsers from caching-->

    <meta property="og:title" content="Verisites" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.verisites.com" />
    <meta property="og:description" content="Turn your Facebook page into a beautiful website">
    <meta property="og:image" content="http://www.verisites.com/images/logo_transparent_509_250.png" />
    <base  />

    <!--<script type="text/javascript" src="core/compiled/clientside/2a2e3649b8e4a5eddf7a01ac134e46a393c2.js?omg=ihatecache"></script>-->
    <link href="core/compiled/clientside/2a2e3649b8e4a5eddf7a01ac134e46a393c2.css" rel="stylesheet" type="text/css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.jsonp-2.4.0.min.js"></script>
    <script src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>

    <?php include_once('../../shared/shared_code_head.php');?>

    <script src="../../shared/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="assets/js/jquery.easing.1.2.js" type="text/javascript"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

    <script src="assets/js/search_filter.js" type="text/javascript"></script>

		<!-- javascript needed in head for functionality -->
		<script type="text/javascript">
			(function() {
				if (!window.console) {
					window.console = {};
				}
				// union of Chrome, FF, IE, and Safari console methods
				var m = [
				"log", "info", "warn", "error", "debug", "trace", "dir", "group",
				"groupCollapsed", "groupEnd", "time", "timeEnd", "profile", "profileEnd",
				"dirxml", "assert", "count", "markTimeline", "timeStamp", "clear"
				];
				// define undefined methods as noops to prevent errors
				for (var i = 0; i < m.length; i++) {
					if (!window.console[m[i]]) {
						window.console[m[i]] = function() {};
					}
				}
			})();
		</script>
		<!-- <script type="text/javascript" src="templates/snapsite/homepage/js/custom.js"></script>
		-->
		<!--end homepage javascript-->


		<!--<link rel="stylesheet" href="templates/snapsite/homepage/css/lavalamp.css">-->
		<!--[if IE 7]>
		<link rel="stylesheet" href="templates/snapsite/homepage/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!--[if lt IE 9]>
		<link rel="stylesheet" media="all" type="text/css" href="templates/snapsite/homepage/css/ie.css" />
		<![endif]-->

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="templates/snapsite/homepage/js/html5shiv.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="templates/snapsite/homepage/ico/apple-touch-icon-144-precomposed.html">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="templates/snapsite/homepage/ico/apple-touch-icon-114-precomposed.html">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="templates/snapsite/homepage/ico/apple-touch-icon-72-precomposed.html">
		<link rel="apple-touch-icon-precomposed" href="templates/snapsite/homepage/ico/apple-touch-icon-57-precomposed.html">
		<link rel="apple-touch-icon-precomposed" href="templates/snapsite/homepage/ico/apple-touch-icon-precomposed.html">
		<link rel="shortcut icon" href="templates/snapsite/homepage/ico/favicon.html">

        <style>
            .center {text-align:center;margin-right:auto;margin-left:auto;}
            .nt {
                display: none;
            }
            #banner .search {top: 120px; top: 189px;}
            .vamp_input.vamp_input2.formapi_placeholder{width:600px !important;}
            .form-search {width: 790px !important;}
            .form-search .search-wrapper{position: absolute;margin-top:5px;}
            #banner .search .main h2 {font-size:34px;text-align: center;margin-top:15px;margin-left: 120px;}
            #fix_head .logo{padding:0;}
            #footer h3 {margin-bottom: 5px;}
            #footer .foot ul li {margin-bottom: 5px;}
            #footer {padding: 20px;}
            #fix_head .search .form-search input[type="text"] {width:500px;}
            #banner .search .main .form-search {margin-left:10%;}
            #banner .carousel-9999 .item.one {background-image: url(images/header_sun.jpg);background-position: 0 -395px;}
            #banner .carousel-caption{margin-top:450px;padding-bottom:30px;text-align: center;}
            #testi .carousel-indicators .active {
                background-color: #a3238e;
            }
            #sponsor h2{color:#a3238e;}
            .testi_holder .name span{color:#a3238e;}
            .btn_fb_login {color: #a3238e !important;}
            #fix_head .search .form-search button, .btn.btn_vamp.btn_vamp2 {background-color: #A3238E !important;}
            .search_results{text-align: left;}
            #banner .search .main .form-search {background: none;}

            .vamp_input.vamp_input2.formapi_placeholder.searchfb {text-align: left !important;color:#000000 !important;}
            .vamp_input.searchfb.formapi_placeholder {text-align: left !important;color:#000000 !important;}

            a.brand{position: absolute;left: 196px;}
            a.brand img{width:170px;}

            .clear {
                clear: both !important;
                height: 0px !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            a.brand{position: inherit;float:left;}
            #banner .search .main h2 {
                float: left;
                margin-left: 20px;
                margin-top: 0px;
                text-align: left;
                margin-bottom:15px;}


            #banner .search .main .form-search {
                margin: 0 auto;
            }
            .main {width:880px;}
            .vamp_input.vamp_input2.formapi_placeholder.searchfb {
                color: #000 !important;
            }
            #banner .search .main{padding:20px;background:rgba(0, 0, 0, 0.42);}

            #banner .search .main .form-search input[type="text"], .vamp_input.vamp_input2.formapi_placeholder.searchfb {
                background: url(images/searchIcon.png) no-repeat 8px 2px #FFF;
                font: 300 28px Arial,Helvetica,Sans-serif;
                color: #555;
                width: 500px;
                padding: 10px 30px 11px 60px;
                border-radius: 5px;
                -webkit-transition: all 0.5s ease 0s;
                -moz-transition: all 0.5s ease 0s;
                -o-transition: all 0.5s ease 0s;
                transition: all 0.5s ease 0s;
                border: 2px solid #FFF;
                line-height: 1.3;
                height: 2em;
                font-size: 25px;
            }
            a.brand img {
                background-color: #FFF;
                padding: 5px;
                margin-top: 16px;
            }
            #testi {
                display: none;
            }

            @media only screen and (max-width: 769px) {
                #banner .search {top: inherit;position: relative;width: 100%;padding: 0;}
                #banner .search .main {
                    padding: 15px 0 5px;
                    margin: 0;
                    width: 100%;
                    text-align: center !important;
                }
                a.brand{float: initial;}
                #banner .search .main h2 {
                    float: left;
                    margin-left: 0;
                    margin-top: 10px;
                    text-align: center;
                    margin-bottom: 15px;
                    font-size: 22px;
                    color: #555
                }
                #banner .search .main{background:none;}
                .vamp_input.vamp_input2.formapi_placeholder.searchfb{width: 90%;background-color: #F9FFFE;border: 1px solid #BBB;}
                #banner .search .main .form-search{display: block;width: 100% !important;padding: 5px !important;margin: 0 !important;}
                .vamp_input.vamp_input2.formapi_placeholder{width:100% !important;width: 90% !important; background-color: #F9FFFE !important; border: 1px solid #BBB !important;}
                #banner .search .main h2 {margin-left: auto;float:none;}
                .search-results-item .pull-left.fanpage {float: left;}
                .search_results {width: 90%;}
                #header .nav-collapse .nav {background: black;}
                .form-search .search-wrapper {position: absolute;margin-top: 5px;background-color: #FFF;border: 1px solid #EEE;padding: 5px;width: 95%;}
                .navbar.navbar-inverse {display: none;}
                .vamp_input.vamp_input2.formapi_placeholder.searchfb:focus {background-color: #F5E8CE !important;}
                search_results {max-height: inherit}
            }
        </style>

	</head>

	<body>
		<div id="fb-root"></div>

    <!-- Wrap
    ================================================== -->
    <div id="wrap">
    	
        <!-- Fixed Header
        ================================================== -->
        <div id="fix_head" class="ha-header-hide">
        	<div class="container">
            	<div class="row">
                	<div class="span2">
                    	<div class="logo"><a href="#" title="verisites"><img src="templates/snapsite/homepage/img/logo_fixed.png"></a></div><!-- /.logo -->
                    </div>
                    <div class="span9">
                        <div class="search">
                            <div class="container">
                                <div class="span7">
                                    <div class="main">
                                        <div class="form-search center">
                                            <input type="text" class="vamp_input searchfb" data-placeholder="Type Your Facebook Page Name..." data-enter=".btn_vamp1"></input>
                                            <!--<button class="btn btn_vamp btn_vamp1">View Your Site</button>-->
											<div class="tb search-wrapper"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.search -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Header
        ================================================== -->
        <div id="header">
            <!-- NAVBAR
            ================================================== -->
            <div class="navbar-wrapper">
              <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
              <div class="container">
        
                <div class="navbar navbar-inverse">
                  <div class="navbar-inner">
                    <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                    <div class="nav-collapse collapse">
                      <ul class="nav">
                        <li><a href="http://www.youtube.com/watch?v=c9HlSITDejc?fs=1&amp;autoplay=1&amp;vq=hd1080" class="video">Video</a></li>
                        <li class="active"><a class="btn_fb_login" href="javascript:void(0);">Login</a></li>
                      </ul>
                    </div><!--/.nav-collapse -->
                  </div><!-- /.navbar-inner -->
                </div><!-- /.navbar -->
        
              </div> <!-- /.container -->
            </div><!-- /.navbar-wrapper -->
        </div>
        
        <!-- Banner
        ================================================== -->
	    <div id="banner">
            <!-- Carousel
            ================================================== -->
            <div id="myCarousel-9999" class="carousel-9999 slide">
              <div class="carousel-inner-999">
                <div class="active item one photograpy">
                  <div class="container">
                    <div class="carousel-caption">Free. Created in seconds. No effect on your Facebook page.</div>
                  </div>
                </div>

                <div class="search">
                	<div class="container">
                    	<div class="span12">
                        	<div class="main center">
                                <div>
                                    <a class="brand" href="#"><img src="templates/snapsite/homepage/img/logo.png"></a>
                                    <h2>Have a <span>Facebook fan page</span>?<br/>
                                        See how it is turned into <span>a professional website</span>!</h2>
                                    <div class="clear"></div>
                                </div>
                                <div class="form-search">
	                                <input type="text" id="main_search_box" class="vamp_input vamp_input2 formapi_placeholder searchfb" placeholder="Type Your Facebook Fan Page Name..." data-enter=".btn_vamp2"></input>
    	                            <!--<button class="btn btn_vamp btn_vamp2">View Your Site</button>-->
									<div class="tb search-wrapper"></div>
                                </div>
								
                            </div>
                        </div>
                    </div>
                </div><!-- /.search -->  
              </div>
            </div><!-- /.carousel -->
        </div>
        
        <!-- Sub Nav
        ================================================== -->
        <div id="sub_nav">
            <div class="nt">
            <div class="container">
                <ul class="nav nav-tabs" id="myTab-9999">
                    <li class="aa" id="selected"><a href="#photograpy" class="photograpy">Business Owners</a></li>
                </ul>
			</div>
            </div><!-- /.nt -->
            
            <div class="tc">
                <div class="container">
                    <div class="tab-content">
                        <div class="tab-pane active" id="photograpy">
                        	<div class="container">
                            	<div class="row">
                                	<div class="span3">
                                    	<div class="img_holder"><img src="templates/snapsite/homepage/img/icon_fast.png"></div>
                                        <h2>FAST</h2>
                                        <p>Get a professional website ready to launch in seconds</p>
                                    </div>
                                    <div class="span3">
                                        <div class="img_holder"><img src="templates/snapsite/homepage/img/icon_fresh.png"></div>
                                        <h2>AUTOMATIC UPDATE</h2>
                                        <p>Your site updates automatically every time you post on Facebook. Continue doing what you've already been doing, and let Verisites take care of the rest</p>
                                    </div>
                                	<div class="span3">
                                    	<div class="img_holder"><img src="templates/snapsite/homepage/img/icon_beautiful.png"></div>
                                        <h2>BEAUTIFUL</h2>
                                        <p>Enjoy templates designed by top professionals. You can also change your template with just 1 click!</p>
                                    </div>
                                    <div class="span3">
                                        <div class="img_holder"><img src="templates/snapsite/homepage/img/icon_social.png"></div>
                                        <h2>SOCIAL</h2>
                                        <p>Show your content from Facebook, Twitter, LinkedIn, Picasa, Flickr and more</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane-show">
                        </div>

                    </div>
                </div>
            </div><!-- /.tc -->
        	
        </div><!-- subnav --> 
        
        <!-- Testi
        ================================================== -->
        <div id="testi">
            <div class="container">
                <div class="row">
                    <div class="span12">
                    
                        <div id="myCarousel2" class="carousel slide">
                          <ol class="carousel-indicators">
                            <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel2" data-slide-to="1"></li>
                            <li data-target="#myCarousel2" data-slide-to="2"></li>
                            <li data-target="#myCarousel2" data-slide-to="3"></li>
                          </ol>
                          <!-- Carousel items -->
                          <div class="carousel-inner">
                            <div class="active item">
                            	<div class="testi_holder">
                                    <div class="row">
                                        <div class="span5">
                                        	<div class="left"><img src="templates/snapsite/homepage/img/ability.png"></div><!-- /.left -->
                                        </div>
                                        <div class="span7">
                                        	<div class="right">
                                            	<div class="voice">
                                                	<div style="min-height: 237px;">
                                                        <div class="testimo" style="opacity: 1.0;">
                                                            <div class="top"><img src="templates/snapsite/homepage/img/icon_quote_left.png"></div><!-- /.top -->
                                                            <div class="mid">
                                                                <h3></h3>
                                                                <p></p>
                                                            </div><!-- /.mid -->
                                                            <div class="bottom"><img src="templates/snapsite/homepage/img/icon_quote_right.png"></div><!-- /.bottom -->
                                                        </div>
                                                    </div>
                                                    <div class="authur">
                                                            <div class="row-fluid">
                                                                <div class="span8">
                                                                    <div class="name">
                                                                        <span>Abi L., Musician of Abi.L.ity</span>
                                                                        Verisites User<br> <a href="http://abi-l-ity.com/" target="_blank">View Site</a>
                                                                    </div><!-- /.name -->
                                                                </div>
                                                                <div class="span4">
                                                                    <div class="pic"><img src="templates/snapsite/homepage/img/abilityface.png"></div><!-- /.pic -->
                                                                </div>
                                                            </div>
                                                        </div><!-- /.author -->
                                                </div><!-- /.voice -->
                                            </div><!-- /.right -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item">
                            	<div class="testi_holder">
                                    <div class="row">
                                        <div class="span5">
                                        	<div class="left"><img src="templates/snapsite/homepage/img/conejo.png"></div><!-- /.left -->
                                        </div>
                                        <div class="span7">
                                        	<div class="right">
                                            	<div class="voice">
                                                	<div style="min-height: 237px;">
                                                        <div class="testimo" style="opacity: 0.0;">
                                                            <div class="top"><img src="templates/snapsite/homepage/img/icon_quote_left.png"></div><!-- /.top -->
                                                            <div class="mid">
                                                                <h3>I was surprised by how easy it was to create and customize the website.</h3>
                                                                <p>After weeks of putting off building a site, I finally have one that works and looks great.<br><br></p>
                                                            </div><!-- /.mid -->
                                                            <div class="bottom"><img src="templates/snapsite/homepage/img/icon_quote_right.png"></div><!-- /.bottom -->
                                                        </div>
                                                    </div>
                                                    <div class="authur">
                                                    	<div class="row-fluid">
                                                        	<div class="span8">
                                                            	<div class="name">
                                                                	<span></span>
                                                                    Verisites User<br> <a href="" target="_blank">View Site</a>
                                                                </div><!-- /.name -->
                                                            </div>
                                                            <div class="span4">
                                                            	<div class="pic"><img src="templates/snapsite/homepage/img/conejoface.png"></div><!-- /.pic -->
                                                            </div>
                                                        </div>
                                                    </div><!-- /.author -->
                                                </div><!-- /.voice -->
                                            </div><!-- /.right -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item">
                            	<div class="testi_holder">
                                    <div class="row">
                                        <div class="span5">
                                        	<div class="left"><img src="templates/snapsite/homepage/img/highsteppers.png"></div><!-- /.left -->
                                        </div>
                                        <div class="span7">
                                        	<div class="right">
                                            	<div class="voice">
                                                	<div style="min-height: 237px;">
                                                        <div class="testimo" style="opacity: 0.0;">
                                                            <div class="top"><img src="templates/snapsite/homepage/img/icon_quote_left.png"></div><!-- /.top -->
                                                            <div class="mid">
                                                                <h3></h3>
                                                                <p></p>
                                                            </div><!-- /.mid -->
                                                            <div class="bottom"><img src="templates/snapsite/homepage/img/icon_quote_right.png"></div><!-- /.bottom -->
                                                        </div>
                                                    </div>
                                                    <div class="authur">
                                                    	<div class="row-fluid">
                                                        	<div class="span8">
                                                            	<div class="name">
                                                                	<span>Sydney Montgomery, Vice President of Princeton HighSteppers</span>
                                                                    Verisites User<br> <a href="http://princetonhighsteppers.com/" target="_blank">View Site</a>
                                                                </div><!-- /.name -->
                                                            </div>
                                                            <div class="span4">
                                                            	<div class="pic"><img src="templates/snapsite/homepage/img/highsteppersface.png"></div><!-- /.pic -->
                                                            </div>
                                                        </div>
                                                    </div><!-- /.author -->
                                                </div><!-- /.voice -->
                                            </div><!-- /.right -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item">
                            	<div class="testi_holder">
                                    <div class="row">
                                        <div class="span5">
                                        	<div class="left"><img src="templates/snapsite/homepage/img/azwine.png"></div><!-- /.left -->
                                        </div>
                                        <div class="span7">
                                        	<div class="right">
                                            	<div class="voice">
                                                	<div style="min-height: 237px;">
                                                        <div class="testimo" style="opacity: 0.0;">
                                                            <div class="top"><img src="templates/snapsite/homepage/img/icon_quote_left.png"></div><!-- /.top -->
                                                            <div class="mid">
                                                                <h3></h3>
                                                                <p></p>
                                                            </div><!-- /.mid -->
                                                            <div class="bottom"><img src="templates/snapsite/homepage/img/icon_quote_right.png"></div><!-- /.bottom -->
                                                        </div>
                                                    </div>
                                                    <div class="authur">
                                                    	<div class="row-fluid">
                                                        	<div class="span8">
                                                            	<div class="name">
                                                                	<span>Marita Gomez, Owner of Arizona Wine Museum</span>
                                                                    Verisites User<br> <a href="http://azwinemuseum.com/" target="_blank">View Site</a>
                                                                </div><!-- /.name -->
                                                            </div>
                                                            <div class="span4">
                                                            	<div class="pic"><img src="templates/snapsite/homepage/img/azwineface.png"></div><!-- /.pic -->
                                                            </div>
                                                        </div>
                                                    </div><!-- /.author -->
                                                </div><!-- /.voice -->
                                            </div><!-- /.right -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <!-- Carousel nav -->
                        </div>        
                    
                    </div>
                </div>
            </div>
        </div>

        <!-- Sponsor
        ================================================== -->
        <div id="sponsor">
        	<div class="container">
            	<h2>Bring the best of the web to your website:</h2>
            	<ul class="row">
                    <li class="span3"></li>
                	<li class="span3"><img src="images/paypal_logo.png"></li>
                	<li class="span3"><img src="images/amazong_logo.png"></li>
                    <li class="span3"></li>
                </ul>
            </div>
        </div>
        
        <!-- Footer
        ================================================== -->
        <div id="footer">
        	<div class="container">
            	<div class="row">
                	<div class="span2">
                    	<div class="foot">
                        	<h3>PRODUCT</h3>
                            <ul class="unstyled">
                            	<li><a href="http://www.verisites.com/faq/">FAQ</a></li>
                            	<li><a href="http://builder.verisites.com/pricing/">Pricing</a></li>
                            </ul>
                        </div>
                    </div>
                	<div class="span2">
                    	<div class="foot">
                        	<h3>COMPANY</h3>
                            <ul class="unstyled">
                            	<li><a href="http://www.verisites.com/about">About</a></li>
                            	<li><a href="http://www.verisites.com/blog">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                	<div class="span2">
                    	<div class="foot">
                        	<h3>LEGAL</h3>
                            <ul class="unstyled">
                            	<li><a href="http://www.verisites.com/privacy-policy">Privacy Policy</a></li>
                            	<li><a href="http://www.verisites.com/terms-of-service">Terms of Use</a></li>
                            </ul>
                        </div>
                    </div>
                	<div class="span2 offset3">
                    	<div class="foot">
                        	<h3>CONNECT</h3>
                            <ul class="unstyled">
                            	<li><a href="https://facebook.com/Verisites" target="_blank">Facebook</a></li>
                            	<li><a href="https://twitter.com/Verisites" target="_blank">Twitter</a></li>
                                <li><a href="http://www.linkedin.com/company/Verisites" target="_blank">LinkedIn</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- footer -->
    </div><!-- wrap -->
    

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".video").bind("click", function() {
                $.fancybox({
                    'padding'       : 0,
                    'autoScale'     : false,
                    'transitionIn'  : 'none',
                    'transitionOut' : 'none',
                    'title'         : this.title,
                    'width'         : 640,
                    'height'        : 385,
                    'href'          : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/index.html'),
                    'type'          : 'swf',
                    'swf'           : {
                        'wmode'             : 'transparent',
                        'allowfullscreen'   : 'true'
                    }
                });
                return false;
            });

            $('#main_search_box').focus();
        });
    </script>

	</body>
</html>