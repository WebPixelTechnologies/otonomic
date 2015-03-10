<!-- Side Navbar -->
<?php get_template_part('templates/side-navbar'); ?>
<div class="navbar navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" id="menu-toggle" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target=".sidebar-nav">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="https://otonomic.com"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="otonomic.com"></a>
      <div class="navbar-right" >
        <a href="#" class="btn btn-sm navbar-btn btn-oto-orange hidden-xs">Create Your Website Now</a>
        <a href="#" style="padding-left: 14px;vertical-align: sub;color: #F54500;">Login</a>
      </div>
    </div>
  </div>
</div>
