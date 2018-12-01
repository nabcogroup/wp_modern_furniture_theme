<?php


class ModernFurniture_MainNavigation {
    
    public $items = array();
    
    public static function createInstance($args = array()) {
       return new ModernFurniture_MainNavigation($args);
    }

    public function __construct($args = array()) {

        $locations = get_nav_menu_locations();

        if(isset($locations[$args['location']])) {
            
            $menu = get_term($locations[$args['location']],'nav_menu');
            
            $this->items = wp_get_nav_menu_items( $menu->name );
        }
    }

    public function haveItems() {
        return count($this->items) > 0 ? true : false;
    }

}
