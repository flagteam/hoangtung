<?php /* Template Name: HomePage */ 

$alc_options = get_option('alc_general_settings');
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$blogLayout =  isset ($alc_options['alc_blog_layout']) ? $alc_options['alc_blog_layout'][0] : '1';
$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
$titles = $alc_options['alc_show_page_titles'];
?>

<?php get_header();?>

<div class="product_wrap">
    <div class="container">
		<div class="row">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php if ($layout == '3'):?><div class="span3"><div id="sidebar2"> <?php generated_dynamic_sidebar() ?></div></div><?php endif?>
				<div class="<?php echo $layout == '1' ? 'span12' : 'span9'?>">
					<?php the_content(); ?>
				</div>
				<?php if ($layout == '2'):?><div class="span3"><div id="sidebar2"> <?php generated_dynamic_sidebar() ?></div></div> <?php endif?>
			<?php endwhile; ?>	
			<div class="clear"></div>
		</div>
    </div>
</div>

<?php get_footer();?>