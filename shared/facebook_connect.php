<?php include_once 'facebook_connect_config.php'; ?>

<div id="fb-root"></div>

<script type="text/javascript">
    window.fbAsyncInit = function() {
        FB.init({ appId: FACEBOOK_APP_ID,status: true,cookie: true,xfbml: true});

        window.fbAsyncInit.fbLoaded.resolve();
        //checkConnectedWithFacebook();
    };

    window.fbAsyncInit.fbLoaded = jQuery.Deferred();

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js&appId="+FACEBOOK_APP_ID;
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<link rel="stylesheet" href="/shared/css/tb.bootstrap.css">
<link rel="stylesheet" href="/shared/css/style.admin_panel.css">


<div class="tb">
    <div id="publishModal" class="publish-modal modal fade step-modal-box in animateIn" role="dialog" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- ngInclude: templatePath -->
                <div class="">
                    <!-- Header -->
                    <div class="modal-header">
                        <iframe src="//www.facebook.com/plugins/facepile.php?href=https%3A%2F%2Fwww.facebook.com%2Fotonomic&amp;action&amp;width=530&amp;height=60&amp;max_rows=1&amp;colorscheme=dark&amp;size=medium&amp;show_count=true&amp;appId=575528525876858" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:530px; height:60px;" allowTransparency="true"></iframe>
                    </div>
                    <!-- Content -->
                    <div id="publish-modal" class="modal-body">
                        <h3>Show your new website to the world!</h3>
                        <p>To publish your website, we need to make sure you are the administrator of the Facebook business page. It's a quick and simple process.</p>
                        <p>Click below to show your new website to the world!</p>
                        <div class="modal-btns text-right">
                            <div id="close-btn" class="btn btn-default close-btn modal_close_btn" onClick="closeModalWindows()">
                                <img src="/shared/images/close_btn_x.png">It's not mine</div>
                            <div id="yes-btn" class="btn btn-success facebook_connect">
                                <img src="/shared/images/fb_ico.png">Yes, this page is mine</div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer">
                        <div class="pull-left">
                            <img class="footer-logo" src="/shared/images/footer_logo.png">
                        </div>
                        <div class="footer-text pull-left">
                            <p><strong>Otonomic</strong> will not use your personal Facebook data under any circumstances without your permission. We just need to confirm you own the page.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tb" id="main_content">
    <div id="facebook_fanpages">
        <div id="fbCancelModal" class="publish-modal modal fade step-modal-box in animateIn" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="">
                        <!-- Header -->
                        <div class="modal-header">
                            <iframe src="//www.facebook.com/plugins/facepile.php?href=https%3A%2F%2Fwww.facebook.com%2Fotonomic&amp;action&amp;width=530&amp;height=60&amp;max_rows=1&amp;colorscheme=dark&amp;size=medium&amp;show_count=true&amp;appId=575528525876858" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:530px; height:60px;" allowTransparency="true"></iframe>
                        </div>
                        <!-- Content -->
                        <div id="fbCancel-modal" class="modal-body">
                            <h3>We're sorry, but...</h3>
                            <p>In order to publish your website it's really important for us to verify that you are the owner of this Facebook page.</p>
                            <div class="modal-btns text-right">
                                <div id="close-btn" class="btn btn-default close-btn modal_close_btn">
                                    <img src="/shared/images/close_btn_x.png">It's not mine</div>
                                <div id="yes-btn" class="btn btn-success facebook_connect">
                                    <img src="/shared/images/fb_ico.png">Yes, this page is mine</div>
                            </div>
                        </div>
                        <!-- Footer -->
                        <div class="modal-footer">
                            <div class="pull-left">
                                <img class="footer-logo" src="/shared/images/footer_logo.png">
                            </div>
                            <div class="footer-text pull-left">
                                <p><strong>Otonomic</strong> will not use your personal Facebook data under any circumstances without your permission. We just need to confirm you own the page.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tb">
    <div id="fbManagePagesModal" class="publish-modal modal fade step-modal-box in animateIn" role="dialog" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="">
                    <!-- Header -->
                    <div class="modal-header">
                        <iframe src="//www.facebook.com/plugins/facepile.php?href=https%3A%2F%2Fwww.facebook.com%2Fotonomic&amp;action&amp;width=530&amp;height=60&amp;max_rows=1&amp;colorscheme=dark&amp;size=medium&amp;show_count=true&amp;appId=575528525876858" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:530px; height:60px;" allowTransparency="true"></iframe>
                    </div>
                    <!-- Content -->
                    <div id="fbCancel-modal" class="modal-body">
                        <h3>As we said before...</h3>
                        <p>In order to publish your website it's important to verify that you are the owner of this Facebook page.</p>
                        <p><strong>Don't worry!</strong> We won't misuse this privilege in any way.</p>
                        <div class="modal-btns text-right">
                            <div id="close-btn" class="btn btn-default close-btn modal_close_btn">
                                <img src="/shared/images/fb_no.png">Don't publish my site</div>
                            <div id="yes-btn" class="btn btn-success facebook_connect">
                                <img src="/shared/images/fb_yes.png">OK! Publish my site</div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer">
                        <div class="pull-left">
                            <img class="footer-logo" src="/shared/images/footer_logo.png">
                        </div>
                        <div class="footer-text pull-left">
                            <p><strong>Otonomic</strong> will not use your personal Facebook data under any circumstances without your permission. We just need to confirm you own the page.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tb">
    <div id="fbConnectedModal" class="publish-modal modal fade step-modal-box in animateIn" role="dialog" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- ngInclude: templatePath -->
                <div class="">
                    <!-- Header -->
                    <div class="modal-header">
                        <iframe src="//www.facebook.com/plugins/facepile.php?href=https%3A%2F%2Fwww.facebook.com%2Fotonomic&amp;action&amp;width=530&amp;height=60&amp;max_rows=1&amp;colorscheme=dark&amp;size=medium&amp;show_count=true&amp;appId=575528525876858" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:530px; height:60px;" allowTransparency="true"></iframe>
                    </div>
                    <!-- Content -->
                    <div id="fbConnected-modal" class="modal-body">
                        <h3>Congratulations!</h3>
                        <p>Your site is now saved and is available online.</p>
                        <p>Share it with your friends and start getting visitors!</p>
                        <div>
                            <ul>
                                <li>
                                    <!-- Google+ share -->
                                    <div class="g-plus" data-action="share" data-href="http://otonomic.com" data-annotation="vertical-bubble" data-height="60" data-width="56"></div>
                                </li>
                                <li>
                                    <!-- Facebook share -->
                                    <div class="fb-share-button" data-href="http://otonomic.com" data-type="box_count" style="font-size: 1px;"></div>
                                </li>
                                <li>
                                    <!-- twitter share -->
                                   <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://otonomic.com" data-via="your_screen_name" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
                                </li>
                                <!--
                                <li class="linkedin">
                                    <script type="IN/Share" data-url="http://otonomic.com" data-counter="top"></script>
                                </li>
                                -->
                                <!--
                                <li>
                                    <a href="//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fotonomic.com&media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=I%20am%20launching%20a%20new%20website%20where%20you%20can%20see%20my%20work%20and%20regular%20updates%20%20%20about%20what%20I%20do.%20Please%20visit%20my%20site%20at%20%5Blink%5D%20and%20share%20it%20with%20your%20friends.%20Thank%20you%20%20%20www.otonomic.com%20for%20building%20my%20website." data-pin-do="buttonPin" data-pin-config="above" data-pin-color="white" data-pin-height="28"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_white_28.png" /></a>
                                </li>
                                -->
                            </ul>
                        </div>
                        <div class="modal-btns text-right">
                            <div id="close-btn" class="btn btn-default close-btn modal_close_btn" onClick='window.open("/pricing?reason=domain/","_self");'>
                                <img src="/shared/images/close_btn_x.png">Return to site</div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="modal-footer">
                        <div class="pull-left">
                            <img class="footer-logo" src="/shared/images/footer_logo.png">
                        </div>
                        <div class="footer-text pull-left">
                            <p><strong>Otonomic</strong> users that share their site get 6.3 times more visits - sounds like a good decision!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="domHide" style="display: none">
    <div class="media site-item">
        <a href="#" target="_blank" class="page_image" style="float: left">
            <img class="media-object" src="" height="50" width="50">
        </a>

        <div class="media-body pull-left" style="float: left;margin-left: 10px">
            <p class="media-heading">
                <a href="#" target="_blank" class="page_name"></a>
            </p>
        </div>
    </div>
</div>

 <div id="loader" style="display:none">
	<div class="center" style="margin: 40px auto;">
    	<img src="/shared/images/loader.gif" style="margin-right: 10px;" />
        <span>Loading...</span>
	</div>
</div>

<!-- pintrest -->
<!--
<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
-->

<!-- twitter -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<!-- google+ -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<!-- Linkedin -->
<!--
<script src="//platform.linkedin.com/in.js" type="text/javascript">
  lang: en_US
</script>
-->