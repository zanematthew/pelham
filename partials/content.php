<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

    <div class="entry-main clearfix">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="entry-featured-image">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before'=>__('Permalink to: ','pelham')) ); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
            </div>
        <?php endif; ?>

        <?php if ( get_the_title() ) : ?>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before'=>__('Permalink to: ','pelham')) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php endif; ?>

        <?php get_template_part( 'partials/entry-meta' ); ?>

        <?php if ( ! is_single() && has_excerpt() ) : ?>
            <div class="entry-excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php else : ?>
            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'pelham' ), 'after' => '</div>' ) ); ?>
            </div>
        <?php endif; ?>
    </div>
</article>