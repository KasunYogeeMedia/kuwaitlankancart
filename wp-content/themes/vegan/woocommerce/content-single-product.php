<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

	$product_version = vegan_get_product_single_version();

	if ($product_version == 'v2') {
		wc_get_template_part( 'content-single-product-v2' );
	} else {
?>

	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product-version-'.$product_version, $product ); ?>>
		<div class="product-header-info">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="image-mains">
							<?php
								/**
								 * woocommerce_before_single_product_summary hook
								 *
								 * @hooked woocommerce_show_product_sale_flash - 10
								 * @hooked woocommerce_show_product_images - 20
								 */
								do_action( 'woocommerce_before_single_product_summary' );
							?>
						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<div class="information">
							<div class="summary entry-summary ">
								<div class="product-navs">
									<?php
										the_post_navigation( array(
											'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'vegan' ) . '</span> ' .
												'<span class="navi">' . esc_html__( 'Next post:', 'vegan' ) . '</span> ' .
												'<span class="post-title">%title</span>',
											'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'vegan' ) . '</span> ' .
												'<span class="navi">' . esc_html__( 'Previous post:', 'vegan' ) . '</span> ' .
												'<span class="post-title">%title</span>',
										) );
									?>
								</div>

								<?php
									/**
									 * woocommerce_single_product_summary hook
									 *
									 * @hooked woocommerce_template_single_title - 5
									 * @hooked woocommerce_template_single_rating - 10
									 * @hooked woocommerce_template_single_price - 10
									 * @hooked woocommerce_template_single_excerpt - 20
									 * @hooked woocommerce_template_single_add_to_cart - 30
									 * @hooked woocommerce_template_single_meta - 40
									 * @hooked woocommerce_template_single_sharing - 50
									 */
									remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
									add_action('woocommerce_single_product_summary','woocommerce_template_single_meta',25);
									do_action( 'woocommerce_single_product_summary' );
								?>
							</div><!-- .summary -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="product-tabs-info">
			<div class="container">
			<?php
				/**
				 * woocommerce_after_single_product_summary hook
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				do_action( 'woocommerce_after_single_product_summary' );
			?>
			</div>
		</div>
		<meta itemprop="url" content="<?php the_permalink(); ?>" />

	</div><!-- #product-<?php the_ID(); ?> -->

	<?php do_action( 'woocommerce_after_single_product' ); ?>
<?php } ?>