<div class="row">
  <div class="col-xs-12">
    <?php  while (have_posts()) : the_post(); ?>
	
	
	<div class="media blog-item white-holder">

	<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
	    <a class="pull-left" href="<?php the_permalink(); ?>">
	        <?php the_post_thumbnail('homepage-thumb',array( 'alt' => false )); ?>
	    </a>
    <?php } ?>

    <div class="media-body">
        <h1 class="media-heading"><?php the_title(); ?></h1>
        <p class="post-meta">By <?php the_author_link(); ?>  •  <?php echo get_the_date(); ?></p>
        <hr style="margin-bottom:20px;margin-top:-8px;">
        <?php //the_excerpt();
		the_content();
		 ?>
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
 
     <!-- <article <?php post_class(); ?>>
        <div class="entry-content">
          <?php //the_content(); ?>
        </div>
      </article>-->
    <?php endwhile; ?>
  </div>
</div>
<style>
.otonomic-blog .blog-item {height:auto !important;}
.blog_title_color{color:#006699;font-size:18px;}
</style>
