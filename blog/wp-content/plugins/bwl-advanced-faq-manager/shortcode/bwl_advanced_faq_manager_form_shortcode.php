<?php

add_shortcode('bwla_form','bwl_advanced_faq_front_end_form');

function bwl_advanced_faq_front_end_form($atts) {
    
    $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
    
    $captcha_status = 1;
    
    if ( isset( $bwl_advanced_faq_options['bwl_advanced_faq_captcha_status'] ) ) { 
        
        $captcha_status = $bwl_advanced_faq_options['bwl_advanced_faq_captcha_status'];
        
    }
 
    $login_required = TRUE; // Default we required logged in to post a new faq.
    
    if( is_user_logged_in() ) {
                
        $login_required = FALSE;

    }    
    
    
    
    if ( isset( $bwl_advanced_faq_options['bwl_advanced_faq_logged_in_status'] ) ) { 
         
        if ( $bwl_advanced_faq_options['bwl_advanced_faq_logged_in_status'] == 1 ) {
            
            if( is_user_logged_in() ) {
                
                $login_required = FALSE;
                
            }            
            
        } else  {
            
            $login_required = FALSE;
            
        }            
        
    }
    
    
   if ( $login_required == FALSE ) :
    
   $bwl_faq_categories_counter = get_categories('post_type=bwl_advanced_faq&taxonomy=advanced_faq_category&order=DESC');
 
    if( count($bwl_faq_categories_counter) == 0) {
 
        wp_insert_term(
          'General', // the term 
          'advanced_faq_category', // the taxonomy
          array(
            'description'=> 'First FAQ Category.',
            'slug' => 'general',
            'parent'=> 0
          )
        );
 
    }
    
    $bwl_faq_categories = wp_dropdown_categories( 'post_type=bwl_advanced_faq&show_option_none='.__('Category', 'bwl-adv-faq') . '&tab_index=4&taxonomy=advanced_faq_category&echo=0&hide_empty=0' );
    
    $bwl_advanced_faq_form_id = wp_rand();    
    
    if ( $captcha_status == 1 ) :
        
        $bwl_captcha_generator = '<p>
                                                <label for="captcha">' . __('Captcha:', 'bwl-adv-faq') . '</label>
                                                    <input id="num1" class="sum" type="text" name="num1" value="' . rand(1,4) . '" readonly="readonly" /> +
                                                    <input id="num2" class="sum" type="text" name="num2" value="' . rand(5,9) . '" readonly="readonly" /> =
                                                    <input id="captcha" class="captcha" type="text" name="captcha" maxlength="2" />
                                                    <input id="captcha_status" type="hidden" name="captcha_status" value="' . $captcha_status . '" />
                                                <span id="spambot"> '. __('Verify Human or Spambot ?', 'bwl-adv-faq') .'</span>
                                            </p>';    
        
    else:        
        
        $bwl_captcha_generator = '<input id="captcha_status" type="hidden" name="captcha_status" value="' . $captcha_status . '" />';    
        
    endif;
    
    $bwla_form_body = '<section class="bwl-faq-form-container" id="' . $bwl_advanced_faq_form_id . '">
                    
                                        <h2>' . __('Add A New FAQ Question !', 'bwl-adv-faq') . ' </h2>

                                        <div class="bwl-faq-form-message-box"></div>
                                            
                                        <form id="bwl_advanced_faq_form" class="bwl_advanced_faq_form" name="bwl_advanced_faq_form" method="post" action="#"> 
                                        
                                                <p>        
                                                    <label for="title">' . __('Question Title: ', 'bwl-adv-faq') . '</label>
                                                    <input type="text" id="title" value="" name="title"/>                                      

                                               <p>
                                                    <label for="cat">' . __('Category:', 'bwl-adv-faq') . '</label>'
                                                    . $bwl_faq_categories . 
                                                '</p>

                                                ' . $bwl_captcha_generator . '

                                                <p align="left">
                                                    <input type="submit" value="' . __('Submit FAQ', 'bwl-adv-faq') . '" tabindex="6" id="submit" name="submit" bwl_advanced_faq_form_id= "' . $bwl_advanced_faq_form_id . '" />
                                                </p>

                                                <input type="hidden" name="post_type" id="post_type" value="bwl_advanced_faq" />

                                                <input type="hidden" name="action" value="bwl_advanced_faq" />'

                                                . wp_nonce_field( 'name_of_my_action','name_of_nonce_field' ) .
            
                                           '</form>

                                        </section>';
    
    else:
        
        $bwla_form_body = '<p>' . __("Log In is required for submitting new FAQ.", 'bwl-adv-faq') . '</p>';
        
    endif;
    
    return $bwla_form_body;

}

