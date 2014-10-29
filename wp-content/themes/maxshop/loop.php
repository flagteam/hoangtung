<?php /*** The loop that displays posts.***/ ?>

<?php 

$alc_options = get_option('alc_general_settings');
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
//$blogLayout =  isset ($alc_options['alc_blog_layout']) ? $alc_options['alc_blog_layout'][0] : '0';
//$blogLayout = isset($_GET['blog_layout']) ? $_GET['blog_layout'] : '1';
?>

<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'Maxshop' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'Maxshop' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>
<?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID();?>" <?php post_class('clearfix'); ?>>
        <figure>
            <?php  
			$thumbnail = get_the_post_thumbnail($post->ID, 'blog-list1');
			$postmeta = get_post_custom($post->ID); 
			if(!empty($thumbnail)):?>
				<a href="<?php the_permalink()?>"><?php the_post_thumbnail('blog-list1'); ?></a>
			<?php elseif (isset($postmeta['_post_video'])): ?>
				<iframe src="http://player.vimeo.com/video/<?php echo $postmeta['_post_video'][0]; ?>" width="870" height="330" class="post-image"></iframe>
			<?php else: ?>
				<a href="<?php the_permalink()?>">
					<img src = "http://placehold.it/870x330" alt="<?php _e('No image', 'Maxshop')?>" />
				</a>
			<?php endif; ?>		
        </figure>
		<h2><?php the_title() ?></h2>
		<p class="post_text"><?php echo do_shortcode(get_the_excerpt()); ?></p>
        <ul class="post-meta clearfix">
			<!-- Show comments if set from admin panel -->
            <?php if( 'open' == $post->comment_status && $alc_options['alc_blog_show_comments']) : ?>        
				<li>
					<?php comments_popup_link( __( '0 Comments', 'Maxshop' ), __( '1 Comment', 'Maxshop' ), __( '% Comments', 'Maxshop' )); ?>
				</li>
            <?php endif?>
            <?php if($alc_options['alc_blog_show_date']): ?>
				<li>
					<span><?php echo get_the_time('M d, Y'); ?></span>
				</li>
            <?php endif?>
		</ul>
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %1$s', 'Maxshop' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="read">
			<?php echo isset($alc_options['alc_blogreadmore']) ? $alc_options['alc_blogreadmore'] : _e ('Read More', 'Maxshop') ?>
		</a>
    </article>

<?php endwhile;?>

<div class="pagination clearfix">
    <?php 
        if ( $wp_query->max_num_pages > 1 ) :
	include(Maxshop_PLUGINS. '/wp-pagenavi.php' );
	if(function_exists('wp_pagenavi')) { wp_pagenavi();}
	endif; 
    ?>
</div>
