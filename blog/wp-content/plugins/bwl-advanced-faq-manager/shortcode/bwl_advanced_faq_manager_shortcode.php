<?php 
$final_link="0";
add_shortcode('bwla_faq', 'bwla_faq');        
        
function bwla_faq($atts){
    
     $id_prefix = wp_rand();
    
     extract(shortcode_atts(array(
        'post_type'     => 'bwl_advanced_faq',
        'meta_key'         => '',
        'orderby'         => 'menu_order',
        'order'            => 'ASC',
        'limit'              => -1,
        'faq_category' => '',
        'faq_topics'     => '',
        'sbox'            => 1,
        'bwl_tabify'    => 0,
        'list'       => 0,
        'single' => 0,
        'fpid' => 0,
		'open_first'=>0,
		'faq_number'=>0
         
    ), $atts));
    
     // Show Single FAQ. Introduced Version 1.4.9
     
     if( $single == 1 ) {
         
         return get_single_faq_interface($atts);         
         
     }
     
     // New Feature added in version 1.4.6
     
     if( $list == 1 && $faq_category != "" ) {
         return get_list_faq_interface( $atts );
         
     } 
     
     if( $list == 1 && $faq_topics != "" ) {
         return get_list_faq_interface( $atts );
         
     }
     
     
    $faq_category = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $faq_category);
    
    $unique_faq_container_id = wp_rand();
    
    if( $faq_category != "" ) {
        $id_prefix = "category-";
    }
    
    $faq_topics = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $faq_topics);
    
    if( $faq_topics != "" ) {
        $id_prefix = "topic-";
    }
    
    $args = array(
        'post_status'       => 'publish',
        'post_type'         => $post_type,
        'orderby'             => $orderby,
        'order'                => $order,
        'posts_per_page' => $limit,
        'faq_category'      => $faq_category,
        'faq_topics'          => $faq_topics        
    );
    
    if ( isset( $meta_key ) && $meta_key !="" ) {
        $args['meta_key'] = $meta_key;
    }
    
    $loop = new WP_Query($args);
    
    //$output = '<section class="ac-container" container_id="' . $unique_faq_container_id . '">'; //Open the container
    $output = '<div class="panel-group" id="accordion">'; //Open the container
    $count_loops = 0;
    /*------------------------------ Get Options For Search Settings  ---------------------------------*/
    
    $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
    $bwl_advanced_faq_search_status  = 1; 

    if ( isset($bwl_advanced_faq_options['bwl_advanced_faq_search_status'])) { 

        $bwl_advanced_faq_search_status = $bwl_advanced_faq_options['bwl_advanced_faq_search_status'];

    } 
    
    
    if ( $bwl_advanced_faq_search_status && $sbox !=0 ) {
    
    $output .='<form id="live-search" action="" class="bwl-faq-search-panel" method="post">
                        <fieldset>
                            <input type="text" class="text-input" id="bwl_filter_' . $unique_faq_container_id . '" value="" placeholder="' . __('Search...test', 'bwl-adv-faq') . '"/>
                             <span id="bwl-filter-message-' . $unique_faq_container_id . '" class="bwl-filter-message"></span>
                        </fieldset>
                    </form>';
    
    }
    
    /*------------------------------ FAQ Post Date/Time Information ---------------------------------*/
    $bwl_advanced_faq_meta_info_status = 0;
    
     if( isset($bwl_advanced_faq_options['bwl_advanced_faq_meta_info_status'])) { 

        $bwl_advanced_faq_meta_info_status = $bwl_advanced_faq_options['bwl_advanced_faq_meta_info_status'];

    }
    
    $bwl_advanced_faq_meta_info = "";
    $bwl_advanced_faq_show_date_time_interface = "";
    
     /*------------------------------ FAQ Author Information ---------------------------------*/
    
    $bwl_advanced_faq_author_info_interface = "";
    
    /*------------------------------  Direct Post Edit Permission ---------------------------------*/
    
    $bwl_advanced_faq_edit_status  = 0; 
    $bwl_advanced_faq_edit_interface = "";
    
    if ( is_user_logged_in() ) :
        $bwl_advanced_faq_edit_status = 1;        
    endif;
    
    /*------------------------------ Like Button Status ---------------------------------*/
    
    $bwl_advanced_faq_like_button_status  = 1; 
    
    if( isset($bwl_advanced_faq_options['bwl_advanced_faq_like_button_status'])) { 

        $bwl_advanced_faq_like_button_status = $bwl_advanced_faq_options['bwl_advanced_faq_like_button_status'];

    }
    
    $bwl_advanced_faq_like_button_interface = "";
    
    
    
    if ( $loop->have_posts() ) :
        
        $counter = 1; 
        
        while ( $loop->have_posts() ) :
        
            $loop->the_post();   
        
            $post_id = get_the_ID();
            
            if( $bwl_advanced_faq_like_button_status == 1 ) {
        
                $bwl_advanced_faq_like_button_interface = bwl_get_rating_interface( get_the_ID());

            }
            
            // Get Author FAQ Author Information
                
            $bwl_advanced_faq_author = get_post_meta( $post_id, "bwl_advanced_faq_author", true)  ;
            $bwl_advanced_faq_Excert = get_post_meta( $post_id, "Excert", true)  ;

            $bwl_advanced_faq_author_name = ( $bwl_advanced_faq_author == "" ) ? 'Anonymous' : get_the_author_meta( 'display_name' , $bwl_advanced_faq_author ) ;

