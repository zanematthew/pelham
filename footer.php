            <?php if ( $wp_query->max_num_pages > 1 && ! $wp_query->is_404 ) : ?>
                <div class="pagination-container grid-100">
                    <?php echo paginate_links( array(
                        'base' => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $wp_query->max_num_pages
                    ) ); ?>
                </div>
            <?php endif; ?>

            <footer class="grid-100 grid-parent" id="site-footer">
                <hgroup class="site-branding">
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                </hgroup>
                <?php if ( has_nav_menu( 'footer_primary' ) ) : ?>
                    <nav class="main-navigation" role="navigation">
                        <?php wp_nav_menu( array( 'theme_location' => 'footer_primary' ) ); ?>
                    </nav>
                <?php endif; ?>
                <?php if ( has_nav_menu( 'footer_secondary' ) ) : ?>
                    <div class="site-secondary-navigation">
                        <?php wp_nav_menu( array( 'theme_location' => 'footer_secondary', 'fallback_cb' => false ) ); ?>
                    </div>
                <?php endif; ?>
            </footer>
        <?php wp_footer(); ?>
    </main>
</body>
</html>