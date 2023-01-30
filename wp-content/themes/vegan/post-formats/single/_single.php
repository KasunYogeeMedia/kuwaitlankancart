<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-head">
        <div class="info-left">
            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php } ?>
        </div>
        <div class="meta">
            <?php
                printf( '<span class="post-author">%1$s<a href="%2$s">%3$s</a></span>',
                    _x( 'By ', 'Used before post author name.', 'vegan' ),
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    get_the_author()
                );
            ?> - 
            <span class="entry-date"><?php the_time( 'M d ,Y' ); ?></span>
            - 
            <?php esc_html_e('in ', 'vegan'); vegan_post_categories($post); ?>
        </div>
        
    </div>

    <?php if ( $post_format == 'gallery' ) {
        $gallery = vegan_post_gallery( get_the_content(), array( 'size' => 'full' ) );
    ?>
        <div class="entry-thumb <?php echo  (empty($gallery) ? 'no-thumb' : ''); ?>">
            <?php echo trim($gallery); ?>
        </div>
    <?php } elseif( $post_format == 'link' ) {
            $vegan_format = vegan_post_format_link_helper( get_the_content(), get_the_title() );
            $vegan_title = $vegan_format['title'];
            $vegan_link = vegan_get_link_attributes( $vegan_title );
            $thumb = vegan_post_thumbnail('', $vegan_link);
            echo trim($thumb);
        } else { ?>
    	<div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
    		<?php
                $thumb = vegan_post_thumbnail();
                echo trim($thumb);
            ?>
    	</div>
    <?php } ?>
	<div class="entry-content">


    	<div class="single-info info-bottom">
    		<?php
                if ( $post_format == 'gallery' ) {
                    $gallery_filter = vegan_gallery_from_content( get_the_content() );
                    echo trim($gallery_filter['filtered_content']);
                } else {
            ?>
                    <div class="entry-description"><?php the_content(); ?></div><!-- /entry-content -->
            <?php } ?>
    		<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'vegan' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'vegan' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
    		<div class="tag-social row">
                <div class="pull-left">
                    <?php vegan_post_tags(); ?>
                </div>
    			
    			<div class="pull-right">
                    
                   <?php if( vegan_get_config('show_blog_social_share', true) ) {
                        get_template_part( 'page-templates/parts/sharebox' );
                    } ?>         
                </div>
    		</div>
    	</div>
    </div>
</article>