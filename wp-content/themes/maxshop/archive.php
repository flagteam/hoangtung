<?php get_header();?>
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
        <div class="span12">
        <h1>
            <?php if ( is_day() ) : ?>
            <?php printf( __( 'Daily Archives: <span>%s</span>', 'Maxshop' ), get_the_date() ); ?>
            <?php elseif ( is_month() ) : ?>
            <?php printf( __( 'Monthly Archives: <span>%s</span>', 'Maxshop' ), get_the_date('F Y') ); ?>
            <?php elseif ( is_year() ) : ?>
            <?php printf( __( 'Yearly Archives: <span>%s</span>', 'Maxshop' ), get_the_date('Y') ); ?>
            <?php elseif ( is_category() ) : ?>
            <?php single_cat_title();?>
            <?php else : ?>
            <?php _e( 'Blog Archives', 'Maxshop' ); ?>
            <?php endif; ?>
	</h1>
        </div>
        <div class="span9 blog">
            <?php
                if ( have_posts() ) the_post();
		rewind_posts();       
		get_template_part( 'loop', 'archive' );
            ?>
    	</div>
        <div class="span3"><div id="sidebar2">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?>
        </div></div>
       	<div class="clear"></div>
    </div>
    </div>
</div>

<?php get_footer(); ?>