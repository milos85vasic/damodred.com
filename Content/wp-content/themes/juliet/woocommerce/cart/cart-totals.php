<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
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
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

<div class="row">
    <div class="col-sm-5 col-sm-offset-7 text-right">
    
	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
    
    <ul class="list-total">
    
        <li class="cart-subtotal">
            <label><?php _e( 'Subtotal', 'juliet' ); ?></label>
            <?php wc_cart_totals_subtotal_html(); ?>
        </li>
        
        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
        <li class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
            <label><?php wc_cart_totals_coupon_label( $coupon ); ?></label>
            <?php wc_cart_totals_coupon_html( $coupon ); ?>
        </li>
        <?php endforeach; ?>
        
        
        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

        <li class="shipping">
            <label><?php _e( 'Shipping', 'juliet' ); ?></label>
            <?php woocommerce_shipping_calculator(); ?>
        </li>

		<?php endif; ?>
        
        
        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
		<li class="fee">
            <label><?php echo esc_html( $fee->name ); ?></label>
            <?php wc_cart_totals_fee_html( $fee ); ?>
		</li>
		<?php endforeach; ?>
        
        
        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' <small>' . __( '(estimated for %s)', 'juliet' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
					: '';

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<li class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<label><?php echo esc_html( $tax->label ) . $estimated_text; ?></label>
						<?php echo wp_kses_post( $tax->formatted_amount ); ?>
					</li>
				<?php endforeach; ?>
			<?php else : ?>
				<li class="tax-total">
					<label><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></label>
					<?php wc_cart_totals_taxes_total_html(); ?>
				</li>
			<?php endif; ?>
		<?php endif; ?>
        
        <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<li class="order-total">
			<label><?php _e( 'Total', 'juliet' ); ?></label>
			<?php wc_cart_totals_order_total_html(); ?>
		</li>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</ul>

	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

    </div>
</div>
</div>
