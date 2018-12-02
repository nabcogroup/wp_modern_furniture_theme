<?php

class ModernFurniture_WCLoop  extends Theme_Hook {
    

    public function __construct() {
        
        $this->actions = array(

            'woocommerce_before_main_content' => array(
                array('fn' => 'woocommerce_breadcrumb', 'event' => 'remove', 'pos' => 20),
                array('fn' => array($this,'woocommerce_wrapper_before'),'pos' => 10),
            ),
            'woocommerce_after_main_content' => array(
                array('fn' => array($this,'woocommerce_wrapper_after'),'pos' => 10),
            ),
            'woocommerce_before_shop_loop' => array(
                array('fn' => array($this,'woocommerce_product_search'), 'pos' => 5),
                array('fn' => array($this,'woocommerce_order_wrapper_opening'), 'pos' => 19),
                array('fn' => array($this,'woocommerce_order_wrapper_closing'), 'pos' => 31),

            ),
            'woocommerce_after_shop_loop' => array( 
                array('fn' => array($this,'woocommerce_product_columns_wrapper'), 'pos' => 19),
            ),

            'woocommerce_before_shop_loop_item' => array(
                array('fn' => array($this,'woocommerce_product_wrapper_opening'), 'pos' => 5),
                array('fn' => 'woocommerce_template_loop_product_link_open', 'event' => 'remove', 'pos' => 10),
                array('fn' => array($this,'woocommerce_cart_position'), 'pos' => 20),
                
            ),

            'woocommerce_after_shop_loop_item'  =>  array(
                array('fn' => 'woocommerce_after_shop_loop_item', 'event' => 'remove', 'pos' => 5),
                array('fn' => array($this,'woocommerce_product_div_closing'), 'pos' => 15)
            )
                ,
            'woocommerce_before_shop_loop_item_title'   =>  array('fn' => array($this,'woocommerce_product_content_opening'), 'pos' => 15),
            'woocommerce_after_shop_loop_item_title'   =>  array('fn' => array($this,'woocommerce_product_div_closing'), 'pos' => 15),

            'woocommerce_shop_loop_item_title' => array(
                array('fn' => array($this,'woocommerce_nav_set_product'), 'pos' => 5),
                array('fn' => array($this,'woocommerce_set_title_pos'), 'pos' => 5)
            ), 
        );


       


        parent::__construct();
       
        
        // /**
        //  * Remove default WooCommerce wrapper.
        //  * - single product
        //  * - archive product
        //  * - loop breadcrumb
        //  */
        // remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
        // remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
        // remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

        // /** 
        //  * replace to match theme
        //  * wrapper to bootstrap theme
        //  *  
        // */
        // add_action( 'woocommerce_before_main_content', array($this,'woocommerce_wrapper_before') );
        // add_action( 'woocommerce_after_main_content', array($this,'woocommerce_wrapper_after') );

        //   /**
	    // * Product columns wrapper.
	    // *
	    // * @return  void
	    // */
        // add_action( 'woocommerce_before_shop_loop', array($this,'woocommerce_product_columns_wrapper'), 5);
        // add_action( 'woocommerce_before_shop_loop', array($this,'woocommerce_order_wrapper_opening'), 15);
        // add_action( 'woocommerce_before_shop_loop', array($this,'woocommerce_order_wrapper_closing'), 35);
        // add_action( 'woocommerce_after_shop_loop', array($this,'woocommerce_product_columns_wrapper_close'), 40 );
    }   


    public function woocommerce_product_wrapper_opening() {
        echo '<div class="wc-product-container">';
    }

    public function woocommerce_product_div_closing() {
        echo '</div>';
    }

    public function woocommerce_product_content_opening() {
        echo '<div class="wc-product-body">';
    }

   public function woocommerce_cart_position() {
        
        //remove and reposition
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart',10);
        //add_action( 'theme_wc_product_cart','woocommerce_template_loop_add_to_cart',10 );

   }

    /** 
        * Product Navigation includes link,cart
    */
    public function woocommerce_nav_set_product() {
            
            global $product;
            
            $classes = array("woocommerce-LoopProduct-link", "woocommerce-loop-product__link");
            $view = sprintf('<a href="%s" class="%s">%s</a>', get_the_permalink(),implode(" ",$classes),"<i class='far fa-eye'></i>");

            ?>
                <ul class="wc-product-nav-set">
                    <li><?php echo $view ?> </li>
                    <li><?php do_action('theme_wc_product_cart') ?></li>
                </ul>

            <?php
    }

    public function woocommerce_set_title_pos() {
        remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
        add_action('woocommerce_shop_loop_item_title',array($this,'woocommerce_product_title'),10);
    }

    public function woocommerce_product_title() {
        $new_title = substr(get_the_title(),0,24);
        echo '<h2 class="woocommerce-loop-product__title">' . $new_title . '&hellip;' . '</h2>';
    }

    public function woocommerce_product_search() {

        $html = "<div class='wc-product-multi-search search-container'>";

        $html .= "</div>";

        echo $html;
    }

    /**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	public function woocommerce_product_columns_wrapper() {
        echo '<!-- opening --><div class="woocommerce-product-wrapper">';
    }

    /**
	 * Ordering wrapper opening closing.
	 *
	 * @return  void
	 */
    public function woocommerce_order_wrapper_opening() {
        echo '<!-- archive opening --><div class="column-ordering-row">';
    }

    public function woocommerce_order_wrapper_closing() {
        echo '</div>';
    }

    /**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	public function woocommerce_product_columns_wrapper_close() {
		echo '</div>';
    }

    /**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	public function woocommerce_wrapper_before() {
		?>
		<div id="primary" class="container content-area">
			<main id="main" class="wc-site-main" role="main">
        <?php
    }

    /**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	public function woocommerce_wrapper_after() {
        ?>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php
    }

    /**
     * Product loop cart button
     * 
     */
    public function woocommerce_modify_cart_link($content,$product,$args) {



        return sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
                    esc_url( $product->add_to_cart_url() ),
                    esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                    esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
                    isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
                    wp_kses_post( "<span><i class=' fas fa-shopping-cart '></i><span> " ) );
    }

}

return new ModernFurniture_WCLoop();