function bwl_advanced_faq_save_post_data() {    
    
     if (empty($_REQUEST) || !wp_verify_nonce($_REQUEST['name_of_nonce_field'], 'name_of_my_action')) {
         
        $status = array(
            'bwl_faq_add_status' => 0
        );
         
     } else {
    
        $post = array(
            'post_title'            =>   wp_strip_all_tags( $_REQUEST['title'] ),
            'tax_input'            => array('advanced_faq_category' => $_REQUEST['cat']), // Usable for custom taxonomies too 
            'post_status'        => 'pending', // Choose: publish, preview, future, etc.
            'post_type'          => $_REQUEST['post_type']  // Use a custom post type if you want to
        );
      
        $post_id = wp_insert_post($post);            
        
        $status = array(
            'bwl_faq_add_status' =>1
        );
        
        //Send Email to administrator.
        
        $bwl_send_email_status = TRUE; // Initally We send email when user post a new faq.
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
    
        if ( isset($bwl_advanced_faq_options['bwl_advanced_email_notification_status'] ) && $bwl_advanced_faq_options['bwl_advanced_email_notification_status'] == 0) { 
            
            $bwl_send_email_status = FALSE;
            
        }
        
        if ( $bwl_send_email_status == TRUE ) {
            
            $to =  get_bloginfo( 'admin_email' );
            $email = "user@email.com";
            $subject = __('New FAQ submited!', 'bwl-adv-faq');
            $edit_faq_url =  get_admin_url() . "post.php?post&#61;$post_id&#38;action&#61;edit";

            $body = "<p>". __("Hello Administrator", 'bwl-adv-faq') . ",<br>" . __("A new faq has been submitted by a user.", 'bwl-adv-faq') . "</p>";         
            $body .= "<h3>" . __("Submitted FAQ Information", 'bwl-adv-faq') . "</h3><hr />";         
            $body .= "<p><strong>" . __("Title", 'bwl-adv-faq') . ":</strong><br />" . strip_tags( $_REQUEST['title'] ) . "</p>";            
            $body .= "<p><strong>" . __("FAQ Status", 'bwl-adv-faq') . ":</strong> " . __("Pending", 'bwl-adv-faq') . "</p>";
            $body .= "<p><strong>" . __("Review FAQ", 'bwl-adv-faq') . ":</strong> " . $edit_faq_url . "</p>";
            $body .= "<p>" . __("Thank You!", 'bwl-adv-faq') . "</p>"; 
            
            $headers[]= "From: New FAQ Question <$email>";
            
            add_filter( 'wp_mail_content_type', 'bwl_adv_faq_set_html_content_type' );
            
            wp_mail ( $to, $subject, $body, $headers );
            
            remove_filter ( 'wp_mail_content_type', 'bwl_adv_faq_set_html_content_type' );
            
        }

    }
    
    echo json_encode($status);
    
    die();
    
}

/**
* @Description: Add A filter for sending HTML email.
* @Created At: 08-04-2013
* @Last Edited AT: 30-06-2013
* @Created By: Mahbub
**/

 function bwl_adv_faq_set_html_content_type() {
   return 'text/html';
}
 
add_action('wp_ajax_bwl_advanced_faq_save_post_data', 'bwl_advanced_faq_save_post_data');

add_action( 'wp_ajax_nopriv_bwl_advanced_faq_save_post_data', 'bwl_advanced_faq_save_post_data' );

?>