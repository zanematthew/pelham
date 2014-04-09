<?php

/**
 * This file handles the Theme Customization for the Pelham Theme.
 *
 * Sources of reference are below.
 *
 * @link https://codex.wordpress.org/Theme_Customization_API
 * @link http://plugins.svn.wordpress.org/jetpack/tags/2.7/modules/custom-post-types/testimonial.php
 * @link https://gist.github.com/eduardozulian/4739075
 */


function pelham_custom_control_classess(){

    /**
     * Extend the default control to display a textarea
     */
    class Pelham_Customize_Textarea_Control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() { ?>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="5" style="width:100%; font-size: 13px; font-family: monospace; background: #808080; color: rgb(0, 250, 0); text-shadow: 1px 1px 0 #000; box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.3);" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php }
    }


    /**
     * Extends the image control to show a "history" of recently
     * uploaded images.
     */
    class Pelham_Customize_Image_Reloaded_Control extends WP_Customize_Image_Control {

        /**
         * Constructor.
         *
         * @since 3.4.0
         * @uses WP_Customize_Image_Control::__construct()
         *
         * @param WP_Customize_Manager $manager
         */
        public function __construct( $manager, $id, $args = array() ) {
            parent::__construct( $manager, $id, $args );
        }


        /**
         * Build the tabs history
         */
        public function tab_uploaded() {
            $my_context_uploads = get_posts( array(
                'post_type'  => 'attachment',
                'meta_key'   => '_wp_attachment_context',
                'meta_value' => $this->context,
                'orderby'    => 'post_date',
                'nopaging'   => true,
            ) ); ?>
            <div class="uploaded-target"></div>

            <?php
            if ( empty( $my_context_uploads ) )
                return;

            foreach ( (array) $my_context_uploads as $my_context_upload ){
                $this->print_tab_image( esc_url_raw( $my_context_upload->guid ) );
            }
        }
    }


    class Pelham_Customize_Input_Control extends WP_Customize_Control {

        public $type = 'input';

        public function render_content() { ?>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input type="text" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" />
            </label>
        <?php }
    }


    class Pelham_Customize_Number_Control extends WP_Customize_Control {

        public $type = 'number';

        public function render_content() { ?>
            <style type="text/css">
            .px {
                background: #DDD;
                padding: 5px 5px 4px;
                text-transform: uppercase;
                color: #FFF;
                margin: 0 0 0 -4px;
                border-radius: 0 5px 5px 0;
                text-shadow: 1px 1px 1px #C5C5C5;
            } </style>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input type="number" step="1" min="560" max="1600" placeholder="760" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>px" />
            <span class="px"><?php _e('px','pelham'); ?></span>
            </label>
        <?php }
    }

}


/**
 *
 *
 */
