<?php 
#Woocommerce breadrumbs

add_filter('woocommerce_breadcrumb_defaults', 'juliet_woocommerce_breadcrumbs');
function juliet_woocommerce_breadcrumbs()
{
    return array(
        'delimiter' => '',
        'wrap_before' => '<ol class="woocommerce-breadcrumb breadcrumb">',
        'wrap_after' => '</ol>',
        'before' => '<li>',
        'after' => '</li>',
        'home' => _x('Home', 'breadcrumb', 'juliet'),
    );
}

#Woocommerce Loop Hooks

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action('woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_before_shop_loop_item', 'juliet_template_loop_product_thumb', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_before_shop_loop_item_title', 'juliet_template_loop_product_thumb_close', 10);
add_action('woocommerce_shop_loop_item_title', 'juliet_template_loop_product_title', 10);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

#Woocommerce Single Product Hooks

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 1 );


#Insert the opening tag for product-thumb class in the loop.

function juliet_template_loop_product_thumb()
{
    $output = "<div class=\"product-thumb\">\n";
    $output .= "\t\t\t<a href=\"".get_the_permalink()."\" class=\"woocommerce-LoopProduct-link\">\n";
    $output .= "\t\t\t\t".woocommerce_get_product_thumbnail()."\n";
    $output .= "\t\t\t</a>\n";
    $output .= "\t\t\t<span class=\"product-thumb-bag-icon\"><i class=\"fa fa-shopping-bag\"></i></span>\n";
    echo $output;
}

#Insert the opening tag for product-thumb class in the loop.

function juliet_template_loop_product_thumb_close()
{
    //global $woocommerce;
    //echo "\t\t<a href=\"" . $woocommerce->cart->get_cart_url() . "\" class=\"added_to_cart\" title=\"" . esc_html__( 'View cart', 'juliet' ) . "\">" . esc_html__( 'View cart', 'juliet' ) . "</a>\n";
    echo "\t\t</div>\n";
}

#Show the product title in the product loop. By default this is an H2.

function juliet_template_loop_product_title()
{
    echo '<h4 class="woocommerce-loop-product__title product-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
}

/**
 * Get the product thumbnail, or the placeholder if not set.
 *
 * @subpackage    Loop
 * @param string $size (default: 'shop_catalog')
 * @param int $deprecated1 Deprecated since WooCommerce 2.0 (default: 0)
 * @param int $deprecated2 Deprecated since WooCommerce 2.0 (default: 0)
 * @return string
 */
