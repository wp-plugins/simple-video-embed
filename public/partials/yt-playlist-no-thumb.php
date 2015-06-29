<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/Almalerik
 * @since      1.0.0
 *
 * @package    Simple_Video_Embed
 * @subpackage Simple_Video_Embed/public/partials
 */
?>

<div class="wpsve-youtube" id="wpsve-youtube-{playerapiid}">
	<div class="wpsve-video-container wpsve-youtube-container">
		<iframe class="wpsve-iframe wpsve-youtube-iframe" id="{playerapiid}" src="{url}" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	</div>
</div>