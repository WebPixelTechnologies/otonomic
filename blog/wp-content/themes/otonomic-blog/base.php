<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>




<div id="main-wrapper" class="otonomic-blog">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <?php if (!is_front_page()) { ?>
          <a href="<?php echo home_url(); ?>/" class="btn-back btn-link"><span class="glyphicons chevron-left"></span>Back</a>
        <?php } ?>
        <h1><?php echo wp_trim_words( roots_title(), $num_words = 9, $more = null ); ?></h1>
        <?php 
            if (is_single()) { 
              while (have_posts()) : the_post(); 
                get_template_part('templates/entry-meta');
              endwhile;
            } 
        ?>
        <!-- Social buttons -->
        <?php get_template_part('templates/social-buttons'); ?>
      </div>
    </div>
  <div class="wrap container" role="document">
    <div class="content row">
      <main class="main <?php echo roots_main_class(); ?>" role="main">
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->
      <?php 
	   if(!is_page_template('template-feature.php'))
		  {
			global $wp_query;
			global $wp;

				if ($wp_query->query_vars['post_type'] != 'feature' ) 
				{ 
				   if (roots_display_sidebar()) : ?>
					<aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
					  <?php 
					  //echo get_page_template();
								  
							  include roots_sidebar_path();
							
					   ?>
					</aside>
					<?php endif; 
		}
		  }
		  else
		  {
			//	  
		  }
		  ?><!-- /.sidebar -->
      
    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>
</div>
</body>
</html>
