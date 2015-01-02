<?php
//error_reporting(E_ALL);
/**
* Plugin Name: BWL Advanced FAQ Manager
* Plugin URI: http://www.bluewindlab.net
* Description: BWL Advanced FAQ Manager is a cool frequently asked question management plugin for wordpress. It offers faq custom post type that can be used to effortlessly add faq sections to your website.
* Author: Md Mahbub Alam Khan
* Version: 1.5.1
* Author URI: http://www.bluewindlab.net
* WP Requires at least: 3.6+
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/Licenses/gpl-2.0.html
*/

/*  Copyright 2013 Md Mahbub Alam Khan (email : bluewindlab@gmail.com)
    
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.
            
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
        
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class BWL_Advanced_Faq_Manager {
    
    function __construct() {
        
        /*------------------------------ PLUGIN COMMON CONSTANTS ---------------------------------*/
        
        define( "BWL_BAFM_PLUGIN_DIR", plugins_url() .'/bwl-advanced-faq-manager/' );
        $this->include_files();
        $this->register_post_type();
        $this->taxonomies();
        $this->cau();
    }
    
    public function include_files() {
        
        /* ------------------------------ Load Required Files --------------------------------- */

        include_once 'includes/version-manager.php'; // INTEGRATE VERSION MANAGER 
        include_once 'includes/autoupdate/wp_autoupdate.php';  // INTEGRATE AUTO UPDATER [VERSION: 1.5.1]
        
    }
    
    public function cau(){
        
        $wptuts_plugin_current_version = BWL_ADVANCED_FAQ_VERSION_NO; 
        $wptuts_plugin_remote_path = 'http://bpurm.coolajax.net/baf/update.php';
        $wptuts_plugin_slug = plugin_basename(__FILE__);
        new wp_auto_update ($wptuts_plugin_current_version, $wptuts_plugin_remote_path, $wptuts_plugin_slug);
        
    }
    
    
    public function register_post_type() {
        
        /*
         * Custom Slug Section.
         */        
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_custom_slug = "bwl-advanced-faq";
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_custom_slug']) && $bwl_advanced_faq_options['bwl_advanced_faq_custom_slug'] != "" ) {
        
            $bwl_advanced_faq_custom_slug = trim( $bwl_advanced_faq_options['bwl_advanced_faq_custom_slug'] );

        }
        
        $labels = array(
            'name'                         => __('All FAQs', 'bwl-adv-faq'),
            'singular_name'            => __('FAQ', 'bwl-adv-faq'),
            'add_new'                    => __('Add New FAQ', 'bwl-adv-faq'),
            'add_new_item'           => __('Add New FAQ', 'bwl-adv-faq'),
            'edit_item'                   => __('Edit FAQ', 'bwl-adv-faq'),
            'new_item'                  => __('New FAQ', 'bwl-adv-faq'),
            'all_items'                    => __('All FAQs', 'bwl-adv-faq'),
            'view_item'                  => __('View FAQ', 'bwl-adv-faq'),
            'search_items'             => __('Search FAQ', 'bwl-adv-faq'),
            'not_found'                 => __('No FAQ found', 'bwl-adv-faq'),
            'not_found_in_trash'    => __('No FAQ found in Trash', 'bwl-adv-faq'),
            'parent_item_colon'     => '',
            'menu_name'              => __('Advanced FAQ', 'bwl-adv-faq')
        );

        $args = array(
            'labels'                       => $labels,
            'query_var'                => 'advanced_faq',            
            'public'                       => true,        
            'show_ui'                   => true,
            'show_in_menu'         => true,
            'rewrite'                     => array(
                                                 'slug' => $bwl_advanced_faq_custom_slug
                                                ),
            'publicly_queryable'     => true,
            'capability_type'          => 'post',
            'has_archive'              => true,
            'hierarchical'               => false,
            'show_in_admin_bar'  => true,
            'supports'                   => array('title', 'editor'),
            'menu_icon'                => plugin_dir_url( __FILE__ ) . 'images/faq_icon.png'
        );        
      
        register_post_type('bwl_advanced_faq', $args);
        
    }
    
    public function taxonomies() {
        
        /*
         * Custom Slug Section.
         */        
        
        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        $bwl_advanced_faq_custom_slug = "bwl-advanced-faq";
        
        if( isset($bwl_advanced_faq_options['bwl_advanced_faq_custom_slug']) && $bwl_advanced_faq_options['bwl_advanced_faq_custom_slug'] != "" ) {
        
            $bwl_advanced_faq_custom_slug = trim( $bwl_advanced_faq_options['bwl_advanced_faq_custom_slug'] );

        }
        
        $taxonomies = array();
        
        $taxonomies['advanced_faq_category'] = array(
            'hierarchical'      => true,
            'query_var'       => 'faq_category',
            'rewrite'            => array(
                                        'slug' => $bwl_advanced_faq_custom_slug. '-category'
                                        ),            
            'labels'              => array(
                                            'name' => __('FAQ Category', 'bwl-adv-faq'),
                                            'singular_name' => __('Category', 'bwl-adv-faq'),
                                            'edit_item' => __('Edit Category', 'bwl-adv-faq'),
                                            'update_item' =>__('Update category', 'bwl-adv-faq'),
                                            'add_new_item' => __('Add Category', 'bwl-adv-faq'),
                                            'new_item_name' => __('Add New category', 'bwl-adv-faq'),
                                            'all_items' => __('All categories', 'bwl-adv-faq'),
                                            'search_items' => __('Search categories', 'bwl-adv-faq'),
                                            'popular_items' => __('Popular categories', 'bwl-adv-faq'),
                                            'separate_items_with_comments' => __('Separate categories with commas', 'bwl-adv-faq'),
                                            'add_or_remove_items' => __('Add or remove category', 'bwl-adv-faq'),
                                            'choose_from_most_used' => __('Choose from most used categories', 'bwl-adv-faq')
                                        )
                
         );     
        
        //  INTRODUCED CATEGORY FILTERING IN ADMIN PANEL FROM VESTION 1.4.8 VERSION
        
        if(is_admin()) {
            $taxonomies['advanced_faq_category']['query_var'] = TRUE;
        }
        
        $taxonomies['advanced_faq_topics'] = array(
            'hierarchical'      => true,
            'query_var'       => 'faq_topics',            
            'rewrite'            => array(
                                                'slug' => $bwl_advanced_faq_custom_slug. '-topics'
                                            ),            
            'labels'              => array(
                                                'name'                                         => __('FAQ Topics', 'bwl-adv-faq'),
                                                'singular_name'                            => __('Topics', 'bwl-adv-faq'),
                                                'edit_item'                                    => __('Edit Topics', 'bwl-adv-faq'),
                                                'update_item'                               => __('Update Topics', 'bwl-adv-faq'),
                                                'add_new_item'                            => __('Add Topic', 'bwl-adv-faq'),
                                                'new_item_name'                         => __('Add New Topics', 'bwl-adv-faq'),
                                                'all_items'                                     => __('All Topics', 'bwl-adv-faq'),
                                                'search_items'                              => __('Search Topics', 'bwl-adv-faq'),
                                                'popular_items'                             => __('Popular Topics', 'bwl-adv-faq'),
                                                'separate_items_with_comments' => __('Separate Topics with commas', 'bwl-adv-faq'),
                                                'add_or_remove_items'                => __('Add or remove Topics', 'bwl-adv-faq'),
                                                'choose_from_most_used'            => __('Choose from most used Topics', 'bwl-adv-faq')
                                          )
                
        );
        
        //  INTRODUCED TOPICS FILTERING IN ADMIN PANEL FROM VESTION 1.4.8 VERSION
        
        if(is_admin()) {
            $taxonomies['advanced_faq_topics']['query_var'] = TRUE;
        }
        
        $this->register_all_taxonomies($taxonomies);
    }    
    
    public function register_all_taxonomies($taxonomies) {
        
        foreach ($taxonomies as $name=> $arr) {
            register_taxonomy($name, array('bwl_advanced_faq'), $arr);
        }
        
    }
    
}

 /**
    * @Description: Register Scripts & Style
    */

    function bwl_advanced_faq_manager_script_enqueue() {

        $bwl_advanced_faq_options = get_option('bwl_advanced_faq_options');
        
        wp_register_style( 'bwl-advanced-faq-theme', plugin_dir_url( __FILE__ ) . 'css/faq-style.css' );    
        wp_enqueue_style('bwl-advanced-faq-theme');
        
        /*------------------------------  Introduce Font Awesome In Version 1.4.9 ---------------------------------*/
        
        if ( isset($bwl_advanced_faq_options['bwl_advanced_fa_status']) && $bwl_advanced_faq_options['bwl_advanced_fa_status'] == "on" ) {         
        
            wp_register_style( 'bwl-advanced-faq-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css' );    
            wp_enqueue_style('bwl-advanced-faq-font-awesome');
        
        }
        
        wp_register_script( 'bwl-advanced-faq-filter', plugin_dir_url( __FILE__ ) . 'js/bwl_faq_filter.js', array('jquery'), false, true );      
        wp_enqueue_script('bwl-advanced-faq-filter');
        wp_register_script( 'bwl-advanced-like-post', plugin_dir_url( __FILE__ ) . 'js/rating-scripts.js', array('jquery'), false, true );      
        wp_enqueue_script('bwl-advanced-like-post');
        
        $bwl_advanced_modernizr_status = 0; // Introduced in version 1.4.4

        if ( isset($bwl_advanced_faq_options['bwl_advanced_modernizr_status']) && $bwl_advanced_faq_options['bwl_advanced_modernizr_status'] == "on" ) {         

            $bwl_advanced_modernizr_status = 1;

        }

        if( $bwl_advanced_modernizr_status == 1 ) {
            wp_register_script( 'bwl-advanced-faq-modernizr', plugin_dir_url( __FILE__ ) . 'js/modernizr.custom.29473.js', '', '', true );     
            wp_enqueue_script('bwl-advanced-faq-modernizr');  
        }

    }
    
