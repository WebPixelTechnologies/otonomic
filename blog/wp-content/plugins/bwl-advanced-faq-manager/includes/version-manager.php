<?php
/*---
 * Date: 21-05-2014 Version 1.5.1
 * Date: 18-04-2014 Version 1.5.0
 * Date: 02-04-2014 Version 1.4.9
 * Date: 15-03-2014 Version 1.4.8
 * Date: 06-02-2014 Version 1.4.7
 * Date: 26-12-2013 Version 1.4.6
 * Date: 20-12-2013 Version 1.4.5
 * Date: 20-10-2013 Version 1.4.4
 * Date: 20-08-2013 Version 1.4.3
 * Date: 01-08-2013 Version 1.4.2
 * Date: 23-07-2013 Version 1.4.1
 * Date: 09-07-2013 Version 1.4.0
 * Date: 04-07-2013 Version 1.3.0
 * Date: 01-07-2013 Version 1.2.0
 * Date: 23-06-2013 Version 1.1.0
 * Date: 19-06-2013 Version 1.0.0
 * 
 * ---------------------------  ---------------------------------*/
define('DEVELOPER_CONTACT', 'http://codecanyon.com/user/xenioushk');

$new_version = '1.5.1';

if (!defined('BWL_ADVANCED_FAQ_VERSION_KEY'))
    
    define('BWL_ADVANCED_FAQ_VERSION_KEY', 'bwl_advanced_faq_version');

if (!defined('BWL_ADVANCED_FAQ_VERSION_NO'))    
    
    define('BWL_ADVANCED_FAQ_VERSION_NO', '1.5.1');

add_option(BWL_ADVANCED_FAQ_VERSION_KEY, BWL_ADVANCED_FAQ_VERSION_NO);

if (get_option(BWL_ADVANCED_FAQ_VERSION_KEY) != $new_version) {
    // Execute your upgrade logic here

    // Then update the version value
    update_option(BWL_ADVANCED_FAQ_VERSION_KEY, $new_version);
}


?>
