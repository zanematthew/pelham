<?php

add_filter( 'use_default_gallery_style', '__return_false' );


/**
 * Returns true if a blog has more than 1 category.
 */
function pelham_categorized_blog(){
    if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ){
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
                'hide_empty' => 1,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'all_the_cool_cats', $all_the_cool_cats );
    }

    if ( '1' != $all_the_cool_cats ){
        // This blog has more than 1 category so pelham_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so pelham_categorized_blog should return false.
        return false;
    }
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pelham_body_classes( $classes ) {

    if ( has_nav_menu('header_secondary') ){
        $classes[] = 'has-header-secondary-menu';
    }

    if ( is_singular() ){
        $classes[] = 'singular';
    }

    if ( is_active_sidebar('sidebar-1') ){
        $classes[] = 'has-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'pelham_body_classes' );


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function pelham_wp_title( $title, $sep ) {
    global $page, $paged;

    if ( is_feed() ) {
        return $title;
    }

    // Add the blog name
    $title .= get_bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 ) {
        $title .= " $sep " . sprintf( __( 'Page %s', 'pelham' ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', 'pelham_wp_title', 10, 2 );


/**
 * Displays the attachment image at a given size with a hyper link for
 * the next/previous image.
 *
 * @package pehlam
 */
function pelham_attachment_image(){
    $post                = get_post();
    $attachment_size     = apply_filters( 'pelham_attachment_size', array( 1200, 1200 ) );
    $next_attachment_url = wp_get_attachment_url();

    /**
     * Grab the IDs of all the image attachments in a gallery so we can get the
     * URL of the next adjacent image in a gallery, or the first image (if
     * we're looking at the last image in a gallery), or, in a gallery of one,
     * just the link to that image file.
     */
    $attachment_ids = get_posts( array(
        'post_parent'    => $post->post_parent,
        'fields'         => 'ids',
        'numberposts'    => -1,
        'post_status'    => 'inherit',
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'order'          => 'ASC',
        'orderby'        => 'menu_order ID'
    ) );

    // If there is more than 1 attachment in a gallery...
    if ( count( $attachment_ids ) > 1 ){
        foreach ( $attachment_ids as $attachment_id ){
            if ( $attachment_id == $post->ID ){
                $next_id = current( $attachment_ids );
                break;
            }
        }

        // get the URL of the next image attachment...
        if ( $next_id )
            $next_attachment_url = get_attachment_link( $next_id );

        // or get the URL of the first image attachment.
        else
            $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
    }

    printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
        esc_url( $next_attachment_url ),
        the_title_attribute( array( 'echo' => false ) ),
        wp_get_attachment_image( $post->ID, $attachment_size )
    );
}