<div class="page" id="facebook_fanpages">
    <header class="container">
        <h1>Awesome!</h1>
        <h2>You are one small step away from having a gorgeous new website!</h2>
        <img src="images/header.png">
    </header>
    <main class="container">
        <p class="fanpage_list_connected">Go ahead and choose the Fan Page you want to convert to your website</p>
        <div class="fanpage_list selection" style="display: none">
            <article class="fanpage">
                <a href="#" class="fanpage_link">
                    <img src="images/ico-1.png" class="fanpage_image">
                    <p class="fanpage_name">Jessica's Pastries</p>
                </a>
            </article>
            <article class="fanpage">
                <img src="images/ico-2.png" class="fanpage_image">
                <p class="fanpage_name">Lorem ipsu dolor</p>
            </article>
            <article class="fanpage">
                <img src="images/ico-3.png" class="fanpage_image">
                <p class="fanpage_name">Adipiscing loriumet</p>
            </article>
            <article class="fanpage">
                <img src="images/ico-4.png" class="fanpage_image">
                <p class="fanpage_name">Amet consetuer</p>
            </article>

        </div>
        <p class="fanpage_list_connected"><small>Don't worry, you will be able to create a website for your other pages later.</small></p>
        <div class="fanpage_list_disconnected">
            <a class="button-connect-using-facebook facebook_connect track_event measure_time" style="display: block;cursor: pointer" data-ajax-track="1" data-ga-label="main_button" data-ga-event="Connect with Facebook" data-ga-category="Fanpage listing"></a>
        </div>
    </main>
</div>
<script type="text/javascript">
    var isFanpageListing = 1;
    $(window).on('load', function(){
        //image height/width will be accurate after window load all the DOMs
        initialize_fanpage_listing();   //CTRL+F5 image height/width issue solved
    });
    jQuery(document).ready(function($){
        dfd.done(function(){
            initialize_fanpage_listing();
            checkConnectedWithFacebook();
        });
    });
</script>

