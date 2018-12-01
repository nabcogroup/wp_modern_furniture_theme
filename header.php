<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Modern_Furniture
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="page-site">

	
	<?php get_template_part('template-parts/components/component', 'header') ?>
	
	<?php 
		//get the primary menu
		get_template_part('template-parts/components/component', 'menu')
	?>


	<main id="content" class="site-content">
		
		<?php if(is_front_page() || is_home()) : ?>
			<?php get_template_part('template-parts/components/component','slider') ?>
		<?php endif; ?>
		
		<?php 
			/**
			* Functions hooked in to content_top
			*
			* @hooked woocommerce_breadcrumb - 10
			*/
			do_action( 'modfurn_content_top' );
		?>

