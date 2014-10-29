<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<div class="check-accordion2">
   <?php if(is_user_logged_in()){?>
    <h5><small>Step 1</small><a href="#"><?php _e('Cupon Information', 'woocommerce'); ?></a></h5>
    <?php }else{ ?>
    <h5><small>Step 2</small><a href="#"><?php _e('CUpon Information', 'woocommerce'); ?></a></h5>
    <?php } ?>
    <div class="clearfix">
        <div class="span6 checkout clearfix">
<?php
if ( get_option( 'woocommerce_enable_coupons' ) == 'no' || get_option( 'woocommerce_enable_coupon_form_on_checkout' ) == 'no' ) return;

$info_message = apply_filters('woocommerce_checkout_coupon_message', __('<h6>Have a coupon?</h6>', 'woocommerce'));
?>

<?php echo $info_message; ?> <a href="#" class="showcoupon"><?php _e('Click here to enter your code', 'woocommerce'); ?></a>

<form class="checkout_coupon" method="post">

	<p class="form-row form-row">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e('Coupon code', 'woocommerce'); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row">
		<input type="submit"  name="apply_coupon" value="<?php _e('Apply Coupon', 'woocommerce'); ?>" />
	</p>

	<div class="clear"></div>
</form>
    </div></div></div>