<?php
/**
 * vegan functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Vegan
 * @since Vegan 5.2.26
 */


define( 'VEGAN_THEME_VERSION', '5.2.26' );
define( 'VEGAN_DEMO_MODE', false );
define( 'VEGAN_DEV_MODE', true );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'vegan_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Vegan 1.0
 */
function vegan_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on vegan, use a find and replace
	 * to change 'vegan' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'vegan', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'vegan' ),
		'topmenu'  => esc_html__( 'Top Menu', 'vegan' ),
		'social'  => esc_html__( 'Social Links Menu', 'vegan' ),
		'footer-menu'  => esc_html__( 'Footer Menu', 'vegan' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( "woocommerce" );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = vegan_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'vegan_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'responsive-embeds' );
	
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( array( 'css/style-editor.css', vegan_fonts_url() ) );
	
	vegan_get_load_plugins();
}
endif; // vegan_setup
add_action( 'after_setup_theme', 'vegan_setup' );


/**
 * Load Google Front
 */
function vegan_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $josefin = _x( 'on', 'josefin font: on or off', 'vegan' );
    $amatic    = _x( 'on', 'amatic font: on or off', 'vegan' );
    $playfair = _x( 'on', 'playfair font: on or off', 'vegan' );
 
    if ( 'off' !== $josefin || 'off' !== $amatic || 'off' !== $playfair ) {
        $font_families = array();
 
        if ( 'off' !== $josefin ) {
            $font_families[] = 'Josefin+Sans:400,700';
        }
        if ( 'off' !== $amatic ) {
            $font_families[] = 'Amatic+SC:400,700';
        }
        if ( 'off' !== $playfair ) {
            $font_families[] = 'Playfair+Display:400';
        }
 
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

function vegan_full_fonts_url() {  
	$protocol = is_ssl() ? 'https:' : 'http:';
	wp_enqueue_style( 'vegan-theme-fonts', vegan_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'vegan_full_fonts_url');

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Vegan 1.1
 */
function vegan_javascript_detection() {
	wp_add_inline_script( 'vegan-typekit', "(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);" );
}
add_action( 'wp_enqueue_scripts', 'vegan_javascript_detection', 0 );

function vegan_fontawesome_load() {
	$css_folder = vegan_get_css_folder();
	$min = vegan_get_asset_min();

	//load font awesome
	wp_enqueue_style( 'font-awesome', $css_folder . '/font-awesome'.$min.'.css', array(), '4.5.0' );
}
add_action( 'wp_enqueue_scripts', 'vegan_fontawesome_load', 999999 );

/**
 * Enqueue scripts and styles.
 *
 * @since Vegan 1.0
 */
function vegan_scripts() {
	// Load our main stylesheet.
	$css_folder = vegan_get_css_folder();
	$js_folder = vegan_get_js_folder();
	$min = vegan_get_asset_min();

	$css_path = $css_folder . '/template'.$min.'.css';
	wp_enqueue_style( 'vegan-template', $css_path, array(), '3.2' );
	wp_enqueue_style( 'vegan-style', get_template_directory_uri() . '/style.css', array(), '3.2' );


	//load font monia
	wp_enqueue_style( 'font-monia', $css_folder . '/font-monia'.$min.'.css', array(), '1.8.0' );

	// load animate version 3.5.0
	wp_enqueue_style( 'animate-style', $css_folder . '/animate'.$min.'.css', array(), '3.5.0' );

	// load bootstrap style
	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap', $css_folder . '/bootstrap-rtl'.$min.'.css', array(), '3.2.0' );
	}else{
		wp_enqueue_style( 'bootstrap', $css_folder . '/bootstrap'.$min.'.css', array(), '3.2.0' );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'perfect-scrollbar', $css_folder . '/perfect-scrollbar'.$min.'.css', array(), '2.3.2' );

	wp_enqueue_script( 'bootstrap', $js_folder . '/bootstrap'.$min.'.js', array( 'jquery' ), '20150330', true );
	wp_enqueue_script( 'owl-carousel', $js_folder . '/owl.carousel'.$min.'.js', array( 'jquery' ), '2.0.0', true );
	wp_enqueue_script( 'perfect-scrollbar-jquery', $js_folder . '/perfect-scrollbar.jquery'.$min.'.js', array( 'jquery' ), '2.0.0', true );

	wp_enqueue_script( 'jquery-magnific-popup', $js_folder . '/magnific/jquery.magnific-popup'.$min.'.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_style( 'magnific-popup', $js_folder . '/magnific/magnific-popup'.$min.'.css', array(), '1.1.0' );
	
	// lazyload image
	wp_enqueue_script( 'jquery-unveil', $js_folder . '/jquery.unveil'.$min.'.js', array( 'jquery' ), '20150330', true );

	wp_register_script( 'vegan-functions', $js_folder . '/functions'.$min.'.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'vegan-functions', 'vegan_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_script( 'vegan-functions' );

	if ( vegan_get_config('header_js') != "" ) {
		wp_add_inline_script( 'vegan-header', vegan_get_config('header_js') );
	}
}
add_action( 'wp_enqueue_scripts', 'vegan_scripts', 100 );

function vegan_footer_scripts() {
	if ( vegan_get_config('footer_js') != "" ) {
		wp_add_inline_script( 'vegan-footer', vegan_get_config('footer_js') );
	}
}
add_action('wp_footer', 'vegan_footer_scripts');
/**
 * Display descriptions in main navigation.
 *
 * @since Vegan 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function vegan_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'vegan_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Vegan 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function vegan_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'vegan_search_form_modify' );

/**
 * Function for remove srcset (WP4.4)
 *
 */
function vegan_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'vegan_disable_srcset' );

/**
 * Function get opt_name
 *
 */
function vegan_get_opt_name() {
	return 'vegan_theme_options';
}
add_filter( 'apus_themer_get_opt_name', 'vegan_get_opt_name' );

function vegan_register_demo_mode() {
	if ( defined('VEGAN_DEMO_MODE') && VEGAN_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'apus_themer_register_demo_mode', 'vegan_register_demo_mode' );

function vegan_get_demo_preset() {
	$preset = '';
    if ( defined('VEGAN_DEMO_MODE') && VEGAN_DEMO_MODE ) {
        if ( isset($_GET['_preset']) && $_GET['_preset'] ) {
            $presets = get_option( 'apus_themer_presets' );
            if ( is_array($presets) && isset($presets[$_GET['_preset']]) ) {
                $preset = $_GET['_preset'];
            }
        } else {
            $preset = get_option( 'apus_themer_preset_default' );
        }
    }
    return $preset;
}

function vegan_get_config($name, $default = '') {
	global $vegan_options;
    if ( isset($vegan_options[$name]) ) {
        return $vegan_options[$name];
    }
    return $default;
}

function vegan_get_global_config($name, $default = '') {
	$options = get_option( 'vegan_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

function vegan_get_image_lazy_loading() {
	return vegan_get_config('image_lazy_loading');
}

add_filter( 'apus_themer_get_image_lazy_loading', 'vegan_get_image_lazy_loading');

function vegan_register_sidebar() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'vegan' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'vegan' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Currency Switcher', 'vegan' ),
		'id'            => 'currency-switcher',
		'description'   => esc_html__( 'Add widgets here to appear in your Header.', 'vegan' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Contact us Topbar 2', 'vegan' ),
		'id'            => 'contact-topbar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your Top Bar.', 'vegan' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Contact us Topbar 1', 'vegan' ),
		'id'            => 'contact-topbar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your Top Bar.', 'vegan' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Vertical Menu', 'vegan' ),
		'id'            => 'sidebar-verticalmenu',
		'description'   => esc_html__( 'Add widgets here to appear in your Top Bar.', 'vegan' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog left sidebar', 'vegan' ),
		'id'            => 'blog-left-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'vegan' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog right sidebar', 'vegan' ),
		'id'            => 'blog-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'vegan' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Product left sidebar', 'vegan' ),
		'id'            => 'product-left-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'vegan' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Product right sidebar', 'vegan' ),
		'id'            => 'product-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'vegan' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Filter sidebar', 'vegan' ),
		'id'            => 'filter-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'vegan' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name' 				=> esc_html__( 'Shop', 'vegan' ),
		'id' 				=> 'widgets-shop',
		'before_widget'		=> '<div id="%1$s" class="col-md-cus-5 perfect-scroll  %2$s">',
		'after_widget' 		=> '</div></div></div>',
		'before_title' 		=> '<h3 class="apus-widget-title">',
		'after_title' 		=> '</h3><div class="apus-widget-content"><div class="apus-widget-scroll">'
	));
}
add_action( 'widgets_init', 'vegan_register_sidebar' );

