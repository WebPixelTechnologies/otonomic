<?php
$campaign_id = 'landomania';
$main_image_options = array(
    '<img src="../options_images/Depositphotos_4876746_xs.jpg" alt="Page2site" id="main_image" height="460" style="margin-top:0px">',
    '<img src="../options_images/Depositphotos_3340512_xs.jpg" alt="Page2site" id="main_image" height="460" style="margin-top:0px">',
    '<img src="../options_images/Depositphotos_3855384_xs.jpg" alt="Page2site" id="main_image" style="margin-top:20px">',
    '<img src="../options_images/Depositphotos_5721598_s.jpg" alt="Page2site" id="main_image" height="460" style="margin-top:0px">',
    '<img src="../options_images/Depositphotos_6467121_s.jpg" alt="Page2site" id="main_image" height="460" style="margin-top:0px">',
    '<img src="../options_images/Depositphotos_7267553_s.jpg" alt="Page2site" id="main_image" height="460" style="margin-top:0px">',
    '<img src="../options_images/Depositphotos_7692657_s.jpg" alt="Page2site" id="main_image" height="460" style="margin-top:0px">',
);

$main_button_options = array(
    'Show me my site!',
    'Create my site!'
);




// START Do not change:
$cookie_name = 'landing_page_' . $campaign_id;
$main_image_options_count = count($main_image_options);
$main_button_options_count = count($main_button_options);

if (!empty($_GET['options'])) {
    $mvt_options = $_GET['options'];
} else {
    if (isset($_COOKIE[$cookie_name]) && !isset($_GET['reset_campaign_cookie'])) {
        $mvt_options = $_COOKIE[$cookie_name];
    } else {
        $main_image_option = rand(0, $main_image_options_count - 1);
        $main_button_option = rand(0, $main_button_options_count - 1);
        $mvt_options = $main_image_option . '|' . $main_button_option;

        setcookie($cookie_name, $mvt_options, time() + 3600 * 24 * 7);
    }
}
$mvt_options_arr = explode('|', $mvt_options);
$main_image_tag = $main_image_options[$mvt_options_arr[0]];
$main_button_text = $main_button_options[$mvt_options_arr[1]];

//require_once('../shared/config.php');
// END Do not change
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="author" content="Code Hunk">

        <link rel="shortcut icon" href="../shared/images/favicon.png" />

        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/tipsy.css" type="text/css">
        <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen">
        <link rel="stylesheet" href="css/blue.css" type="text/css">
        <!--[if lte IE 7]> <link rel="stylesheet" href="css/ie.css" type="text/css" /> <![endif]-->

        <style>
            p,ul {
                color: #404040;
                display: block;
                font-size: 15px;
                line-height: 1.5;
                margin-bottom: 5px;
            }
            ul li, ol li {
                list-style: inside;
            }
            #offerright #offerslide, #offerright #offerstatic {
                height: auto;
            }
            #offerright {
                background: none;
                height: auto;
            }
            #offerright #offerslide img, #offerright #offerstatic img {
                height: auto;
                width:auto;
            }
            #offerright #offerslide img, #offerright #offerstatic img {
                max-width: 420px;
                max-height: 460px;
            }
            .center {text-align:center;margin-right:auto;margin-left:auto;}
        </style>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.easing.js"></script>
        <script type="text/javascript" src="js/jquery.tipsy.js"></script>
        <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="js/jquery.cycle.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/PTSans.js"></script>
        <script type="text/javascript" src="js/custom.js"></script><title>Page2site</title>

        <!-- fancybox js/css start -->
        <link rel="stylesheet" type="text/css" href="../shared/css/fancybox/jquery.fancybox.css" />
        <script type="text/javascript" src="../shared/js/jquery.fancybox.js"></script>
        <!-- fancybox js/css end -->

        <?php /*
        <script type="text/javascript">
        	
            $(document).ready(function(){
                $("#facebook_connect").live('click',function() {
                    $.fancybox.open({
                        href : '<?php echo URL_MARKETING_SITE; ?>facebook_connect_iframe.php',
                        type : 'iframe',
                        padding : 5,
                        width : 500,
                        minHeight : 400
                    });
            
                    return false;
                });
            });
            
        </script>
		*/ ?>
    <noscript><link rel="stylesheet" href="css/noscript.css"
                    type="text/css" /></noscript>
    <noscript><link rel="stylesheet" href="css/noscript.css"
                    type="text/css" /></noscript>

    <?php include('../shared/google_analytics_head_end.php') ?>

