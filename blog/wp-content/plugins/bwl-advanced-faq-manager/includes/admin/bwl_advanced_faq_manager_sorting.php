<?php

//Integrate sorting section in Menu//

add_action('admin_menu', 'bwl_advanced_faq_sort_page_add');

function bwl_advanced_faq_sort_page_add() {

    wp_enqueue_style('bwl-advanced-faq-admin-style' , BWL_BAFM_PLUGIN_DIR . 'css/faq-admin-style.css');    
    wp_enqueue_style( 'bwl-advanced-faq-color-picker', BWL_BAFM_PLUGIN_DIR . 'css/colorpicker.css' );    
    wp_enqueue_style( 'bwl-advanced-faq-editor-style' , BWL_BAFM_PLUGIN_DIR . 'tinymce/css/bwl-advanced-faq-editor.css' );    
    wp_enqueue_style( 'bwl-advanced-faq-multiple-select', BWL_BAFM_PLUGIN_DIR . 'tinymce/css/multiple-select.css' );
    
    wp_register_script( 'bwl-advanced-theme-colorpicker', BWL_BAFM_PLUGIN_DIR . 'js/colorpicker.js', array('jquery'), '', FALSE );  
    wp_enqueue_script('bwl-advanced-theme-colorpicker');
    
    wp_register_script( 'bwl-advanced-faq-multiple-select', BWL_BAFM_PLUGIN_DIR . 'tinymce/js/jquery.multiple.select.js', array('jquery'), '', FALSE );  
    wp_enqueue_script('bwl-advanced-faq-multiple-select');
    
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-dropable');
    wp_enqueue_script('jquery-ui-dragable');
    wp_enqueue_script('jquery-ui-selectable');
    wp_enqueue_script('jquery-ui-sortable');
    wp_register_script('bwl-advanced-faq-sorting', BWL_BAFM_PLUGIN_DIR . 'js/bwl_faq_sorting.js', array('jquery', 'jquery-ui-core'), false, true);
    wp_enqueue_script('bwl-advanced-faq-sorting');
    
    add_submenu_page('edit.php?post_type=bwl_advanced_faq', __('FAQ Sorting', 'bwl-adv-faq'), __('FAQ Sorting', 'bwl-adv-faq'), 'edit_posts', 'bwl_advanced_faq_sort', 'bwl_advanced_faq_sort_page');
    
}

function bwl_advanced_faq_sort_page() {

    $args = array(
        'post_type' => 'bwl_advanced_faq',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);
?>
    	<div class="wrap">
                
                        <div id="icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>
                        
                        <h2><?php _e('FAQ Sorting', 'bwl-adv-faq')?></h2>
                        
                        <p><?php _e('Sorting FAQ by drag-n-drop. Items at the top will be appear in first.' , 'bwl-adv-faq'); ?></p>
                        
                        <p id="sort-status"><strong><?php _e('Saved', 'bwl-adv-faq')?> !</strong></p>

                        <div class="faq-sort-container">
                        
                        <ul id="bwl_faq_items">
                            
    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                                         
                                            <li id="<?php the_id(); ?>" class="menu-item">
                                                <dl class="menu-item-bar">
                                                    <dt class="menu-item-handle">
                                                        <span class="menu-item-title"><?php the_title(); ?></span>
                                                    </dt>
                                                </dl>
                                                <ul class="menu-item-transport"></ul>
                                            </li>
                                         
        <?php endwhile;
    endif; ?>           
                            
                        </ul>
                            
                         </div>   
                        
    	</div>

    <?php wp_reset_query();  //reset the query   ?>

    <script>

            jQuery(document).ready(function($) {
                bwl_items_sort('#bwl_faq_items', 'bwl_advanced_faq_apply_sort');
            });

    </script>
            
    <?php wp_reset_postdata(); ?>
            
    <?php
}

function bwl_advanced_faq_apply_sort() {

    global $wpdb;

    $order = explode(',', $_POST['order']);
    $counter = 0;

    foreach ($order as $bwl_faq_id) {

        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $bwl_faq_id));
        $counter++;
    }

    die();
}

add_action('wp_ajax_bwl_advanced_faq_apply_sort', 'bwl_advanced_faq_apply_sort');

add_action('wp_ajax_nopriv_bwl_advanced_faq_apply_sort', 'bwl_advanced_faq_apply_sort');
?>
