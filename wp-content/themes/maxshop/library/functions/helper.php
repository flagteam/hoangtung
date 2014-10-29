<?php

/************* COMMENTS HOOK *************/

function maxshop_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	
    <li class="clearfix" id="li-comment-<?php comment_ID() ?>">
            <figure>
                <a href="<?php echo get_comment_author_link()?>" rel="external nofollow">
                <?php echo get_avatar($comment); ?> 
                </a>
            </figure>
            <?php if ($comment->comment_approved == '0') : ?>
            <p><em><?php _e('Your comment is awaiting moderation.', 'Maxshop') ?></em></p>
            <?php endif; ?>
            <div>
                <p>
                    <a href="<?php echo get_comment_author_link()?>" rel="external nofollow"><?php echo get_comment_author()?></a>		
                    <span><?php printf(__('%1$s at %2$s', 'Maxshop'), get_comment_date(),get_comment_time()) ?></span>
                    <?php edit_comment_link(__('(Edit)', 'Maxshop'),'  ','') ?>
                </p>
                <p class="com_text"><?php comment_text() ?></p>
                <div class="com_reply ">
                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'style'=>'<ul class="com_child"', 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>
        </li>	
<?php }

/*****************************************/


/*************** SIDEBAR *****************/

if ( function_exists('register_sidebar') )
{
    register_sidebar( array(
    'name' => 'Header Sidebar',
    'id' => 'header-sidebar',
    'before_widget' => '<div>',
    'after_widget' => "</div>",
    'before_title' => '',
    'after_title' => '',
) );
register_sidebar(array(
	'name' => 'Blog Sidebar',
	'id' => 'global-sidebar-1',
	'before_widget' => '<div id="%1$s" class="widget sidebar-widget portfolio_sidebar %2$s">',
	'after_widget' => '</div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="widget-content">',
));

register_sidebar(array(
	'name' => 'Footer Top Sidebar',
	'id' => 'footer-top-sidebar',
	'before_widget' => '<div id="%1$s" class="widget sidebar-widget footer_top_sidebar %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));

register_sidebar(array(
	'name' => 'Shop sidebar',
	'id'	=> 'shop-sidebar-1',
	'before_widget' => '<div id="%1$s" class="shop-sidebar widget %2$s">',
	'after_widget' => '</div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="widget-content">',
));
        
   $al_options = get_option('alc_general_settings'); 
	$footer_widget_count = isset($al_options['alc_footer_widgets_count']) ? $al_options['alc_footer_widgets_count']:4;

	for($i = 1; $i<= $footer_widget_count; $i++)
	{
		unregister_sidebar('Footer Widget '.$i);
		if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'name' => 'Footer Widget '.$i,
			'id'	=> 'footer-sidebar-'.$i,
			'before_widget' => '<div class="span3">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="widget"><h3>',
			'after_title' => '</h3>',
		));
	}
}

add_filter('widget_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');

/*******************************************/


/********* STRING MANIPULATIONS ************/

function alc_trim($text, $length, $end = '[...]') {
	$text = preg_replace('`\[[^\]]*\]`', '', $text);
	$text = strip_tags($text);
	$text = substr($text, 0, $length);
	$text = substr($text, 0, last_pos($text, " "));
	$text = $text . $end;
	return $text;
}

function last_pos($string, $needle){
   $len=strlen($string);
   for ($i=$len-1; $i>-1;$i--){
       if (substr($string, $i, 1)==$needle) return ($i);
   }
   return FALSE;
}

function limit_words($string, $word_limit) {
 
	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character
 
	$words = explode(' ', $string);
 
	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character
 
	return implode(' ', array_slice($words, 0, $word_limit)).'...';
}

function custom_tag_cloud_widget($args) {
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 10; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );

/*******************************************/

/********** GET PAGES BY PARAMS ************/

