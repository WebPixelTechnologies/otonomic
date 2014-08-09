<?php include_once __DIR__ .'/facebook_connect_config.php'; ?>

<div id="fb-root"></div>
<script type="text/javascript">
    var dfd;
    /* LOAD FACEBOOK SDK ASYNC */
    window.fbAsyncInit = function() {
        FB.init({ appId: FACEBOOK_APP_ID,status: true,cookie: true,xfbml: true});
        dfd.resolve();
        //checkConnectedWithFacebook();
    };
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js&appId="+FACEBOOK_APP_ID;
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    //$.noConflict();
    jQuery(document).ready(function($){
        $(".facebook_connect").hide();
        dfd = $.Deferred();
        dfd.done(function(){
            $(".facebook_connect").show();
        });
    });
</script>

<a href="#model_rejected_app" id="facebook_connector" style="display:none">Connect Facebook</a>
<a href="#model_rejected_manage_pages" id="facebook_pconnector" style="display:none">Connect Personal Facebook</a>

<div id="loader" style="display:none">
    <div class="center" style="margin: 40px auto;">
        <img src="images/loader.gif" style="margin-right: 10px;" />
        <span>Loading...</span>
    </div>
</div>

<div id="message_info" style="display:none">
    <div class="center" style="margin: 40px auto;">
        <span>&nbsp;</span>
    </div>
</div>