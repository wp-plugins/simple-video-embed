=== Plugin Name ===
Contributors: almalerik
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=K5Z25CMCNEUDN
Tags: video, video player, video gallery, shortcode, embed, mobile, responsive
Requires at least: 4.0
Tested up to: 4.2.2
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple plugin to embed responsive video and video playlist to posts or articles with nice features.

== Description ==

This plugin actually support embed of public Youtube video and video playlist adding a simple button in Tinymce that generate or edit shortcode.

Video playlist can be publish with 4 responsive templates:

* Only video iframe
* Iframe with all thumbnails videos in columns
* Iframe with a swipe and draggable carousel thumbnails videos
* Swipe and draggable carousel slider

For Youtube video, the plugin use Google API version 3.

Upcoming developments will support other video sources like Vimeo.

== Installation ==

* Upload the unzipped folder `simple-video-embed` to the `/wp-content/plugins/` directory
* Activate the plugin through the 'Plugins' menu in WordPress
* Update simple-video-embed configuration under Settings -> Simple Video Embed

== Frequently Asked Questions ==

= How to get a Google Public Api Key (V3)? =

1. Visit the <a href="https://console.developers.google.com/" target="_blank">Google Developers Console</a> and log in with your Google Account.
2. Create a project or edit one.
3. Click "APIs & auth"
4. Go to "Credentials" and create a new Public API access
5. Go to "APIs" and enable YouTube Data API

== Screenshots ==

1. Simply TinyMCE button.
2. Playlist Video Gallery
3. Playlist with thumb in columns
4. Playlist with thumb carousel

== Changelog ==

= 1.0.3 =
* Show Google API error.
* Fix css grid system.
* Remove Google API Check from admin panel to preserve request quota

= 1.0.1 =
* Better Google API request.

= 1.0.1 =
* Fix php bug.

= 1.0.0 =
* First release.


== Upgrade Notice ==

= 1.0.3 =

= 1.0.2 =

= 1.0.1 =

= 1.0.0 =
First release

`<?php code(); // goes in backticks ?>`
