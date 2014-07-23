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