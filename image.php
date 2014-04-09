<?php get_header(); ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <div class="grid-50">
                    <hgroup>
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        <h2><?php _e('&larr; Back to ', 'pelham'); ?> <a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" title="<?php echo get_the_title( $post->post_parent ); ?>" id="post_parent_page"><?php echo get_the_title( $post->post_parent ); ?></a></h2>
                    </hgroup>
                </div>
                <div class="grid-50">
                    <?php get_template_part( 'partials/entry-meta' ); ?>
                </div>
                <div class="grid-100">
                    <?php get_template_part( 'partials/entry-navigation' ); ?>
                </div>
            </header>

            <div class="entry-attachment">
                <div class="attachment">
                    <?php pelham_attachment_image(); ?>
                </div>
            </div>

            <div class="grid-100">
                <?php get_template_part( 'partials/entry-navigation' ); ?>
            </div>

            <?php if ( has_excerpt() ) : ?>
                <div class="entry-caption">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>

            <?php if ( get_the_content() ) : ?>
            <div class="entry-content">
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'pelham' ), 'after' => '</div>' ) ); ?>
            </div>
            <?php endif; ?>

        </article>

        <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || '0' != get_comments_number() )
                comments_template();
        ?>
    <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>