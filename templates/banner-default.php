<div id="carousel-page" class="banner slide default" data-ride="carousel">
  <div class="carousel-inner">
    <div class="item active">
      <div class="container">
        <div 
        <?php $img = get_field('page_banner_image');
          if(!empty($img)): ?>
          style="background-image: url('<?=$img['url']?>');"
        <?php endif; ?>
        class="jumbotron">
          <h1><?=roots_title()?></h1>
          <?=roots_subtitle()?>
        </div>
      </div>
    </div>
  </div>
</div>