<!-- START Google Analytics -->
<?php if(!empty($_COOKIE['team'])) { return;} ?>
<?php
	$ga_code = 'UA-XXXXX-Y';
	$domain = 'www.page2site.com'
?>

<!-- START Google Analytics -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  var pluginUrl = '//www.google-analytics.com/plugins/ga/inpage_linkid.js';
  
	_gaq.push(['_require', 'inpage_linkid', pluginUrl]);
	_gaq.push(['_setAccount', '<?php echo $ga_code;?>']);
	_gaq.push(['_setDomainName', '<?php echo $domain;?>']);
	_gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- END Google Analytics -->