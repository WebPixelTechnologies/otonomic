<?php
if (isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'p2s.test' || $_SERVER['HTTP_HOST'] == 'otonomic.test' )) {
    if(!defined('LOCALHOST')) { define('LOCALHOST', 1); }
    if(!defined('ZINK_APP_FOLDER')) { define('ZINK_APP_FOLDER', '/'); }
    //if(!defined('MAIN_DOMAIN')) { define('MAIN_DOMAIN', 'page2site.com'); }
    //if(!defined('BUILDER_PATH')) { define('BUILDER_PATH', 'http://p2s.test/'); }
	if(!defined('MAIN_DOMAIN')) { define('MAIN_DOMAIN', 'otonomic.test'); }
	if(!defined('BUILDER_PATH')) { define('BUILDER_PATH', 'http://otonomic.test/'); }

    if(!defined('FACEBOOK_APP_ID')) { define('FACEBOOK_APP_ID', '286934271328156'); }
    if(!defined('FACEBOOK_SECRET_KEY')) { define('FACEBOOK_SECRET_KEY', '55bf8f49cd5030ba6d6fecb50b896a77'); }
    if(!defined('FACEBOOK_CONNECT_PATH')) { define('FACEBOOK_CONNECT_PATH', '/shared/'); }
    if(!defined('NEXT_PAGE_URL')) { define('NEXT_PAGE_URL', '/shared/facebook_fanpages.php'); }

} else {
    if(!defined('LOCALHOST')) {     define('LOCALHOST', 0); }
    if(!defined('MAIN_DOMAIN')) { define('MAIN_DOMAIN', 'otonomic.com'); }
    if(!defined('ZINK_APP_FOLDER')) { define('ZINK_APP_FOLDER', '/code/'); }
    //if(!defined('BUILDER_PATH')) { define('BUILDER_PATH', 'http://builder.'.MAIN_DOMAIN.'/'); }
	if(!defined('BUILDER_PATH')) { define('BUILDER_PATH', 'http://wp.'.MAIN_DOMAIN.'/'); }

    if(!defined('FACEBOOK_APP_ID')) { define('FACEBOOK_APP_ID', '373931652687761'); }
    if(!defined('FACEBOOK_SECRET_KEY')) { define('FACEBOOK_SECRET_KEY', 'd154036467714f4ac4706e653a1211ad'); }
    if(!defined('FACEBOOK_CONNECT_PATH')) { define('FACEBOOK_CONNECT_PATH', '/shared/'); }
    if(!defined('NEXT_PAGE_URL')) { define('NEXT_PAGE_URL', '//www.'.MAIN_DOMAIN.'/shared/facebook_fanpages.php'); }
}
if(!defined('PAGE2SITE_FOLDER')) { define('PAGE2SITE_FOLDER', ZINK_APP_FOLDER); }
?>

<script>
/* GLOBAL VARIABLES */
var WEBROOT = '<?= PAGE2SITE_FOLDER?>';
var BUILDER_PATH = '<?= BUILDER_PATH;?>';
var connect_path = '<?= FACEBOOK_CONNECT_PATH?>';
var FACEBOOK_APP_ID = '<?= FACEBOOK_APP_ID?>';
var LOCALHOST = <?= LOCALHOST?>;
var MAIN_DOMAIN = '<?= MAIN_DOMAIN?>';
</script>
