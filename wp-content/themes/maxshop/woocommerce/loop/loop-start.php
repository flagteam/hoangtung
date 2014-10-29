<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
<?php
$alc_options = get_option('alc_general_settings');
$prodLayout =  isset ($alc_options['alc_prlayout']) ? $alc_options['alc_prlayout'][0] : '1';
if($prodLayout==0){
    echo '<div class="product-grid clearfix">';
}
else{
    echo '<div class="product-list clearfix">';
}
?>

