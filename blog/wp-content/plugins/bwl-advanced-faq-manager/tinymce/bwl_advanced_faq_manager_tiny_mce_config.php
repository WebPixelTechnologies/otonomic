<?php

/**
* @Description: Shortcode Editor Button
* @Created At: 08-04-2013
* @Last Edited AT: 26-06-2013
* @Created By: Mahbub
**/

add_action('admin_init', 'bwl_advanced_faq_tinymce_shortcode_button');

function bwl_advanced_faq_tinymce_shortcode_button() {
    
    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
        add_filter('mce_external_plugins', 'add_bwl_advanced_faq_shortcode_plugin');
        add_filter('mce_buttons', 'register_bwl_advanced_faq_shortcode_button');
    }
}

function register_bwl_advanced_faq_shortcode_button( $buttons ) {
    array_push($buttons, "bwl_advanced_faq");
    return $buttons;
}

function add_bwl_advanced_faq_shortcode_plugin( $plugin_array ) {
    $plugin_array['bwl_advanced_faq'] = BWL_BAFM_PLUGIN_DIR . 'tinymce/bwl_advanced_faq_tinymce_button.js';
    return $plugin_array;
}

 
?>