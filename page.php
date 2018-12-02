<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nabcofurn_us
 */

get_header();

$page_sidebar = get_theme_mod('nabcofurniture_theme_page_layout', '' );

?>

<!-- Section: Page Header -->
<article class="page-content container">
	<div class="row">
	
	<?php if(have_posts()) : ?>
		<?php while(have_posts()) : the_post(); ?>
			<div class="col-md-12">
				<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => 'post-featured-image' ) ); ?>
				<?php the_title('<h1 class="entry-title blog-post-title">','</h1>') ?>
			</div>
			<div class="col-md-12">
				<?php if(get_option('wc_disabled_shop_cart_1','no') == 'yes') : ?>
					<?php if(is_page('cart') || is_page('my-account')) :?>
						<?php echo apply_filters('nabcofurniture_page_disabled', '<p class="woocommerce-info">This page is disabled</p>' ) ?>
					<?php else : ?>
						<?php the_content(); ?>
					<?php endif; ?>
				<?php else : ?>
					<?php the_content(); ?>
				<?php endif; ?>	
			</div>
		<?php endwhile ?>
	<?php endif; ?>
	
	</div>
</article>


<?php get_footer(); ?>