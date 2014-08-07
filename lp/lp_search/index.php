<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="../creative/script/jquery-1.10.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">window.jQuery || document.write('<script src="js/jquery-1.7.2.min.js"><\/script>');</script>

    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    <?php include('../search/head.php');?>
    
    <link  rel='stylesheet' type='text/css' href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

    <script src="js/jquery.tipsy.js" type="text/javascript"></script>
    <script src="js/bootstrap-modal.js" type="text/javascript"></script>
    <script src="js/search_filter.js" type="text/javascript"></script>

    <script type="text/javascript">
        category = 'LandingPage';
        event = 'View';
        label = currentUrl();
        _gaq.push(['_trackEvent', category, event, label, null, non_interaction = true]);
        p2sTrack(category, event, label);
        trackEvent(category, event, label, null, non_interaction = true);
    </script>


    <title>Page2Site</title>
	<link rel="shortcut icon" type="image/ico" href="/images/favicon.png" />

    <script type="text/javascript" src="script/index.js"></script>
    <script src="../creative/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="../creative/fancybox/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>
    <script type="text/javascript" src="../creative/fancybox/helpers/jquery.fancybox-buttons.js"></script>
    <script type="text/javascript" src="../creative/fancybox/helpers/jquery.fancybox-media.js"></script>
    <script src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>
    <script type="text/javascript" src="js/jquery.jsonp-2.4.0.min.js"></script>
    <link href="./style/index.css" type="text/css" rel="stylesheet">
    <link href="../creative/fancybox/jquery.fancybox.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../creative/fancybox/helpers/jquery.fancybox-buttons.css">

    <style type="text/css">
        a.facebook_connect {width: 100%; height: 100%;display: inline-block;text-decoration: none}
        .button1 a{text-indent: -9999px;}
        a.facebook_connect .fbws-caption{color: #000000}

        .copright {text-align: left;margin-left:0px;}
        .copright p {text-align: right;margin-top: 15px;font-size: .85em;}
        .footerpartrow2.footerpartrow-last {background: none;}
        .panel6 {height: inherit;}
        .sliderslogan {line-height: 1.1em;font-size:40px;}
        .slidercont {margin-top:0px;margin-bottom: 25px;}
        #form_div{margin-top:25px;float:right;}
        .videobg {margin-top: 40px;}
    </style>
    <!-- START fancybox -->
<script type="text/javascript">
    $.noConflict();
    jQuery(document).ready(function ($) {
        $('.fancybox').fancybox();
    });

    /*YOUTUBE video callback*/
    var tag = document.createElement('script');
    tag.src = "//www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('youtube_player', {
            height: '300',
            width: '483',
            videoId: 'c9HlSITDejc',
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerStateChange(event) {
        if(event.data == YT.PlayerState.PLAYING) {
            p2sTrack('Pricing', 'Video', '', 'played');
            trackEvent('Pricing', 'Video','', 'played');
        } else if (event.data == YT.PlayerState.PAUSED) {
            var elapsed_time = player.getCurrentTime();
            p2sTrack('Pricing', 'Video', elapsed_time + ' sec', 'paused');
            trackEvent('Pricing', 'Video', elapsed_time + ' sec', 'paused');
        }
    }
</script>

</head>
<body class="tb">
        <?php //require_once '../../shared/facebook_connect.php'; ?>
        <div class="clear"></div>
    <div class="newcotainer">

    <div class="slidercont">
        <div class="sliderslogan">
            <div style="font-size:.7em">You already created the best website. You just didn’t know.</div>

            <div style="margin-top:10px">
                See how your <span>Facebook page</span> turns into <span>a beautiful website</span> in seconds.
            </div>
        </div>
        <div class="clear"></div>

        <div id="form_div">
            <form id="preview-form" class="preview-form form-inline" action="<?php echo FULL_PATH?>sites/add/" method="get">
                <div class="form-group">
                    <label class="sr-only" type="text" for="exampleInputEmail2">Search for your Facebook fan page:</label>
                    <input id="form_name" name="u" class="field form_url form-control" type="input"
                           class="form-control" placeholder="Search for your Facebook fan page..."
                           required autofocus style="width: 480px;">
                    <input type="hidden" name="newsite" value="1">
                    <input type="hidden" name="visitor_type" value="visitor">
                </div>
                <!--
                <button type="submit" class="btn btn-default">View Your Site</button>
                -->
            </form>
            <div id="search-wrapper" class="tb"></div>

            <div style="margin-top: 5px;text-align: center;">Free to try - No changes will be made to your page</div>
        </div>
    </div>

    <div class=" body-cont">
        <div class="iconcontent">
            <section class="q-block"><img src="./images/fresh.png" alt="Fresh">
                <h3>FRESH</h3>
                Your site will be automatically updated from your Facebook page
            </section>

            <section class="q-block"><img src="./images/fast.png" alt="Fast">
                <h3>FAST</h3>
                Get a beautiful working website ready to launch in seconds
            </section>

            <section class="q-block"><img src="./images/beautiful.png" alt="Beautiful">
                <h3>BEAUTIFUL</h3>
                Enjoy templates designed by top professionals. You can also change your
                template with just 1 click!
            </section>

            <section class="q-block"><img src="./images/social.png" alt="Social">
                <h3>SOCIAL</h3>
                Show your content from Facebook, Twitter, LinkedIn, Picasa, Flickr more
            </section>
        </div>


        <div class="body-heading"><h2> Over 50,000 sites created using <span>Page2site</span></h2></div>

        <div class="samplecont">
            <section class="e-block"><a target="_blank" href="http://griyaspreiandfashions.com/sites/store"> <img
                        src="./images/page2site_griya_store.jpg" alt="Griya Sprei &amp; Fashion">

                    <h3>Griya Sprei &amp; Fashion</h3>
                </a></section>
            <section class="e-block"><a target="_blank" href="http://coachingdevidahn.com/sites/blog"> <img
                        src="./images/page2site_coaching_de_vida_blog.jpg" alt="Coaching de vida Honduras">

                    <h3>COACHING DE VIDA</h3>
                </a></section>
            <section class="e-block"><a target="_blank" href="http://sklcosmetiques973.com/sites/portfolio"> <img
                        src="./images/page2site_sklcosmetics_photos.jpg" alt="SKL Conseils ">

                    <h3>SKL Conseils</h3>
                </a></section>

        </div>

        <div class="videobg">
            <div class="videoslogan">
                See the story of Jessica<br/>
                and learn how you too can get a <span>professional website</span> in seconds
            </div>

            <div class="videobg2">
                <div class="videocont" id="youtube_player"><img src="images/videoimg.jpg" width="483" height="300" alt=""></div>
            </div>
        </div>


        <div class="testimonialcont">
            <article class="panel6" style="margin-left:0px;">
                <h2>Testimonials</h2>

                <section class="testimonials">
                    <section class="testimonial " style="display: block;">
                        <div class="testimonial-thumb">
                            <div class="t-icon"><img src="./images/user-sonia-robinson.png" alt="Testimonial"></div>
                            <div class="t-statement">I was surprised by how easy it was to create and customize the website.
                                After weeks of putting off building a site, I finally have one that works and looks great.
                            </div>
                            <div class="t-author">
                                <p>- Sonia Robinson, USA </p>
                                <a href="http://robinsoninvestmentfirm.page2site.com/" data-ga-category="LandingPage" data-ga-event="Testimonial" data-ga-label="First URL" data-ga-value="click" data-ajax-track="1" class="website track_event">http://robinsoninvestmentfirm.page2site.com/</a>
                            </div>
                        </div>

                        <div class="testimonialspe"></div>

                        <div class="testimonial-thumb">
                            <div class="t-icon"><img src="./images/user-karl-loupec.png" alt="Testimonial"></div>
                            <div class="t-statement">I would like to thank the Page2site team for their great service and
                                their extraordinary patience. Thanks to them, my site looks even better than I envisioned it
                                and I had 3 new customers asking for a price proposal in the first week alone!
                            </div>
                            <div class="t-author">
                                <p>- Karl Loupec, France </p>
                                <a target="_blank" href="http://sklcosmetiques973.com" data-ga-category="LandingPage" data-ga-event="Testimonial" data-ga-label="Second URL" data-ga-value="click" data-ajax-track="1" class="website track_event">http://sklcosmetiques973.com</a>
                            </div>
                        </div>

                        <div class="clear"></div>
                    </section>
                </section>
                <div class="clear"></div>
            </article>
        </div>

    </div>


    </div>

    <div class="clear"></div>


<!-- panel3 -->


    <div class="clear"></div>
    <article class="panel4 left panel8">
        <h2> Frequently Asked Questions </h2>


        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            How much does it cost?
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        The site Page2site creates for you is totally free and yours to use. We have Premium paid plans that give you a professional .com domain,
                        email addresses and other awesome features like an online store.<br>
                        Check out our <a target="_blank" href="http://builder.page2site.com/pricing">premium plans</a> to learn more.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Will my site update automatically when I update my Facebook page?
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse">
                    <div class="panel-body">
                        Yes! The great thing about your new website is that you don't need to do anything new to keep it updated.
                        Keep posting on Facebook - your site will update automatically with your new content.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            Will creating a site change my Facebook page?
                        </a>
                    </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse">
                    <div class="panel-body">
                        Page2site works only one way: From Facebook to your website. We will never make any changes to your page, or
                        post anything on your page, without asking your approval every time. Regardless, It is highly recommended to
                        share your new site on Facebook and on any other network to give it a good head start.<br>
                        Feel free to visit our <a target="_blank" href="http://localhost/faq">FAQ</a> for more information, or <a
                            href="mailto:support@page2site.com">contact support</a>.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Is my private information protected?
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        Page2site uses public information from Facebook to create your website.
                        Only page admins can edit and save the site.
                        You can learn more from our <a target="_blank" href="http://localhost/faq">Frequently Asked Questions</a>, or by directly <a
                            href="mailto:support@page2site.com">contacting our support</a>.
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </article>

    <footer>
        <div class="newcotainer">
            <div class="footerpart1">
                <div class="footerpart1-heading">Contact Us:</div>
                <div class="footerpartrow2">
                    <div class="innfooter"> Phone. (+) 972-50-4006203<br/>
                        Fax. (+) 972-3-5700386<br/>
                        Email. support@page2site.com
                    </div>

                    <div class="footerpart1-heading">Contact Us:</div>

                    <div class="innfooter">
                        <a data-ajax-track="1" data-ga-value="click" data-ga-label="Facebook" data-ga-event="Social" data-ga-category="Landingpage" href="http://www.facebook.com/page2site" target="_blank" class="track_event social">
                            <img src="images/facebook.png" width="44" height="44" alt="">
                        </a>
                        <a data-ajax-track="1" data-ga-value="click" data-ga-label="Twitter" data-ga-event="Social" data-ga-category="Landingpage" href="http://twitter.com/page2site" target="_blank" class="track_event social">
                            <img src="images/twitter.png" width="44" height="44" alt="">
                        </a>
                        <a data-ajax-track="1" data-ga-value="click" data-ga-label="Linkedin" data-ga-event="Social" data-ga-category="Landingpage" href="http://linkedin.com/page2site" target="_blank" class="track_event social">
                            <img src="images/linkedin.png" width="44" height="44" alt="">
                        </a>
                        <a data-ajax-track="1" data-ga-value="click" data-ga-label="GooglePlus" data-ga-event="Social" data-ga-category="Landingpage" href="https://plus.google.com/108108963350439707993" target="_blank" class="track_event social">
                            <img src="images/gplus.png" width="44" height="44" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <div class="footerpart2">
                <div class="footerpart1-heading footerpart1-heading2">Main Info:</div>
                <div class="footerpartrow2 footerpartrow-last">
                    <div class="innfooter">
                        <ul>
                            <li><a href="http://www.page2site.com/about/">About</a></li>
                            <li><a href="http://www.page2site.com/FAQ/">FAQ</a></li>
                            <li><a href="http://www.page2site.com/blog/">Blog</a></li>
                            <li><a href="http://www.page2site.com/features/">Features</a></li>
                            <li><a href="http://builder.page2site.com/pricing/reason:from_main_website">Pricing</a></li>
                        </ul>
                    </div>
                </div>


            </div>
            <div class="copright"> Promote your business, showcase your art, set up an online shop or just test out new
                ideas. page2site has everything you need to build a fully-personalized, high-quality free website. Browse
                our collection of beautiful website templates. You'll find loads of stunning designs, ready to be
                customized.

                <p>Copyright © 2013-2014 Page2Site. All rights reserved</p>
            </div>
        </div>
    </footer>

    <?php require_once('../../shared/shared_code_closing_body_tag.php');?>
</body>
</html>
