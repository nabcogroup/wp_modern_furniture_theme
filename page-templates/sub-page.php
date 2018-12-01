<?php  

/**
 * Template Name: Sub Page
 *
 * Template for displaying a standard page.
 *
 */



get_header();

?>



<article class="page-content container">
    <?php if(have_posts()) : ?>
        <?php while(have_posts()) : the_post(); ?>
            <nav class="sub-page-nav">
                <?php echo modern_furniture_list_child_pages(); ?>
            </nav>
            <div class="body-content row col-md-12">
                <?php the_title('<h1>','</h1>') ?>
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</article>

<?php get_footer(); ?>