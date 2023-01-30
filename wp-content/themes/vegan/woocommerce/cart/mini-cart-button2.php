<?php   global $woocommerce; ?>
<div class="apus-topcart version-2">
 <div id="cart" class="dropdown">
        <div class="media ropdown-toggle" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" title="<?php esc_html_e('View your shopping cart', 'vegan'); ?>">
            <div class="media-left">
                <a href="#" class="mini-cart">
                    <i class="mn-icon-913"></i>
                </a>   
            </div>
            <div class="media-body">
                <h5 class="title-cart"><?php echo esc_html('SHOPPING CART','vegan') ?></h5>
                <?php echo sprintf(_n(' <span class="mini-cart-items"> %d item - </span> ', ' <span class="mini-cart-items"> %d items - </span> ', $woocommerce->cart->cart_contents_count, 'vegan'), $woocommerce->cart->cart_contents_count);?> <?php echo trim( $woocommerce->cart->get_cart_total() ); ?>
            </div> 
        </div>
        <div class="dropdown-menu"><div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div></div>
    </div>
</div>