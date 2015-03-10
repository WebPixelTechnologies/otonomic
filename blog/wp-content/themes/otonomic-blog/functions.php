<?php
/**
 * Roots includes
 */
 add_theme_support( 'post-thumbnails' );
require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/wrapper.php');         // Theme wrapper class
require_once locate_template('/lib/sidebar.php');         // Sidebar class
require_once locate_template('/lib/config.php');          // Configuration
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/titles.php');          // Page titles
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/gallery.php');         // Custom [gallery] modifications
require_once locate_template('/lib/comments.php');        // Custom comments modifications
require_once locate_template('/lib/relative-urls.php');   // Root relative URLs
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions

//add_theme_support( 'post-thumbnails' );

function blog_feature_custom_post() 
	{
	$labels = array(
				'name'               => _x( 'Features', 'post type general name' ),
				'singular_name'      => _x( 'Feature', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'Feature' ),
				'add_new_item'       => __( 'Add New Feature' ),
				'edit_item'          => __( 'Edit Feature' ),
				'new_item'           => __( 'New Feature' ),
				'all_items'          => __( 'All Features' ),
				'view_item'          => __( 'View Feature' ),
				'search_items'       => __( 'Search Features' ),
				'not_found'          => __( 'No Feature found' ),
				'not_found_in_trash' => __( 'No Feature found in the Trash' ), 
				'parent_item_colon'  => '',
				'menu_name'          => 'Feature'
			  );
	$args = array(
				'labels'        => $labels,
				'description'   => 'Holds our Features and Feature specific data',
				'public'        => true,
				'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ,'page-attributes','post-formats' ),
				'has_archive'   => true,
			);
	register_post_type( 'feature', $args ); 
}

add_action( 'init', 'blog_feature_custom_post' );
add_action( 'init', 'create_blog_feature_taxonomies', 0 );

function create_blog_feature_taxonomies()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Feature Category', 'taxonomy general name' ),
    'singular_name' => _x( 'Feature Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Feature Category' ),
    'popular_items' => __( 'Popular Feature Category' ),
    'all_items' => __( 'All Feature Category' ),
    'parent_item' => __( 'Parent Feature Category' ),
    'parent_item_colon' => __( 'Parent Feature Category:' ),
    'edit_item' => __( 'Edit Feature Category' ),
    'update_item' => __( 'Update Feature Category' ),
    'add_new_item' => __( 'Add New Feature Category' ),
    'new_item_name' => __( 'New Feature Category Name' ),
  );
  register_taxonomy('feature_category',array('feature'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'feature_category' ),
  ));
}

/*add_action( 'after_setup_theme', 'register_my_sidebarmenu' );
function register_my_sidebarmenu() {
  register_nav_menu( 'side_bar_menu', 'Side Bar Menu' );
}*/

function roots_excerpt_more_remove($more) 
{
	global $wp_query;
	global $wp;

	if ($wp_query->query_vars['post_type'] != 'feature' ) 
	{
		return ' ';
	}
}
add_filter('excerpt_more', 'roots_excerpt_more_remove');
function otonomic_blog_excerpt_length($length) {
	return 70;
}
add_filter('excerpt_length', 'otonomic_blog_excerpt_length');
