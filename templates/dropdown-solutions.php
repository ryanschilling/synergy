<div id="menu-solutions-dropdown">
  <div class="menu-well">
    <div class="menu-dropdown">
      <?php get_menu_block(21); // Voip Communications ?>
      <?php get_menu_block(23); // Video Conferencing ?>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-12">
            <?php $item = get_post(25); // Industries ?>
            <h3><a href="<?=get_permalink($item->ID)?>"><?=$item->post_title?></a></h3>
            <p>
              <?=($item->post_excerpt) ? $item->post_excerpt : substr(strip_tags($item->post_content), 0, 200).'...'?>
              <a href="<?=get_permalink($item->ID)?>">
                <?=get_field('embed_button', $item->ID); ?>
                <i class="fa fa-fw fa-<?=get_field('embed_icon', $item->ID); ?>"></i>
              </a>
            </p>
            <ul class="nav">
              <?php // Case studies 
              $terms = get_terms('case-study-industry', 'hide_empty=0');
              foreach($terms as $item): ?>
                <li><a href="<?=get_term_link($item)?>"><?=$item->name?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-12">
            <h3><a href="<?=get_post_type_archive_link('case-study')?>">Case Studies</a></h3>
            <?php $item = get_post(274); // Atlee Development ?>
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