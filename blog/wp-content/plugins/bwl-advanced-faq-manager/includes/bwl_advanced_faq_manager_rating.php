<?php

$timebeforerevote = 120; // = 2 hours  

function bwl_check_already_voted( $post_id )  {
    
    global $timebeforerevote;  
  
    // Retrieve post votes IPs  
    $meta_IP = get_post_meta($post_id, "voted_IP");
    
    $vote_count = get_post_meta($post_id, "votes_count", true);
    
    
    if( $vote_count == "" || $vote_count == 0 ) {
        return false;
    }
    
    
    if( !empty($meta_IP)) {
        
        $voted_IP = $meta_IP[0];  
        
    } else {
        
         $voted_IP = array();  
         
    } 
          
    // Retrieve current user IP  
    $ip = $_SERVER['REMOTE_ADDR'];  
  
    // If user has already voted  
    if ( in_array($ip, array_keys($voted_IP)) ) {
        
        $time = $voted_IP[$ip];
        
        $now = time();  
          
        // Compare between current time and vote time 
        
        if( round(($now - $time) / 60) > $timebeforerevote )
            
            return false;  
              
        return true;  
    }  
      
    return false;  
}

function bwl_get_rating_interface($post_id)  {

    $vote_count = get_post_meta($post_id, "votes_count", true);
   
    $output = '<hr class="ultra-fancy-hr" />';
    
    $output .= '<p class="post-like">'; 
    
    if ( bwl_check_already_voted( $post_id ) &&  $vote_count != "" && $vote_count != 0 ) :
        
        $output .= '<h4 class="post-like-status">You have already liked it!</h4><span title="'.__('I like this faq', 'bwl-adv-faq').'" class="like alreadyvoted"></span>';  
    
    else  :
        
        $output .= '<a href="#" data-post_id="'.$post_id.'"> 
                    <span title="'.__('I like this faq', 'bwl-adv-faq').' "class="like"></span> 
                </a>';
    
    endif;
    
    
    if( $vote_count != "" && $vote_count != 0 ) {
    
        $output .= '<span class="count">' . "$vote_count ". __("people found this faq useful.", 'bwl-adv-faq') . '</span></p>';
    
    } else {
        
        $output .= '<span class="count">' . __("Be the first person to like this faq.", 'bwl-adv-faq') . '</span></p>';  
        
    }

    return $output;
    
}

add_action('wp_head', 'bwl_faq_set_ajax_url');

function bwl_faq_set_ajax_url() {
    
?>
    <script type="text/javascript">
        
         var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>',
               err_faq_question = '<?php _e('Question Title Required Minimum 3 Characters!', 'bwl-adv-faq')?>',
               err_faq_category = '<?php _e('Select FAQ Category!', 'bwl-adv-faq')?>',
               err_faq_captcha = '<?php _e(' Incorrect Captcha Value!', 'bwl-adv-faq')?>';
       
    </script>

<?php

}

function bwl_advanced_faq_apply_rating() {

     if( isset($_REQUEST['post_like']) ) {

        // Retrieve user IP address  
         
        $ip          = $_SERVER['REMOTE_ADDR'];
        
        $post_id  = $_POST['post_id'];
        
        $meta_IP = get_post_meta($post_id, "voted_IP");  // Get voters'IPs for the current post  
        
        if (!empty($meta_IP)) {
            
            $voted_IP = $meta_IP[0];
            
        } else {
            
            $voted_IP = array();
            
        }

        $rate_counter = get_post_meta($post_id, "votes_count", true);  

        if( ! bwl_check_already_voted($post_id) ) {
            
            $voted_IP[$ip] = time();  

            // Save IP and increase votes count
            
            update_post_meta($post_id, "voted_IP", $voted_IP);  
            update_post_meta($post_id, "votes_count", ++$rate_counter);
            
            $data = array (
                'status'           => 1,
                'rate_counter' => $rate_counter,
                'msg'              => __(' Thank For Your Rating!', 'bwl-adv-faq')
            );
            
        } else  {
            
             $data = array (
                'status'            => 0,
                'rate_counter'   => $rate_counter,
                'msg'               => __(' You have already give rating!', 'bwl-adv-faq')
            );
             
        }
        
        echo json_encode($data);
    }
    
    die();
    
}

add_action('wp_ajax_bwl_advanced_faq_apply_rating', 'bwl_advanced_faq_apply_rating');

add_action( 'wp_ajax_nopriv_bwl_advanced_faq_apply_rating', 'bwl_advanced_faq_apply_rating' );

?>