add_action('wp_enqueue_scripts', 'bwl_advanced_faq_manager_script_enqueue');

include_once 'includes/bwl_advanced_faq_manager_custom_theme_generator.php';

include_once 'includes/bwl_advanced_faq_manager_welcome_link_settings.php';

include_once 'includes/bwl_advanced_faq_manager_excerpt_settings.php';


/* ------------------------------ INTEGRATE SHORTCODES --------------------------------- */

include_once 'shortcode/bwl_advanced_faq_manager_shortcode.php';

include_once 'shortcode/bwl_advanced_faq_manager_form_shortcode.php';

/* ------------------------------ INTEGRATE WIDGET --------------------------------- */

include_once 'widget/bwl_advanced_faq_manager_widget.php';

/* ------------------------------ INTEGRATE RATING MANAGER --------------------------------- */

include_once 'includes/bwl_advanced_faq_manager_rating.php';

/* ------------------------------ INTEGRATE FAQ TINY MCE BUTTON --------------------------------- */

 if( is_admin() ) {
            
    include_once 'tinymce/bwl_advanced_faq_manager_tiny_mce_config.php';
    
    include_once 'includes/admin/bwl_advanced_faq_custom_meta_box.php';    

}

/*------------------------------ INTEGREATE FAQ TABIFY  ---------------------------------*/

