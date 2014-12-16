<?php
$twitter_share_options = [
    [   "url"  => "http://bit.ly/hsalon2",
        "text" => "Only for 45 Hours! FREE website for your hair salon: @Otonomic turns your Facebook biz page into an amazing website"
    ],
    [   "url"  => "http://bit.ly/hsalon19",
        "text" => "Got my #HairSalon #Free website @otonomic and all my social media synced in one place. Get yours #Free"
    ],
    [   "url"  => "http://bit.ly/hsalon20",
        "text" => "#Hairsalon website #Giveaway! @Otonomic builds a website from my FB biz page. No more #hairstylistproblems"
    ],
    [   "url"  => "http://bit.ly/hsalon21",
        "text" => "Thank you @Otonomic for my #HairSalon #Free website. Click and get yours #free"
    ]
];

$i = rand(0, count($twitter_share_options)-1);
$twitter_share = $twitter_share_options[$i];
$twitter_share_text = $twitter_share['text'];
$twitter_share_url = $twitter_share['url'];


$opengraph_options = [
    [   "url"  => "http://bit.ly/hsalon6",
        "text" => "Free website for your hair salon - only 45 hours left!
Otonomic turns your Facebook page into a website."
    ],
    [   "url"  => "http://bit.ly/hsalon16",
        "text" => "Get your hair salon a Free website!
Otonomic turns your Facebook page into a self updating website.
"
    ],
    [   "url"  => "http://bit.ly/hsalon17",
        "text" => "Transform your Facebook page into a beautiful website -Free!
Otonomic creates a website synched with your Facebook content.
"
    ],
    [   "url"  => "http://bit.ly/hsalon18",
        "text" => "Your Hair Salon deserves a website.
Otonomic turns your Facebook page into a beautiful website, synched with all your social media. "
    ],
];

$i = rand(0, count($opengraph_options)-1);
$og_variation = $opengraph_options[$i];
$og_title = $og_variation['text'];
$og_url = $og_variation['url'];
?>

