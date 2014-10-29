<?php /* Template Name: Regular page */ 

$alc_options = get_option('alc_general_settings');
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$blogLayout =  isset ($alc_options['alc_blog_layout']) ? $alc_options['alc_blog_layout'][0] : '1';
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
                <?php  if ($titles):?>
                    <h1>
                        <?php 
                        $headline = get_post_meta($post->ID, "_headline", $single = false);
			if(!empty($headline[0]) ){echo $headline[0];}
			else{echo get_the_title();} 
			?>
		</h1>
		<?php endif?>
            </div>        
            </div>
        </div>
    </div>
</div>
<?php endif?>
<div class="product_wrap">
    <div class="container page-content">
	<div class="row">
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <?php if ($layout == '3'):?><div class="span3"><aside id="sidebar"> <?php generated_dynamic_sidebar() ?></aside></div><?php endif?>
            <div class="<?php echo $layout == '1' ? 'span12' : 'span9'?>">
                <?php the_content(); ?>
            </div>
            <?php if ($layout == '2'):?><div class="span3"><aside id="sidebar"> <?php generated_dynamic_sidebar() ?></aside></div> <?php endif?>
        <?php endwhile; ?>	
        <div class="clear"></div>
	</div>
    </div>
</div>

<?php get_footer();?>