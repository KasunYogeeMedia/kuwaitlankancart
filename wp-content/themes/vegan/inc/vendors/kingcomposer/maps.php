<?php

if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    function vegan_woocommerce_get_category_childs( $categories, $id_parent, $level, &$dropdown ) {
        foreach ( $categories as $key => $category ) {
            if ( $category->category_parent == $id_parent ) {
                $dropdown = array_merge( $dropdown, array( $category->slug => str_repeat( "- ", $level ) . $category->name ) );
                unset($categories[$key]);
                vegan_woocommerce_get_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
            }
        }
    }

    function vegan_woocommerce_get_categories() {
        $return = array( '' => esc_html__(' --- Choose a Category --- ', 'vegan') );

        $args = array(
            'type' => 'post',
            'child_of' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => 1,
            'taxonomy' => 'product_cat'
        );

        $categories = get_categories( $args );
        vegan_woocommerce_get_category_childs( $categories, 0, 0, $return );

        return $return;
    }

    add_action('init', 'vegan_woocommerce_kingcomposer_map', 99 );

    function vegan_woocommerce_kingcomposer_map() {
    	global $kc;

    	$order_by_options = array(
    		'',
    		'date'     	     =>  esc_html__( 'Date', 'vegan' ) ,
    		'ID'  	    	 =>  esc_html__( 'ID', 'vegan' ),
    		'author'    	 =>  esc_html__( 'Author', 'vegan' ) ,
    		'title'  	  	 =>  esc_html__( 'Title', 'vegan' ) ,
    		'modified'  	 =>  esc_html__( 'Modified', 'vegan' ),
    		'rand'           =>  esc_html__( 'Random', 'vegan' ),
    		'comment_count'  =>  esc_html__( 'Comment count', 'vegan' ),
    		'menu_order'  	 => esc_html__( 'Menu order', 'vegan' ),
    	);

    	$order_way_options = array(
    		'',
    		'DESC' =>  esc_html__( 'Descending', 'vegan' ) ,
    		'ASC'  =>  esc_html__( 'Ascending', 'vegan' ),
    	);

    	$layouts = array(
    		'grid' => esc_html__( 'Grid', 'vegan' ),
    		'carousel' => esc_html__( 'Carousel', 'vegan' )
    	);
    	$types = array(
    		'best_selling' => esc_html__( 'Best Selling', 'vegan' ),
    		'featured_product' => esc_html__( 'Featured Products', 'vegan' ),
    		'top_rate'  => esc_html__( 'Top Rate', 'vegan' ),
    		'recent_product'  => esc_html__( 'Recent Products', 'vegan' ),
    		'on_sale'  => esc_html__( 'On Sale', 'vegan' ),
    		'recent_review'  => esc_html__( 'Recent Review', 'vegan' )
    	);
        $categories = array();
        if ( is_admin() ) {
            $categories = vegan_woocommerce_get_categories();
        }
    	$kc->add_map( array('woo_products_category' => array(
            'name' => 'Apus Products Category',
            'description' => esc_html__('Display Products By Category in frontend', 'vegan'),
            'icon' => 'sl-paper-plane',
            'category' => 'Woocommerce',
            'params' => array(
                array(
                    'name' => 'title',
                    'label' => esc_html__( 'Title', 'vegan' ),
                    'type' => 'text'
                ),
                array(
                    "type" => "icon_picker",
                    "label" => esc_html__("Icon", 'vegan'),
                    "name" => "icon"
                ),
                array(
                    "type" => "attach_image",
                    "description" => esc_html__("If you upload an image, icon will not show.", 'vegan'),
                    "name" => "icon_image",
                    'label' => esc_html__('Icon Image', 'vegan' )
                ),
                array(
                    'name' => 'bg_color',
                    'label' => esc_html__( 'Background Color', 'vegan' ),
                    'type' => 'color_picker'
                ),
                array(
    				'type' => 'select',
    				'label' => esc_html__( 'Select Category', 'vegan' ),
    				'name' => 'category',
    				'description' => esc_html__( 'Select Category to display', 'vegan' ),
    				'admin_label' => true,
    				'options' => $categories
                ),
                array(
                    'name' => 'type',
                    'label' => esc_html__( 'Product Type', 'vegan' ),
                    'type' => 'select',
                    'admin_label' => true,
                    'options' => $types
                ),
                array(
                    'name' => 'number',
                    'label' => esc_html__( 'Number product show', 'vegan' ),
                    'type' => 'number_slider',
                    'options' => array(
                        'min' => 1,
                        'max' => 24,
                        'unit' => '',
                        'show_input' => true
                    ),
                    'description' => esc_html__( 'Display number of product', 'vegan' )
                ),
                array(
                    'name' => 'layout_type',
                    'label' => esc_html__( 'Layout Type' ,'vegan' ),
                    'type' => 'select',
                    'admin_label' => true,
                    'options' => array(
                        'layout1' => esc_html__( 'Layout 1' ,'vegan' ),
                        'layout2' => esc_html__( 'Layout 2' ,'vegan' ),
                        'layout3' => esc_html__( 'Layout 3' ,'vegan' ),
                        'layout4' => esc_html__( 'Layout 4' ,'vegan' ),
                    )
                ),
                array(
                    'name' => 'columns',
                    'label' => esc_html__( 'Number Column' ,'vegan' ),
                    'type' => 'number_slider',
                    'options' => array(
                        'min' => 1,
                        'max' => 6,
                        'unit' => '',
                        'show_input' => true
                    ),
                    'value' => 1,
                    'description' => esc_html__( 'Apply for Layout 1 and Layout 2', 'vegan' )
                ),
                array(
                    "type" => "attach_image",
                    "description" => esc_html__("Banner image for Layout 2.", 'vegan'),
                    "name" => "image1",
                    'label' => esc_html__('Banner Image 1', 'vegan' )
                ),
                array(
                    "type" => "attach_image",
                    "description" => esc_html__("Banner image for Layout 2.", 'vegan'),
                    "name" => "image2",
                    'label' => esc_html__('Banner Image 2', 'vegan' )
                )
            )
        )));
    }

    add_filter( 'apus_themer_kingcomposer_map_woo_categories_tabs', 'vegan_kingcomposer_map_woo_categories_tabs' );
    function vegan_kingcomposer_map_woo_categories_tabs($args){
        $types = array(
            'best_selling' => esc_html__( 'Best Selling', 'vegan' ),
            'featured_product' => esc_html__( 'Featured Products', 'vegan' ),
            'top_rate'  => esc_html__( 'Top Rate', 'vegan' ),
            'recent_product'  => esc_html__( 'Recent Products', 'vegan' ),
            'on_sale'  => esc_html__( 'On Sale', 'vegan' ),
            'recent_review'  => esc_html__( 'Recent Review', 'vegan' )
        );
        $categories = array();
        if ( is_admin() ) {
            $categories = apus_themer_woocommerce_get_categories();
        }
        return array(
            'name' => 'Apus Categories Tabs',
            'description' => esc_html__('Display categories tabs with icon in frontend', 'vegan'),
            'icon' => 'sl-paper-plane',
            'category' => 'Woocommerce',
            'params' => array(
                array(
                    'type' => 'group',
                    'label' => __('Tabs', 'vegan'),
                    'name' => 'tabs',
                    'params' => array(
                        array(
                            'name' => 'name',
                            'label' => esc_html__( 'Tab Name' ,'vegan' ),
                            'type' => 'text',
                        ),
                        array(
                            'type'           => 'select',
                            'label'          => esc_html__( 'Select Category', 'vegan' ),
                            'name'           => 'category',
                            'description'    => esc_html__( 'Select Category to display', 'vegan' ),
                            'admin_label'    => true,
                            'options' => $categories
                        ),
                        array(
                            "type" => "icon_picker",
                            "label" => esc_html__("Icon", 'vegan'),
                            "name" => "icon"
                        ),
                        array(
                            "type" => "attach_image",
                            "description" => esc_html__("If you upload an image, icon will not show.", 'vegan'),
                            "name" => "image",
                            'label' => esc_html__('Icon Image', 'vegan' )
                        ),
                        array(
                            "type" => "attach_image",
                            "description" => esc_html__("If you upload an image, icon will not show.", 'vegan'),
                            "name" => "icon_image_hover",
                            'label' => esc_html__('Icon Image When Hover', 'vegan' )
                        )
                    ),
                ),
                array(
                    'name' => 'type',
                    'label' => esc_html__( 'Product Type' ,'vegan' ),
                    'type' => 'select',
                    'admin_label' => true,
                    'options' => $types,
                    'value' => 4,
                ),
                array(
                    'name' => 'number',
                    'label' => esc_html__( 'Number products' ,'vegan' ),
                    'type' => 'number_slider',
                    'options' => array(
                        'min' => 1,
                        'max' => 30,
                        'unit' => '',
                        'show_input' => true
                    ),
                    'value' => 8,
                    'description' => esc_html__( 'Display number of products', 'vegan' )
                ),
                array(
                    'name' => 'columns',
                    'label' => esc_html__( 'Number Column' ,'vegan' ),
                    'type' => 'number_slider',
                    'options' => array(
                        'min' => 1,
                        'max' => 6,
                        'unit' => '',
                        'show_input' => true
                    ),
                    'value' => 4
                ),
                array(
                    'name' => 'tab_style',
                    'label' => esc_html__( 'Tab Style' ,'vegan' ),
                    'type' => 'select',
                    'admin_label' => true,
                    'options' => array(
                        'style1' => esc_html__( 'Style 1' ,'vegan' ),
                        'style2' => esc_html__( 'Style 2' ,'vegan' ),
                        'style3' => esc_html__( 'Style 3' ,'vegan' ),
                    ),
                    'value' => 'grid'
                ),
                array(
                    'name' => 'layout_type',
                    'label' => esc_html__( 'Layout Type' ,'vegan' ),
                    'type' => 'select',
                    'admin_label' => true,
                    'options' => array(
                        'grid' => esc_html__( 'Grid' ,'vegan' ),
                        'special' => esc_html__( 'Special' ,'vegan' ),
                    ),
                    'value' => 'grid'
                ),
            )
        );
    }
}


