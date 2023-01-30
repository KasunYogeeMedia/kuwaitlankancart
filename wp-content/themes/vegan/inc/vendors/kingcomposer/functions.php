<?php

add_action('init', 'vegan_kingcomposer_init');
function vegan_kingcomposer_init() {
    if ( function_exists( 'kc_add_icon' ) ) {
    	$css_folder = vegan_get_css_folder();
		$min = vegan_get_asset_min();
        kc_add_icon( $css_folder . '/font-monia'.$min.'.css' );
    }
 
}