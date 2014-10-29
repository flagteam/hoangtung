<?php
define ( 'JS_PATH' , get_template_directory_uri().'/library/functions/shortcodes/shortcode.js');


add_action('admin_head','html_quicktags');
function html_quicktags() {

	$output = "<script type='text/javascript'>\n
	/* <![CDATA[ */ \n";
	wp_print_scripts( 'quicktags' );

	$buttons = array();
	
	/*$buttons[] = array(
		'name' => 'raw',
		'options' => array(
			'display_name' => 'raw',
			'open_tag' => '\n[raw]',
			'close_tag' => '[/raw]\n',
			'key' => ''
	));*/
	
	$buttons[] = array(
		'name' => 'one_whole',
		'options' => array(
			'display_name' => 'Full width',
			'open_tag' => '\n[one_whole]',
			'close_tag' => '[/one_whole]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'one_third',
		'options' => array(
			'display_name' => 'one third',
			'open_tag' => '\n[one_third]',
			'close_tag' => '[/one_third]\n',
			'key' => ''
	));
		
	$buttons[] = array(
		'name' => 'two_third',
		'options' => array(
			'display_name' => 'two third',
			'open_tag' => '\n[two_third]',
			'close_tag' => '[/two_third]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_half',
		'options' => array(
			'display_name' => 'one half',
			'open_tag' => '\n[one_half]',
			'close_tag' => '[/one_half]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'one_fourth',
		'options' => array(
			'display_name' => 'one fourth',
			'open_tag' => '\n[one_fourth]',
			'close_tag' => '[/one_fourth]\n',
			'key' => ''
	));	
	
	$buttons[] = array(
		'name' => 'three_fourth',
		'options' => array(
			'display_name' => 'three fourth',
			'open_tag' => '\n[three_fourth]',
			'close_tag' => '[/three_fourth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'one_sixth',
		'options' => array(
			'display_name' => 'one sixth',
			'open_tag' => '\n[one_sixth]',
			'close_tag' => '[/one_sixth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'five_twelveth',
		'options' => array(
			'display_name' => 'five twelveth',
			'open_tag' => '\n[five_twelveth]',
			'close_tag' => '[/five_twelveth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'seven_twelveth',
		'options' => array(
			'display_name' => 'seven twelveth',
			'open_tag' => '\n[seven_twelveth]',
			'close_tag' => '[/seven_twelveth]\n',
			'key' => ''
	));
        
        $buttons[] = array(
		'name' => 'one_twelveth',
		'options' => array(
			'display_name' => 'one twelveth',
			'open_tag' => '\n[one_twelveth]',
			'close_tag' => '[/one_twelveth]\n',
			'key' => ''
	));
        
        $buttons[] = array(
		'name' => 'eleven_twelveth',
		'options' => array(
			'display_name' => 'eleven twelveth',
			'open_tag' => '\n[eleven_twelveth]',
			'close_tag' => '[/eleven_twelveth]\n',
			'key' => ''
	));
        
        $buttons[] = array(
		'name' => 'five_sixth',
		'options' => array(
			'display_name' => 'five sixth',
			'open_tag' => '\n[five_sixth]',
			'close_tag' => '[/five_sixth]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'row',
		'options' => array(
			'display_name' => 'Insert Row',
			'open_tag' => '\n[row]',
			'close_tag' => '[/row]\n',
			'key' => ''
	));
	
	$buttons[] = array(
		'name' => 'clear',
		'options' => array(
			'display_name' => 'Clear Float',
			'open_tag' => '[clear /]',
			'close_tag' => '',
			'key' => ''
	));
			
	for ($i=0; $i <= (count($buttons)-1); $i++) {
		$output .= "edButtons[edButtons.length] = new edButton('ed_{$buttons[$i]['name']}'
			,'{$buttons[$i]['options']['display_name']}'
			,'{$buttons[$i]['options']['open_tag']}'
			,'{$buttons[$i]['options']['close_tag']}'
			,'{$buttons[$i]['options']['key']}'
		); \n";
	}
	
	$output .= "\n /* ]]> */ \n
	</script>";
	echo $output;
}

function maxshop_addbuttons() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_alc_custom_tinymce_plugin");
		add_filter('mce_buttons_3', 'register_alc_custom_button');
	}
}
function register_alc_custom_button($buttons) {
	array_push(
		$buttons,
		"AddPanel",
		"Progress",
		"AddButton",
		"Dropdown",
		"Tabs",
		"Toggle",
		"Accordion",
		"Testimonial",
		"Alert",
		"Audio",
		"Video",
		"Shvideo",
		"Slider",
		"Oslider",
		"Carousel",
		"Contact",
		"Fblock",
		"Tblock",
		"Reveal",
		"Tooltip",
		"SocialButton"
		); 
	return $buttons;
} 
function add_alc_custom_tinymce_plugin($plugin_array) {
	$plugin_array['MaxshopShortcodes'] = JS_PATH;
	return $plugin_array;
}
add_action('init', 'maxshop_addbuttons');




/********************* PANEL **********************/

function alc_panel( $atts, $content = null ) {
 extract(shortcode_atts(array(
		"title" => '',
		"type" => '3' 
	), $atts));	
	$out = '';
	$finaltitle = ($title == '') ? '': '<h5>'.$title.'</h5>';
	if ($type == 'regular' || $type=='callout')
	{
		$out = '<div class="panel '.$type.'">'.$finaltitle.do_shortcode($content). '</div>';
	}
	else
	{
		$out = '<div class="widgets  clearfix"><h3>'.$title.'</h3>' .do_shortcode($content).'</div>';
	}
    return $out;
}
add_shortcode('panel', 'alc_panel');

/**************************************************/


/***************** PROGRESS BAR *******************/

function alc_progressbar( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"type" => '',
		"meter" => '',
		"style" => '',
		"animated" => '',
		"class" => '',
	), $atts));	
	$out = '
	<div class="progress '.$type.' '.$style.' '.$animated.' '.$class.'">
		<div class="bar" style="width:'.$meter.'%"></div>
	</div>';
    return $out;
}
add_shortcode('progressbar', 'alc_progressbar');

/************************************************/

/*************** Dropdown buttons ***************/

function alc_dropbutton_group( $atts, $content ){
	extract(shortcode_atts(array(
		'title' => '',
		'type'	=> ''
	), $atts));
	$GLOBALS['dropbutton_count'] = 0;
	$randomId = mt_rand(0, 100000);
	
	do_shortcode( $content );
	$counter = 1;
	if( is_array( $GLOBALS['dropbuttons'] ) ){
		foreach( $GLOBALS['dropbuttons'] as $dropbutton ){
			$dropbuttons[] = '<li><a href="'.$dropbutton['url'].'">'.do_shortcode($dropbutton['content']).'</a></li>';
			if ($dropbutton['divider'] == 1)
			{
				$dropbuttons[] = '<li class="divider"></li>';
			}
		}
		$return='<div class="btn-group">';
		if ($type == 'split')
		{
			$return.='<button class="btn '.$type.'" >'.$title.' '.'</button><button class="btn dropdown-togle" data-toggle="dropdown"><span class="caret"><span></button>';
		}
		else
		{	
			$return.= '<a class="btn '.$type.' dropdown-toggle" data-toggle="dropdown">'.$title.' '.'<span class="caret"><span></a>';
		}
		$return.= '<ul class="dropdown-menu" id="'.$randomId.'" style="top: 38px;">'.implode( "\n", $dropbuttons ).'</ul>';
                $return.='</div>';
	}
	return $return;
}
add_shortcode( 'dropbuttongroup', 'alc_dropbutton_group' );
/*****************/


function alc_dropbutton( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => '',
	'url' => '',
	'divider' => '',
	), $atts));
	
	$x = $GLOBALS['dropbutton_count'];
	$GLOBALS['dropbuttons'][$x] = array( 'title' => $title, 'url' => $url, 'divider' => $divider, 'content' =>  $content );
	
	$GLOBALS['dropbutton_count']++;
}

