<form role="search" method="get" class="search-form form-inline" action="<?php echo home_url('/'); ?>">
  <div class="form-group has-feedback">
    <input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control p2s_fanpages" placeholder="Search Otonomic blog.."> 
	
	<!--placeholder="<?php _e('Search', 'roots'); ?> <?php bloginfo('name'); ?>"-->
    <label class="hide"><?php _e('Search for:', 'roots'); ?></label>
    <span class="glyphicons search form-control-feedback"></span>
    <!-- <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-default"><?php _e('Search', 'roots'); ?></button>
    </span> -->
  </div> 
</form>
