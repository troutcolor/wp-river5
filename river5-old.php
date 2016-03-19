<?php 
/*
* Plugin Name: River5
* Description: Displays content of a river5 json feed.
* Version: 0.1
* Author: John Johnston
* Author URI: http://johnjohnston.info
* License:     GPL2
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


///just_a_test.mp3
function river5_shortcode_routine($args) {
		extract( shortcode_atts( array(
			'river' => "http://radio3.io/rivers/iowa.js",
		), $args ) );
	$return = "";	
	// paty attention 
	$return= sprintf(
	"<script>
	jQuery(document).ready(function( $ ) {
	
		// $ Works! You can test it with next line if you like
		  console.log($);
	
	});
	var appConsts = {
	version: '0.45'
	}

	var urlDefaultRiver = 'http://pi.johnj.info/rivers/Edublogs.js';  
	function updateRiver (url) {
	return (httpGetRiver (url, 'idRiverDisplay')); 
	}
	function startup () {
	console.log ('startup');
	jQuery('#idVersionNumber').html ('v' + appConsts.version);
	updateRiver (urlDefaultRiver); //10/5/14 by DW
	}
	</script>
	<style>
	body {
 
	font-size: 18px;
	background-color: whitesmoke;
	}
	.divPageBody {
	width: 60%;
	margin-left: auto;
	margin-right: auto;
	}
	.divVersionNumber {
	font-size: 12px;
	color: #777777;
	float: right;
	padding: 19px;
	}
	.divRiverContainer {
	margin-top: 110px;
	margin-bottom: 500px;
	}
	</style>
	</head>
	<body>

	<div class='divPageBody'>
	<div class='divRiverContainer'>
	<div class='divRiverDisplay' id='idRiverDisplay'>
	</div>
	</div>
	</div>
	<script>
	
	
	
	
	startup ();
	</script>"
		,
		esc_url( $river )
	);
	
	
	//enqueue here so only add script & styles when needed
	wp_enqueue_script( 'riverbrowser');	
	// return the result
	return $return;
}


//add_shortcode('gifmovie', 'gifmovie_shortcode_routine');
//Above comment out because:  however when running in the plugin context you must hook the shortcode registration to init.
//see https://developer.wordpress.org/plugins/shortcodes/basic-shortcodes/
//[gifmovie gif="value1" mp3="value2"]

function river5_register_shortcode() {
    add_shortcode( 'river5', 'river5_shortcode_routine' );
}
 
add_action( 'init', 'river5_register_shortcode' );

 
function add_scripts_basic(){
// wp_register_script Registers a script file in WordPress to be linked to a page later using the wp_enqueue_script() function, which safely handles the script dependencies.
		wp_register_script( 'riverbrowser', "http://fargo.io/code/browsers/riverbrowser.js", array( 'jquery' ),false,false );	
 }
add_action( 'init', 'add_scripts_basic' );
?>