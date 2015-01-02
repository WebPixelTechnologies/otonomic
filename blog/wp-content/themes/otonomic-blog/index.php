<?php get_template_part('templates/page', 'header'); ?>

<?php
// set the "paged" parameter (use 'page' if the query is on a static front page)
wp_reset_query();
global $the_query, $paged;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 
 if( roots_title())
 {	
	if(strstr(roots_title(),"Search Results for "))
	{	
		$tag= str_replace("Search Results for ","", roots_title());	
		$mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title LIKE '".$tag."%' ");	
	 	$args = array(
					'post__in'=> $mypostids,
					'showposts'=>'10',
					'order'=>'asc',
					'paged' =>$paged
    			);
    	$the_query = new WP_Query($args);
	}
	else if(strstr(roots_title(),"Archives"))
	{
		$tag= str_replace("Monthly Archives: ","", roots_title());	
		$year = date('Y',strtotime($tag));
		$month = date('M',strtotime($tag));
			
	 	$args = array(
					'post__in'=> $mypostids,
					'showposts'=>'10',
					'order'=>'asc',
					'paged' =>$paged,
					'date_query' => array(
										  array(
											 'year'  => $year,
											 'month' => $month
										  ),
	   								),
    			);
    	$the_query = new WP_Query($args);	
		
		
	}
	else
	{
		$tag= roots_title();	
		$the_query = new WP_Query('showposts=3'  .'&tag='.$tag. '&paged=' . $paged );	
	}
	
 }
 else
 {
// the query
	$the_query = new WP_Query('showposts=3'  . '&paged=' . $paged ); 
 }


?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while ($the_query->have_posts() ) : $the_query->the_post(); ?>
  <?php get_template_part('templates/content', get_post_format()); ?>
<?php endwhile; ?>

<nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link( '&larr; Older posts', $the_query->max_num_pages); //next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;',$the_query->max_num_pages)); ?></li>
    </ul>
</nav>
<?php 
// clean up after the query and pagination
wp_reset_postdata(); 
?>