<!DOCTYPE html>
<!--[if lte IE 8]> <html class="ie8" lang="en"> <![endif]-->
<!--[if !IE]><!--> <html lang="en">             <!--<![endif]-->
<head>
    <script src="//cdn.optimizely.com/js/326727683.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Otonomic - turn your Facebook page into a professional website</title>
    <meta property="og:title" content="<?= $og_title?>"/>
    <meta property="og:site_name" content="Otonomic"/>
    <meta property="og:description"
          content="Otonomic turns your Facebook business page into a website."/>
    <meta property="og:url" content="<?= $og_url?>"/>
    <meta property="og:image" content="http://www.otonomic.com/images/hairstyleWebsite-theme-154x113_4x.jpg"/>

    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/styles.css?v=0.0.1">
    <link rel="stylesheet" type="text/css" href="css/searchResults.css">

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-37736198-1', 'auto');
        ga('send', 'pageview');
    </script>

    <script type="text/javascript" async="" src="http://cdn.luckyorange.com/w.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
    <script type="text/javascript" src="js/main.js?v=1.0"></script>
    <script type="text/javascript" async="" src="http://cdn.luckyorange.com/w.js"></script>
    <script src="/js/otonomic-analytics.js"></script>


    <!-- Facebook Conversion Code for User visited hairstyling LP -->
    <script>(function() {
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
        window._fbq.push(['track', '6021558542830', {'value':'0.00','currency':'USD'}]);
    </script>
    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6021558542830&amp;cd[value]=0.00&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
    <!-- END Facebook Conversion Code for User visited hairstyling LP -->
</head>

<body>

<div class="container-fluid">
    <div class="row">
      <header class="header">
        <img class="logo-img" src="images/otonomic-logo.png" alt="otonomic.com">
        <div class="fb-like pull-right hidden-xs hidden-sm" data-href="https://www.facebook.com/otonomic" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
        <div class="fb-like pull-right hidden-md hidden-lg" data-href="https://www.facebook.com/otonomic" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
      </header>
    </div>
    <div class="row main-content">
      <div class="col-xs-12 col-md-11 col-md-offset-1">
        <!-- Angled wrapper -->
        <div class="angled-wrapper rr-left">
          <h1 class="js-heading-text heading-text">Have the website you’ve always<br /> wanted in just 5 clicks.</h1>
          <h2 class="text2">How? it’s easy!</h2>
          <p class="text3">We take your Facebook page and turn it into a <br />beautiful mobile & desktop website.</p>
          <p class="js-text3 text3">Connect to your Facebook page</p>
          <!-- Search input field -->
          <div class="p2s_fanpages">
            <div class="form-search form-inline">
              <input id="main_search_box" type="text" 
              class="form-control main_search_box LoNotSensitive"
              data-attr="center"
              onClick="searchBoxClick('#main_search_box');" 
              onKeyup="searchBoxKeyUp('#main_search_box','#search_wrapper_main','.close-search');"
              placeholder="Type your Facebook page name (or URL)">
              <button id="btn_go" class="btn btn_go" data-attr="center" data-target-field="main_search_box" type="button">Get my website</button>
              <span class="close-search" onClick="closeSearch('#search_wrapper_main','center')" style="display: none;">
                <img src="/shared/fanpages/images/close.png" width="32" height="32">
              </span>
            </div>
            <div class="tb search-wrapper" id="search_wrapper_main" data-attr="center"></div>
          </div>
          <!-- Share Buttons -->
          <div class="js-social-shares social-shares-container" style="display:none;">
              <a href="javascript:void(0)" class="fb-share" onclick="shareOnFB();">
                  <img src="images/facebook-icon.svg">
                  Share on facebook
              </a>
              <a class="tweet" href="https://twitter.com/intent/tweet?url=<?= $twitter_share_url?>&text=<?= $twitter_share_text?>">
                  <img src="images/twitter-icon.svg">
                  Share on twitter
              </a>             
          </div>
        </div>
      </div>
    </div>
    <div class="row websites-counter">
      <div class="col-xs-12 col-md-11 col-md-offset-1">
        <b>30,218</b> Websites created, and counting...
      </div>
    </div>
    <div class="row testimonials">
      <section class="media-links "><!-- Section Media -->
        <div class="hidden-xs">
            <h3 class="text-center">As seen on:</h3>
          <div class="section-media holder">
            <div class="media-item">
              <a href="http://finance.yahoo.com/news/otonomic-launches-one-click-website-130000355.html;_ylt=AwrBT7wCW1pU4o0AzwZXNyoA;_ylu=X3oDMTEzYWhlMWs4BHNlYwNzcgRwb3MDMQRjb2xvA2JmMQR2dGlkA1ZJUDMwMV8x" target="_blank"><img src="images/media2.png" class="img-responsive" alt="Yahoo"></a>
            </div>
            <div class="media-item">
              <a href="http://smallbusiness.foxbusiness.com/finance-accounting/2014/05/02/funding-roundup-social-media-management-startup-sprinklr-raises-40-million/" target="_blank"><img src="images/media3.png" class="img-responsive" alt="FOX Business"></a>
            </div>
            <div class="media-item">
              <a href="http://allfacebook.com/otonomic_b131534" target="_blank"><img src="images/media4.png" class="img-responsive" alt="All Facebook"></a>
            </div>
            <div class="media-item">
              <a href="http://www.inc.com/christina-desmarais/6-tools-that-can-save-you-precious-time.html" target="_blank"><img src="images/media5.png" class="img-responsive" alt="Inc."></a>
            </div>
            <div class="media-item">
              <a href="http://www.forbes.com/sites/ilyapozin/2014/06/29/25-hot-israeli-tech-startups/" target="_blank"><img src="images/media6.png" class="img-responsive" alt="forbes"></a>
            </div>
            <div class="media-item">
              <a href="http://communitytable.com/309854/kevinducoff/4-must-have-tools-for-easy-website-creation/" target="_blank"><img src="images/media7.png" class="img-responsive" alt="parade"></a>
            </div>
          </div>
        </div>
        <div class=" visible-xs">
          <h3 class="text-center">As seen on:</h3>
          <a href="#">
            <div class="mobile-media-item-holder">
              <div class="mobile-media-item">
                <a href="http://finance.yahoo.com/news/otonomic-launches-one-click-website-130000355.html;_ylt=AwrBT7wCW1pU4o0AzwZXNyoA;_ylu=X3oDMTEzYWhlMWs4BHNlYwNzcgRwb3MDMQRjb2xvA2JmMQR2dGlkA1ZJUDMwMV8x" target="_blank"><img src="images/media2.png" class="img-responsive" alt="Yahoo"></a>
              </div>
            </div>
          </a>
          <a href="#">
            <div class="mobile-media-item-holder">
              <div class="mobile-media-item">
                <a href="http://smallbusiness.foxbusiness.com/finance-accounting/2014/05/02/funding-roundup-social-media-management-startup-sprinklr-raises-40-million/" target="_blank"><img src="images/media3.png" class="img-responsive" alt="FOX Business"></a>
              </div>
            </div>
          </a>
          <a href="#">
            <div class="mobile-media-item-holder bottom">
              <div class="mobile-media-item">
                <a href="http://allfacebook.com/otonomic_b131534" target="_blank"><img src="images/media4.png" class="img-responsive" alt="All Facebook"></a>
              </div>
            </div>
          </a>
        </div>
        <div class=" visible-xs">
          <a href="#">
            <div class="mobile-media-item-holder bottom">
              <div class="mobile-media-item">
                <a href="http://www.inc.com/christina-desmarais/6-tools-that-can-save-you-precious-time.html" target="_blank"><img src="images/media5.png" class="img-responsive" alt="Inc."></a>
              </div>
            </div>
          </a>
          <a href="#">
            <div class="mobile-media-item-holder bottom">
              <div class="mobile-media-item">
                <a href="http://www.forbes.com/sites/ilyapozin/2014/06/29/25-hot-israeli-tech-startups/" target="_blank"><img src="images/media6.png" class="img-responsive" alt="Forbes.com"></a>
              </div>
            </div>
          </a>
          <a href="#">
            <div class="mobile-media-item-holder bottom">
              <div class="mobile-media-item">
                <a href="http://communitytable.com/309854/kevinducoff/4-must-have-tools-for-easy-website-creation/" target="_blank"><img src="images/media7.png" class="img-responsive"></a>
              </div>
            </div>
          </a>
        </div>
      </section>
    </div>
    <div class="row">
      <footer>
        <div class="col-xs-12">
          <div class="footer-text">
            <a href="http://otonomic.com/terms" target="_blank">Terms of Use</a> | 
            <a href="http://otonomic.com/pdfs/Otonomic_Privacy_Policy.pdf" target="_blank">Privacy Policy</a> | 
            <a href="http://support.otonomic.com/" target="_blank">FAQ</a> |   
            <a href="mailto:info@otonomic.com" target="_blank">Contact</a> 
            © 2014
          </div>
          <div class="social-channels">
              <a class="social-btn facebook-btn" target="_blank" href="https://www.facebook.com/otonomic"><img src="images/facebook-icon.svg"></a>
              <a class="social-btn twitter-btn" target="_blank" href="https://twitter.com/otonomic"><img src="images/twitter-icon.svg"></a>
              <a class="social-btn linkedin-btn" target="_blank" href="https://www.linkedin.com/company/otonomic"><img src="images/linkedin-icon.svg"></a>
              <a class="social-btn googleplus-btn" target="_blank" href="https://plus.google.com/+Otonomic/about"><img src="images/googleplus-icon.svg"></a>
          </div>
        </div>
      </footer>
    </div>
</div>
    <!-- Search box template -->
    <div style="display: none">
      <div class="t_box">
          <div class="msgbox">
              <div class="header">
                  <a href="#" class="close_btn close-search" onclick="closeSearch('.search-wrapper'); return false;"><span class="glyphicon glyphicon-remove"></span></a>
                  <span class="msg_info">We weren't able to find this page on Facebook</span>
              </div>

              <div class="body_info">
                  <h1 class="first_msg">Refine your search</h1>
                  <p class="first_msg_desc">e.g. "my business" instead of "mybusiness"</p>
                  <p class="or_msg">Or</p>
                  <h1>Enter the full Facebook address of your business</h1>
                  <p style="display: inline-block;">e.g.: "https://www.facebook.com/pages/Jessicas-Pastries"</p>
                  <a href="#" id="how_do_i">How do I do that?</a>
                  <p class="or_msg">Or</p>
                  <a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" id="fb_connector" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="Search explanation box" data-ajax-track="1">Connect
                  </a>
                <h1 style="line-height: 34px; float:left;">So we can find your page for you.</h1>
              </div>
          </div>

          <div class="steps">
              <ul>
                  <li>
                      <h1>Step 1 </h1> | <span>Go to your Facebook business page</span>
                  </li>
                  <li>
                      <h1>Step 2 </h1> | <span>Copy the address shown in your browser</span>
                      <p>(starts with "https://www.facebook.com")</p>
                  </li>
                  <li>
                      <h1>Step 3 </h1> | <span>Paste the address in the search box above.</span>
                  </li>
                  <li>
                      <h1>Step 4 </h1> | <span>Click "See my website"</span>
                  </li>
              </ul>
          </div>
      </div>

      <div class="search_progress hidden" style="position: absolute; left: -35px;">
          <span class="msg_info">Search in progress, please wait...!!!</span>
      </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
    <script type="text/javascript" src="https://d2zxr4ixkv1lwq.cloudfront.net/lp/js/jquery.jsonp-2.4.0.min.js" defer></script>
    <script type="text/javascript" src="/js/search_filterv1.0.4-wp.js?v=1.0.4"></script>
    <link type="text/css" href="http://d2zxr4ixkv1lwq.cloudfront.net/lp/css/tipsy.css" rel="stylesheet">
    <script type="text/javascript" src="http://d2zxr4ixkv1lwq.cloudfront.net/lp/js/jquery.tipsy.js" defer></script>
    <script type="text/javascript" src="/js/otonomicv1.0.4.js"></script>
    <script type="text/javascript" src="/js/functions.js"></script>
</body>
</html>
