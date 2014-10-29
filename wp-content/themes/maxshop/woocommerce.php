<?php /* Template Name: Regular page */ 

$alc_options = get_option('alc_general_settings');

//$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$prodLayout =  isset ($alc_options['alc_prlayout']) ? $alc_options['alc_prlayout'][0] : '1';
$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
$titles = $alc_options['alc_show_page_titles'];
?>

<?php get_header();?>
<?php  if ($titles):?>
<div class="bar-wrap">
    <div class="container">
        <div class="row">
			<div class="span12">
				<div class="title-bar">         
					<h1>
						<?php woocommerce_page_title(); ?>
					</h1>
				</div>        
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="product_wrap">
    <div class="container">
	<div class="row">
       
            
            <div class="span9 ">
                <?php woocommerce_content(); ?>
            </div>
           <div class="span3"><aside id="sidebar" class="shop-sidebar"> <?php dynamic_sidebar("Shop sidebar") ?></aside></div>

        <div class="clear"></div>
	</div>
    </div>
</div>

<?php get_footer();?>