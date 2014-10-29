<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages();
?>
<?php do_action( 'woocommerce_before_cart' ); ?>
<div class="shopping-cart">
<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
<?php do_action( 'woocommerce_before_cart_table' ); ?>
    <ul class="title clearfix">
        <li class="product-thumbnail"><?php _e( 'Image', 'woocommerce' ); ?></li>
	<li class="product-name"><?php _e( 'Product Name', 'woocommerce' ); ?></li>
        <li class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></li>
	<li class="product-price"><?php _e( 'Unit Price', 'woocommerce' ); ?></li>
	<li class="product-subtotal"><?php _e( 'Sub Total', 'woocommerce' ); ?></li>
        <li class="product-remove"><?php _e( 'Action', 'woocommerce' ); ?></li>
    </ul>
    <ul class="clearfix">
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>
	<?php
            if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
                foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
                    $_product = $values['data'];
                    if ( $_product->exists() && $values['quantity'] > 0 ) {
	?>
	<li class="product-thumbnail">
	<?php
           $thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );
            printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
	?>
	</li>
	<li class="product-name">
	<?php
            if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
                echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
            else
                printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );
	echo $woocommerce->cart->get_item_data( $values );
        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
            echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
	?>
	</li>
	<li class="product-quantity">
	<?php
	if ( $_product->is_sold_individually() ) {
            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
	} else {
            $step = apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
            $min 	= apply_filters( 'woocommerce_quantity_input_min', '', $_product );
            $max 	= apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );
            $product_quantity = sprintf( '<input type="number" name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="input-text qty text" />', $cart_item_key, $step, $min, $max, esc_attr( $values['quantity'] ) );
	}
        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
	?>
	</li>
	<li class="product-price">
	<?php
            $product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
            echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
	?>
	</li>
	<li class="product-subtotal">
	<?php
            echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
	?>
        </li>
	<li class="product-remove">
	<?php
            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key );
	?>
	</li>
	<?php
                }
            }
	}
	do_action( 'woocommerce_cart_contents' );
	?>
    </ul>
   <?php  ?>
    <a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>" class="red-button"><?php _e( 'Continue shopping', 'woocommerce' ); ?></a>
    <input type="submit" class="red-button black" name="update_cart" value="<?php _e( 'Update Shopping Cart', 'woocommerce' ); ?>" /> 
 <?php $woocommerce->nonce_field('cart') ?>
        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
<?php do_action( 'woocommerce_after_cart_table' ); ?>	
    <input type="submit" class="red-button" name="proceed" value="<?php _e( 'Proceed to Checkout', 'woocommerce' ); ?>" />
        <?php do_action('woocommerce_proceed_to_checkout'); ?>    		
</form>
</div>
<div class="row cart-calculator clearfix">
    <div class="span4">
        <?php woocommerce_shipping_calculator(); ?>
        <?php do_action('woocommerce_cart_collaterals'); ?>
    </div>
    <div class="span4">
        <?php if ( $woocommerce->cart->coupons_enabled() ) { ?>
        <form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
			<h6><?php _e( 'DISCOUNT CODES', 'woocommerce' ); ?></h6>
			<div class="estimate clearfix">
				<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Your postcode', 'woocommerce' ); ?>"/> 
				<input type="submit" class="red-button" name="apply_coupon" value="<?php _e( 'Get quotes', 'woocommerce' ); ?>" />
				<?php do_action('woocommerce_cart_coupon'); ?>
			</div>
		<?php } ?>
		</form>
    </div>
    <div class="span4 total clearfix">
	<?php woocommerce_cart_totals(); ?>
    </div>
</div>
