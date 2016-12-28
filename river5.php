<?php 
/*
* Plugin Name: River5
* Description: shortcode for displaying a river5 json file
* Version: 0.1
* Author: John Johnston
* Author URI: http://johnjohnston.info
* License:     GPL2
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
define( 'RIVER5_URL', \plugin_dir_url( __FILE__ ) );

///just_a_test.mp3
function river5_shortcode_routine( $args ) {
	extract( shortcode_atts( array( 'river5jsonurl' => 'http://pi.johnj.info/rivers/Edublogs.js'), $args ) );
	$return = "";	
	// pay attention john
	$return= sprintf(
		"<div  data-river5='%s' class='river5feed'  ><img  src='".RIVER5_URL."assets/Ajax-loader.gif'></div>",
		esc_url( $river5jsonurl ) );
	//enqueue here so only add script & styles when needed
	wp_enqueue_script( 'river5');	
	wp_enqueue_style ( 'river5' );
	// return the result
	return $return;
}

//add_shortcode('river5', 'river5_shortcode_routine');
//Above comment out because:  however when running in the plugin context you must hook the shortcode registration to init.
//see https://developer.wordpress.org/plugins/shortcodes/basic-shortcodes/

function river5_register_shortcode() {
    add_shortcode( 'river5', 'river5_shortcode_routine' );
}
 
add_action( 'init', 'river5_register_shortcode' );

 
function add_scripts_basic(){
// wp_register_script Registers a script file in WordPress to be linked to a page later using the wp_enqueue_script() function, which safely handles the script dependencies.
	wp_register_script( 'river5', plugins_url( 'assets/river5.js', __FILE__ ), array( 'json2','jquery' ),false,true );	
	wp_register_style ( 'river5', plugins_url( 'assets/river5.css', __FILE__ ) );
}

add_action( 'init', 'add_scripts_basic' );
?>