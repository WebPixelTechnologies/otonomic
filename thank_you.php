<?php
/* send email with lead details */
$mail_to = 'edik@otonomic.com';

$headers = 'From: omri@otonomic.com' . "\r\n" .
    'Reply-To: omri@otonomic.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);

$server = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
$mail_subject = 'New lead generated on '.$server;

foreach($_REQUEST as $key=>$value) {
    $mail_content = ucfirst(str_replace("_", " ", $key)).": ".$value."\n";
}

/*
$mail_content = "Page Name: ".$_REQUEST['page_name'];
$mail_content .= "\nPage ID: ".$_REQUEST['page_id'];
$mail_content .= "\nPage Category: ".$_REQUEST['category'];
*/
$mail_content .= "IP: ".$ip;

@mail($mail_to, $mail_subject, $mail_content, $headers);

?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/Organization">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Create your own Website - make your own website >> Otonomic</title>
      <meta name="title" content="Create your own Website - make your own website >> Otonomic">
      <meta name="description"
            content="make your own website free and immediately! With Otonomic you will create your own website in seconds by simply turning your Social presence page to a website. Try it out!">
      <meta name="keywords" content="make your own website, create your own website, build your own website">
      <link rel="shortcut icon" href="images/favicon.ico">

      <meta property="og:title" content="Give your business the website it deserves!"/>
      <meta property="og:site_name" content="otonomic"/>
      <meta property="og:description"
            content="Do you need a website for your business? Otonomic will create one for you in seconds, just try it out!"/>
      <meta property="og:url" content="http://www.otonomic.com"/>
      <meta property="og:image" content="http://otonomic.com/images/logo148x148.png"/>

      <meta itemprop="name" content="Otonomic">
      <meta itemprop="description"
            content="Do you need a website for your business? Otonomic will create one for you in seconds, just try it out!">
      <meta itemprop="image" content="http://otonomic.com/images/logo148x148.png">

      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom style -->
      <link href="css/style.css" rel="stylesheet">
      <link href="css/searchResults.css" rel="stylesheet">
      <!-- Google+ -->
      <link href="https://plus.google.com/112126439055007134666" rel="publisher">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <script src="/js/otonomic-analytics.js"></script>
      <!-- START Facebook Pixel Tracking -->
      <!-- Facebook Conversion Code for Lead Generated -->
      <script>
	  
	  (function() {
          var _fbq = window._fbq || (window._fbq = []);
          if (!_fbq.loaded) {
              var fbds = document.createElement('script');
              fbds.async = true;
              fbds.src = '//connect.facebook.net/en_US/fbds.js';
              var s = document.getElementsByTagName('script')[0];
              s.parentNode.insertBefore(fbds, s);
              _fbq.loaded = true;
          }
      })();
      window._fbq = window._fbq || [];
      window._fbq.push(['track', '6019480665030', {'value':'0.00','currency':'USD'}]);
      </script>
      <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6019480665030&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
      <!-- END Facebook Pixel Tracking -->
  </head>

  <body>
  <div id="wrapper">
  		<!-- Side Navbar -->
      <div id="sidebar-wrapper">
          <ul class="sidebar-nav">
              <li class="sidebar-login">
                <a href="/shared/facebook_login.php" class="facebook_connect sidebar-link track_event" data-target="" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Login">
                  <div class="sidebar-icon"><span class="glyphicon glyphicon-user"></span></div>Login
                </a>
              </li>
              <li>
                <a href="#" class="sidebar-link track_event" data-target="features" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Features">
                  <div class="sidebar-icon"><img src="images/sidebar-icon1.png" alt="Features"></div>Features
                </a>
              </li>
              <li>
                <a href="#" class="sidebar-link track_event" data-target="reviews" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Reviews">
                  <div class="sidebar-icon"><img src="images/sidebar-icon2.png" alt="Reviews"></div>Reviews
                </a>
              </li>
              <!-- <li>
                <a href="#" class="sidebar-link track_event" data-target="media-links" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Media">
                  <div class="sidebar-icon"><img src="images/sidebar-icon3.png" alt="In the media"></div>In the media
                </a>
              </li> -->
              <li>
                <a href="#" class="sidebar-link track_event" data-target="about" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="About">
                  <div class="sidebar-icon about"><img src="images/sidebar-icon4.png" alt="About"></div>About
                </a>
              </li>
              <li>
                  <a href="/pages/jobs" target="_blank" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Jobs">
                      <div class="sidebar-icon blog"><img src="images/sidebar-icon5.png" alt="Jobs"></div>Jobs
                  </a>
              </li>
              <li>
                  <a href="http://blog.otonomic.com" target="_blank" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Blog">
                      <div class="sidebar-icon blog"><img src="images/sidebar-icon6.png" alt="Blog"></div>Blog
                  </a>
              </li>
          </ul>
      </div>
      <!-- Main Content -->
      <div id="page-content-wrapper">
          <div class="page-content">
            <div class="container-fluid">
             <!-- top navbar -->
              <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			  		<div class="navbar-header">
                       <button type="button" class="navbar-toggle track_event track_hover" id="menu-toggle" data-toggle="offcanvas" data-target=".sidebar-nav" data-ga-category="Marketing Website"  data-ga-event="Menu Click" data-ga-event-hover="Menu Hover">
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                       </button>
                       <a class="navbar-brand hidden-xs" href="#"><img src="images/otonomic-logo.png" alt="otonomic logo"></a>
                  </div>
                  <div class="center-logo-holder">
                    <div class="center-logo center-block">
                      <img src="images/otonomic-logo.png" class="logo-img" alt="otonomic logo">
                      <img src="images/blue-arrow.png" alt="otonomic logo">
                    </div>
                  </div>
              </div>
            </div>

              <div class="container-fluid">
                  <section class="home"><!-- Section Home -->
                    <div class="row section-home">
                        <div class="col-xs-12 text-center">
                        <h1>Congratulations!</br>
                        We've started building your new website</h1>
                        <h2>We will contact you in 72 hours with a draft of your site.</br>
                        If you have any qestion, please contact <a href="mailto:support@otonomic.com" style="color:pink">support@otonomic.com</a>.</h2>

                        <div class="bg-image">
                          <img src="images/section-home-bg.png" class="" alt="build your own free website">
                        </div>
                      </div><!-- /.col-xs-12 main -->
                    </div>
                  </section>
				  
				  <section class="likes">
                    <div class="row section-likes">
                      <div class="hidden-xs col-xs-12 text-center">
                        <div class="likes-div">
                          <h3>Like and Share Otonomic</h3>
                          <div class="like-div fb">
                            <div class="fb-like" data-href="https://www.facebook.com/otonomic" data-width="86" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                          </div>
                          <div class="like-div">
                            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.otonomic.com" data-text="Do you need a website for your business? Otonomic will create one for you in seconds, just try it out!" data-via="otonomic" data-lang="en">Tweet</a>
                          </div>
                          <div class="like-div">
                            <div class="g-plusone" data-size="medium" data-prefilltext="Engage your users today, create a Google+ page for your business." data-href="http://otonomic.com/"></div>
                          </div>
                          <div class="like-div">
                            <a href="//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fotonomic.com%2F&media=http%3A%2F%2Fotonomic.com%2Fimages%2Flogo148x148.png&description=Do%20you%20need%20a%20website%20for%20your%20business%3F%20Otonomic%20will%20create%20one%20for%20you%20in%20seconds%2C%20just%20try%20it%20out!" data-pin-do="buttonPin" data-pin-config="beside" data-pin-color="white"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_white_20.png" /></a>
                          </div>
                          <div class="like-div">
                            <script type="IN/Share" data-url="http://otonomic.com/" data-counter="right"></script>
                          </div>
                        </div>
                      </div>
                      <div class="visible-xs col-xs-12 text-center">
                        <div class="btn-group  dropup">
                          <button class="btn-social dropdown-toggle" type="button" data-toggle="dropdown">
                            <img src="images/thumbs-up.png" width="26">  Like/Share us
                          </button>
                          <ul class="dropdown-menu">
                            <li><script type="IN/Share" data-url="http://otonomic.com/" data-counter="right"></script></li>
                            <li>
                              <a href="//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fotonomic.com%2F&media=http%3A%2F%2Fotonomic.com%2Fimages%2Flogo148x148.png&description=Do%20you%20need%20a%20website%20for%20your%20business%3F%20Otonomic%20will%20create%20one%20for%20you%20in%20seconds%2C%20just%20try%20it%20out!" data-pin-do="buttonPin" data-pin-config="beside" data-pin-color="white"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_white_20.png" /></a>
                            </li>
                            <li>
                              <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.otonomic.com" data-text="Do you need a website for your business? Otonomic will create one for you in seconds, just try it out!" data-via="otonomic" data-lang="en">Tweet</a>
                            </li>
                            <li>
                              <div class="g-plusone" data-size="medium" data-href="http://otonomic.com/"></div>
                            </li>
                            <li>
                              <div class="fb-like" data-href="https://www.facebook.com/otonomic" data-width="86" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </section>
                  <section class="features"><!-- Section Features -->
                    <div class="row hidden-xs">
                      <div class="section-features holder">
                        <div class="col-xs-12 col-sm-6 col-md-4 title">
                          <div class="title-inner">
                            <h1>The Perfect Website for All Your Business Needs</h1>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 feature track_event track_hover" data-ga-category="Marketing Website" data-ga-event-hover="Features Hover" data-ga-label="Gorgeous">
                          <img class="feature-icon" src="images/feature-icon1.png" alt="build your own website in 1 click">
                          <h3>Gorgeous site in 1 click</h3>
                          <p>Not a techie? Not a problem! With our new technology, creating your own fabulous website from your Facebook page literally takes one click. You don’t have to know anything about programming or design.</p>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 feature track_event track_hover" data-ga-category="Marketing Website" data-ga-event-hover="Features Hover" data-ga-label="Auto">
                          <img class="feature-icon" src="images/feature-icon2.png" alt="create your own website from Facebook page">
                          <h3>Self-updating</h3>
                          <p>Whenever you post something on your Facebook page, it immediately appears on your Otonomic site. You can just kick back, enjoy sharing news, pictures and whatever else you feel like on Facebook, and ta-da - it’s on your site!</p>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 feature track_event track_hover" data-ga-category="Marketing Website" data-ga-event-hover="Features Hover" data-ga-label="Mobile">
                          <img class="feature-icon" src="images/feature-icon3.png" alt="create your own free mobile site">
                          <h3>Web, tablet and mobile ready</h3>
                          <p>You know you must cater to all digital tastes. With Otonomic, you get web, mobile and tablet sites right away! So you can reach clients wherever they go, on all platforms and all devices in all sizes.</p>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 feature track_event track_hover" data-ga-category="Marketing Website" data-ga-event-hover="Features Hover" data-ga-label="Domain">
                          <img class="feature-icon" src="images/feature-icon4.png" alt="build a free website with your own domain">
                          <h3>Your domain, your brand</h3>
                          <p>In today's world, brand name is everything. With us you get your own domain, which means your own fully-branded web, mobile and tablet sites. Don’t settle for less— get the best combo for your business.</p>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 feature track_event track_hover" data-ga-category="Marketing Website" data-ga-event-hover="Features Hover" data-ga-label="Growth">
                          <img class="feature-icon" src="images/feature-icon5.png" alt="build a website for your own business">
                          <h3>Business Growth Made Easy</h3>
                          <p>With features like a blog, video player, and photo gallery, every one of your clients is engaged. With your chic online store, you can easily capitalize on these warm leads. Your clients are happy, so are you.</p>
                        </div>
                      </div>
                    </div>
                    <div class="row visible-xs features-mobile">
                      <div class="col-xs-12">
                          <h1>The Perfect Website for All Your Business Needs</h1>
                      </div>
                      <div id="carousel-features" class="carousel slide clearfix" data-interval="false" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators carousel-tabs">
                          <li data-target="#carousel-features" data-slide-to="0" class="active">
                          <div class="carousel-features-ico-1"></div>
                          </li>
                          <li data-target="#carousel-features" data-slide-to="1">
                            <div class="carousel-features-ico-2"></div>
                          </li>
                          <li data-target="#carousel-features" data-slide-to="2">
                            <div class="carousel-features-ico-3"></div>
                          </li>
                          <li data-target="#carousel-features" data-slide-to="3">
                            <div class="carousel-features-ico-4"></div>
                          </li>
                          <li data-target="#carousel-features" data-slide-to="4">
                            <div class="carousel-features-ico-5"></div>
                          </li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                          <div class="item active">
                            <img src="images/feature-icon1.png">
                            <div class="carousel-caption">
                              <h3>Gorgeous site in 1 click</h3>
                              <p>Not a techie? Not a problem! With our new technology, creating your own fabulous website from your Facebook page literally takes one click. You don’t have to know anything about programming or design.</p>
                            </div>
                          </div>
                          <div class="item">
                            <img src="images/feature-icon2.png">
                            <div class="carousel-caption">
                             <h3>Self-updating</h3>
                             <p>Whenever you post something on your Facebook page, it immediately appears on your Otonomic site. You can just kick back, enjoy sharing news, pictures and whatever else you feel like on Facebook, and ta-da - it’s on your site!</p>
                            </div>
                          </div>
                          <div class="item">
                            <img src="images/feature-icon3.png">
                            <div class="carousel-caption">
                             <h3>Web, tablet and mobile ready</h3>
                             <p>You know you must cater to all digital tastes. With Otonomic, you get web, mobile and tablet sites right away! So you can reach clients wherever they go, on all platforms and all devices in all sizes.</p>
                            </div>
                          </div>
                          <div class="item">
                            <img src="images/feature-icon4.png">
                            <div class="carousel-caption">
                             <h3>Your domain, your brand</h3>
                             <p>In today's world, brand name is everything. With us you get your own domain, which means your own fully-branded web, mobile and tablet sites. Don’t settle for less— get the best combo for your business.</p>
                            </div>
                          </div>
                          <div class="item">
                            <img src="images/feature-icon5.png">
                            <div class="carousel-caption">
                             <h3>Business Growth Made Easy</h3>
                             <p>With features like a blog, video player, and photo gallery, every one of your clients is engaged. With your chic online store, you can easily capitalize on these warm leads. Your clients are happy, so are you. </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <section class="reviews"><!-- Section Reviews -->
                    <div class="row section-reviews hidden-xs">
                      <div class="section-reviews-inner holder center-block">
                        <div class="col-xs-12 text-center">
                          <h1>Small business owners love us</h1>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 track_hover" data-ga-category="Marketing Website" data-ga-event="Testimonials Click" data-ga-event-hover="Testimonials Hover" data-ga-label="Grymm">
                          <div class="ch-item">       
                            <div class="ch-info">
                              <div class="ch-info-front">
                                <!-- <img src="images/review-user1.png"> -->
                                <img src="images/review-user1-over.png">
                              </div>
                              <div class="ch-info-back">
                                <img src="images/review-user1-over.png">
                              </div>  
                            </div>
                            <div class="ch-text">
                              <h3>Grymm</h3>
                              <h4><a href="http://artisticembracetattoo.com/" target="_blank" class="track_event" data-ga-category="Marketing Website" data-ga-event="Testimonials Site Click" data-ga-label="Grymm">artisticembracetattoo.com</a></h4>
                              <p>I've had my website for a little over a month now and my clients absolutely love it!!! They have told me that it's extremely easy to navigate and it looks awesome! I couldn't have had a better website!</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 track_hover" data-ga-category="Marketing Website" data-ga-event="Testimonials Click" data-ga-event-hover="Testimonials Hover" data-ga-label="Shawna Todd">
                          <div class="ch-item">       
                            <div class="ch-info">
                              <div class="ch-info-front">
                                <!-- <img src="images/review-user2.png"> -->
                                <img src="images/review-user2-over.png">
                              </div>
                              <div class="ch-info-back">
                                <img src="images/review-user2-over.png">
                              </div>  
                            </div>
                            <div class="ch-text">
                              <h3>Shawna Todd</h3>
                              <h4><a href="http://boulderacupuncture.me/" target="_blank" class="track_event" data-ga-category="Marketing Website" data-ga-event="Testimonials Site Click" data-ga-label="Shawna Todd">boulderacupuncture.me</a></h4>
                              <p>I had been wanting a website for my small business for too long. I never found the time or energy to get it done. I'm so grateful, I wish I had done it sooner.
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 track_hover" data-ga-category="Marketing Website" data-ga-event="Testimonials Click" data-ga-event-hover="Testimonials Hover" data-ga-label="Steve Bross">
                          <div class="ch-item">       
                            <div class="ch-info">
                              <div class="ch-info-front">
                                <!-- <img src="images/review-user3.png"> -->
                                <img src="images/review-user3-over.png">
                              </div>
                              <div class="ch-info-back">
                                <img src="images/review-user3-over.png">
                              </div>  
                            </div>
                            <div class="ch-text">
                              <h3>Steve Bross</h3>
                              <h4><a href="http://thehawkmobile.com/" target="_blank"  target="_blank" class="track_event" data-ga-category="Marketing Website" data-ga-event="Testimonials Site Click" data-ga-label="Steve Bross">thehawkmobile.com</a></h4>
                              <p>Since I do a lot of daily updates, I like the fact that the page updates on it's own. Otonomic have been very helpful in working with me to get the site just the way I wanted it. Glad I found them!
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 track_hover" data-ga-category="Marketing Website" data-ga-event="Testimonials Click" data-ga-event-hover="Testimonials Hover" data-ga-label="Fanny May">
                          <div class="ch-item">       
                            <div class="ch-info">
                              <div class="ch-info-front">
                                <!-- <img src="images/review-user4.png"> -->
                                <img src="images/review-user4-over.png">
                              </div>
                              <div class="ch-info-back">
                                <img src="images/review-user4-over.png">
                              </div>  
                            </div>
                            <div class="ch-text">
                              <h3>Brian O'Callaghan</h3>
                              <h4><a href="http://www.dublinacupunctureclinic.com/" target="_blank" class="track_event" data-ga-category="Marketing Website" data-ga-event="Testimonials Site Click" data-ga-label="Brian O'Callaghan">dublinacupunctureclinic.com</a></h4>
                              <p>Otonomic offered me what I need at the time I needed it, a well designed, informative website that I update effortlessly wherever I travel.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row visible-xs reviews-mobile">
                      <div class="col-xs-12">
                          <h1>Small business owners love us</h1>
                      </div>
                      <div id="carousel-reviews" class="carousel slide clearfix" data-interval="false" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators carousel-tabs">
                          <li data-target="#carousel-reviews" data-slide-to="0" class="active">
                          <div class="carousel-reviews-ico-1"></div>
                          </li>
                          <li data-target="#carousel-reviews" data-slide-to="1">
                            <div class="carousel-reviews-ico-2"></div>
                          </li>
                          <li data-target="#carousel-reviews" data-slide-to="2">
                            <div class="carousel-reviews-ico-3"></div>
                          </li>
                          <li data-target="#carousel-reviews" data-slide-to="3">
                            <div class="carousel-reviews-ico-4"></div>
                          </li>
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                          <div class="item active">
                            <img src="images/reviews-icon1.png">
                            <div class="carousel-caption">
                              <h3>Grymm</h3>
                              <p>I've had my website for a little over a month now and my clients absolutely love it!!! They have told me that it's extremely easy to navigate and it looks awesome! I couldn't have had a better website!</p>
                            </div>
                          </div>
                          <div class="item">
                            <img src="images/reviews-icon2.png">
                            <div class="carousel-caption">
                             <h3>Shawna Todd</h3>
                             <p>I had been wanting a website for my small business for to long. I never found the time or energy to get it done. I'm so grateful, I wish I had done it sooner..</p>
                            </div>
                          </div>
                          <div class="item">
                            <img src="images/reviews-icon3.png">
                            <div class="carousel-caption">
                              <h3>Steve Bross</h3>
                              <p>Since I do a lot of daily updates, I like the fact that the page updates on it's own. Otonomic been very helpful in working with me to get the site just the way I wanted it. Glad I found them!</p>
                            </div>
                          </div>
                          <div class="item">
                            <img src="images/reviews-icon4.png">
                            <div class="carousel-caption">
                             <h3>Brian O'Callaghan</h3>
                             <p>Otonomic offered me what I need at the time I needed it, a well designed, informative website that I update effortlessly wherever I travel.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <section class="media-links "><!-- Section Media -->
                    <div class="row hidden-xs">
                      <div class="section-media holder">
                        <div class="col-xs-4 col-sm-2 col-md-2 col-sm-offset-1 col-md-offset-1 media-item">
                          <img src="images/media1.png" class="img-responsive">
                        </div>
                        <div class="col-xs-4 col-sm-2 col-md-2 media-item">
                          <img src="images/media2.png" class="img-responsive">
                        </div>
                        <div class="col-xs-4 col-sm-2 col-md-2 media-item">
                          <img src="images/media3.png" class="img-responsive">
                        </div>
                        <div class="col-xs-4 col-sm-2 col-md-2 media-item">
                          <img src="images/media4.png" class="img-responsive">
                        </div>
                        <div class="col-xs-4 col-sm-2 col-md-2 media-item">
                          <img src="images/media5.png" class="img-responsive">
                        </div>
                        <!-- <div class="col-xs-4 col-sm-2 col-md-2">
                          <img src="images/media6.png" class="img-responsive">
                        </div> -->
                      </div>
                    </div>
                    <div class="row visible-xs">
                      <a href="#">
                        <div class="mobile-media-item-holder">
                          <div class="mobile-media-item">
                            <img src="images/media1.png" class="img-responsive">
                          </div>
                        </div>
                      </a>
                      <a href="#">
                        <div class="mobile-media-item-holder">
                          <div class="mobile-media-item">
                            <img src="images/media2.png" class="img-responsive">
                          </div>
                        </div>
                      </a>
                      <a href="#">
                        <div class="mobile-media-item-holder">
                          <div class="mobile-media-item">
                            <img src="images/media3.png" class="img-responsive">
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="row visible-xs">
                      <a href="#">
                        <div class="mobile-media-item-holder bottom">
                          <div class="mobile-media-item">
                            <img src="images/media4.png" class="img-responsive">
                          </div>
                        </div>
                      </a>
                      <a href="#">
                        <div class="mobile-media-item-holder bottom">
                          <div class="mobile-media-item">
                            <img src="images/media5.png" class="img-responsive">
                          </div>
                        </div>
                      </a>
                      <a href="#">
                        <div class="mobile-media-item-holder bottom">
                          <div class="mobile-media-item">
                            <img src="images/media6.png" class="img-responsive">
                          </div>
                        </div>
                      </a>
                    </div>
                  </section>
                  <section class="about"><!-- Section About -->
                    <div class="row section-about hidden-xs">
                      <div class="section-about-inner holder center-block clearfix">
                        <div class="col-xs-12">
                          <div class="drop-screen center-block">
                            <div class="drop-screen-inner">
                              <h1>We are otonomic.</h1>
                              <img src="images/about-team.png">
                              <p>Otonomic was created to empower small businesses on the web.<br/>20,000 freelancers and business owners have already chosen Otonomic to create and manage their websites.</p>
                              <p>Otonomic was established in 2012 by Omri Allouche, an experienced entrepreneur, formerly the founder of social marketing platform Zink. The company currently employs a team of 10 talented professionals, led by veterans including Edik Mitelman, formerly of Conduit and Ilan Lichtnaier, formerly of Conduit, HP and Netcraft.</p>
                            </div>
                            <div class="bottom-bar">
                              <div class="bottom-bar-side-left"></div>
                              <div class="bottom-bar-side-right pull-right"></div>
                              <div class="bottom-bar-handle"><img src="images/handle.gif"></div>
                            </div>
                          </div>
                          <div class="bg-text center-block">
                            <p>Otonomic was created to empower small businesses on the web.<br/>20,000 freelancers and business owners have already chosen Otonomic to create and manage their websites.</p>
                            <p>Otonomic was established in 2012 by Omri Allouche, an experienced entrepreneur, formerly the founder of social marketing platform Zink. The company currently employs a team of 10 talented professionals, led by veterans including Edik Mitelman, formerly of Conduit and Ilan Lichtnaier, formerly of Conduit, HP and Netcraft.</p>
                          </div>
                        </div>
                      </div>
                      <div class="bg-about text-center">
                          <img src="images/team-default.png" class="team-default active">
                          <img src="images/team-active.png" class="team-active">
                          <img src="images/computers.png" class="computers">
                      </div>
                    </div>
                    <div class="row visible-xs about-mobile">
                      <div id="carousel-about" class="carousel slide clearfix" data-interval="false" data-ride="carousel">
                        <!-- Indicators -->
                        <!-- <ol class="carousel-indicators carousel-tabs">
                          <li data-target="#carousel-about" data-slide-to="0" class="active">
                            <div class="carousel-about-ico-1"></div>
                          </li>
                          <li data-target="#carousel-about" data-slide-to="1">
                            <div class="carousel-about-ico-2"></div>
                          </li>
                        </ol> -->
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                          <div class="item active">
                            <div class="carousel-caption">
                              <h1>We are otonomic.</h1>
                              <p>Otonomic was created to empower small businesses on the web. 20,000 freelancers and business owners have already chosen Otonomic to create and manage their websites.</p>
                              <p>Otonomic was established in 2012 by Omri Allouche, an experienced entrepreneur, formerly the founder of social marketing platform Zink. The company currently employs a team of 10 talented professionals, led by veterans including Edik Mitelman, formerly of Conduit and Ilan Lichtnaier, formerly of Conduit, HP and Netcraft.</p>
                            </div>
                            <img src="images/about-mobile-bg-1.png">
                          </div>
                          <!-- <div class="item">
                            <div class="carousel-caption">
                             <p>Otonomic was created in 2012 by <strong>Omri Allouche</strong>, who previously founded Zink, a social marketing platform that uses unique technology to increase the word of mouth effect on social networks and serves clients like P&G, Greenpeace, and Accessorize London.</p>
                             <p>His fellow travellers on this journey are <strong>Edik Mitelman</strong> (product) and <strong>Ilan Lichtnaier</strong> (design), who took part in introducing the community toolbar at Conduit and elsewhere, and Roman Raslin who dominated the Israeli online gaming scene since 2006.</p>
                            </div>
                            <img src="images/about-mobile-bg-2.png">
                          </div> -->
                        </div>
                      </div>
                    </div>
                  </section>
                  <section class="social"><!-- Section Social -->
                    <div class="row section-social">
                      <div class="col-xs-12 text-center">
                        <h3>Also see us at:</h3>
                      </div>
                      <div class="social-links center-block">
                        <div class="social-link-holder google-plus">
                          <a href="https://plus.google.com/+Otonomic/" target="_blank" class="social-link track_event" data-ga-category="Marketing Website" data-ga-event="Share Click" data-ga-label="Google Plus"><img src="images/social-icon-1.png" class="img-responsive"></a>
                        </div>
                        <div class="social-link-holder facebook">
                          <a href="https://www.facebook.com/otonomic" target="_blank" class="social-link track_event" data-ga-category="Marketing Website" data-ga-event="Share Click" data-ga-label="Facebook"><img src="images/social-icon-2.png" class="img-responsive"></a>
                        </div>
                        <div class="social-link-holder twitter">
                          <a href="https://twitter.com/otonomic/" target="_blank" class="social-link track_event" data-ga-category="Marketing Website" data-ga-event="Share Click" data-ga-label="Twitter"><img src="images/social-icon-3.png" class="img-responsive"></a>
                        </div>
                        <div class="social-link-holder email">
                          <a href="http://www.linkedin.com/company/otonomic" target="_blank" class="social-link track_event" data-ga-category="Marketing Website" data-ga-event="Share Click" data-ga-label="Linkedin"><img src="images/social-icon-4.png" class="img-responsive"></a>
                        </div>
                      </div>
                      <div class="footer-links center-block">
                        <div class="footer-link"><a href="pdfs/Otonomic_Terms_of_Service.pdf" target="_blank"class="track_event" data-ga-category="Marketing Website" data-ga-event="Footer" data-ga-label="ToU">Terms of Use</a></div>
                        <div class="footer-link"><a href="pdfs/Otonomic_Privacy_Policy.pdf" target="_blank" class="track_event" data-ga-category="Marketing Website" data-ga-event="Footer" data-ga-label="PP">Privacy Policy</a></div>
                        <div class="footer-link"><a href="http://support.otonomic.com" target="_blank" class="track_event" data-ga-category="Marketing Website" data-ga-event="Footer" data-ga-label="FAQ">FAQ</a></div>
                      </div>
                      <div class="powered-by">© 2014 <img src="images/otonomic-logo.png" alt="otonomic logo"></div>
                    </div>
                  </section>
				  
              </div>
          </div>
      </div>
  </div>

  <noscript><p><img src="http://a.otonomic.com/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/placeholders.min.js"></script>
    <script type="text/javascript" src="/js/jquery.scrollstop.js"></script>
    <script type="text/javascript" src="/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="/js/jquery.scrollsnap.js"></script>
    <script type="text/javascript" src="/js/jquery.touchSwipe.min.js"></script>
    <!-- Custom JS -->
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="//cherne.net/brian/resources/jquery.hoverIntent.minified.js"></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
    <link href="http://d2zxr4ixkv1lwq.cloudfront.net/lp/css/tipsy.css" rel="stylesheet" type="text/css" />
	
	<!-- Social  -->
    <!-- // Facebook -->
    <div id="fb-root"></div>
    <script type="text/javascript">
        window.fbAsyncInit = function() {
            FB.init({ appId: "373931652687761",status: true,cookie: true,xfbml: true});

            window.fbAsyncInit.fbLoaded.resolve();
            //checkConnectedWithFacebook();
        };

        window.fbAsyncInit.fbLoaded = jQuery.Deferred();

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js&appId=373931652687761";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- // Google Plus -->
    <script type="text/javascript">
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
    <!-- // Twitter -->
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
    </script>
    <!-- // Pintrest -->
    <script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
    <!-- // Linkedin -->
    <script src="//platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
    <!-- /Social  -->
    <script>
      AUTO_FOCUS = false;
      SEARCH_PICTURE_SIZE = 80;
    </script>

  <link href="css/tipsy.css" rel="stylesheet" type="text/css">
    <link href="css/jquery.fancybox.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/js/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="/js/search_filter_lead_gen.js"></script>
    <script type="text/javascript" src="/js/jquery.jsonp-2.4.0.min.js"></script>
    <script type="text/javascript" src="/js/jquery.tipsy.js"></script>
    <script type="text/javascript" src="/js/otonomicv1.0.4.js?v=1"></script>

	<script>
	function getParameterByName(name) 
	{
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			results = regex.exec(location.search);
		return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
	if( getParameterByName('msg') == 'site-deleted' )
	{
		alert('Site was deleted successully.');
	}
    </script>
    <script type="text/javascript" src="js/functions.js"></script>

    <script>
        jQuery(document).ready(function($) {
			p2sTrack('Thank you Page', 'Page Loaded', '0 seconds');
			var event_data = 'Page id:'+getParameterByName('page_id')+', Page name:'+getParameterByName('page_name')+', Category:'+getParameterByName('category');
            track_event("Lead Generation Website", "Lead Generated", event_data);
			track_event("Lead Generation Website", "Lead Generated", "Page ID: "+getParameterByName('page_id'));
			track_event("Lead Generation Website", "Lead Generated", "Page name:"+getParameterByName('page_name'));
			track_event("Lead Generation Website", "Lead Generated", "Category:"+getParameterByName('category'));
        });
    </script>
  </body>
</html>
