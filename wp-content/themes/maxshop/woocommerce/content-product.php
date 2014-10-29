<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibilty
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;
$alc_options = get_option('alc_general_settings');
$prodLayout =  isset ($alc_options['alc_prlayout']) ? $alc_options['alc_prlayout'][0] : '1';
?>
<div class="<?php echo $prodLayout==0 ? 'span3' : 'clearfix'?> product <?php
	if ( $woocommerce_loop['loop'] % 4 == 0 )
		echo 'last';
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
		echo 'first';
	?>">
	<?php echo  $prodLayout==0 ? '<div>' : ''?>
        <figure> 
			<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

			<a href="<?php the_permalink(); ?>">

				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
				
			</a>
            <div class="overlay">
                <a href="<?php echo  wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="zoom"></a>
                <a href="<?php the_permalink(); ?>" class="link"></a>
            </div>
		</figure>
		<div class="detail">         
			<h4><a href="<?php the_permalink()?>"><?php the_title()?></a></h4>
			<span><?php echo $product->get_price_html(); ?></span>
			<?php
			if($prodLayout==1){
			 echo apply_filters( 'woocommerce_short_description', limit_words($post->post_excerpt, 25) );
			 }        
			?>
			
			<div class="icon">
				<?php
				if (shortcode_exists('yith_wcwl_add_to_wishlist')):
					echo  do_shortcode("[yith_wcwl_add_to_wishlist]");
				endif;	
				do_action( 'woocommerce_after_shop_loop_item' ); 
				
			?>
			</div>
		</div>
	<?php echo  $prodLayout==0 ? '</div>' : ''?>
</div>
<?php if  ( $woocommerce_loop['loop'] % 4 == 0 ):?><div class="clear height20"></div><?php endif?>