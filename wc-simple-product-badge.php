<?php
/*
Plugin Name: WC Simple Product Badge
Version: 1.1
Description: Display a simple product badge overlay for a WooCommerce store product.
Author: Designs 4 The Web
Author URI: http://designs4theweb.com
Text Domain: wc-simple-product-badge
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Define the plugin path as a constant
define('WC_PRODUCT_BADGE_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

// Hook the stylesheet to an action

add_action( 'wp_enqueue_scripts', 'wc_simple_product_badge_stylesheet' );

//  Enqueue the stylesheet

function wc_simple_product_badge_stylesheet() {
    wp_register_style( 'wc-simple-product-badge-style', WC_PRODUCT_BADGE_PLUGIN_PATH.'css/style.css' );
    wp_enqueue_style( 'wc-simple-product-badge-style' );
}

// Check to see that WooCommerce is installed and active

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
// Create 'badge', 'class', and 'duration' fields in the General panel of WooCommerce product options

add_action( 'woocommerce_product_options_general_product_data', 'wc_simple_product_badge_fields' );

    function wc_simple_product_badge_fields() {
        
		global $woocommerce, $post;

        echo '<div class="options_group">';

		// Badge Title Field
        woocommerce_wp_text_input(array(
            'id'          => '_wc_simple_product_badge_title',
            'label'       => __( 'Badge Title', 'wc-simple-product-badge' ),
            'description' => __( 'e.g. New Product', 'wc-simple-product-badge' ),
        ) );

		// Badge Class Field
        woocommerce_wp_text_input(array(
            'id'          => '_wc_simple_product_badge_class',
            'label'       => __( 'CSS Class', 'wc-simple-product-badge' ),
            'description' => __( 'e.g. orange, yellow, green, blue, purple, black', 'wc-simple-product-badge' ),
        ) );
		
		// Badge Duration Field
		woocommerce_wp_text_input(array( 
			'id'                => '_wc_simple_product_badge_duration', 
			'label'             => __( 'Duration', 'wc-simple-product-badge' ), 
			'description'       => __( 'e.g. 14', 'wc-simple-product-badge' ),
			'type'              => 'number',
		) );

        echo '</div>';
    }

// Save custom field values

add_action( 'woocommerce_process_product_meta', 'wc_simple_product_badge_fields_save' );
    function wc_simple_product_badge_fields_save( $post_id ) {
        $title = $_POST['_wc_simple_product_badge_title'];
        $class = $_POST['_wc_simple_product_badge_class'];
		$duration = $_POST['_wc_simple_product_badge_duration'];

        update_post_meta( $post_id, '_wc_simple_product_badge_title', esc_attr( $title ) );
        update_post_meta( $post_id, '_wc_simple_product_badge_class', esc_attr( $class ) );
		update_post_meta( $post_id, '_wc_simple_product_badge_duration', esc_attr( $duration ) );
    }	
	
// Display the product badge

add_action( 'woocommerce_after_shop_loop_item_title', 'wc_simple_product_badge_display', 30 );
    function wc_simple_product_badge_display() {
        $title = get_post_meta( get_the_ID(), '_wc_simple_product_badge_title', true ); // badge title
        $class = get_post_meta( get_the_ID(), '_wc_simple_product_badge_class', true ); // badge class
		$duration = get_post_meta( get_the_ID(), '_wc_simple_product_badge_duration', true ); // badge duration
		$postdate = get_the_time( 'Y-m-d' ); // post date
		$postdatestamp = strtotime( $postdate ); // post date in unix timestamp
		$difference = round ((time() - $postdatestamp) / (24*60*60));  // difference in days between now and product's post date

        if ( !empty( $title ) && empty( $duration ) || !empty( $title ) && $difference <= $duration ){ // Check to see if there is a title and the product is still within the duration timeframe if specified
            $class = !empty( $class ) ? $class : '';
            echo '<span class="wc_simple_product_badge ' . $class . '">' . $title . '</span>';
        }
    }
}

?>