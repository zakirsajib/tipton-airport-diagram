<?php
/**
 * tipton Airport functions and definitions
 * Only included what needed on diagram page
 * @package tipton
 */



/**
 * Enqueue scripts and styles
 */
function tipton_scripts() {
		
	wp_enqueue_style( 'tipton-style', get_stylesheet_uri() );
	wp_enqueue_style( 'tipton-font-style', '//fonts.googleapis.com/css?family=Roboto:400,400italic,700italic,700|Roboto+Condensed:400italic,700italic,400,700' );
	
	wp_enqueue_style('jquery-ui', '//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css');
	wp_enqueue_script('jquery-ui-js', 'https://code.jquery.com/ui/1.12.0/jquery-ui.js');
	
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css');
	
	wp_enqueue_script( 'panzoom', get_template_directory_uri() . '/js/panzoom/jquery.panzoom.min.js', array(), '20130115', true );
	wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/panzoom/jquery.mousewheel.js', array(), '20130115', true );
		
	wp_enqueue_script( 'tipton-js', get_template_directory_uri() . '/js/tipton.js', array('jquery'), '20130115', true );

	
}
add_action( 'wp_enqueue_scripts', 'tipton_scripts' );

