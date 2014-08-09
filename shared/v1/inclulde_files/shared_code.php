<?php
include_once __DIR__ . '/log_landing_pdo.php';
// recordPageLoad
//recordEventInDb('LandingPage', 'Load', curPageURL());
?>
<!-- START ErrorCeption -->
<script>
    (function(_,e,rr,s){_errs=[s];var c=_.onerror;_.onerror=function(){var a=arguments;_errs.push(a);
        c&&c.apply(this,a)};var b=function(){var c=e.createElement(rr),b=e.getElementsByTagName(rr)[0];
        c.src="//beacon.errorception.com/"+s+".js";c.async=!0;b.parentNode.insertBefore(c,b)};
        _.addEventListener?_.addEventListener("load",b,!1):_.attachEvent("onload",b)})
        (window,document,"script","52713acf0a2b9bf55800090f");
</script>
<!-- END ErrorCeption -->

<!-- START LuckyOrange -->
<script type='text/javascript'>

    window.__wtw_lucky_site_id = 10400;

    (function() {
        var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
        wa.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://ca10400') + '.luckyorange.com/w.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
    })();

</script>
<!-- END LuckyOrange -->

<?php include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'google_analytics_code.php'; ?>

<!-- START smt2 mouse tracking -->
<!--
<script type="text/javascript" src="/smt2/core/js/smt-aux.min.js"></script>
<script type="text/javascript" src="/smt2/core/js/smt-record.min.js"></script>
<script>smt2.record();</script>
-->
<!-- END smt2 mouse tracking -->
