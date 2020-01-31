
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
        'label'         => __( 'Color field', 'color-name' ),
        'class'					=> 'color-name',
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
            '<script>

            function checkValue(value) {
              return value == document.getElementById("color-field").value;
            }
            function saveColor(){
                        let colors = [\'#f0f8ff\',\'#faebd7\',\'#00ffff\',\'#7fffd4\',\'#f0ffff\',\'#f5f5dc\',\'#ffe4c4\',\'#000000\',\'#ffebcd\',\'#0000ff\',\'#8a2be2\',\'#a52a2a\',\'#deb887\',\'#5f9ea0\',\'#7fff00\',\'#d2691e\',\'#ff7f50\',\'#6495ed\',\'#fff8dc\',\'#dc143c\',\'#00ffff\',\'#00008b\',\'#008b8b\',\'#b8860b\',\'#a9a9a9\',\'#a9a9a9\',\'#006400\',\'#bdb76b\',\'#8b008b\',\'#556b2f\',\'#ff8c00\',\'#9932cc\',\'#8b0000\',\'#e9967a\',\'#8fbc8f\',\'#483d8b\',\'#2f4f4f\',\'#2f4f4f\',\'#00ced1\',\'#9400d3\',\'#ff1493\',\'#00bfff\',\'#696969\',\'#696969\',\'#1e90ff\',\'#b22222\',\'#fffaf0\',\'#228b22\',\'#ff00ff\',\'#dcdcdc\',\'#f8f8ff\',\'#ffd700\',\'#daa520\',\'#808080\',\'#808080\',\'#008000\',\'#adff2f\',\'#f0fff0\',\'#ff69b4\',\'#cd5c5c\',\'#4b0082\',\'#fffff0\',\'#f0e68c\',\'#e6e6fa\',\'#fff0f5\',\'#7cfc00\',\'#fffacd\',\'#add8e6\',\'#f08080\',\'#e0ffff\',\'#fafad2\',\'#d3d3d3\',\'#d3d3d3\',\'#90ee90\',\'#ffb6c1\',\'#ffa07a\',\'#20b2aa\',\'#87cefa\',\'#778899\',\'#778899\',\'#b0c4de\',\'#ffffe0\',\'#00ff00\',\'#32cd32\',\'#faf0e6\',\'#ff00ff\',\'#800000\',\'#66cdaa\',\'#0000cd\',\'#ba55d3\',\'#9370db\',\'#3cb371\',\'#7b68ee\',\'#00fa9a\',\'#48d1cc\',\'#c71585\',\'#191970\',\'#f5fffa\',\'#ffe4e1\',\'#ffe4b5\',\'#ffdead\',\'#000080\',\'#fdf5e6\',\'#808000\',\'#6b8e23\',\'#ffa500\',\'#ff4500\',\'#da70d6\',\'#eee8aa\',\'#98fb98\',\'#afeeee\',\'#db7093\',\'#ffefd5\',\'#ffdab9\',\'#cd853f\',\'#ffc0cb\',\'#dda0dd\',\'#b0e0e6\',\'#800080\',\'#663399\',\'#ff0000\',\'#bc8f8f\',\'#4169e1\',\'#8b4513\',\'#fa8072\',\'#f4a460\',\'#2e8b57\',\'#fff5ee\',\'#a0522d\',\'#c0c0c0\',\'#87ceeb\',\'#6a5acd\',\'#708090\',\'#708090\',\'#fffafa\',\'#00ff7f\',\'#4682b4\',\'#d2b48c\',\'#008080\',\'#d8bfd8\',\'#ff6347\',\'#40e0d0\',\'#ee82ee\',\'#f5deb3\',\'#ffffff\',\'#f5f5f5\',\'#ffff00\',\'#9acd32\'];
                        let names = [\'AliceBlue\',\'AntiqueWhite\',\'Aqua\',\'Aquamarine\',\'Azure\',\'Beige\',\'Bisque\',\'Black\',\'BlanchedAlmond\',\'Blue\',\'BlueViolet\',\'Brown\',\'BurlyWood\',\'CadetBlue\',\'Chartreuse\',\'Chocolate\',\'Coral\',\'CornflowerBlue\',\'Cornsilk\',\'Crimson\',\'Cyan\',\'DarkBlue\',\'DarkCyan\',\'DarkGoldenRod\',\'DarkGray\',\'DarkGrey\',\'DarkGreen\',\'DarkKhaki\',\'DarkMagenta\',\'DarkOliveGreen\',\'DarkOrange\',\'DarkOrchid\',\'DarkRed\',\'DarkSalmon\',\'DarkSeaGreen\',\'DarkSlateBlue\',\'DarkSlateGray\',\'DarkSlateGrey\',\'DarkTurquoise\',\'DarkViolet\',\'DeepPink\',\'DeepSkyBlue\',\'DimGray\',\'DimGrey\',\'DodgerBlue\',\'FireBrick\',\'FloralWhite\',\'ForestGreen\',\'Fuchsia\',\'Gainsboro\',\'GhostWhite\',\'Gold\',\'GoldenRod\',\'Gray\',\'Grey\',\'Green\',\'GreenYellow\',\'HoneyDew\',\'HotPink\',\'IndianRed\',\'Indigo\',\'Ivory\',\'Khaki\',\'Lavender\',\'LavenderBlush\',\'LawnGreen\',\'LemonChiffon\',\'LightBlue\',\'LightCoral\',\'LightCyan\',\'LightGoldenRodYellow\',\'LightGray\',\'LightGrey\',\'LightGreen\',\'LightPink\',\'LightSalmon\',\'LightSeaGreen\',\'LightSkyBlue\',\'LightSlateGray\',\'LightSlateGrey\',\'LightSteelBlue\',\'LightYellow\',\'Lime\',\'LimeGreen\',\'Linen\',\'Magenta\',\'Maroon\',\'MediumAquaMarine\',\'MediumBlue\',\'MediumOrchid\',\'MediumPurple\',\'MediumSeaGreen\',\'MediumSlateBlue\',\'MediumSpringGreen\',\'MediumTurquoise\',\'MediumVioletRed\',\'MidnightBlue\',\'MintCream\',\'MistyRose\',\'Moccasin\',\'NavajoWhite\',\'Navy\',\'OldLace\',\'Olive\',\'OliveDrab\',\'Orange\',\'OrangeRed\',\'Orchid\',\'PaleGoldenRod\',\'PaleGreen\',\'PaleTurquoise\',\'PaleVioletRed\',\'PapayaWhip\',\'PeachPuff\',\'Peru\',\'Pink\',\'Plum\',\'PowderBlue\',\'Purple\',\'RebeccaPurple\',\'Red\',\'RosyBrown\',\'RoyalBlue\',\'SaddleBrown\',\'Salmon\',\'SandyBrown\',\'SeaGreen\',\'SeaShell\',\'Sienna\',\'Silver\',\'SkyBlue\',\'SlateBlue\',\'SlateGray\',\'SlateGrey\',\'Snow\',\'SpringGreen\',\'SteelBlue\',\'Tan\',\'Teal\',\'Thistle\',\'Tomato\',\'Turquoise\',\'Violet\',\'Wheat\',\'White\',\'WhiteSmoke\',\'Yellow\',\'YellowGreen\'];
                        
                        let val = document.getElementById("color-field").value;
                        console.log(val)
                        let color_index = colors.findIndex(checkValue);
                        console.log(color_index);
                        console.log(names[color_index]);
                        if (color_index > -1){
                            document.getElementById("color-name").value = names[color_index]
                            }
                        };
            </script>
            <div class="color-field-wrapper"><label for="color-field">%s</label>
            <input type="color" name="color" id="color-field" value="#ff0000" onClick="saveColor()" onchange="saveColor()">
            <input type="text" name="color-name" id="color-name" style="display: none;" value="unknown"">
            </div>',
            esc_html( $title )
        );
    }
}
add_action( 'woocommerce_before_add_to_cart_button', 'display_color_field' );

function validate_color_field( $passed, $product_id, $quantity ) {
    if( empty( $_POST['color-name'] ) ) {
        $passed = false;
        wc_add_notice( __( 'Please enter a value into the color field', 'color-name' ), 'error' );
    }
    return $passed;
}
add_filter( 'woocommerce_add_to_cart_validation', 'validate_color_field', 10, 3 );

function add_color_field_item_data( $cart_item_data, $product_id, $variation_id, $quantity ) {
    if( ! empty( $_POST['color-name'] ) ) {
        // Add the item data
        $cart_item_data['title_field'] = $_POST['color-name'];
        $product = wc_get_product( $product_id );
        $price = $product->get_price();
        $cart_item_data['total_price'] = $price;
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

?>
