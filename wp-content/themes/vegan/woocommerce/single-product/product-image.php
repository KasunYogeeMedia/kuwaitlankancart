<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$productConfig = array(     
  'product_enablezoom'         => 1,
  'product_zoommode'           => 'basic',
  'product_zoomeasing'         => 1,
  'product_zoomlensshape'      => "round",
  'product_zoomlenssize'       => "150",
  'product_zoomgallery'        => 0,
  'enable_product_customtab'   => 0,
  'product_customtab_name'     => '',
  'product_customtab_content'  => '',
  'product_related_column'     => 0,        
);

global $post, $woocommerce, $product;

?>

<div class="images images-swipe">
<?php
	$images = $product->get_gallery_image_ids();
	
	if ( in_array(get_post_thumbnail_id(), $images) ) {
		$attachment_ids = $images;
	} else {
		$attachment_ids =  array_merge_recursive( array( get_post_thumbnail_id() ) , $images ) ;
	}
	$product_version = vegan_get_product_single_version();

  if ( $product_version == 'v2' ) {
    if ( $attachment_ids ) {
      ?>
      <div class="main-image-carousel">
        <?php
            $image_sizes = get_option('shop_single_image_size');
            $data_med_size = $image_sizes['width'] . 'x'. $image_sizes['height'];
            foreach ( $attachment_ids as $attachment_id ) {
                $classes = array( 'thumb-link' );

                $image_full = wp_get_attachment_image_src( $attachment_id, 'full' );
                $image_full_link = isset($image_full[0]) ? $image_full[0] : '';

                if (isset($image_full[1]) && isset($image_full[2]) ) {
                  $data_size = $image_full[1] . 'x' . $image_full[2];
                } else {
                  $data_size = $data_med_size;
                }

                $image_src = wp_get_attachment_image_src( $attachment_id, 'shop_single' );
                $image_link = isset($image_src[0]) ? $image_src[0] : '';

                if ( ! $image_link )
                    continue;

                $image_title    = esc_attr( get_the_title( $attachment_id ) );

                if (vegan_get_config('image_lazy_loading')) {
                  $placeholder_image = vegan_create_placeholder(array($image_src[1],$image_src[2]));
                  $image = '<img src="'.trim($placeholder_image).'" data-src="'.esc_url($image_link).'" class="attachment-shop_single size-shop_single unveil-image" title="'.esc_attr($image_title).'" alt="'.esc_attr($image_title).'">';
                } else {
                  $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0, $attr = array(
                      'title' => $image_title,
                      'alt'   => $image_title
                      ) );
                }

                $class = get_post_thumbnail_id() == $attachment_id ? 'active apus_swipe_image_item' : 'apus_swipe_image_item';
                echo '<div class="image-wrapper">';
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" data-med="%s" data-size="%s" data-med-size="%s" class="%s">%s</a>', $image_link, $image_full_link, $data_size, $data_med_size, $class, $image ), $attachment_id, $post->ID );
                echo '</div>';
            }
        ?>
      </div>
      <?php
    }
  } else {
  	if ( $attachment_ids ) {
  		?>
  		<div class="owl-carousel main-image-carousel" data-smallmedium="1" data-extrasmall="1" data-items="1" data-carousel="owl" data-pagination="true" data-nav="true">
        <?php
            $image_sizes = get_option('shop_single_image_size');
            $data_med_size = $image_sizes['width'] . 'x'. $image_sizes['height'];
            foreach ( $attachment_ids as $attachment_id ) {
                $classes = array( 'thumb-link' );

                $image_full = wp_get_attachment_image_src( $attachment_id, 'full' );
                $image_full_link = isset($image_full[0]) ? $image_full[0] : '';

                if (isset($image_full[1]) && isset($image_full[2]) ) {
                  $data_size = $image_full[1] . 'x' . $image_full[2];
                } else {
                  $data_size = $data_med_size;
                }

                $image_link = wp_get_attachment_image_src( $attachment_id, 'shop_single' );
                $image_link = isset($image_link[0]) ? $image_link[0] : '';

                if ( ! $image_link )
                    continue;

                $image_title    = esc_attr( get_the_title( $attachment_id ) );

                $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0, $attr = array(
                    'title' => $image_title,
                    'alt'   => $image_title
                    ) );

                $class = get_post_thumbnail_id() == $attachment_id ? 'active apus_swipe_image_item' : 'apus_swipe_image_item';
                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" data-med="%s" data-size="%s" data-med-size="%s" class="%s">%s</a>', $image_link, $image_full_link, $data_size, $data_med_size, $class, $image ), $attachment_id, $post->ID );
                
            }
        ?>
      </div>
      <?php
  	}
  	do_action( 'woocommerce_product_thumbnails' );
  }
?>
</div>