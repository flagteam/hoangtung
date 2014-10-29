<?php /* Template Name: Blog */

get_header();


$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '2';
$alc_options = get_option('alc_general_settings');
$blogLayout =  isset ($alc_options['alc_blog_layout']) ? $alc_options['alc_blog_layout'][0] : '0';
?>

<div class="blog_wrap">
    <div class="container">
		<div class="row">
			<?php if ($layout == '3'):?>
				<div class="span3"><aside id="sidebar"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?></aside></div>
			<?php endif?>
			<div class="<?php echo $layout == '1' ? 'span12' : 'span9'?> blog">
				<?php 
					$temp = $wp_query;
					$wp_query= null;
					$wp_query = new WP_Query();
					$pp = get_option('posts_per_page');
					$wp_query->query('posts_per_page='.$pp.'&paged='.$paged);			
					get_template_part( 'loop', 'index' );
				?>
			</div>
			<?php if ($layout == '2'):?>
				<div class="span3"><aside id="sidebar"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?></aside></div>
			<?php endif?>
			<div class="clear"></div>
		</div>
    </div>
</div>

<?php get_footer(); ?>