<?php
/*
Plugin Name: Progress Bar
Plugin URI: https://github.com/jazzsequence/progress-bar
Description: a simple progress bar shortcode that can be styled with CSS
Version: 1.1
Author: Chris Reynolds
Author URI: http://museumthemes.com
License: GPL3
*/

/*
	Progress Bar
    Copyright (C) 2013 | Chris Reynolds (chris@arcanepalette.com)

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
 * @author Chris Reynolds
 * @since 0.1
 * @param string $progress REQUIRED displays the actual progress bar in % or in x/y
 * usage: [wppb progress=50] or [wppb progress=500/1000]
 * @param string $option OPTIONAL calls various options. These can be user-input (uses CSS classes, so anything a user adds to their CSS could
 * potentially be used as an option) or any of the pre-defined options/styles. Included options (as of 1.0.1): candystripes, animated-candystripes,
 * red
 * usage: [wppb progress=50 option="red candystripes"]
 * usage: [wppb progress=50 option=animated-candystripes]
 * @param string $percent OPTIONAL displays the percentage either on the bar itself, or after the progress bar, depending on which parameter is used.
 * Options are 'after' and 'inside'.
 * usage: [wppb progress=50 percent=after]
 * @param bool $fullwidth OPTIONAL if present (really, if this is in the shortcode at all), will stretch the progress bar to 100% width
 * usage: [wppb progress=50 fullwidth=true]
 * @param string $color OPTIONAL sets a color for the progress bar that overrides the default color. can be used as a starting color for $gradient
 * usage: [wppb progress=50 color=ff0000]
 * usage: [wppb progress=50 color=ff0000 gradient=.1]
 * @param string $gradient OPTIONAL @uses $color adds an end color that is the number of degrees offset from the $color parameter and uses it for a
 * gradient
 * $color parameter is REQUIRED for $gradient
 * usage: [wppb progress=50 color=ff0000 gradient=.1]
 */

