<?php
/**
 * Cart errors page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>

<?php $woocommerce->show_messages(); ?>
<div class="alert alert-box">
	<p><?php _e('There are some issues with the items in your cart (shown above). Please go back to the cart page and resolve these issues before checking out.', 'woocommerce') ?></p>
</div>
<?php do_action('woocommerce_cart_has_errors'); ?>

<p><a class="red-button" href="<?php echo get_permalink(woocommerce_get_page_id('cart')); ?>"><?php _e('&larr; Return To Cart', 'woocommerce') ?></a></p>