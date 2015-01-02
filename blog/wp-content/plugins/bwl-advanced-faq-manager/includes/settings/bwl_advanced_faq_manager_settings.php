<?php

    /**
    * Render the settings screen
    */

    function bwl_advanced_faq_settings() {      
        
    ?>

    <style type="text/css">
        
        .faq-wrapper table.form-table th{
            font-size: 13px;
        }
        
    </style>

    <div class="wrap faq-wrapper">
        
        <?php screen_icon(); ?>  

       <h2><?php _e('BWL Advanced FAQ Manager Settings', 'bwl-adv-faq'); ?></h2>

           <?php if (isset($_GET['settings-updated'])) { ?>
               <div id="message" class="updated">
                   <p><strong><?php _e('Settings saved.', 'bwl-adv-faq') ?></strong></p>
               </div>
           <?php } ?>

       <form action="options.php" method="post">
           <?php settings_fields('bwl_advanced_faq_options')?>
           <?php do_settings_sections(__FILE__);?>

           <p class="submit">
               <input name="submit" type="submit" class="button-primary" value="<?php _e('Save Settings', 'bwl-adv-faq'); ?>"/>
           </p>
       </form>    

      </div> 

    <?php
        
    }

    
    function register_settings_and_fields() {
        
        // First Parameter option group.
        // Second Parameter contain keyword. use in get_options() function.
        
        register_setting('bwl_advanced_faq_options', 'bwl_advanced_faq_options');
        
        // Common Settings.        
        add_settings_section('bwl_advanced_faq_display_section', __("Display Settings: ", 'bwl-adv-faq'), "bwl_advanced_faq_display_section_cb", __FILE__);        
        add_settings_field('bwl_advanced_faq_theme',  __("FAQ Theme: ", 'bwl-adv-faq'), "bwl_advanced_faq_theme_settings", __FILE__ , 'bwl_advanced_faq_display_section');
        add_settings_field('bwl_advanced_faq_search_status',  __("Display Search Box: ", 'bwl-adv-faq'), "bwl_search_box_settings", __FILE__ , 'bwl_advanced_faq_display_section');
        add_settings_field('bwl_advanced_faq_meta_info_status',  __("Display Meta Info: ", 'bwl-adv-faq'), "bwl_meta_info_settings", __FILE__ , 'bwl_advanced_faq_display_section');
        add_settings_field('bwl_advanced_faq_like_button_status',  __("Display Like Button: ", 'bwl-adv-faq'), "bwl_like_button_settings", __FILE__ , 'bwl_advanced_faq_display_section');
        add_settings_field('bwl_advanced_faq_logged_in_status',  __("Require Logged In For Submit FAQ: ", 'bwl-adv-faq'), "bwl_faq_logged_in_settings", __FILE__ , 'bwl_advanced_faq_display_section');
        add_settings_field('bwl_advanced_faq_captcha_status',  __("Captcha In FAQ Submit Form : ", 'bwl-adv-faq'), "bwl_faq_captcha_settings", __FILE__ , 'bwl_advanced_faq_display_section');
        add_settings_field('bwl_advanced_email_notification_status',  __("New FAQ Email Notification: ", 'bwl-adv-faq'), "bwl_faq_email_notification_settings", __FILE__ , 'bwl_advanced_faq_display_section');        
        add_settings_field('bwl_advanced_modernizr_status',  __("Enable Modernizr: ", 'bwl-adv-faq'), "enable_modernizr_setting", __FILE__ , 'bwl_advanced_faq_display_section');
        
        // Font Settings.        
        add_settings_section('bwl_advanced_faq_custom_font_section', __("Font Settings", 'bwl-adv-faq'), "bwl_advanced_faq_custom_font_cb", __FILE__);        
        add_settings_field('bwl_advanced_label_font_size',  __("FAQ Label Font Size: ", 'bwl-adv-faq'), "bwl_faq_label_font_size_settings", __FILE__ , 'bwl_advanced_faq_custom_font_section');        
        add_settings_field('bwl_advanced_content_font_size',  __("Content Font Size: ", 'bwl-adv-faq'), "bwl_faq_content_font_size_settings", __FILE__ , 'bwl_advanced_faq_custom_font_section');        
        add_settings_field('bwl_advanced_fa_status',  __("Font Awesome: ", 'bwl-adv-faq'), "bwl_enable_fa_settings", __FILE__ , 'bwl_advanced_faq_custom_font_section');        
        
        // Theme Settings.
        add_settings_section('bwl_advanced_faq_custom_theme_section', __("Custom Theme Settings", 'bwl-adv-faq'), "bwl_advanced_faq_custom_theme_cb", __FILE__);        
        add_settings_field('enable_custom_theme',  __("Enable Custom Theme: ", 'bwl-adv-faq'), "enable_custom_theme_setting", __FILE__ , 'bwl_advanced_faq_custom_theme_section');
        add_settings_field('gradient_first_color',  __("Gradient First Color: ", 'bwl-adv-faq'), "gradient_first_color_setting", __FILE__ , 'bwl_advanced_faq_custom_theme_section');
        add_settings_field('gradient_second_color',  __("Gradient Second Color: ", 'bwl-adv-faq'), "gradient_second_color_setting", __FILE__ , 'bwl_advanced_faq_custom_theme_section');
        add_settings_field('label_text_color',  __("Label Text Color: ", 'bwl-adv-faq'), "label_text_color_setting", __FILE__ , 'bwl_advanced_faq_custom_theme_section');
        add_settings_field('label_hover_text_color',  __("Label Hover Text Color: ", 'bwl-adv-faq'), "label_hover_text_color_setting", __FILE__ , 'bwl_advanced_faq_custom_theme_section');
        add_settings_field('active_background_color',  __("Active Label Background Color: ", 'bwl-adv-faq'), "active_background_color_setting", __FILE__ , 'bwl_advanced_faq_custom_theme_section');
        
        // Reading Settings.        
        add_settings_section('bwl_advanced_faq_reading_section', __("Reading Settings", 'bwl-adv-faq'), "bwl_advanced_faq_excerpt_section_cb", __FILE__);        
        add_settings_field('bwl_advanced_faq_collapsible_accordion_status',  __("Collapsible Accordion: ", 'bwl-adv-faq'), "bwl_faq_collapsible_accordion_settings", __FILE__ , 'bwl_advanced_faq_reading_section');
        add_settings_field('bwl_advanced_faq_excerpt_status',  __("Excerpt Status: ", 'bwl-adv-faq'), "bwl_faq_excerpt_settings", __FILE__ , 'bwl_advanced_faq_reading_section');
        add_settings_field('bwl_advanced_faq_excerpt_length',  __("Excerpt Length: ", 'bwl-adv-faq'), "bwl_faq_excerpt_length", __FILE__ , 'bwl_advanced_faq_reading_section');
        
        // Slug Settings.
        add_settings_section('bwl_advanced_faq_advanced_section', __("Advanced Settings", 'bwl-adv-faq'), "bwl_advanced_faq_advanced_section_cb", __FILE__);        
        add_settings_field('bwl_advanced_faq_custom_slug',  __("Custom Slug: ", 'bwl-adv-faq'), "bwl_faq_custom_slug_settings", __FILE__ , 'bwl_advanced_faq_advanced_section');
        
    }


    function bwl_advanced_faq_custom_font_cb() {
        // Add option Later.        
    }
    
    /**
    * @Description: FAQ Label Font Size.
    * @Created At: 17-12-2013
    * @Last Edited AT: 17-12-2013
    * @Created By: Mahbub
    **/
    
    function bwl_faq_label_font_size_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_label_font_size  = ""; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_label_font_size'])) { 
            
            $bwl_advanced_label_font_size = $bwl_advanced_faq_options['bwl_advanced_label_font_size'];
            
        }        

        
        $bwl_advanced_content_font_size_string =  '<select name="bwl_advanced_faq_options[bwl_advanced_label_font_size]">';
        
        $bwl_advanced_content_font_size_string .='<option value="" "selected=selected"> '. __('Use Theme Font Size', 'bwl-adv-faq') . ' </option>';
        
        for( $i = 15; $i <= 72; $i++ ) {
                     
            if( $bwl_advanced_label_font_size == $i ) {

                $selected_status = "selected=selected";

            } else {

                $selected_status = "";

            }
            
            
            $bwl_advanced_content_font_size_string .='<option value="'.$i.'" ' . $selected_status . '>' . $i . ' Px</option>';
            
        }
        
        $bwl_advanced_content_font_size_string .="</select>";

        echo $bwl_advanced_content_font_size_string; 
        
        
    }
    
    /**
    * @Description: FAQ Content Font Size.
    * @Created At: 17-12-2013
    * @Last Edited AT: 17-12-2013
    * @Created By: Mahbub
    **/
    
    function bwl_faq_content_font_size_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_content_font_size  = ""; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_content_font_size'])) { 
            
            $bwl_advanced_content_font_size = $bwl_advanced_faq_options['bwl_advanced_content_font_size'];
            
        }        

        
        $bwl_advanced_content_font_size_string =  '<select name="bwl_advanced_faq_options[bwl_advanced_content_font_size]">';
        
        $bwl_advanced_content_font_size_string .='<option value="" "selected=selected"> '. __('Use Theme Font Size', 'bwl-adv-faq') . ' </option>';
        
        for( $i = 11; $i <= 62; $i++ ) {
                     
            if( $bwl_advanced_content_font_size == $i ) {

                $selected_status = "selected=selected";

            } else {

                $selected_status = "";

            }
            
            
            $bwl_advanced_content_font_size_string .='<option value="'.$i.'" ' . $selected_status . '>' . $i . ' Px</option>';
            
        }
        
        $bwl_advanced_content_font_size_string .="</select>";

        echo $bwl_advanced_content_font_size_string; 
        
        
    }
    
    /**
    * @Description: Font Awesome Settings
    * @Created At: 17-12-2013
    * @Last Edited AT: 17-12-2013
    * @Created By: Mahbub
    **/
    
    function bwl_enable_fa_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_fa_status  = ""; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_fa_status'])) {
            
            $bwl_advanced_fa_status = $bwl_advanced_faq_options['bwl_advanced_fa_status'];
            
        }        
        
        if( $bwl_advanced_fa_status == "on" ) {
            
            $enable_status = "checked=checked";
            
        } else {
            
            $enable_status = "";
            
        }
        
        echo '<input type="checkbox" name="bwl_advanced_faq_options[bwl_advanced_fa_status]" ' . $enable_status . '>';
        
        
    }
    
    
    function bwl_advanced_faq_custom_theme_cb() {
        // Add option Later.        
    }
    
    
    
     /**
    * @Description: FAQ Modernizr Setting
    * @Created At: 08-04-2013
    * @Last Edited AT: 06-11-2013
    * @Created By: Mahbub
    **/
    
    function enable_modernizr_setting() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_modernizr_status  = ""; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_modernizr_status'])) {
            
            $bwl_advanced_modernizr_status = $bwl_advanced_faq_options['bwl_advanced_modernizr_status'];
            
        }        
        
        if( $bwl_advanced_modernizr_status == "on" ) {
            
            $enable_status = "checked=checked";
            
        } else {
            
            $enable_status = "";
            
        }
        
        echo '<input type="checkbox" name="bwl_advanced_faq_options[bwl_advanced_modernizr_status]" ' . $enable_status . '>';
        
        
    }
    
    /**
    * @Description: FAQ Collapsible Accordion.
    * @Created At: 08-04-2013
    * @Last Edited AT: 26-06-2013
    * @Created By: Mahbub
    **/
    
    function enable_custom_theme_setting() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $enable_custom_theme  = ""; 
        
        if( isset($bwl_advanced_faq_options['enable_custom_theme'])) {
            
            $enable_custom_theme = $bwl_advanced_faq_options['enable_custom_theme'];
            
        }        
        
        if( $enable_custom_theme == "on" ) {
            
            $enable_status = "checked=checked";
            
        } else {
            
            $enable_status = "";
            
        }
        
        echo '<input type="checkbox" name="bwl_advanced_faq_options[enable_custom_theme]" ' . $enable_status . '>';
        
    }
    
    
    /**
    * @Description: FAQ Color Picker settings.
    * @Created At: 08-04-2013
    * @Last Edited AT: 26-06-2013
    * @Created By: Mahbub
    **/
    
    /*------------------------------ First Color Settings ---------------------------------*/
    
    function gradient_first_color_setting() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $gradient_first_color  = "#FFFFFF"; 
        
        if( isset($bwl_advanced_faq_options['gradient_first_color'])) { 
            
                    $gradient_first_color = strtoupper( $bwl_advanced_faq_options['gradient_first_color'] );
            
        }
        
        echo '<input type="text" name="bwl_advanced_faq_options[gradient_first_color]" id="gradient_first_color" class="medium-text ltr" value="' . $gradient_first_color . '" />';        
        
    }
    
    /*------------------------------ Second Color Settings ---------------------------------*/
    
    function gradient_second_color_setting() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $gradient_second_color  = "#EAEAEA"; 
        
        if( isset($bwl_advanced_faq_options['gradient_second_color'])) { 
            
                    $gradient_second_color = strtoupper( $bwl_advanced_faq_options['gradient_second_color'] );
            
        }
        
        echo '<input type="text" name="bwl_advanced_faq_options[gradient_second_color]" id="gradient_second_color" class="medium-text ltr" value="' . $gradient_second_color . '" />';        
        
    }
    
    
    /*------------------------------ Label Text Color Setting Settings ---------------------------------*/
    
    function label_text_color_setting() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $label_text_color  = "#777777"; 
        
        if( isset($bwl_advanced_faq_options['label_text_color'])) { 
            
            $label_text_color = strtoupper( $bwl_advanced_faq_options['label_text_color'] );
            
        }
        
        echo '<input type="text" name="bwl_advanced_faq_options[label_text_color]" id="label_text_color" class="medium-text ltr" value="' . $label_text_color . '" />';        
        
    }
    
    /*------------------------------ Label Hover Text Color Setting Settings ---------------------------------*/
    
    function label_hover_text_color_setting() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $label_hover_text_color  = "#777777"; 
        
        if( isset($bwl_advanced_faq_options['label_hover_text_color'])) { 
            
            $label_hover_text_color = strtoupper( $bwl_advanced_faq_options['label_hover_text_color'] );
            
        }
        
        echo '<input type="text" name="bwl_advanced_faq_options[label_hover_text_color]" id="label_hover_text_color" class="medium-text ltr" value="' . $label_hover_text_color . '" />';        
        
    }
    
    
    /*------------------------------ Active Background Color Settings ---------------------------------*/
    
    function active_background_color_setting() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $active_background_color  = "#C6E1EC";
        
        if( isset($bwl_advanced_faq_options['active_background_color'])) { 
            
                $active_background_color = strtoupper( $bwl_advanced_faq_options['active_background_color'] );
            
        }
        
        echo '<input type="text" name="bwl_advanced_faq_options[active_background_color]" id="active_background_color" class="medium-text ltr" value="' . $active_background_color . '" />';        
        
    }
    
 
    
    function bwl_advanced_faq_advanced_section_cb() {
        // Add option Later.        
    }
    
  
     /**
    * @Description: FAQ Excerpt Length settings.
    * @Created At: 08-04-2013
    * @Last Edited AT: 26-06-2013
    * @Created By: Mahbub
    **/
    
    function bwl_faq_custom_slug_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_custom_slug  = "bwl-advanced-faq"; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_custom_slug']) && $bwl_advanced_faq_options['bwl_advanced_faq_custom_slug'] != "" ) {
            
                $bwl_advanced_faq_custom_slug = trim( $bwl_advanced_faq_options['bwl_advanced_faq_custom_slug'] );
            
        }
        
        echo '<input type="text" name="bwl_advanced_faq_options[bwl_advanced_faq_custom_slug]" class="regular-text all-options" value="' . strtolower( $bwl_advanced_faq_custom_slug ) . '" /> <strong>Example:</strong> http://yourdomain.com/custom-slug/faq-4/ ';        
        echo '<br /><strong>Note:</strong> You may face 404 issue after changing slug value. To solve that, Go to Settings>Permalinks. Select "Default" from Common Settings, click save. Then again select "Post name" radio button and click save. Issue will be solved.';
        
    }
    
    
    
    function bwl_advanced_faq_excerpt_section_cb() {
        // Add option Later.        
    }
    
     /**
    * @Description: FAQ Collapsible Accordion.
    * @Created At: 08-04-2013
    * @Last Edited AT: 26-06-2013
    * @Created By: Mahbub
    **/
    
    function bwl_faq_collapsible_accordion_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_collapsible_accordion_status  = 0; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_collapsible_accordion_status'])) {
            
            $bwl_advanced_faq_collapsible_accordion_status = $bwl_advanced_faq_options['bwl_advanced_faq_collapsible_accordion_status'];
            
        }        
        
        
        if( $bwl_advanced_faq_collapsible_accordion_status == 1 ) {
            
            $show_status = "selected=selected";
            $hide_status = "";
            $all_faq_open_status = "";
            
        }else if( $bwl_advanced_faq_collapsible_accordion_status == 2 ) {
            
            $show_status = "";
            $hide_status = "";
            $all_faq_open_status = "selected=selected";
            
        } else {
            
            $show_status = "";
            $hide_status = "selected=selected";
            $all_faq_open_status = "";
            
        }
        
        echo '<select name="bwl_advanced_faq_options[bwl_advanced_faq_collapsible_accordion_status]">	 
                    <option value="0" ' . $hide_status . '>Inactive</option>
                    <option value="1" ' . $show_status . '>Show All FAQ Answer Closed</option>	 
                    <option value="2" ' . $all_faq_open_status . '>Show All FAQ Answer Opened</option>                    
                 </select>';
        
    }
    
    
    /**
    * @Description: FAQ Excerpt settings.
    * @Created At: 08-04-2013
    * @Last Edited AT: 26-06-2013
    * @Created By: Mahbub
    **/
    
    function bwl_faq_excerpt_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_excerpt_status  = 0; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_excerpt_status'])) {
            
            $bwl_advanced_faq_excerpt_status = $bwl_advanced_faq_options['bwl_advanced_faq_excerpt_status'];
            
        }        
        
        
        if($bwl_advanced_faq_excerpt_status == 1) {
            $show_status = "selected=selected";
            $hide_status = "";
        } else {
            
            $show_status = "";
            $hide_status = "selected=selected";
            
        }
        
        echo '<select name="bwl_advanced_faq_options[bwl_advanced_faq_excerpt_status]">	 
                    <option value="0" ' . $hide_status . '>Inactive</option>
                    <option value="1" ' . $show_status . '>Active</option>	 
                    
                 </select>';
        
        
    }
    
    
    /**
    * @Description: FAQ Excerpt Length settings.
    * @Created At: 08-04-2013
    * @Last Edited AT: 26-06-2013
    * @Created By: Mahbub
    **/
    
    function bwl_faq_excerpt_length() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_excerpt_length  = 60; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_excerpt_length'])) { 
            
                    $bwl_advanced_faq_excerpt_length = is_numeric($bwl_advanced_faq_options['bwl_advanced_faq_excerpt_length']) ? $bwl_advanced_faq_options['bwl_advanced_faq_excerpt_length'] : 60;
            
        }
        
        echo '<input type="text" name="bwl_advanced_faq_options[bwl_advanced_faq_excerpt_length]" class="small-text ltr" value="' . $bwl_advanced_faq_excerpt_length . '" />';        
        
    }
    
    
    
    
    /*------------------------------ Form Input ---------------------------------*/
    
    function bwl_advanced_faq_display_section_cb() {
        // Add option Later.        
    }
    
    function bwl_advanced_faq_theme_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_theme  = 'default'; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_theme'])) { 
            
            $bwl_advanced_faq_theme = $bwl_advanced_faq_options['bwl_advanced_faq_theme'];
            
        }       
        
        $theme_scheme = array('default', 'light', 'red', 'blue', 'green', 'pink', 'orange');        
        
        $theme_output = '<select name="bwl_advanced_faq_options[bwl_advanced_faq_theme]">';
        
        foreach ($theme_scheme as $theme_key=>$theme_value) {            
            
            if($bwl_advanced_faq_theme == $theme_value) {
                
                $show_status = "selected=selected";                
                
            } else {

                $show_status = "";                

            }
            
            $theme_output .='<option value="' . $theme_value . '" ' . $show_status . '>' . ucfirst($theme_value) . ' Theme</option>';
            
        }
        
        $theme_output .= '</select>';
        
        echo $theme_output;
        
    }
    
    function bwl_search_box_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_search_status  = 1; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_search_status'])) { 
            
            $bwl_advanced_faq_search_status = $bwl_advanced_faq_options['bwl_advanced_faq_search_status'];
            
        }        
        
        
        if($bwl_advanced_faq_search_status == 1) {
            $show_status = "selected=selected";
            $hide_status = "";
        } else {
            
            $show_status = "";
            $hide_status = "selected=selected";
            
        }
        
        echo '<select name="bwl_advanced_faq_options[bwl_advanced_faq_search_status]">	 
	<option value="1" ' . $show_status . '>Display Search Box </option>	 
	<option value="0" ' . $hide_status . '>Hide Search Box</option>
        </select>';
        
        
    }    
    
    /**
    * @Description: Meta Info Settings
    * @Created At: 08-04-2013
    * @Last Edited AT: 04-04-2013
    * @Created By: Mahbub
    **/
    
    function bwl_meta_info_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_meta_info_status  = 1; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_meta_info_status'])) { 
            
            $bwl_advanced_faq_meta_info_status = $bwl_advanced_faq_options['bwl_advanced_faq_meta_info_status'];
            
        }
        
        
        if($bwl_advanced_faq_meta_info_status == 1) {
            $show_status = "selected=selected";
            $hide_status = "";
        } else {
            
            $show_status = "";
            $hide_status = "selected=selected";
            
        }
        
        echo '<select name="bwl_advanced_faq_options[bwl_advanced_faq_meta_info_status]">	 
	<option value="1" ' . $show_status . '>Show</option>	 
	<option value="0" ' . $hide_status . '>Hide</option>
        </select>';
        
    }    
    
    /**
    * @Description: Like Button Enable/Disable
    * @Created At: 08-04-2013
    * @Last Edited AT: 04-11-2013
    * @Created By: Mahbub
    **/
    
    function bwl_like_button_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_like_button_status  = 1; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_like_button_status'])) { 
            
            $bwl_advanced_faq_like_button_status = $bwl_advanced_faq_options['bwl_advanced_faq_like_button_status'];
            
        }
        
        
        if($bwl_advanced_faq_like_button_status == 1) {
            $show_status = "selected=selected";
            $hide_status = "";
        } else {
            
            $show_status = "";
            $hide_status = "selected=selected";
            
        }
        
        echo '<select name="bwl_advanced_faq_options[bwl_advanced_faq_like_button_status]">	 
	<option value="1" ' . $show_status . '>Display Like Button</option>	 
	<option value="0" ' . $hide_status . '>Hide Like Button</option>
        </select>';
        
        
    }    
    
    /**
    * @Description: FAQ Login required settings.
    * @Created At: 08-04-2013
    * @Last Edited AT: 26-06-2013
    * @Created By: Mahbub
    **/
    
    function bwl_faq_logged_in_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_logged_in_status  = 1; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_logged_in_status'])) { 
            
            $bwl_advanced_faq_logged_in_status = $bwl_advanced_faq_options['bwl_advanced_faq_logged_in_status'];
            
        }        
        
        
        if($bwl_advanced_faq_logged_in_status == 1) {
            $show_status = "selected=selected";
            $hide_status = "";
        } else {
            
            $show_status = "";
            $hide_status = "selected=selected";
            
        }
        
        echo '<select name="bwl_advanced_faq_options[bwl_advanced_faq_logged_in_status]">	 
                    <option value="1" ' . $show_status . '>Required (Recommended) </option>	 
                    <option value="0" ' . $hide_status . '>Not Required</option>
                 </select>';
        
        
    }
    
    
    /**
    * @Description: FAQ Captcha settings.
    * @Created At: 08-04-2013
    * @Last Edited AT: 26-06-2013
    * @Created By: Mahbub
    **/
    
    function bwl_faq_captcha_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_captcha_status  = 1; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_captcha_status'])) { 
            
            $bwl_advanced_faq_captcha_status = $bwl_advanced_faq_options['bwl_advanced_faq_captcha_status'];
            
        }        
        
        
        if($bwl_advanced_faq_captcha_status == 1) {
            $show_status = "selected=selected";
            $hide_status = "";
        } else {
            
            $show_status = "";
            $hide_status = "selected=selected";
            
        }
        
        echo '<select name="bwl_advanced_faq_options[bwl_advanced_faq_captcha_status]">	 
                    <option value="1" ' . $show_status . '>Enable (Recommended) </option>	 
                    <option value="0" ' . $hide_status . '>Disable</option>
                 </select>';
        
        
    }
    
    /**
    * @Description: FAQ Email Notification Settings.
    * @Created At: 08-04-2013
    * @Last Edited AT: 26-06-2013
    * @Created By: Mahbub
    **/
    
    function bwl_faq_email_notification_settings() {
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_email_notification_status  = 1; 
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_email_notification_status'])) { 
            
            $bwl_advanced_faq_email_notification_status = $bwl_advanced_faq_options['bwl_advanced_email_notification_status'];
            
        }        
        
        
        if($bwl_advanced_faq_email_notification_status == 1) {
            $show_status = "selected=selected";
            $hide_status = "";
        } else {
            
            $show_status = "";
            $hide_status = "selected=selected";
            
        }
        
        echo '<select name="bwl_advanced_faq_options[bwl_advanced_email_notification_status]">	 
                    <option value="1" ' . $show_status . '>Yes (Recommended) </option>	 
                    <option value="0" ' . $hide_status . '>No</option>
                 </select>';
        
        
    }
    
    /**
     * Add the settings page to the admin menu
     */
    
    function bwl_advanced_faq_settings_submenu() {
        
        add_submenu_page(
                'edit.php?post_type=bwl_advanced_faq', __('BWL Advanced FAQ Manager Settings.', 'bwl-adv-faq'), __('FAQ Settings', 'bwl-adv-faq'), 'administrator', 'bwl-advanced-faq-settings', 'bwl_advanced_faq_settings'
        );        
        
    }

    add_action('admin_menu', 'bwl_advanced_faq_settings_submenu');
    
    
    add_action('admin_init', 'register_settings_and_fields')
 
?>