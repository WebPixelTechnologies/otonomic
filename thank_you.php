<?php
/* send email with lead details */
$mail_to = 'edik@otonomic.com';

$headers = 'From: leads@otonomic.com' . "\r\n" .
    'Reply-To: leads@otonomic.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$ip = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);

$server = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
$mail_subject = 'New lead generated on '.$server;
$mail_content = "Page Name: ".$_REQUEST['page_name'];
$mail_content .= "\nPage ID: ".$_REQUEST['page_id'];
$mail_content .= "\nPage Category: ".$_REQUEST['category'];
$mail_content .= "\nIP: ".$ip;

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
      <!-- Main Content -->
      <div id="page-content-wrapper">
          <div class="page-content">
            <div class="container-fluid">
             <!-- top navbar -->
              <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
