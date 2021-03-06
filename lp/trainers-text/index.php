<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Otonomic 1 click website - Personal Trainers</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

      <script src="/js/otonomic-analytics.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div id="header">
            <p class="header-title pull-left">Your website - Free, Updated and Mobile!</p>
            <div class="logo-container pull-right">
              <div class="left-side-border"></div>
              <img src="images/otonomic-logo.png" alt="Otonomic">
            </div>
          </div>
        </div>
      </div>
      <div id="content">
        <div class="row">
          <div class="col-xs-7">
              <div class="content-inner">
                <p class="title-text">Get yourself a website in a time of<br>
                one push-up! It's quick, easy and<br>
                effortless!</p>
                <p class="sub-title-text">Everyone should focus on what they’re doing best. You’re<br>
                the best at training people, and we’re the best at building<br>
                and marketing your website. Let's grow together!</p>
                <img src="images/arrows.png" class="red-arrows">
                <div class="p2s_fanpages">
                  <div class="input-group search-field form-search">
                    <input id="main_search_box" type="text" 
                    class="form-control main_search_box LoNotSensitive"
                    data-attr="center"
                    onClick="searchBoxClick('#main_search_box');" 
                    onKeyup="searchBoxKeyUp('#main_search_box','#search_wrapper_main','.close-search');"
                    placeholder="Enter your Facebook business page name here">
                    <span class="input-group-btn">
                      <button id="btn_go" class="btn btn_go" data-attr="center" data-target-field="main_search_box" type="button">Get Your Website!</button>
                    </span>
                  </div><!-- /input-group -->
                  <!-- <div class="search-wrapper" id="search_wrapper_main"></div> -->
                  <div class="tb search-wrapper" id="search_wrapper_main" data-attr="center"></div>
                  <div style="position:relative;">
                    <span class="icon_clear close-search" onClick="closeSearch('#search_wrapper_main','center')" style="display: none;">
                      <span class="glyphicon glyphicon-remove"></span>
                    </span>
                  </div>
                </div>
          </div>
        </div>
      </div>
      <div id="testimonials">
        <div class="row">
          <div class="col-xs-12">
            <div class="counter text-center">
              <p><b>Over 3,800</b> personal trainers and coaches already have Otonomic websites!</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object testi-image-1" src="images/james.jpg" alt="James Porter">
              </a>
              <div class="media-body">
                <h4 class="media-heading">James Porter</h4>
                This website helped me market myself online, and position myself as a professional personal trainer.
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object testi-image-2" src="images/natalie.jpg" alt="Natalie Bennet">
              </a>
              <div class="media-body">
                <h4 class="media-heading">Natalie Bennet</h4>
                After years of putting off building a site, I finally have one that works<br>and looks great.
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object testi-image-3" src="images/janette.jpg" alt="Janette Wiggins">
              </a>
              <div class="media-body">
                <h4 class="media-heading">Janette Wiggins</h4>
                I was surprised by how easy it was to create and customize the website.
              </div>
            </div>
          </div>
      </div>
    </div>
    <div id="footer" class="text-center">
        <img src="images/footer-logo.png">
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


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/jquery-1.11.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="//cherne.net/brian/resources/jquery.hoverIntent.minified.js"></script>

    <script type="text/javascript" src="http://d2zxr4ixkv1lwq.cloudfront.net/lp/js/jquery.jsonp-2.4.0.min.js" defer></script>

    <link rel="stylesheet" type="text/css" href="css/searchResults.css">
    <script type="text/javascript" src="/js/search_filterv1.0.4-wp.js"></script>

    <link href="http://d2zxr4ixkv1lwq.cloudfront.net/lp/css/tipsy.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://d2zxr4ixkv1lwq.cloudfront.net/lp/js/jquery.tipsy.js" defer></script>

    <script type="text/javascript" src="/js/otonomicv1.0.4.js"></script>

      <script type="text/javascript">
          var query_tags = {
              <?php $get_params = $_GET;
              foreach($get_params as $key => $val) {
                echo "'$key': '$val',";
              }
              ?>
          };
      </script>
    <div id="fb-root"></div>
    <script type="text/javascript">
        window.fbAsyncInit = function() {
            FB.init({ appId: "373931652687761",status: true,cookie: true,xfbml: true});
            window.fbAsyncInit.fbLoaded.resolve();
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












    
        <noscript><p><img src="http://a.otonomic.com/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>


    <script type="text/javascript" src="/js/functions.js"></script>
  </body>
</html>