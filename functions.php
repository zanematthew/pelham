<?php

/**
 * Set our content width, used for media assets and others items
 */
if ( ! isset( $content_width ) )
    $content_width = 512; /* pixels */


/**
 * Add various features during theme set-up, note this runs
 * before init
 *
 * @package pehlam
 */
function pelham_setup(){
    add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', apply_filters( 'pelham_post_formart_args', array(
        'aside',
        'gallery',
        'link',
        'image',
        'quote',
        'chat'
        ) ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-background', apply_filters( 'pelham_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => ''
    ) ) );
    add_theme_support( 'custom-header', apply_filters( 'pelham_custom_header_args', array(
        'default-image'          => '',
        'width'                  => 960,
        'height'                 => 250,
        'flex-height'            => true,
        'header-text'            => false
    ) ) );

    /**
     * Load the style sheet to ensure that the wysiwyg editor matches
     * the styling of the front end.
     */
    add_editor_style();

    /**
     * Load our custom font style sheet so our fonts match
     */
    add_editor_style( str_replace( ',', '%2C', pelham_copy_font_url() ) );
    add_editor_style( str_replace( ',', '%2C', pelham_title_font_url() ) );

    register_nav_menus( apply_filters( 'pelham_nav_menus_args', array(
        'header_primary' => __( 'Primary Header Menu', 'pelham' ),
        'header_secondary' => __( 'Secondary Header Menu', 'pelham' ),

        'footer_primary' => __( 'Primary Footer Menu', 'pelham' ),
        'footer_secondary' => __( 'Secondary Footer Menu', 'pelham' )
    ) ) );

    add_image_size( 'pelham_brand_logo', 124, 100 );
}
add_action( 'after_setup_theme', 'pelham_setup' );


/**
 * The custom Google font url for our titles, nav, etc.
 *
 * @return The the Google font url
 */
function pelham_title_font_url(){
    $protocol = is_ssl() ? 'https' : 'http';
    return "$protocol://fonts.googleapis.com/css?family=Lato:300,400,700";
}


/**
 * The custom Google font url for our copy fonts, i.e., paragraph, etc.
 *
 * @return The the Google font url
 */
function pelham_copy_font_url(){
    $protocol = is_ssl() ? 'https' : 'http';
    return "$protocol://fonts.googleapis.com/css?family=Merriweather";
}


/**
 * Load our CSS, JS, and custom fonts
 *
 * @package pelham
 */
function pelham_scripts(){

    $theme = wp_get_theme( 'pelham' );

    wp_enqueue_style( 'pelham-title-font', pelham_title_font_url(), '', $theme->Version );
    wp_enqueue_style( 'pelham-copy-font', pelham_copy_font_url(), '', $theme->Version );

    wp_enqueue_style( 'genericons', get_template_directory_uri() . '/vendor/genericons/genericons.css', '', $theme->Version );
    wp_enqueue_style( 'unsemantic-grid-responsive', get_template_directory_uri() . '/vendor/unsemantic/unsemantic-grid-responsive.css', '', $theme->Version );

    wp_enqueue_style( 'pelham-navigation-style', get_template_directory_uri() . '/assets/stylesheets/menu.css', '', $theme->Version );
    wp_enqueue_style( 'pelham-style', get_stylesheet_uri(), array('genericons','unsemantic-grid-responsive', 'pelham-navigation-style'), $theme->Version );

    wp_enqueue_script( 'pelham-scripts', get_template_directory_uri() . '/assets/javascripts/scripts.js', array('jquery'), $theme->Version, true );
    wp_enqueue_script( 'pelham-navigation', get_template_directory_uri() . '/assets/javascripts/navigation.js', array('pelham-scripts'), $theme->Version, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'pelham_scripts' );


/**
 * Activate our widget area
 *
 * @package pehlam
 */
function pelham_widgets_init(){
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'pelham' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h1 class="widgettitle">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'pelham_widgets_init' );


require get_template_directory() . '/helpers/customizer.php';
require get_template_directory() . '/helpers/misc.php';