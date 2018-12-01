<?php 


require get_template_directory() . '/inc/theme/components/class-component-navigation.php';
require get_template_directory() . '/inc/theme/components/class-component-search.php';

if(!function_exists('MF_Component')) {

    function MF_Component($component_name,$args = array()) {
        
        if($component_name == 'navigation') {
            return new ModernFurniture_NavigationComponent($args);
        }
        else if($component_name == 'search') {
            return new ModerFurniture_SearchComponent($args);
        }
    }
    
}



