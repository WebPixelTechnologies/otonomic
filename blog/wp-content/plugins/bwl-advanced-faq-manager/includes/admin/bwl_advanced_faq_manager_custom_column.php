<?php

 /*------------------------------  Custom Column Section ---------------------------------*/
        
add_filter('manage_bwl_advanced_faq_posts_columns', 'bwl_advanced_faq_custom_column_header' );

function bwl_advanced_faq_custom_column_header( $columns ) {
    
    $columns = array();
    
     $columns['cb'] = 'cb';
     
     $columns['title'] = __('FAQ Title', 'bwl-adv-faq');
     
     $columns['description'] = __('FAQ Answer', 'bwl-adv-faq');
     
     $columns['advanced_faq_category'] = __('FAQ Category', 'bwl-adv-faq');
     
     $columns['advanced_faq_topics'] = __('FAQ Topics', 'bwl-adv-faq');
     
     $columns['bwl_advanced_faq_author'] = __('Author', 'bwl-adv-faq');
     
     $columns['votes_count'] = __('Votes', 'bwl-adv-faq');
     
     $columns['date'] = __('Date', 'bwl-adv-faq');
    
     return $columns;
 }

add_action('manage_bwl_advanced_faq_posts_custom_column', 'bwl_advanced_faq_display_custom_column');
 
function bwl_advanced_faq_display_custom_column( $column ) {
    
    global $post;
    
    switch ( $column ) {
    
    case 'description':
            
            echo bwl_advanced_faq_excerpt(TRUE);
            
            break;
        
    case 'advanced_faq_category':

        $faq_category = "";
        
        $get_faq_categories = get_the_terms( $post->ID , 'advanced_faq_category' );
        
        if ( is_array($get_faq_categories) && count( $get_faq_categories )>0 ) {
            
            foreach ( $get_faq_categories as $category ) {

                $faq_category .= $category->name .",";

            }

            echo substr( $faq_category, 0, strlen( $faq_category )-1 );
            
        } else {
            
            _e('Uncategorized', 'bwl-adv-faq');
            
        }

       break;
        
    case 'advanced_faq_topics':

        $faq_topics = "";
        
        $get_faq_topics = get_the_terms( $post->ID , 'advanced_faq_topics' );
        
        if ( is_array($get_faq_topics) && count( $get_faq_topics )>0 ) {
            
            foreach ( $get_faq_topics as $topic ) {

                $faq_topics .= $topic->name .",";

            }

            echo substr( $faq_topics, 0, strlen( $faq_topics )-1 );
            
        } else {
            
            echo "—";
            
        }

    break;
    
    case 'bwl_advanced_faq_author':
            
            $bwl_advanced_faq_author = get_post_meta($post->ID, "bwl_advanced_faq_author", true)  ;
        
            $bwl_advanced_faq_author_name = ( $bwl_advanced_faq_author == "" ) ? 'Annonymas' : get_the_author_meta( 'display_name' , $bwl_advanced_faq_author ) ;
            
            echo $bwl_advanced_faq_author_name;
            
            break;
        
        
    case 'votes_count':
            
            $votes_count = get_post_meta($post->ID, "votes_count", true)  ;
        
            $votes_count = ( $votes_count == "" ) ? 0 : $votes_count ;
            
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$votes_count;
            
            break;
        
     
            
    }
}

?>
