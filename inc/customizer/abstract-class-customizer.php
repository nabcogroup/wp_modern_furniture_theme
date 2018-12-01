<?php

abstract class ModernFurniture_AbstractCustomizer {

    public function __construct() {

        add_action( 'customize_register', array($this,'customize_register') );

        add_action( 'customize_controls_enqueue_scripts', array($this,'customize_preview_js') );

    }

    public abstract function extend_customize(&$wp_customize);
    
    /**
    * Add postMessage support for site title and description for the Theme Customizer.
    *
    * @param WP_Customize_Manager $wp_customize Theme Customizer object.
    */
    public function customize_register($wp_customize) {
        
        $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
        $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

        if ( isset( $this->wp_customize->selective_refresh ) ) {
            
            $wp_customize->selective_refresh->add_partial( 'blogname', array(
                'selector'        => '.site-title a',
                'render_callback' => array($this,'customize_partial_blogname'),
            ) );

            $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
                'selector'        => '.site-description',
                'render_callback' => array($this,'partial_blogdescription'),
            ) );
        }

        $this->extend_customize($wp_customize);
    }

    /**   
     * Render the site title for the selective refresh partial.
     *
     * @return void
     */
    public function partial_blogname() {
        bloginfo( 'name' );
    }

    /**
     * Render the site tagline for the selective refresh partial.
     *
     * @return void
     */
    public function partial_blogdescription() {
        bloginfo( 'description' );
    }

    /**
     * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
     */
    public function customize_preview_js() {
        wp_enqueue_script( 'modernfurniture-customizer', get_template_directory_uri() . 'inc/customizer/js/customizer.js', array( 'customize-preview' ), '20151215', true );
    }
}