<?php  

/**
 * Template Name: Front Page
 *
 * Template for displaying a front page.
 *
 */



get_header();


$customize_options = get_theme_mod('mf-front-options', array());

?>

<!-- product collection -->
<?php get_template_part('template-parts/sections/section','collection')  ?>


<!-- testominal section -->
<?php get_template_part('template-parts/sections/section', 'testimonial') ?>

<?php get_footer(); ?>