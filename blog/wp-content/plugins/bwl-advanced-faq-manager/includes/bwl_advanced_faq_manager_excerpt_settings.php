<?php

/*-----------------------------------------------------------------------------------*/
# Change The Default WordPress Excerpt Length
/*-----------------------------------------------------------------------------------*/

function bwl_advanced_faq_excerpt( $admin_excerpt = FALSE ){

    $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
    
    if($admin_excerpt == TRUE) {
        
        $text = get_the_content();
        
        if (strlen($text) > 150) {
            
            $text = substr($text,0,strpos($text,' ',150)); 
            
        }
        
        $text = $text . ' ...';
        
        return apply_filters('the_excerpt',$text);
        
    } else {
        
         if ( isset( $bwl_advanced_faq_options['bwl_advanced_faq_excerpt_status'] ) && $bwl_advanced_faq_options['bwl_advanced_faq_excerpt_status'] == 1 ) {
        
            $content = get_the_content();
            
            $trimmed_content = wp_trim_words( $content, $bwl_advanced_faq_options['bwl_advanced_faq_excerpt_length'], '..... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'bwl-adv-faq') . ' &raquo; </a>' );
       
            //return $trimmed_content;
			 return $content;

        } else {

            $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
            
            return $content;

        }
        
    }

}

?>