add_shortcode( 'dropbutton', 'alc_dropbutton' );
/************************************************/

/******************* BUTTONS ********************/

function alc_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'size' => 'medium',
		'link' => '#',

		'color' => '',

        'status'=>'',

		'target' => '',
        'icon'=>''
	), $atts));

	$target = ($target) ? ' target="_blank"' : '';
 
	$out = '<a href="'.$link.'"'.$target.' class="btn  '.$size.' '.$color.' '.$status.'"><span class="'.$icon.'"></span>'.do_shortcode($content).'</a>';
    return $out;
}
add_shortcode('button', 'alc_button');

/************************************************/

/******************TABS****************************/
function alc_tab_group( $atts, $content ){
	
	$GLOBALS['tab_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['tabs'] ) ){
		$count = 1;
		foreach( $GLOBALS['tabs'] as $tab ){
			$randomId = mt_rand(0, 100000);
			$active = $count == 1 ? ' active' : 'fade';
			$active2 = $count == 1 ? 'class="active"' : '';
			$tabs[] = '<li '.$active2.'><a href="#'.$randomId.'" data-toggle="tab">'.$tab['title'].'</a></li>';
			$cont[]='<div class="tab-pane '.$active.'" id="'.$randomId.'">'.do_shortcode($tab['content']).'</div>';
			$count ++;
		}
                
		$return = '<ul  class="nav nav-tabs">'.implode( "\n", $tabs ).'</ul><div class="tab-content">'.implode("\n", $cont).'</div>';

	}
	return $return;
}
add_shortcode( 'tabgroup', 'alc_tab_group' );

