<?php

class ModerFurniture_SearchComponent {

    protected $args;

    
    public function __construct($args) {
        
        $this->args = $args;
    
    }


    public function get_search() {
        $html = "";
        if(class_exists('WooCommerce')) {
            ob_start()
            ?> 
                <div id="search-category">
                    <form class="search-box" action="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" method="post">
                        <div class="search-categories">
                            <div class="search-cat">
                                <?php 
                                    $args = array(
                                        'taxonomy' => 'product_cat',
                                        'orderby' => 'name',
                                        'show_count' => '0',
                                        'pad_counts' => '0',
                                        'hierarchical' => '1',
                                        'title_li' => '',
                                        'hide_empty' => '0',
                                    );
                                    $all_categories = get_categories( $args );  
                                ?>

                                <select class="category-items" name="category">
                                    <option value="0"><?php _e('All Categories','modernfurniture') ?></option>
                                    <?php foreach( $all_categories as $category ) { ?>
                                        <option value="<?php echo $category->slug; ?>"><?php echo $category->cat_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <input type="search" name="s" id="text-search" value="<?php echo get_search_query(); ?>" placeholder="<?php _e('Search here...','modernfurniture') ?>" />

                        <button id="btn-search-category" type="submit">
                            <i class="icon-search"></i>
                        </button>
                        <input type="hidden" name="post_type" value="product" />
                    </form>
                </div>
               
            <?php
            $html = ob_get_clean();
        }

        return $html;
	}
    
}