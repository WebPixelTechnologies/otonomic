<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>

<?php 
if(is_page('Home'))
{
	get_template_part('templates/content', 'home');
}

?>
