<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-main">
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="entry-featured-image">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before'=>__('Permalink to: ','pelham')) ); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
        </div>
        <?php endif; ?>
        <h1 class="entry-title"><?php the_title(); ?> <?php edit_post_link(__('Edit','pelham')); ?></h1>
        <div class="entry-content">
            <?php the_content(''); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'pelham' ), 'after' => '</div>' ) ); ?>
        </div>
    </div>
</article>
