<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() )
	return;
?>
<div class="sorting-bar clearfix">	
		<form class="woocommerce-ordering" method="get">
                    <label>Sort by</label>
                    <select name="orderby" class="orderby selectBox">
				<?php
					$catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
						'menu_order' => __( 'Default sorting', 'woocommerce' ),
						'popularity' => __( 'popularity', 'woocommerce' ),
						'rating'     => __( 'average rating', 'woocommerce' ),
						'date'       => __( 'newness', 'woocommerce' ),
						'price'      => __( 'price: low to high', 'woocommerce' ),
						'price-desc' => __( 'price: high to low', 'woocommerce' )
					) );

					if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
						unset( $catalog_orderby['rating'] );

					foreach ( $catalog_orderby as $id => $name )
						echo '<option value="' . esc_attr( $id ) . '" ' . selected( $orderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
				?>
			</select>
			<?php
				// Keep query string vars intact
				foreach ( $_GET as $key => $val ) {
					if ( 'orderby' == $key )
						continue;
					
					if (is_array($val)) {
						foreach($val as $innerVal) {
							echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
						}
					
					} else {
						echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
					}
				}
			?>
		</form>
  