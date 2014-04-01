<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-content">
      <?php get_template_part('templates/featured-image'); ?>
      <?php the_content(); ?>
    </div>
  </article>
<?php endwhile; ?>