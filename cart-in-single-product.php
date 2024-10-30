<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sharabindu.com
 * @since             1.0.0
 * @package           Cart_In_Single_Product
 *
 * @wordpress-plugin
 * Plugin Name:       Cart in Ajax on single product page
 * Plugin URI:        https://sharabindu.com/cart-in-single-product
 * Description:       This is a plugin for Cart via Ajax on a single product page
 * Version:           1.0.0
 * Author:            Sharabindu
 * Author URI:        https://sharabindu.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cart-in-single-product
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CART_IN_SINGLE_PRODUCT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cart-in-single-product-activator.php
 */
function activate_cart_in_single_product() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-cart-in-single-product-activator.php';
    Cart_In_Single_Product_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cart-in-single-product-deactivator.php
 */
function deactivate_cart_in_single_product() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-cart-in-single-product-deactivator.php';
    Cart_In_Single_Product_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cart_in_single_product' );
register_deactivation_hook( __FILE__, 'deactivate_cart_in_single_product' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cart-in-single-product.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cart_in_single_product() {

    $plugin = new Cart_In_Single_Product();
    $plugin->run();

}
run_cart_in_single_product();




function ajax_add_to_cart_handler() {
    WC_Form_Handler::add_to_cart_action();
    WC_AJAX::get_refreshed_fragments();
}
add_action( 'wc_ajax_add_to_cart', 'ajax_add_to_cart_handler' );
add_action( 'wc_ajax_nopriv_add_to_cart', 'ajax_add_to_cart_handler' );

// Remove WC Core add to cart handler to prevent double-add
remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );