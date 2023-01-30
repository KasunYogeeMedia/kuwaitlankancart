<header id="apus-header" class="site-header header-default hidden-sm hidden-xs <?php echo (vegan_get_config('keep_header') ? 'main-sticky-header' : ''); ?>" role="banner">
    <div class="header-main clearfix">
        <div class="container">
            <div class="header-inner">
                    <div class="row">
                    <!-- LOGO -->
                      
						
						
							
						<div class="col-md-6">
							
							<?php if ( vegan_get_config('show_searchform') ): ?>
                                        <div class="apus-search">
                                           <button type="button" class="button-show-search button-setting"><i class="mn-icon-52"></i></button>
                                        </div>
                                    <?php endif; ?>
							
                            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                <div class="main-menu">
                                    <nav 
                                     data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
                                    <?php   $args = array(
                                            'theme_location' => 'primary',
                                            'container_class' => 'collapse navbar-collapse',
                                            'menu_class' => 'nav navbar-nav megamenu',
                                            'fallback_cb' => '',
                                            'menu_id' => 'primary-menu',
                                            'walker' => new Vegan_Nav_Menu()
                                        );
                                        wp_nav_menu($args);
                                    ?>
                                    </nav>
                                </div>
                            <?php endif; ?>
                        </div>
						
						
                        <div class="col-md-6">
                            <div class="col-md-2">
								<div class="logo-in-theme">
									<?php get_template_part( 'page-templates/parts/logo2' ); ?>
								</div>
							
                        </div>
                            <div class="heading-right pull-right hidden-sm hidden-xs">

                                <div class="header-setting">

                                    <?php if ( defined('VEGAN_WOOCOMMERCE_ACTIVED') && VEGAN_WOOCOMMERCE_ACTIVED ): ?>
                                        <div class="pull-right">
                                            <!-- Setting -->
                                            <div class="top-cart hidden-xs">
                                                <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="setting-popup pull-right">
                                        <div class="dropdown">
                                            <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown"><span class="mn-icon-410"></span></button>
                                            <div class="dropdown-menu">
                                                <?php if ( has_nav_menu( 'topmenu' ) ) { ?>
                                                    <div class="pull-left">
                                                        <?php
                                                            $args = array(
                                                                'theme_location'  => 'topmenu',
                                                                'container_class' => '',
                                                                'menu_class'      => 'menu-topbar'
                                                            );
                                                            wp_nav_menu($args);
                                                        ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
						</div>
					
                    </div>
            </div>
        </div>
        <div class="full-top-search-form">
            <?php get_template_part( 'page-templates/parts/productsearchform-popup' ); ?>
        </div>
    </div>
</header>



