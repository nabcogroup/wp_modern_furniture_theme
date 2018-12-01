<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 *
 * @package Modern_Furniture
 */

?>

	</main><!-- #content -->

	<footer id="footer" class="site-footer">
		<div class="site-info <?php echo get_theme_mod("mf-theme-container","container");  ?>">
			<?php get_template_part('template-parts/sidebars/sidebar', 'footer') ?>
		</div><!-- .site-info -->
		
		<!-- small footer -->
		<div class="footer-bottom ">
			<div class="<?php echo get_theme_mod("mf-theme-container","container"); ?>">
				<div class="row">
					<div class="col-md-6 col-sm-12 text-light">
						<small class="align-middle p-0 m-0">&copy; All Rights Reserved 2018</small>
					</div>
					<div class="col-md-6 col-sm-12">
						<?php echo modernfurniture_do_shortcode('ns-social-link',array()); ?>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