/*-- Get root parent of a page --*/
function get_root_page($page_id) 
{
	global $wpdb;
	
	$parent = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE post_type='page' AND ID = '$page_id'");
	
	if ($parent == 0) 
		return $page_id;
	else 
		return get_root_page($parent);
}


/*-- Get page name by ID --*/
function get_page_name_by_ID($page_id)
{
	global $wpdb;
	$page_name = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = '$page_id'");
	return $page_name;
}


/*-- Get page ID by Page Template --*/
function get_page_ID_by_page_template($template_name)
{
	global $wpdb;
	$page_ID = $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$template_name' AND meta_key = '_wp_page_template'");
	return $page_ID;
}

/*-- Get page content (Used for pages with custom post types) --*/
if(!function_exists('getPageContent'))
{
	function getPageContent($pageId)
	{
		if(!is_numeric($pageId))
		{
			return;
		}
		global $wpdb;
		$sql_query = 'SELECT DISTINCT * FROM ' . $wpdb->posts .
		' WHERE ' . $wpdb->posts . '.ID=' . $pageId;
		$posts = $wpdb->get_results($sql_query);
		if(!empty($posts))
		{
			foreach($posts as $post)
			{
				return nl2br($post->post_content);
			}
		}
	}
}


/* -- Get page ID by Custom Field Value -- */
function get_page_ID_by_custom_field_value($custom_field, $value)
{
	global $wpdb;
	$page_ID = $wpdb->get_var("
	    SELECT wposts.ID
    	FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
	    WHERE wposts.ID = wpostmeta.post_id 
    	AND wpostmeta.meta_key = '$custom_field' 
	    AND (wpostmeta.meta_value like '$value,%' OR wpostmeta.meta_value like '%,$value,%' OR wpostmeta.meta_value like '%,$value' OR wpostmeta.meta_value = '$value')		
    	AND wposts.post_status = 'publish' 
	    AND wposts.post_type = 'page'
		LIMIT 0, 1");

	return $page_ID;
}
/*******************************************/

add_theme_support( 'automatic-feed-links' );
if ( ! isset( $content_width ) ) $content_width = 960;
add_filter('the_excerpt', 'do_shortcode');

/******* POSTS RELATED BY TAXONOMY *********/

function get_taxonomy_related_posts($post_id, $taxonomy, $limit, $args=array()) {
  $query = new WP_Query();
  $terms = wp_get_object_terms($post_id, $taxonomy);
  if (count($terms)) {
    $post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
    $post = get_post($post_id);
    $args = wp_parse_args($args,array(
      'post_type' => $post->post_type, 
      'post__in' => $post_ids,
	  'exclude' => $post_id,
      'taxonomy' => $taxonomy,
      'term' => $terms[0]->slug,
	  'posts_per_page' => $limit
    ));
    $query = new WP_Query($args);
  }
  return $query;
}

/********************************************/

/*************  ENABLE SESSIONS *************/

function cp_admin_init() {
	if (!session_id())
	session_start();
}

add_action('init', 'cp_admin_init');

/********************************************/


/**************  GOOGLE FONTS ***************/

function font_name($string){
		
	$check = strpos($string, ':');
	if($check == false){
		return $string;
	} else { 
		preg_match("/([\w].*):/i", $string, $matches);
		return $matches[1];
	} 
} 



/************** LIST TAXONOMY ***************/

function list_taxonomy($taxonomy, $id='')
{
	$args = array ('hide_empty' => false);
	$tax_terms = get_terms($taxonomy, $args); 
	$active = '';
	$output = '<ul id="'.$id.'">';

	foreach ($tax_terms as $tax_term) {
		if ($taxonomy  == $tax_term)
		{
			$active  = ' class="active"';
		}
		$output.='<li><a href="'.esc_attr(get_term_link($tax_term, $taxonomy)) . '"'.$active.'>'.$tax_term->name.'</a></li>';
	}
	$output.='</ul>';
	
	return $output;
}

/********************************************/