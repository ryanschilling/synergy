<div class="breadcrumbs hidden-xs" xmlns:v="http://rdf.data-vocabulary.org/#">
  <div class="container">
  	<div class="row">
  		<div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
        <?php roots_breadcrumbs(); ?>
      </div>
  		<div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
        <nav class="social">
          <?php
          if (has_nav_menu('social_navigation')) :
            wp_nav_menu(array('theme_location' => 'social_navigation', 'menu_class' => ''));
          endif;
          ?>
    			<ul><li>Share this online</li></ul>
    		</nav>
    	</div>
    </div>
  </div>
</div>