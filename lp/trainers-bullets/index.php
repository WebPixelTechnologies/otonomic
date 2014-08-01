<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Otonomic - Personal Trainers</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom-style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <!-- Facebook Conversion Code for User searched for page -->
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
    </script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div id="header">
            <p class="header-title pull-left">Get a Free Website that Updates Itself!<br>This is how it works:</p>
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
                <div class="media">
                  <a class="pull-left" href="#">
                    <img class="media-object" src="images/plane.png" alt="We automatically build and design your website">
                  </a>
                  <div class="media-body">
                    <h4 class="media-heading">We automatically build and design your website</h4>
                    using the content from your Facebook business page
                  </div>
                </div>
                <div class="media">
                  <a class="pull-left" href="#">
                    <img class="media-object" src="images/beer.png" alt="You don't have to do anything">
                  </a>
                  <div class="media-body">
                    <h4 class="media-heading">You don't have to do anything</h4>
                    and it only takes about a minute
                  </div>
                </div>
                <div class="media last">
                  <a class="pull-left" href="#">
                    <img class="media-object" src="images/facebook.png" alt="Enter your Facebook business page name">
                  </a>
                  <div class="media-body">
                    <h4 class="media-heading">Enter your Facebook business page name</h4>
                    below and get your website now!
                  </div>
                </div>
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
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript" src="//cherne.net/brian/resources/jquery.hoverIntent.minified.js"></script>

    <script type="text/javascript" src="http://d2zxr4ixkv1lwq.cloudfront.net/lp/js/jquery.jsonp-2.4.0.min.js" defer></script>

    <link rel="stylesheet" type="text/css" href="css/searchResults.css">
    <script type="text/javascript" src="js/search_filterv1.0.4-wp.js"></script>

    <link href="http://d2zxr4ixkv1lwq.cloudfront.net/lp/css/tipsy.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://d2zxr4ixkv1lwq.cloudfront.net/lp/js/jquery.tipsy.js" defer></script>

    <script type="text/javascript" src="js/otonomicv1.0.4.js"></script>

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












      <!-- START ErrorCeption -->
      <script>
          (function(_,e,rr,s){_errs=[s];var c=_.onerror;_.onerror=function(){var a=arguments;_errs.push(a);
              c&&c.apply(this,a)};var b=function(){var c=e.createElement(rr),b=e.getElementsByTagName(rr)[0];
              c.src="//beacon.errorception.com/"+s+".js";c.async=!0;b.parentNode.insertBefore(c,b)};
              _.addEventListener?_.addEventListener("load",b,!1):_.attachEvent("onload",b)})
                  (window,document,"script","52713acf0a2b9bf55800090f");
      </script>
      <!-- END ErrorCeption -->

      <!-- START LuckyOrange -->
    <script type='text/javascript'>
        window.__wtw_lucky_site_id = 10400;

        (function() {
            var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
            wa.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://ca10400') + '.luckyorange.com/w.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
        })();
    </script>
    <!-- END LuckyOrange -->

      <!-- START Google Analytics -->
      <script>
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-37736198-1']);
          _gaq.push(['_setDomainName', 'otonomic.com']);
          _gaq.push(['_setAllowLinker', true]);
          _gaq.push(['_trackPageview']);

          (function() {
              var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
      </script>

      <script type="text/javascript">
    var _paq = _paq || [];
    
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u=(("https:" == document.location.protocol) ? "https" : "http") + "://a.otonomic.com/";
            _paq.push(['setTrackerUrl', u+'piwik.php']);
            _paq.push(['setSiteId', 1]);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
            g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <noscript><p><img src="http://a.otonomic.com/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>

      <!-- END Google Analytics -->

    <script type="text/javascript" src="js/functions.js"></script>
  </body>
</html>