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

  <?php if(is_front_page()): ?>
  <div id="carousel-home" class="banner slide" data-ride="carousel">

      <ol class="carousel-indicators">
        <?php for($x=0;$x<3;$x++): ?>
          <li data-target="#carousel-example-generic" data-slide-to="<?=$x?>" class="<?=$x==0 ? 'active' : ''?>"></li>
        <?php endfor; ?>
      </ol>

      <div class="carousel-inner">
        <?php for($x=1;$x<=3;$x++): $img = get_field('home_slide'.$x.'_image'); ?>
          <div class="item <?=$x==1 ? 'active' : ''?>">
            <div class="container">
              <div class="jumbotron" style="background-image: url('<?=$img['url']?>');">
                <h1><?=html_entity_decode(get_field('home_slide'.$x.'_headline', 4))?></h1>
                <p><?=html_entity_decode(get_field('home_slide'.$x.'_subtitle', 4))?></p>
                <p><a href="<?=get_field('home_slide'.$x.'_link', 4)?>" class="btn btn-danger btn-lg" role="button"><?=get_field('home_slide'.$x.'_button', 4)?> <i class="fa fa-fw fa-chevron-circle-right"></i></a></p>
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>

      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="fa fa-3x fa-chevron-circle-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="fa fa-3x fa-chevron-circle-right"></span>
      </a>

  </div>
  <?php else: ?>
  <div id="carousel-page" class="banner slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item active">
        <div class="container">
          <div class="jumbotron" style="background-image: url('<?=$img['url']?>');">
            <h1><?=roots_title()?></h1>
            <?php if(get_field('page_subtitle')): ?>
              <p><?=html_entity_decode(get_field('page_subtitle'))?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

</header>