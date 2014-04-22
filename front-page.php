<div class="blocks">
<?php for($x=1;$x<=3;$x++): ?>
<?php $column = end(get_field('home_column'.$x)); ?>
<div class="block <?=$column->post_type?>">
  <div class="panel">
    <!--
    <div class="panel-heading">
      <h3>
      <?php switch($column->post_type){
      	case 'post':
      		echo 'Blog Post';
      		break;
      	case 'review':
      		echo 'Customer Review';
      		break;
      	case 'training-video':
      		echo 'Video';
      		break;
      	case 'case-study':
      		echo 'Case Study';
      		break;
      	case 'product':
      		echo 'VoIP Product';
      		break;
      	default:
      		if(is_page() && $column->post_parent):
            $parent = get_post($column->post_parent);
            echo $parent->post_title;
          else:
            echo 'Article';
          endif;
      		break;
      } ?></h3>
    </div>
    -->
    <div class="panel-body">
      <a href="<?=get_permalink($column->ID)?>">
        <?=get_the_post_thumbnail($column->ID, 'panel-image'); ?>
        <div class="overlay"><i class="fa fa-fw fa-4x fa-<?=get_field('embed_icon', $column->ID); ?>"></i></div>
      </a>
    </div>
  </div>
  <div class="description">
    <h2><?=$column->post_title; ?></h2>
    <p><?=$column->post_excerpt; ?></p>
    <p>
      <a href="<?=get_permalink($column->ID)?>" class="btn btn-lg btn-primary">
        <i class="fa fa-fw fa-<?=get_field('embed_icon', $column->ID); ?>"></i>
        <?=get_field('embed_button', $column->ID); ?>
      </a>
    </p>
  </div>
</div>
<?php endfor; ?>
</div>