add_action('init', 'vegan_kingcomposer_maps', 99 );
function vegan_kingcomposer_maps() {
    global $kc;
    $kc->add_map( array('element_group_banner' => array(
        'name' => 'Apus Group Banner',
        'description' => esc_html__('Display Group Banner in frontend', 'vegan'),
        'icon' => 'sl-paper-plane',
        'category' => 'Elements',
        'params' => array(
            array(
                'type' => 'group',
                'label' => __('Banners', 'vegan'),
                'name' => 'banners',
                'params' => array(
                    array(
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'vegan' ),
                        'type' => 'text'
                    ),
                    array(
                        'name' => 'bg_color',
                        'label' => esc_html__( 'Background Color', 'vegan' ),
                        'type' => 'color_picker'
                    ),
                    array(
                        "type" => "attach_image",
                        "name" => "image",
                        'label' => esc_html__('Image Banner', 'vegan' )
                    ),
                    array(
                        'name' => 'image_position',
                        'label' => esc_html__( 'Image Position' ,'vegan' ),
                        'type' => 'select',
                        'admin_label' => true,
                        'options' => array(
                            'left' => esc_html__( 'Left' ,'vegan' ),
                            'right' => esc_html__( 'Right' ,'vegan' ),
                        )
                    ),
                    array(
                        'name' => 'link',
                        'label' => esc_html__( 'Link', 'vegan' ),
                        'type' => 'text'
                    ),
                ),
            )
        )
    )));
}

add_filter( 'apus_themer_kingcomposer_map_element_newsletter', 'vegan_kingcomposer_map_newsletter');
function vegan_kingcomposer_map_newsletter($args) {
    if ( isset($args['params'][0]['options']) ) {
        $args['params'][0]['options'] = array(
                'style1' => esc_html__( 'Style 1', 'vegan' ),
                'style2' => esc_html__( 'Style 2', 'vegan' ),
                'style3' => esc_html__( 'Style 3', 'vegan' )
            );
    }
    return $args;
}

add_filter( 'apus_themer_kingcomposer_map_element_features_box', 'vegan_kingcomposer_map_features_box');
function vegan_kingcomposer_map_features_box($args) {
    if ( isset($args['params'][2]['options']) ) {
        $args['params'][2]['options'] = array(
                'default' => esc_html__('Default ', 'vegan'),
                'style2' => esc_html__( 'Style 2', 'vegan' ),
                'style3' => esc_html__( 'Style 3', 'vegan' ),
                'style4' => esc_html__( 'Style 4', 'vegan' )
            );
    }
    return $args;
}

