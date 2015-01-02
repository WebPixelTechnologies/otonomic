<?php

/***********************************************************
* @Description: Integreate settings options
* @Created At: 08-04-2013
* @Last Edited AT: 23-04-2013
* @Created By: Mahbub
***********************************************************/

add_filter('plugin_action_links', 'bwl_advanced_faq_plugin_welcome_link', 10, 2);

function bwl_advanced_faq_plugin_welcome_link( $links, $file ) {
    
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) {
        // The "page" query string value must be equal to the slug
        // of the Settings admin page we defined earlier, which in
        // this case equals "myplugin-settings".
        $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/edit.php?post_type=bwl_advanced_faq&page=bwl-advanced-faq-welcome">Welcome</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}

?>
