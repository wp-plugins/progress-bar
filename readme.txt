=== Progress Bar ===
Contributors: jazzs3quence
Donate link:https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=AWM2TG
Tags: progress bar, css3, progress, shortcode
Requires at least: 2.8
Tested up to: 3.3.1
Stable tag: 1.0.1

a simple progress bar shortcode that can be styled with CSS

== Description ==

This plugin does one thing: it creates a simple (but nice-looking) CSS3 progress bar that you can style with your own CSS and use wherever you want with a simple shortcode.

To add a progress bar to a post or a page, simply use this shortcode:

`[wppb progress=50]`

where "50" in the example above is a progress bar that is 50% complete.  Simple, lightweight, cross-browser compatible (degrades nicely for browsers that don\'t support CSS3).

You can also apply 2 effects to the progress bar or change the default color by applying "options".  Accepted parameters are 'candystripe', 'animated-candystripe' and 'red', but you can create your own CSS classes to create new color options or apply different CSS effects.  You can display the percent complete by adding the "percent" parameter to the shortcode.  Accepted values are 'after' and 'inside', but, again, you can create your own CSS classes and extend this functionality to offer 'before' or 'on-top' or whatever you want.

For demos of each of the options, go here: http://museumthemes.com/progress-bar/

**Examples**

`[wppb progress=50]

`[wppb progress=50 option=candystripe]`

`[wppb progress=50 option=animated-candystripe]`

`[wppb progress=50 option="red candystripe" percent=inside]`

`[wppb progress=50 option=red percent=after]`

== Installation ==

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

== Frequently Asked Questions ==

**How do I change the colors?**

You can change the colors via the css.  Use `div.wppb-progress` to change the style of the container and `div.wppb-progress > span` to change the style of the bar itself.  You can also change the candystripe and animated candystripe.  See http://css-tricks.com/css3-progress-bars/ for an excellent tutorial and http://www.colorzilla.com/gradient-editor/ for a CSS gradient generator.

**No, really, how do I change the colors?  I don't know much about CSS.**

Okay, here's a great example that's being used in the plugin CSS right now to create the 'red' option.  Here's the CSS:

`/* red */
div.wppb-progress > span.red {
	background: #d10418; /* Old browsers */
	background: -moz-linear-gradient(top, #d10418 0%, #6d0019 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#d10418), color-stop(100%,#6d0019)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #d10418 0%,#6d0019 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #d10418 0%,#6d0019 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top, #d10418 0%,#6d0019 100%); /* IE10+ */
	background: linear-gradient(top, #d10418 0%,#6d0019 100%); /* W3C */
}`

You don't need to worry about the candystripes -- those will apply to your new option automatically.  Using this example, you can change the hex values and create a new class (like span.green or span.orange or span.nyannyanrainbows) that you can use inside the shortcode.  Want to see where I got those gradient values?  Go here: http://www.colorzilla.com/gradient-editor/#d10418+0,6d0019+100;Custom

**What about placement of the percentage?  Where's that?**

At the end of `wppb.css` you'll find the two classes for the percentage parameter:

`/* after */
div.wppb-wrapper.after { width: 440px; }
div.wppb-wrapper.after div.wppb-progress { float: left; }
div.wppb-wrapper.after div.after { float: right; line-height: 25px; }

/* inside */
div.wppb-wrapper.inside { width: 400px; height: 25px; position: relative; }
div.wppb-wrapper div.inside { margin: 0 auto; line-height: 25px; color: #ffffff; font-weight: bold; position: absolute; z-index: 1; width: 400px; text-align: center; }`

Position these however you want.  If you wanted the percentage to be inside the progress bar but towards the end, you could do something like this:

`/* right */
div.wppb-wrapper.right { width: 400px; height: 25px; position: relative; }
div.wppb-wrapper div.inside { margin: 0 auto; line-height: 25px; color: #ffffff; font-weight: bold; position: absolute; z-index: 1; width: 400px; text-align: right; padding-right: 10px }`

== Changelog ==

**1.0.1**

*	added "red" as an optional parameter (can go nuts with colors here, but don't really want to do that yet since it's just going to add a lot of unused CSS to the stylesheet) | usage [wppb progress=50 option=red]
*	added new parameter $percent | usage [wppb progress=50 percent=after] -- this will display the percentage after the progress bar; [wppb progress=50 percent=inside] -- this will display the percentage on the actual bar itself

**1.0**

*   initial commit

 