<footer class="footer" role="contentinfo">
  <div class="widgets">
		<div class="container">
			<div class="row">
				<?php dynamic_sidebar('sidebar-widgets'); ?>
			</div>
		</div>
  </div>
  <div class="container">
  	<div class="row">

  		<div class="recent-post">
  			<?php
  			query_posts( 'posts_per_page=1' );
  			if (have_posts()) :
  				while (have_posts()) :
  					the_post();
  					echo "<h3>Recent Blog Post</h3>";
  					the_excerpt();
  					echo "<p><a class=\"btn btn-lg btn-primary\" href=\"".get_permalink()."\"><i class=\"fa fa-fw fa-comment\"></i> Contine reading</a></p>";
  				endwhile;
  			endif;
				rewind_posts();
				?>
  		</div>

  		<div class="quick-links">
  			<div class="row">
  				<div class="col-sm-4">
  					<h3>Quick Links</h3>
  				</div>
  				<div class="col-sm-8">
  					<nav class="social">
	  					<?php
			          if (has_nav_menu('social_navigation')) :
			            wp_nav_menu(array('theme_location' => 'social_navigation', 'menu_class' => ''));
			          endif;
			        ?>
			        <ul><li>Share your Synergy Story</li></ul>
			      </nav>
  				</div>
  			</div>
  			<div class="row">
  				<nav class="column">
		        <?php
		          if (has_nav_menu('quicklinks_navigation_1')) :
		            wp_nav_menu(array('theme_location' => 'quicklinks_navigation_1', 'menu_class' => ''));
		          endif;
		        ?>
		      </nav>
		      <nav class="column">
		        <?php
		          if (has_nav_menu('quicklinks_navigation_2')) :
		            wp_nav_menu(array('theme_location' => 'quicklinks_navigation_2', 'menu_class' => ''));
		          endif;
		        ?>
		      </nav>
		      <nav class="column">
		        <?php
		          if (has_nav_menu('quicklinks_navigation_3')) :
		            wp_nav_menu(array('theme_location' => 'quicklinks_navigation_3', 'menu_class' => ''));
		          endif;
		        ?>
		      </nav>
  			</div>
  		</div>
  	</div>

	  <div class="legal">
	    <div class="copyright">
	      <p>&copy; 2001-<?php echo date('Y'); ?> Synergy Telecom, Inc. <span class="hidden-xs hidden-sm">All rights reserved.</span></p>
	      <nav class="links">
		      <?php
		          if (has_nav_menu('footer_navigation')) :
		            wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => ''));
		          endif;
		      ?>
	      </nav>
	    </div>
	    <div class="leadhub">
	    	<p>Design by <a href="http://leadhub.net" target="_blank">Leadhub</a></p>
	    </div>
	  </div>
	</div>
</footer>

<?php wp_footer(); ?>