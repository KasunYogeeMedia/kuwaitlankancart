<?php
    $thumbsize = isset($thumbsize) ? $thumbsize : vegan_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 25;
?>

<article <?php post_class('post post-grid'); ?>>
    <?php
    $thumb = vegan_display_post_thumb($thumbsize);
    echo trim($thumb);
    ?>
    <div class="entry-content <?php echo !empty($thumb) ? '' : 'no-thumb'; ?>">
        <div class="entry-meta">
            <div class="info">
                
                <?php if (get_the_title()) { ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>
                <div class="meta">
                    <?php
                        printf( '<span class="post-author">%1$s<a href="%2$s">%3$s</a></span>',
                            _x( 'By ', 'Used before post author name.', 'vegan' ),
                            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                            get_the_author()
                        );
                    ?> - 
                    <span class="date"><?php the_time( 'M d , Y' ); ?>  </span>
                    
                </div>

            </div>
        </div>
        <div class="info-bottom">
            <?php if (! has_excerpt()) { ?>
                <div class="entry-description"><?php echo vegan_substring( get_the_content(), $nb_word, '...' ); ?></div>
            <?php } else { ?>
                <div class="entry-description"><?php echo vegan_substring( get_the_excerpt(), $nb_word, '...' ); ?></div>
            <?php } ?>
        </div>
    </div>
</article>