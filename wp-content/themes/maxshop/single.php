<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); 
	
?>

<div class="bar-wrap">
    <div class="container">
        <div class="row">
			<div class="span12">
				<div class="title-bar">
                    <h1>
                        <?php 
                            $headline = get_post_meta($post->ID, "_headline", $single = false);
                            if(!empty($headline[0]) ){echo $headline[0];}
                            else{echo get_the_title();} 
						?>
                    </h1>
				</div>        
            </div>
        </div>
    </div>
</div>
<div class="blog_wrap">
    <div class="container">
        <div class="row">
			<div class="span9 blog">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID();?>" <?php post_class('clearfix'); ?>>
						<figure>
							<?php  
							$thumbnail = get_the_post_thumbnail($post->ID, 'blog-list1');
							$postmeta = get_post_custom($post->ID); 
							if(!empty($thumbnail)):?>
								<a href="<?php the_permalink()?>"><?php the_post_thumbnail('blog-list1'); ?></a>
							<?php elseif (isset($postmeta['_post_video'])): ?>
								<iframe src="http://player.vimeo.com/video/<?php echo $postmeta['_post_video'][0]; ?>" width="740" height="350" class="post-image"></iframe>
							<?php else: ?>
								<a href="<?php the_permalink()?>">
									<img src = "<?php echo get_template_directory_uri()?>/images/picture.png" alt="<?php _e('No image', 'Maxshop')?>" />
								</a>
							<?php endif ?>		
						</figure>
						<h2><?php the_title() ?></h2>
						<p><?php the_content(); ?></p>
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
					</article>
					<?php wp_link_pages();?>
				<?php endwhile;?>
				<div class="commnts-wrap">
					<?php comments_template(); ?>
					<?php $test = false; if ($test) {comment_form(); } ?>
				</div>
			</div>
			<div class="span3">
				<div id="sidebar2">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?>
				</div>
			</div>
        </div>
    </div>
</div>
<?php get_footer(); ?>