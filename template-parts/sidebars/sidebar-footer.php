<?php
/**
 * Sidebar setup for footer full.
 *
 * @package understrap
 */

?>
<?php if ( is_active_sidebar( 'footerfull' ) ) : ?>
	<!-- ******************* The Footer Full-width Widget Area ******************* -->
	<div class="container p-3" id="footer-full-content" tabindex="-1">
		<div class="row">
			<?php dynamic_sidebar( 'footerfull' ); ?>
		</div>
	</div>
<?php endif; ?>
