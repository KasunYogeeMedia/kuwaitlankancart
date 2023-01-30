<div class="popupnewsletter hidden">
  <!-- Modal -->
  <button title="<?php echo esc_html('Close (Esc)', 'vegan'); ?>" type="button" class="mfp-close apus-mfp-close">×</button>
  <div class="row">
    <div class="col-sm-6">
      <?php if ( isset($image) && $image ) : ?>
        <img src="<?php echo esc_url( $image ); ?>" alt=""/>
      <?php endif; ?>
    </div>
    <div class="col-sm-6">
      <div class="popupnewsletter-widget">
        <?php if(!empty($title)){ ?>
            <h3>
              <span><?php echo esc_html( $title ); ?></span>
            </h3>
        <?php } ?>
        
        <?php if(!empty($description)){ ?>
            <p class="description">
                <?php echo trim( $description ); ?>
            </p>
        <?php } ?>      
        <?php mc4wp_show_form(''); ?>
        <!-- social -->
        <div class="socials">
          <?php if (isset($facebook) && $facebook): ?>
            <a href="<?php echo esc_url($facebook); ?>" title="<?php esc_html_e('Facebook', 'vegan'); ?>"><?php esc_html_e('Facebook', 'vegan'); ?></a>
          <?php endif; ?>
          <?php if (isset($instagram) && $instagram): ?>
            <a href="<?php echo esc_url($instagram); ?>" title="<?php esc_html_e('Instagram', 'vegan'); ?>"><?php esc_html_e('Instagram', 'vegan'); ?></a>
          <?php endif; ?>
          <?php if (isset($twitter) && $twitter): ?>
            <a href="<?php echo esc_url($twitter); ?>" title="<?php esc_html_e('Twitter', 'vegan'); ?>"><?php esc_html_e('Twitter', 'vegan'); ?></a>
          <?php endif; ?>
          <?php if (isset($pinterest) && $pinterest): ?>
            <a href="<?php echo esc_url($pinterest); ?>" title="<?php esc_html_e('Pinterest', 'vegan'); ?>"><?php esc_html_e('Pinterest', 'vegan'); ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
          
</div>