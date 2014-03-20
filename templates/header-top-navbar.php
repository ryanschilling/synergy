<header class="header" role="banner">
  <div class="container">
    <div class="navbar-header">
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
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-fw fa-bars"></i>
      </button>
      <a class="logo" href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>"><span><?php bloginfo('name'); ?></span></a>
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
</header>
