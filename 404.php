<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package pelham
 */

get_header(); ?>
<section>

    <hgroup class="page-header">
        <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'pelham' ); ?></h1>
    </hgroup><!-- .page-header -->

    <p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'pelham' ); ?></p>

    <?php get_search_form(); ?>

    <div class="grid-custom">
        <div class="grid-25">
            <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
        </div>

        <?php if ( pelham_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
            <div class="grid-25">
                <div class="widget widget_categories">
                    <h2 class="widgettitle"><?php _e( 'Most Used Categories', 'pelham' ); ?></h2>
                    <ul>
                    <?php wp_list_categories( array(
                            'orderby'    => 'count',
                            'order'      => 'DESC',
                            'show_count' => 1,
                            'title_li'   => '',
                            'number'     => 10,
                        ) ); ?>
                    </ul>
                </div><!-- .widget -->
            </div>
        <?php endif; ?>

        <div class="grid-25">
            <?php the_widget( 'WP_Widget_Archives', 'dropdown=1' ); ?>
        </div>
        <div class="grid-25">
            <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>