/***********/

function alc_tab( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'Tab %d',
	), $atts));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
	
	$GLOBALS['tab_count']++;
}
add_shortcode( 'tab', 'alc_tab' );


/************************************************/


/****************** TOGGLES *********************/

function alc_toggle_group( $atts, $content ){
	
	$GLOBALS['toggle_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['toggles'] ) ){
		foreach( $GLOBALS['toggles'] as $toggle ){
			$toggles[] = '
			<div class="toggle-wrapper">
				<a href="#" class="toggle-trigger">'.$toggle['title'].'</a>                  
				<div class="toggle-container">
					'.do_shortcode($toggle['content']).'
				</div>                  
			</div>';	
		}
		$return = implode( "\n", $toggles );
	}
	return $return;

}
add_shortcode( 'togglegroup', 'alc_toggle_group' );


function alc_toggle( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'toggle %d',
	), $atts));
	
	$x = $GLOBALS['toggle_count'];
	$GLOBALS['toggles'][$x] = array( 'title' => sprintf( $title, $GLOBALS['toggle_count'] ), 'content' =>  $content );
	
	$GLOBALS['toggle_count']++;
}
add_shortcode( 'toggle', 'alc_toggle' );
/************************************************/



/***************** ACCORDION ********************/


function alc_accordion_group( $atts, $content ){
	
	$GLOBALS['accordion_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['accordions'] ) ){
		foreach( $GLOBALS['accordions'] as $accordion ){
                        $randomId = mt_rand(0, 100000);
			$accordions[] = ' 
				<h5><a href="#" >'.$accordion['title'].'</a></h5>                  
				<div >
					'.do_shortcode($accordion['content']).'
				</div>
                                
			';	
		}
		$return = '<div id="accordion" >'.implode( "\n", $accordions ).'</div>';
	}
	return $return;
}

add_shortcode( 'accordiongroup', 'alc_accordion_group' );
/***************/

function alc_accordion( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'accordion %d',
	), $atts));
	
	$x = $GLOBALS['accordion_count'];
	$GLOBALS['accordions'][$x] = array( 'title' => sprintf( $title, $GLOBALS['accordion_count'] ), 'content' =>  $content );
	
	$GLOBALS['accordion_count']++;
}

add_shortcode( 'accordion', 'alc_accordion' );
/************************************************/


/*************** TESTIMONIALS ********************/
function alc_testimonial( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"authorname"	=> '', 
		"authorposition"	=> ''
	), $atts));

	$out = '<div class="testimonial-block"><div class="testimonial-content"><p>'.do_shortcode($content).'</p></div><cite>'.$authorname.'</cite><p class="test_author">'.$authorposition.'</p></div>';
    return $out;
}
add_shortcode('testimonial', 'alc_testimonial');

/************************************************/

/******************* Alertbox *******************/

function alc_alert( $atts, $content = null ) {
     extract(shortcode_atts(array(
		"type"=>'',
		"title" => ''
	), $atts));	
	$out = '
	<div class="alert '.$type.'">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4 class="alert-heading">'.$title.'</h4>
		'.do_shortcode($content).'
	</div>';
   return $out;
}
add_shortcode('alert', 'alc_alert');

/************************************************/


/***********  VIDEOS  ****************/

