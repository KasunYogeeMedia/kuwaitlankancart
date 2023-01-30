<?php

$atts  = array_merge( array(
	'banners' => array()
), $atts);

extract( $atts );

if ( !empty($banners) ): ?>
	<div class="widget widget-ground-banner">
		<div class="no-margin row ">
			<?php foreach ($banners as $banner) { ?>
				<div class="no-padding col-sm-6">
					<div class="no-margin row  ">
						<div class="no-padding col-xs-6 pull-<?php echo esc_attr($banner->image_position); ?>">
							<!-- image -->
							<?php $img = wp_get_attachment_image_src($banner->image, 'full'); ?>
							
							<?php if (isset($banner->link) && $banner->link): ?>
								<a href="<?php echo esc_url($banner->link); ?>" title="<?php echo esc_attr($banner->title); ?>">
									<?php if (isset($img[0]) && $img[0]) { ?>
								    	<?php vegan_display_image($img); ?>
									<?php } ?>
								</a>
							<?php else: ?>
								<?php if (isset($img[0]) && $img[0]) { ?>
							    	<?php vegan_display_image($img); ?>
								<?php } ?>
							<?php endif; ?>
						</div>
						<div class="no-padding col-xs-6 b-absolute-<?php echo esc_attr($banner->image_position); ?>">
							<?php $style = ''; if ($banner->bg_color) {
								$style = ' style="background: '.esc_attr($banner->bg_color).'"';
							} ?>
							<div class="banner-title" <?php echo trim($style); ?>>
								<?php if (isset($banner->link) && $banner->link): ?>
									<a href="<?php echo esc_url($banner->link); ?>" title="<?php echo esc_attr($banner->title); ?>">
										<span><?php echo trim($banner->title); ?></span>
									</a>
								<?php else: ?>
									<span><?php echo trim($banner->title); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php endif; ?>