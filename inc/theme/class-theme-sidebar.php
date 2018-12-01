<?php 


class ModernFurniture_SidebarRegister {
	
	public function __construct() {

		add_action('widgets_init', array($this,'widgets_init'));
	}
	

    public function widgets_init() {
        
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', MF_THEME_DOMAIN ),
            'id'            => 'primary-sidebar',
            'description'   => esc_html__( 'Add widgets here.', MF_THEME_DOMAIN ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        //footer
        register_sidebar( array(
            'name'          => __( 'Footer Full', MF_THEME_DOMAIN ),
            'id'            => 'footerfull',
            'description'   => 'Full sized footer widget with dynamic grid',
            'before_widget'  => '<div id="%1$s" class=" %2$s '. $this->count_widgets( 'footerfull' ) .' mb-3 "  ><div class="single-widget footer-widget-list">', 
            'after_widget'   => '</div></div><!-- .footer-widget -->', 
            'before_title'   => '<div class="widget-title">', 
            'after_title'    => '</div>', 
        ) );
			


    }

    public function count_widgets($sidebar_id) {

        // If loading from front page, consult $_wp_sidebars_widgets rather than options
		// to see if wp_convert_widget_settings() has made manipulations in memory.
        global $_wp_sidebars_widgets;
        
		if ( empty( $_wp_sidebars_widgets ) ) :
			$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
		endif;

		$sidebars_widgets_count = $_wp_sidebars_widgets;

		if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
			$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
			if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
				// Four widgets per row if there are exactly four or more than six
				$widget_classes .= ' col-md-3';
			elseif ( 6 == $widget_count ) :
				// If two widgets are published
				$widget_classes .= ' col-md-2';
			elseif ( $widget_count >= 3 ) :
				// Three widgets per row if there's three or more widgets 
				$widget_classes .= ' col-md-4';
			elseif ( 2 == $widget_count ) :
				// If two widgets are published
				$widget_classes .= ' col-md-6';
			elseif ( 1 == $widget_count ) :
				// If just on widget is active
				$widget_classes .= ' col-md-12';
			endif; 
			return $widget_classes;
		endif;
    }
}

return new ModernFurniture_SidebarRegister();