<?php
$campaign_id = 'clickr';
$main_image_options = array(
    '<img src="../options_images/Depositphotos_4876746_xs.jpg" alt="Page2site" id="main_image" style="margin-top:0px">',
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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="shortcut icon" href="../shared/images/favicon.png" />

        <style>
            .center {text-align:center;margin-right:auto;margin-left:auto;}
            #main_image {border: 6px solid white;max-width: 94%;box-shadow: 1px 1px 11px #aaa;}
        </style>
        <title>Page2site</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/PT_Sans.font.js"></script> 
        <script type="text/javascript">
            Cufon.replace('h2');       
        </script>

<?php include('../shared/google_analytics_head_end.php') ?>

        <!-- fancybox js/css start -->
        <link rel="stylesheet" type="text/css" href="../shared/css/fancybox/jquery.fancybox.css" />
        <script type="text/javascript" src="../shared/js/jquery.fancybox.js"></script>
        <!-- fancybox js/css end -->

        <script type="text/javascript">
			/*
        	$(document).ready(function(){
                $("#facebook_connect").live('click',function() {
                    $.fancybox.open({
                        href : '/facebook_connect_iframe.php',
                        type : 'iframe',
                        padding : 5,
                        width : 500,
                        minHeight : 350
                    });
            
                    return false;
                });
            });
            */
        </script>
    </head>
    <body>
    	<?php //include('../shared/clicktale_body_start.php')?>
    	<?php require_once '../../shared/facebook_connect.php'; ?>

        <div class="header">
        </div><!-- .header -->
        <div class="featured">
            <div class="half">
                <div class="center" style="margin-bottom:10px"><img src="../shared/images/logo-transparent-150px.png" alt="Page2site"></div>

                <h2 style="line-height:1.4em">Got a Facebook Page? <br/>Get a <span style="color:#a3238e">FREE</span> Website with <span style="color:#a3238e">just 1 click!</span></h2>
                <p>Turn the content of your Facebook page into a beautiful, professional website!<br/>
                    Establish your web presence with the posts, photos and videos you share on your professional or personal Facebook page.</p>
                    

                <h3 class="center">1-click and free!</h3>
                <p class="center"><a class="button facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="facebook_connect_main_button" data-ajax-track=1 href="#" id="facebook_connect_main_button"><?php echo $main_button_text ?></a></p>
                    
                You get:
                <ul>
                    <li> Professionally designed website</li>
                    <li> Automatically updated with content from your Facebook page</li>
                    <li> Ability to add pages, widgets and marketing tools</li>
                    <li> Free hosting</li>
                </ul>
            </div><!-- .half -->
            <div class="half center last" style="margin-top:40px">
<?php echo $main_image_tag; ?>
            </div><!-- .half last -->
        </div><!-- .featured -->
        <div class="primary">
            <div class="half notes">                
<?php if (false): ?>                
                    <ul class="social nofloat">
                        <li><a class="twitter" target="_blank" href="https://twitter.com/page2site" title="Twitter"></a></li>
                        <li><a class="facebook" target="_blank" href="http://www.facebook.com/page2site" title="Facebook"></a></li>
                    </ul>
<?php endif; ?>
                &copy; 2013 <a href="http://www.page2site.com" target="_blank">Page2site - Create a free website with just 1 click</a>.
            </div><!-- .notes -->
            <div class="half brand last">
                <img src="images/logo.png" alt="Page2site">
            </div><!-- .brand -->
        </div><!-- .primary -->

<?php //include('../shared/uservoice_body_end.php') ?>
        <?php include('../shared/google_analytics_body_end.php') ?>
        <?php //include('../shared/clicktale_body_end.php')?>   
    </body>
</html>