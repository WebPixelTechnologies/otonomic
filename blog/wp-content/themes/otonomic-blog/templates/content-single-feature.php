<?php   
	while (have_posts()) : the_post();  
	?>
	
	<h4><?php echo the_title(); ?></h4>
	<p><?php echo the_content(); ?></p>
			
	<?php
	endwhile; 
?>
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