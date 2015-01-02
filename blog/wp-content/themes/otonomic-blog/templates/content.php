<div class="media blog-item white-holder">

	<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
	    <a class="pull-left" href="<?php the_permalink(); ?>">
	        <?php the_post_thumbnail('homepage-thumb'); ?>
	    </a>
    <?php } ?>

    <div class="media-body">
        <h4 class="media-heading"><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h4>
        <p class="post-meta">By <?php the_author_link(); ?>  •  <?php echo get_the_date(); ?></p>
        <?php the_excerpt(); ?>
    </div>
    <div class="post-shares">
        <?php 
		 $val=file_get_contents("http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls=".get_permalink());
	
	$value = json_decode($val);
	$share_count = $value[0]->share_count;
	if($share_count)
	{echo $share_count." Shares";}
	?> 
    </div>
</div>