<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-main">
        <?php if ( get_the_title() ) : ?>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before'=>__('Permalink to: ','pelham')) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php endif; ?>
        <?php if ( has_excerpt() ) : ?>
            <div class="entry-excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php else : ?>
            <div class="entry-content">
                <?php if ( has_shortcode( get_the_content(), 'gallery' ) ) : ?>
                    <?php the_content(); ?>
                <?php else : ?>
                    <?php echo wp_trim_words( get_the_content(), 40 ); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <time><?php the_time('D M j, Y'); ?></time>
    </div>
</article>
