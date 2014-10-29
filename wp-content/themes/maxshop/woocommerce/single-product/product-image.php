<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<div id="carousel-wrapper" class="spcarousel">
    <div id="carousel" class="cool-carousel">
	<?php
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );
			$attachment_count   = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}
			
			$ids = $product->get_gallery_attachment_ids();
			
			for ($i=0; $i<$attachment_count; $i++)
			{
				$image_link = wp_get_attachment_url($ids[$i]);
				echo '<span id="prodimage'.$ids[$i].'"><img src="'.$image_link.'" alt="" /></span>';
			}
			//echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<span id="%s"   class="zoom" title="%s">%s</span>', $image_link, $image_title, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>
    </div>
    <a href="#" class="prev"></a><a href="#" class="next"></a>
    <div class="bottom">
		<div id="thumbs-wrapper">
			<div id="thumbs">
				<?php do_action( 'woocommerce_product_thumbnails' ); ?>
			</div>
			<a id="prev" href="#"></a>
			<a id="next" href="#"></a>
		</div>
	</div>
</div>
