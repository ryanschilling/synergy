<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, there no case studies for <em>'.single_term_title('', false).'</em> available at this time.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/case-study'); ?>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Previous Case Studies', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('More '.single_term_title('', false).' &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>