<?php 
    /**
 * Displays Header
 *
 */
?>

<header class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			
			<!-- branding -->
			<?php  
				if(has_custom_logo()) {
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo_path = wp_get_attachment_image_src( $custom_logo_id , 'full' ); 
				} 	

				$brand_classes = apply_filters("modfurn-branding-classes", array("mr-auto", "site-brand"));
			?>
			<a class="navbar-brand <?php echo implode(" ",$brand_classes); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($logo_path[0]); ?>" alt=""></a>
			<!-- end branding -->
			
			<div class="col-md-6 ml-auto">
				<!-- search form -->
				<?php echo MF_Component('search')->get_search(); ?>	
			</div>
			<!-- bootstrap toggle button -->
			<button class="navbar-toggler" type="button" 
                        data-toggle="collapse" 
                        data-target="#mobileMenu" 
                        aria-controls="navbarSupportedContent" 
                        aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

		</div>
	</header><!-- #masthead -->