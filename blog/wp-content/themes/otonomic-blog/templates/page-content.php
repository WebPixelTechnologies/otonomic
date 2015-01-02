<div class="row page-content">	
	<?php  
	$temp = $wp_query; 
	$wp_query= null;

	$wp_query = new WP_Query(); $wp_query->query();

	while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

	  <div class="col-xs-12 col-sm-6 col-md-4 thumbnail-col">
	  <article>
	    <div class="thumbnail">
	      	<?php
		    	if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		    ?>
				  <a href="<?php the_permalink(); ?>" title="Read more"><?php the_post_thumbnail('homepage-thumb'); ?></a>
			<?php
				} 
			?>
	      <div class="caption">
	        <h3><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h3>
	        <p><?php the_excerpt(); ?></p>
	      </div>
	    </div>
	  </article>
	  </div>

	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