function wppb( $atts ) {
	extract( shortcode_atts( array(
		'progress' => '',		// the progress in % or x/y
		'option' => '',			// what options you want to use (candystripes, animated-candystripes, red)
		'percent' => '',		// whether you want to display the percentage and where you want that to go (after, inside)
		'fullwidth' => '',		// determines if the progress bar should be full width or not
		'color' => '',			// this will set a static color value for the progress bar, or a starting point for the gradient
		'gradient' => '',		// will set a positive or negative end result based on the color, e.g. gradient=1 will be 100% brighter, gradient=-0.2 will be 20% darker
		'endcolor' => ''		// defines an end color for a custom gradient
		), $atts ) );
	$pos = strpos($progress, '/');
	if($pos===false) {
		$width = $progress . "%";
		$progress = $progress . " %";
	} else {
		$dollar = strpos($progress, '$');
		if ( $dollar === false ) {
			/**
			 * this could be used for other currencies, potentially, though if it was, it should be changed into a case instead of an if statement
			 */
		} else {
			/**
			 * if there's a progress bar in the progress, it will break the math
			 * let's strip it out so we can add it back later
			 */
			$progress = str_replace('$', '', $progress);
		}
		$xofy = explode('/',$progress);
		if (!$xofy[1])
			$xofy[1] = 100;
		$percentage = $xofy[0] / $xofy[1] * 100;
		$width = $percentage . "%";
		if ( $dollar === false ) {
			$progress = $xofy[0] . " / " . $xofy[1];
		} else {
			/**
			 * if there's a dollar sign in the progress, display it manually
			 */
			$progress = '$' . $xofy[0] . ' / $' . $xofy[1];
		}
	}
	/**
	 * here's the html output of the progress bar
	 */
	$wppb_output	= "<div class=\"wppb-wrapper {$percent}"; // adding $percent to the wrapper class, so I can set a width for the wrapper based on whether it's using div.wppb-wrapper.after or div.wppb-wrapper.inside or just div.wppb-wrapper
	if (isset($atts['fullwidth'])) {
		$wppb_output .= " full";
	}
	$wppb_output .= "\">";
	if (isset($atts['percent'])) { // if $percent is not empty, add this
		$wppb_output .= "<div class=\"{$percent}\">{$progress}</div>";
	}
	$wppb_output 	.= 	"<div class=\"wppb-progress";
	if (isset($atts['fullwidth'])) {
		$wppb_output .= " full";
	}
	$wppb_output 	.= "\">";
	$wppb_output	.= "<span";
	if (isset($atts['option'])) {
		$wppb_output .= " class=\"{$option}\"";
	}
	if (isset($atts['color'])) { // if color is set
		$wppb_output .= " style=\"width: {$width}; background: {$color};";
		if (isset($atts['endcolor'])) {
			$gradient_end = $atts['endcolor'];
			$wppb_output .= "background: -moz-linear-gradient(top, {$color} 0%, $gradient_end 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,{$color}), color-stop(100%,$gradient_end)); background: -webkit-linear-gradient(top, {$color} 0%,$gradient_end 100%); background: -o-linear-gradient(top, {$color} 0%,$gradient_end 100%); background: -ms-linear-gradient(top, {$gradient} 0%,$gradient_end 100%); background: linear-gradient(top, {$color} 0%,$gradient_end 100%); \"";
		}
	} else {
		$wppb_output .= " style=\"width: {$width};";
	}
	if (isset($atts['gradient']) && isset($atts['color'])) { // if a color AND gradient is set (gradient won't work without the starting color)
		$gradient_end = wppb_brightness($atts['color'],$atts['gradient']);
		$wppb_output .= "background: -moz-linear-gradient(top, {$color} 0%, $gradient_end 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,{$color}), color-stop(100%,$gradient_end)); background: -webkit-linear-gradient(top, {$color} 0%,$gradient_end 100%); background: -o-linear-gradient(top, {$color} 0%,$gradient_end 100%); background: -ms-linear-gradient(top, {$gradient} 0%,$gradient_end 100%); background: linear-gradient(top, {$color} 0%,$gradient_end 100%); \"";
	} else {
		$wppb_output .= "\"";
	}
	$wppb_output	.= "><span></span></span>";
	$wppb_output	.=	"</div>";
	$wppb_output	.= "</div>";
	/**
	 * now return the progress bar
	 */
	return $wppb_output;
}
add_shortcode('wppb','wppb');

/**
 * Brightness
 * calculates a brighter or darker color based on the hex value given
 * @since 1.1
 * @link http://lab.clearpixel.com.au/2008/06/darken-or-lighten-colours-dynamically-using-php/
 * @param string $hex REQUIRED the hex color value
 * @param string $percent REQUIRED how much the offset should be
 * usage: wppb_brightness('ff0000','0.2')
 */
function wppb_brightness($hex, $percent) {
	/**
	 * Work out if hash given
	 */
	$hash = '';
	if (stristr($hex,'#')) {
		$hex = str_replace('#','',$hex);
		$hash = '#';
	}
	/**
	 * HEX TO RGB
	 */
	$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
	//// CALCULATE
	for ($i=0; $i<3; $i++) {
		// See if brighter or darker
		if ($percent > 0) {
			// Lighter
			$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
		} else {
			// Darker
			$positivePercent = $percent - ($percent*2);
			$rgb[$i] = round($rgb[$i] * $positivePercent);// + round(0 * (1-$positivePercent));
		}
		// In case rounding up causes us to go to 256
		if ($rgb[$i] > 255) {
			$rgb[$i] = 255;
		}
	}
	/**
	 * RBG to Hex
	 */
	$hex = '';
	for($i=0; $i < 3; $i++) {
		// Convert the decimal digit to hex
		$hexDigit = dechex($rgb[$i]);
		// Add a leading zero if necessary
		if(strlen($hexDigit) == 1) {
		$hexDigit = "0" . $hexDigit;
		}
		// Append to the hex string
		$hex .= $hexDigit;
	}
	return $hash.$hex;
}