<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sharabindu.com
 * @since      1.0.0
 *
 * @package    Cart_In_Single_Product
 * @subpackage Cart_In_Single_Product/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cart_In_Single_Product
 * @subpackage Cart_In_Single_Product/public
 * @author     Sharabindu <contact@sharabindu.com>
 */
class Cart_In_Single_Product_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;	

	}


	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cart_In_Single_Product_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cart_In_Single_Product_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if (class_exists( 'WooCommerce' ) && is_product()){
		
		$product = wc_get_product(get_the_ID());

			if ($product->is_type("external") ||  $product->is_type( 'grouped' )){
			    return;
			}
            $CartsScript = array(
                'cartUrl'=>  wc_get_cart_url(),
                'viewcaer'=> __('View Cart', 'cart-in-single-product'),

            );

	 	 wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cart-in-single-product-public.js', array( 'jquery' ), $this->version, false ); 


        wp_localize_script( $this->plugin_name, 'Cartinajax', $CartsScript );
	}
		

	}

}
