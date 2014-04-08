<?php

$products = new WP_Query( array('post_type' => 'product', 'orderby' => 'menu_order') );
if ( $products->have_posts() ): ?>
<div id="carousel-products" class="carousel slide slider" data-ride="carousel">
	 <ol class="carousel-indicators">
      <?php for($x=0;$x<ceil($products->post_count / 3);$x++): ?>
        <li data-target="#carousel-products" data-slide-to="<?=$x?>" class="<?=$x==0 ? 'active' : ''?>"></li>
      <?php endfor; ?>
    </ol>
	<div class="carousel-inner">
	<?php $x=0; while ( $products->have_posts() ): $products->the_post(); ?>
		<?php $mod = $x % 3;
		if($mod == 0): ?>
		<?php if($x > 0):?></div></div><?php endif; ?>
		<div class="item <?php if($x == 0): echo 'active'; endif;?>">
			<div class="row">
		<?php endif; ?>
				<div class="product col-sm-4">
					<?php get_template_part('templates/featured-image'); ?>
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<?php the_excerpt(); ?>
					<p>
						<a href="<?php the_permalink(); ?>" class="btn btn-primary">
							<i class="fa fa-fw fa-<?=get_field('embed_icon'); ?>"></i>
							<?=get_field('embed_button'); ?>
						</a>
					</p>
				</div>
			<?php $x++; endwhile; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; wp_reset_postdata(); ?>