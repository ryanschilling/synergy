<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, there are no products available at this time.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<div class="blocks">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/product'); ?>
  <?php endwhile; ?>
</div>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Previous Products', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('More Products &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>