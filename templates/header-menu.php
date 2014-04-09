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

  <div id="menu-solutions-dropdown">
    <div class="menu-well">
      <div class="menu-dropdown">
        <div class="menu-block">
          <?php $item = get_post(21); ?>
          <h3><?=$item->post_title?></h3>
          <div class="panel">
            <div class="panel-body">
              <a href="<?=get_permalink($item->ID)?>">
                <?=get_the_post_thumbnail($item->ID, 'panel-image'); ?>
                <div class="overlay"><i class="fa fa-fw fa-4x fa-<?=get_field('embed_icon', $item->ID); ?>"></i></div>
              </a>
            </div>
          </div>
          <p><?=($item->post_excerpt) ? $item->post_excerpt : substr(strip_tags($item->post_content), 0, 200).'...'?></p>
          <p>
            <a href="<?=get_permalink($item->ID)?>">
              <?=get_field('embed_button', $item->ID); ?>
              <i class="fa fa-fw fa-<?=get_field('embed_icon', $item->ID); ?>"></i>
            </a>
          </p>
        </div>
        <div class="menu-block">
          <?php $item = get_post(23); ?>
          <h3><?=$item->post_title?></h3>
          <div class="panel">
            <div class="panel-body">
              <a href="<?=get_permalink($item->ID)?>">
                <?=get_the_post_thumbnail($item->ID, 'panel-image'); ?>
                <div class="overlay"><i class="fa fa-fw fa-4x fa-<?=get_field('embed_icon', $item->ID); ?>"></i></div>
              </a>
            </div>
          </div>
          <p><?=($item->post_excerpt) ? $item->post_excerpt : substr(strip_tags($item->post_content), 0, 200).'...'?></p>
          <p>
            <a href="<?=get_permalink($item->ID)?>">
              <?=get_field('embed_button', $item->ID); ?>
              <i class="fa fa-fw fa-<?=get_field('embed_icon', $item->ID); ?>"></i>
            </a>
          </p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12">
              <?php $item = get_post(25); ?>
              <h3><?=$item->post_title?></h3>
              <p>
                <?=($item->post_excerpt) ? $item->post_excerpt : substr(strip_tags($item->post_content), 0, 200).'...'?>
                <a href="<?=get_permalink($item->ID)?>">
                  <?=get_field('embed_button', $item->ID); ?>
                  <i class="fa fa-fw fa-<?=get_field('embed_icon', $item->ID); ?>"></i>
                </a>
              </p>
              <ul class="nav">
                <?php
                $terms = get_terms('case-study-industry', 'hide_empty=0');
                foreach($terms as $item): ?>
                  <li><a href="<?=get_term_link($item)?>"><?=$item->name?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-12">
              <h3>Case Studies</h3>
              <?php $item = get_post(274); ?>
              <p><?=($item->post_excerpt) ? $item->post_excerpt : substr(strip_tags($item->post_content), 0, 200).'...'?></p>
              <p>
                <a href="<?=get_permalink($item->ID)?>">
                  Learn more about <?=$item->post_title?>
                  <i class="fa fa-fw fa-chevron-right"></i>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-banner">
      <div class="menu-banner-text">
        <h4>Synergy is solving business class communications. Are you using VoIP yet?</h4>
      </div>
      <div class="menu-banner-button">
        <a href="#">Request a VoIP Demo</a>
      </div>
    </div>
  </div>

  <?php get_template_part('templates/header', 'banner'); ?>

</header>