//                $bwl_advanced_faq_author_info_interface = "<span class='fa fa-user'></span> <a href='". get_author_posts_url( $bwl_advanced_faq_author ) ."'>" . $bwl_advanced_faq_author_name . "</a> &nbsp;";
            //$bwl_advanced_faq_author_info_interface = "<span class='fa fa-user'></span> " . $bwl_advanced_faq_author_name . " &nbsp;";
        
           // Get FAQ Date and Time
        
           // $bwl_advanced_faq_show_date_time_interface = "<span class='fa fa-calendar'></span> " . get_the_date() . " &nbsp;";
        
            // Get FAQ Edit Link
            
            if( $bwl_advanced_faq_edit_status== 1 && current_user_can( 'edit_post', $post_id ) ) {
                $bwl_advanced_faq_edit_url = get_edit_post_link();
                $bwl_advanced_faq_edit_interface = '<span class="fa fa-edit"></span> <a href="'.$bwl_advanced_faq_edit_url.'" target="_blank" title="'.get_the_title().'">' . __('Edit', 'bwl-adv-faq') . '</a>';
            }
            
            if( $bwl_advanced_faq_meta_info_status == 1 ) {
            
                $bwl_advanced_faq_meta_info = "<p class='bwl_meta_info'>" . $bwl_advanced_faq_author_info_interface . $bwl_advanced_faq_show_date_time_interface . $bwl_advanced_faq_edit_interface ."</p>";
            
            }
            $count_loops++;
            //$output .='<div class="bwl-faq-container bwl-faq-container-' . $unique_faq_container_id . '">'.
            $output .='<div class="panel panel-oto">'.
                                //'<input id="ac-' . $id_prefix . $unique_faq_container_id .  get_the_ID() . '" name="accordion-1" type="checkbox" />'.
                                '<div class="panel-heading">'.
                                '<h4 class="panel-title">';
                                //'<label for="ac-' . $id_prefix . $unique_faq_container_id . get_the_ID() . '" label_id="ac-' . $id_prefix .  get_the_ID() . '" parent_container_id="' . $unique_faq_container_id . '"><b>' . get_the_title() . '</b></label>'.
                                if($faq_number%2==0)
								{									
									$class1 = "accordion-toggle collapsed color_accordion";
									$num_class = "num num_color";	
								}
								else
								{									
									$class1="accordion-toggle collapsed";
									$num_class = "num";	
								}
								
								if($count_loops==1 && $open_first==1)
                                    $output .='<div class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$unique_faq_container_id.get_the_ID().'">';
                                else
                                    $output .='<div class="'.$class1.'" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$unique_faq_container_id.get_the_ID().'">';
                                $output.='<span class="'.$num_class.'">'.$count_loops.'</span><span class="title_faq" >'.get_the_title().
                                '</span></div></h4></div>';
								
								
                                if($count_loops==1 && $open_first==1) 
                                    $output .='<div id="collapse'.$unique_faq_container_id.get_the_ID().'" class="panel-collapse collapse in">';
                                else 
                                    $output .='<div id="collapse'.$unique_faq_container_id.get_the_ID().'" class="panel-collapse collapse">';
                                if($bwl_advanced_faq_Excert!="")
                                    $output .='<div class="panel-body">'.$bwl_advanced_faq_Excert.'" <a target="_blank" class="btn btn-oto-white readmore_faq" href="'.get_permalink( $post_id).'"> .....Read More </a>';
                                else
                                    $output .='<div class="panel-body">'.bwl_advanced_faq_excerpt() . $bwl_advanced_faq_meta_info;
                                $output .='</div></div>'.                                
                             '</div>';
            
            $counter++;
            
        endwhile;
        
    else :
            
            $output .= "<p>". __('Sorry, No FAQ Available!', 'bwl-adv-faq') . "</p>";
        
    endif;
	
	
	
    
     //Close the container     ?>


     <?php
    
    /*------------------------------ ADD SEARCH SCRIPT ---------------------------------*/
    
    $noting_found_text = __('Nothing Found!', 'bwl-adv-faq');
    
    $found_text = __('Found', 'bwl-adv-faq');
    
    if ( $bwl_advanced_faq_search_status && $list == 0 ) {
    
        $output .='<script type="text/javascript">jQuery(document).ready(function() {';

       $output .= 'var filter_search_container = jQuery("#bwl_filter_' . $unique_faq_container_id . '");';    

        $output .= 'var faq_search_result_container = jQuery("#bwl-filter-message-' . $unique_faq_container_id . '");';    

        $output .= 'var faq_container = jQuery(".bwl-faq-container-' . $unique_faq_container_id . '");'; 

        $output .= 'filter_search_container.val("");';    

          $output .= 'filter_search_container.keyup(function(){';

            $output .= 'var filter = jQuery.trim( jQuery(this).val() ), count = 0;';

            $output .= 'faq_container.find("label").each(function(){';
            
            $output .= 'var search_string = jQuery(this).text() + jQuery(this).next("article").text();';
                        
                $output .= 'if (search_string.search(new RegExp(filter, "i")) < 0) {';

                    $output .= 'jQuery(this).parent(".bwl-faq-container-' . $unique_faq_container_id . '").slideUp();';

                $output .= '} else {';

                    $output .='jQuery(this).parent(".bwl-faq-container-' . $unique_faq_container_id . '").slideDown();';

                    $output .='count++;'; 

                $output .='}';

            $output .='});';

            $output .='if(count == 0 ) {';

                $output .='faq_search_result_container.html("' . $noting_found_text . '").css("margin-bottom","10px");';

            $output .='} else {';

               $output .='var count_string = (count >1) ? count + " '.__('FAQs !', 'bwl-adv-faq') . '" : count + " '.__('FAQ !', 'bwl-adv-faq') . '";';

                $output .='faq_search_result_container.html("' . $found_text . ' "+ count_string).css("margin-bottom","10px");';

            $output .='}';

            $output .='if( jQuery.trim( filter_search_container.val() ) == "") { ';

                $output .='faq_search_result_container.html("").css("margin-bottom","0px");';

            $output .='}';

        $output .='});';    

        $output .='});</script>';
		
		
    
    }

    /*------------------------------ Start IE7-IE8 Support ---------------------------------*/
    
    $output .= '<!--[if lt IE 9]>
        
                        <script type="text/javascript">
                        
                            jQuery(document).ready(function() {
                            
                                var faq_container_id = jQuery(".bwl-faq-container-' . $unique_faq_container_id . '");
                                    
                                 faq_container_id.find("label").click(function() {    
   
                                   var get_label_id = jQuery(this).attr("label_id");                                   

                                    if( jQuery("article[article_id="+get_label_id+"]").height() == -1 || jQuery("article[article_id="+get_label_id+"]").height() == 0) {
                                    
                                        jQuery("article[article_id="+get_label_id+"]").attr("style","height: auto;visibility: visible");                                   
                                   
                                    } else {
                                  
                                        jQuery("article[article_id="+get_label_id+"]").attr("style","");     

                                   }                                    

                                 });
                            });
                        </script><![endif]-->';
    
    /*------------------------------ End IE7-IE8 Support ---------------------------------*/
    
    wp_reset_query();
	
	
	/*$output.='<div class="row">'.
      '      <div class="col-md-12">'.
 '             <h5>Didn\'t you find your answer? </h5>'.
     '         <div class="row">'.
            '    <div class="col-md-5">'.
              '    <h4 class="contact-title">Send us an Email</h4>'.
           '    </div>'.
          '      <div class="col-md-7">'.
         '         <a href="mailto:support@otonomic.com" class="btn btn-block btn-oto-blue btn-xlarge"><span class="glyphicons message_full"></span> support@otonomic.com</a>'.
   '             </div>'.
        '      </div>'.
          '    <div class="row">'.
               ' <div class="col-md-5">'.
                '  <h4 class="contact-title">Or fill a contact form</h4>'.
               ' </div>'.
              '  <div class="col-md-7">'.
             '     <!-- <a href="#" class="btn btn-block btn-oto-blue btn-xlarge"><span class="glyphicons notes_2"></span> Fill out this form</a> -->'.
            '        <div class="panel-group" id="contactAccordion">'.
                      '  <div class="panel panel-oto panel-blue">'.
                     '     <div class="panel-heading">'.
                    '        <h4 class="panel-title">'.
                   '           <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#contactAccordion" href="#contactAccordion1">'.
                  '              <span class="glyphicons notes_2"></span> Fill out this form'.
                 '             </a>'.
                '            </h4>'.
               '           </div>'.
               '           <div id="contactAccordion1" class="panel-collapse collapse">'.
              '              <div class="panel-body">'.
             '                 <form role="form">'.
            '                        <div class="form-group">'.
                               '         <label for="inputName">Name</label>'.
                              '          <input type="text" class="form-control" id="inputName" placeholder="e.g John Doe">'.
                             '       </div>'.
                            '        <div class="form-group">'.
                           '             <label for="inputEmail">Email</label>'.
                          '              <input type="email" class="form-control" id="inputEmail" placeholder="e.g johndoe@gmail.com">'.
                         '           </div>'.
                        '            <div class="form-group">'.
                       '                 <label for="inputMessage">Whats on your mind</label>'.
                      '                  <textarea name="inputMessage" class="form-control" rows="3" placeholder="Tell us whats bothering you"></textarea>'.
                     '               </div>'.
                    '                <button type="submit" class="btn btn-oto-blue btn-cornered">'.
                   '                     Let us know'.
                  '                  </button>'.
                 '               </form>'.
                '            </div>'.
                '          </div>'.
               '         </div>'.
             '     </div>'.
             '   </div>'.
            '  </div>'.
            '</div>'.
          '</div>';*/
   
    return $output;
