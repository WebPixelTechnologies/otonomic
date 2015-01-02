<?php

/**
* @Description: Custom Theme Style integrate for FAQ
* @Created At: 04-07-2013
* @Last Edited AT: 04-07-2013
* @Created By: Mahbub
**/

function bwl_advanced_faq_manager_custom_theme() {
        
    $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
    
    $theme_id = 'default';
    
    $bwl_advanced_faq_collapsible_accordion_status = 0; // Introduced in version 1.4.4
    
    $enable_custom_theme = 0; // Introduced in version 1.4.4
    
    if ( isset($bwl_advanced_faq_options['enable_custom_theme']) && $bwl_advanced_faq_options['enable_custom_theme'] == "on" ) {         

        $enable_custom_theme = 1;
        
    }
    
    if ( isset($bwl_advanced_faq_options['bwl_advanced_faq_theme']) ) {
         
        $theme_id =   $bwl_advanced_faq_options['bwl_advanced_faq_theme'];
        
    }
    
    if ( isset($bwl_advanced_faq_options['bwl_advanced_faq_collapsible_accordion_status']) ) {
         
        $bwl_advanced_faq_collapsible_accordion_status =   $bwl_advanced_faq_options['bwl_advanced_faq_collapsible_accordion_status'];
        
    }
    
    
    if( $theme_id == "light" && $enable_custom_theme == 0 ) {
        
        //LIGHT COLOR SCHEME.
        $gradient_first_color = "#FFFFFF";
        $gradient_second_color = "#FFFFFF";
        $active_background_color = "#F7F7F7";
        $label_text_color = "#555555";
        $hover_background = "#FFFFFF";
        $label_hover_text_color = "#3a3a3a";        
        $tab_top_border =  "#2C2C2C";
        
    } else if($theme_id == "red" && $enable_custom_theme == 0 ) {
        
        //RED COLOR SCHEME.
        
        $gradient_first_color = "#FF3019";
        $gradient_second_color = "#CF0404";
        $active_background_color = "#CF0404";        
        $label_text_color = "#FFFFFF";
        $hover_background = "#FF3019";
        $label_hover_text_color = "#FFFFFF";
        $tab_top_border = $gradient_first_color;
        
    } else if($theme_id == "blue" && $enable_custom_theme == 0 ) {
        
        //BLUE COLOR SCHEME.
        
        $gradient_first_color = "#49C0F0";
        $gradient_second_color = "#2CAFE3";
        $active_background_color = "#2CAFE3";        
        $label_text_color = "#FFFFFF";
        $hover_background = "#49C0F0";
        $label_hover_text_color = "#FFFFFF";	
        $tab_top_border = $gradient_first_color;
        
    } else if($theme_id == "green" && $enable_custom_theme == 0 ) {
        
        //GREEN COLOR SCHEME.
        
        $gradient_first_color = "#0EB53D";
        $gradient_second_color = "#299A0B";
        $active_background_color = "#299A0B";        
        $label_text_color = "#FFFFFF";
        $hover_background = "#0EB53D";
        $label_hover_text_color = "#FFFFFF";	
        $tab_top_border = $gradient_first_color;
        
    } else if($theme_id == "pink" && $enable_custom_theme == 0 ) {
        
        //GREEN COLOR SCHEME.
        
        $gradient_first_color = "#FF5DB1";
        $gradient_second_color = "#EF017C";
        $active_background_color = "#EF017C";        
        $label_text_color = "#FFFFFF";
        $hover_background = "#FF5DB1";
        $label_hover_text_color = "#FFFFFF";	
        $tab_top_border = $gradient_first_color;
        
    } else if($theme_id == "orange" && $enable_custom_theme == 0 ) {
        
        //GREEN COLOR SCHEME.
        
        $gradient_first_color = "#FFA84C";
        $gradient_second_color = "#FF7B0D";
        $active_background_color = "#FF7B0D";
        $label_text_color = "#FFFFFF";
        $hover_background = "#FFA84C";
        $label_hover_text_color = "#FFFFFF";	
        $tab_top_border = $gradient_first_color;
        
    } else if( $enable_custom_theme == 1 ) {
        
        //CUSTOM COLOR SCHEME.
        
        $hover_background = "#FFA84C";
        
        /*------------------------------ Gradient First Color Settings ---------------------------------*/
        
        $gradient_first_color = "#FFA84C";
        
        if ( isset($bwl_advanced_faq_options['gradient_first_color']) ) {
         
            $gradient_first_color =   $bwl_advanced_faq_options['gradient_first_color'];

        }
        
        /*------------------------------ Gradient Second Color Settings ---------------------------------*/
        
        $gradient_second_color = "#FF7B0D";
        
        if ( isset($bwl_advanced_faq_options['gradient_second_color']) ) {
         
            $gradient_second_color =   $bwl_advanced_faq_options['gradient_second_color'];

        }
        
        /*------------------------------ LABEL TEXT COLOR SETTINGS ---------------------------------*/
        
        $label_text_color = "#777777";
        
         if ( isset($bwl_advanced_faq_options['label_text_color']) ) {
         
            $label_text_color =   $bwl_advanced_faq_options['label_text_color'];

        }
        
        /*------------------------------ LABEL HOVER TEXT COLOR SETTINGS ---------------------------------*/
        
        $label_hover_text_color = "#777777";
        
         if ( isset($bwl_advanced_faq_options['label_hover_text_color']) ) {
         
            $label_hover_text_color =   $bwl_advanced_faq_options['label_hover_text_color'];

        }
        
        /*------------------------------ Gradient Active Background Color Settings ---------------------------------*/
        
        $active_background_color = "#FF7B0D";
        
        if ( isset($bwl_advanced_faq_options['active_background_color']) ) {
         
            $active_background_color =   $bwl_advanced_faq_options['active_background_color'];

        }
        
        $tab_top_border = $gradient_first_color;
        
    } else {
        
        //DEFAULT COLOR SCHEME.
        
        $tab_top_border =  "#2C2C2C";
        $gradient_first_color = "#FFFFFF";
        $gradient_second_color = "#EAEAEA";
        $active_background_color = "#C6E1EC";
        $label_text_color = "#777777";
        $hover_background = "#FFFFFF";
        $label_hover_text_color = "#777777";
        
    }
    
    
    if ( strtoupper( $gradient_first_color ) == "#FFFFFF") {
        
        $tab_top_border =  "#2C2C2C";
        
    }
    
    /*------------------------------Font Settings (Version : 1.4.5)  ---------------------------------*/
    
    $label_font_size = "";
    
    if ( isset( $bwl_advanced_faq_options['bwl_advanced_label_font_size'] ) && $bwl_advanced_faq_options['bwl_advanced_label_font_size'] !="" ) {
        
        $label_font_size = "font-size: " . $bwl_advanced_faq_options['bwl_advanced_label_font_size'] ."px;";
        
    }
    
    $output = "";
    
    $output .= ".ac-container label{";
    $output .= " color: " . $label_text_color .";
                       " . $label_font_size . "
                       text-shadow: 0px 0px 1px rgba(255,255,255,0.8);
                       background: " . $gradient_first_color . ";
                       background: -moz-linear-gradient(top, " . $gradient_first_color . " 1%, " . $gradient_second_color . " 100%);
                       background: -webkit-gradient(linear, left top, left bottom, color-stop(1%," . $gradient_first_color . "), color-stop(100%," . $gradient_second_color . "));
                       background: -webkit-linear-gradient(top, " . $gradient_first_color . " 1%," . $gradient_second_color . " 100%);
                       background: -o-linear-gradient(top, " . $gradient_first_color . " 1%," . $gradient_second_color . " 100%);
                       background: -ms-linear-gradient(top, " . $gradient_first_color . " 1%," . $gradient_second_color . " 100%);
                       background: linear-gradient(top, " . $gradient_first_color . " 1%," . $gradient_second_color . " 100%);
                       filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='" . $gradient_first_color . "', endColorstr='" . $gradient_second_color . "',GradientType=0 );";    
    $output .= "}";
    
    $output .=".ac-container label:hover{
                            background: " . $hover_background .";
                            color: " . $label_hover_text_color .";
                    }";
    
    
        $output .=".ac-container input:checked + label,
                     .ac-container input:checked + label:hover{
                            background: " . $active_background_color . ";
                            color: " . $label_text_color . ";
                            text-shadow: 0px 0px 1px rgba(255,255,255,0.8);
                      }"; 
    $output .=".ac-container input:checked + label{
                            background: " . $gradient_first_color . ";
                       background: -moz-linear-gradient(top, " . $gradient_first_color . " 1%, " . $gradient_second_color . " 100%);
                       background: -webkit-gradient(linear, left top, left bottom, color-stop(1%," . $gradient_first_color . "), color-stop(100%," . $gradient_second_color . "));
                       background: -webkit-linear-gradient(top, " . $gradient_first_color . " 1%," . $gradient_second_color . " 100%);
                       background: -o-linear-gradient(top, " . $gradient_first_color . " 1%," . $gradient_second_color . " 100%);
                       background: -ms-linear-gradient(top, " . $gradient_first_color . " 1%," . $gradient_second_color . " 100%);
                       background: linear-gradient(top, " . $gradient_first_color . " 1%," . $gradient_second_color . " 100%);
                       filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='" . $gradient_first_color . "', endColorstr='" . $gradient_second_color . "',GradientType=0 );
                            color: " . $label_text_color . ";
                            text-shadow: 0px 0px 1px rgba(255,255,255,0.8);
                      }";
    
    
    
    if ( isset( $bwl_advanced_faq_options['bwl_advanced_content_font_size'] ) && $bwl_advanced_faq_options['bwl_advanced_content_font_size'] !="" ) {
        
    // Change Font Settings: Introduced in Version: 1.4.5
    $output .=".ac-container .bwl-faq-container article div,
                    .ac-container .bwl-faq-container article p {
                            font-size: " . $bwl_advanced_faq_options['bwl_advanced_content_font_size'] . "px;
                   }";
    
    }
    
     // Change Font Settings: Introduced in Version: 1.4.5
    $output .=".bwl-faq-wrapper ul.bwl-faq-tabs li.active{                            
                            border-color: " . $tab_top_border .";
                   }";
 
    echo "<style type='text/css'>$output</style>";
    
    $color_scheme_output = "var first_color = '" . $gradient_first_color . "',
                                               checked_background = '" . $active_background_color . "',
                                               hover_background = '" . $hover_background . "',
                                               bwl_advanced_faq_collapsible_accordion_status = '" . $bwl_advanced_faq_collapsible_accordion_status . "',
                                               text_nothing_found = '" . __('Noting Found !', 'bwl-adv-faq'). "',
                                               text_faqs = '" . __('FAQs', 'bwl-adv-faq'). "',
                                               text_faq = '" . __('FAQ', 'bwl-adv-faq'). "',                                               
                                               second_color = '" . $gradient_second_color. "'";
    
    echo '<script type="text/javascript">' . $color_scheme_output . '</script>';
    
}

add_action( 'wp_head', 'bwl_advanced_faq_manager_custom_theme' );


?>
