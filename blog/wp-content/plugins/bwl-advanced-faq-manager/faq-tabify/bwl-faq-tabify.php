<?php

include_once 'shortcode/bwl-faq-tabify-shortcode.php';
 

function bwl_faq_tabify_scripts() {
    
    if ( ! is_admin()) {
    
        wp_enqueue_style( 'bwl-faq-tabify-style' , plugins_url( 'css/bwl-faq-tabify.css' , __FILE__ ) );
        wp_register_script( 'bwl-faq-tabify-script', plugins_url( 'js/bwl-faq-tabify.js' , __FILE__ ) , array( 'jquery'), '', FALSE );
        wp_enqueue_script( 'bwl-faq-tabify-script' );
    
    }
    
}

add_action('init', 'bwl_faq_tabify_scripts');

?>