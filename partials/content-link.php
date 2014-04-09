<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
    <?php if ( is_single() ) : ?>
        <?php get_template_part( 'partials/entry-meta' ); ?>
        <div class="entry-main">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    <?php else : ?>
        <div class="entry-main">
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before'=>__('Permalink to: ','pelham')) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        </div>
    <?php endif; ?>
</article>