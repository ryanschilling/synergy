<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-content">
      <?php get_template_part('templates/featured-image'); ?>
      <?php the_content(); ?>
    </div>
    <footer>
    	<div class="row">
	    	<div class="col-xs-12 col-sm-5 col-md-6 col-lg-7">
	    		<?php get_template_part('templates/entry-meta'); ?>
	    	</div>
	    	<div class="col-xs-12 col-sm-7 col-md-6 col-lg-5">
	    		<br class="visible-xs">
	    		<a href="/support/request-a-callback" class="btn btn-lg btn-danger btn-block"><i class="fa fa-fw fa-phone"></i> Request a Call Back</a>
	    	</div>
	    	<div class="col-xs-12">
	    		<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
	    	</div>
	    </div>
    </footer>
  </article>
<?php endwhile; ?>
