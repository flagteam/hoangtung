<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if (is_user_logged_in()) return;
?>
<form method="post" class="login clearfix" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

		<label for="username"><?php _e( 'Your e-mail address', 'woocommerce' ); ?></label>
		<input type="text" class="input-text" name="username" id="username" placeholder="yourmail@domain.com" />
                <br>
		<label for="password"><?php _e( 'Password', 'woocommerce' ); ?></label>
		<input class="input-text" type="password" name="password" id="password" placeholder="enter your password" />
                <br>
		<?php $woocommerce->nonce_field('login', 'login') ?>
                <a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>"><?php _e( 'Forgot your password ?', 'woocommerce' ); ?></a>
		<input type="submit"  name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		

	<div class="clear"></div>
</form>