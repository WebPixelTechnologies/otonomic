<div id="fb-root"></div>
<script type="text/javascript">
    var fb_id = '334469486646650';

    window.fbAsyncInit = function() {
        FB.init({ appId: fb_id,status: true,cookie: true,xfbml: true});
        window.fbAsyncInit.fbLoaded.resolve();
    };

    window.fbAsyncInit.fbLoaded = $.Deferred();

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js&appId=" + fb_id;
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>