?>

<?php    
}


/*------------------------------ For List Items  ---------------------------------*/

function get_list_faq_interface( $atts ) {
    
    extract($atts);
   
    $unique_faq_container_id = wp_rand();
    
    $list_output = '<section class="ac-container" container_id="' . $unique_faq_container_id . '" id="' . $unique_faq_container_id . '">';
    
    $list_inner_output = "";
    
    $list_inner_output .='<form id="live-search" action="" class="bwl-faq-search-panel" method="post">
                        <fieldset>
                            <input type="text" class="text-input" id="bwl_filter_' . $unique_faq_container_id . '" value="" placeholder="' . __('Search...', 'bwl-adv-faq') . '"/>
                             <span id="bwl-filter-message-' . $unique_faq_container_id . '" class="bwl-filter-message"></span>
                        </fieldset>
                    </form>';
    
    
    if ( isset( $atts['faq_topics'] ) ) {
    
        $bwl_faq_topics = explode(',', $atts['faq_topics']);

        foreach ( $bwl_faq_topics as $topics ) {
            
            $topics_info = get_term_by( 'slug', $topics, 'advanced_faq_topics' );
            $term_id_extracted = $topics_info->term_id;
            $val_final = 'advanced_faq_topics_'.$term_id_extracted.'_href';
            $val_final_1 = 'advanced_faq_topics_'.$term_id_extracted.'_label';
            $val_final_2 = 'advanced_faq_topics_'.$term_id_extracted.'_text_for_link_button';
            $query_st = "select * from wp_options where option_name='$val_final' or option_name='$val_final_1' or option_name='$val_final_2' ";
             $ar=mysql_query($query_st);
            while($arr = mysql_fetch_assoc($ar))
            {
                if($arr["option_name"]==$val_final)
                    $final_link = $arr["option_value"];    
                if($arr["option_name"]==$val_final_1)
                    $label_final = $arr["option_value"];    
                if($arr["option_name"]==$val_final_2)
                    $text_final_btn = $arr["option_value"];    
            }
            
            //$topics_link_info = get_options_by( 'option_name', 'advanced_faq_topics_'.$term_id_extracted.'_href','advanced_faq_topics' );
            $list_inner_output .='<h2>'. $topics_info->name.'</h2>';

            $list_inner_output .= do_shortcode( '[bwla_faq faq_topics="' . $topics . '" sbox="0" ]' ) ;
            $list_inner_output .='</div>'.
    '<div class="row">'.
              '<div class="col-md-12">'.
               $label_final.
                '<a class="btn navbar-btn btn-oto-orange" href="'.$final_link.'"> '.$text_final_btn.' </a>'.
              '</div>'.
          '</div>';
        }
    
    } else {
        
        $bwl_faq_category = explode(',', $atts['faq_category']);

        foreach ( $bwl_faq_category as $category ) {
            
            $category_info = get_term_by( 'slug', $category, 'advanced_faq_category' );
            $list_inner_output .='<h2>'. $category_info->name .'</h2>';        

            $list_inner_output .= do_shortcode( '[bwla_faq faq_category="' . $category . '" sbox="0" ]' ) ;

        }
        
    }
    
    $list_output .= $list_inner_output;
    
    $list_output .= '</section><!-- container -->';
    
    $list_output .='<script type="text/javascript">jQuery(document).ready(function() {';
    
    $list_output .= 'jQuery("#bwl_filter_' . $unique_faq_container_id . '").bwlFaqFilter({
                                                unique_id: "' . $unique_faq_container_id . '"
                                            })';   
    
    $list_output .='});</script>';
    
    $list_output.='<div class="row">'.
      '      <div class="col-md-12">'.
 '            <h5>Didn\'t you find your answer? </h5>'.
     '         <div class="row">'.
            '    <div class="col-md-5">'.
              '    <h4 class="contact-title">Send us an Email</h4>'.
           '    </div>'.
          '      <div class="col-md-7">'.
         '         <a href="mailto:support@otonomic.com" class="btn btn-block btn-oto-blue btn-xlarge"><span class="glyphicons message_full"></span> support@otonomic.com</a>'.
   '             </div>'.
        '      </div>'.
          '    <div class="row">'.
               ' <div class="col-md-5">'.
                '  <h4 class="contact-title">Or fill a contact form</h4>'.
               ' </div>'.
              '  <div class="col-md-7">'.
             '     <!-- <a href="#" class="btn btn-block btn-oto-blue btn-xlarge"><span class="glyphicons notes_2"></span> Fill out this form</a> -->'.
            '        <div class="panel-group" id="contactAccordion">'.
                      '  <div class="panel panel-oto panel-blue">'.
                     '     <div class="panel-heading">'.
                    '        <h4 class="panel-title">'.
                   '           <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#contactAccordion" href="#contactAccordion1">'.
                  '              <span class="glyphicons notes_2"></span> Fill out this form'.
                 '             </a>'.
                '            </h4>'.
               '           </div>'.
               '           <div id="contactAccordion1" class="panel-collapse collapse">'.
              '              <div class="panel-body">'.
             '                 <form role="form">'.
            '                        <div class="form-group">'.
                               '         <label for="inputName">Name</label>'.
                              '          <input type="text" class="form-control" id="inputName" placeholder="e.g John Doe">'.
                             '       </div>'.
                            '        <div class="form-group">'.
                           '             <label for="inputEmail">Email</label>'.
                          '              <input type="email" class="form-control" id="inputEmail" placeholder="e.g johndoe@gmail.com">'.
                         '           </div>'.
                        '            <div class="form-group">'.
                       '                 <label for="inputMessage">Whats on your mind</label>'.
                      '                  <textarea name="inputMessage" class="form-control" rows="3" placeholder="Tell us whats bothering you"></textarea>'.
                     '               </div>'.
                    '                <button type="submit" class="btn btn-oto-blue btn-cornered">'.
                   '                     Let us know'.
                  '                  </button>'.
                 '               </form>'.
                '            </div>'.
                '          </div>'.
               '         </div>'.
             '     </div>'.
             '   </div>'.
            '  </div>'.
            '</div>'.
          '</div>';
    return $list_output;
    
}

