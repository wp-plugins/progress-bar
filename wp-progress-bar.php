<?php
/*
Plugin Name: Progress Bar
Plugin URI: https://github.com/jazzsequence/progress-bar
Description: a simple progress bar shortcode that can be styled with CSS
Version: 1.0
Author: Chris Reynolds
Author URI: http://museumthemes.com
License: GPL3
*/

/*
	Progress Bar
    Copyright (C) 2012 | Chris Reynolds (chris@arcanepalette.com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    http://www.opensource.org/licenses/gpl-3.0.html
*/

/**
 * wppb_init
 * loads the css and javascript
 * @author Chris Reynolds
 * @since 0.1
 */

function wppb_init() {
	$wppb_path = plugin_dir_url( __FILE__ );
	if ( !is_admin() ) { // don't load this if we're in the backend
		wp_register_style( 'wppb_css', $wppb_path . 'css/wppb.css' );
		wp_enqueue_style( 'wppb_css' );
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'wppb_animate', $wppb_path . 'js/wppb_animate.js', 'jquery' );
		wp_enqueue_script ( 'wppb_animate' );
	}
}
add_action( 'init', 'wppb_init' );

/**
 * Progress Bar
 * simple shortcode that displays a progress bar
 * syntax: [wppb 50] -- displays a progress bar that is 50% full
 * @author Chris Reynolds
 * @since 0.1
 */

function wppb( $atts ) {
	extract( shortcode_atts( array(
		'progress' => '',
		'option' => ''
		), $atts ) );
	// here's the html output of the progress bar
	$wppb_output	= "{$wppb_progress}";
	$wppb_output 	.= 	"<div class=\"wppb-progress\">";
	$wppb_output 	.=	"	<span style=\"width: {$progress}%;\" class=\"{$option}\"><span></span></span>";
	$wppb_output	.=	"</div>";
	// now return the progress bar
	return $wppb_output;
}
add_shortcode('wppb','wppb');

?>