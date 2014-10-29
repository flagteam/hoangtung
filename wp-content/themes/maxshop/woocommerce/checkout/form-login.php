<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( is_user_logged_in() ) return;

if ( get_option('woocommerce_enable_signup_and_login_from_checkout') == "no" ) return;

$info_message = apply_filters('woocommerce_checkout_login_message', __('<h6> Registered Customer ? </h6> ', 'woocommerce'));
?>
<div class="check-accordion2">
    <h5><small>Step 1</small><a href="#"><?php _e('Checkout Information', 'woocommerce'); ?></a></h5>
    <div class="clearfix">
        <div class="span6 cheakout clearfix">
          <h6>New Customer ? <span>Choose your Checkout options:</span></h6>
                                            <form>
                                                <input type="radio"> <label>Check out as a Guest</label> <br>
                                                <input type="radio"> <label>Register Account</label>

                                                <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                                                <input type="submit" value="continue">
                                            </form>
                                        </div>
        <div class="span6 clearfix cheakout register">
<?php echo $info_message; ?> <a href="#" class="showlogin"><?php _e('Click here to login', 'woocommerce'); ?></a>

<?php woocommerce_login_form( array( 'message' => __('', 'woocommerce'), 'redirect' => get_permalink(woocommerce_get_page_id('checkout')) ) ); ?>
  </div> </div> </div>