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
    <div class="row">
        <?php if(have_posts()) : ?>
            <?php while(have_posts()) : the_post(); ?>
                <nav class="sub-page-nav">
                    <?php echo modern_furniture_list_child_pages(); ?>
                </nav>
                <div class="col-md-12">
                    <?php the_title('<h1 class="entry-title blog-post-title">','</h1>') ?>
                </div>
                <div class="col-md-12">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</article>

<?php get_footer(); ?>