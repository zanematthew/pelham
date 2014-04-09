<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">

<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="masthead" class="site-header" role="banner">

    <?php if ( has_nav_menu( 'header_secondary' )) : ?>
        <div class="site-secondary-navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'header_secondary', 'fallback_cb' => false, 'depth' => 1 ) ); ?>
        </div>
    <?php endif; ?>

    <div class="primary-header-area">
        <div class="site-branding">
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php if ( get_bloginfo( 'description' ) ) : ?>
                <h2 class="site-description"><span class="long-title"><?php bloginfo( 'description' ); ?></span></h2>
            <?php endif; ?>
        </div>

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <h1 class="menu-toggle"><?php _e( 'Menu', '_s' ); ?></h1>
            <?php wp_nav_menu( array( 'theme_location' => 'header_primary' ) ); ?>
        </nav><!-- #site-navigation -->

        <div class="search-container">
            <span class="genericon genericon-search" id="search_toggle_handle"><a href="#"></a></span>
            <div id="search_form_target" class="search-form-container" style="display: none;">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</header><!-- #masthead -->

<main class="grid-container grid-parent">
    <?php if ( get_header_image() ) : ?>
        <div class="custom-header-container">
            <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo get_post_meta( get_custom_header()->attachment_id, '_wp_attachment_image_alt', true ); ?>" title="<?php echo get_post_meta( get_custom_header()->attachment_id, '_wp_attachment_image_alt', true ); ?>" />
        </div>
    <?php endif; ?>