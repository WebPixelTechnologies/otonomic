<div class="row">
<div class="col-xs-12">
<?php 
wp_reset_query();
 global $my_query, $paged;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args=array(               
			'paged' => $paged,
			'posts_per_page' => 10,
			//'caller_get_posts'=>1
		);
	$my_query = new WP_Query($args);
	
	if( $my_query->have_posts() )
	{
		$i=0;
		//echo '<div class="row">';
		while ($my_query->have_posts()) : $my_query->the_post();
		$i++;
	?>
<div class="media blog-item white-holder">
		<?php if ( has_post_thumbnail() )
			{ // check if the post has a Post Thumbnail assigned to it. ?>
				<a class="pull-left" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('homepage-thumb',array( 'alt' => false )); ?>
				</a>		
		<?php 
			} 
		?>
		
	<div class="media-body">
		<h4 class="media-heading">
			<a href="<?php the_permalink(); ?>" title="Read more">
				<?php the_title(); ?>
			</a>
		</h4>
        
		<p class="post-meta">
			By <?php the_author_link(); ?>  •  <?php echo get_the_date(); ?>
		</p>
        <hr style="margin-bottom:20px;margin-top:-8px;">
		<?php the_excerpt(); ?>
	</div>
	<div class="post-shares">
		 <?php 
		 $val=file_get_contents("http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls=".get_permalink());
	
	$value = json_decode($val);
	$share_count = $value[0]->share_count;
	if($share_count)
	{ 
		echo $share_count." Shares";
	}
	?> 
	</div>	
</div>
<?php if($i%2==0)
	{
		//display button after every 2 blogs ?>
		<div class="create-website-block" align="center">
            <span>1-click website from your facebook page</span>
            <a href="http://otonomic.com/" class="btn btn-oto-orange">Create Your Website Now</a>
            
         </div>
	<?php 
	}
	?>
<?php
		endwhile;
	?>
	<nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link( '&larr; Older posts', $my_query->max_num_pages); //next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;',$my_query->max_num_pages)); ?></li>
    </ul>
  </nav>
	<?php
		//echo "</div>";
	} //if ($my_query)$my_query->max_num_pages
	
wp_reset_postdata(); 
 ?> 
</div>
</div>

 
