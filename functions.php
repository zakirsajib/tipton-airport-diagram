<?php
/**
 * tipton functions and definitions
 *
 * @package tipton
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */


function tipton_backgrounds () {
	global $post;
	$topbg = get_field('top_background_image');
	$bottombg = get_field('bottom_background_image');
	$expand = get_field('expandable_background');
	$bottom_padding = get_field('bottom_padding');
	$out = $outM = '';
	$total_height = 0;
	$total_mobile_height = 0;
	//echo wp_get_attachment_image( $topbg );
	if ( ! empty($topbg) ) {
		$rat = (320*1.25);
		$newY = round( ( $topbg['height'] / $topbg['width'] ) * $rat );
		$h = $newY+41;
		$out .= '#topbg{
			height:'.$topbg['height'].'px; background:url('.$topbg['url'].') no-repeat center top;
		}
		';
		$outM .= '#topbg{
			height:'.$h.'px; background:url('.$topbg['url'].') no-repeat center 41px;background-size:135%;
		}
		';
		$total_height += $topbg['height'];
		//$m = (320*1.25)
		//$ratio = min( $resize_to / $width, $resize_to/ $height );
		
		$total_mobile_height += $h;
	}
	if ( ! empty($bottombg) ) {
		
		if ( $expand == 'No' ) {
			$pos = 'top';
			$ab = 'top:' . $h .'px;bottom:auto;';
		} else {
			$ab = 'bottom:0;top:auto;';
			$pos = 'bottom';
			
		}
		$newY = round( ( $bottombg['height'] / $bottombg['width'] ) * $rat );
		$out .= '#bottombg{
			height:'.$bottombg['height'].'px; background:url('.$bottombg['url'].') no-repeat center bottom;
		}
		';
		$outM .= '#bottombg{
			height:'.$newY.'px; background:url('.$bottombg['url'].') no-repeat center '.$pos.';'.$ab.'background-size:135%;
		}
		';
		$total_height += $bottombg['height'];
		
		$total_mobile_height += $newY;
	}
	$padding_height += ( $bottombg['height'] - 200 );
	$p = '';
	//$p = ( $padding_height > 0 ) ? 'padding-bottom:'.$padding_height.'px;' : '';
	//$p = 'padding-bottom:200px;';
	if ( $expand != 'Yes' ) {
		$p = 'padding-bottom:0;';
	} else {
		if ( !empty($bottom_padding)  ) {
			$p = 'padding-bottom:'.(200+$bottom_padding).'px;';
		}
	}
	$p .= ( $total_height > 0 ) ? 'min-height:'.$total_height.'px;' : '';
	$out .= '
	#page{
		'.$p.'
	}
	@media screen and (max-width: 340px) {

	'.$outM.'
	#page{
		min-height:'.$total_mobile_height.'px;padding-bottom:60px;
	}
	}
	';
	//wp_add_inline_style( 'tipton-style', $out );
	echo '<style type="text/css">' . $out . '</style>';
}
add_action( 'before', 'tipton_backgrounds',100 );

	
	

	
	
	
if ( ! function_exists( 'tipton_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function tipton_setup() {

	load_theme_textdomain( 'tipton', get_template_directory() . '/languages' );

	//add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'tipton' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'tipton_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	add_editor_style( array( 'editor-style.css', 'http://fonts.googleapis.com/css?family=Roboto:400,400italic,700italic,700|Roboto+Condensed:400italic,700italic,400,700' ) );
}
endif; // tipton_setup
add_action( 'after_setup_theme', 'tipton_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function tipton_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'tipton' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => 'Home Footer',
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'tipton_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function tipton_scripts() {
		
	wp_enqueue_style( 'tipton-style', get_stylesheet_uri() );
	wp_enqueue_style( 'tipton-font-style', '//fonts.googleapis.com/css?family=Roboto:400,400italic,700italic,700|Roboto+Condensed:400italic,700italic,400,700' );
	//wp_enqueue_script( 'tipton-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_style('jquery-ui', '//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css');
	wp_enqueue_script('jquery-ui-js', 'https://code.jquery.com/ui/1.12.0/jquery-ui.js');
	
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css');
	
	wp_enqueue_script( 'panzoom', get_template_directory_uri() . '/js/panzoom/jquery.panzoom.min.js', array(), '20130115', true );
	wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/panzoom/jquery.mousewheel.js', array(), '20130115', true );
	
	wp_enqueue_script( 'tipton-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'tipton-js', get_template_directory_uri() . '/js/tipton.js', array('jquery'), '20130115', true );

	
}
add_action( 'wp_enqueue_scripts', 'tipton_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



class Twenty_Eleven_Sidebarcontent_Widget extends WP_Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function Twenty_Eleven_Sidebarcontent_Widget() {
		$widget_ops = array( 'classname' => 'widget_twentyeleven_sidebarcontent', 'description' => __( 'Use this widget to insert the Sidebar Content from individual Pages', 'twentyeleven' ) );
		$this->WP_Widget( 'widget_twentyeleven_sidebarcontent', 'Sidebar Content', $widget_ops );
		$this->alt_option_name = 'widget_twentyeleven_sidebarcontent';

		add_action( 'save_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache' ) );
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array An array of standard parameters for widgets in this theme
	 * @param array An array of settings for this widget instance
	 * @return void Echoes it's output
	 **/
	function widget( $args, $instance ) {
		$cache = wp_cache_get( 'widget_twentyeleven_sidebarcontent', 'widget' );
global $post;
echo '<aside class="widget sidebarcontent">';
echo apply_filters ( 'the_content' , get_post_meta($post->ID, 'sidebar_content', true) );
//echo get_post_meta($post->ID, 'sidebar_content', true);
echo '</aside>';
		if ( !is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = null;

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract( $args, EXTR_SKIP );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Sidebar Content' : $instance['title'], $instance, $this->id_base);

		if ( ! isset( $instance['number'] ) )
			$instance['number'] = '10';

		if ( ! $number = absint( $instance['number'] ) )
 			$number = 10;



		if ( 0 ) :
			echo $before_widget;
			echo $before_title;
			echo $title; // Can set this with a widget option, or omit altogether
			echo $after_title;
			?>

			<?php

			echo $after_widget;

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'widget_twentyeleven_sidebarcontent', $cache, 'widget' );
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_twentyeleven_sidebarcontent'] ) )
			delete_option( 'widget_twentyeleven_sidebarcontent' );

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete( 'widget_twentyeleven_sidebarcontent', 'widget' );
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 **/
	function form( $instance ) {
		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'twentyeleven' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<?php
	}
}
register_widget( 'Twenty_Eleven_Sidebarcontent_Widget' );



add_shortcode('diagram', 'tipton_diagram', 7);
function tipton_diagram ( $atts ) {
	/*
$output = '<script src="//www.gmodules.com/ig/ifr?url=http://dl.google.com/developers/maps/tourgadget.xml&amp;up_kml_url=http%3A%2F%2Ftiptonairport.org%2FTipton.kml&amp;up_tour_index=1&amp;up_tour_autoplay=1&amp;up_show_navcontrols=0&amp;up_show_buildings=1&amp;up_show_terrain=1&amp;up_show_roads=0&amp;up_show_borders=0&amp;up_sphere=earth&amp;synd=open&amp;w=960&amp;h=640&amp;title=Embedded+Tour+Player&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>
';
*/

	$output = '<script src="//www.gmodules.com/ig/ifr?url=http://dl.google.com/developers/maps/tourgadget.xml&amp;up_kml_url=http%3A%2F%2Ftiptonairport.org%2FNewTipton.kml&amp;up_tour_index=1&amp;up_tour_autoplay=1&amp;up_show_navcontrols=0&amp;up_show_buildings=0&amp;up_show_terrain=1&amp;up_show_roads=0&amp;up_show_borders=0&amp;up_sphere=earth&amp;synd=open&amp;w=960&amp;h=640&amp;title=Embedded+Tour+Player&amp;border=%23ffffff%7C3px%2C1px+solid+%23999999&amp;output=js"></script>';
	return $output;
}


add_shortcode('awos', 'tipton_awos', 7);
function tipton_awos ( $atts ) {
	$awos = get_awos_data();
	$arr = explode( ' RMK ', $awos[1] );
	$awos_text = $arr[0];
	wp_enqueue_script( 'tipton-home', get_template_directory_uri() . '/js/home.js', array('jquery'), '20120206', true );
	global $post;
	$sfra = apply_filters ( 'the_content' , get_post_meta($post->ID, 'sidebar_content', true) );
	$output = '
	<div id="awos">
		<h2><a href="#">SFRA ALERT &rsaquo;&rsaquo;&rsaquo;</a></h2>
		<div id="awos_inner">
			
			<div id="compass"></div>
			<div id="arrow" style="transform:rotate('.$awos[2].'deg);-ms-transform:rotate('.$awos[2].'deg);-webkit-transform:rotate('.$awos[2].'deg);"></div>
			<div id="awos_text_1"><span>Updated every 20 minutes</span><br />'.$awos_text.'</div>
			<div id="awos_text_2">
				<p>ELV. 150\'<br />3000 X 75</p>
				<p>RWY 28 LP<br />RWY 10 RP<br />PA 1000 msl</p>
				<p>CTAF 123.05<br />AWOS-3 123.925</p>
				<p>Activate MIRL-CTAF<br />Beacon Green-White</p>
			</div>
			<div id="awos_link"><a target="_blank" href="http://aviationweather.gov/">http://aviationweather.gov</a></div>
		</div>
		<div id="sfra_alert"><div class="inner">'.$sfra.'</div></div>
	</div>
	<div class="clear"></div>';
	return $output;
}
function get_awos_data() {
	$myfile = get_template_directory() . '/AWOS.txt';
	$myfile_data = file( $myfile );
	$now = time();
	$last_update = (int)trim($myfile_data[0]);
	$diff = ( $now - $last_update );
	
	if ( $diff < 1200 ) {
		foreach ( $myfile_data as $k => $v) {
			$myfile_data[$k] = trim($v);
		}
		return $myfile_data;
	} else {
		$url = "http://aviationweather.gov/adds/metars/?station_ids=KFME&std_trans=standard&chk_metars=on&hoursStr=most+recent+only&submitmet=Submit";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		$pattern = '|<FONT FACE="Monospace,Courier">(.*)?</FONT>|s';
		preg_match($pattern, $output, $matches);
		$awos_text = str_replace( array( "\n","\r" ), "", $matches[1] );
		$parts = explode( ' ', $awos_text );
		if ( $parts[0] != 'KFME' ) { return $myfile_data; }
		$wind_dir = $wind_speed = '';
		foreach( $parts as $part ){
			if ( substr($part, -2) == 'KT' ) {
				$wind_dir = substr($part, 0, 3);
				$wind_speed = substr($part, 3, 2);
			}
		}
		if ( empty($wind_dir) || empty($wind_speed) ) { return $myfile_data; }
		$newdata = array( $now, $awos_text, $wind_dir, $wind_speed );
		$file_out = implode( "\n", $newdata );
		$h = fopen( $myfile, 'w+' );
		fwrite( $h, $file_out );
		fclose( $h );
		return $newdata;
	}
	
	//$h = fopen( $myfile, 'w+' );
	//fwrite( $h, $now . "\n" );
	//fclose( $h );
}



add_shortcode('homepagetop', 'tipton_homepagetop', 7);
function tipton_homepagetop ( $atts, $content="" ) {
	$content = get_field('home_page_top_section');
	return '<div class="hide_mobile">'.$content.'</div>';
}

add_shortcode('flyingeasy', 'tipton_flyingeasy', 7);
function tipton_flyingeasy ( $atts, $content="" ) {
	$content_browser = get_field('flying_easy_for_browser');
	$content_mobile = get_field('flying_easy_for_mobile');
	
	return '<hr /><div id="flyingeasy"><img style="display: block; margin: auto;" alt="" src="http://tiptonairport.org/wp-content/uploads/2015/02/Tipton-Airport-Logo.png" /><h1>FLYING IS EASY</h1><h2>FOR PLEASURE OR BUSINESS</h2></div><div id="flyingeasy_text"><div class="hide_mobile">'.$content_browser.'</div><div class="hide_browser">'.$content_mobile.'</div></div><hr />';
}

add_shortcode('browseronly', 'tipton_browseronly', 7);
function tipton_browseronly ( $atts, $content="" ) {
	//echo 'browseronly<textarea>'.$content.'</textarea>';
	return '<div class="hide_mobile">'.$content.'</div>';
}

add_shortcode('mobileonly', 'tipton_mobileonly', 7);
function tipton_mobileonly ( $atts, $content="" ) {
	
	return '<div class="hide_browser">'.$content.'</div>';
}

add_shortcode('gallery', 'my_gallery_shortcode', 7);    
function my_gallery_shortcode($attr) {
    $post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'full',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}




	foreach ( $attachments as $id => $attachment ) {

		$output .= wp_get_attachment_image( $id, $size );

	}

	return '<div id="slider">' . $output . '</div>';
}


add_action( 'init', 'register_cpt_visitorinfo' );
function register_cpt_visitorinfo() {

    $labels = array( 
        'name' => _x( 'Visitor Info', 'visitor info' ),
        'singular_name' => _x( 'Visitor Info', 'visitor info' ),
        'add_new' => _x( 'Add New', 'visitor info' ),
        'add_new_item' => _x( 'Add New Visitor Info', 'visitor info' ),
        'edit_item' => _x( 'Edit Visitor Info', 'visitor info' ),
        'new_item' => _x( 'New Visitor Info', 'visitor info' ),
        'view_item' => _x( 'View Visitor Info', 'visitor info' ),
        'search_items' => _x( 'Search Visitor Info', 'visitor info' ),
        'not_found' => _x( 'No visitor info found', 'visitor info' ),
        'not_found_in_trash' => _x( 'No visitor info found in Trash', 'visitor info' ),
        'menu_name' => _x( 'Visitor Info', 'visitor info' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
    );

    register_post_type( 'visitorinfo', $args );

	add_shortcode( 'visitorinfo', 'visitorinfo_func', 7 );
	
}

function visitorinfo_func( $atts ) {
	$visitorinfo_query_args = array(
		'post_type' => 'visitorinfo',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	);
	$visitorinfo = get_posts($visitorinfo_query_args);
	$out = '';
	foreach ( $visitorinfo as $vi ) {
		$icon = wp_get_attachment_image_src( get_post_thumbnail_id( $vi->ID ) );
		$offset = 246 - $icon[1];
		$out .= '<div class="visitor_icon"><div class="divicon" style="background-image:url('.$icon[0].');"></div><h3>'.$vi->post_title.'</h3><p>'.$vi->post_content.'</p></div>';
		
	}
	
	return $out;
}



/*
// This will do nothing but will allow the shortcode to be stripped
add_shortcode( 'foobar', '__return_false' );
 
// Actual processing of the shortcode happens here
function foobar_run_shortcode( $content ) {
    global $shortcode_tags;

    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes();
 
    add_shortcode( 'foobar', 'shortcode_foobar' );
 
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
echo '<textarea>'.$content.'</textarea>';
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
 
add_filter( 'the_content', 'foobar_run_shortcode', 7 );
*/




function my_the_content_filter($content) {
//echo '<textarea>'.$content.'</textarea>';
  return $content;
}

add_filter( 'the_content', 'my_the_content_filter' );