/*------------------------------ For List Items  ---------------------------------*/

function get_single_faq_interface( $atts ) {
    
    extract(shortcode_atts(array(
        'post_type'     => 'bwl_advanced_faq',
        'limit'              => -1,
        'meta_key'         => '',
        'faq_category' => '',
        'faq_topics'     => '',
        'sbox'            => 0,
        'bwl_tabify'    => 0,
        'list'       => 0,
        'single' => 1,
        'fpid' => 0
         
    ), $atts));
  
    $unique_faq_container_id = wp_rand();
    
    $args = array(
        'post_status'       => 'publish',
        'post_type'         => $post_type,
        'posts_per_page' => 1,
        'p'         => $fpid
    );
    
    if ( isset( $meta_key ) && $meta_key !="" ) {
        $args['meta_key'] = $meta_key;
    }
    
    $id_prefix = 'single-';
    
    $loop = new WP_Query($args);
 
    $output = '<section class="ac-container single-faq-post" container_id="' . $unique_faq_container_id . '">'; //Open the container
    
    /*------------------------------ Get Options For Search Settings  ---------------------------------*/
    
    $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
    $bwl_advanced_faq_search_status  = 1; 

    if ( isset($bwl_advanced_faq_options['bwl_advanced_faq_search_status'])) { 

        $bwl_advanced_faq_search_status = $bwl_advanced_faq_options['bwl_advanced_faq_search_status'];

    } 
    
 
    
    /*------------------------------ FAQ Post Date/Time Information ---------------------------------*/
    $bwl_advanced_faq_meta_info_status = 0;
    
     if( isset($bwl_advanced_faq_options['bwl_advanced_faq_meta_info_status'])) { 

        $bwl_advanced_faq_meta_info_status = $bwl_advanced_faq_options['bwl_advanced_faq_meta_info_status'];

    }
    
    $bwl_advanced_faq_meta_info = "";
    $bwl_advanced_faq_show_date_time_interface = "";
    
     /*------------------------------ FAQ Author Information ---------------------------------*/
    
    $bwl_advanced_faq_author_info_interface = "";
    
    /*------------------------------  Direct Post Edit Permission ---------------------------------*/
    
    $bwl_advanced_faq_edit_status  = 0; 
    $bwl_advanced_faq_edit_interface = "";
    
    if ( is_user_logged_in() ) :
        $bwl_advanced_faq_edit_status = 1;        
    endif;
    
    /*------------------------------ Like Button Status ---------------------------------*/
    
    $bwl_advanced_faq_like_button_status  = 1; 
    
    if( isset($bwl_advanced_faq_options['bwl_advanced_faq_like_button_status'])) { 

        $bwl_advanced_faq_like_button_status = $bwl_advanced_faq_options['bwl_advanced_faq_like_button_status'];

    }
    
    $bwl_advanced_faq_like_button_interface = "";
    
    if ( $loop->have_posts() ) :
        
        $counter = 1; 
        
        while ( $loop->have_posts() ) :
        
            $loop->the_post();   
        
            $post_id = get_the_ID();
            
            if( $bwl_advanced_faq_like_button_status == 1 ) {
        
                $bwl_advanced_faq_like_button_interface = bwl_get_rating_interface( get_the_ID() );

            }
            
            // Get Author FAQ Author Information
                
            $bwl_advanced_faq_author = get_post_meta( $post_id, "bwl_advanced_faq_author", true)  ;

            $bwl_advanced_faq_author_name = ( $bwl_advanced_faq_author == "" ) ? 'Annonymas' : get_the_author_meta( 'display_name' , $bwl_advanced_faq_author ) ;

            $bwl_advanced_faq_author_info_interface = "<span class='fa fa-user'></span> " . $bwl_advanced_faq_author_name . " &nbsp;";
        
           // Get FAQ Date and Time
        
            $bwl_advanced_faq_show_date_time_interface = "<span class='fa fa-calendar'></span> " . get_the_date() . " &nbsp;";
        
            // Get FAQ Edit Link
            
            if( $bwl_advanced_faq_edit_status== 1 && current_user_can( 'edit_post', $post_id ) ) {
                $bwl_advanced_faq_edit_url = get_edit_post_link();
                $bwl_advanced_faq_edit_interface = '<span class="fa fa-edit"></span> <a href="'.$bwl_advanced_faq_edit_url.'" target="_blank" title="'.get_the_title().'">' . __('Edit', 'bwl-adv-faq') . '</a>';
            }
            
            if( $bwl_advanced_faq_meta_info_status == 1 ) {
            
                $bwl_advanced_faq_meta_info = "<p class='bwl_meta_info'>" . $bwl_advanced_faq_author_info_interface . $bwl_advanced_faq_show_date_time_interface . $bwl_advanced_faq_edit_interface ."</p>";
            
            }
            
            $output .='<div class="bwl-faq-container bwl-faq-container-' . $unique_faq_container_id . '">'.
                                '<input id="ac-' . $id_prefix . $unique_faq_container_id .  get_the_ID() . '" name="accordion-1" type="checkbox" />'.
                                '<label for="ac-' . $id_prefix . $unique_faq_container_id . get_the_ID() . '" label_id="ac-' . $id_prefix .  get_the_ID() . '" parent_container_id="' . $unique_faq_container_id . '"><b>' . get_the_title() . '</b></label>'.
                                '<article class="ac-medium" article_id="ac-' . $id_prefix .  get_the_ID() . '">' . bwl_advanced_faq_excerpt() . $bwl_advanced_faq_meta_info . $bwl_advanced_faq_like_button_interface . '</article>'.                                
                             '</div>';
            
            $counter++;
            
        endwhile;
        
    else :
            
            $output .= "<p>". __('Sorry, No FAQ Available!', 'bwl-adv-faq') . "</p>";
        
    endif;
    
    $output .= '</section>'; //Close the container     
    
    wp_reset_query();
    
    return $output;
    
    
    
}

?>