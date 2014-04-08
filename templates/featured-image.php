<?php if(has_post_thumbnail()): $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
	<div class="featured-image">
		<div class="panel-body">
			<?php if(is_archive()): ?>
			<a href="<?php the_permalink(); ?>">
			<?php else: ?>
			<a href="<?php echo $img[0]; ?>" data-toggle="lightbox" data-gallery="gallery-<?=$post->ID?>" data-parent=".content" data-type="image">
			<?php endif; ?>
				<?php 
				switch($post->post_type){
					case 'post':
						$size = is_archive() ? 'blog-thumb' : 'panel-image';
						break;

					case 'case-study':
						$size = is_archive() ? 'panel-image' : 'category-thumb';
						break;

					default:
						$size = 'panel-image';
						break;
				}
				the_post_thumbnail($size); ?>
				<div class="overlay"><i class="fa fa-fw fa-4x fa-<?=(is_archive()) ? get_field('embed_icon') : 'search-plus'; ?>"></i></div>
			</a>
		</div>
	</div>
<?php endif; ?>