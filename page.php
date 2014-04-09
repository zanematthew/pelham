<?php get_header(); ?>
<section>
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'partials/content', 'page' ); ?>
        <?php endwhile; ?>
        <?php if ( comments_open() || '0' != get_comments_number() ) : ?>
            <?php comments_template( '', true ); ?>
        <?php endif; ?>
    <?php endif; ?>
</section>
<?php get_footer(); ?>