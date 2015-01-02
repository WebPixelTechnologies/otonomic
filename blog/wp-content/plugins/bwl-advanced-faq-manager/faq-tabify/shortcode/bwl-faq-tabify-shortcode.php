<?php

add_shortcode('bwl_faq_tab', 'bwl_faq_tab');

function bwl_faq_tab($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'title' => '',
        'link' => '',
        'target' => ''
                    ), $atts));
    
    global $single_tab_array;
    
    $single_tab_array[] = array(
                                        'title' => $title, 
                                        'link' => $link, 
                                        'content' => trim(do_shortcode($content))
                                    );
}


add_shortcode('bwl_faq_tabs', 'bwl_faq_tabs');

function bwl_faq_tabs( $atts, $content = null ) {
    
    global $single_tab_array;
    
    $single_tab_array = array(); // clear the array

    $bwl_faq_tab_navigation = '<div class="bwl-faq-wrapper">';
    $bwl_faq_tab_content = "";
    $bwl_faq_tab_output = "";
    
    $bwl_faq_tab_navigation .= '<ul class="bwl-faq-tabs">';

    // execute the '[tab]' shortcode first to get the title and content - acts on global $single_tab_array
    do_shortcode($content);

    //declare our vars to be super clean here
    
    foreach ( $single_tab_array as $tab => $tab_attr_array ) {

        $random_id = wp_rand();

        $default = ( $tab == 0 ) ? ' class="active"' : '';

        if ( $tab_attr_array['link'] != "" ) {
            
            $bwl_faq_tab_navigation .= '<li' . $default . '><a class="bwl-faq-link" href="' . $tab_attr_array["link"] . '" target="' . $tab_attr_array["target"] . '" rel="tab' . $random_id . '"><span>' . $tab_attr_array['title'] . '</span></a></li>';
            
        } else {
            
            $bwl_faq_tab_navigation .= '<li' . $default . '><a href="javascript:void(0)" rel="tab' . $random_id . '"><span>' . $tab_attr_array['title'] . '</span></a></li>';
            $bwl_faq_tab_content .= '<div class="bwl-faq-tab-content" id="tab' . $random_id . '" ' . ( $tab != 0 ? 'style="display:none"' : '') . '>' . $tab_attr_array['content'] . '</div>';
            
        }
        
    }
    
    $bwl_faq_tab_navigation .= '</ul><!-- .bwl-faq-tabs -->';

    $bwl_faq_tab_output = $bwl_faq_tab_navigation . '<div class="bwl-faq-content-wrapper">' . $bwl_faq_tab_content . '</div>';
    $bwl_faq_tab_output .= '</div><!-- .tabs-wrapper -->';

    return $bwl_faq_tab_output;
}



?>