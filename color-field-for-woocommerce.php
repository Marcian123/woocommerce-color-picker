<?php
/**
 * Plugin Name: Color Field for WooCommerce
 * Description: Add custom fields to WooCommerce products
 * Version: 1.0.0
 * Author: Marcin Grudziąż
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function create_color_field() {
    $args = array(
        'id'            => 'color_field_title',
        'label'         => __( 'Color field', 'color' ),
        'class'					=> 'color-field',
        'desc_tip'      => true,
        'description'   => __( 'Color field.', 'color' ),
    );
    woocommerce_wp_text_input( $args );
}
add_action( 'woocommerce_product_options_general_product_data', 'create_color_field' );

function save_color_field( $post_id ) {
    $product = wc_get_product( $post_id );
    $title = isset( $_POST['color_field_title'] ) ? $_POST['color_field_title'] : '';
    $product->update_meta_data( 'color_field_title', sanitize_text_field( $title ) );
    $product->save();
}
add_action( 'woocommerce_process_product_meta', 'save_color_field' );

function display_color_field() {
    global $post;
    // Check for the custom field value
    $product = wc_get_product( $post->ID );
    $title = $product->get_meta( 'color_field_title' );
    if( $title ) {
        // Only display our field if we've got a value for the field title
        printf(
            '<div class="color-field-wrapper"><label for="color-field">%s</label><input type="color" name="color" id="color-field" value="#ff0000"></div>',
            esc_html( $title )
        );
    }
}
add_action( 'woocommerce_before_add_to_cart_button', 'display_color_field' );

function validate_color_field( $passed, $product_id, $quantity ) {
    if( empty( $_POST['color-field'] ) ) {
        // Fails validation
        $passed = false;
        wc_add_notice( __( 'Please enter a value into the color field', 'color-field' ), 'error' );
    }
    return $passed;
}
add_filter( 'woocommerce_add_to_cart_validation', 'validate_color_field', 10, 3 );

function add_color_field_item_data( $cart_item_data, $product_id, $variation_id, $quantity ) {
    if( ! empty( $_POST['color-field'] ) ) {
        // Add the item data
        $cart_item_data['title_field'] = $_POST['color-field'];
        $product = wc_get_product( $product_id ); // Expanded function
        $price = $product->get_price(); // Expanded function
        $cart_item_data['total_price'] = $price + 100; // Expanded function
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'add_color_field_item_data', 10, 4 );

/**
 * Update the price in the cart
 * @since 1.0.0
 */
function before_calculate_totals( $cart_obj ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }
    // Iterate through each cart item
    foreach( $cart_obj->get_cart() as $key=>$value ) {
        if( isset( $value['total_price'] ) ) {
            $price = $value['total_price'];
            $value['data']->set_price( ( $price ) );
        }
    }
}
add_action( 'woocommerce_before_calculate_totals', 'before_calculate_totals', 10, 1 );

/**
 * Display the custom field value in the cart
 * @since 1.0.0
 */
function cart_item_name( $name, $cart_item, $cart_item_key ) {
    if( isset( $cart_item['title_field'] ) ) {
        $name .= sprintf(
            '<p>%s</p>',
            esc_html( $cart_item['title_field'] )
        );
    }
    return $name;
}
add_filter( 'woocommerce_cart_item_name', 'cart_item_name', 10, 3 );

/**
 * Add custom field to order object
 */
function add_custom_data_to_order( $item, $cart_item_key, $values, $order ) {
    foreach( $item as $cart_item_key=>$values ) {
        if( isset( $values['title_field'] ) ) {
            $item->add_meta_data( __( 'Color Field', 'color' ), $values['title_field'], true );
        }
    }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'add_custom_data_to_order', 10, 4 );
