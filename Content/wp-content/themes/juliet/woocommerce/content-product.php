<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

if( is_shop()|| is_product_category() || is_product_tag() ) {
    $block_class = 'juliet-product-item';
} else {
    $block_class = 'juliet-product-slick-item';
}
$columns    = wc_get_loop_prop( 'columns', wc_get_default_products_per_row() );
switch ($columns) {
    case 2:
        $block_class .= " juliet-product-item-2";
        break;
    case 3:
        $block_class .= " juliet-product-item-3";
        break;
    case 5:
        $block_class .= " juliet-product-item-5";
        break;
}
?>
<div class="<?php echo $block_class; ?>">
    <div <?php post_class( 'juliet-loop-product' ); ?>>
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked juliet_template_loop_product_thumb - 10
         */
        do_action( 'woocommerce_before_shop_loop_item' );

        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_add_to_cart - 10
         * @hooked juliet_template_loop_product_thumb_close - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );

        /**
         * woocommerce_shop_loop_item_title hook.
         *
         * @hooked juliet_template_loop_product_title - 10
         */
        do_action( 'woocommerce_shop_loop_item_title' );

        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );

        /**
         * woocommerce_after_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_rating - 10
         */
        do_action( 'woocommerce_after_shop_loop_item' );
        ?>
    </div>
</div>