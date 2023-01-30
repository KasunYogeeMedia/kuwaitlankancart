<?php

function vegan_woocommerce_setup() {
    global $pagenow;
    if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
        $catalog = array(
            'width'     => '330',   // px
            'height'    => '330',   // px
            'crop'      => 1        // true
        );

        $single = array(
            'width'     => '660',   // px
            'height'    => '660',   // px
            'crop'      => 1        // true
        );

        $thumbnail = array(
            'width'     => '130',    // px
            'height'    => '130',   // px
            'crop'      => 1        // true
        );

        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }
}

add_action( 'init', 'vegan_woocommerce_setup');

// cart modal
if ( !function_exists('vegan_woocommerce_cart_modal') ) {
    function vegan_woocommerce_cart_modal() {
        wc_get_template( 'content-product-cart-modal.php' , array( 'current_product_id' => (int)$_GET['product_id'] ) );
        die;
    }
}

add_action( 'wp_ajax_vegan_add_to_cart_product', 'vegan_woocommerce_cart_modal' );
add_action( 'wp_ajax_nopriv_vegan_add_to_cart_product', 'vegan_woocommerce_cart_modal' );


// hooks
if ( !function_exists('vegan_woocommerce_enqueue_styles') ) {
    function vegan_woocommerce_enqueue_styles() {
        $css_folder = vegan_get_css_folder();
        $js_folder = vegan_get_js_folder();
        $min = vegan_get_asset_min();

        wp_enqueue_style( 'vegan-woocommerce', $css_folder . '/woocommerce'.$min.'.css' , 'vegan-woocommerce-front' , VEGAN_THEME_VERSION, 'all' );
        
        if ( is_singular('product') ) {
            // photoswipe
            wp_enqueue_script( 'photoswipe-js', $js_folder . '/photoswipe/photoswipe'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_script( 'photoswipe-ui-js', $js_folder . '/photoswipe/photoswipe-ui-default'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_script( 'photoswipe-init', $js_folder . '/photoswipe/photoswipe.init'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_style( 'photoswipe-style', $js_folder . '/photoswipe/photoswipe'.$min.'.css', array(), '3.2.0' );
            wp_enqueue_style( 'photoswipe-skin-style', $js_folder . '/photoswipe/default-skin/default-skin'.$min.'.css', array(), '3.2.0' );

            // sticky
            $product_version = vegan_get_product_single_version();
            if ( $product_version == 'v2' ) {
                wp_enqueue_script( 'sticky-kit', $js_folder . '/sticky-kit'.$min.'.js', array( 'jquery' ), '1.1.2', true );
            }
        }

        if ( !vegan_is_wc_quantity_increment_activated() ) {
            wp_enqueue_style( 'vegan-quantity-increment', $css_folder . '/wc-quantity-increment.css');
            wp_enqueue_script( 'vegan-number-polyfill', get_template_directory_uri() . '/js/number-polyfill.min.js', array( 'jquery' ), '20150330', true );
            wp_enqueue_script( 'vegan-quantity-increment', get_template_directory_uri() . '/js/wc-quantity-increment.js', array( 'jquery' ), '20150330', true );
        }

        wp_enqueue_script( 'vegan-woocommerce-script', $js_folder . '/woocommerce'.$min.'.js', array( 'jquery' ), '20150330', true );
        wp_enqueue_script( 'wc-add-to-cart-variation' );
    }
}
add_action( 'wp_enqueue_scripts', 'vegan_woocommerce_enqueue_styles', 150 );

// cart
if ( !function_exists('vegan_woocommerce_header_add_to_cart_fragment') ) {
    function vegan_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['#cart .count'] =  sprintf(_n(' <span class="count"> %d  </span> ', ' <span class="count"> %d </span> ', $woocommerce->cart->cart_contents_count, 'vegan'), $woocommerce->cart->cart_contents_count);
        $fragments['#cart .mini-cart-total'] = trim( $woocommerce->cart->get_cart_total() );
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'vegan_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('vegan_woocommerce_breadcrumb_defaults') ) {
    function vegan_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = vegan_get_config('woo_breadcrumb_image');
        $breadcrumb_color = vegan_get_config('woo_breadcrumb_color');
        $style = array();
        $breadcrumb_enable = vegan_get_config('show_product_breadcrumbs');
        if ( !$breadcrumb_enable ) {
            $style[] = 'display:none';
        }
        if( $breadcrumb_color  ){
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
        }
        $estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

        if ( is_single() ) {
            $title = esc_html__('Product Detail', 'vegan');
        } else {
            $title = esc_html__('Products List', 'vegan');
        }
        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb"'.$estyle.'><div class="container"><div class="wrapper-breads"><div class="breadscrumb-inner"><h2 class="bread-title">'.$title.'</h2><ol class="apus-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
        $args['wrap_after'] = '</ol></div></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'vegan_woocommerce_breadcrumb_defaults' );
add_action( 'vegan_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );

// display woocommerce modes
if ( !function_exists('vegan_woocommerce_display_modes') ) {
    function vegan_woocommerce_display_modes(){
        global $wp;
        $current_url = vegan_shop_page_link(true);

        $url_grid = add_query_arg( 'display_mode', 'grid', remove_query_arg( 'display_mode', $current_url ) );
        $url_list = add_query_arg( 'display_mode', 'list', remove_query_arg( 'display_mode', $current_url ) );

        $woo_mode = vegan_woocommerce_get_display_mode();

        echo '<div class="display-mode">';
        echo '<a href="'.  $url_grid  .'" class=" change-view '.($woo_mode == 'grid' ? 'active' : '').'"><i class="mn-icon-99"></i>'.'</a>';
        echo '<a href="'.  $url_list  .'" class=" change-view '.($woo_mode == 'list' ? 'active' : '').'"><i class="mn-icon-105"></i>'.'</a>';
        echo '</div>'; 
    }
}
add_action( 'woocommerce_before_shop_loop', 'vegan_woocommerce_display_modes' , 2 );

if ( !function_exists('vegan_woocommerce_get_display_mode') ) {
    function vegan_woocommerce_get_display_mode() {
        $woo_mode = vegan_get_config('product_display_mode', 'grid');
        if ( isset($_COOKIE['vegan_woo_mode']) && ($_COOKIE['vegan_woo_mode'] == 'list' || $_COOKIE['vegan_woo_mode'] == 'grid') ) {
            $woo_mode = $_COOKIE['vegan_woo_mode'];
        }
        return $woo_mode;
    }
}

if(!function_exists('vegan_shop_page_link')) {
    function vegan_shop_page_link($keep_query = false ) {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
            $link = get_post_type_archive_link( 'product' );
        } else {
            $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
        }

        if( $keep_query ) {
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' === $key || 'submit' === $key ) {
                    continue;
                }
                $link = add_query_arg( $key, $val, $link );

            }
        }
        return $link;
    }
}


if(!function_exists('vegan_filter_before')){
    function vegan_filter_before(){
        echo '<div class="apus-filter">';
    }
}
if(!function_exists('vegan_filter_after')){
    function vegan_filter_after(){
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop', 'vegan_filter_before' , 1 );
add_action( 'woocommerce_before_shop_loop', 'vegan_filter_after' , 40 );

// set display mode to cookie
if ( !function_exists('vegan_before_woocommerce_init') ) {
    function vegan_before_woocommerce_init() {
        if( isset($_GET['display_mode']) && ($_GET['display_mode']=='list' || $_GET['display_mode']=='grid') ){  
            setcookie( 'vegan_woo_mode', trim($_GET['display_mode']) , time()+3600*24*100,'/' );
            $_COOKIE['vegan_woo_mode'] = trim($_GET['display_mode']);
        }
    }
}
add_action( 'init', 'vegan_before_woocommerce_init' );

// Number of products per page
if ( !function_exists('vegan_woocommerce_shop_per_page') ) {
    function vegan_woocommerce_shop_per_page($number) {
        $value = vegan_get_config('number_products_per_page');
        if ( is_numeric( $value ) && $value ) {
            $number = absint( $value );
        }
        return $number;
    }
}
add_filter( 'loop_shop_per_page', 'vegan_woocommerce_shop_per_page' );

// Number of products per row
if ( !function_exists('vegan_woocommerce_shop_columns') ) {
    function vegan_woocommerce_shop_columns($number) {
        $value = vegan_get_config('product_columns');
        if ( in_array( $value, array(2, 3, 4, 6) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'vegan_woocommerce_shop_columns' );

// share box
if ( !function_exists('vegan_woocommerce_share_box') ) {
    function vegan_woocommerce_share_box() {
        if ( vegan_get_config('show_product_social_share') ) {
            get_template_part( 'page-templates/parts/sharebox-product' );
        }
    }
}
add_filter( 'woocommerce_single_product_summary', 'vegan_woocommerce_share_box', 100 );

// quickview
if ( !function_exists('vegan_woocommerce_quickview') ) {
    function vegan_woocommerce_quickview() {
        $args = array(
            'post_type'=>'product',
            'product' => $_GET['productslug']
        );
        $query = new WP_Query($args);
        if ( $query->have_posts() ) {
            while ($query->have_posts()): $query->the_post(); global $product;
                wc_get_template_part( 'content', 'product-quickview' );
            endwhile;
        }
        wp_reset_postdata();
        die;
    }
}

if ( vegan_get_global_config('show_quickview') ) {
    add_action( 'wp_ajax_vegan_quickview_product', 'vegan_woocommerce_quickview' );
    add_action( 'wp_ajax_nopriv_vegan_quickview_product', 'vegan_woocommerce_quickview' );
}

// swap effect
if ( !function_exists('vegan_swap_images') ) {
    function vegan_swap_images($size = 'shop_catalog') {
        global $post, $product, $woocommerce;
        
        $output = '';
        $class = 'image-no-effect unveil-image';
        if (has_post_thumbnail()) {
            $product_thumbnail_id = get_post_thumbnail_id();
            $product_thumbnail_title = get_the_title( $product_thumbnail_id );
            $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $size );
            $placeholder_image = vegan_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

            if ( vegan_get_config('show_swap_image') ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ($attachment_ids && isset($attachment_ids[0])) {
                    $class = 'image-hover';
                    $product_thumbnail_hover_title = get_the_title( $attachment_ids[0] );
                    $product_thumbnail_hover = wp_get_attachment_image_src( $attachment_ids[0], $size );
                    
                    if ( vegan_get_config('image_lazy_loading') ) {
                        echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail_hover[0] ) . '" width="' . esc_attr( $product_thumbnail_hover[1] ) . '" height="' . esc_attr( $product_thumbnail_hover[2] ) . '" alt="' . esc_attr( $product_thumbnail_hover_title ) . '" class="attachment-shop-catalog unveil-image image-effect" />';
                    } else {
                        echo '<img src="' . esc_url( $product_thumbnail_hover[0] ) . '" width="' . esc_attr( $product_thumbnail_hover[1] ) . '" height="' . esc_attr( $product_thumbnail_hover[2] ) . '" alt="' . esc_attr( $product_thumbnail_hover_title ) . '" class="attachment-shop-catalog image-effect" />';
                    }
                }
            }
            
            if ( vegan_get_config('image_lazy_loading') ) {
                echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image '.esc_attr($class).'" />';
            } else {
                echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog '.esc_attr($class).'" />';
            }
        } else {
            $image_sizes = get_option('shop_catalog_image_size');
            $placeholder_width = $image_sizes['width'];
            $placeholder_height = $image_sizes['height'];

            $output .= '<img src="'.woocommerce_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'vegan').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }
}


// get image
if ( !function_exists('vegan_product_get_image') ) {
    function vegan_product_get_image($thumb = 'shop_thumbnail') {
        global $product;

        $product_thumbnail_id = get_post_thumbnail_id();
        $product_thumbnail_title = get_the_title( $product_thumbnail_id );
        $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $thumb );
        
        $placeholder_image = vegan_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

        echo '<div class="product-image">';
        if ( vegan_get_config('image_lazy_loading') ) {
            echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-'.esc_attr($thumb).' size-'.esc_attr($thumb).' wp-post-image unveil-image" />';
        } else {
            echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-'.esc_attr($thumb).' size-'.esc_attr($thumb).' wp-post-image" />';
        }
        echo '</div>';
    }
}

// layout class for woo page
if ( !function_exists('vegan_woocommerce_content_class') ) {
    function vegan_woocommerce_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        if( vegan_get_config('product_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'vegan_woocommerce_content_class', 'vegan_woocommerce_content_class' );

// get layout configs
if ( !function_exists('vegan_get_woocommerce_layout_configs') ) {
    function vegan_get_woocommerce_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        $left = vegan_get_config('product_'.$page.'_left_sidebar');
        $right = vegan_get_config('product_'.$page.'_right_sidebar');

        switch ( vegan_get_config('product_'.$page.'_layout') ) {
            case 'left-main':
                $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3'  );
                $configs['main'] = array( 'class' => 'col-md-9 ' );
                break;
            case 'main-right':
                $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3' ); 
                $configs['main'] = array( 'class' => 'col-md-9 ' );
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12' );
                break;
            case 'left-main-right':
                $configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3'  );
                $configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3' ); 
                $configs['main'] = array( 'class' => 'col-md-6 ' );
                break;
            default:
                $configs['main'] = array( 'class' => 'col-md-12' );
                break;
        }

        return $configs; 
    }
}

// Show/Hide related, upsells products
if ( !function_exists('vegan_woocommerce_related_upsells_products') ) {
    function vegan_woocommerce_related_upsells_products($located, $template_name) {
        $content_none = get_template_directory() . '/woocommerce/content-none.php';
        $show_product_releated = vegan_get_config('show_product_releated');
        if ( 'single-product/related.php' == $template_name ) {
            if ( !$show_product_releated  ) {
                $located = $content_none;
            }
        } elseif ( 'single-product/up-sells.php' == $template_name ) {
            $show_product_upsells = vegan_get_config('show_product_upsells');
            if ( !$show_product_upsells ) {
                $located = $content_none;
            }
        }

        return apply_filters( 'vegan_woocommerce_related_upsells_products', $located, $template_name );
    }
}
add_filter( 'wc_get_template', 'vegan_woocommerce_related_upsells_products', 10, 2 );

if ( !function_exists( 'vegan_product_review_tab' ) ) {
    function vegan_product_review_tab($tabs) {
        if ( !vegan_get_config('show_product_review_tab') && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        }
        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'vegan_product_review_tab', 100 );

if ( !function_exists( 'vegan_minicart') ) {
    function vegan_minicart() {
        $template = apply_filters( 'vegan_minicart_version', '' );
        get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
// Wishlist
add_filter( 'yith_wcwl_button_label', 'vegan_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'vegan_woocomerce_icon_wishlist_add' );
function vegan_woocomerce_icon_wishlist( $value='' ){
    return '<i class="mn-icon-1246"></i>'.'<span class="sub-title">'.esc_html__('Add to Wishlist','vegan').'</span>';
}

function vegan_woocomerce_icon_wishlist_add(){
    return '<i class="mn-icon-2"></i>'.'<span class="sub-title">'.esc_html__('Wishlisted','vegan').'</span>';
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


function vegan_woocommerce_get_ajax_products() {
    $categories = isset($_POST['categories']) ? $_POST['categories'] : '';
    $columns = isset($_POST['columns']) ? $_POST['columns'] : 4;
    $number = isset($_POST['number']) ? $_POST['number'] : 4;
    $product_type = isset($_POST['product_type']) ? $_POST['product_type'] : '';
    $layout_type = isset($_POST['layout_type']) ? $_POST['layout_type'] : '';

    $categories_id = !empty($categories) ? array($categories) : array();
    $loop = apus_themer_get_products( $categories_id, $product_type, 1, $number );
    if ( $loop->have_posts()) {
        wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) );
    }
    exit();
}
add_action( 'wp_ajax_vegan_get_products', 'vegan_woocommerce_get_ajax_products' );
add_action( 'wp_ajax_nopriv_vegan_get_products', 'vegan_woocommerce_get_ajax_products' );

function vegan_woocommerce_photoswipe() {
    if ( !is_singular('product') ) {
        return;
    }
    ?>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>

        <div class="pswp__scroll-wrap">

          <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
          </div>

          <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="<?php echo esc_html__('Close (Esc)', 'vegan'); ?>"></button>
                <button class="pswp__button pswp__button--share" title="<?php echo esc_html__('Share', 'vegan'); ?>"></button>
                <button class="pswp__button pswp__button--fs" title="<?php echo esc_html__('Toggle fullscreen', 'vegan'); ?>"></button>
                <button class="pswp__button pswp__button--zoom" title="<?php echo esc_html__('Zoom in/out', 'vegan'); ?>"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="<?php echo esc_html__('Previous (arrow left)', 'vegan'); ?>"></button>
            <button class="pswp__button pswp__button--arrow--right" title="<?php echo esc_html__('Next (arrow right)', 'vegan'); ?>"></button>
            <div class="pswp__caption">
              <div class="pswp__caption__center"></div>
            </div>
          </div>

        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'vegan_woocommerce_photoswipe' );

function vegan_get_product_single_version() {
    return vegan_get_config('product_single_version', 'v1');
}


function vegan_next_product_link($output, $format, $link, $post, $adjacent) {
    if (empty($post) || $post->post_type != 'product') {
        return $output;
    }
    $title = get_the_title( $post->ID );
    return '<div class="next-product product-nav">
        <a class="before-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            '.esc_html__('Next', 'vegan').'<i class="mn-icon-159"></i>'.'
        </a>
        <a class="on-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            <span class="nav-product-title">'.$title.'</span>
            '.get_the_post_thumbnail( $post->ID,'shop_thumbnail' ).'
        </a>
        </div>';
    
}

add_filter( 'next_post_link', 'vegan_next_product_link', 100, 5 );

function vegan_previous_product_link($output, $format, $link, $post, $adjacent) {
    if (empty($post) || $post->post_type != 'product') {
        return $output;
    }
    $title = get_the_title( $post->ID );
    return '<div class="previous-product product-nav">
        <a class="before-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            <i class="mn-icon-158"></i>'.esc_html__('Previous', 'vegan').'
        </a>
        <a class="on-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            <span class="nav-product-title">'.$title.'</span>
            '.get_the_post_thumbnail( $post->ID, 'shop_thumbnail' ).'
        </a>
        </div>';
    
}
add_filter( 'previous_post_link', 'vegan_previous_product_link', 100, 5 );



/*
 * Start for only Vegan theme
 */
function vegan_is_ajax_request() {
    if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {
        return true;
    }
    return false;
}

function vegan_category_menu_create_list( $category, $current_cat_id ) {
    $output = '<li class="cat-item-' . $category->term_id;
                    
    if ( $current_cat_id == $category->term_id ) {
        $output .= ' current-cat';
    }
    
    $output .=  '"><a href="' . esc_url( get_term_link( (int) $category->term_id, 'product_cat' ) ) . '">' . esc_attr( $category->name ) . '</a></li>';
    
    return $output;
}

/*
 *  Product category menu
 */
if ( ! function_exists( 'vegan_category_menu' ) ) {
    function vegan_category_menu() {
        global $wp_query;

        $current_cat_id = ( is_tax( 'product_cat' ) ) ? $wp_query->queried_object->term_id : '';
        $is_category = ( strlen( $current_cat_id ) > 0 ) ? true : false;
        $hide_empty = true;
        $shop_categories_top_level = true;
        // Should top-level categories be displayed?
        if ( !$shop_categories_top_level && $is_category ) {
            vegan_sub_category_menu_output( $current_cat_id, $hide_empty );
        } else {
            vegan_category_menu_output( $is_category, $current_cat_id, $hide_empty );
        }
    }
}

    

/*
 *  Product category menu: Output
 */
function vegan_category_menu_output( $is_category, $current_cat_id, $hide_empty ) {
    global $wp_query;
    
    $page_id = wc_get_page_id( 'shop' );
    $page_url = get_permalink( $page_id );
    $hide_sub = true;
    $all_categories_class = '';
    
    // Is this a category page?                                                             
    if ( $is_category ) {
        $hide_sub = false;
        
        // Get current category's direct children
        $direct_children = get_terms( 'product_cat',
            array(
                'fields'        => 'ids',
                'parent'        => $current_cat_id,
                'hierarchical'  => true,
                'hide_empty'    => $hide_empty
            )
        );
        
        $category_has_children = ( empty( $direct_children ) ) ? false : true;
    } else {
        // No current category, set "All" as current (if not product tag archive or search)
        if ( ! is_product_tag() && ! isset( $_REQUEST['s'] ) ) {
            $all_categories_class = ' class="current-cat"';
        }
    }
    
    $output = '<li' . $all_categories_class . '><a href="' . esc_url ( $page_url ) . '">' . esc_html__( 'All', 'vegan' ) . '</a></li>';
    $sub_output = '';
    
    // Categories order
    $orderby = 'slug';
    $order = 'asc';
    
    
    $categories = get_categories( array(
        'type'          => 'post',
        'orderby'       => $orderby, // Note: 'name' sorts by product category "menu/sort order"
        'order'         => $order,
        'hide_empty'    => $hide_empty,
        'hierarchical'  => 1,
        'taxonomy'      => 'product_cat'
    ) );
             
    foreach( $categories as $category ) {
        // Is this a sub-category?
        if ( $category->parent != '0' ) {
            // Should sub-categories be included?
            if ( $hide_sub ) {
                continue;
            } else {
                if ( 
                    $category->term_id == $current_cat_id ||
                    $category->parent == $current_cat_id ||
                    ! $category_has_children && $category->parent == $wp_query->queried_object->parent
                ) {
                    $sub_output .= vegan_category_menu_create_list( $category, $current_cat_id );
                }
                continue;
            }
        }
        
        $output .= vegan_category_menu_create_list( $category, $current_cat_id );
    }
    
    if ( strlen( $sub_output ) > 0 ) {
        $sub_output = '<ul class="apus-shop-sub-categories">' . $sub_output . '</ul>';
    }
    
    $output = $output . $sub_output;
    
    echo trim($output);
}

/*
 *  Product category menu: Output sub-categories
 */
function vegan_sub_category_menu_output( $current_cat_id, $hide_empty ) {
    global $wp_query;
    
    
    $output_sub_categories = '';
    
    // Categories order
    $orderby = 'slug';
    $order = 'asc';
    
    $sub_categories = get_categories( array(
        'type'          => 'post',
        'parent'        => $current_cat_id,
        'orderby'       => $orderby,
        'order'         => $order,
        'hide_empty'    => $hide_empty,
        'hierarchical'  => 1,
        'taxonomy'      => 'product_cat'
    ) );
    
    $has_sub_categories = ( empty( $sub_categories ) ) ? false : true;
    
    // Is there any sub-categories available
    if ( $has_sub_categories ) {
        $current_cat_name = apply_filters( 'vegan_shop_parent_category_title', $wp_query->queried_object->name );
        
        foreach ( $sub_categories as $sub_category ) {
            $output_sub_categories .= vegan_category_menu_create_list( $sub_category, $current_cat_id );
        }
    } else {
        $current_cat_name = $wp_query->queried_object->name;
    }
    
    $current_cat_url = get_term_link( (int) $current_cat_id, 'product_cat' );
    $output_current_cat = '<li class="current-cat"><a href="' . esc_url( $current_cat_url ) . '">' . esc_html( $current_cat_name ) . '</a></li>';
    
    echo trim($output_current_cat . $output_sub_categories);
}

function vegan_count_filtered() {
    $return = 0;
    if ( isset($_GET['min_price']) && isset($_GET['max_price']) ) {
        $return++;
    }
    // filter by attributes
    $attribute_taxonomies = wc_get_attribute_taxonomies();

    if ( ! empty( $attribute_taxonomies ) ) {
        foreach ( $attribute_taxonomies as $tax ) {
            if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
                if ( isset($_GET['filter_'.$tax->attribute_name]) ) {
                    $return++;
                }
            }
        }
    }
    return $return;
}

add_filter( 'woosc_button_position_archive_default', 'vegan_woosc_button_position_archive_default' );
function vegan_woosc_button_position_archive_default($return) {
    return '';
}

add_filter( 'woosw_button_position_archive_default', 'vegan_woosw_button_position_archive_default' );
function vegan_woosw_button_position_archive_default($return) {
    return '';
}