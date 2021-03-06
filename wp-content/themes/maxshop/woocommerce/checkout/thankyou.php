<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */


global $woocommerce;
?>

<?php if ($order) : ?>
<div class="billing">
	<?php if (in_array($order->status, array('failed'))) : ?>

		<p><?php _e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce'); ?></p>

		<p><?php
			if (is_user_logged_in()) :
				_e('Please attempt your purchase again or go to your account page.', 'woocommerce');
			else :
				_e('Please attempt your purchase again.', 'woocommerce');
			endif;
		?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e('Pay', 'woocommerce') ?></a>
			<?php if (is_user_logged_in()) : ?>
			<a href="<?php echo esc_url( get_permalink(woocommerce_get_page_id('myaccount')) ); ?>" class="button pay"><?php _e('My Account', 'woocommerce'); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<p><?php _e('Thank you. Your order has been received.', 'woocommerce'); ?></p>

		<ul class="title">
                    <li><?php _e('Order:', 'woocommerce'); ?></li>
                    <li><?php _e('Date:', 'woocommerce'); ?></li>
                    <li><?php _e('Total:', 'woocommerce'); ?></li>
                    <li><?php _e('Payment method:', 'woocommerce'); ?></li>
                  
                    </ul>
                    <ul>
			<li class="order">
				
				<strong><?php echo $order->get_order_number(); ?></strong>
			</li>
			<li class="date">
				
				<strong><?php echo date_i18n(get_option('date_format'), strtotime($order->order_date)); ?></strong>
			</li>
			<li class="total">
				
				<strong><?php echo $order->get_formatted_order_total(); ?></strong>
			</li>
			<?php if ($order->payment_method_title) : ?>
			<li class="method">
				
				<strong><?php
					echo $order->payment_method_title;
				?></strong>
			</li>
			<?php endif; ?>
		</ul>
                    
		<div class="clear"></div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>
</div>
<?php else : ?>

	<p><?php _e('Thank you. Your order has been received.', 'woocommerce'); ?></p>

<?php endif; ?>