<?php  

/**
 * Template Name: Standard Page
 *
 * Template for displaying a standard page.
 *
 */



get_header();

?>

<article class="page-wrapper">
    <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post(); ?>
            <div class="body-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</article>


<?php get_footer(); ?>