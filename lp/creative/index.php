<!DOCTYPE HTML>
<html>
	<head>
        <!-- <script src="//cdn.optimizely.com/js/326727683.js"></script> -->
        <script src="//wwwstatic.verisites.com/lp/creative/script/jquery-1.10.1.min.js" type="text/javascript"></script>
        <?php include_once('../../shared/v1/shared_code_head.php');?>

        <script type="text/javascript">
            try {
                category = 'LandingPage'; event = 'View'; label = currentUrl();
                p2sTrack(category, event, label);
                trackEvent(category, event, label, null, non_interaction = true);

                jQuery(document).ready(function($) {
                    // Track time since the page is loaded in the P2S database
                    var time_counter = 0;
                    var next_record_time = 1;
                    p2sTrack('LandingPage', 'Page Loaded', '0 seconds');

                    var page_loaded_interval_func = setInterval(function() {
                        time_counter++;
                        if(time_counter >= next_record_time) {
                            next_record_time *= 2;
                            p2sTrack('LandingPage', 'Page Loaded', ''+time_counter+' seconds');
                        }
                    }, 1000);
                });

            } catch(e) {
                console.log('Error recording LandingPage.View');
                p2sTrack('LandingPage', 'Error', 'Error recording LandingPage.View');
            }
        </script>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title>Page2Site</title>

        <script src="//wwwstatic.verisites.com/lp/creative/script/index.js" type="text/javascript"></script>
        <script src="//wwwstatic.verisites.com/lp/creative/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="//wwwstatic.verisites.com/lp/creative/fancybox/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>
        <script type="text/javascript" src="//wwwstatic.verisites.com/lp/creative/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="//wwwstatic.verisites.com/lp/creative/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

        <link href="//wwwstatic.verisites.com/lp/creative/style/index.css?v=1.0.2" type="text/css" rel="stylesheet" />
        <link href="//wwwstatic.verisites.com/lp/creative/fancybox/jquery.fancybox.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="//wwwstatic.verisites.com/lp/creative/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
        <style type="text/css">
        a.facebook_connect {width: 100%; height: 100%;display: inline-block;text-decoration: none}
        /*.button1 {height: 76px; width: 344px;}*/
        .button1 a{text-indent: -9999px;}
        </style>

        <!-- START fancybox -->
        <script type='text/javascript'>
	        jQuery(document).ready(function($) {
	        	$('.fancybox-media')
					.attr('rel', 'media-gallery')
					.fancybox({
						openEffect : 'none',
						closeEffect : 'none',
						prevEffect : 'none',
						nextEffect : 'none',

						arrows : false,
						helpers : {
							media : {},
							buttons : {}
						},
                            afterLoad : function(param){
                                //trackEvent('LandingPage', 'Watch_video', 'Youtube_c9HlSITDejc');
                                //trackPageView('watch_video');
                            }
					});
	        });
	    </script>
        <!-- END fancybox -->
    </head>
