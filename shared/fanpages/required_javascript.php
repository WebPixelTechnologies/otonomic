<!-- <script src="//cdn.optimizely.com/js/326727683.js"></script> -->

<link href="/shared/fanpages/css/style_new.css" rel="stylesheet" type="text/css" />
<link href="/shared/lib/tipsy/tipsy.css" rel="stylesheet" type="text/css" />

<link href="//wwwstatic.verisites.com/lp/creative/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="/shared/css/t_box_styles.css" rel="stylesheet" type="text/css" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>

<script src="//wwwstatic.verisites.com/lp/creative/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js" type="text/javascript" ></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" type="text/javascript"></script>

<script src="/shared/fanpages/js/search_filter.js" type="text/javascript"></script>

<script type="text/javascript" src="/shared/fanpages/js/jquery.jsonp-2.4.0.min.js" defer></script>
<script type="text/javascript" src="/shared/lib/tipsy/jquery.tipsy.js" defer></script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#btn_go').tipsy({
            gravity:  'se',//jQuery.fn.tipsy.autoNS,
            trigger: 'manual'
        });
    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        trackFBConnect('Search Page', 'Document Ready');

        $("#btn_video").click(function(e) {
            e.preventDefault();

            $.fancybox({
                'padding'       : 0,
                'autoScale'     : false,
                'transitionIn'  : 'none',
                'transitionOut' : 'none',
                'title'         : this.title,
                'width'         : 680,
                'height'        : 495,
                'href'          : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
                'type'          : 'swf',
                'swf'           : {
                    'wmode'        : 'transparent',
                    'allowfullscreen'   : 'true'
                }
            });

            //return false;
        });

        $('#main_search_box').focus();

        window.scrollTo(0,0);
    });
</script>
