<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Vegan_Redux_Framework_Config')) {

    class Vegan_Redux_Framework_Config
    {
        public $args = array();
        public $sections = array();
        public $ReduxFramework;

        public function __construct()
        {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            add_action('init', array($this, 'initSettings'), 10);
        }

        public function initSettings()
        {
            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections()
        {
            global $wp_registered_sidebars;
            $sidebars = array();

            if ( !empty($wp_registered_sidebars) ) {
                foreach ($wp_registered_sidebars as $sidebar) {
                    $sidebars[$sidebar['id']] = $sidebar['name'];
                }
            }
            $columns = array( '1' => esc_html__('1 Column', 'vegan'),
                '2' => esc_html__('2 Columns', 'vegan'),
                '3' => esc_html__('3 Columns', 'vegan'),
                '4' => esc_html__('4 Columns', 'vegan'),
                '5' => esc_html__('5 Columns', 'vegan'),
                '6' => esc_html__('6 Columns', 'vegan')
            );
            
            $general_fields = array();
            if ( !function_exists( 'wp_site_icon' ) ) {
                $general_fields[] = array(
                    'id' => 'media-favicon',
                    'type' => 'media',
                    'title' => esc_html__('Favicon Upload', 'vegan'),
                    'desc' => esc_html__('', 'vegan'),
                    'subtitle' => esc_html__('Upload a 16px x 16px .png or .gif image that will be your favicon.', 'vegan'),
                );
            }
            $general_fields[] = array(
                'id' => 'preload',
                'type' => 'switch',
                'title' => esc_html__('Preload Website', 'vegan'),
                'default' => true,
            );
            $general_fields[] = array(
                'id' => 'image_lazy_loading',
                'type' => 'switch',
                'title' => esc_html__('Image Lazy Loading', 'vegan'),
                'default' => true,
            );
            // General Settings Tab
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => esc_html__('General', 'vegan'),
                'fields' => $general_fields
            );
            // Header
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Header', 'vegan'),
                'fields' => array(
                    array(
                        'id' => 'media-logo',
                        'type' => 'media',
                        'title' => esc_html__('Logo Upload', 'vegan'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'vegan'),
                    ),
                    array(
                        'id' => 'media-mobile-logo',
                        'type' => 'media',
                        'title' => esc_html__('Mobile Logo Upload', 'vegan'),
                        'subtitle' => esc_html__('Upload a .png or .gif image that will be your logo.', 'vegan'),
                    ),
                    array(
                        'id' => 'header_type',
                        'type' => 'select',
                        'title' => esc_html__('Header Layout Type', 'vegan'),
                        'subtitle' => esc_html__('Choose a header for your website.', 'vegan'),
                        'options' => vegan_get_header_layouts()
                    ),
                    array(
                        'id' => 'keep_header',
                        'type' => 'switch',
                        'title' => esc_html__('Keep Header When Scroll Mouse', 'vegan'),
                        'default' => false
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Search Form', 'vegan'),
                'fields' => array(
                    array(
                        'id'=>'show_searchform',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Form', 'vegan'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'vegan'),
                        'off' => esc_html__('No', 'vegan'),
                    ),
                    array(
                        'id'=>'search_type',
                        'type' => 'button_set',
                        'title' => esc_html__('Search Content Type', 'vegan'),
                        'required' => array('show_searchform','equals',true),
                        'options' => array('all' => esc_html__('All', 'vegan'), 'post' => esc_html__('Post', 'vegan'), 'product' => esc_html__('Product', 'vegan')),
                        'default' => 'all'
                    ),
                    array(
                        'id'=>'search_category',
                        'type' => 'switch',
                        'title' => esc_html__('Show Categories', 'vegan'),
                        'required' => array('search_type', 'equals', array('post', 'product')),
                        'default' => false,
                        'on' => esc_html__('Yes', 'vegan'),
                        'off' => esc_html__('No', 'vegan'),
                    ),
                    array(
                        'id' => 'autocomplete_search',
                        'type' => 'switch',
                        'title' => esc_html__('Autocomplete search?', 'vegan'),
                        'required' => array('show_searchform','equals',true),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_search_product_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Result Image', 'vegan'),
                        'required' => array('autocomplete_search', '=', '1'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_search_product_price',
                        'type' => 'switch',
                        'title' => esc_html__('Show Search Result Price', 'vegan'),
                        'required' => array(array('autocomplete_search', '=', '1'), array('search_type', '=', 'product')),
                        'default' => 1
                    ),
                )
            );
            // Footer
            $this->sections[] = array(
                'icon' => 'el el-website',
                'title' => esc_html__('Footer', 'vegan'),
                'fields' => array(
                    array(
                        'id' => 'footer_type',
                        'type' => 'select',
                        'title' => esc_html__('Footer Layout Type', 'vegan'),
                        'subtitle' => esc_html__('Choose a footer for your website.', 'vegan'),
                        'options' => vegan_get_footer_layouts()
                    ),
                    array(
                        'id' => 'copyright_text',
                        'type' => 'editor',
                        'title' => esc_html__('Copyright Text', 'vegan'),
                        'default' => 'Powered by Redux Framework.',
                        'required' => array('footer_type','=','')
                    ),
                    array(
                        'id' => 'back_to_top',
                        'type' => 'switch',
                        'title' => esc_html__('Back To Top Button', 'vegan'),
                        'subtitle' => esc_html__('Toggle whether or not to enable a back to top button on your pages.', 'vegan'),
                        'default' => true,
                    ),
                )
            );

            // Blog settings
            $this->sections[] = array(
                'icon' => 'el el-pencil',
                'title' => esc_html__('Blog', 'vegan'),
                'fields' => array(
                    array(
                        'id' => 'show_blog_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'vegan'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'vegan'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'vegan').'</em>',
                        'id' => 'blog_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'blog_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'vegan'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'vegan'),
                    ),
                )
            );
            // Archive Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog & Post Archives', 'vegan'),
                'fields' => array(
                    array(
                        'id' => 'blog_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'vegan'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'vegan'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'vegan'),
                                'alt' => esc_html__('Main Only', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'vegan'),
                                'alt' => esc_html__('Left - Main Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'vegan'),
                                'alt' => esc_html__('Main - Right Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'vegan'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'blog_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'vegan'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'vegan'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'vegan'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'vegan'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'vegan'),
                        'options' => $sidebars
                        
                    ),
                    array(
                        'id' => 'blog_display_mode',
                        'type' => 'select',
                        'title' => esc_html__('Display Mode', 'vegan'),
                        'options' => array(
                            'grid' => esc_html__('Grid Layout', 'vegan'),
                            'mansory' => esc_html__('Mansory Layout', 'vegan'),
                            'list' => esc_html__('List Layout', 'vegan'),
                            'chess' => esc_html__('Chess Layout', 'vegan'),
                            'timeline' => esc_html__('Timeline Layout', 'vegan'),
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Blog Columns', 'vegan'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'blog_item_style',
                        'type' => 'select',
                        'title' => esc_html__('Blog Item Style', 'vegan'),
                        'options' => array(
                            'grid' => esc_html__('Grid', 'vegan'),
                            'list' => esc_html__('List', 'vegan')
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'blog_item_thumbsize',
                        'type' => 'text',
                        'title' => esc_html__('Thumbnail Size', 'vegan'),
                        'desc' => esc_html__('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme.', 'vegan'),
                    ),

                )
            );
            // Single Blogs settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog', 'vegan'),
                'fields' => array(
                    
                    array(
                        'id' => 'blog_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'vegan'),
                        'subtitle' => esc_html__('Select the variation you want to apply on your store.', 'vegan'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'vegan'),
                                'alt' => esc_html__('Main Only', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'vegan'),
                                'alt' => esc_html__('Left - Main Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'vegan'),
                                'alt' => esc_html__('Main - Right Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'vegan'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'blog_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'vegan'),
                        'default' => false
                    ),
                    array(
                        'id' => 'blog_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Left Sidebar', 'vegan'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'vegan'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'blog_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Blog Right Sidebar', 'vegan'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'vegan'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_blog_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_blog_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Releated Posts', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_blog_releated',
                        'type' => 'text',
                        'title' => esc_html__('Number of related posts to show', 'vegan'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'releated_blog_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Blogs Columns', 'vegan'),
                        'required' => array('show_blog_releated', '=', '1'),
                        'options' => $columns,
                        'default' => 4
                    ),

                )
            );
            // Woocommerce
            $this->sections[] = array(
                'icon' => 'el el-shopping-cart',
                'title' => esc_html__('Woocommerce', 'vegan'),
                'fields' => array(
                    array(
                        'id' => 'show_product_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Breadcrumbs', 'vegan'),
                        'default' => 1
                    ),
                    array (
                        'title' => esc_html__('Breadcrumbs Background Color', 'vegan'),
                        'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'vegan').'</em>',
                        'id' => 'woo_breadcrumb_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'woo_breadcrumb_image',
                        'type' => 'media',
                        'title' => esc_html__('Breadcrumbs Background', 'vegan'),
                        'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'vegan'),
                    )
                )
            );
            // Archive settings
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Product Archives', 'vegan'),
                'fields' => array(
                    array(
                        'id' => 'product_archive_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'vegan'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your archive product page.', 'vegan'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Content', 'vegan'),
                                'alt' => esc_html__('Main Content', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left Sidebar - Main Content', 'vegan'),
                                'alt' => esc_html__('Left Sidebar - Main Content', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main Content - Right Sidebar', 'vegan'),
                                'alt' => esc_html__('Main Content - Right Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'vegan'),
                                'alt' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'product_archive_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'vegan'),
                        'default' => false
                    ),
                    array(
                        'id' => 'product_archive_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Left Sidebar', 'vegan'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'vegan'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'product_archive_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Right Sidebar', 'vegan'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'vegan'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'product_display_mode',
                        'type' => 'select',
                        'title' => esc_html__('Display Mode', 'vegan'),
                        'subtitle' => esc_html__('Choose a default layout archive product.', 'vegan'),
                        'options' => array('grid' => esc_html__('Grid', 'vegan'), 'list' => esc_html__('List', 'vegan')),
                        'default' => 'grid'
                    ),
                    array(
                        'id' => 'number_products_per_page',
                        'type' => 'text',
                        'title' => esc_html__('Number of Products Per Page', 'vegan'),
                        'default' => 12,
                        'min' => '1',
                        'step' => '1',
                        'max' => '100',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Product Columns', 'vegan'),
                        'options' => $columns,
                        'default' => 4
                    ),
                    array(
                        'id' => 'show_quickview',
                        'type' => 'switch',
                        'title' => esc_html__('Show Quick View', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_swap_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show Second Image (Hover)', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'product_pagination',
                        'type' => 'select',
                        'title' => esc_html__('Pagination Type', 'vegan'),
                        'options' => array(
                            'default' => esc_html__('Default', 'vegan'),
                            'loadmore' => esc_html__('Load More Button', 'vegan'),
                            'infinite' => esc_html__('Infinite Scrolling', 'vegan'),
                        ),
                        'default' => 'default'
                    ),
                )
            );
            // Product Page
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Single Product', 'vegan'),
                'fields' => array(
                    array(
                        'id' => 'product_single_version',
                        'type' => 'select',
                        'title' => esc_html__('Product Version', 'vegan'),
                        'options' => array(
                            'v1' => esc_html__('Version 1', 'vegan'),
                            'v2' => esc_html__('Version 2', 'vegan'),
                        ),
                        'default' => 'v1'
                    ),
                    array(
                        'id' => 'product_single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => esc_html__('Sidebar position', 'vegan'),
                        'subtitle' => esc_html__('Select the layout you want to apply on your Single Product Page.', 'vegan'),
                        'options' => array(
                            'main' => array(
                                'title' => esc_html__('Main Only', 'vegan'),
                                'alt' => esc_html__('Main Only', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                            ),
                            'left-main' => array(
                                'title' => esc_html__('Left - Main Sidebar', 'vegan'),
                                'alt' => esc_html__('Left - Main Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                            ),
                            'main-right' => array(
                                'title' => esc_html__('Main - Right Sidebar', 'vegan'),
                                'alt' => esc_html__('Main - Right Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                            ),
                            'left-main-right' => array(
                                'title' => esc_html__('Left - Main - Right Sidebar', 'vegan'),
                                'alt' => esc_html__('Left - Main - Right Sidebar', 'vegan'),
                                'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                            ),
                        ),
                        'default' => 'left-main'
                    ),
                    array(
                        'id' => 'product_single_fullwidth',
                        'type' => 'switch',
                        'title' => esc_html__('Is Full Width?', 'vegan'),
                        'default' => false
                    ),
                    array(
                        'id' => 'product_single_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Left Sidebar', 'vegan'),
                        'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'vegan'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'product_single_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Right Sidebar', 'vegan'),
                        'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'vegan'),
                        'options' => $sidebars
                    ),
                    array(
                        'id' => 'show_product_social_share',
                        'type' => 'switch',
                        'title' => esc_html__('Show Social Share', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_product_review_tab',
                        'type' => 'switch',
                        'title' => esc_html__('Show Product Review Tab', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_product_releated',
                        'type' => 'switch',
                        'title' => esc_html__('Show Products Releated', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'show_product_upsells',
                        'type' => 'switch',
                        'title' => esc_html__('Show Products upsells', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'number_product_releated',
                        'title' => esc_html__('Number of related/upsells products to show', 'vegan'),
                        'default' => 4,
                        'min' => '1',
                        'step' => '1',
                        'max' => '20',
                        'type' => 'slider'
                    ),
                    array(
                        'id' => 'releated_product_columns',
                        'type' => 'select',
                        'title' => esc_html__('Releated Products Columns', 'vegan'),
                        'options' => $columns,
                        'default' => 4
                    ),

                )
            );
            // Style
            $this->sections[] = array(
                'icon' => 'el el-icon-css',
                'title' => esc_html__('Style', 'vegan'),
                'fields' => array(
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Content', 'vegan').'</h3>',
                    ),
                    array (
                        'title' => esc_html__('Main Theme Color', 'vegan'),
                        'subtitle' => esc_html__('The main color of the site.', 'vegan'),
                        'id' => 'main_color',
                        'type' => 'color',
                        'transparent' => false,
                    ),
                    array (
                        'id' => 'site_background',
                        'type' => 'background',
                        'title' => esc_html__('Site Background', 'vegan'),
                        'output' => 'body'
                    ),
                    array (
                        'id' => 'container_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Container Background Color', 'vegan'),
                        'output' => array(
                            'background-color' =>'.wrapper-container, .apus-mfp-zoom-in .mfp-inline-holder .mfp-content, .dropdown-menu'
                        )
                    ),
                    array (
                        'id' => 'forms_inputs_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Forms inputs Color', 'vegan'),
                        'output' => array(
                            'background-color' =>'.form-control, select, .quantity input[type="number"], .emodal, input[type="text"], input[type="email"], input[type="password"], input[type="tel"], textarea, textarea.form-control, .mail-form .input-group .form-control'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Typography', 'vegan'),
                'fields' => array(
                    
                    array (
                        'id' => 'main_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Body Font', 'vegan').'</h3>',
                    ),
                    // Standard + Google Webfonts
                    array (
                        'title' => esc_html__('Font Face', 'vegan'),
                        'subtitle' => '<em>'.esc_html__('Pick the Main Font for your site.', 'vegan').'</em>',
                        'id' => 'main_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'default' => array (
                            'font-family' => 'Montserrat',
                            'subsets' => '',
                        ),
                        'output' => array(
                            'body, p, .product-block.grid .name, .product-block.grid .groups-button .addcart > .add-cart > a.button .title-cart,
                            .apus-products-list .name, .apus-footer, .widget-testimonials,
                            .widget-testimonials .testimonials-body .testimonials-profile .testimonial-meta .info .name-client, .apus-topbar,
                            .widget_apus_recent_post .media-post-layout .posts-list .entry-title, .archive-shop div.product .information .product-navs .post-navigation .nav-links .product-nav, .archive-shop div.product .information .compare, .archive-shop div.product .information .add_to_wishlist, .archive-shop div.product .information .yith-wcwl-wishlistexistsbrowse > a, .archive-shop div.product .information .yith-wcwl-wishlistaddedbrowse > a, .information .price .woocs_price_code .woocommerce-Price-amount, .information, .archive-shop div.product .information .cart button, .tabs-v1 .tab-content, .apus-breadscrumb .breadcrumb, .kc-team .overlay .content-subtitle,
                            .kc-team:hover .overlay .content-desc, .kc_accordion_wrapper *, .widget-features-box.style3 .fbox-content .ourservice-heading,
                            .widget-features-box.style3 .fbox-content .description, .single-post, .layout-blog .entry-content, .layout-blog .info-content, .entry-description'
                        )
                    ),
                    
                    // Header
                    array (
                        'id' => 'secondary_font_info',
                        'icon' => true,
                        'type' => 'info',
                        'raw' => '<h3 style="margin: 0;"> '.esc_html__('Heading', 'vegan').'</h3>',
                    ),
                    array (
                        'title' => esc_html__('H1 Font', 'vegan'),
                        'subtitle' => '<em>'.esc_html__('Pick the H1 Font for your site.', 'vegan').'</em>',
                        'id' => 'h1_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h1'
                        )
                    ),
                    array (
                        'title' => esc_html__('H2 Font', 'vegan'),
                        'subtitle' => '<em>'.esc_html__('Pick the H2 Font for your site.', 'vegan').'</em>',
                        'id' => 'h2_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h2'
                        )
                    ),
                    array (
                        'title' => esc_html__('H3 Font', 'vegan'),
                        'subtitle' => '<em>'.esc_html__('Pick the H3 Font for your site.', 'vegan').'</em>',
                        'id' => 'h3_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h3, .navbar-nav.megamenu > li > a, ul.nav.style1, .price .woocs_price_code .woocommerce-Price-amount,
                            .widgettitle, .newletters-1 .widgettitle, .about .tt-about, .about .author-about, ul.nav.style2, .hotline .tt-hotline, .hotline .phone,
                            .widget-ground-banner .banner-title span, .newletters-2 .widgettitle, .btn, .button, .banner1 .bn-sale, .widget .widget-title, .widget .widgettitle, .widget .widget-heading, .newletters-3 .widgettitle, .woocommerce div.product .product_title, .tabs-v1 .nav-tabs li > a,
                            .entry-title'
                        )
                    ),
                    array (
                        'title' => esc_html__('H4 Font', 'vegan'),
                        'subtitle' => '<em>'.esc_html__('Pick the H4 Font for your site.', 'vegan').'</em>',
                        'id' => 'h4_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h4'
                        )
                    ),
                    array (
                        'title' => esc_html__('H5 Font', 'vegan'),
                        'subtitle' => '<em>'.esc_html__('Pick the H5 Font for your site.', 'vegan').'</em>',
                        'id' => 'h5_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h5'
                        )
                    ),
                    array (
                        'title' => esc_html__('H6 Font', 'vegan'),
                        'subtitle' => '<em>'.esc_html__('Pick the H6 Font for your site.', 'vegan').'</em>',
                        'id' => 'h6_font',
                        'type' => 'typography',
                        'line-height' => true,
                        'text-align' => false,
                        'font-style' => false,
                        'font-weight' => true,
                        'all_styles'=> true,
                        'font-size' => true,
                        'color' => true,
                        'output' => array(
                            'h6'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Top Bar', 'vegan'),
                'fields' => array(
                    array(
                        'id'=>'topbar_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'vegan'),
                        'output' => '#apus-header.header-v3 .apus-topbar, #apus-header.header-v4 .apus-topbar, #apus-header.header-v5 .apus-topbar, #apus-header.header-v6 .apus-topbar'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'vegan'),
                        'id' => 'topbar_text_color',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar, .contact-topbar-1 .textwidget .media .media-body .phone-info'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'vegan'),
                        'id' => 'topbar_link_color',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color When Hover', 'vegan'),
                        'id' => 'topbar_link_color_hover',
                        'type' => 'color_rgba',
                        'output' => array(
                            'color' =>'#apus-topbar a:hover'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Header', 'vegan'),
                'fields' => array(
                    array(
                        'id'=>'header_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'vegan'),
                        'output' => '#apus-header.header-v6 .main-menu, #apus-header.header-v5 .main-menu, #apus-header.header-v4 .main-menu, #apus-header.header-v3 .main-menu, #apus-header.header-v2 .main-menu, #apus-header.header-v1 .main-menu, #apus-header.header-default .header-main, #apus-header, #apus-header.header-v2 .header-inner'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'vegan'),
                        'id' => 'header_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'vegan'),
                        'id' => 'header_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'vegan'),
                        'id' => 'header_link_color_active',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'#apus-header .active > a, #apus-header a:active, #apus-header a:hover'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Main Menu', 'vegan'),
                'fields' => array(
                    array(
                        'title' => esc_html__('Link Color', 'vegan'),
                        'id' => 'main_menu_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'.navbar-nav.megamenu > li > a, #apus-header.header-default .navbar-nav.megamenu > li > a, .dropdown-menu > li > a,#apus-header.header-v3 .header-main .main-menu nav li a, #apus-header.header-v4 .header-main .main-menu nav li a, #apus-header.header-v5 .header-main .main-menu nav li a, #apus-header.header-v6 .header-main .main-menu nav li a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Active', 'vegan'),
                        'id' => 'main_menu_link_color_active',
                        'type' => 'color',
                        'output' => array(
                            'color' =>'.navbar-nav.megamenu > li.active > a, .navbar-nav.megamenu > li:hover > a, .navbar-nav.megamenu > li:active > a,.navbar-nav.megamenu .dropdown-menu > li.active > a, .navbar-nav.megamenu .dropdown-menu > li > a:hover, .navbar-nav.megamenu .dropdown-menu > li > a:active, #apus-header.header-v3 .header-main .main-menu nav li.active > a, #apus-header.header-v3 .header-main .main-menu nav li:hover > a, #apus-header.header-v3 .header-main .main-menu nav li:active > a, #apus-header.header-v4 .header-main .main-menu nav li.active > a, #apus-header.header-v4 .header-main .main-menu nav li:hover > a, #apus-header.header-v4 .header-main .main-menu nav li:active > a, #apus-header.header-v5 .header-main .main-menu nav li.active > a, #apus-header.header-v5 .header-main .main-menu nav li:hover > a, #apus-header.header-v5 .header-main .main-menu nav li:active > a, #apus-header.header-v6 .header-main .main-menu nav li.active > a, #apus-header.header-v6 .header-main .main-menu nav li:hover > a, #apus-header.header-v6 .header-main .main-menu nav li:active > a'
                        )
                    ),
                )
            );
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Footer', 'vegan'),
                'fields' => array(
                    array(
                        'id'=>'footer_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'vegan'),
                        'output' => '.apus-footer .dark'
                    ),
                    array(
                        'title' => esc_html__('Heading Color', 'vegan'),
                        'id' => 'footer_heading_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer h1, #apus-footer h2, #apus-footer h3, #apus-footer h4, #apus-footer h5, #apus-footer h6 ,#apus-footer .widget-title'
                        )
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'vegan'),
                        'id' => 'footer_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer, .apus-footer .contact-info, .apus-copyright'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'vegan'),
                        'id' => 'footer_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer a'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'vegan'),
                        'id' => 'footer_link_color_hover',
                        'type' => 'color',
                        'output' => array(
                            'color' => '#apus-footer a:hover'
                        )
                    ),
                )
            );
            
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Copyright', 'vegan'),
                'fields' => array(
                    array(
                        'id'=>'copyright_bg',
                        'type' => 'background',
                        'title' => esc_html__('Background', 'vegan'),
                        'output' => '.apus-copyright'
                    ),
                    array(
                        'title' => esc_html__('Text Color', 'vegan'),
                        'id' => 'copyright_text_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color', 'vegan'),
                        'id' => 'copyright_link_color',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright a, .apus-copyright a i'
                        )
                    ),
                    array(
                        'title' => esc_html__('Link Color Hover', 'vegan'),
                        'id' => 'copyright_link_color_hover',
                        'type' => 'color',
                        'output' => array(
                            'color' => '.apus-copyright a:hover .apus-copyright a i:hover'
                        )
                    ),
                )
            );

            // Social Media
            $this->sections[] = array(
                'icon' => 'el el-file',
                'title' => esc_html__('Social Media', 'vegan'),
                'fields' => array(
                    array(
                        'id' => 'facebook_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Facebook Share', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'twitter_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable twitter Share', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'linkedin_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable linkedin Share', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'tumblr_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable tumblr Share', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'google_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable google plus Share', 'vegan'),
                        'default' => 1
                    ),
                    array(
                        'id' => 'pinterest_share',
                        'type' => 'switch',
                        'title' => esc_html__('Enable pinterest Share', 'vegan'),
                        'default' => 1
                    )
                )
            );
            // Custom Code
            $this->sections[] = array(
                'icon' => 'el-icon-css',
                'title' => esc_html__('Custom CSS/JS', 'vegan'),
                'fields' => array(
                    array (
                        'title' => esc_html__('Custom CSS', 'vegan'),
                        'subtitle' => esc_html__('Paste your custom CSS code here.', 'vegan'),
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                    ),
                    
                    array (
                        'title' => esc_html__('Header JavaScript Code', 'vegan'),
                        'subtitle' => esc_html__('Paste your custom JS code here. The code will be added to the header of your site.', 'vegan'),
                        'id' => 'header_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                    
                    array (
                        'title' => esc_html__('Footer JavaScript Code', 'vegan'),
                        'subtitle' => esc_html__('Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.', 'vegan'),
                        'id' => 'footer_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                    ),
                )
            );
            $this->sections[] = array(
                'title' => esc_html__('Import / Export', 'vegan'),
                'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'vegan'),
                'icon' => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => esc_html__('Import Export', 'vegan'),
                        'subtitle' => esc_html__('Save and restore your Redux options', 'vegan'),
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {
            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $preset = vegan_get_demo_preset();
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'vegan_theme_options'.$preset,
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('Theme Options', 'vegan'),
                'page_title' => esc_html__('Theme Options', 'vegan'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => 'vegan_options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
                // Show the time the page took to load, etc
                'update_notice' => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon' => '',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE
                'use_cdn' => true
            );

            return $this->args;
        }

    }

    global $reduxConfig;
    $reduxConfig = new Vegan_Redux_Framework_Config();
}
