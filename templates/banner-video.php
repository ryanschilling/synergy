<div id="carousel-landing" class="banner slide video" data-ride="carousel">
  <div class="carousel-inner">
    <div class="item active">
      <div class="container">
        <div 
        <?php $img = get_field('page_banner_image');
          if(!empty($img)): ?>
          style="background-image: url('<?=$img['url']?>');"
        <?php endif; ?>
        class="jumbotron">
          <div class="row">
            <div class="description">
              <h1><?=roots_title()?></h1>
              <?=roots_subtitle()?>
              <?php if(get_field('cta_url')): ?>
                <p><a href="<?=get_field('cta_url')?>" class="btn btn-lg btn-danger"><?=get_field('cta_label')?></a></p>
              <?php endif; ?>
            </div>
            <div class="player">
              <?php the_post_video(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>