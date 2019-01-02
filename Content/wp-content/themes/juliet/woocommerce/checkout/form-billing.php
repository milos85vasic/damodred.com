<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php _e( 'Billing &amp; Shipping', 'juliet' ); ?></h3>

	<?php else : ?>

		<h3><?php _e( 'Billing details', 'juliet' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper form-group">
		<?php 
			$fields = $checkout->get_checkout_fields( 'billing' );
			foreach ( $fields as $key => $field ) : ?>
				<?php
				$field['label_class'] = 'form-label';
				if( in_array( $key, array( 'billing_first_name', 'billing_email', 'billing_state' ) ) ) : ?>
				<div class="row">
				<?php endif; ?>
				<?php if( in_array( $key, array( 'billing_first_name', 'billing_email', 'billing_state', 'billing_last_name', 'billing_phone', 'billing_postcode' ) ) ) : ?>
					<div class="col-sm-6">
				<?php endif; ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php if( in_array( $key, array( 'billing_first_name', 'billing_email', 'billing_state', 'billing_last_name', 'billing_phone', 'billing_postcode' ) ) ) : ?>
					</div>
				<?php endif; ?>
				<?php if( in_array( $key, array( 'billing_last_name', 'billing_phone', 'billing_postcode' ) ) ) : ?>
				</div>
				<?php endif; ?>
		<?php endforeach; ?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<div class="form-group">
                <div class="checkbox">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> <span><?php _e( 'Create an account?', 'juliet' ); ?></span>
                    </label>
                </div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' )  as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
