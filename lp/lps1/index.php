<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <!-- <script src="//cdn.optimizely.com/js/326727683.js"></script> -->

    <title>Create and Update Website from Facebook Page</title>

    <meta name="title" content="Create and Update Website from Facebook Page" />
    <meta name="type" content="website" />
    <meta name="description" content="Have a Facebook Page and looking to make a website? Page2site is an easy way to create and update a beautiful website from Facebook Pages." />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <meta name="ROBOTS" content="NOARCHIVE" /> <!--Prevents browsers from caching-->
    <link rel="shortcut icon" href="//wwwstatic.verisites.com/justi/wp-content/uploads/2012/02/favicon.png"/>

    <meta property="og:title" content="Page2site" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.page2site.com" />
    <meta property="og:description" content="Turn your Facebook page into a beautiful website">
    <meta property="og:image" content="http://www.page2site.com/images/logo_transparent_509_250.png" />

    <!--<script type="text/javascript" src="core/compiled/clientside/2a2e3649b8e4a5eddf7a01ac134e46a393c2.js?omg=ihatecache"></script>-->
    <link href="//wwwstatic.verisites.com/lp/lps1/core/compiled/clientside/2a2e3649b8e4a5eddf7a01ac134e46a393c2.css" rel="stylesheet" type="text/css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript" src="//wwwstatic.verisites.com/lp/lps1/assets/js/jquery.jsonp-2.4.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
    <link href="//wwwstatic.verisites.com/shared/lib/tipsy/tipsy.css" rel="stylesheet" type="text/css" />
    <style>
        .form-search{ position:relative;}
        span.icon_clear{
            right: 110px;opacity: 0.6;
            position:absolute;
            cursor:pointer;
            font: bold 1em sans-serif;
            display: none;
            color:#38468F;
            top: 25px;
        }
        span.icon_clear:hover{ color:#f52;}
    </style>

    <link rel="stylesheet" type="text/css" href="//wwwstatic.verisites.com/shared/fancybox/jquery.fancybox.css" media="screen" />
    <script src="/shared/fancybox/jquery.fancybox.js" type="text/javascript"></script>
    <script src="//wwwstatic.verisites.com/lp/lps1/assets/js/jquery.easing.1.2.js" type="text/javascript"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="//wwwstatic.verisites.com/shared/lib/tipsy/jquery.tipsy.js" defer></script>

    <?php include_once('../../shared/shared_code_head.php');?>

    <!--<link rel="stylesheet" href="templates/snapsite/homepage/css/lavalamp.css">-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/css/font-awesome-ie7.min.css">
    <![endif]-->
    <!--[if lt IE 9]>
    <link rel="stylesheet" media="all" type="text/css" href="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/css/ie.css" />
    <![endif]-->

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
        <!--
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="templates/snapsite/homepage/ico/apple-touch-icon-144-precomposed.html">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="templates/snapsite/homepage/ico/apple-touch-icon-114-precomposed.html">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="templates/snapsite/homepage/ico/apple-touch-icon-72-precomposed.html">
		<link rel="apple-touch-icon-precomposed" href="templates/snapsite/homepage/ico/apple-touch-icon-57-precomposed.html">
		<link rel="apple-touch-icon-precomposed" href="templates/snapsite/homepage/ico/apple-touch-icon-precomposed.html">
		<link rel="shortcut icon" href="templates/snapsite/homepage/ico/favicon.html">
        -->

    <?php
    /*
        //TODO : Replace javascript path once updated javascript uploaded on wwwstatic.verisites.com
        <link href="//wwwstatic.verisites.com/lp/lps1/css/style.css" rel="stylesheet" type="text/css" />
    */
    ?>
    <link href="/lp/lps1/css/style.css" rel="stylesheet" type="text/css" />

    <style>
        #banner .carousel-9999 .item.one {background-image: url(//wwwstatic.verisites.com/lp/lps1/images/header_sun.jpg);}
    </style>
</head>

<body>
    <?php // require_once '../../shared/facebook_connect.php'; ?>

    <script>
        // Inject Javascript file
        /*
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "/shared/fanpages/fanpage_autoload.php";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'otonomic-facebook-connect'));
*/
    </script>

    <!-- Wrap
    ================================================== -->
    <div id="wrap">

        <!-- Fixed Header
        ================================================== -->
        <div id="fix_head" class="ha-header-hide">
        	<div class="container">
            	<div class="row">
                	<div class="span2">
                    	<div class="logo"><a href="#" title="Page2site"><img src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/logo_fixed.png"></a></div><!-- /.logo -->
                    </div>
                    <div class="span9">
                        <div class="search">
                            <div class="">
                                <div class="span7">
                                    <div class="main">
                                        <div class="form-search center">
                                            <input type="text" class="vamp_input searchfb" data-placeholder="Search for your Facebook fan page..." data-enter=".btn_vamp1"></input>
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
                        <li><a href="http://www.youtube.com/watch?v=c9HlSITDejc&fs=1&autoplay=1&vq=hd1080" target="_blank" id="btn_video" class="video tracking_enabled" data-ga-category="Search LP" data-ga-event="Video" data-ga-label="v=c9HlSITDejc" data-ajax-track="1">Video</a></li>
                        <li>
                            <a href="/shared/facebook_login.php" id="btn_connect" class="facebook_connect track_event measure_time"
                               data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="main_button" data-ajax-track="1"
                               id="main_button">
                                        <button type="button" class="btn btn-primary">Connect with Facebook</button>
                            </a>
                        </li>
                        <li class="active"><a class="btn_fb_login tracking_enabled" href="http://builder.page2site.com/users/login/" data-ga-category="Search LP" data-ga-event="Login" data-ga-label="" data-ajax-track="1" >Login</a></li>
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
                    <a class="brand" href="#" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="Logo" data-ga-label="Click" data-ajax-track="1"><img src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/logo.png"></a>
                  <div class="container">
                    <div class="carousel-caption"></div>
                  </div>
                </div>


                <div class="search">
                	<div class="container">
                    	<div class="span12">
                        	<div class="main center">
                                <div>
                                    <h2>Have a <span>Facebook fan page</span>?<br/>
                                        See how it is turned into <span>a professional website</span>!</h2>
                                    <div class="clear"></div>
                                </div>
                                <div class="form-search">
	                                <input type="text" id="main_search_box" class="LoNotSensitive vamp_input vamp_input2 formapi_placeholder searchfb" placeholder="Search for your Facebook fan page..." data-enter=".btn_vamp2"></input>
    	                            <!--<button class="btn btn_vamp btn_vamp2">View Your Site</button>-->
                                    <div class="tb search-wrapper" id="search_wrapper_main"></div>
                                    <img src="//wwwstatic.verisites.com/lp/lps1/images/btn_go.jpg" id="btn_go" title='Choose your page from the suggestions below'>
                                    <div class="right" id="text_paste_url">Can't find your page? Paste its URL</div>
                                    <span class="icon_clear close-search"><img class="close-search" src="//wwwstatic.verisites.com/lp/lps1/misc/images/home/close.png" width="32" height="32"/></span>
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
                            	<div class="row center" style="width:80%">
                                	<div class="span3">
                                    	<div class="img_holder"><img class="grayscale" src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/icon_fast.png"></div>
                                        <h2>FAST</h2>
                                        <p>Get a professional website ready to launch in seconds</p>
                                    </div>
                                	<div class="span3">
                                    	<div class="img_holder"><img class="grayscale" src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/icon_beautiful.png"></div>
                                        <h2>FREE</h2>
                                        <p>No credit card required, no commitment</p>
                                    </div>
                                    <div class="span3">
                                        <div class="img_holder"><img class="grayscale" src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/icon_social.png"></div>
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
                          </ol>
                          <!-- Carousel items -->
                          <div class="carousel-inner">
                            <div class="active item">
                            	<div class="testi_holder">
                                    <div class="row">
                                        <div class="span5">
                                        	<div class="left"><img src="//wwwstatic.verisites.com/lp/lps1/images/main_img_1.png"></div><!-- /.left -->
                                        </div>
                                        <div class="span7">
                                        	<div class="right">
                                            	<div class="voice">
                                                	<div style="min-height: 237px;">
                                                        <div class="testimo" style="opacity: 1.0;">
                                                            <div class="top"><img src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/icon_quote_left.png"></div><!-- /.top -->
                                                            <div class="mid">
                                                                <h3>I was sold immediately at how incredibly easy it is to create a website directly from our Facebook page..LOVE IT!</h3>
                                                            </div><!-- /.mid -->
                                                            <div class="bottom"><img src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/icon_quote_right.png"></div><!-- /.bottom -->
                                                        </div>
                                                    </div>
                                                    <div class="authur">
                                                            <div class="row-fluid">
                                                                <div class="span8">
                                                                    <div class="name">
                                                                        <span>Sarah Le Kali</span>
                                                                        Owner of The Coconut Bar<br>
                                                                        <a href="http://www.the-coconut-bar.com" target="_blank" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="View" data-ga-label="www.the-coconut-bar.com" data-ajax-track="1">
                                                                            View Site
                                                                        </a>
                                                                    </div><!-- /.name -->
                                                                </div>
                                                                <div class="span4">
                                                                    <div class="pic"><img class="testimonial_user_image" src="//wwwstatic.verisites.com/lp/lps1/images/sarah.jpg"></div><!-- /.pic -->
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
                                        	<div class="left"><img src="//wwwstatic.verisites.com/lp/lps1/images/main_img_2.png"></div><!-- /.left -->
                                        </div>
                                        <div class="span7">
                                        	<div class="right">
                                            	<div class="voice">
                                                	<div style="min-height: 237px;">
                                                        <div class="testimo">
                                                            <div class="top"><img src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/icon_quote_left.png"></div><!-- /.top -->
                                                            <div class="mid">
                                                                <h3>Page2site offered me what I need at the time I needed it - a well designed, informative website that I update effortlessly wherever I travel.</h3>
                                                            </div><!-- /.mid -->
                                                            <div class="bottom"><img src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/icon_quote_right.png"></div><!-- /.bottom -->
                                                        </div>
                                                    </div>
                                                    <div class="authur">
                                                    	<div class="row-fluid">
                                                        	<div class="span8">
                                                            	<div class="name">
                                                                	<span>Brian O'Callaghan-Westropp</span>
                                                                    Owner of Dublin Acupuncture Clinic<br>
                                                                    <a href="http://www.dublinacupunctureclinic.com" target="_blank" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="View" data-ga-label="dublinacupunctureclinic.com" data-ajax-track="1">
                                                                        View Site
                                                                    </a>
                                                                </div><!-- /.name -->
                                                            </div>
                                                            <div class="span4">
                                                            	<div class="pic"><img class="testimonial_user_image" src="//wwwstatic.verisites.com/lp/lps1/images/brian.jpg"></div><!-- /.pic -->
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
                                              <div class="left"><img src="//wwwstatic.verisites.com/lp/lps1/images/main_img_3.png"></div><!-- /.left -->
                                          </div>
                                          <div class="span7">
                                              <div class="right">
                                                  <div class="voice">
                                                      <div style="min-height: 237px;">
                                                          <div class="testimo">
                                                              <div class="top"><img src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/icon_quote_left.png"></div><!-- /.top -->
                                                              <div class="mid">
                                                                  <h3>
                                                                      As a photographer I needed a solution that provides a website while I keep doing what I do best - taking photos and sharing them on all platforms.
                                                                  </h3>
                                                              </div><!-- /.mid -->
                                                              <div class="bottom"><img src="//wwwstatic.verisites.com/lp/lps1/templates/snapsite/homepage/img/icon_quote_right.png"></div><!-- /.bottom -->
                                                          </div>
                                                      </div>
                                                      <div class="authur">
                                                          <div class="row-fluid">
                                                              <div class="span8">
                                                                  <div class="name">
                                                                      <span>Enrico Jesus Ong</span>
                                                                      Infinity Still and Motion Studio<br>
                                                                      <a href="http://infinitystillandmotionstudio.com/" target="_blank" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="View" data-ga-label="infinitystillandmotionstudio.com" data-ajax-track="1">
                                                                          View Site
                                                                      </a>
                                                                  </div><!-- /.name -->
                                                              </div>
                                                              <div class="span4">
                                                                  <div class="pic"><img class="testimonial_user_image" src="//wwwstatic.verisites.com/lp/lps1/images/enrico.jpg"></div><!-- /.pic -->
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
                    <li class="span3"><img class="grayscale" src="//wwwstatic.verisites.com/lp/lps1/images/paypal_logo.png"></li>
                    <li class="span3"><img class="grayscale" src="//wwwstatic.verisites.com/lp/lps1/images/amazon_logo.png"></li>
                	<li class="span3"><img class="grayscale" src="//wwwstatic.verisites.com/lp/lps1/images/resellerclub_logo.png"></li>
                    <li class="span3"><img class="grayscale" src="//wwwstatic.verisites.com/lp/lps1/images/bluesnap_logo.png"></li>
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
                            	<li><a target="_blank" href="http://page2site.zendesk.com/" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="Footer" data-ga-label="faq" data-ajax-track="1">FAQ</a></li>
                            	<li><a target="_blank" href="http://builder.page2site.com/pricing/" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="Footer" data-ga-label="pricing" data-ajax-track="1">Pricing</a></li>
                            </ul>
                        </div>
                    </div>
                	<div class="span2">
                    	<div class="foot">
                        	<h3>COMPANY</h3>
                            <ul class="unstyled">
                            	<li><a target="_blank" href="http://www.page2site.com/about" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="Footer" data-ga-label="about" data-ajax-track="1">About</a></li>
                            	<li><a target="_blank" href="http://www.page2site.com/blog" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="Footer" data-ga-label="blog" data-ajax-track="1">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                	<div class="span2">
                    	<div class="foot">
                        	<h3>LEGAL</h3>
                            <ul class="unstyled">
                            	<li><a target="_blank" href="http://www.page2site.com/privacy-policy" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="Footer" data-ga-label="privacy policy" data-ajax-track="1">Privacy Policy</a></li>
                            	<li><a target="_blank" href="http://www.page2site.com/terms-of-service" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="Footer" data-ga-label="terms of use" data-ajax-track="1">Terms of Use</a></li>
                            </ul>
                        </div>
                    </div>
                	<div class="span2 offset3">
                    	<div class="foot">
                        	<h3>CONNECT</h3>
                            <ul class="unstyled">
                            	<li><a target="_blank" href="https://facebook.com/page2site" target="_blank" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="Footer" data-ga-label="facebook" data-ajax-track="1">Facebook</a></li>
                            	<li><a target="_blank" href="https://twitter.com/page2site" target="_blank" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="Footer" data-ga-label="twitter" data-ajax-track="1">Twitter</a></li>
                                <li><a target="_blank" href="http://www.linkedin.com/company/page2site" target="_blank" class="tracking_enabled" data-ga-category="Search LP" data-ga-event="Footer" data-ga-label="linkedin" data-ajax-track="1">LinkedIn</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- footer -->
    </div><!-- wrap -->

    <?php
    include_once(realpath(__DIR__).'/../../shared/fanpages/fanpage_autoload.php');?>

</body>
</html>