Class Pelham_Customizer {

    /**
     *
     * Used by hook: 'customize_register'
     *
     * @see add_action('customize_register',$func)
     * @param \WP_Customize_Manager $wp_customize
     * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
     * @since Pelham 1.0
     */
    public static function register( $wp_customize ) {

        pelham_custom_control_classess();

        $sections = array(
            array(
                'id' => 'pelham_custom_settings',
                'title' => __( 'Additional Options', 'pelham' ),
                'priority' => 999,
                'description' => __('This is the danger section, were you can add custom CSS! Add at your own risk!', 'pelham'),
            )
        );

        $settings = array(
            array(
                'id' => 'link_color',
                'default' => '#9e9e9e',
                'transport' => 'refresh', // Hover states do not work well with postMessage, so using refresh
                'type' => 'color',
                'control' => array(
                    'label' => __( 'Link Color', 'pelham' ),
                    'section' => 'colors'
                    )
                ),
            array(
                'id' => 'link_hover_color',
                'default' => '#000000',
                'transport' => 'refresh', // Hover states do not work well with postMessage, so using refresh
                'type' => 'color',
                'control' => array(
                        'label' => __( 'Link Hover Color', 'pelham' ),
                        'section' => 'colors'
                    )
                ),
            array(
                'id' => 'custom_text_color',
                'default' => '#000000',
                'transport' => 'refresh', // Hover states do not work well with postMessage, so using refresh
                'type' => 'color',
                'control' => array(
                        'label' => __( 'Text Color', 'pelham' ),
                        'section' => 'colors'
                    )
                ),

            // Brand settings
            array(
                'id' => 'title_background_color',
                'default' => '#000000',
                'type' => 'color',
                'control' => array(
                        'label' => __( 'Title Background', 'pelham' ),
                        'section' => 'title_tagline'
                    )
                ),
            array(
                'id' => 'title_text_color',
                'default' => '#ffffff',
                'type' => 'color',
                'control' => array(
                        'label' => __( 'Title Color', 'pelham' ),
                        'section' => 'title_tagline'
                    )
                ),
            array(
                'id' => 'title_logo',
                'type' => 'image',
                'control' => array(
                        'label' => __('Logo (replaces title)', 'pelham'),
                        'section' => 'title_tagline',
                        'context' => 'title_logo'
                    )
                ),
            array(
                'id' => 'custom_css',
                'settings' => 'pelham_custom_settings[custom_css]',
                'type' => 'textarea',
                'control' => array(
                        'label' => __( 'Custom CSS', 'pelham' ),
                        'section' => 'pelham_custom_settings'
                    )
                ),
            array(
                'id' => 'single_page_width',
                'settings' => 'pelham_custom_settings[single_page_width]',
                'type' => 'number',
                'default' => '760',
                'control' => array(
                    'label' => __( 'Set the width for single pages', 'pelham' ),
                    'section' => 'pelham_custom_settings'
                    )
                )
            );

        // Can we derive this? so we don't have to update it
        // as wp adds new sections?
        $default_sections = array(
            'title_tagline',
            'colors',
            'header_image',
            'background_image',
            'nav',
            'static_front_page'
            );

        foreach( $settings as $setting ){

            // We need to add support so we only register "NEW" controls
            // and don't RE-REGSITER existing controls!
            if ( ! empty( $sections ) && ! in_array( $setting['control']['section'], $default_sections ) ){
                // Do we have a section?
                foreach( $sections as $section ){
                    if ( $section['id'] == $setting['control']['section'] ){
                        $wp_customize->add_section( $section['id'], array(
                            'title' => $section['title'],
                            'priority' => $section['priority'],
                            'capability' => 'edit_theme_options',
                            'description' => $section['description']
                        ) );
                        $section_id = $section['id'];
                        $setting_id = $section['id'] . '[' . $setting['id'] . ']';
                    }
                }
            } else {
                $setting_id = $setting['id'];
                $section_id = $setting['control']['section'];
            }


            $wp_customize->add_setting( $setting_id, array(
                'default'   => empty( $setting['default'] ) ? null : $setting['default'],
                'transport' => empty( $setting['transport'] ) ? null : $setting['transport'],
            ) );

            // Handle controls here
            switch( $setting['type'] ){
                case 'color':
                    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
                        'label'    => $setting['control']['label'],
                        'section'  => $section_id,
                        'settings' => $setting_id
                    ) ) );
                    break;
                case 'image':
                    $wp_customize->add_control( new Pelham_Customize_Image_Reloaded_Control( $wp_customize, $setting_id, array(
                        'label'     => $setting['control']['label'],
                        'section'   => $section_id,
                        'settings'  => $setting_id,
                        'context'   => $setting['control']['context']
                    ) ) );
                    break;
                case 'textarea':
                    $wp_customize->add_control( new Pelham_Customize_Textarea_Control( $wp_customize, $setting_id, array(
                       'label'    => $setting['control']['label'],
                       'section'  => $section_id,
                       'settings' => $setting_id,
                    ) ) );
                    break;
                case 'input':
                    $wp_customize->add_control( new Pelham_Customize_Input_Control( $wp_customize, $setting_id, array(
                       'label'    => $setting['control']['label'],
                       'section'  => $section_id,
                       'settings' => $setting_id,
                    ) ) );
                    break;
                case 'number':
                    $wp_customize->add_control( new Pelham_Customize_Number_Control( $wp_customize, $setting_id, array(
                       'label'    => $setting['control']['label'],
                       'section'  => $section_id,
                       'settings' => $setting_id,
                    ) ) );
                    break;
            }
        }
    }


    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($name) has no defined value, the CSS will not be output.
     *
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $suffix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     *
     * @uses get_theme_mod()
     * @return string Returns a single line of CSS with selectors and a property.
     * @link https://codex.wordpress.org/Theme_Customization_API#Sample_Theme_Customization_Class
     * @since Pelham 1.0
     */
    public static function generate_css( $args ) {

        extract( wp_parse_args( $args, array(
            'selector' => null,
            'style' => null,
            'name' => null,
            'key' => null,
            'prefix' => null,
            'suffix' => null,
            'echo' => true
            ) ) );

        $return = '';
        $mod = get_theme_mod( $name );

        if ( is_array( $mod ) ){
            $mod = $mod[ $key ];
        }

        if ( ! empty( $mod ) ) {
            $return = sprintf( '%s{%s:%s;}',
                $selector,
                $style,
                $prefix.$mod.$suffix
            );

            if ( $echo ) {
                echo $return;
            }
        }
        return $return;
    }


    /**
     * Prints the custom CSS generated via the Theme Customize
     *
     * Used by hook: 'wp_head'
     *
     * @see add_action('wp_head',$func)
     * @since Pelham 1.0
     */
    public static function header_output() { ?>
        <!-- Theme Customizer CSS -->
        <style type="text/css"><?php

        // Yes, these can get messy!
        self::generate_css( array(
            'selector' => '
            a,
            #masthead nav .current-menu-item a',
            'style' => 'color',
            'name' => 'link_color'
            ) );

        self::generate_css( array(
            'selector' => '
            a:hover .genericon,
            a .genericon:hover,
            a:hover,

            #masthead nav .current-menu-item a:hover,
            #masthead nav .current-menu-item > a,
            #masthead nav .current-menu-ancestor > a,
            #masthead nav .sub-menu a:hover,
            #masthead nav .current-menu-item .sub-menu a:hover,

            .genericon:hover,
            .genericon:hover a',
            'style' => 'color',
            'name' => 'link_hover_color'
            ) );

        self::generate_css( array(
            'selector' => '.site-header .site-title',
            'style' => 'background-color',
            'name' => 'title_background_color',
            'key' => 'title_tagline'
            ) );

        self::generate_css( array(
            'selector' => '.site-header .site-title a',
            'style' => 'color',
            'name' => 'title_text_color',
            'key' => 'title_tagline'
            ) );

        self::generate_css( array(
            'selector' => '.site-header .site-title a',
            'style' => 'background-image',
            'name' => 'title_logo',
            'key' => 'title_tagline',
            'prefix' => 'url(',
            'suffix' => '); background-repeat: no-repeat; background-position: 0; background-size: 100% auto; text-indent: -999em; overflow: hidden; width: 70px;'
            ) );

        self::generate_css( array(
            'selector' => 'main.grid-container',
            'style' => 'max-width',
            'name' => 'pelham_custom_settings',
            'key' => 'single_page_width',
            'suffix' => 'px'
        ) );

        self::generate_css( array(
            'selector' => 'main, .site-header .site-description',
            'style' => 'color',
            'name' => 'custom_text_color',
            'key' => 'color'
        ) );

        $danger = get_theme_mod('pelham_custom_settings');
        echo $danger['custom_css'];
        ?></style>
        <!-- Theme Customizer CSS -->
        <?php
    }
}
add_action( 'customize_register', array( 'Pelham_Customizer', 'register' ) );
add_action( 'wp_head', array( 'Pelham_Customizer', 'header_output' ) );
