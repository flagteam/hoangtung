<?php
/**
 * Change password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php $woocommerce->show_messages(); ?>

<form action="<?php echo esc_url( get_permalink(woocommerce_get_page_id('change_password')) ); ?>" class="login" method="post">

		<label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?></label>
		<input type="password" class="input-text" name="password_1" id="password_1" />

		<label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?></label>
		<input type="password" class="input-text" name="password_2" id="password_2" />
	<div class="clear"></div>

	<p><input type="submit"  name="change_password" value="<?php _e( 'Save', 'woocommerce' ); ?>" /></p>

	<?php $woocommerce->nonce_field('change_password')?>
	<input type="hidden" name="action" value="change_password" />

</form>