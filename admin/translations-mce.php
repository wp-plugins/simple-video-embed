<?php
if (! defined( 'ABSPATH' ))
	exit();

if (! class_exists( '_WP_Editors' ))
	require (ABSPATH . WPINC . '/class-wp-editor.php');

function mce_translation() {
	$option = new Simple_Video_Embed_Option();
	$main_option = $option->getMain();
    $youtubeOption = $option -> getYoutube();
	$strings = array (
			
			'googlePublicKeyV3' => $youtubeOption['google-public-key-v3'],
			'defaultVideoSliderHeight' => $main_option['video-carousel-height'],
			'defaultColumnsNumber' => $main_option['thumb-columns-number'],
			'defaultThumbTitle' => $main_option['thumb_title'],
			
			'typeLabel' => __( 'Type', 'simple-video-embed' ),
			'videoLabel' => __( 'Video', 'simple-video-embed' ),
			'playlistLabel' => __( 'Playlist', 'simple-video-embed' ),
			'urloridLabel' => __( 'Url or ID', 'simple-video-embed' ),
			'autoplayLabel' => __( 'Autoplay', 'simple-video-embed' ),
			'loopLabel' => __( 'Loop', 'simple-video-embed' ),
			'templateLabel' => __( 'Playlist template', 'simple-video-embed' ),
			'videoControlsDisplayLabel' => __( 'Video player controls', 'simple-video-embed' ),
			'videoControlsDisplay0Label' => __( 'Hide', 'simple-video-embed' ),
			'videoControlsDisplay1Label' => __( 'Display immediately', 'simple-video-embed' ),
			'videoControlsDisplay2Label' => __( 'Display after video played', 'simple-video-embed' ),
			'fullscreenLabel' => __( 'Full screen', 'simple-video-embed' ),
			'thumb_titleLabel' => __( 'Show thumb video title', 'simple-video-embed' ),
			
			'noThumbLabel' => __( 'No thumbnails', 'simple-video-embed' ),
			'slider' => __( 'Video Slider', 'simple-video-embed' ),
			'thumbSlider' => __( 'Thumbnails slider', 'simple-video-embed' ),
			'thumbInColumns' => __( 'Thumbnails in columns', 'simple-video-embed' ),
			
			'alertRequired' => __( 'Please fill popup required fields.', 'simple-video-embed' ),
			'alertKeyInvalid' => __( 'Google Public API Key is invalid!', 'simple-video-embed' ),
			'alertRequiredSend' => __( 'Bad Request, missing required parameter!', 'simple-video-embed' ),
			'alertUnknownPart' => __( 'Bad Request, unknown parameter!', 'simple-video-embed' ),
			'alertUrlNotFound' => __( 'Cannot contact ', 'simple-video-embed' ),
			'alertNotFound' => __( 'not found!', 'simple-video-embed' ),
			'alertConfig' => __( 'You have to configure Simple Video Embed!', 'simple-video-embed' ) 
	);
	
	$locale = _WP_Editors::$mce_locale;
	$translated = 'tinyMCE.addI18n("' . $locale . '.wpsve_mce_button", ' . json_encode( $strings ) . ");\n";
	
	return $translated;
}

$strings = mce_translation();