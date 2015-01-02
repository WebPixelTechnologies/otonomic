<?php
/**
 * Custom functions
 */
// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '... <a class="moretag" href="'. get_permalink($post->ID) . '">Read More <span class="glyphicon glyphicon-play"></span></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');