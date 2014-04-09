<?php get_header(); ?>
<section class="<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>grid-70 <?php endif; ?>grid-parent">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'partials/content', get_post_format() ); ?>
            <footer class="entry-footer">
                <?php get_template_part( 'partials/entry-navigation' ); ?>
                <a href="#expand-<?php echo get_the_ID(); ?>" id="expand-footer-handle"><span class="genericon genericon-expand"></span></a>
                <div id="expand-footer-target" style="display: none;">
                    <?php get_template_part( 'partials/entry-meta' ); ?>
                </div>
            </footer>
        <?php endwhile; ?>
        <?php if ( comments_open() || '0' != get_comments_number() ) : ?>
            <?php comments_template( '', true ); ?>
        <?php endif; ?>
    <?php endif; ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>