<?php if ( vegan_get_config('show_searchform') ): ?>

	<div class="apus-search-form">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<?php if ( vegan_get_config('search_type') != 'all' && vegan_get_config('search_category') ): ?>
				<div class="select-category">
					<?php if ( vegan_get_config('search_type') == 'product' ):
						$args = array(
						    'show_counts' => false,
						    'hierarchical' => true,
						    'show_uncategorized' => 0
						);
					?>
					    <?php wc_product_dropdown_categories( $args ); ?>

					<?php elseif ( vegan_get_config('search_type') == 'post' ):
						$args = array(
							'show_option_all' => esc_html__( 'All categories', 'vegan' ),
						    'show_counts' => false,
						    'hierarchical' => true,
						    'show_uncategorized' => 0,
						    'name' => 'category',
							'id' => 'search-category',
							'class' => 'postform dropdown_product_cat',
						);
					?>
						<?php wp_dropdown_categories( $args ); ?>
					<?php endif; ?>
			  	</div>
		  	<?php endif; ?>
		  	<div class="input-group">
		  		<input type="text" placeholder="<?php esc_html_e( 'Search', 'vegan' ); ?>" name="s" class="apus-search form-control"/>
				<span class="input-group-btn">
			     	<button type="submit" class="button-search btn"><i class="mn-icon-52"></i></button>
			    </span>
		  	</div>
			<?php if ( vegan_get_config('search_type') != 'all' ): ?>
				<input type="hidden" name="post_type" value="<?php echo vegan_get_config('search_type'); ?>" class="post_type" />
			<?php endif; ?>
		</form>
	</div>
<?php endif; ?>