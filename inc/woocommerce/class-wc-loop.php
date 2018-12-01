<?php

class ModernFurniture_WCLoop {
    

    public function __construct() {
        
       
        
        /**
         * Remove default WooCommerce wrapper.
         * - single product
         * - archive product
         * - loop breadcrumb
         */
        remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

        /** 
         * replace to match theme
         * wrapper to bootstrap theme
         *  
        */
        add_action( 'woocommerce_before_main_content', array($this,'woocommerce_wrapper_before') );
        add_action( 'woocommerce_after_main_content', array($this,'woocommerce_wrapper_after') );

          /**
	    * Product columns wrapper.
	    *
	    * @return  void
	    */
        add_action( 'woocommerce_before_shop_loop', array($this,'woocommerce_product_columns_wrapper'), 5);
        add_action( 'woocommerce_before_shop_loop', array($this,'woocommerce_order_wrapper_opening'), 15);
        add_action( 'woocommerce_before_shop_loop', array($this,'woocommerce_order_wrapper_closing'), 35);
        add_action( 'woocommerce_after_shop_loop', array($this,'woocommerce_product_columns_wrapper_close'), 40 );
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
        echo '<!-- archive opening --><div class="row">';
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
			<div id="main" class="mf-site-main" role="main">
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

}

return new ModernFurniture_WCLoop();