<body>
	<?php require_once '../../shared/facebook_connect.php'; ?>

    <header>
        <section class="h-block">
            <img src="//wwwstatic.verisites.com/lp/creative/images/logo.jpg" alt="Page2Site"/>

            <nav>
                <ul class="menu">
                    <li><a target="_blank" href="http://builder.page2site.com/users/login/" class="track_event" data-ga-category="LandingPage" data-ga-event="Login" data-ga-label="Location.Topbar" data-ajax-track="1">LOGIN</a></li>
                    <li class="extra"><a href="/shared/facebook_login.php" id="Topbar_button" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="Topbar_button" data-ajax-track="1">CREATE WEBSITE</a></li>
                </ul>
            </nav>
        </section>
    </header>

	<article class="panel1">
		<h3>
			<br />Turn your <b>FACEBOOK</b> page into<br />a beautiful <b>WEBSITE</b>
			with just <b>1 CLICK</b>
		</h3>

		<div class="button1"><a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="main_button" data-ajax-track="1"  id="main_button">Connect</a></div>

        <div class="watch_video">
            <a href="http://youtu.be/c9HlSITDejc" class="fancybox-media track_event" rel="media-gallery" style="font-size: 17px;" data-ga-category="LandingPage" data-ga-event="Watch Video" data-ga-label="http://youtu.be/c9HlSITDejc" data-ajax-track="1">
                <img src="//wwwstatic.verisites.com/lp/creative/images/play.png" style="vertical-align: middle;margin-right: 5px;margin-top: -3px;">Watch Video
            </a>
        </div>

        <div class="fbws-block">
            <a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="step1_button" id="step1_button" data-ajax-track="1" >
			<img src="//wwwstatic.verisites.com/lp/creative/images/connect.png" alt="Connect with Facebook" />

			<div class="fbws-caption">
				Connect<br />with Facebook
			</div>
            </a>
		</div>
		<div class="fbws-arrow">
			<img src="//wwwstatic.verisites.com/lp/creative/images/cse-arrow.png" alt="arrow" />
		</div>
        <div class="fbws-block">
            <a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="step2_button" id="step2_button" data-ajax-track="1" >
			<img src="//wwwstatic.verisites.com/lp/creative/images/select.png" alt="Select your Page" />

			<div class="fbws-caption">
				Select<br />your Page
			</div>
            </a>
		</div>
		<div class="fbws-arrow">
			<img src="//wwwstatic.verisites.com/lp/creative/images/cse-arrow.png" alt="arrow" />
		</div>
        <div class="fbws-block">
            <a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="step3_button" id="step3_button" data-ajax-track="1" >
			<img src="//wwwstatic.verisites.com/lp/creative/images/enjoy.png" alt="Enjoy your Website!" />

			<div class="fbws-caption">
				Enjoy<br />your Website!
			</div>
            </a>
		</div>
	</article>
	<!-- panel1 -->

	<article class="panel2">
		FREE <img src="//wwwstatic.verisites.com/lp/creative/images/freebie.png" alt="Free" /> Automatic updates
		from Facebook <img src="//wwwstatic.verisites.com/lp/creative/images/freebie.png" alt="Free" /> Full website
		with content, photos, videos
	</article>
	<!-- panel2 -->

	<article class="panel3">
		<div class="question">What will Page2Site do to my Facebook page?</div>
		Page2site does not change anything on your Facebook page. It only
		reads the contents of your fan page. We will never use your
		information for anything else.
	</article>
	<!-- panel3 -->

	<div class="clear"></div>
	<article class="panel4">
		<section class="q-block">
			<img src="//wwwstatic.verisites.com/lp/creative/images/fresh.png" alt="Fresh" />

			<h3>FRESH</h3>
			Your site will be automatically updated from your Facebook page. Just
			keep posting your posts, photos and videos on Facebook and your
			website will always be fresh and up-to-date
		</section>

		<section class="q-block">
			<img src="//wwwstatic.verisites.com/lp/creative/images/fast.png" alt="Fast" />

			<h3>FAST</h3>
			Get a beautiful working website ready to launch in seconds. Don't
			waste time writing once again about who you are and what you do, just
			connect your Facebook page, and you've got a brand new site
		</section>

		<section class="q-block">
			<img src="//wwwstatic.verisites.com/lp/creative/images/beautiful.png" alt="Beautiful" />

			<h3>BEAUTIFUL</h3>
			We've got over 30 templates designed by top professionals to make
			your content stand out. Feel like a fresh look? you can change your
			template with just 1 click – all your content will be automatically
			transferred
		</section>

        <section class="q-block">
			<img src="//wwwstatic.verisites.com/lp/creative/images/social.png" alt="Social" />

			<h3>SOCIAL</h3>
			Present all your social activity on a single site. Add social
			accounts to your site to create a central focal point for displaying
			your interactions on Facebook, Twitter, LinkedIn, Picasa, Flickr,
			Pinterest and more
		</section>

        <div class="clear"></div>
        <div class="button1 center" style="margin-top:40px;">
            <a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="big_button_below_features" data-ajax-track="1"  id="big_button_below_features">
                Facebook Connect
            </a>
        </div>
	</article>
	<!-- panel4 -->

	<article class="panel5">
		<h2>Over 10,000 sites created using Page2site</h2>

        <section class="e-block">
			<a target="_blank" href="http://griyaspreiandfashions.com/sites/store">
			<img src="//wwwstatic.verisites.com/lp/creative/images/page2site_griya_store.jpg" alt="Griya Sprei & Fashion" />

			<h3>Griya Sprei & Fashion</h3>
			</a>
		</section>

		<section class="e-block">
			<a target="_blank" href="http://coachingdevidahn.com/sites/blog">
			<img src="//wwwstatic.verisites.com/lp/creative/images/page2site_coaching_de_vida_blog.jpg" alt="Coaching de vida Honduras" />

			<h3>COACHING DE VIDA</h3>
			</a>
		</section>

        <section class="e-block">
			<a target="_blank" href="http://sklcosmetiques973.com/sites/portfolio">
			<img src="//wwwstatic.verisites.com/lp/creative/images/page2site_sklcosmetics_photos.jpg" alt="SKL Conseils " />

			<h3>SKL Conseils</h3>
			</a>
		</section>
		<div class="clear"></div>
	</article>
	<!-- article5 -->

	<div class="clear"></div>
	<article class="panel6">
		<div class="arrows">
			<img src="//wwwstatic.verisites.com/lp/creative/images/l-arrow-d.png" alt="Left Arrow" /><img src="//wwwstatic.verisites.com/lp/creative/images/r-arrow-e.png" alt="Right Arrow" />
		</div>
		<h2>Testimonials</h2>

		<section class="testimonials">
			<section class="testimonial">
				<div class="t-icon">
					<img src="//wwwstatic.verisites.com/lp/creative/images/user-sonia-robinson.png" alt="Testimonial" />
				</div>
				<div class="t-statement">I was surprised by how easy it was to create and customize the website. After years of putting off building a site, I finally have one that works and looks great.</div>
				<div class="t-author"><p>- Sonia Robinson, USA </p><a href="http://robinsoninvestmentfirm.page2site.com/" class="website">http://robinsoninvestmentfirm.page2site.com/</a></div>
			</section>
			<section class="testimonial">
				<div class="t-icon">
					<img src="//wwwstatic.verisites.com/lp/creative/images/user-karl-loupec.png" alt="Testimonial" />
				</div>
				<div class="t-statement">I would like to thank the Page2site team for their great service and their extraordinary patience. Thanks to them, my site looks even better than I envisioned it and I had 3 new customers asking for a price proposal in the first week alone!</div>
				<div class="t-author"><p>- Karl Loupec, France </p><a href="http://sklcosmetiques973.com" class="website">http://sklcosmetiques973.com</a></div>
			</section>
		</section>
        <div class="clear"></div>
    </article>
    <div class="clear"></div>
    <div class="button1 center" style="margin-top:40px;">
        <a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="big_button_below_testimonials" data-ajax-track="1"  id="big_button_below_testimonials">
            Facebook Connect
        </a>
    </div>
	<!-- panel6 -->

	<div class="clear"></div>
	<article class="panel7">
		<h2>
			5 Beautiful Templates <span class="ex-text">You can change your site's
				appearance in <b>1 click</b>
			</span>
		</h2>

		<section class="carousel">
			<div class="l-arrow">
				<img src="//wwwstatic.verisites.com/lp/creative/images/l-arrow-e.png" alt="Left Arrow" />
			</div>
			<div class="c-box">
				<div class="c-block">
					<img src="//wwwstatic.verisites.com/lp/creative/images/sensation.png" alt="Sensation" />
					<h3>SENSATION</h3>
					<!-- <div class="c-button">Create a site with this template</div> -->
				</div>
				<div class="c-block">
					<img src="//wwwstatic.verisites.com/lp/creative/images/beulah.jpg" alt="Beulah" />
					<h3>BEULAH</h3>
					<!-- <div class="c-button">Create a site with this template</div> -->
				</div>
				<div class="c-block">
					<img src="//wwwstatic.verisites.com/lp/creative/images/half-tone.jpg" alt="Half Tone" />
					<h3>HALF TONE</h3>
					<!-- <div class="c-button">Create a site with this template</div> -->
				</div>
				<div class="c-block">
					<img src="//wwwstatic.verisites.com/lp/creative/images/nova.jpg" alt="Half Tone" />
					<h3>NOVA</h3>
					<!-- <div class="c-button">Create a site with this template</div> -->
				</div>
				<div class="c-block">
					<img src="//wwwstatic.verisites.com/lp/creative/images/muro.jpg" alt="Half Tone" />
					<h3>MURO</h3>
					<!-- <div class="c-button">Create a site with this template</div> -->
				</div>
			</div>
			<!-- c-box -->
			<div class="r-arrow">
				<img src="//wwwstatic.verisites.com/lp/creative/images/r-arrow-d.png" alt="Right Arrow" />
			</div>
		</section>
	</article>
	<!-- panel7 -->
	<div class="clear"></div>


	<article class="panel4 left panel8">
		<h2>
			Frequently Asked Questions
		</h2>
		<section class="q-block double">
			<h3>Is it really free?</h3>
			Yes, the site you create with us is totally free and yours to use. We have paid plans for users who prefer a site without our ads, who want their own domain, or that need awesome features like an online store.<br/>
