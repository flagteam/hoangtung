<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( get_option('woocommerce_enable_shipping_calc')=='no' || ! $woocommerce->cart->needs_shipping() )
	return;
?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

                               
                                  
<h6><?php _e( 'Estimate Shipping &amp; Taxes', 'woocommerce' ); ?></h6>
<div class="estimate clearfix">
    <form class="shipping_calculator" action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
        <select name="calc_shipping_country" id="calc_shipping_country" class="" rel="calc_shipping_state">
            <option value=""><?php _e( 'Select a country&hellip;', 'woocommerce' ); ?></option>
            <?php
                foreach( $woocommerce->countries->get_allowed_countries() as $key => $value )
                echo '<option value="' . esc_attr( $key ) . '"' . selected( $woocommerce->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
            ?>
	</select>
        <?php
            $current_cc = $woocommerce->customer->get_shipping_country();
            $current_r  = $woocommerce->customer->get_shipping_state();
            $states     = $woocommerce->countries->get_states( $current_cc );
	// Hidden Input
            if ( is_array( $states ) && empty( $states ) ) {
        ?>
        <input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'woocommerce' ); ?>" />
        <?php
	// Dropdown Input				
            } elseif ( is_array( $states ) ) {
	?>
        <select name="calc_shipping_state" id="calc_shipping_state" class="selectBox" placeholder="<?php _e( 'State / county', 'woocommerce' ); ?>">
            <option value=""><?php _e( 'Select a state&hellip;', 'woocommerce' ); ?></option>
            <?php
                foreach ( $states as $ckey => $cvalue )
                    echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . __( esc_html( $cvalue ), 'woocommerce' ) .'</option>';
            ?>
	</select>
        <?php
        // Standard Input
            } else {
	?>
        <input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php _e( '--Select your region--', 'woocommerce' ); ?>" name="calc_shipping_state" id="calc_shipping_state" />
        <?php
            }
	?>
	<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>
	<input type="text" class="input-text" value="<?php echo esc_attr( $woocommerce->customer->get_shipping_city() ); ?>" placeholder="<?php _e( 'City', 'woocommerce' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
	<?php endif; ?>
	<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
            <input type="text" class="input-text" value="<?php echo esc_attr( $woocommerce->customer->get_shipping_postcode() ); ?>" placeholder="<?php _e( 'Your Postcode', 'woocommerce' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
	<?php endif; ?>
        <input type="submit" name="calc_shipping" value="<?php _e( 'Get Quotes', 'woocommerce' ); ?>" class="red-button">
        <?php $woocommerce->nonce_field('cart') ?>
    </form>
</div>
<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>