function woocommerce_get_product_thumbnail($size = 'large', $deprecated1 = 0, $deprecated2 = 0)
{
    global $post;

    if (has_post_thumbnail()) {
        $props = wc_get_product_attachment_props(get_post_thumbnail_id(), $post);
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
		$image = $image[0];

        return '<img src="'.$props['src'].'" alt="'.$props['alt'].'" title="'.$props['title'].'" class="img-responsive" />';
    } elseif (wc_placeholder_img_src()) {
        return '<img src="'.woocommerce_placeholder_img_src().'" alt="'.esc_html__('No image', 'juliet').'" class="img-responsive" />';
    }
}

    /**
     * Outputs a checkout/address form field.
     *
     * @subpackage	Forms
     * @param string $key
     * @param mixed $args
     * @param string $value (default: null)
     */
    function woocommerce_form_field( $key, $args, $value = null ) {
        $defaults = array(
            'type'              => 'text',
            'label'             => '',
            'description'       => '',
            'placeholder'       => '',
            'maxlength'         => false,
            'required'          => false,
            'autocomplete'      => false,
            'id'                => $key,
            'class'             => array(),
            'label_class'       => array(),
            'input_class'       => array(),
            'return'            => false,
            'options'           => array(),
            'custom_attributes' => array(),
            'validate'          => array(),
            'default'           => '',
            'autofocus'         => '',
            'priority'          => '',
        );

        $args = wp_parse_args( $args, $defaults );
        $args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

        if ( $args['required'] ) {
            $args['class'][] = 'validate-required';
            //$required = ' <span class="asterisk" title="' . esc_attr__( 'required', 'juliet' ) . '">*</span>';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'juliet' ) . '">*</abbr>';
        } else {
            $required = '';
        }

        if ( is_string( $args['label_class'] ) ) {
            $args['label_class'] = array( $args['label_class'] );
        }

        if ( is_null( $value ) ) {
            $value = $args['default'];
        }

        // Custom attribute handling
        $custom_attributes         = array();
        $args['custom_attributes'] = array_filter( (array) $args['custom_attributes'] );

        if ( $args['maxlength'] ) {
            $args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
        }

        if ( ! empty( $args['autocomplete'] ) ) {
            $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
        }

        if ( true === $args['autofocus'] ) {
            $args['custom_attributes']['autofocus'] = 'autofocus';
        }

        if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
            foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
                $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
            }
        }

        if ( ! empty( $args['validate'] ) ) {
            foreach ( $args['validate'] as $validate ) {
                $args['class'][] = 'validate-' . $validate;
            }
        }

        $field           = '';
        $label_id        = $args['id'];
        $sort            = $args['priority'] ? $args['priority'] : '';
        $field_container = '<div class="form-group" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</div>';

        switch ( $args['type'] ) {
            case 'country' :

                $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

                if ( 1 === sizeof( $countries ) ) {

                    $field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

                    $field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" />';

                } else {

                    $field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select form-control selectpicker ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . '>' . '<option value="">' . esc_html__( 'Select a country&hellip;', 'juliet' ) . '</option>';

                    foreach ( $countries as $ckey => $cvalue ) {
                        $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
                    }

                    $field .= '</select>';

                    $field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country', 'juliet' ) . '" /></noscript>';

                }

                break;
            case 'state' :

                /* Get Country */
                $country_key = 'billing_state' === $key ? 'billing_country' : 'shipping_country';
                $current_cc  = WC()->checkout->get_value( $country_key );
                $states      = WC()->countries->get_states( $current_cc );

                if ( is_array( $states ) && empty( $states ) ) {

                    $field_container = '<div class="form-group" id="%2$s" style="display: none">%3$s</div>';

                    $field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';

                } elseif ( ! is_null( $current_cc ) && is_array( $states ) ) {

                    $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select form-control selectpicker' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
						<option value="">' . esc_html__( 'Select a state&hellip;', 'juliet' ) . '</option>';

                    foreach ( $states as $ckey => $cvalue ) {
                        $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
                    }

                    $field .= '</select>';

                } else {

                    $field .= '<input type="text" class="input-text form-control ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

                }

                break;
            case 'textarea' :

                $field .= '<textarea name="' . esc_attr( $key ) . '" class="form-control ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="5"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';

                break;
            case 'checkbox' :

                $field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
						<input type="' . esc_attr( $args['type'] ) . '" class="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> '
                    . $args['label'] . $required . '</label>';

                break;
            case 'password' :
            case 'text' :
            case 'email' :
            case 'tel' :
            case 'number' :

                $field .= '<input type="' . esc_attr( $args['type'] ) . '" class="form-control ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

                break;
            case 'select' :

                $options = $field = '';

                if ( ! empty( $args['options'] ) ) {
                    foreach ( $args['options'] as $option_key => $option_text ) {
                        if ( '' === $option_key ) {
                            // If we have a blank option, select2 needs a placeholder
                            if ( empty( $args['placeholder'] ) ) {
                                $args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'juliet' );
                            }
                            $custom_attributes[] = 'data-allow_clear="true"';
                        }
                        $options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
                    }

                    $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="form-control selectpicker ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';
                }

                break;
            case 'radio' :

                $label_id = current( array_keys( $args['options'] ) );

                if ( ! empty( $args['options'] ) ) {
                    foreach ( $args['options'] as $option_key => $option_text ) {
                        $field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
                        $field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . $option_text . '</label>';
                    }
                }

                break;
        }

        if ( ! empty( $field ) ) {
            $field_html = '';

            if ( $args['label'] && 'checkbox' != $args['type'] ) {
                $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] . $required . '</label>';
            }

            $field_html .= $field;

            if ( $args['description'] ) {
                $field_html .= '<span class="description">' . esc_html( $args['description'] ) . '</span>';
            }

            $container_class = esc_attr( implode( ' ', $args['class'] ) );
            $container_id    = esc_attr( $args['id'] ) . '_field';
            $field           = sprintf( $field_container, $container_class, $container_id, $field_html );
        }

        $field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

        if ( $args['return'] ) {
            return $field;
        } else {
            echo $field;
        }
    }



#Order of fields on Woocommerce checkout form

add_filter("woocommerce_checkout_fields", "juliet_order_fields");

function juliet_order_fields($fields) {

    $order = array(
        "billing_first_name",
        "billing_last_name",
        "billing_company",
        "billing_email",
        "billing_phone",
        "billing_country",
        "billing_address_1",
        "billing_address_2",
        "billing_city",
        "billing_state",
        "billing_postcode",
    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
    return $fields;

}

#WooCommerce sidebar

function juliet_is_active_woocommerce_sidebar(){
	if(is_shop()){
		if(is_active_sidebar('sidebar-woocommerce')) return true;
		if(is_active_sidebar('sidebar-woocommerce-bordered')) return true;
	}
	if(is_product()){
		if(is_active_sidebar('sidebar-woocommerce-product')) return true;
	}
	if(is_product_category()){
		if(is_active_sidebar('sidebar-woocommerce-product-category')) return true;
	}
	if(is_cart()){
		if(is_active_sidebar('sidebar-woocommerce-cart')) return true;
	}
	if(is_checkout()){
		if(is_active_sidebar('sidebar-woocommerce-checkout')) return true;
	}
}

/**
 * Add classes to order button.
 *
 * This function is attached to 'woocommerce_order_button_html'
 * filter hook.
 *
 * @param  string $button Order button markup.
 * @return string         Returns filtered order button markup.
 */
function lyrathemes_woocommerce_order_button_html( $button ) {
    // The text of the button
    $order_button_text = esc_html__( 'Place order', 'juliet' );

    return '<button type="submit" class="btn btn-dark btn-xlg btn-block button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>';
}
add_filter( 'woocommerce_order_button_html', 'lyrathemes_woocommerce_order_button_html' );
?>