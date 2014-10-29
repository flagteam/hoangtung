<?php header("Content-type: text/css; charset: UTF-8"); 
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
$alc_options = get_option('alc_general_settings');
?>
<?php if ( $alc_options['alc_custom_background'] != '' || $alc_options['alc_background_color'] != '' || $alc_options['alc_background_repeat'] != '') :?>
body{
	<?php 	if ($alc_options['alc_custom_background'] !='') :?>background-image:url('<?php echo $alc_options['alc_custom_background']?>') !important;<?php endif;?>
	<?php 
	echo $alc_options['alc_background_color'] != '' ? 'background-color:'.$alc_options['alc_background_color'].';' : '';  
	echo $alc_options['alc_background_repeat'] != '' ? 'background-repeat:'.$alc_options['alc_background_repeat'].';' : ''; 	
	?>
}
<?php endif?>
<?php if ($alc_options['alc_topbar_bg'] || $alc_options['alc_topbar_bg_color']):?>
.header-bar{
	<?php if (!(empty($alc_options['alc_topbar_bg']))):?> background-image:url('<?php echo $alc_options['alc_topbar_bg']?>'); <?php endif ?> 
	<?php if (!(empty($alc_options['alc_topbar_bg_repeat']))):?> background-repeat:<?php echo $alc_options['alc_topbar_bg_repeat'] ?>; <?php endif ?> 
	<?php if (!(empty($alc_options['alc_topbar_bg_color']))):?> background-color:<?php echo $alc_options['alc_topbar_bg_color'] ?>; <?php endif ?> 
}
<?php endif?>
<?php if ($alc_options['alc_header_bg'] || $alc_options['alc_header_bg_color']):?>
header, .header-top{
	<?php if (!(empty($alc_options['alc_header_bg']))):?> background-image:url('<?php echo $alc_options['alc_header_bg']?>'); <?php endif ?> 
	<?php if (!(empty($alc_options['alc_header_bg_repeat']))):?> background-repeat:<?php echo $alc_options['alc_header_bg_repeat'] ?>; <?php endif ?> 
		<?php if (!(empty($alc_options['alc_header_bg_color']))):?> background-color:<?php echo $alc_options['alc_header_bg_color'] ?>; <?php endif ?> 
}
<?php endif?>
<?php if ($alc_options['alc_content_bg'] || $alc_options['alc_content_bg_static']):?>
.title-bar{
	<?php if (!(empty($alc_options['alc_content_bg']))):?> background-image:url('<?php echo $alc_options['alc_content_bg']?>'); <?php endif ?> 
	<?php if (!(empty($alc_options['alc_content_bg_static']))):?> background-color:<?php echo $alc_options['alc_content_bg_static']?>; <?php endif ?> 
	<?php if (!(empty($alc_options['alc_content_bg_repeat']))):?> background-repeat:<?php echo $alc_options['alc_content_bg_repeat']?>; <?php endif ?> 
	
}
<?php endif?>
<?php if($alc_options['alc_menu_color'] != ''):?>
.desktop-nav ul li > a {color:<?php echo $alc_options['alc_menu_color']?>}
<?php endif?>
<?php if($alc_options['alc_submenu_color'] != ''):?>
.desktop-nav ul li ul li a{color:<?php echo $alc_options['alc_submenu_color']?>}
<?php endif?>
<?php if($alc_options['alc_submenu_bg'] != ''):?>
.desktop-nav ul li ul li, .desktop-nav ul li ul li a  {background-color:<?php echo $alc_options['alc_submenu_bg']?>}
<?php endif?>
<?php if($alc_options['alc_menu_hover_color'] != ''):?>
.desktop-nav  a:hover, .current-menu-item a:hover, .current_page_item a:hover, .current_page_parent a:hover, .current-menu-parent a:hover, .top-bar-section ul>li> a:hover {color:<?php echo $alc_options['alc_menu_hover_color'] ?> !important;}
<?php endif?>
<?php if($alc_options['alc_menu_active_bg'] != ''):?>
.desktop-nav > li.active a, 
.desktop-nav .current > a, .desktop-nav .current-menu-item > a, .desktop-nav .current_page_item > a, .desktop-nav .current_page_parent > a, .desktop-nav .current-menu-parent > a{background-color:<?php echo $alc_options['alc_menu_active_bg']?>;}
<?php endif?>
<?php if($alc_options['alc_main_color']):?>
.slider > a.next, .slider > a.prev, .slider .slider-btn a:hover, .product figure .overlay, .work_slide a.prev:hover, .work_slide a.next:hover, .read,
.contact-form form input[type="submit"], .slider .slider-btn .activeSlide, #thumbs-wrapper a#prev, #thumbs-wrapper a#next {
	background-color:<?php echo $alc_options['alc_main_color']?>;
}
.detail span, .button, .product_list_widget li span, .product_wrap li a:hover{
	color:<?php echo $alc_options['alc_main_color']?>;
}
{
	border-color:<?php echo $alc_options['alc_main_color']?>;
}
{
	border-left-color:<?php echo $alc_options['alc_main_color']?>;
}

<?php endif?>
<?php if($alc_options['alc_headings_color'] != ''):?>h1, h2, h3, h4, h5, h6 {color:<?php echo $alc_options['alc_headings_color']?> !important}<?php endif?>
<?php if($alc_options['alc_footer_color'] != ''):?>
.footer *{<?php echo 'color:'.$alc_options['alc_footer_color'] ?>!important;}
<?php endif?>
<?php if($alc_options['alc_footer_bg'] != '' || $alc_options['alc_footer_bg_color'] != ''):?>
.footer{
	<?php if($alc_options['alc_footer_bg'] != ''):?>background-image:url('<?php echo $alc_options['alc_footer_bg']?>'); <?php endif?>
	background-repeat:<?php echo $alc_options['footer_bg_repeat'] ?>;	
	<?php if($alc_options['alc_footer_bg_color'] != ''):?>background-color:<?php	echo  $alc_options['alc_footer_bg_color'] ?><?php endif?>;
}
<?php endif?>
<?php if($alc_options['alc_topmenu_font_size'] != ''):?>
#menu-main a{font-size: <?php echo $alc_options['alc_topmenu_font_size']?>}
<?php endif?>
<?php if($alc_options['alc_dropdownmenu_font_size'] != ''):?>
#menu-main ul li a{font-size: <?php echo $alc_options['alc_dropdownmenu_font_size']?> !important}
<?php endif?>
<?php if($alc_options['alc_body_font_size'] != ''):?>
body, p, ul#twitter_update_list li, .crumb_navigation ul a, .footer p, .widget ul li a{font-size: <?php echo $alc_options['alc_body_font_size']?>}
<?php endif?>
<?php if($alc_options['alc_main_layout']):?>
.main-wrapper, .top-header, .footer_wrapper{ margin:0 auto; max-width:1020px;}
<?php endif?>
<?php if($alc_options['alc_custom_css']):?>
	<?php echo $alc_options['alc_custom_css'] ?>
<?php endif?>