<?php /** The template for displaying Archive pages. **/
get_header();
$layout = 2;
?>

<div class="bar-wrap">
    <div class="container">
        <div class="row">
			<div class="span12">
				<div class="title-bar">
					<h1><?php printf( __( 'Search Results for: %s', 'Maxshop' ), '<mark>' . get_search_query() . '</mark>' ); ?></h1>
				</div>        
            </div>
        </div>
    </div>
</div>
<div class="blog_wrap">
    <div class="container page-content">
		<div class="row">
		
			<div class="<?php echo $layout == '1' ? 'span12' : 'span9'?> blog"> 
				<?php if ( have_posts() ) : ?>
					<?php get_template_part( 'loop', 'search' );?>
				<?php else : ?>
					<div id="post-0" class="post no-results not-found">
						<h1><?php _e( 'Nothing Found', 'Maxshop' ); ?></h1>
						<div class="entry-content">
							<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'Maxshop' ); ?></p>
						 </div><!-- .entry-content -->
					</div><!-- #post-0 -->
				<?php endif; ?>
			</div>
			<?php if ($layout == '2'):?>
				<div class="span3"><aside id="sidebar"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?></aside></div>
			<?php endif?>
			<div class="clear"></div>
		</div>
	</div>
</div>

<?php get_footer(); ?>