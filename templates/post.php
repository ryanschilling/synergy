<article <?php post_class(); ?>>
	<header>
	  <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	  <div class="meta">
	    <?php get_template_part('templates/entry-meta'); ?>
	  </div>
	</header>
	<div class="entry-content">
	  <?php get_template_part('templates/featured-image'); ?>
	  <?php the_content(); ?>
	</div>
</article>