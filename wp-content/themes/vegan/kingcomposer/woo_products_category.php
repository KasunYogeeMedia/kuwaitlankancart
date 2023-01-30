<?php

$atts  = array_merge( array(
	'title' => '',
	'icon_image' => '',
	'bg_color' => '',
	'number'  => 8,
	'columns'	=> 4,
	'category'	=> '',
	'type' => 'recent_product',
	'layout_type' => 'layout1',
	'rows' => 1,
	'image1' => '',
	'image2' => '',
), $atts);
extract( $atts );

$categories = array();
if (!empty($category) ) {
	$categories[] = $category;
}
$style = '';
if (!empty($bg_color)) {
	$style = 'style="background: '.esc_attr($bg_color).';"';
}
$loop = apus_themer_get_products( $categories, $type, 1, $number );
?>
<div class="widget_products_categories widget widget_products">

    <div class="widget-content woocommerce">
        <?php if ( $loop->have_posts() ): ?>
        	<?php if ($layout_type == 'layout1'): ?>
            	<div class="row table-fix">
                    <div class="col-md-2">
                		<div class="title_products_categories" <?php echo trim($style); ?>>
                            <div>
                                <?php $img = wp_get_attachment_image_src($icon_image, 'full'); ?>
                                <?php if( isset($img[0]) ) { ?>
                                    <img src="<?php echo esc_url_raw($img[0]);?>" alt="" class="image-icon">
                                <?php } elseif( $icon ) { ?>
                                    <i class="fa <?php echo esc_attr($icon); ?>"></i>
                                <?php } ?>

                                <?php if( !empty($title) ) { ?>
                                    <h3><?php echo trim($title); ?></h3>
                                <?php } ?>
                            </div>
                        </div>
            		</div>
            		<div class="col-md-10">
            			<?php wc_get_template( 'layout-products/grid.php' , array( 'loop' => $loop, 'columns' => $columns ) ); ?>
            		</div>
            	</div>
        	<?php elseif ($layout_type == 'layout2'): ?>
        		<div class="row table-fix">
                    <div class="col-md-2  hidden-lg hidden-md">
                        <div class="title_products_categories" <?php echo trim($style); ?>>
                            <div>
                                <?php $img = wp_get_attachment_image_src($icon_image, 'full'); ?>
                                <?php if( isset($img[0]) ) { ?>
                                    <img alt="" src="<?php echo esc_url_raw($img[0]);?>" title="<?php echo esc_attr($title); ?>" class="image-icon">
                                <?php } elseif( $icon ) { ?>
                                    <i class="fa <?php echo esc_attr($icon); ?>"></i>
                                <?php } ?>

                                <?php if( !empty($title) ) { ?>
                                    <h3><?php echo trim($title); ?></h3>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
            		<div class="col-md-10">
            			<?php wc_get_template( 'layout-products/grid.php' , array( 'loop' => $loop, 'columns' => $columns ) ); ?>
            			<div class="banner-images row">
            				<?php $img = wp_get_attachment_image_src($image1, 'full'); ?>
	            			<?php if( isset($img[0]) ) { ?>
	            				<div class="col-md-6">
									<img src="<?php echo esc_url_raw($img[0]);?>" class="image-icon" alt="">
								</div>
							<?php } ?>

							<?php $img = wp_get_attachment_image_src($image2, 'full'); ?>
	            			<?php if( isset($img[0]) ) { ?>
	            				<div class="col-md-6">
									<img src="<?php echo esc_url_raw($img[0]);?>" class="image-icon" alt="">
								</div>
							<?php } ?>
            			</div>
            		</div>
            		<div class="col-md-2 hidden-sm hidden-xs">
                        <div class="title_products_categories" <?php echo trim($style); ?>>
                            <div>
                    			<?php $img = wp_get_attachment_image_src($icon_image, 'full'); ?>
                    			<?php if( isset($img[0]) ) { ?>
        							<img alt="" src="<?php echo esc_url_raw($img[0]);?>" title="<?php echo esc_attr($title); ?>" class="image-icon">
        						<?php } elseif( $icon ) { ?>
        						 	<i class="fa <?php echo esc_attr($icon); ?>"></i>
        						<?php } ?>

        						<?php if( !empty($title) ) { ?>
        							<h3><?php echo trim($title); ?></h3>
        						<?php } ?>
                            </div>
                        </div>
            		</div>
            	</div>
        	<?php elseif ($layout_type == 'layout3'): ?>
        		<div class="row table-fix">
            		<div class="col-md-2">
                        <div class="title_products_categories" <?php echo trim($style); ?>>
                            <div>
                    			<?php $img = wp_get_attachment_image_src($icon_image, 'full'); ?>
                    			<?php if ( isset($img[0]) ) { ?>
        							<img src="<?php echo esc_url_raw($img[0]);?>" alt="" class="image-icon">
        						<?php } elseif( $icon ) { ?>
        						 	<i class="fa <?php echo esc_attr($icon); ?>"></i>
        						<?php } ?>

        						<?php if ( !empty($title) ) { ?>
        							<h3><?php echo trim($title); ?></h3>
        						<?php } ?>
                            </div>
                        </div>
            		</div>
            		<div class="col-md-10">
            			<div class="row">
                        <div class="layout-fix">
            				<?php $count = 0; while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
            					<?php if ($count == 0): ?>
            						<div class="col-md-6">
            							<?php wc_get_template_part( 'item-product/inner-v1' ); ?>
            						</div>
        						<?php else: ?>
    								<div class="col-md-3 col-sm-6 col-xs-6">
    									<?php wc_get_template_part( 'item-product/inner' ); ?>
    								</div>
            					<?php endif; ?>
            				<?php $count++; endwhile; ?>
                        </div>
            			</div>
            			<?php wp_reset_postdata(); ?>
            		</div>
            	</div>
        	<?php else: ?>
        		<div class="row table-fix">
                    <div class="col-md-2 hidden-lg hidden-md">
                        <div class="title_products_categories" <?php echo trim($style); ?>>
                            <div>
                                <?php $img = wp_get_attachment_image_src($icon_image, 'full'); ?>
                                <?php if ( isset($img[0]) ) { ?>
                                    <img src="<?php echo esc_url_raw($img[0]);?>" alt="" class="image-icon">
                                <?php } elseif( $icon ) { ?>
                                    <i class="fa <?php echo esc_attr($icon); ?>"></i>
                                <?php } ?>

                                <?php if ( !empty($title) ) { ?>
                                    <h3><?php echo trim($title); ?></h3>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
            		<div class="col-md-10">
            			<div class="row">
                            <div class="layout-fix">
                				<?php $count = 0; $j = 0; while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                					<?php if ( $count <= 4 ): ?>
    	            					<?php if ($count <= 3): ?>
    		            					<?php if ($count == 0): ?>
    		            						<div class="col-md-6">
    		            						<div class="row">
    		        						<?php endif; ?>
    		            							<div class="col-md-6 col-sm-6 col-xs-6">
    			            							<?php wc_get_template_part( 'item-product/inner' ); ?>
    			            						</div>
    		        						<?php if ($count == 3 || $j == ($loop->post_count - 1) ): ?>
    		        							</div>
    		        							</div>
    		        						<?php endif; ?>
    		            				<?php else: ?>
    	    								<div class="col-md-6">
    	    									<?php wc_get_template_part( 'item-product/inner-v1' ); ?>
    	    								</div>
    	            					<?php endif; ?>
                					<?php else: ?>
                						<div class="col-md-3 ">
        									<?php wc_get_template_part( 'item-product/inner' ); ?>
        								</div>
                					<?php endif; ?>

                				<?php $count++; $j ++; endwhile; ?>
                            </div>
            			</div>
            			<?php wp_reset_postdata(); ?>
            		</div>
            		<div class="col-md-2 hidden-sm hidden-xs">
                        <div class="title_products_categories" <?php echo trim($style); ?>>
                            <div>
                    			<?php $img = wp_get_attachment_image_src($icon_image, 'full'); ?>
                    			<?php if ( isset($img[0]) ) { ?>
        							<img src="<?php echo esc_url_raw($img[0]);?>" alt="" class="image-icon">
        						<?php } elseif( $icon ) { ?>
        						 	<i class="fa <?php echo esc_attr($icon); ?>"></i>
        						<?php } ?>

        						<?php if ( !empty($title) ) { ?>
        							<h3><?php echo trim($title); ?></h3>
        						<?php } ?>
                            </div>
                        </div>
            		</div>
            	</div>
        	<?php endif; ?>
        <?php endif; ?>
    </div>

</div>