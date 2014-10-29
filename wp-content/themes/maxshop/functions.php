<?php
/********************* DEFINE MAIN PATHS ********************/

define('Maxshop_PLUGINS',  get_template_directory() . '/addons' ); // Shortcut to the /addons/ directory

$adminPath 	=  get_template_directory() . '/library/admin/';
$funcPath 	=  get_template_directory() . '/library/functions/';
$incPath 	=  get_template_directory() . '/library/includes/';

global $alc_options;
$alc_options = isset($_POST['options']) ? $_POST['options'] : get_option('alc_general_settings');

/************************************************************/


/************* LOAD REQUIRED SCRIPTS AND STYLES *************/
function maxshop_loadScripts()
{
	$alc_options = isset($_POST['options']) ? $_POST['options'] : get_option('alc_general_settings');
	if( $GLOBALS['pagenow'] != 'wp-login.php' && !is_admin())
	{         
		wp_enqueue_style('tooltipster',  get_template_directory_uri().'/css/tooltipster.css');
		wp_enqueue_style('ie', get_template_directory_uri().'/css/ie.css');
		wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.css');
		wp_enqueue_style('bootstrap-responsive', get_template_directory_uri().'/css/bootstrap-responsive.css');
		wp_enqueue_style('main-styles', get_stylesheet_directory_uri().'/style.css');
		wp_enqueue_style('responsive',  get_template_directory_uri().'/responsive.css');
		
		wp_enqueue_style('prettyphoto',  get_template_directory_uri().'/css/prettyPhoto.css');
		wp_enqueue_style('dynamic-styles',  get_template_directory_uri().'/css/dynamic-styles.php');
		wp_enqueue_style('font-awesome',  get_template_directory_uri().'/addons/fontawesome/css/font-awesome.min.css');
        wp_enqueue_style('font-awesome',  get_template_directory_uri().'/css/themes/default/default.css');
		wp_enqueue_style('jplayer-styles',  get_template_directory_uri().'/js/jplayer/skin/pink.flag/jplayer.pink.flag.css',false,'3.0.1','all');
        
		// Register or enqueue scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizr', get_template_directory_uri() .'/js/modernizr.custom.17475.js');
		wp_enqueue_script('bootstrap',  get_template_directory_uri(). '/js/bootstrap.min.js', array('jquery'), '3.2', true);
		wp_enqueue_script('jquery-ui',  get_template_directory_uri(). '/js/jquery-ui.js', array('jquery'), '3.2', true);
        wp_enqueue_script('jquery-cycle', get_template_directory_uri() .'/js/jquery.cycle.all.js', array('jquery'), '3.2', true);
		wp_enqueue_script('jplayer-audio',  get_template_directory_uri().'/js/jplayer/jquery.jplayer.min.js', array('jquery'), '3.2', true);
		wp_enqueue_script('elastislide', get_template_directory_uri() .'/js/jquery.elastislide.js', array('jquery'), '3.2', true);
		wp_enqueue_script('carouFredSel',  get_template_directory_uri(). '/js/jquery.carouFredSel-6.0.4-packed.js', array('jquery'), '3.2', true);
		wp_enqueue_script('selectBox', get_template_directory_uri() .'/js/jquery.selectBox.js', array('jquery'), '3.2', true);
		wp_enqueue_script('tooltipster', get_template_directory_uri() .'/js/jquery.tooltipster.min.js', array('jquery'), '3.2', true);
		wp_enqueue_script('prettyphoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array('jquery'), '3.2', true);
		wp_enqueue_script('custom', get_template_directory_uri() .'/js/custom.js', array('jquery'), '3.2', true);
		wp_enqueue_script('Validate',  get_template_directory_uri().'/js/jquery.validate.min.js', array('jquery'), '3.2', true);
		wp_enqueue_script('flickr', get_template_directory_uri().'/addons/flickr/jflickrfeed.min.js', array('jquery'), '3.2', true);
     	if (is_page_template('contact-template.php')){
			$alc_options = get_option('alc_general_settings'); 
			if (!empty($alc_options['alc_contact_address']))
			{
				wp_enqueue_script('Google-map-api',  'http://maps.google.com/maps/api/js?sensor=false');
				wp_enqueue_script('Google-map',  get_template_directory_uri().'/js/gmap3.min.js', array('jquery'), '3.2', true);
			}			
		}		
		if (is_page_template('under-construction.php'))
		{
			wp_enqueue_script('Under-construction',  get_template_directory_uri().'/js/jquery.countdown.js', array('jquery'), '3.2', true);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'maxshop_loadScripts' ); //Load All Scripts

function maxshop_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'maxshop-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300,700,600,800" );
    wp_enqueue_style( 'maxshop-oswald', "$protocol://fonts.googleapis.com/css?family=Oswald:400,700" );
    wp_enqueue_style( 'maxshop-quattrocento', "$protocol://fonts.googleapis.com/css?family=Quattrocento:400,700" );
    
    }
add_action( 'wp_enqueue_scripts', 'maxshop_fonts' );

/************************************************************/


/********************* DEFINE MAIN PATHS ********************/

require_once ($funcPath . 'helper.php');
require_once ($incPath . 'the_breadcrumb.php');
require_once ($incPath . 'OAuth.php');
require_once ($incPath . 'twitteroauth.php');
require_once ($funcPath . 'options.php');
require_once ($funcPath . 'post-types.php');
require_once ($funcPath . 'widgets.php');
require_once ($funcPath . 'sidebar-generator.php');
require_once ($funcPath . '/shortcodes/shortcode.php');
require_once ($adminPath . 'custom-fields.php');
require_once ($adminPath . 'scripts.php');
require_once ($adminPath . 'admin-panel/admin-panel.php');
// Redirect To Theme Options Page on Activation
if (is_admin() && isset($_GET['activated'])){
	wp_redirect(admin_url('admin.php?page=adminpanel'));
	unregister_sidebar('header-sidebar');
}

/************************************************************/


/*************** AFTER THEME SETUP FUNCTIONS ****************/

add_action( 'after_setup_theme', 'maxshop_setup' );
function maxshop_setup() {
	// Language support 
	load_theme_textdomain( 'Maxshop',  get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file =  get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) ){
		require_once( $locale_file );
	}
	
	// ADD SUPPORT FOR POST THUMBS 
	add_theme_support( 'post-thumbnails');
	// Define various thumbnail sizes
	add_image_size('blog-list1', 740, 350, true); 
	add_image_size('blog-thumb', 50, 50, true);

	//ADD SUPPORT FOR WORDPRESS 3 MENUS ************/

	add_theme_support( 'menus' );
	//Register Navigations
	add_action( 'init', 'my_custom_menus' );
	function my_custom_menus() {
		register_nav_menus(
			array(
				'primary_nav' => __( 'Primary Navigation', 'Maxshop'),
				'top_nav'=>__('Top Navigation', 'Maxshop'),
			)
		);
	}
}

/************************************************************/


/****************** WOOCommerce HOOKS ***********************/

add_theme_support( 'woocommerce' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
// Display 24 products per page. 

//add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 8;' ), 20 );
// Disable WooCommerce styles 
define('WOOCOMMERCE_USE_CSS', false);

remove_action( 'woocommerce_after_main_content', 'woocommerce_catalog_ordering', 10 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_title', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

function maxshop_woocommerce_catalog_page_ordering() {
?>

	<form action="" method="POST" name="results">
		<label>Show</label>
		<select name="woocommerce-sort-by-columns" id="woocommerce-sort-by-columns" class="sortby" onchange="this.form.submit()">
		<?php

		//  This is where you can change the amounts per page that the user will use  feel free to change the numbers and text as you want, in my case we had 4 products per row so I chose to have multiples of four for the user to select.
			$shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
			    ''       => __('Results per page', 'Maxshop'),
				'2' 	=> __('2 per page', 'Maxshop'),
				'4' 	=> __('4 per page', 'Maxshop'),
				'12' 	=> __('12 per page', 'Maxshop'),
				'24' 	=> __('24 per page', 'Maxshop'),
				'36' 	=> __('36 per page', 'Maxshop'),
				'48' 	=> __('48 per page', 'Maxshop'),
				'64' 	=> __('64 per page', 'Maxshop'),
			));

			foreach ( $shopCatalog_orderby as $sort_id => $sort_name )
				echo '<option value="' . $sort_id . '" ' . selected($_SESSION['shop_pageResults'], $sort_id, false ) . ' >' . $sort_name . '</option>';
		?>
		</select>
	</form>
</div>
<?php

} 

// now we set our cookie if we need to
function maxshop_sort_by_page($count) {
  $count = 2;
  if (isset($_SESSION['shop_pageResults'])) { // if normal page load with cookie
     $count = $_SESSION['shop_pageResults'];
  }
  if (isset($_POST['woocommerce-sort-by-columns'])) { //if form submitted
    //setcookie('shop_pageResults', $_POST['woocommerce-sort-by-columns'], time()+1209600, '/',  get_site_url(), false);
    $count = $_POST['woocommerce-sort-by-columns'];
	$_SESSION['shop_pageResults'] = $count;
  }
  // else normal page load and no cookie
  return $count;
}

add_filter('loop_shop_per_page','maxshop_sort_by_page');
add_action( 'woocommerce_before_shop_loop', 'maxshop_woocommerce_catalog_page_ordering', 20 );

/************************************************************/
?>