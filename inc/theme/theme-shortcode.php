<?php



class ModernFurniture_ShortCode {

    public static function init() {

        $shortcodes = array(
            'search'    =>  __CLASS__ . '::get_search',
        );

        foreach ($shortcodes as $shortcode => $function) {
            add_shortcode("modfurn-".$shortcode,$function);
        }
    }

    public static function get_search($atts) {
        return MF_Component('search')->get_search();
    }

}


BizPack_ShortCode::init();