<?php
/**
 * Template Name: Blog Template
 */
get_header(); ?>
<section class="<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>grid-70 <?php endif; ?>grid-parent">
    <?php if ( have_posts() && get_query_var('paged') == 0 ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'partials/content', 'page' ); ?>
        <?php endwhile; wp_reset_postdata(); ?>
    <?php endif; ?>

    <?php
        $wp_query->query( array(
            'paged' => ( get_query_var('paged') ) ? get_query_var('paged') : 1,
            'posts_per_page' => get_option('posts_per_page')
        ) );
    ?>
    <?php if ( $wp_query->have_posts() ) : ?>
        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
            <?php get_template_part( 'partials/content', get_post_format() ); ?>
        <?php endwhile; wp_reset_postdata(); ?>
    <?php endif; ?>
</section>
<?php get_sidebar( get_post_type() ); ?>
<?php get_footer(); ?>