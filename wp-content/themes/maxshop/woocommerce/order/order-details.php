<?php
/**
 * Order details
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$order = new WC_Order( $order_id );
?>
<div class="billing">
<h2><?php _e( 'Order Details', 'woocommerce' ); ?></h2>
        <ul class="title order_details">
            <li class="product-name"><?php _e( 'Product name', 'woocommerce' ); ?></li>
            <li class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></li>
            <li class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></li>
	</ul>

    <?php
        if (sizeof($order->get_items())>0) {
            foreach($order->get_items() as $item) {
                $_product = get_product( $item['variation_id'] ? $item['variation_id'] : $item['product_id'] );
                echo '<ul class = "order_details ' . esc_attr( apply_filters( 'woocommerce_order_table_item_class', 'order_table_item', $item, $order ) ) . '">
                        <li class="product-name">' .
			apply_filters( 'woocommerce_order_table_product_title', '<a href="' . get_permalink( $item['product_id'] ) . '">' . $item['name'] . '</a>', $item );
                        $item_meta = new WC_Order_Item_Meta( $item['item_meta'] );
			$item_meta->display();
                       if ( $_product->exists() && $_product->is_downloadable() && $_product->has_file() && ( $order->status=='completed' || ( get_option( 'woocommerce_downloads_grant_access_after_payment' ) == 'yes' && $order->status == 'processing' ) ) ) :
                                    $download_file_urls = $order->get_downloadable_file_urls( $item['product_id'], $item['variation_id'], $item );

					$i     = 0;
					$links = array();

					foreach ( $download_file_urls as $file_url => $download_file_url ) {

						$filename = woocommerce_get_filename_from_url( $file_url );

						$links[] = '<small><a href="' . $download_file_url . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_file_urls ) > 1 ? ' ' . ( $i + 1 ) . ': ' : ': ' ) ) . $filename . '</a></small>';

						$i++;
					}

					echo implode( '<br/>', $links );
			endif;
                        echo '</li><li class="product-quantity">'.$item['qty'].'</li><li class="product-total">' . $order->get_formatted_line_subtotal( $item ) . '</li></ul>';
		// Show any purchase notes
                        if ($order->status=='completed' || $order->status=='processing') {
                            if ($purchase_note = get_post_meta( $_product->id, '_purchase_note', true))
                                echo '<ul class="product-purchase-note"><li >' . apply_filters('the_content', $purchase_note) . '</li></ul>';
                        }
            }
	}
	do_action( 'woocommerce_order_items_table', $order );
    ?>
<div class="totle">
    <table class="shop_table order_details">
    <tfoot>
        <?php
            if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
	?>
	<tr>
            <th colspan="2" scope="row"><?php echo $total['label']; ?></th>
            <td><?php echo $total['value']; ?></td>
	</tr>
	<?php
            endforeach;
	?>
    </tfoot>	
</table>
</div>

<?php if ( get_option('woocommerce_allow_customers_to_reorder') == 'yes' && $order->status=='completed' ) : ?>
	<p class="order-again">
		<a href="<?php echo esc_url( $woocommerce->nonce_url( 'order_again', add_query_arg( 'order_again', $order->id, add_query_arg( 'order', $order->id, get_permalink( woocommerce_get_page_id( 'view_order' ) ) ) ) ) ); ?>" class="button"><?php _e( 'Order Again', 'woocommerce' ); ?></a>
	</p>
<?php endif; ?>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

        <header class="title">
            
	<h5>
            <a href="#"></a>
            <?php _e( 'Customer details', 'woocommerce' ); ?>
        </h5>
</header>
<dl class="customer_details">
<?php
	if ($order->billing_email) echo '<dt>'.__( 'Email:', 'woocommerce' ).'</dt><dd>'.$order->billing_email.'</dd>';
	if ($order->billing_phone) echo '<dt>'.__( 'Telephone:', 'woocommerce' ).'</dt><dd>'.$order->billing_phone.'</dd>';
?>
</dl>

<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>

<div class="col2-set addresses">

	<div class="col-1">

<?php endif; ?>

		<header class="title">
                    
			<h5>
                            <a href="#"></a>
                            <?php _e( 'Billing Address', 'woocommerce' ); ?>
                        </h5>
		</header>
		<address><p>
			<?php
				if (!$order->get_formatted_billing_address()) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
			?>
		</p></address>

<?php if (get_option('woocommerce_ship_to_billing_address_only')=='no') : ?>

	</div><!-- /.col-1 -->

	<div class="col-2">

		<header class="title">
			<h5>
                            <a href="#"></a>
                            <?php _e( 'Shipping Address', 'woocommerce' ); ?>
                        </h5>
		</header>
		<address><p>
			<?php
				if (!$order->get_formatted_shipping_address()) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();
			?>
		</p></address>

	</div><!-- /.col-2 -->

</div><!-- /.col2-set -->

<?php endif; ?>

<div class="clear"></div>
</div><!-- /.billing -->