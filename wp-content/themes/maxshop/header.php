<!DOCTYPE html>
<!--[if IE 8]> 	<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>  

	<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        
    <?php  $alc_options = get_option('alc_general_settings'); ?>
	
   	<?php if(!empty($alc_options['alc_favicon'])):?>
		<link rel="shortcut icon" href="<?php echo $alc_options['alc_favicon'] ?>" /> 
 	<?php endif?>
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri() ?>/js/html5shiv-printshiv.js"></script><![endif]-->
	<!--[if IE]><link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/ie.css" /><![endif]-->
    <?php 
   		$bodyFont = isset($alc_options['alc_body_font']) ? $alc_options['alc_body_font'] : 'off';
		$headingsFont =(isset($alc_options['alc_headings_font']) && $alc_options['alc_headings_font'] !== 'off') ? $alc_options['alc_headings_font'] : 'off';
		$menuFont = (isset($alc_options['alc_menu_font']) && $alc_options['alc_menu_font'] !== 'off') ? $alc_options['alc_menu_font'] : 'off';
	
		$fonts['body, p, .content_wrapper a, #menu-top-menu a, ol, .content_wrapper li #menu-top-menu li, label, #copyright'] = $bodyFont;
		$fonts['h1, h2, h3, h4, h5, h6'] = $headingsFont;
		$fonts['#menu-main a'] = $menuFont;
		
		foreach ($fonts as $value => $key)
		{
			if($key != 'off' && $key != ''){ 
				$api_font = str_replace(" ", '+', $key);
				$font_name = font_name($key);
				
				echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family='.$api_font.'" />';
				echo "<style type=\"text/css\">".$value."{ font-family: '".$key."' !important; }</style>";			
			}
		}
	?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>	
<?php if (!is_page_template('under-construction.php')):?>
	<!-- HEADER -->
	<div class="header-bar">
		<div class="container">
			<div class="row">
			   <div class="span12 right">
				   <div class="social-strip">
						<?php
						global $woocommerce;
						wp_nav_menu(array( 
							'theme_location' => 'top_nav',
							'menu' =>'top_nav', 
							'container'=>'', 
							'depth' => 1, 
							'menu_class' => 'inline-list alc_top_menu'
							));
						?>
				   </div>
				   <div class="languages">
					   <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Sidebar") ) : ?> <?php   endif;?>
				   </div>
				   <div class="clearfix"></div>
			   </div>
		   </div>
	   </div>
	</div>

	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="span5">
					<div class="logo">	
						<a href="<?php echo home_url() ?>" id="logo">
							<?php if(!empty($alc_options['alc_logo'])):?>
								<img src="<?php echo $alc_options['alc_logo'] ?>" alt="<?php echo $alc_options['alc_logotext']?>" id="logo-image" />
							<?php else:?>
								<?php echo isset($alc_options['alc_logotext']) ? $alc_options['alc_logotext'] : 'Maxshop' ?>
							<?php endif?>
						</a>	
						<p><?php bloginfo('description'); ?></p>
						<div class="clear"></div>
					</div>
				</div>
				<div class="span5">
					<form action="<?php echo site_url() ?>" method="get" id="search-global-form">   
						<input type="text" placeholder="<?php _e('Type and hit enter', 'Maxshop');?>" name="s" id="search" value="<?php the_search_query(); ?>" />
						<input type="submit" value="" name="search"  id="searchsubmit">
					</form>
				</div>
				<div class="span2">
					<div class="cart">
						<ul>
							<li class="first">
								<?php if (isset($woocommerce)):?>
									<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'Maxshop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'Maxshop'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
								<?php endif?>
							</li>
						</ul>
					</div>
				</div>
			 </div>
		</div>
	</div>

	<header>
		<div class="container">
			<div class="row">
				<div class="span12">
					<nav class="desktop-nav">
						<?php 
							if(function_exists('wp_nav_menu')):
								wp_nav_menu( 
								array( 
									'theme_location' => 'primary_nav',
									'menu' =>'primary_nav', 
									'container'=>'', 
									'depth' => 4, 
									'menu_class' => 'clearfix',
									)  
								); 
							else:
								?><ul class="sf-menu top-level-menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul><?php
							endif; 
						?>						
					</nav>
					<select onchange="document.location.href=this.options[this.selectedIndex].value;" id="selectpage" class="selectBox">
						<option value=""><?php echo  _e('Select page', 'Maxshop'); ?></option> 
						<?php 
						$pages = get_pages(array('parent' => 0)); 
						if($pages)
						{
							foreach ($pages as $pagg) {
								 $option = '<option value="'.get_page_link($pagg->ID).'">';
								 $option .= $pagg->post_title;
								 $option .= '</option>';
								 echo $option;
							}
							wp_reset_query();
						}
						?>
					 </select>
				</div>
			</div>
		</div>
	</header>
	<!-- HEADER -->
<?php endif; ?>