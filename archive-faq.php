<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, there are no FAQs in the knowledge base at this time.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/faq'); ?>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Previous FAQs', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('More FAQs &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>