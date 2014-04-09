<?php get_header(); ?>
<header>
    <h1 class="page-title">
        <?php
            if ( is_category() ) :
                single_cat_title();

            elseif ( is_tag() ) :
                single_tag_title();

            elseif ( is_day() ) :
                printf( __( 'Day %s', 'pelham' ), '<span>' . get_the_date() . '</span>' );

            elseif ( is_month() ) :
                printf( __( 'Month %s', 'pelham' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

            elseif ( is_year() ) :
                printf( __( 'Year %s', 'pelham' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

            elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
                _e( 'Asides', 'pelham' );

            elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
                _e( 'Images', 'pelham');

            elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
                _e( 'Videos', 'pelham' );

            elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
                _e( 'Quotes', 'pelham' );

            elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
                _e( 'Links', 'pelham' );

            else :
                _e( 'Archives', 'pelham' );

            endif;
        ?>
    </h1>
    <?php
        // Show an optional term description.
        $term_description = term_description();
        if ( ! empty( $term_description ) ) :
            printf( '<div class="taxonomy-description">%s</div>', $term_description );
        endif;
    ?>
</header>

<section class="<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>grid-70 <?php endif; ?>grid-parent">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'partials/content', get_post_format() == '' ? 'archive-' . get_post_type() : get_post_format() ); ?>
        <?php endwhile; ?>
        <?php comments_template( '', true ); ?>
    <?php else : ?>
        <div class="entry-main">
            <div class="entry-content">
                <?php _e('Archive nothing','pelham'); ?>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php get_sidebar( get_post_type() ); ?>
<?php get_footer(); ?>