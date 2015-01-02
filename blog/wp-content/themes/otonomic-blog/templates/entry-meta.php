<div class="post-meta">
    <time class="post-meta-published" datetime="<?php echo get_the_time('c'); ?>"><span class="glyphicons clock"></span><?php echo get_the_date(); ?></time>
    <span class="post-meta-author"><span class="glyphicons old_man"></span><?php the_author_link(); ?></span>
    <span class="post-meta-tags"><span class="glyphicons bookmark"></span><?php echo get_the_tag_list('',', ',''); ?></span>
    <span class="post-meta-categories"><span class="glyphicons show_big_thumbnails"></span><?php echo get_the_category_list(', '); ?></span>
    <!-- <p class="byline author vcard"><?php echo __('By', 'roots'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a></p> -->
</div>