Feel free to visit our <a target="_blank" href="/faq">FAQ</a> for more information, or <a href="mailto:support@page2site.com">contact support</a>.
<br/><br/>
			<h3>How is my private information protected?</h3>
Page2site uses public information from you profile to create your website and to make you the only person that can edit the site and make changes. We will never use this information for any other purpose without your consent. <br/>
Feel free to visit our <a target="_blank" href="/privacy">privacy policy</a> or <a target="_blank" href="/faq">FAQ</a> for more information, or <a href="mailto:support@page2site.com">contact support</a>.
		</section>

		<section class="q-block double">
			<h3>Will my site update automatically when I update Facebook?</h3>
That's an absolute yes. The great thing about your new website is that all you need to do to keep it updated is the same you did before - keep posting interesting content to your Facebook page.<br/>
Feel free to visit our <a target="_blank" href="/faq">FAQ</a> for more information, or <a href="mailto:support@page2site.com">contact support</a>.
<br/><br/>
			<h3>Will my site change my Facebook page?</h3>
Page2site works only one way: From Facebook to your website. We will never make any changes to your page, or post anything on your page, without asking your approval every time. Regardless, It is highly recommended to share your new site on Facebook and on any other network to give it a good head start.<br/>
Feel free to visit our <a target="_blank" href="/faq">FAQ</a> for more information, or <a href="mailto:support@page2site.com">contact support</a>.
		</section>
        <div class="clear"></div>
        <div class="button1 center" style="margin-top:40px;">
            <a href="/shared/facebook_login.php" class="facebook_connect track_event measure_time" data-ga-category="LandingPage" data-ga-event="Connect with Facebook" data-ga-label="big_button_below_faq" data-ajax-track="1"  id="big_button_below_faq">
                Facebook Connect
            </a>
        </div>
	</article>
	<br />
	<br />
	<br />

    <?php require_once('../../shared/v1/shared_code_closing_body_tag.php');?>
</body>
</html>