function alc_video($atts, $content=null) {
	extract(
		shortcode_atts(array(
			'site' => 'youtube',
			'id' => '',
			'width' => '',
			'height' => '',
			'autoplay' => '0'
		), $atts)
	);
	if ( $site == "youtube" ) { $src = 'http://www.youtube.com/embed/'.$id.'?autoplay='.$autoplay; }
	else if ( $site == "vimeo" ) { $src = 'http://player.vimeo.com/video/'.$id.'?autoplay='.$autoplay; }
	else if ( $site == "dailymotion" ) { $src = 'http://www.dailymotion.com/embed/video/'.$id.'?autoplay='.$autoplay; }
	else if ( $site == "veoh" ) { $src = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay='.$autoplay.'&permalinkId='.$id; }
	else if ( $site == "bliptv" ) { $src = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$id; }
	else if ( $site == "viddler" ) { $src = 'http://www.viddler.com/embed/'.$id.'e/?f=1&offset=0&autoplay='.$autoplay; }
	
	if ( $id != '' ) {
		return '<div class="flex-video"><iframe width="'.$width.'" height="'.$height.'" src="'.$src.'" class="vid iframe-'.$site.'"></iframe></div>';
	}
}
add_shortcode('video','alc_video');

/************************************************/


/************ LOCAL AUDIO (HTML 5) **************/

function alc_audio($atts, $content = null) {
    extract(shortcode_atts(array(
            "title" => '',
			"poster" => '',
			"m4a"  => '',
			"mp3"  => '',
			"ogg"	=> ''			
    ), $atts));
 	
	$poster = ($poster == '') ? get_template_directory_uri().'/images/music.jpg' : $poster;
	$randomId = mt_rand(0, 100000);  
	$return = '	<script type="text/javascript">jQuery(document).ready(function($){
		$("#jquery_jplayer_'.$randomId.'").jPlayer({
			ready: function () {
				$(this).jPlayer("setMedia", {
					m4a: "'.$m4a.'",
					mp3: "'. $mp3 .'",
					oga: "'.$ogg.'",
					poster: "'.$poster.'"
				});
			},
			play: function() { // To avoid both jPlayers playing together.
				$(this).jPlayer("pauseOthers");
			},
			repeat: function(event) { // Override the default jPlayer repeat event handler
				if(event.jPlayer.options.loop) {
					$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
					$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function() {
						$(this).jPlayer("play");
					});
				} else {
					$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
					$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerNext", function() {
						$("#jquery_jplayer_'.$randomId.'").jPlayer("play", 0);
					});
				}
			},
			swfPath: "'.get_template_directory_uri().'/js/jplayer",
			supplied: "m4a, oga",
			wmode: "window",
			size: {width: "100%",height: "auto",cssClass: "jp-audio-standard"},
			cssSelectorAncestor: "#jp_container_'.$randomId.'"
		});
			});
		</script>';
		
		$return.= '	
		<div class="singlesong span6">     
			<div id="jquery_jplayer_'.$randomId.'" class="jp-jplayer"></div>           
			<div id="jp_container_'.$randomId.'" class="jp-audio">
				<div class="jp-type-single">
					<div class="jp-gui jp-interface">
						<ul class="jp-controls">
							<li><a href="javascript:;" class="jp-play" tabindex="1">play></a></li>
							<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
							<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
							<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
							<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
							<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
						</ul>
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
						<div class="jp-time-holder">
							<div class="jp-current-time"></div>
							<div class="jp-duration"></div>
	
							<ul class="jp-toggles">
								<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
								<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
							</ul>
						</div>
					</div>
					<div class="jp-title">
						<ul>
							<li>'.$title.'</li>
						</ul>
					</div>
					<div class="jp-no-solution">
						<span>Update Required</span>
						To play the media you will need to either update your browser to a recent version or update your Flash plugin.
					</div>
				</div>
			</div>
		</div>';
	return $return;
	
}
add_shortcode("audio", "alc_audio"); 

/************************************************/

/************ LOCAL VIDEO (HTML 5) **************/

function alc_sh_video($atts, $content = null) {
    extract(shortcode_atts(array(
            "title" => '',
			"poster" => '',
			"m4v"  => '',
			"mp4"  => '',
			"ogv"	=> ''			
    ), $atts));
 	
	$poster = ($poster == '') ? get_template_directory_uri().'/images/video.jpg' : $poster;
	$randomId = mt_rand(0, 100000);  
	$return = '<script type="text/javascript">jQuery(document).ready(function($){
			$("#jquery_jplayer_'.$randomId.'").jPlayer({
				option: {"fullscreen": true},
				ready: function () {
					$(this).jPlayer("setMedia", {
						m4v: "'.$m4v.'",
						mp4: "'.$mp4.'",
						ogv: "'.$ogv.'",
						poster: "'.$poster.'"
					});
				},
				play: function() { // To avoid both jPlayers playing together.
					$(this).jPlayer("pauseOthers");
				},
				repeat: function(event) { // Override the default jPlayer repeat event handler
					if(event.jPlayer.options.loop) {
						$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
						$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function() {
							$(this).jPlayer("play");
						});
					} else {
						$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
						$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerNext", function() {
							$("#jquery_jplayer_'.$randomId.'").jPlayer("play", 0);
						});
					}
				},
				swfPath: "'.get_template_directory_uri().'/js/jplayer",
				supplied: "ogv, m4v",
				size: {width: "100%",height: "auto",cssClass: "jp-video-standard"},
				cssSelectorAncestor: "#jp_container_'.$randomId.'"
			});
		});
	</script>';
	
	$return.= '	
	<div class="singlesong featured-image">
		<div id="jp_container_'.$randomId.'" class="jp-video jp-video-standard filterable-2col-videowrap">
			<div class="jp-type-single">
				<div id="jquery_jplayer_'.$randomId.'" class="jp-jplayer"></div>
				<div class="jp-gui">
					<div class="jp-video-play">
						<a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
					</div>
					<div class="jp-interface">
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
						<div class="jp-current-time"></div>
						<div class="jp-duration"></div>
						<div class="jp-controls-holder">
							<ul class="jp-controls">
								<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
								<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
								<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
								<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
								<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
								<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
							</ul>
							<div class="jp-volume-bar">
								<div class="jp-volume-bar-value"></div>
							</div>
							<ul class="jp-toggles">
								<li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>
								<li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>
								<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
								<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
							</ul>
						</div>
						<div class="jp-title">
							<ul>
								<li>'.$title.'</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your Flash plugin.
				</div>
			</div>
		</div>
	</div>';
	return $return;	
}
add_shortcode("shvideo", "alc_sh_video"); 

