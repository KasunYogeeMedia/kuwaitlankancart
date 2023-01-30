<?php

get_header();
$sidebar_configs = vegan_get_woocommerce_layout_configs();

?>

<?php do_action( 'vegan_woo_template_main_before' ); ?>

<section id="main-container" class="main-content <?php echo apply_filters('vegan_woocommerce_content_class', 'container');?>">
	<div class="row">
		<?php if ( isset($sidebar_configs['left']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
			  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
				   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
				   	<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>

		<div id="main-content" class="archive-shop col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">

			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					<?php if ( !isset($sidebar_configs['left']) && !isset($sidebar_configs['right']) ) : ?>
						<!-- header for full -->
						<?php
							wc_get_template_part( 'content', 'product_header' );
							
							remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
							remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
							remove_action( 'woocommerce_before_shop_loop', 'vegan_filter_before' , 1 );
							remove_action( 'woocommerce_before_shop_loop', 'vegan_filter_after' , 40 );
							remove_action( 'woocommerce_before_shop_loop', 'vegan_woocommerce_display_modes' , 2 );
						?>
					<?php endif; ?>
					<div id="apus-shop-products-wrapper" class="apus-shop-products-wrapper">
						<?php
                            // Results bar/button
                            wc_get_template_part( 'content', 'product_results_bar' );
                        ?>
						<?php woocommerce_content(); ?>
					</div>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div><!-- #main-content -->
		<?php if ( isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
			  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
				   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
				   	<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php

get_footer();
