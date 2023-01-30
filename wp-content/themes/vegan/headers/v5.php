<header id="apus-header" class="site-header header-v5 hidden-sm hidden-xs" role="banner">
	<div id="apus-topbar" class="apus-topbar">
		<div class="container">
            <div class="topbar-inner clearfix">
                <div class="row">
                    <div class="col-md-5">
                        <?php if ( vegan_get_config('show_searchform') ): ?>
                            <?php get_template_part( 'page-templates/parts/productsearchform' ); ?>
                        <?php endif; ?>
                    </div>

                    <!-- LOGO -->
                    <div class="logo-in-theme col-md-2 text-center">
                        <?php get_template_part( 'page-templates/parts/logo' ); ?>
                    </div>
                    <!-- //LOGO -->
                    <div class="col-md-5 hidden-sm hidden-xs topbar-menu">
                       <?php if ( defined('VEGAN_WOOCOMMERCE_ACTIVED') && VEGAN_WOOCOMMERCE_ACTIVED ): ?>
                            <div class="pull-right">
                                <!-- Setting -->
                                <div class="top-cart hidden-xs">
                                    <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ( has_nav_menu( 'topmenu' ) ): ?>
                        <div class="pull-right wrapper-topmenu hidden-xs hidden-sm">
                            <nav class="apus-topmenu" role="navigation">
                                    <?php
                                        $args = array(
                                            'theme_location'  => 'topmenu',
                                            'menu_class'      => 'apus-menu-top list-inline',
                                            'fallback_cb'     => '',
                                            'menu_id'         => 'topmenu'
                                        );
                                        wp_nav_menu($args);
                                    ?>
                            </nav>                                                                     
                        </div>
                        <?php endif; ?>

                        <div class="user-login pull-right">
                            <ul class="list-inline">
                                <?php if( !is_user_logged_in() ){ ?>
                                    <li> <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Login','vegan'); ?>"> <?php esc_html_e('Login', 'vegan'); ?> </a></li>
                                    <li> <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Register','vegan'); ?>"> <?php esc_html_e('Register', 'vegan'); ?> </a></li>
                                <?php }else{ ?>
                                    <?php $current_user = wp_get_current_user(); ?>
                                  <li>  <span class="hidden-xs"><?php esc_html_e('Welcome ','vegan'); ?><?php echo esc_html( $current_user->display_name); ?> !</span></li>
                                  <li><a href="<?php echo wp_logout_url(home_url()); ?>"><?php esc_html_e('Logout ','vegan'); ?></a></li>
                                <?php } ?>
                            </ul>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>

	<div class="header-main clearfix <?php echo (vegan_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
        <div class="main-menu">
            <div class="container">
                <div class="p-relative">
                <div class="row">
                    <?php if ( is_active_sidebar( 'sidebar-verticalmenu' ) ) : ?>
                        <div class="col-md-2 hidden-sm hidden-xs">
                        <?php dynamic_sidebar( 'sidebar-verticalmenu' ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <div class="p-static <?php echo (is_active_sidebar( 'sidebar-verticalmenu' ) == false)?'col-md-12':'col-md-10'; ?>">
                            <div class="pull-left site-header-mainmenu ">
                                <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar" role="navigation">
                                <?php
                                    $args = array(
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


                            <?php if ( is_active_sidebar('contact-topbar-2') ): ?>
                                <div class="pull-right contact-topbar-2">
                                    <?php dynamic_sidebar('contact-topbar-2'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                </div>
            </div>
        </div>

	</div>
</header>