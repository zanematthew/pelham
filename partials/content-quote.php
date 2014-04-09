<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-main">
        <?php if ( get_the_title() ) : ?>
            <header>
                <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before'=>__('Permalink to: ','pelham')) ); ?>" rel="bookmark"><span class="genericon genericon-link"></span><?php the_title(); ?></a></h1>
            </header>
        <?php endif; ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</article>