<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="col-sm-6 juliet-order-by">
    
    <form class="woocommerce-ordering hidden" method="get">
        <select name="orderby" class="orderby">
            <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="paged" value="1" />
        <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
    </form>

    <div class="shop-filter-sortby">
        <div class="dropdown dropdown-select">
            <a class="dropdown-toggle" href="javascript:;" data-toggle="dropdown"><?php echo esc_html('Sort By', 'juliet'); ?></a>
            <ul class="dropdown-menu right">
                <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                    <li><a data-id="<?php echo esc_attr( $id ); ?>" href="#"><?php echo esc_html( $name ); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    
</div>