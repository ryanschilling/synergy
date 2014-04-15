<header class="header" role="banner">
  
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-2x fa-fw fa-bars"></i>
      </button>
      <nav class="social">
        <?php
          if (has_nav_menu('social_navigation')) :
            wp_nav_menu(array('theme_location' => 'social_navigation', 'menu_class' => ''));
          endif;
        ?>
      </nav>
      <nav class="utility">
        <?php
          if (has_nav_menu('utility_navigation')) :
            wp_nav_menu(array('theme_location' => 'utility_navigation', 'menu_class' => ''));
          endif;
        ?>
      </nav>

      <a class="logo" href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>"><span><?php bloginfo('name'); ?></span></a>

      <div class="call-number">
        <h3><i class="fa fa-phone"></i> Call <a style="font-weight: 700" href="tel:+12104388647">(210) GET-VOIP</a>
        <span class="hidden-xs">
          <small>OR</small>
          <a href="/support/request-a-quote" class="btn btn-lg btn-danger" style="font-weight: 600">Order Online <i class="fa fa-fw fa-chevron-circle-right"></i></a></h3>
        </span>
      </div>
    </div>
  </div>

  <div class="menu">
    <div class="container">
      <nav class="collapse navbar-collapse" role="navigation">
        <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => ''));
          endif;
        ?>
      </nav>
    </div>
  </div>

  <?php get_template_part('templates/dropdown', 'solutions'); ?>

  <?php get_template_part('templates/header', 'banner'); ?>

</header>