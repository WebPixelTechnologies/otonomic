<!DOCTYPE html>
<html lang="en">
  <head>
  	<script src="//cdn.optimizely.com/js/326727683.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Otonomic Site Creation Page">
    <meta name="author" content="Otonomic">
    <link rel="shortcut icon" href="favicon.ico">

    <title>Otonomic is creating your site...</title>

      <!-- Glyphicons -->
      <link href="fonts/Glyphicons-WebFont/glyphicons.css" rel="stylesheet">

      <link rel='stylesheet' id='sb_instagram_icons-css'  href='//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css?ver=4.2.0' type='text/css' media='all' />

      <!-- Aller font -->
      <link href="fonts/Aller-WebFont/aller_font.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/wp-loading-page.css" rel="stylesheet">

      <script src="js/jquery-1.11.1.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/typeahead.jquery.min.js"></script>

      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

      <![endif]-->
    <script src="/js/otonomic-analytics.js?v=1.0"></script>
  </head>

  <body class="wp-lp">

  <!-- Facebook SDK -->
  <div id="fb-root"></div>
  <script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=575528525876858&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <!-- /Facebook SDK -->

    <!-- Intro    ========================================================== -->
    <div class="container-fluid">
      <div id="intro" class="row installer-stage">
        <div class="bg-image hidden-xs"></div>
        <div class="col-xs-12">
          <div class="text-center">
            <img class="logo" src="images/otonomic-logo-dark.png">
            <h1 class="title">Create a website for </h1>
            <p class="site-name" id="ot-fb-name">YOUR BUSINESS</p>
            <h2 >in just 5 minutes!</h2>
            <a href="#" onclick="return false;" class="btn btn-ttc-blue btn-next">Let the magic begin!<span class="glyphicon glyphicon-chevron-right"></span></a>
          </div>
        </div>
      </div>

      <!-- Stage ================================================ -->
      <div id="" class="row hidden installer-stage">
          <div class="bg-image hidden-xs"><div class="map_canvas"></div></div>
          <div class="content-panel">
              <h1 class="title">Let's start creating your awesome website!</h1>
              <h3></h3>
              <form role="form" id="business-details" action="">
                  <div class="row">
                      <div class="col-xs-12">
                          <div class="form-group">
                              <label for="productName">Business name</label>
                              <textarea rows="3" id="address" name="contact_address" class="form-control" autocomplete="off" placeholder=""></textarea>
                          </div>
                          <div class="form-group">
                              <label for="email">Category</label>
                              <div id="cat-selector" class="">
                                  <input class="typeahead form-control pulse-background" type="text" placeholder="Search for your category" id="fb_category">
                                  <!-- span class="glyphicon glyphicon-search form-control-feedback"></span -->
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" name="contact_email" value="">
                          </div>
                          <div class="form-group text-right">
                              <a href="#" onclick="return false;" class="submit-skip-contact btn btn-ttc-clear btn-lg"><span class="glyphicon glyphicon-share-alt"></span>Skip</a>
                              <a href="#" onclick="return false;" class="btn-next btn btn-ttc-orange btn-lg"><span class="glyphicon glyphicon-ok"></span>Next</a>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>

      <!-- Stage ================================================ -->
      <div id="stage-3" class="row hidden installer-stage">
          <div class="bg-image hidden-xs"><img src="images/bg7.jpg"></div>
          <div class="content-panel">
              <div class="hidden-xs">
                  <img class="logo" src="images/otonomic-logo-dark.png">
                  <h1 class="title">Site Purpose</h1>
                  <h2>What would you like to achieve with your website?</h2>
                  <div class="row">
                      <div class="col-xs-12">
                          <button id="option-online-store" class="btn btn-block btn-ttc-white btn-checkbox btn-add-on" data-analytics-action="Addons" data-analytics-label="Online Store">
                              <span class="text-type-1">Sell products online</span>
                              <span class="glyphicons shop"></span>
                          </button>
                      </div>
                      <div class="col-xs-12">
                          <button id="option-booking" class="btn btn-block btn-ttc-white btn-checkbox btn-add-on" data-analytics-action="Addons" data-analytics-label="Online Booking">
                              <span class="text-type-1">Receive Appointments</span>
                              Let your clients book online <span class="glyphicons calendar"></span>
                          </button>
                      </div>
                      <div class="col-xs-12">
                          <button class="btn btn-block btn-ttc-white btn-checkbox btn-add-on" data-analytics-action="Addons" data-analytics-label="I don’t need these features">
                              <span class="text-type-1">Show my portfolio</span>
                              <span class="glyphicons picture"></span>
                          </button>
                      </div>
                      <div class="col-xs-12">
                          <button class="btn btn-block btn-ttc-white btn-checkbox btn-add-on" data-analytics-action="Addons" data-analytics-label="I don’t need these features">
                              <span class="text-type-1">Get more readers for my content</span>
                              <span class="glyphicons newspaper"></span>
                          </button>
                      </div>
                  </div>

                  <hr>
                  <a href="#" onclick="return false;" class="btn btn-ttc-orange pull-right disabled js-stage3-next next-btn">
                      Select
                      <span class="glyphicon glyphicon-chevron-right"></span>
                  </a>
                  <a href="#" onclick="return false;" class="btn btn-ttc-clear btn-back pull-right">
                      <span class="glyphicons undo"></span>
                      Back
                  </a>
              </div>
          </div>
      </div>


      <!-- Stage ================================================ -->
      <div id="choose-template" class="row hidden installer-stage">
          <div class="content-panel">
              <img class="logo" src="images/otonomic-logo-dark.png">
              <div class="hidden-xs">
                  <h1 class="title">Your website, your vision.</h1>
                  <h2>Choose a template that you like. You can switch anytime.</h2>
              </div>
              <div class="visible-xs">
                  <h1 class="title">Choose a template that you like:</h1>
                  <p>(You can switch anytime)</p>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-6">
                      <div class="template-conrainer pull-right">
                          <div class="overlay">
                              <h3>Curly Beige</h3>
                              <p>Perfect for ...</p>
                              <button class="btn btn-ttc-blue btn-choose-template" data-option-value="curly-beige"><span class="glyphicons ok_2"></span> Choose Template</button>
                          </div>
                          <img class="img-responsive" src="images/templates/curly-beige.png">
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                      <div class="template-conrainer">
                          <div class="overlay">
                              <h3>Fluffy Strokes</h3>
                              <p>Perfect for ...</p>
                              <button class="btn btn-ttc-blue btn-choose-template" data-option-value="fluffy-strokes"><span class="glyphicons ok_2"></span> Choose Template</button>
                          </div>
                          <img class="img-responsive" src="images/templates/fluffy-strokes.png">
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                      <div class="template-conrainer pull-right">
                          <div class="overlay">
                              <h3>Blonde Rays</h3>
                              <p>Perfect for ...</p>
                              <button class="btn btn-ttc-blue btn-choose-template" data-option-value="blonde-rays"><span class="glyphicons ok_2"></span> Choose Template</button>
                          </div>
                          <img class="img-responsive" src="images/templates/blonde-rays.png">
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                      <div class="template-conrainer">
                          <div class="overlay">
                              <h3>Dream Salon</h3>
                              <p>Perfect for ...</p>
                              <button class="btn btn-ttc-blue btn-choose-template" data-option-value=""><span class="glyphicons ok_2"></span>Choose Template</button>
                          </div>
                          <img class="img-responsive" src="images/templates/dream-salon.png">
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Stage ================================================ -->
      <div id="" class="row hidden installer-stage">
          <div class="bg-image hidden-xs"><div class="map_canvas"></div></div>
          <div class="content-panel">
              <h1 class="title">Let your clients easily contact you!</h1>
              <h3>Review, update and complete your contact details to make sure clients can reach you:</h3>
              <form role="form" id="business-details" action="">
                  <div class="row">
                      <div class="col-xs-12">
                          <div class="form-group">
                              <label for="productName">Business address</label>
                              <textarea rows="3" id="address" name="contact_address" class="form-control" autocomplete="off" placeholder=""></textarea>
                          </div>
                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" name="contact_email" value="">
                          </div>
                          <div class="form-group">
                              <label for="phone">Phone number</label>
                              <input type="text" class="form-control" id="phone" name="contact_phone" value="">
                          </div>
                          <div class="checkbox">
                              <label for="show_opening_hours"><input type="checkbox" id="show_opening_hours" name="show_opening_hours"> Show opening hours</label>

                          </div>

                          <div class="opening-hours" id="opening-hours">
                              <h4>Opening Hours</h4>

                              <div class="form-group opening-hours">
                                  <label for="opening_hours_mon">Monday</label>
                                  <input type="text" class="form-control" name="opening_hours[mon][start]"
                                         value="">
                                  <span>&nbsp;-&nbsp;</span>
                                  <input type="text" class="form-control" name="opening_hours[mon][end]"
                                         value="">
                              </div>

                              <div class="form-group opening-hours">
                                  <label for="opening_hours_tue">Tuesday</label>
                                  <input type="text" class="form-control" name="opening_hours[tue][start]"
                                         value="">
                                  <span>&nbsp;-&nbsp;</span>
                                  <input type="text" class="form-control" name="opening_hours[tue][end]"
                                         value="">
                              </div>

                              <div class="form-group opening-hours">
                                  <label for="opening_hours_wed">Wednesday</label>
                                  <input type="text" class="form-control" name="opening_hours[wed][start]"
                                         value="">
                                  <span>&nbsp;-&nbsp;</span>
                                  <input type="text" class="form-control" name="opening_hours[wed][end]"
                                         value="">
                              </div>

                              <div class="form-group opening-hours">
                                  <label for="opening_hours_thu">Thursday</label>
                                  <input type="text" class="form-control" name="opening_hours[thu][start]"
                                         value="">
                                  <span>&nbsp;-&nbsp;</span>
                                  <input type="text" class="form-control" name="opening_hours[thu][end]"
                                         value="">
                              </div>

                              <div class="form-group opening-hours">
                                  <label for="opening_hours_fri">Friday</label>
                                  <input type="text" class="form-control" name="opening_hours[fri][start]"
                                         value="">
                                  <span>&nbsp;-&nbsp;</span>
                                  <input type="text" class="form-control" name="opening_hours[fri][end]"
                                         value="">
                              </div>

                              <div class="form-group opening-hours">
                                  <label for="opening_hours_sat">Saturday</label>
                                  <input type="text" class="form-control" name="opening_hours[sat][start]"
                                         value="">
                                  <span>&nbsp;-&nbsp;</span>
                                  <input type="text" class="form-control" name="opening_hours[sat][end]"
                                         value="">
                              </div>

                              <div class="form-group opening-hours">
                                  <label for="opening_hours_sun">Sunday</label>
                                  <input type="text" class="form-control" name="opening_hours[sun][start]"
                                         value="">
                                  <span>&nbsp;-&nbsp;</span>
                                  <input type="text" class="form-control" name="opening_hours[sun][end]"
                                         value="">
                              </div>
                          </div>


                          <div class="form-group text-right">
                              <a href="#" onclick="return false;" class="submit-skip-contact btn btn-ttc-clear btn-lg"><span class="glyphicon glyphicon-share-alt"></span>Skip</a>
                              <a href="#" onclick="return false;" class="btn-next btn btn-ttc-orange btn-lg"><span class="glyphicon glyphicon-ok"></span>Next</a>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>

      <!-- Stage  ========================================================== -->
      <div id="" class="row hidden installer-stage">
          <div class="bg-image hidden-xs"><img src="images/bg6.jpg"></div>
          <div class="content-panel">
              <img class="logo" src="images/otonomic-logo-dark.png">
              <h1 class="title">Every social media post added to your website. </h1>
              <h2>We help you promote your website with every new post and picture.</h2>
              <p>Select the social networks you’d like to connect to your site:</p>
              <!--
              <div class="row">
                  <div class="col-xs-12">
                      <button class="btn social-btn facebook-btn selected" data-analytics-action="Social" data-analytics-label="Facebook"><img src="images/facebook-icon.svg"></button>
                      <button class="btn social-btn twitter-btn" data-analytics-action="Social" data-analytics-label="Twitter"><img src="images/twitter-icon.svg"></button>
                      <button class="btn social-btn instagram-btn" data-analytics-action="Social" data-analytics-label="Instagram"><img src="images/instagram-icon.svg"></button>
                      <button class="btn social-btn googleplus-btn" data-analytics-action="Social" data-analytics-label="Google plus"><img src="images/googleplus-icon.svg"></button>
                  </div>
              </div>
              -->

              <div class="row">
                  <div class="col-xs-12">

                      <!-- START Facebook -->
                      <div class="form-group social-media-field" id="facebook">
                          <div class="row">
                              <div class="col-xs-3">
                                  <label for="businessName"><i class="fa fa-facebook-square"></i> Facebook</label>
                              </div>
                              <div class="col-xs-9 has-feedback">
                                  <input type="text" class="form-control LoNotSensitive" id="social_media_facebook" name="social_media_facebook" value="pinkfloyd1">
                                  <i class="glyphicons remove_2 form-control-feedback clear-input"></i>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-xs-12">
                                  <div class="search-results-container" id="search-results-facebook"></div>
                              </div>
                          </div>
                      </div>
                      <!-- END Facebook -->

                      <!-- START Instagram -->
                      <div class="form-group social-media-field" id="instagram">
                          <div class="row">
                              <div class="col-xs-3">
                                  <label for="businessName"><i class="fa fa-instagram"></i> Instagram</label>
                              </div>
                              <div class="col-xs-9 has-feedback">
                                  <input type="text" class="form-control LoNotSensitive" id="social_media_instagram" name="social_media_instagram" value="pinkfloyd1">
                                  <i class="glyphicons remove_2 form-control-feedback clear-input"></i>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-xs-12">
                                  <div class="search-results-container" id="search-results-instagram"></div>
                              </div>
                          </div>
                      </div>
                      <!-- END Instagram -->

                      <!-- START YouTube -->
                      <div class="form-group social-media-field" id="youtube">
                          <div class="row">
                              <div class="col-xs-3">
                                  <label for="businessName"><i class="fa fa-youtube"></i> YouTube</label>
                              </div>
                              <div class="col-xs-9 has-feedback">
                                  <input type="text" class="form-control LoNotSensitive" id="social_media_youtube" name="social_media_youtube" value="pinkfloyd1">
                                  <i class="glyphicons remove_2 form-control-feedback clear-input"></i>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-xs-12">
                                  <div class="search-results-container" id="search-results-youtube"></div>
                              </div>
                          </div>
                      </div>
                      <!-- END YouTube -->


                      <!-- START Twitter -->
                      <div class="form-group social-media-field" id="twitter">
                          <div class="row">
                              <div class="col-xs-3">
                                  <label for="businessName"><i class="fa fa-twitter"></i> Twitter</label>
                              </div>
                              <div class="col-xs-9 has-feedback">
                                  <input type="text" class="form-control LoNotSensitive" id="social_media_twitter" name="social_media_twitter" value="pinkfloyd1">
                                  <i class="glyphicons remove_2 form-control-feedback clear-input"></i>
                              </div>
                          </div>

                          <div class="row">
                              <div class="col-xs-12">
                                  <div class="search-results-container" id="search-results-twitter"></div>
                              </div>
                          </div>
                      </div>
                      <!-- END Twitter -->
                  </div>
              </div>

              <a href="#" onclick="return false;" class="btn btn-ttc-orange pull-right js-stage4-next">
                  Select
                  <span class="glyphicon glyphicon-chevron-right"></span>
              </a>
              <a href="#" onclick="return false;" class="btn btn-ttc-clear btn-back pull-right">
                  <span class="glyphicons undo"></span>
                  Back
              </a>
          </div>
      </div>









        <!-- Congratz ========================================================== -->
      <div id="congratz" class="row hidden text-center">
        <img class="logo" src="images/otonomic-logo-dark.png">
        <div class="upper-content">
          <p class="site-name" id="ot-fb-name">Your business</p>
          <h1 class="congratz-title">website will be ready in <span id="counter">7 seconds</span></h1>
          <div class="fb-like" data-href="https://www.facebook.com/otonomic" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
          <img class="oto-anima" src="images/ottoHoverLoop.gif">
        </div>
        <div class="lower-content">
          <h3 id="oto-web-url" class="hidden">http://wp.otonomic.com/newsite</h3>
          <p class="tos">
            By continuing to use our platform, you accept the Otonomic <a target="_blank" href="/pdfs/Otonomic_Terms_of_Service.pdf" id="link-tos">Terms of Service</a>
          </p>
        </div>
      </div>
    </div><!-- /.container -->

    <script src="js/main.js?v=1.0.1"></script>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: "373931652687761",
                status: true,
                cookie: true,
                xfbml: true
            });

            window.fbAsyncInit.fbLoaded.resolve();
            checkConnectedWithFacebook();
        };
        window.fbAsyncInit.fbLoaded = jQuery.Deferred();
    </script>

    <script type="text/javascript">
      var base_url = 'http://otonomic.com/hybridauth/twitter.php';

      jQuery(document).ready(function($) {
          trackFacebookPixel('viewed_installer');
          window._fbq = window._fbq || [];
          window._fbq.push(['track', '6021618382030', {'value':'0.00','currency':'USD'}]);


          $('#social_connect_hybrid a').click(function(){
              var type = $(this).attr('id').split('_');

              track_event('Loading Page', 'Social Connect', type[1]);

              var url = base_url+"?social="+type[1];
              window.open(
                      url,
                      "hybridauth_social_sign_on",
                      "location=0,status=0,scrollbars=1,width=800,height=500"
              );
              return false;
          });

          // Change social buttons appearance depending on screen width
            var changeWidth = function(){
            console.log('Resized');
            if ( $(window).width() < 480 ){
                $('#social_connect_hybrid').addClass('btn-group-justified btn-group');
                $('#social_connect_hybrid a').addClass('btn');
              } else {
                $('.btn-group-vertical').removeClass('btn-group-justified btn-group');
                $('#social_connect_hybrid a').removeClass('btn');
              }
            };
            $(window).resize(changeWidth());

          // Search engine buttons
          $('.btn-search-engine').click(function(){
            // $('.btn-search-engine').removeClass('checked');
            $(this).toggleClass('checked');

              var engineName =$(this).data('engine');
            $('.js-stage1-next').removeClass('disabled').html('Rank high on search engines, got it!');
          });

          // Devices buttons
          $('.btn-device').click(function(){
            // $('.btn-device').removeClass('checked');
            $(this).toggleClass('checked');
            $(this).parents('.installer-stage').find('.next-btn').removeClass('disabled').html('Continue <span class="glyphicon glyphicon-chevron-right"></span>');
          });

          // Online store / booking buttons
          $('.btn-add-on').click(function(){
              var $this = $(this);
              if($this.hasClass('btn-uncheck-others') && !$this.hasClass('checked')) {
                $('.btn-add-on').removeClass('checked');
              } else {
                $('.btn-uncheck-others').removeClass('checked');
              }
              $this.toggleClass('checked');
              $this.parents('.installer-stage').find('.next-btn').removeClass('disabled').html('Continue <span class="glyphicon glyphicon-chevron-right"></span>');
          });

          // Devices buttons
          $('.social-btn').click(function(){
              $(this).toggleClass('selected');
          });

          $('#show_opening_hours').click(function() {
              $('#opening-hours').toggle();
          });




          var path_socialmedia_library = "/shared/lib/socialmedia/";
          $('#social_media_twitter').on('keyup', function() {
              var $this = $(this);
              var searchval = $this.val();
              if(searchval.length > 2) {
                  jQuery('#search-results-twitter').html('Searching... ').show();
                  jQuery.get(path_socialmedia_library + "searchUsernameTwitter.php?format=html&search_box="+searchval, function(data) {
                      jQuery('#search-results-twitter').html(data);
                      jQuery('#social_media_twitter').find('.clear').show();
                  });
              } else {
                  jQuery('#search-results-twitter').html('').hide();
                  jQuery('#social_media_twitter').find('.clear').hide();
              }
          });
          $('#search-results-twitter').on('click', '.media.selectable', function() {
              var value = $(this).attr('data-value');
              $('#social_media_twitter').val(value);
              $('#search-results-twitter').hide();
          });

          /* Youtube */
          $('#social_media_youtube').on('keyup', function() {
              var $this = $(this);
              var searchval = $this.val();
              if(searchval.length > 2) {
                  jQuery('#search-results-youtube').html('Searching... ').show();
                  jQuery.get(path_socialmedia_library + "searchUsernameYoutube.php?format=html&search_box="+searchval, function(data) {
                      jQuery('#search-results-youtube').html(data);
                      jQuery('#youtube').find('.clear').show();
                  });
              } else {
                  jQuery('#search-results-youtube').html('').hide();
                  jQuery('#social_media_youtube').find('.clear').hide();
              }
          });
          $('#search-results-youtube').on('click', '.media.selectable', function() {
              var value = $(this).attr('data-value');
              $('#social_media_youtube').val(value);
              $('#search-results-youtube').hide();
          });
          /* Instagram */
          $('#social_media_instagram').on('keyup', function() {
              var $this = $(this);
              var searchval = $this.val();
              if(searchval.length > 2) {
                  jQuery('#search-results-instagram').html('Searching... ').show();
                  jQuery.get(path_socialmedia_library + "searchUsernameInstagram.php?format=html&search_box="+searchval, function(data) {
                      jQuery('#search-results-instagram').html(data);
                      jQuery('#instagram').find('.clear').show();
                  });
              } else {
                  jQuery('#search-results-instagram').html('').hide();
                  jQuery('#social_media_instagram').find('.clear').hide();
              }
          });
          $('#search-results-instagram').on('click', '.media.selectable', function() {
              var value = $(this).attr('data-value');
              $('#social_media_instagram').val(value);
              $('#search-results-instagram').hide();
          });
          /* Facebook */
          $('#social_media_facebook').on('keyup', function() {
              var $this = $(this);
              var searchval = $this.val();
              if(searchval.length > 2) {
                  jQuery('#search-results-facebook').html('Searching... ').show();
                  jQuery.get(path_socialmedia_library + "searchUsernameFacebook.php?format=html&search_box="+searchval, function(data) {
                      jQuery('#search-results-facebook').html(data);
                      jQuery('#facebook').find('.clear').show();
                  });
              } else {
                  jQuery('#search-results-facebook').html('').hide();
                  jQuery('#social_media_facebook').find('.clear').hide();
              }
          });
          $('#search-results-facebook').on('click', '.media.selectable', function() {
              var value = $(this).attr('data-value');
              $('#social_media_facebook').val(value);
              $('#search-results-facebook').hide();
          });
      })
    </script>

  </body>
</html>
