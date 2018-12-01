<?php

require get_template_directory() . '/inc/class/class-navigation.php';

class ModernFurniture_NavigationComponent {

    protected $navigation;

    public function __construct($args = array()) {

    }

    public function get_navigation() {

        $this->navigation = ModernFurniture_MainNavigation::createInstance(array('location' => 'primary'));
    
?>
        <div class="d-none d-md-block">
            <nav class="mf-navbar mf-navbar-js">
                <div class="container">
                    <?php if($this->navigation->haveItems()) { ?>
                        <ul class="mf-menu justify-content-center">
                            <?php
                                //loop
                                foreach($this->navigation->items as $item) {
                                    if($html_menu = $this->create_html_menu($item)) {
                                        echo $html_menu;
                                    }
                                }
                            ?>
                        </ul>
                    <?php } ?>
                </div>
            </nav>
        </div>  
<?php
    }
    

    protected function create_html_menu(&$item) {
        
        if($item->menu_item_parent != 0) return false;
        
        $cssDropdown = "";
        $anchorCssDropdown = "";
        $childrenOutput = "";
        $classes = "";
        
        if(in_array('has_children',$item->classes)) {
            $cssDropdown = "mf-dropdown";
            $anchorCssDropdown = "mf-dropdown-toggle";
            $childrenOutput = $this->create_html_submenu($item->ID);
            $classes = implode(" ",$item->classes);
        }

        $anchor = "<a class='mf-item-menu {$anchorCssDropdown}'  href='{$item->url}'>{$item->title}</a>";
        $output = "<li class='mf-link {$classes} {$cssDropdown}'>  {$anchor} {$childrenOutput}  </li>";

        return $output;
    }

    


    protected function create_html_submenu($id) {
        
        $imageHtmls = [];
        
        $childrenOutput = "<!--children wrapper --><div class='mf-dropdown__wrapper'>";
        $childrenOutput .= "<div class='container row m-0 p-0 full-container'>";
        $childrenOutput .= "<!-- submenu --><div class='col-4 m-0 p-0'>";
        $childrenOutput .= "<!-- list opening --><ul class='mf-dropdown-subnav' data-group='{$id}'>";
        
        $imageHtmls = array();
        $productArgs = array();
        $isActive = true;   
        
        $childrenList = "";
        foreach($this->navigation->items as $subnav) {
            //subnavigation
            if ( $subnav->menu_item_parent == $id) {

                $images = wp_get_attachment_image_src(get_woocommerce_term_meta($subnav->object_id,'thumbnail_id',true),'medium' );
                
                $imageArgs[$subnav->object_id] = array(
                       "title"      =>  $subnav->title,
                       "url"        =>  $subnav->url,
                       "src"        =>  $images[0],
                       "class"      =>  "prod_cat-image-{$subnav->ID} nb-wc-product-feature",
                       "products"   =>  $this->navigation->getProducts($subnav->object_id)
                );

                $style = "";
                $classes = "";
                if(count($subnav->classes) > 0) {
                    $url = get_template_directory_uri() . '/dist/imgs/icons/' . $subnav->classes[0] . '.png';
                    $style = "background:url({$url}) 5% 50% no-repeat;";
                    $classes = implode(" ", $subnav->classes);
                }

                $childrenList .= "<li class='js-subnav-icon mf-category-subnav {$id} ". ($isActive ? 'active' : '') . "' 
                                        data-container='product_catkey_{$subnav->object_id}'>";
                $childrenList .= "<a href='{$subnav->url}' class='mf-icon {$classes}' style='{$style}'>{$subnav->title}</a>";
                $childrenList .= "</li>";

                //one time activation
                if($isActive) $isActive = false;
            }
        }

        $childrenOutput .= "{$childrenList}</ul><!-- end of list -->";
        $childrenOutput .= "</div><!-- end of submenu -->";
        
        $childrenOutput .= "<div class='col-8 p-0 m-0'>";
        $childrenOutput .= "<div class='mf-dropdown-container'>";
        
        $childrenOutput .=  $this->create_product_list($imageArgs);
        
        $childrenOutput .= "</div>";
        $childrenOutput .= "</div>";
        $childrenOutput .= "</div><!-- container -->";
        $childrenOutput .= "</div><!-- wrapper -->";

        return $childrenOutput;

    }

    protected function create_product_list($imageArgs) {

        $html = "";
        
        foreach($imageArgs as $key => $arg) {
            $html .= "<nav id='product_catkey_{$key}' class='mf-wc-menu-product category-{$key}'  style='background:url({$arg['src']}) top left no-repeat;background-size:cover;height:100%'>"; 
            $html .= "<!-- row --><div class='row m-0' style='height:100%'>";
            $html .= "<div class='col-md-6 subnav-top-product-list' style='background:rgba(255,255,255,0.7);height:100%'><ul>";
            
            foreach($arg['products'] as $product) {
                $html .= "<li><a href='{$product['permalink']}'>{$product['title']}</a></li>";
            }
            
            $html .= sprintf("<li><a href='%s'>%s</a></li>",$arg['url'],__('See more...'));
            $html .= "</ul></div>";
            $html .= "</div><!-- end row-->";
            $html .= "</nav>";
        }
        
	    return $html;
    }
}