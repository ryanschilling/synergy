<div id="carousel-home" class="banner slide slider" data-ride="carousel">
    <ol class="carousel-indicators">
      <?php for($x=0;$x<3;$x++): ?>
        <li data-target="#carousel-home" data-slide-to="<?=$x?>" class="<?=$x==0 ? 'active' : ''?>"></li>
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

    <a class="left carousel-control" href="#carousel-home" data-slide="prev">
      <span class="fa fa-3x fa-chevron-circle-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-home" data-slide="next">
      <span class="fa fa-3x fa-chevron-circle-right"></span>
    </a>
</div>