/************************************************/


/****************** SLIDER ********************/


function alc_slider( $atts, $content ){
	$GLOBALS['slideritem_count'] = 0;
	extract(shortcode_atts(array(
		'interval' => '500'
	), $atts));
	do_shortcode( $content );
		
	if( is_array( $GLOBALS['sitems'] ) ){
		$icount = 0;
		foreach( $GLOBALS['sitems'] as $item ){
			$itemlink = empty ($item['link']) ? '#' : $item['link'];
			$panes[] = '
			<div class="slides">
				<a href="'.$itemlink.'"><img src="'.$item['image'].'" alt="" /></a>
				<div class="overlay">'.do_shortcode($item['content']).'</div>
			</div>';   		
			$icount ++ ;
		}
		$randomId = mt_rand(0, 100000);
		$return ='
		<div class="slider">
			<div class="slider-slides">'.implode( "\n", $panes ).'</div>
			<a href="#" class="next"></a>
			<a href="#" class="prev"></a>
			<div class="slider-btn"></div>
		</div>';
			
	}
	return $return;
}
add_shortcode('slider', 'alc_slider' );

/****/



function alc_slideritem( $atts, $content ){
	extract(shortcode_atts(array(
		'image' => '',
		'link' => '',
	), $atts));
	
	$x = $GLOBALS['slideritem_count'];
	$GLOBALS['sitems'][$x] = array( 'image' => $image, 'link' => $link, 'content' =>  $content );
	
	$GLOBALS['slideritem_count']++;
	
}
add_shortcode( 'slideritem', 'alc_slideritem' );

/************************************************/

/****************Orbit Slider********************
function alc_oslider( $atts, $content ){
	$GLOBALS['oslideritem_count'] = 0;
	extract(shortcode_atts(array(
		'interval' => '500'
	), $atts));
	do_shortcode( $content );
		
	if( is_array( $GLOBALS['ositems'] ) ){
		$icount = 0;
		foreach( $GLOBALS['ositems'] as $item ){
			$panes[] = '<li><img src="'.$item['image'].'" alt="'.$item['title'].'" title="'.$item['title'].'" />
                                    <div class="orbit-caption">'.do_shortcode($item['title']).'</div></li>';   		
			$icount ++ ;
		}
		
		$return ='<div class="orbit-container orbit-stack-on-small"><ul class="orbit-slides-conainer" data-orbit="">'.implode( "\n", $panes ).'</ul></div>
                    <script type=text/javascript>
                        jQuery(document).foundation("orbit", {
                        container_class: "orbit-container",
                         next_class: "orbit-next",
                          next_class: "orbit-next",
                          timer_speed: '.$interval.',
                        })
                    </script>';	
	}
	return $return;
}
add_shortcode('oslider', 'alc_oslider' );

/****

function alc_oslideritem( $atts, $content ){
	extract(shortcode_atts(array(
		'image' => '',
		'title' => '',
	), $atts));
	
	$x = $GLOBALS['oslideritem_count'];
	$GLOBALS['ositems'][$x] = array( 'image' => $image, 'title' => $title, 'content' =>  $content );
	
	$GLOBALS['oslideritem_count']++;
	
}
add_shortcode( 'oslideritem', 'alc_oslideritem' );


/************************************************/


/*************** Carousel Slider ****************/

