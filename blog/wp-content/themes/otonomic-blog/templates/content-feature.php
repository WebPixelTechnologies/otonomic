<div class="container">

<?php
	$feature_taxonomy = 'feature_category';
	$feature_terms = get_terms($feature_taxonomy);
	//print_r($feature_terms);
	//echo $feature_terms[0]->taxonomy_image;
	//die;
	if($feature_terms)
	{
		$count=0;
		foreach($feature_terms as $feature_cat_val)	
		{
			
			$count++;
			$type = 'feature';
			$args=array(
				 $feature_taxonomy => $feature_cat_val->slug,
				'post_type' => $type,
				'post_status' => 'publish',
				'posts_per_page' => 10,
				'caller_get_posts'=> 1		
				);
			$my_query = null;
			$my_query = new WP_Query($args);		
			if( $my_query->have_posts() ) 
			{
				?>
			<section class="feature">
			<div class="row">
			  <div class="col-xs-1 hidden-xs">
				<!--<span class="glyphicons kiosk big-icon"></span>-->
				<?php
				if(z_taxonomy_image_url($feature_cat_val->term_id))
				{
				?>
				<img src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($feature_cat_val->term_id); ?>" class="category-img" />
				<?php 
				}
				?>
			  </div>
			  <div class="col-xs-11">
				<h3 class="feature_class"><?php echo $feature_cat_val->name; ?></h3>
			  </div>
			</div>
		<?php 	
		$i=0;
			while ($my_query->have_posts()) : $my_query->the_post(); 
			$i++;
			if($i%2!=0)
			{
				echo '<div class="row">';	
			}
		?>			
			
			  <div class="col-sm-5 col-sm-offset-1">
				<a href="<?php echo the_permalink();?>"><h4><?php echo the_title(); ?></h4></a>
				<p><?php 
				
				the_excerpt();
				
				?></p>
			 </div>
			<?php 
			if($i%2==0)
			{
				echo '</div>';	
			}
			?> 
		<?php
			endwhile;
			}
			if($i%2!=0)
			{
				echo '</div>';		
			}
			if(count($feature_terms)!=$count)
			{
			?>
			<div class="row">
			  <div class="col-sm-11 col-sm-offset-1">
				<span style="margin-right: 10px;">1-click website from your facebook page</span>&nbsp;&nbsp;&nbsp; <a href="http://otonomic.com" class="btn navbar-btn btn-oto-orange">Create Your Website Now</a>
			  </div>
		  </div>
			<?php
			}
		}
		?>
		
		  </section>
		  
		  
		<?php		
	}
?>
</div>    

      
      

<style>
p {
    font-size: 15px;
    font-weight: lighter;
    line-height: 22px;
    margin: 0 0px 17.5px;
	width:105%;
}
.col-md-8 {
    text-align: justify !important;
    width: 90.667% !important;
}
.h3_color{color:#069;}
.smalltitle_color{color:#03C;font-size:19px;}
</style>