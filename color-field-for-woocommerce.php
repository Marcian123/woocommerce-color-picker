<?php
/**
 * Plugin Name: Color Field for WooCommerce
 * Description: Add custom fields to WooCommerce products
 * Version: 1.0.0
 * Author: Marcin Grudziąż
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function create_color_field()
{
    $args = array(
        'id' => 'color_field_title',
        'label' => __('Color field', 'color-name'),
        'class' => 'color-name',
        'desc_tip' => true,
        'description' => __('Color field.', 'color'),
    );
    woocommerce_wp_text_input($args);
}

add_action('woocommerce_product_options_general_product_data', 'create_color_field');

function save_color_field($post_id)
{
    $product = wc_get_product($post_id);
    $title = isset($_POST['color_field_title']) ? $_POST['color_field_title'] : '';
    $product->update_meta_data('color_field_title', sanitize_text_field($title));
    $product->save();
}

add_action('woocommerce_process_product_meta', 'save_color_field');

function display_color_field()
{
    global $post;
    // Check for the custom field value
    $product = wc_get_product($post->ID);
    $title = $product->get_meta('color_field_title');
    if ($title) {
        // Only display our field if we've got a value for the field title
        printf(
            '<script>
           function checkValue3(value) {
              let val = document.getElementById("color-field").value;
              let len = value.length > val.length ? value.length : val.length;
              let score = 0;
              for (i = 0; i < len; i++) {
                  if (value[i] == val[i]){score = score +1}
              }
              return score >= 3;
            }
            
          function checkValue4(value) {
              let val = document.getElementById("color-field").value;
              let len = value.length > val.length ? value.length : val.length;
              let score = 0;
              for (i = 0; i < len; i++) {
                  if (value[i] == val[i]){score = score +1}
              }
              return score >= 4;
            }
            
            function checkValue5(value) {
              let val = document.getElementById("color-field").value;
              let len = value.length > val.length ? value.length : val.length;
              let score = 0;
              for (i = 0; i < len; i++) {
                  if (value[i] == val[i]){score = score +1}
              }
              return score >= 5;
            }
            
            function checkValue6(value) {
              let val = document.getElementById("color-field").value;
              let len = value.length > val.length ? value.length : val.length;
              let score = 0;
              for (i = 0; i < len; i++) {
                  if (value[i] == val[i]){score = score +1}
              }
              return score >= 6;
            }


            function checkValue7(value) {
              let val = document.getElementById("color-field").value;
              let len = value.length > val.length ? value.length : val.length;
              let score = 0;
              for (i = 0; i < len; i++) {
                  if (value[i] == val[i]){score = score +1}
              }
              return score >= 7;
            }
            function saveColor(){
                        let colors = [\'#ffffff\',\'#fafffa\',\'#fffff0\',\'#ffffd2\',\'#fffdd0\',\'#fafae7\',\'#faf7e5\',\'#e61c66\',\'#ff6d66\',\'#ff0080\',\'#f5accb\',\'#a2007b\',\'#c35c6f\',\'#fa8072\',\'#ff00ff\',\'#e4becf\',\'#d94da9\',\'#eb0165\',\'#ff3800\',\'#c34444\',\'#b80000\',\'#f3b387\',\'#ffc0cb\',\'#d41b56\',\'#c2b280\',\'#ff8413\',\'#964b00\',\'#70201f\',\'#9d5b03\',\'#7b3f00\',\'#3d2b1f\',\'#cc5d2b\',\'#906030\',\'#4d1f1c\',\'#618358\',\'#c04000\',\'#b87333\',\'#532f28\',\'#cd5700\',\'#cc7722\',\'#bd9460\',\'#ac7a33\',\'#e97451\',\'#cd7f32\',\'#866423\',\'#da7c20\',\'#73542f\',\'#f9e04b\',\'#fefe33\',\'#ffbf00\',\'#fde910\',\'#fde456\',\'#ffff99\',\'#ffc000\',\'#edfa8e\',\'#e4d96f\',\'#cfb53b\',\'#f4c430\',\'#c0d727\',\'#ffc125\',\'#ffd700\',\'#ffff00\',\'#e5e4e2\',\'#ded5d0\',\'#dbe3de\',\'#e3e7e6\',\'#c6cece\',\'#c0c0c0\',\'#808080\',\'#7a7d80\',\'#5b5d74\',\'#36454f\',\'#4d5d53\',\'#364135\',\'#006633\',\'#bce27f\',\'#2e8b57\',\'#008080\',\'#808000\',\'#6ebe9f\',\'#9ffb88\',\'#ace1af\',\'#19a56f\',\'#7cfc00\',\'#326647\',\'#00ff00\',\'#33cc66\',\'#6e6f2f\',\'#008000\',\'#003153\',\'#4169e1\',\'#0027c2\',\'#0300fd\',\'#082e79\',\'#3300cc\',\'#00ffff\',\'#000080\',\'#19247c\',\'#3366cc\',\'#007fff\',\'#0000ff\',\'#4b0082\',\'#8aa4b7\',\'#082567\',\'#002d6e\',\'#30d5c8\',\'#00a693\',\'#9d6292\',\'#9966cc\',\'#b803ff\',\'#ee82ee\',\'#660066\',\'#9f9fdf\',\'#800080\',\'#dbb0ef\',\'#964b84\',\'#7fffd4\',\'#800000\',\'#ffcc99\',\'#730029\',\'#600201\',\'#6b5636\',\'#e96b39\',\'#ffe5b4\',\'#e34234\',\'#000000\',\'#8b4726\',\'#fc0300\',\'#801818\',\'#ff0000\',\'#f5f5dc\',\'#cadc79\',\'#cdeba7\',\'#ff2400\',\'#dc143c\',\'#841839\',\'#2c1b01\',\'#c3b091\',\'#c73c07\',\'#ff7f50\',\'#cf2929\',\'#c9a2bf\',\'#c8a2c8\',\'#deb4cb\',\'#dd9ecd\',\'#93f600\',\'#e21e13\',\'#b22222\',\'#e3af34\',\'#e9967b\',\'#d4c279\',\'#532338\',\'#ffa500\',\'#f3ecdb\',\'#e1d9ac\',\'#f23b1c\',\'#cf2f2f\',\'#3a3431\',\'#0c2419\',\'#ad1111\',\'#50344f\',\'#ffe1be\',\'#870121\',\'#cf2942\',\'#ff8000\',\'#660033\',\'#e2e1a3\'];
                        let names = [\'Biały\',\'Alabastrowy\',\'Kość Słoniowa\',\'Chamois\',\'Kremowy\',\'Perłowy\',\'Porcelanowy\',\'Amarantowy\',\'Arbuzowy\',\'Biskupi\',\'Cukierkowy Róż\',\'Cyklamen\',\'Eozyna\',\'Łososiowy\',\'Magenta\',\'Majtkowy\',\'Majerankowy\',\'Malinowy\',\'Pąsowy\',\'Róż Indyjski\',\'Róż Pompejański\',\'Róż Wenecki\',\'Różowy\',\'Rubinowy\',\'Beżowy\',\'Pomarańczowy\',\'Brązowy\',\'Brunatny\',\'Cynamonowy\',\'Czekoladowy\',\'Heban, Hebanowy\',\'Herbaciany\',\'Kakaowy\',\'Kasztanowy\',\'Khaki\',\'Mahoń\',\'Miedziany\',\'Palisander\',\'Rudy\',\'Ochra\',\'Orzechowy\',\'Sepia\',\'Sjena Palona\',\'Spiżowy\',\'Tabaczkowy\',\'Ugier\',\'Umbra\',\'Bahama Yellow\',\'Bananowy\',\'Bursztynowy\',\'Cytrynowy\',\'Jasnożółty\',\'Kanarkowy\',\'Marchewkowy\',\'Siarkowy\',\'Słomkowy\',\'Stare Złoto\',\'Szafranowy\',\'Zieleń Wiosenna\',\'Złocisty\',\'Złoty\',\'Żółty\',\'Platynowy\',\'Siwy\',\'Popielaty\',\'Mysi\',\'Gołębi\',\'Srebrny\',\'Szary\',\'Stalowy\',\'Marengo\',\'Grafitowy\',\'Feldgrau\',\'Antracytowy\',\'Malachitowy\',\'Miętowy\',\'Morska Zieleń\',\'Morski\',\'Oliwkowy\',\'Patynowy\',\'Pistacjowy\',\'Seledynowy\',\'Szmaragdowy\',\'Trawiasty\',\'Zieleń Butelkowa\',\'Zieleń Jaskrawa\',\'Zieleń Veronesea\',\'Zieleń Zgniła\',\'Zielony\',\'Atramentowy\',\'Błękit Królewski\',\'Błękit Paryski\',\'Błękit Thénarda\',\'Błękit Turnbulla\',\'Chabrowy\',\'Cyjan\',\'Granatowy\',\'Kobaltowy\',\'Lapis-Lazuli\',\'Lazurowy\',\'Niebieski\',\'Indygo\',\'Siny\',\'Szafirowy\',\'Ultramaryna\',\'Turkusowy\',\'Grynszpan\',\'Lawendowy\',\'Ametystowy\',\'Fioletowy\',\'Fiołkowy\',\'Jagodowy\',\'Niebieskofioletowy\',\'Purpurowy\',\'Wrzosowy\',\'Śliwkowy\',\'Akwamaryna\',\'Bordowy, Bordo\',\'Brzoskwiniowy\',\'Buraczkowy\',\'Burgund\',\'Bury\',\'Ceglasty\',\'Cielisty\',\'Cynobrowy\',\'Czarny\',\'Czekoladowy\',\'Czerwień Wzrokowa\',\'Czerwień Żelazowa\',\'Czerwony\',\'Écru\',\'Groszkowy\',\'Jaśminowy\',\'Kardynalski\',\'Karmazynowy\',\'Karminowy\',\'Kawowy\',\'Khaki\',\'Koniakowy\',\'Koralowy\',\'Krwisty\',\'Lawendowy\',\'Lila\',\'Lila Róż\',\'Liliowy\',\'Limonkowy\',\'Makowy\',\'Minia\',\'Miodowy\',\'Morelowy\',\'Mosiądzowy\',\'Oberżynowy\',\'Oranż\',\'Piaskowy\',\'Płowy\',\'Pomarańczowy\',\'Poziomkowy\',\'Sadza Angielska\',\'Smolisty\',\'Szkarłatny Żołądź\',\'Śliwkowy\',\'Świniowy\',\'Tango\',\'Truskawkowy\',\'Tycjan\',\'Winny\',\'Woskowy\'];
                  
                        let val = document.getElementById("color-field").value;
                        let color_index = colors.findIndex(checkValue7);
                        if (color_index < 0){
                            color_index = colors.findIndex(checkValue6);
                        };
                        if (color_index < 0){
                            color_index = colors.findIndex(checkValue5);
                        };
                        if (color_index < 0){
                            color_index = colors.findIndex(checkValue4);
                        };
                        if (color_index < 0){
                            color_index = colors.findIndex(checkValue3);
                        };
                        console.log(color_index)
                        if (color_index > -1){
                            document.getElementById("color-name").value = names[color_index]
                            }
                        };
            </script>
            <div class="color-field-wrapper"><label for="color-field">%s</label>
            <input type="color" name="color" id="color-field" value="#ff0000" onClick="saveColor()" onchange="saveColor()">
            <input readonly type="text" name="color-name" id="color-name" value="Wybierz kolor"">
            </div>',
            esc_html($title)
        );
    }
}

add_action('woocommerce_before_add_to_cart_button', 'display_color_field');

function validate_color_field($passed, $product_id, $quantity)
{
    if ($_POST['color-name'] == "Wybierz kolor") {
        $passed = false;
        wc_add_notice(__('Proszę wybrać kolor', 'color-name'), 'error');
    }
    return $passed;
}

add_filter('woocommerce_add_to_cart_validation', 'validate_color_field', 10, 3);

function add_color_field_item_data($cart_item_data, $product_id, $variation_id, $quantity)
{
    if (!empty($_POST['color-name'])) {
        // Add the item data
        $cart_item_data['title_field'] = $_POST['color-name'];
        $product = wc_get_product($product_id);
        $price = $product->get_price();
        $cart_item_data['total_price'] = $price;
    }
    return $cart_item_data;
}

add_filter('woocommerce_add_cart_item_data', 'add_color_field_item_data', 10, 4);

/**
 * Update the price in the cart
 * @since 1.0.0
 */
function before_calculate_totals($cart_obj)
{
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }
    // Iterate through each cart item
    foreach ($cart_obj->get_cart() as $key => $value) {
        if (isset($value['total_price'])) {
            $price = $value['total_price'];
            $value['data']->set_price(($price));
        }
    }
}

add_action('woocommerce_before_calculate_totals', 'before_calculate_totals', 10, 1);

/**
 * Display the custom field value in the cart
 * @since 1.0.0
 */
function cart_item_name($name, $cart_item, $cart_item_key)
{
    if (isset($cart_item['title_field'])) {
        $name .= sprintf(
            '<p>%s</p>',
            esc_html($cart_item['title_field'])
        );
    }
    return $name;
}

add_filter('woocommerce_cart_item_name', 'cart_item_name', 10, 3);

/**
 * Add custom field to order object
 */
function add_custom_data_to_order($item, $cart_item_key, $values, $order)
{
    foreach ($item as $cart_item_key => $values) {
        if (isset($values['title_field'])) {
            $item->add_meta_data(__('Color Field', 'color'), $values['title_field'], true);
        }
    }
}

add_action('woocommerce_checkout_create_order_line_item', 'add_custom_data_to_order', 10, 4);


