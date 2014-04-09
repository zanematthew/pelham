<?php get_header(); ?>
<section>
    <header class="page-header">
        <h1 class="page-title"><?php printf( __( 'Search Results for %s', '_s' ), '<strong>' . get_search_query() . '</strong>' ); ?></h1>
        <div class="result-count">
            <?php _e('Currently showing','pelham'); ?><em><?php global $wp_query; echo $total_results = $wp_query->found_posts; ?></em>
        </div>
    </header><!-- .page-header -->
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'partials/content', 'search' ); ?>
        <?php endwhile; ?>
    <?php else : ?>
        <?php _e('Sorry, there are no search results', 'pelham'); ?>
    <?php endif; ?>
</section>
<?php get_footer(); ?>