/*
 * Init widgets
 */
function vegan_widgets_init($widgets) {
	$widgets = array_merge($widgets, array( 'woo-price-filter', 'woo-product-sorting', 'vertical_menu' ));
	return $widgets;
}
add_filter( 'apus_themer_register_widgets', 'vegan_widgets_init' );

function vegan_get_load_plugins() {
	// framework
	$plugins[] =(array(
		'name'                     => esc_html__( 'Apus Themer For Themes', 'vegan' ),
        'slug'                     => 'apus-themer',
        'required'                 => true,
        'source'				   => get_template_directory() . '/inc/plugins/apus-themer.zip'
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Cmb2', 'vegan' ),
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	));
	
	$plugins[] =(array(
		'name'                     => esc_html__('King Composer - Page Builder', 'vegan'),
	    'slug'                     => 'kingcomposer',
	    'required'                 => true,
	    'source'				   => get_template_directory() . '/inc/plugins/kingcomposer.zip'
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Revolution Slider', 'vegan' ),
        'slug'                     => 'revslider',
        'required'                 => true,
        'source'				   => get_template_directory() . '/inc/plugins/revslider.zip'
	));

	// for woocommerce
	$plugins[] =(array(
		'name'                     => esc_html__( 'WooCommerce', 'vegan' ),
	    'slug'                     => 'woocommerce',
	    'required'                 => true,
	));

	$plugins[] = array(
        'name'     				   => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'vegan' ),
        'slug'     				   => 'woo-smart-wishlist',
        'required' 				   => false,
    );

	// for other plugins
	$plugins[] =(array(
		'name'                     => esc_html__( 'MailChimp for WordPress', 'vegan' ),
	    'slug'                     => 'mailchimp-for-wp',
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Contact Form 7', 'vegan' ),
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	));

	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';


if ( defined( 'APUS_THEMER_REDUX_ACTIVED' ) ) {
	require get_template_directory() . '/inc/vendors/redux-framework/redux-config.php';
	define( 'VEGAN_REDUX_THEMER_ACTIVED', true );
}
if( in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/cmb2/page.php';
	require get_template_directory() . '/inc/vendors/cmb2/footer.php';
	define( 'VEGAN_CMB2_ACTIVED', true );
}
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/woocommerce/functions.php';
	define( 'VEGAN_WOOCOMMERCE_ACTIVED', true );
}
if( in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/kingcomposer/functions.php';
	require get_template_directory() . '/inc/vendors/kingcomposer/maps.php';
	define( 'VEGAN_KINGCOMPOSER_ACTIVED', true );
}
if( in_array( 'apus-themer/apus-themer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/widgets/popup_newsletter.php';
	require get_template_directory() . '/inc/widgets/popup_promotion.php';
}
/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
require get_template_directory() . '/inc/custom-styles.php';