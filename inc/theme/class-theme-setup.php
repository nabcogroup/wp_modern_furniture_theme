<?php 



if(!class_exists('ModernFurniture')) {

    class ModernFurniture {


        public function __construct(ModernFurniture_SidebarRegister $sidebar) {


            add_action('after_setup_theme',array($this,'theme_setup'));
            add_action( 'after_setup_theme', array($this,'custom_header_setup') );
            add_action( 'after_setup_theme', array($this,'content_width'), 0 );

            add_action( 'wp_enqueue_scripts', array($this,'enqueue') );
            
            add_filter( 'body_class',array($this,'body_classes'));
            add_action( 'wp_head', array($this,'pingback_header') );
            
            add_action( 'widgets_init', array($sidebar, 'widgets_init') );
        }

        public function theme_setup() {

            /*
		    * Make theme available for translation.
		    * Translations can be filed in the /languages/ directory.
		    * If you're building a theme based on Modern Furniture, use a find and replace
		    * to change 'modern-furniture' to the name of your theme in all the template files.
		    */
		    load_theme_textdomain( MF_THEME_DOMAIN, get_template_directory() . '/languages' );

		    // Add default posts and comments RSS feed links to head.
		    add_theme_support( 'automatic-feed-links' );

            /*
            * Let WordPress manage the document title.
            * By adding theme support, we declare that this theme does not use a
            * hard-coded <title> tag in the document head, and expect WordPress to
            * provide it for us.
            */
            add_theme_support( 'title-tag' );

            /*
            * Enable support for Post Thumbnails on posts and pages.
            *
            * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
            */
            add_theme_support( 'post-thumbnails' );

            // This theme uses wp_nav_menu() in one location.
            register_nav_menus( array(
                'primary'   => esc_html__( 'Primary', MF_THEME_DOMAIN ),
                'footer'    =>  esc_html__( 'Footer', MF_THEME_DOMAIN ),
            ) );

            /*
            * Switch default core markup for search form, comment form, and comments
            * to output valid HTML5.
            */
            add_theme_support( 'html5', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ) );

            // Set up the WordPress core custom background feature.
            add_theme_support( 'custom-background', apply_filters( 'modern_furniture_custom_background_args', array(
                'default-color' => 'ffffff',
                'default-image' => '',
            ) ) );

            // Add theme support for selective refresh for widgets.
            add_theme_support( 'customize-selective-refresh-widgets' );

            /**
             * Add support for core custom logo.
             *
             * @link https://codex.wordpress.org/Theme_Logo
             */
            add_theme_support( 'custom-logo', array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            ) );
        }

        /**
         * Set up the WordPress core custom header feature.
         *
         * @uses modern_furniture_header_style()
         */
        public function custom_header_setup() {
            add_theme_support( 'custom-header', apply_filters( 'modern_furniture_custom_header_args', array(
                'default-image'          => '',
                'default-text-color'     => '000000',
                'width'                  => 1000,
                'height'                 => 250,
                'flex-height'            => true,
                'wp-head-callback'       => array($this,'header_style'),
            ) ) );
        }


        /**
         * Styles the header image and text displayed on the blog.
         *
         * @see modern_furniture_custom_header_setup().
         */
        public function header_style() {
            $header_text_color = get_header_textcolor();

            /*
            * If no custom options for text are set, let's bail.
            * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
            */
            if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
                return;
            }

            // If we get this far, we have custom styles. Let's do this.
            echo '<style type="text/css">';
            ?>
            <?php
            // Has the text been hidden?
            if ( ! display_header_text() ) :
                ?>
                .site-title,
                .site-description {
                    position: absolute;
                    clip: rect(1px, 1px, 1px, 1px);
                }
            <?php
            // If the user has set a custom color for the text use that.
            else :
                ?>
                .site-title a,
                .site-description {
                    color: #<?php echo esc_attr( $header_text_color ); ?>;
                }
            <?php endif; ?>
            <?php
            echo "</style>";
        }


                
        /**
         * Set the content width in pixels, based on the theme's design and stylesheet.
         *
         * Priority 0 to make it available to lower priority callbacks.
         *
         * @global int $content_width
         */
        public function content_width() {
            // This variable is intended to be overruled from themes.
            // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
            // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
            $GLOBALS['content_width'] = apply_filters( 'modern_furniture_content_width', 640 );
        }

        /**
        * Register widget area.
        *
        * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
        */
        public function widgets_init() {
            
            //initialize all the sidebar for widget
            $this->sidebar->widgets_init();
        }

                
        /**
         * Enqueue scripts and styles.
         */
        public function enqueue() {
            wp_enqueue_style( 'modern-furniture-style', get_template_directory_uri() . '/dist/css/style.css',array(),MF_VER );
            wp_enqueue_script( 'modern-furniture-navigation', get_template_directory_uri() . '/dist/js/theme.min.js', array(), MF_VER, true );

            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }
        }

        /**
        * Adds custom classes to the array of body classes.
        *
        * @param array $classes Classes for the body element.
        * @return array
        */
        public function body_classes($classes) {

            $classes[] = 'mf-theme';
            // Adds a class of hfeed to non-singular pages.
            if ( ! is_singular() ) {
                $classes[] = 'hfeed';
            }

            // Adds a class of no-sidebar when there is no sidebar present.
            if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
                $classes[] = 'no-sidebar';
            }

            return $classes;
        }

        /**
         * Add a pingback url auto-discovery header for single posts, pages, or attachments.
         */
        public function pingback_header() {
            if ( is_singular() && pings_open() ) {
                echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
            }
        }

    } //end class


}

return new ModernFurniture(new ModernFurniture_SidebarRegister());