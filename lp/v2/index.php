<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="../creative/script/jquery-1.10.1.min.js" type="text/javascript"></script>
    <?php include_once('../../shared/shared_code_head.php');?>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>


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

    <link href="./style/index.css" type="text/css" rel="stylesheet">
    <link href="../creative/fancybox/jquery.fancybox.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../creative/fancybox/helpers/jquery.fancybox-buttons.css">

    <style type="text/css">
        a.facebook_connect {width: 100%; height: 100%;display: inline-block;text-decoration: none}
        .button1 a{text-indent: -9999px;}
        a.facebook_connect .fbws-caption{color: #000000}
    </style>
    <!-- START fancybox -->
<script type="text/javascript">
    $(document).ready(function () {
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
<body>
        <?php require_once '../../shared/facebook_connect.php'; ?>
        <div class="clear"></div>
    <div class="newcotainer">

    <div id="inline1" style="width:400px;display: none;">
        <h3>Etiam quis mi eu elit</h3>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis mi eu elit tempor facilisis id et neque.
            Nulla sit amet sem sapien. Vestibulum imperdiet porta ante ac ornare. Nulla et lorem eu nibh adipiscing
            ultricies nec at lacus. Cras laoreet ultricies sem, at blandit mi eleifend aliquam. Nunc enim ipsum, vehicula
            non pretium varius, cursus ac tortor. Vivamus fringilla congue laoreet. Quisque ultrices sodales orci, quis
            rhoncus justo auctor in. Phasellus dui eros, bibendum eu feugiat ornare, faucibus eu mi. Nunc aliquet tempus
            sem, id aliquam diam varius ac. Maecenas nisl nunc, molestie vitae eleifend vel, iaculis sed magna. Aenean
            tempus lacus vitae orci posuere porttitor eget non felis. Donec lectus elit, aliquam nec eleifend sit amet,
            vestibulum sed nunc.
        </p>
    </div>

    <div class="logo"><a href="#"><img src="images/logo.png" width="154" height="85" alt=""></a></div>

    <div class="rightlinks">

        <div class="login"><a target="_blank" href="http://builder.page2site.com/users/login/" class="track_event" data-ga-category="LandingPage" data-ga-event="Login" data-ga-label="Location.Topbar" data-ajax-track="1">Login</a></div>

        <div class="creatacc"><a href="/shared/facebook_login.php" id="Topbar_button" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="Topbar_button" data-ajax-track="1">CREATE WEBSITE </a></div>

    </div>

    <div class="slidercont">


        <div class="sliderslogan">

            With <span> Page2site</span> I got <br/>
            A free website for my business!

        </div>

        <div class="bottoncont">

            <a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="main_button" data-ajax-track="1" id="main_button"><img src="images/create-btn.png" width="458" height="105" alt=""></a>

        </div>

    </div>


    <div class=" body-cont">

        <div class="body-heading"><h2> Over 10,000 sites created using <span>Page2site</span></h2></div>

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


        <div class="tempcont">
            <div class="sampletemp-heading"><h1> 30 Beautiful Templates </h1>
                <span> <em>You can change your site's appearance in click</em></span>
            </div>
            <section class="carousel">
                <div class="l-arrow"><img src="./images/l-arrow-e.png" alt="Left Arrow"></div>
                <div class="c-box">
                    <div class="c-block" style="left: 0px;"><img src="./images/sensation.png" alt="Sensation">

                        <h3>SENSATION</h3>
                        <!-- <div class="c-button">Create a site with this template</div> -->
                    </div>
                    <div class="c-block" style="left: 310px;"><img src="./images/beulah.jpg" alt="Beulah">

                        <h3>BEULAH</h3>
                        <!-- <div class="c-button">Create a site with this template</div> -->
                    </div>
                    <div class="c-block" style="left: 620px;"><img src="./images/half-tone.jpg" alt="Half Tone">

                        <h3>HALF TONE</h3>
                        <!-- <div class="c-button">Create a site with this template</div> -->
                    </div>
                    <div class="c-block" style="left: 930px;"><img src="./images/nova.jpg" alt="Half Tone">

                        <h3>NOVA</h3>
                        <!-- <div class="c-button">Create a site with this template</div> -->
                    </div>
                    <div class="c-block" style="left: 1240px;"><img src="./images/muro.jpg" alt="Half Tone">

                        <h3>MURO</h3>
                        <!-- <div class="c-button">Create a site with this template</div> -->
                    </div>
                </div>
                <!-- c-box -->
                <div class="r-arrow"><img src="./images/r-arrow-d.png" alt="Right Arrow"></div>
            </section>
        </div>


        <div class="create-website"><a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="big_button_below_templates" data-ajax-track="1"  id="big_button_below_templates"><img src="images/create-btn2.png" width="400" height="108" alt=""></a></div>

        <div class="videobg">

            <div class="videoslogan">
                See the story of Jessica
                and realize your potential
                with <span>Page2site</span>

            </div>


            <div class="videobg2">

                <div class="videocont" id="youtube_player"><img src="images/videoimg.jpg" width="483" height="300" alt=""></div>


            </div>


        </div>


        <div class="iconcontent">
            <section class="q-block"><img src="./images/fresh.png" alt="Fresh">

                <h3>FRESH</h3>
                Your site will be automatically updated from your Facebook page. Just
                keep posting your posts, photos and videos on Facebook and your
                website will always be fresh and up-to-date
            </section>
            <section class="q-block"><img src="./images/fast.png" alt="Fast">

                <h3>FAST</h3>
                Get a beautiful working website ready to launch in seconds. Don't
                waste time writing once again about who you are and what you do, just
                connect your Facebook page, and you've got a brand new site
            </section>
            <section class="q-block"><img src="./images/beautiful.png" alt="Beautiful">

                <h3>BEAUTIFUL</h3>
                We've got over 30 templates designed by top professionals to make
                your content stand out. Feel like a fresh look? you can change your
                template with just 1 click – all your content will be automatically
                transferred
            </section>
            <section class="q-block"><img src="./images/social.png" alt="Social">

                <h3>SOCIAL</h3>
                Present all your social activity on a single site. Add social
                accounts to your site to create a central focal point for displaying
                your interactions on Facebook, Twitter, LinkedIn, Picasa, Flickr,
                Pinterest and more
            </section>
        </div>


        <div class="testimonialcont">
            <article class="panel6" style="margin-left:0px;">
                <h2>Testimonials</h2>

                <section class="testimonials">
                    <section class="testimonial " style="display: block;">
                        <div class="testimonial-thumb">

                            <div class="t-icon"><img src="./images/user-sonia-robinson.png" alt="Testimonial"></div>
                            <div class="t-statement">I was surprised by how easy it was to create and customize the website.
                                After years of putting off building a site, I finally have one that works and looks great.
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


                    </section>
                </section>
                <div class="clear"></div>
            </article>
        </div>


        <div class="create-website"><a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="big_button_below_testimonials" data-ajax-track="1" id="big_button_below_testimonials"><img src="images/create-btn2.png" width="400" height="108" alt=""></a></div>

    </div>


    </div>

    <div class="clear"></div>


<!-- panel3 -->


    <div class="clear"></div>
    <article class="panel4 left panel8">
        <h2> Frequently Asked Questions </h2>
        <section class="q-block double">
            <h3>Is it really free?</h3>
            Yes, the site you create with us is totally free and yours to use. We have paid plans for users who prefer a
            site without our ads, who want their own domain, or that need awesome features like an online store.<br>
            Feel free to visit our <a target="_blank" href="http://localhost/faq">FAQ</a> for more information, or <a
                href="mailto:support@page2site.com">contact support</a>. <br>
            <br>

            <h3>How is my private information protected?</h3>
            Page2site uses public information from you profile to create your website and to make you the only person that
            can edit the site and make changes. We will never use this information for any other purpose without your
            consent. <br>
            Feel free to visit our <a target="_blank" href="http://localhost/privacy">privacy policy</a> or <a
                target="_blank" href="http://localhost/faq">FAQ</a> for more information, or <a
                href="mailto:support@page2site.com">contact support</a>.
        </section>
        <section class="q-block double">
            <h3>Will my site update automatically when I update Facebook?</h3>
            That's an absolute yes. The great thing about your new website is that all you need to do to keep it updated is
            the same you did before - keep posting interesting content to your Facebook page.<br>
            Feel free to visit our <a target="_blank" href="http://localhost/faq">FAQ</a> for more information, or <a
                href="mailto:support@page2site.com">contact support</a>. <br>
            <br>

            <h3>Will my site change my Facebook page?</h3>
            Page2site works only one way: From Facebook to your website. We will never make any changes to your page, or
            post anything on your page, without asking your approval every time. Regardless, It is highly recommended to
            share your new site on Facebook and on any other network to give it a good head start.<br>
            Feel free to visit our <a target="_blank" href="http://localhost/faq">FAQ</a> for more information, or <a
                href="mailto:support@page2site.com">contact support</a>.
        </section>
        <div class="clear"></div>
    </article>
    <br>
    <br>
    <br>
    <footer>

        <div class="newcotainer">

            <div class="footerpart1">

                <div class="footerpart1-heading">Contact Us:</div>

                <div class="footerpartrow2">


                    <div class="innfooter"> Phone. (+) 972-3-9679584<br/>
                        Fax. (+) 972-3-9679585<br/>
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

                <div class="footerpartrow2">


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