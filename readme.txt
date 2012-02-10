=== Progress Bar ===
Contributors: jazzs3quence
Donate link:https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=AWM2TG
Tags: progress bar, css3, progress, shortcode
Requires at least: 2.8
Tested up to: 3.3.1
Stable tag: 1.0

a simple progress bar shortcode that can be styled with CSS

== Description ==

This plugin does one thing: it creates a simple (but nice-looking) CSS3 progress bar that you can style with your own CSS and use wherever you want with a simple shortcode.

To add a progress bar to a post or a page, simply use this shortcode:

`[wppb progress=50]`

where "50" in the example above is a progress bar that is 50% complete.  Simple, lightweight, cross-browser compatible (degrades nicely for browsers that don\'t support CSS3).

You can also apply 2 effects to the progress by applying "options".  The accepted parameters are 'candystripe' and 'animated-candystripe'.  For demos of each, go here: http://museumthemes.com/progress-bar-demo/  To use the options, use these shortcodes:

`[wppb progress=50 option=candystripe]`

or

`[wppb progress=50 option=animated-candystripe]`

== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

== Frequently Asked Questions ==

**How do I change the colors?**

You can change the colors via the css.  Use `div.wppb-progress` to change the style of the container and `div.wppb-progress > span` to change the style of the bar itself.  You can also change the candystripe and animated candystripe.  See http://css-tricks.com/css3-progress-bars/ for an excellent tutorial and http://www.colorzilla.com/gradient-editor/ for a CSS gradient generator.

== Changelog ==

**1.0**

*   initial commit

 