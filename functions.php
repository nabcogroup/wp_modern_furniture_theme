<?php
/**
 * Modern Furniture functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Modern_Furniture
 */


 define ('MF_THEME_DOMAIN','modern-furniture');
 define ('MF_VER','ver 0.1');


require get_template_directory() . '/inc/class/class-theme-dev-customizer.php';

require get_template_directory() . '/inc/theme/class-theme-sidebar.php';
require get_template_directory() . '/inc/theme/class-theme-setup.php';

/**
 * Theme Component
 */
require get_template_directory() . '/inc/theme/components/template-components.php';


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/theme/theme-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/abstract-class-customizer.php';
require get_template_directory() . '/inc/customizer/class-extend-customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce/woocommerce.php';
}
