<?php if(has_post_thumbnail()): $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'category-thumb'); ?>
	<div class="featured-image">
		<div class="panel-body">
			<a href="<?php echo $img[0]; ?>" data-toggle="lightbox" data-gallery="gallery-<?=$post->ID?>" data-parent=".content" data-type="image">
				<?php the_post_thumbnail(isset($size) ? $size : 'panel-image'); ?>
				<div class="overlay"><i class="fa fa-fw fa-4x fa-search-plus"></i></div>
			</a>
		</div>
	</div>
<?php endif; ?>