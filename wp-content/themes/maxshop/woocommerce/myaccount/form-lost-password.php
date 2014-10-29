<?php
/**
 * Lost password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

?>

<?php $woocommerce->show_messages(); ?>
<div class="span6 clearfix cheakout acc-login">
    <h6><?php _e( 'Lost your password?', 'woocommerce' ) ?></h6>
<form action="<?php echo esc_url( get_permalink($post->ID) ); ?>" method="post" class="login lost_reset_password">

	<?php	if( 'lost_password' == $args['form'] ) : ?>

    <p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p>

    <label for="user_login"><?php _e( 'Username or email', 'woocommerce' ); ?></label> 
    <input class="input-text" type="text" name="user_login" id="user_login" />

	<?php else : ?>

    <p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce') ); ?></p>

        <label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="password" class="input-text" name="password_1" id="password_1" />

        <label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="password" class="input-text" name="password_2" id="password_2" />


    <input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
    <input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />
	<?php endif; ?>

    <div class="clear"></div>

<input type="submit"  name="reset" value="<?php echo 'lost_password' == $args['form'] ? __( 'Reset Password', 'woocommerce' ) : __( 'Save', 'woocommerce' ); ?>" />
	<?php $woocommerce->nonce_field( $args['form'] ); ?>

</form>
</div>