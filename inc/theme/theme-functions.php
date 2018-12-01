<?php


require get_template_directory() . '/inc/theme/class-template-functions.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/theme/theme-tags.php';





/**
 * Call a shortcode function by tag name.
 *
 * @since   0.1
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function modernfurniture_do_shortcode( $tag, array $atts = array(), $content = null ) {
	global $shortcode_tags;

	if ( ! isset( $shortcode_tags[ $tag ] ) ) {
		return false;
	}

	return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}



function modern_furniture_list_child_pages() { 
 
    global $post; 
    $parent = "";
    if ( is_page() && $post->post_parent ) {
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
        
        $parent = "<li><a href='". get_the_permalink($post->post_parent)."'>".get_the_title($post->post_parent)."</a></li>";
    }
    else {
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
        
        $parent = "<li class='current_page_item'><a class='parent' href='". get_the_permalink($post->ID)."'>". get_the_title($post->ID) ."</a></li>";
        

    }
    
    
    //include parent

    $string =  "";
    if ( $childpages ) {
        $string = '<ul>'.$parent.$childpages.'</ul>';
    }
     
    return $string;
     
}