function alc_carousel( $atts, $content ){
	$GLOBALS['caritem_count'] = 0;
	extract(shortcode_atts(array(
		'title' => '',
		'type' => 'custom',
		'automatic' => 'false',
		'min' => '1',
		'max' => '6'
	), $atts));
	$randomId = mt_rand(0, 100000);
	$panes = array();	
	$return = '';
	do_shortcode ($content);
	if(isset( $GLOBALS['caritems']) && is_array( $GLOBALS['caritems'] ) ){
		$return.='
		<div class="clients-wrap">
			<div class="container">
				<div class="row-fluid heading-wrap">
					<div class="span12 heading">					
						<h2>'.$title.'<span></span></h2>
					</div>
				</div>
				<div class="work_slide">
					<a class="next" id="slide_next'.$randomId.'" href="#"></a>
					<a class="prev" id="slide_prev'.$randomId.'" href="#"></a>
					<div class="clearfix"></div>
				
					<ul class="work_slide'.$randomId.'" id="'.$type.'">';
						foreach( $GLOBALS['caritems'] as $item ){
							$panes[] = '<li>'.$item['content'].'</li>';   		
						}		
						$return.=implode( "\n", $panes ).'
					</ul>
				 </div>
			</div>
		</div>';
		$return.="
		<script type=\"text/javascript\">
			jQuery(window).load(function(){
				jQuery('.work_slide".$randomId."').carouFredSel({
					responsive: true,
					width: '100%',
					auto: {play: ".$automatic."},
					circular	: false,
					infinite	: true,
					prev : {button: \"#slide_prev".$randomId."\", key	: \"left\"},
					next : {button	: \"#slide_next".$randomId."\", key : \"right\"},
					swipe: {onMouse: true, onTouch: true},
					items: {visible: {min: ".$min.",max: ".$max."}
					}
				});
			});
		</script>";
	}
	return $return;
}

add_shortcode('carousel', 'alc_carousel' );
/***/

function alc_caritem( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => '',
	), $atts));
	$x = $GLOBALS['caritem_count'];
	$GLOBALS['caritems'][$x] = array('title' => $title, 'content' =>  do_shortcode ($content) );
	$GLOBALS['caritem_count']++;	
}
add_shortcode( 'caritem', 'alc_caritem' );

/************************************************/


/*************** Contact details ****************/

function alc_contact( $atts, $content = null ) {
     extract(shortcode_atts(array(
		"address" => '',
		"tel" => '',
		"email" => '',
		"skype" => ''
	), $atts));	
	$out = '<p>'.do_shortcode($content).'</p>
	<ul >';
		if ($address) $out.='<li class="address">'.$address.'</li>';
		if ($tel) $out.='<li class="tel">'.$tel.'</li>';
		if ($email) $out.='<li class="email"><a href="mailto:'.$email.'">'.$email.'</a></li>';
		if ($skype) $out.='<li class="skype">'.$skype.'</li>';
	$out.='</ul>';
   return $out;
}
add_shortcode('contact', 'alc_contact');

/************************************************/


/**************************FEATURED BLOCK****************/
function alc_fblock($atts, $content=NULL){
    extract(shortcode_atts(array(
		'icon'=>'', 
                'link'=>''
    ), $atts));
    
   
    $out='<div class="offers"><figure>';
    $out.='<a href="'.$link.'"><img src="'.$icon.'" alt="" /></a>';
    $out.='<div class="overlay">'.do_shortcode($content).'</div>';
    $out.='</figure></div>';
    return $out;
}
add_shortcode('fblock', 'alc_fblock');


/*********************************************************/

/***************TITLE BLOCK***************************/
function alc_tblock($atts, $content=NULL){
    extract(shortcode_atts(array(
        'title'=>'',

    ), $atts));
    
    $out='<div class="heading"><h2>'.$title.'<span></span></h2></div>';
    
    return $out;
}

add_shortcode('tblock', 'alc_tblock');

/******************************************************/

/****************************REVEAL Modal BOX****************/

function alc_reveal($atts, $content=NULL){
    extract(shortcode_atts(array(
        'size'=>'',
        'color'=>'',
        'button'=>'',

        'revtitle'=>'',
    ), $atts));
    $randomId=  mt_rand(0, 100000);
    
    $out='<a data-toggle="modal" href="#'.$randomId.'" class="btn '.$color.' '.$size.'">'.$button.'</a>';
    $out.='<div id="'.$randomId.'" class="modal fade">
            <div class="modal-header">'.$revtitle.'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            <div class="modal-body">'.do_shortcode($content).'</div>
	</div>';
return $out;
}

add_shortcode('reveal', 'alc_reveal');

/*****************************************************/

/*********************TOOLTIP*********************/

