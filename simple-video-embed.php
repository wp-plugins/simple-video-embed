<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/Almalerik
 * @since             1.0.0
 * @package           Simple_Video_Embed
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Video Embed
 * Plugin URI:        https://github.com/Almalerik/wp-simple-video-embed
 * Description:       A simple plugin to embed responsive video and video playlist to posts or articles with nice features.
 * Version:           1.0.3
 * Author:            Almalerik
 * Author URI:        https://github.com/Almalerik
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-video-embed
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-simple-video-embed-activator.php
 */
function activate_simple_video_embed() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-video-embed-activator.php';
	Simple_Video_Embed_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-simple-video-embed-deactivator.php
 */
function deactivate_simple_video_embed() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-video-embed-deactivator.php';
	Simple_Video_Embed_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_simple_video_embed' );
register_deactivation_hook( __FILE__, 'deactivate_simple_video_embed' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-video-embed.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_simple_video_embed() {

	$plugin = new Simple_Video_Embed(plugin_basename(__FILE__));
	$plugin->run();

}
run_simple_video_embed();
