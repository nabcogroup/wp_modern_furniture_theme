<?php 


class ModernFurniture_MiniCart {
	
	public static $instance;

    public static function createInstance() {

        if(is_null(static::$instance )) {
            static::$instance = new static();
        }

        return static::$instance;
	}
	

    public function __construct() {
        add_filter( 'woocommerce_add_to_cart_fragments', array($this,'woocommerce_cart_link_fragment') );
    }

    public function get_mini_cart() {

		$this->woocommerce_header_cart();
		
    }

    /**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	public function woocommerce_cart_link_fragment( $fragments ) {
        ob_start();
		$this->woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
    }
	
	public function woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'modern-furniture' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'modern-furniture' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
  
    /**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	public function woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php $this->woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array('title' => '',);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}

}

return ModernFurniture_MiniCart::createInstance();