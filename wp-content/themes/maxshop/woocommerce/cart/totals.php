<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>
                              
<div class="cart_totals <?php if ( $woocommerce->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">
<?php do_action( 'woocommerce_before_cart_totals' ); ?>
<?php if ( ! $woocommerce->shipping->enabled || $available_methods || ! $woocommerce->customer->get_shipping_country() || ! $woocommerce->customer->has_calculated_shipping() ) : ?>
    <ul class="cart-subtotal black">
        <li><?php _e( 'Subtotal:', 'woocommerce' ); ?></li>
    </ul>
    <ul class="gray">
        <li><?php echo $woocommerce->cart->get_cart_subtotal(); ?></li>
    </ul>
    <?php if ( $woocommerce->cart->get_discounts_before_tax() ) : ?>
    <ul class="discount black">
        <li><?php _e( 'Cart Discount', 'woocommerce' ); ?> <a href="<?php echo add_query_arg( 'remove_discounts', '1', $woocommerce->cart->get_cart_url() ) ?>"><?php _e( 'x', 'woocommerce' ); ?></a></li>
    </ul>
    <ul class="gray">
        <li>-<?php echo $woocommerce->cart->get_discounts_before_tax(); ?></li>
    </ul>
    <?php endif; ?>
    <?php if ( $woocommerce->cart->needs_shipping() && $woocommerce->cart->show_shipping() && ( $available_methods || get_option( 'woocommerce_enable_shipping_calc' ) == 'yes' ) ) : ?>
    <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
    <ul class="shipping black">
        <li><?php _e( 'Shipping', 'woocommerce' ); ?></li>
    </ul>
    <ul class="gray">
        <li><?php woocommerce_get_template( 'cart/shipping-methods.php', array( 'available_methods' => $available_methods ) ); ?></li>
    </ul>
    <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
    <?php endif ?>
    <?php foreach ( $woocommerce->cart->get_fees() as $fee ) : ?>
    <ul class="black fee fee-<?php echo $fee->id ?>">
        <li><?php echo $fee->name ?></li>
    </ul>
    <ul class="gray">
        <li><?php
                if ( $woocommerce->cart->tax_display_cart == 'excl' )
                    echo woocommerce_price( $fee->amount );
		else
                    echo woocommerce_price( $fee->amount + $fee->tax );
            ?>
        </li>
    </ul>
    <?php endforeach; ?>
    <?php
// Show the tax row if showing prices exclusive of tax only
    if ( $woocommerce->cart->tax_display_cart == 'excl' ) {
        foreach ( $woocommerce->cart->get_tax_totals() as $code => $tax ) {
            echo '<ul class=" black tax-rate tax-rate-' . $code . '">
                    <li>' . $tax->label . '</li>
                  </ul>
                  <ul class="gray">
                    <li>'. $tax->formatted_amount .'</li>
                  </ul>';
        }
    }
    ?>
    <?php if ( $woocommerce->cart->get_discounts_after_tax() ) : ?>
    <ul class="black discount">
        <li><?php _e( 'Order Discount', 'woocommerce' ); ?> <a href="<?php echo add_query_arg( 'remove_discounts', '2', $woocommerce->cart->get_cart_url() ) ?>" title="Remove"><?php _e( 'x', 'woocommerce' ); ?></a></li>
    </ul>
    <ul class="gray">
        <li>-<?php echo $woocommerce->cart->get_discounts_after_tax(); ?></li>
    </ul>
    <?php endif; ?>
    <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
    <ul class="black total">
        <li><?php _e( 'Grand Total', 'woocommerce' ); ?></li>
    </ul>
    <ul class="gray total-gray">
        <li><?php echo $woocommerce->cart->get_total(); ?></li>
    </ul>
    <?php
// If prices are tax inclusive, show taxes here
    if (  $woocommerce->cart->tax_display_cart == 'incl' ) {
        $tax_string_array = array();
        foreach ( $woocommerce->cart->get_tax_totals() as $code => $tax ) {
            $tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
	}
        if ( ! empty( $tax_string_array ) ) {
        echo '<small class="includes_tax">' . sprintf( __( '(Includes %s)', 'woocommerce' ), implode( ', ', $tax_string_array ) ) . '</small>';
        }
    }
    ?>
    <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
    <?php if ( $woocommerce->cart->get_cart_tax() ) : ?>
    <p><small>
        <?php
	$estimated_text = ( $woocommerce->customer->is_customer_outside_base() && ! $woocommerce->customer->has_calculated_shipping() ) ? sprintf( ' ' . __( ' (taxes estimated for %s)', 'woocommerce' ), $woocommerce->countries->estimated_for_prefix() . __( $woocommerce->countries->countries[ $woocommerce->countries->get_base_country() ], 'woocommerce' ) ) : '';
        printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );
	?>
        </small></p>
    <?php endif; ?>
    <?php elseif( $woocommerce->cart->needs_shipping() ) : ?>
    <?php if ( ! $woocommerce->customer->get_shipping_state() || ! $woocommerce->customer->get_shipping_postcode() ) : ?>
    <div class="woocommerce-info">
        <p><?php _e( 'No shipping methods were found; please recalculate your shipping and enter your state/county and zip/postcode to ensure there are no other available methods for your location.', 'woocommerce' ); ?></p>
    </div>
    <?php else : ?>
    <?php
        $customer_location = $woocommerce->countries->countries[ $woocommerce->customer->get_shipping_country() ];
	echo apply_filters( 'woocommerce_cart_no_shipping_available_html',
            '<div class="woocommerce-error"><p>' .
                sprintf( __( 'Sorry, it seems that there are no available shipping methods for your location (%s).', 'woocommerce' ) . ' ' . __( 'If you require assistance or wish to make alternate arrangements please contact us.', 'woocommerce' ), $customer_location ) .
            '</p></div>'
	);
    ?>
    <?php endif; ?>
    <?php endif; ?>
    <?php do_action( 'woocommerce_after_cart_totals' ); ?>
</div>