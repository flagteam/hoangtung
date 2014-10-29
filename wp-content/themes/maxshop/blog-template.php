<?php /* Template Name: Blog */

get_header();


$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '2';
$alc_options = get_option('alc_general_settings');
$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
$titles = $alc_options['alc_show_page_titles'];
$blogLayout =  isset ($alc_options['alc_blog_layout']) ? $alc_options['alc_blog_layout'][0] : '0';
?>
<?php  if ( $titles):?>
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
<div class="blog_wrap">
    <div class="container page-content">
    <div class="row">
		<?php if ($layout == '3'):?>
			<div class="span3"><aside="sidebar"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?></aside></div>
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