</head>

<noscript><link rel="stylesheet" href="css/noscript.css" type="text/css" /></noscript>


<body>
    <?php require_once '../../shared/facebook_connect.php'; ?>
    <?php include('../shared/clicktale_body_start.php') ?>

    <div id="header">
        <div class="container">
            <div id="logo"> 
                <a href="http://www.page2site.com" target="_blank"><img src="../shared/images/logo-transparent-150px.png" alt="Page2site logo" height="70"/></a>
            </div>
            <div id="topcontacts"> <br/>Email Us: <span><a href="mailto:info@page2site.com" style="color:#a3238e">info@page2site.com</a></span> </div>
        </div>
    </div>
    <div class="container">
        <div id="content" class="clearfix">
            <div id="offer">
                <h1 style="line-height:1.2em;">Turn the content of your Facebook page <br/>
                    into a <span style="color:#a3238e">FREE</span> website with <span style="color:#a3238e">just 1 click!</span></h1>
                <div id="offerleft">
                    <p class="describe">Do you have a Facebook page?<br/>
                        Get a beautiful, professional website <span style="color:#a3238e;font-size:bold">with 1 click</span>, <br/>
                        without investing in graphics, programming or content writing.</p>
                    <br>
                    <p class="center" style="font-size:1.8em;">1-click and free.</p>
                    <p class="center"><a id="facebook_connect_main_button" href="#" class="facebook_connect action ntip track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="facebook_connect_main_button" data-ajax-track=1 title="" style="color:#a3238e"><?php echo $main_button_text ?></a></p>
                    <br/><br/>
                    <div class="dots"></div>
                    <p class="cufonfont">You get:
                    <ul class="cufonfont">
                        <li style="color:#a3238e"> Professionally designed website</li>
                        <li> Automatically updated with content from your Facebook page</li>
                        <li style="color:#a3238e"> Ability to add pages, widgets and marketing tools</li>
                        <li> Free hosting</li>
                    </ul>
                    </p>
                </div>
                <div id="offerright">
                    <div id="offerstatic" class="center"> 
                            <!-- <iframe src="http://player.vimeo.com/video/7449107" frameborder="0" height="290" width="420"></iframe>  -->
                            <!-- <img src="images/Depositphotos_3340512_xs.jpg" alt="Page2site" style="margin-left: 40px;margin-top: -22px;width: 365px;" /> -->
                        <?php echo $main_image_tag; ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
            <div id="copyrights"> <a href="http://www.page2site.com" target="_blank">Page2site</a> © 2013</div>
            <?php if (false): ?>
                <ul id="fsocial">
                    <li><a href="http://www.facebook.com/page2site" class="ntip" title="Facebook"><img src="images/icons/facebook.png" alt="Facebook"></a></li>
                    <li><a href="https://twitter.com/page2site" class="ntip" title="Twitter"><img src="images/icons/twitter.png" alt="Twitter"></a></li>
                    <li><a href="mailto:info@page2site.com" class="ntip" title="Email Subscription"><img src="images/icons/email.png" alt="Email Subscription"></a></li>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <?php //include('../shared/uservoice_body_end.php') ?>
    <?php include('../shared/google_analytics_body_end.php') ?>    
    <?php include('../shared/clicktale_body_end.php') ?>    
</body></html>