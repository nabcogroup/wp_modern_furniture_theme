<?php


class ModernFurniture_WooCommerce extends Theme_Hook {

    public static $instance;

    public function __construct() {

        $this->actions = array(
            'after_setup_theme' => 'woocommerce_setup',
            'wp_enqueue_scripts' => 'woocommerce_scripts',
            'modfurn_content_top' => array('fn' => 'woocommerce_breadcrumb', 'pos' => 10 ),
        );

        $this->filters = array(
            'body_class'                                => 'woocommerce_active_body_class',
            'loop_shop_per_page'                        => 'woocommerce_products_per_page',
            'woocommerce_product_thumbnails_columns'    => 'woocommerce_thumbnail_columns',
            'loop_shop_columns'                         =>  'woocommerce_loop_columns',
            'woocommerce_output_related_products_args'  =>  'woocommerce_related_products_args',
            'woocommerce_breadcrumb_defaults'           =>  'woocommerce_breadcrumb_defaults'
        );

        parent::__construct();
        
        // add_action( 'after_setup_theme', array($this,'woocommerce_setup'));
        // add_action( 'wp_enqueue_scripts', array($this,'woocommerce_scripts') );

        // add_action("modfurn_content_top","woocommerce_breadcrumb", 10);
        
        /**
         * Disable the default WooCommerce stylesheet.
         *
         * Removing the default WooCommerce stylesheet and enqueing your own will
         * protect you during WooCommerce core updates.
         *
         * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
         */
        //add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

        // add_filter( 'body_class', array($this,'woocommerce_active_body_class'));
        // add_filter( 'loop_shop_per_page', array($this,'woocommerce_products_per_page') );
        // add_filter( 'woocommerce_product_thumbnails_columns', array($this,'woocommerce_thumbnail_columns') );
        // add_filter( 'loop_shop_columns', array($this,'woocommerce_loop_columns') );
        // add_filter( 'woocommerce_output_related_products_args', array($this,'woocommerce_related_products_args') );

        //  //change data filter
        //  add_filter( 'woocommerce_breadcrumb_defaults', array($this,'woocommerce_breadcrumb') );
    }
    
    /**
     * WooCommerce setup function.
     *
     * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
     * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
     *
     * @return void
     */
    public function woocommerce_setup() {

        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );


        /**
        * Disable the default WooCommerce stylesheet.
        *
        * Removing the default WooCommerce stylesheet and enqueing your own will
        * protect you during WooCommerce core updates.
        *
        * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
        */
        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
    }

    
    /**
     * WooCommerce specific scripts & stylesheets.
     *
     * @return void
     */
    public function woocommerce_scripts() {
        
        //wp_enqueue_style( 'modern-furniture-woocommerce-style', get_template_directory_uri() . '/dist/css/woocommerce.css' );

        $font_path   = WC()->plugin_url() . '/assets/fonts/';
        
        $inline_font = '@font-face {
                font-family: "star";
                src: url("' . $font_path . 'star.eot");
                src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
                    url("' . $font_path . 'star.woff") format("woff"),
                    url("' . $font_path . 'star.ttf") format("truetype"),
                    url("' . $font_path . 'star.svg#star") format("svg");
                font-weight: normal;
                font-style: normal;
            }';

            wp_add_inline_style( 'modern-furniture-woocommerce-style', $inline_font );
    }

    
    /**
     * Add 'woocommerce-active' class to the body tag.
     *
     * @param  array $classes CSS classes applied to the body tag.
     * @return array $classes modified to include 'woocommerce-active' class.
     */
    public function woocommerce_active_body_class( $classes ) {
        $classes[] = 'woocommerce-active';
        return $classes;
    }

    
    /**
     * Products per page.
     *
     * @return integer number of products.
     */
    public function woocommerce_products_per_page() {
        return 12;
    }


    /**
     * Product gallery thumnbail columns.
     *
     * @return integer number of columns.
     */
    public function woocommerce_thumbnail_columns() {
        return 4;
    }
    

    /**
     * Default loop columns on product archives.
     *
     * @return integer products per row.
     */
    public function woocommerce_loop_columns() {
        return 3;
    }

    
    /**
     * Related Products Args.
     *
     * @param array $args related products args.
     * @return array $args related products args.
     */
    public function woocommerce_related_products_args( $args ) {
        $defaults = array(
            'posts_per_page' => 3,
            'columns'        => 3,
        );
        $args = wp_parse_args( $defaults, $args );

        return $args;
    }

      /**
     * 
     * hooked: woocommerce_breadcrumb
     *  - change woocommerce breadcrumb
     */
    public function woocommerce_breadcrumb_defaults() {
        return array(
            'delimiter'   => ' » ',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><div class="container"><i class="fas fa-home"></i> ',
            'wrap_after'  => '</div></nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );  

    }

    
}

return new ModernFurniture_WooCommerce();
