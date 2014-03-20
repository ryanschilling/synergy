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

  <div id="carousel-example-generic" class="banner slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <div class="container">
          <div class="jumbotron">
            <h1>High Quality VoIP<br>Business Communications</h1>
            <p>It’s all we do and we’re <em>really</em> good at it.</p>
            <p><a class="btn btn-danger btn-lg" role="button">Is VOIP right for you? <i class="fa fa-fw fa-chevron-circle-right"></i></a></p>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="container">
          <div class="jumbotron">
            <h1>High Quality VoIP<br>Business Communications</h1>
            <p>It’s all we do and we’re <em>really</em> good at it.</p>
            <p><a class="btn btn-danger btn-lg" role="button">Is VOIP right for you? <i class="fa fa-fw fa-chevron-circle-right"></i></a></p>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="container">
          <div class="jumbotron">
            <h1>High Quality VoIP<br>Business Communications</h1>
            <p>It’s all we do and we’re <em>really</em> good at it.</p>
            <p><a class="btn btn-danger btn-lg" role="button">Is VOIP right for you? <i class="fa fa-fw fa-chevron-circle-right"></i></a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
      <span class="fa fa-2x fa-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
      <span class="fa fa-2x fa-chevron-right"></span>
    </a>
  </div>

</header>