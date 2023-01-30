<?php
/**
 *	The template for displaying the shop header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="apus-shop-header">
    <div class="apus-shop-menu">
        <div class="row">
            <div class="col-xs-12">
                <ul id="apus-filter-menu" class="apus-filter-menu">
                    <li class="hidden-lg hidden-md">
                        <a class="categories-action" href="#" title="<?php esc_html_e('Categories', 'vegan'); ?>"><i class="mn-icon-65"></i> <?php esc_html_e( 'Categories', 'vegan' ); ?></a>
                    </li>
                    <li>
                        <a class="filter-action" href="#" title="<?php esc_html_e('Filter', 'vegan'); ?>"><i class="mn-icon-64"></i> <?php esc_html_e( 'Filter', 'vegan' ); ?></a>
					</li>
                </ul>
                <div class="apus-categories-wrapper">
                    <ul id="apus-categories" class="apus-categories">
                        <?php vegan_category_menu(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div id="apus-sidebar" class="apus-sidebar apus-sidebar-header">
        <div class="apus-sidebar-inner">
            <div id="apus-widgets-wrapper" class="row">
                <?php
                    if ( is_active_sidebar( 'widgets-shop' ) ) {
                        dynamic_sidebar( 'widgets-shop' );
					}
                ?>
            </div>
        </div>
        
        <div id="apus-sidebar-layout-indicator"></div> <!-- Don't remove (used for testing sidebar/filters layout in JavaScript) -->
    </div>
    
</div>