include_once 'faq-tabify/bwl-faq-tabify.php';

/* ------------------------------ INTEGRATE FAQ SORTING --------------------------------- */

include_once 'includes/admin/bwl_advanced_faq_manager_sorting.php';

/* ------------------------------ INTEGRATE SETTINGS SCREEN --------------------------------- */

include_once 'includes/settings/bwl_advanced_faq_manager_settings.php';

/* ------------------------------ INTEGRATE WELCOME SCREEN --------------------------------- */

include_once 'includes/bwl_advanced_faq_manager_welcome.php';

/* ------------------------------ INTEGRATE CUSTOM COLUMN FOR FAQ --------------------------------- */

include_once 'includes/admin/bwl_advanced_faq_manager_custom_column.php';

/* ------------------------------ INTEGRATE CUSTOM QUICK EDIT SETTING FOR FAQ --------------------------------- */

include_once 'includes/admin/bwl_advanced_faq_manager_quick_edit.php';    

/* ------------------------------ INTEGRATE CUSTOM FILTERING FOR FAQ [VERSION: 1.4.8] --------------------------------- */

include_once 'includes/admin/bwl_advanced_faq_custom_filter.php';    


/*------------------------------  TRANSLATION FILE ---------------------------------*/

load_plugin_textdomain('bwl-adv-faq', FALSE, dirname(plugin_basename(__FILE__)) . '/lang/');

/*------------------------------ INITIALIZATION ---------------------------------*/

function bwl_advanced_faq_manager_init() {
    
    new BWL_Advanced_Faq_Manager();    
    
}

add_action('init', 'bwl_advanced_faq_manager_init');





?>