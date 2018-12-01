<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Modern_Furniture
 */

class ModernFurniture_Theme {


    public function skip_link() {
        echo apply_filters("skip-link", 
            sprintf("<a class='skip-link screen-reader-text' href='#content'>%s</a>", esc_html( 'Skip to content', MF_THEME_DOMAIN )));
    }

    public function main_navigation() {
        ?>
        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'modern-furniture' ); ?></button>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
            ) );
            ?>
        </nav><!-- #site-navigation -->
        <?php

    }

    public function breadcrumb() {

    }
}

return new ModernFurniture_Theme();