function alc_tooltip($atts, $content=NULL){
    extract(shortcode_atts(array(
        'text'=>'',
        
    ),$atts));

    $out = '<span class="tooltip" title="'.do_shortcode($content).'">'.do_shortcode($text).'</button>';

    return $out;
}

add_shortcode('tooltip', 'alc_tooltip');
/************************************************/

/****** SHOW POSTS BY CATEGORY AND COUNT ********

function alc_list_posts( $atts )
{
	extract( shortcode_atts( array(
		'category' => '',
        'type' => '',
		'limit' => '5',
		'order' => 'DESC',
		'orderby' => 'date',
	), $atts) );

	$return = '';

	$query = array();

	if ( $category != '' )
		$query[] = 'category=' . $category;

	if ( $limit )
		$query[] = 'numberposts=' . $limit;

	if ( $order )
		$query[] = 'order=' . $order;

	if ( $orderby )
		$query[] = 'orderby=' . $orderby;

	$posts_to_show = get_posts( implode( '&', $query ) );
        
    if ($type == 1)
	{
		$counter = 1;
		$return.='
		<h3>'.$title.'</h3>
		<div class="work_slide2">
			<ul id="work_slide2">';
				foreach ($posts_to_show as $ps) 
				{
					$day = get_the_time('d', $ps->ID);
					$month = get_the_time('M', $ps->ID);
					if ($counter ==1) $return.='<li>';
						$return.='
						<article class="row collapse"><div class="small-5 columns"><div class="mod_con_img">';
							$thumbnail = get_the_post_thumbnail($ps->ID, 'blog-thumb3'); $postmeta = get_post_custom($ps->ID); 
						if(!empty($thumbnail) && !isset($postmeta['_post_video'])):
							$return.='<a href="'.get_permalink( $ps->ID ).'" class="post-image">'.$thumbnail.'</a>';
							elseif (isset($postmeta['_post_video'])):
							$return.='<iframe src="http://player.vimeo.com/video/'.$postmeta['_post_video'][0].'" width="146" height="96" class="post-image"></iframe>';
						else: 
							$return.='
							<a href="'.get_permalink( $ps->ID ).'" class="post-image">
								<img src = "http://placehold.it/155x112" alt="'.__('No image', 'Maxshop').'" />
							</a>';
						endif;
					$return.='<ul class="meta">
								<li>
									<span class="icon-time"></span>
									<time datetime="'.get_the_time('Y-m-d').'">'.get_the_time('M d, Y').'</time>
								</li>
							  </ul>
							</div>
						 </div>';
					$return.='<div class="small-7 columns">
								<div class="mod_con_text">
									<h5>'.$ps->post_title.'</h5>
								<p>'.limit_words(getPageContent($ps->ID), 15).'</p>
								<a href="'.get_permalink( $ps->ID ).'">'.__('Read More', 'Maxshop').'</a>
							  </div>
						 </div>
					</article>';
					
				}
			$return.='</li> </ul>
                        <div class="clearfix"></div>
                        <a class="prev2" id="slide_prev2" href="#"><img src="'. get_template_directory_uri().'/images/arrow_left.png" alt="'.__('Prev', 'Maxshop').'"></a>
                        <a class="next2" id="slide_next2" href="#"><img src="'. get_template_directory_uri().'/images/arrow_right.png" alt="'.__('Next', 'Maxshop').'"></a>                            
                       </div></div></div>';
                        $return.="<script type=\"text/javascript\">
			jQuery(window).load(function(){
				jQuery('#work_slide2').carouFredSel({
					responsive: true,
					width: '100%',
					auto: false,
					circular	: true,
					infinite	: true,
                                        scroll: {items:1, pauseOnHover: true},
					prev : {button: \"#slide_prev2\", key	: \"left\"},
					next : {button	: \"#slide_next2\", key : \"right\"},
					swipe: {onMouse: true, onTouch: true},
					items: {visible: {min: 1,max: 6}
					}
				});
			});
		</script>";
	}
	else
	{
		$return = '<ul class="no-bullet recent-posts m0 p0">';		
		foreach ($posts_to_show as $ps) 
		{
			$day = get_the_time('d', $ps->ID);
			$month = get_the_time('M', $ps->ID);
			$return.='
			<li>
				<article class="row collapse">
					<div class="small-5 columns">
						<div class="mod_con_img">';
							$thumbnail = get_the_post_thumbnail($ps->ID, 'blog-thumb3'); $postmeta = get_post_custom($ps->ID); 
							if(!empty($thumbnail) && !isset($postmeta['_post_video'])):
								$return.='<a href="'.get_permalink( $ps->ID ).'" class="post-image">'.$thumbnail.'</a>';
							elseif (isset($postmeta['_post_video'])):
								$return.='<iframe src="http://player.vimeo.com/video/'.$postmeta['_post_video'][0].'" width="146" height="96" class="post-image"></iframe>';
							else: 
								$return.='<a href="'.get_permalink( $ps->ID ).'" class="post-image">
									<img src = "http://placehold.it/155x112" alt="'.__('No image', 'Maxshop').'" />
								</a>';
							endif;
							$return.='
							<ul class="meta">
								<li>
									<span class="icon-time"></span>
									<time datetime="'.get_the_time('Y-m-d', $ps->ID).'">'.get_the_time('M d, Y', $ps->ID).'</time>
								</li>
							</ul>
						</div>
					</div>';
					$return.='
					<div class="small-7 columns">
						<div class="mod_con_text">
							<h5>'.$ps->post_title.'</h5>
							<p>'.limit_words(getPageContent($ps->ID), 15).'</p>
							<a href="'.get_permalink( $ps->ID ).'">'.__('Read More', 'Maxshop').'</a>
						</div>
					</div>
				</article>
			</li>';
		}
		$return.='</ul>';                
	}
	
	return $return;
}

add_shortcode('list_posts', 'alc_list_posts');

/************************************************/

