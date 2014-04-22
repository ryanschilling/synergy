<div id="menu-support-dropdown">
  <div class="menu-well">
    <div class="menu-dropdown">
      <div class="menu-block">
        <h3><a href="<?=get_post_type_archive_link('training-video')?>">Training Videos</a></h3>
        
        <?php
        // Training video thumb
        $videos = new WP_Query( array('post_type' => 'training-video', 'posts_per_page' => 1) );
        if ( $videos->have_posts() ):
          while ( $videos->have_posts() ):
            $videos->the_post(); ?>
            <div class="panel">
              <div class="panel-body">
                <a href="<?=get_permalink($item->ID)?>">
                  <?=get_the_post_thumbnail($item->ID, 'panel-image'); ?>
                  <div class="overlay"><i class="fa fa-fw fa-4x fa-<?=get_field('embed_icon', $item->ID); ?>"></i></div>
                </a>
              </div>
            </div>
          <?php endwhile;
        endif;
        wp_reset_postdata();
        ?>

        <ul class="nav">
          <?php
          // Training video links
          $videos = new WP_Query( array('post_type' => 'training-video', 'posts_per_page' => 3, 'offset' => 1) );
          if ( $videos->have_posts() ) {
            while ( $videos->have_posts() ) {
              $videos->the_post();
              echo '<li><a href="' . get_permalink() . '"><i class="fa fa-fw fa-film"></i> ' . get_the_title() . '</a></li>';
            }
          }
          wp_reset_postdata();
          ?>
          <li><a href="<?=get_post_type_archive_link('training-video')?>">See all training videos <i class="fa fa-fw fa-chevron-right"></i></a></li>
        </ul>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
        <div class="row">
           <div class="col-sm-12 col-md-6">
              <h3><a href="<?=get_post_type_archive_link('faq')?>">Knowledge Base</a></h3>
              <p><?php $post_type = get_post_type_object('faq'); echo $post_type->description; ?></p>
              <p><a href="<?=get_post_type_archive_link('faq')?>">Get answers to FAQs <i class="fa fa-fw fa-chevron-right"></i></a></p>
            </div>
            <?php get_menu_block(113, 'menu-block-simple'); // Software downloads ?>
            <?php get_menu_block(109, 'menu-block-simple'); // Trouble tickets ?>
            <?php get_menu_block(111, 'menu-block-simple'); // Cbeck for service ?>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <h3>More Support &nbsp;&nbsp;
              <br class="visible-md">
              <br class="visible-sm">
              <small>
                <a href="<?=get_permalink(121)?>"><?=get_the_title(121); // Contact Sales Department ?></a>
                &nbsp;&nbsp; | &nbsp;&nbsp; <a href="<?=get_permalink(119)?>"><?=get_the_title(119); // Request a Quote ?></a>
                &nbsp;&nbsp; | &nbsp;&nbsp; <a href="<?=get_permalink(123)?>"><?=get_the_title(123); // Submit a Review ?></a>
              </small>
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="menu-banner">
    <div class="menu-banner-text">
      <h4>Having trouble with a VOIP system? Get training and technical support by Synergy.</h4>
    </div>
    <div class="menu-banner-button">
      <a href="#">Request a Callback</a>
    </div>
  </div>
</div>