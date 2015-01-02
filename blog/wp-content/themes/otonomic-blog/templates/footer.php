
     <!--<div class="footer">
      <div class="container">
        <div class="row">
          <div class="col-xs12 col-sm-3 hidden-xs">
            <h3>Otonomic</h3>
            <ul class="list-unstyled">
              <li><a href="#">Features</a></li>
              <li><a href="#">Galleries</a></li>
              <li><a href="#">Reviews</a></li>
              <li><a href="#">Price Plans</a></li>
              <li><a href="#">Contact Us</a></li>
              <li><a href="#">About Us</a></li>
              <li><a href="#">Blog</a></li>
            </ul>
          </div>
          <div class="col-xs12 col-sm-5 hidden-xs">
            <h3>People Ask Us</h3>
            <ul class="list-unstyled">
              <li><a href="#">How to make a website for free <br>and also get paid money just for <br>the kicks?</a></li>
              <li><a href="#">How to build a business website <br>without a sweat?</a></li>
              <li><a href="#">How to create a free mobile site</a></li>
              <li><a href="#">How to setup a personal website?</a></li>
            </ul>
          </div>
          <div class="col-xs12 col-sm-4 hidden-xs">
            <h3>Our Services</h3>
            <ul class="list-unstyled">
              <li><a href="#">Facebook to Website</a></li>
              <li><a href="#">Free website for small business</a></li>
              <li><a href="#">Free personal website</a></li>
              <li><a href="#">Free wedding website builder</a></li>
              <li><a href="#">Photography website builder</a></li>
            </ul>
          </div>
        </div>
        <div class="lower-part">
          <!-- Social buttons -->
          <?php // include 'social-buttons.php'; ?>
          <!--©2014 <img src="<?php //echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="otonomic.com"> 
          <a href="#">Terms of Service</a>
          •
          <a href="#">Privacy Policy</a>
        </div>
      </div>
    </div>-->
<?php 
	if(is_active_sidebar('sidebar-footer'))
	{
		dynamic_sidebar('sidebar-footer');
		dynamic_sidebar('sidebar-footer1');
		dynamic_sidebar('sidebar-footer2');
		dynamic_sidebar('sidebar-footer3');
	}
	wp_footer(); 
?>
<script> 
	$(".menu").addClass('list-unstyled');
	$( document ).ready(function() 
	{
		$(".tagcloud a").addClass("btn btn-oto-white");
		$(".tagcloud a").attr("style","");
		$(".widget").removeClass("widget");
	});
</script>