/*************** SOCIAL BUTTONS *****************/
function alc_social($atts, $content=NULL){
    $GLOBALS['soc_button_count']=0;
    if(is_array($GLOBALS['soc_buttons'])){
        foreach ($GLOBALS['soc_buttons'] as $soc){
            $soc_buttons[]='<a href="'.$soc['link'].'" class="'.$soc['icon'].'" target="_blank"><i ></i></a>';
        }
        $out='<div class="social-icon">'.implode("\n", $soc_buttons).'</div>';
    }
    return $out;
}

add_shortcode('social', 'alc_social');

/*********************/
function alc_soc_button($atts, $content=NULL){
    extract(shortcode_atts(array(
        'icon'=>'',
        'link'=>''
    ), $atts));
    
    $x= $GLOBALS['soc_button_count'];
    $GLOBALS['soc_buttons'][$x]=array('icon'=> $icon, 'link'=>$link);
    $GLOBALS['soc_button_count']++;

} 

add_shortcode('soc_button', 'alc_soc_button');
/**************************************************/


/******************* COLUMNS ********************/

function maxshop_one_whole( $atts, $content = null ) {
   return '<div class="span12">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_whole', 'maxshop_one_whole');

function maxshop_one_half( $atts, $content = null ) {
   return '<div class="span6">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'maxshop_one_half');

function maxshop_one_third( $atts, $content = null ) {
   return '<div class="span4">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'maxshop_one_third');

function maxshop_two_third( $atts, $content = null ) {
   return '<div class="span8">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'maxshop_two_third');

function maxshop_one_fourth( $atts, $content = null ) {
   return '<div class="span3">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'maxshop_one_fourth');

function maxshop_three_fourth( $atts, $content = null ) {
   return '<div class="span9">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'maxshop_three_fourth');

function maxshop_one_sixth( $atts, $content = null ) {
   return '<div class="span2">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'maxshop_one_sixth');

function maxshop_five_twelveth( $atts, $content = null ) {
   return '<div class="span5">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_twelveth', 'maxshop_five_twelveth');

function maxshop_seven_twelveth( $atts, $content = null ) {
   return '<div class="span7">' . do_shortcode($content) . '</div>';
}
add_shortcode('seven_twelveth', 'maxshop_seven_twelveth');


function maxshop_one_twelveth( $atts, $content = null ) {
   return '<div class="span1">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_twelveth', 'maxshop_one_twelveth');

function maxshop_eleven_twelveth( $atts, $content = null ) {
   return '<div class="span11">' . do_shortcode($content) . '</div>';
}
add_shortcode('eleven_twelveth', 'maxshop_eleven_twelveth');

function maxshop_five_sixth( $atts, $content = null ) {
   return '<div class="span10">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'maxshop_five_sixth');

function maxshop_row( $atts, $content = null ) {
   return '<div class="row-fluid">' . do_shortcode($content) . '</div>';
}
add_shortcode('row', 'maxshop_row');


/************************************************/



/***************** CLEAR ************************/

function alc_clear($atts, $content = null) {	
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'alc_clear');


/******** SHORTCODE SUPPORT FOR WIDGETS *********/

if (function_exists ('shortcode_unautop')) {
	add_filter ('widget_text', 'shortcode_unautop');
}
add_filter ('widget_text', 'do_shortcode');

/************************************************/
?>