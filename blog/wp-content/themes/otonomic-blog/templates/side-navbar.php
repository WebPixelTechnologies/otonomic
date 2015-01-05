<!--<div id="sidebar-wrapper">
      <ul class="sidebar-nav">
          <li class="sidebar-login">
            <a href="/shared/facebook_login.php" class="facebook_connect sidebar-link track_event" data-target="" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Login" data-ajax-track="1">
              <div class="sidebar-icon"><span class="glyphicon glyphicon-user"></span></div>Login
            </a>
          </li>
		  </ul>
</div>
--><div id="sidebar-wrapper">
<?php
$defaults = array(
	'theme_location'  => 'primary_navigation',
	'menu'            => '',
	'container'       => 'div',
	'container_class' => 'sidebar-wrapper',
	'container_id'    => '',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul class="sidebar-nav">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);
wp_nav_menu( $defaults );
?>
</div>

<!--<div id="sidebar-wrapper">
      <ul class="sidebar-nav">
          <li class="sidebar-login">
            <a href="/shared/facebook_login.php" class="facebook_connect sidebar-link track_event" data-target="" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Login" data-ajax-track="1">
              <div class="sidebar-icon"><span class="glyphicon glyphicon-user"></span></div>Login
            </a>
          </li>
          <li>
            <a href="<?php echo site_url();?>/features" class="sidebar-link track_event" data-target="features" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Features" data-ajax-track="1">
              <div class="sidebar-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon1.png" alt="Features"></div>Features
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-link track_event" data-target="reviews" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Reviews" data-ajax-track="1">
              <div class="sidebar-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon2.png" alt="Reviews"></div>Reviews
            </a>
          </li>-->
          <!-- <li>
            <a href="#" class="sidebar-link track_event" data-target="media-links" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Media" data-ajax-track="1">
              <div class="sidebar-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon3.png" alt="In the media"></div>In the media
            </a>
          </li> -->
          <!--<li>
            <a href="#" class="sidebar-link track_event" data-target="about" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="About" data-ajax-track="1">
              <div class="sidebar-icon about"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon4.png" alt="About"></div>About
            </a>
          </li> 
          <li>
            <a href="/pages/jobs" target="_blank" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Jobs">
                <div class="sidebar-icon jobs"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon5.png" alt="Jobs"></div>Come work with us
            </a>
          </li>
          <li>
            <a href="/pages/blog" target="_blank" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Blog">
                <div class="sidebar-icon blog"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon6.png" alt="Blog"></div>Blog
            </a>
          </li>
          <li>
            <a href="/pages/support-center" target="_blank" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Support">
                <div class="sidebar-icon blog"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon7.png" alt="Support"></div>Support
            </a>
          </li>
           <li>
            <a href="/pages/support-center" target="_blank" id="more" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="More">
                <div class="sidebar-icon more"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon-more.png" alt="More"></div>More
            </a>
          </li>
          <li class="hidden-option">
            <a href="/pages/support-center" target="_blank" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Success Stories">
                <div class="sidebar-icon stories"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon8.png" alt="Success Stories"></div>Success Stories
            </a>
          </li>
          <li class="hidden-option">
            <a href="/pages/support-center" target="_blank" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Our Designs">
                <div class="sidebar-icon designs"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon9.png" alt="Our Designs"></div>Our Designs
            </a>
          </li>
          <li class="hidden-option">
            <a href="/pages/support-center" target="_blank" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Website Examples">
                <div class="sidebar-icon examples"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon10.png" alt="Website Examples"></div>Website Examples
            </a>
          </li>
          <li class="hidden-option">
            <a href="/pages/support-center" target="_blank" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Domain Names">
                <div class="sidebar-icon domain"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon11.png" alt="Domain Names"></div>Domain Names
            </a>
          </li>
          <li class="hidden-option">
            <a href="/pages/support-center" target="_blank" class="sidebar-link track_event" data-ga-category="Marketing Website" data-ga-event="Menu Usage" data-ga-label="Contact Us">
                <div class="sidebar-icon contact"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/sidebar-icon12.png" alt="Contact Us"></div>Contact Us
            </a>
          </li>
      </ul>
</div>-->