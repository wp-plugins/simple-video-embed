<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/Almalerik
 * @since      1.0.0
 *
 * @package    Simple_Video_Embed
 * @subpackage Simple_Video_Embed/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since 1.0.0
 * @package Simple_Video_Embed
 * @subpackage Simple_Video_Embed/includes
 * @author Almalerik <almalerik@gmail.com>
 */
class Simple_Video_Embed {
	
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var Simple_Video_Embed_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;
	
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;
	
	/**
	 * The current version of the plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string $version The current version of the plugin.
	 */
	protected $version;
	
	/**
	 * The base name plugin file.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_basename    The base name plugin file.
	 */
	protected $plugin_basename;
	
	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $plugin_basename ) {
		$this->plugin_name = 'simple-video-embed';
		$this->version = '1.0.0';
		
		$this->plugin_basename = $plugin_basename;
		
		$this->load_dependencies ();
		$this->set_locale ();
		$this->define_admin_hooks ();
		$this->define_public_hooks ();
	}
	
	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Simple_Video_Embed_Loader. Orchestrates the hooks of the plugin.
	 * - Simple_Video_Embed_i18n. Defines internationalization functionality.
	 * - Simple_Video_Embed_Admin. Defines all hooks for the admin area.
	 * - Simple_Video_Embed_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function load_dependencies() {
		
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path ( dirname ( __FILE__ ) ) . 'includes/class-simple-video-embed-loader.php';
		
		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path ( dirname ( __FILE__ ) ) . 'includes/class-simple-video-embed-i18n.php';
		
		/**
		 * The class responsible for default option values
		 * of the plugin.
		 */
		require_once plugin_dir_path ( dirname ( __FILE__ ) ) . 'includes/class-simple-video-embed-option.php';
		
		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path ( dirname ( __FILE__ ) ) . 'admin/class-simple-video-embed-admin.php';
		
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path ( dirname ( __FILE__ ) ) . 'public/class-simple-video-embed-public.php';
		
		$this->loader = new Simple_Video_Embed_Loader ();
	}
	
	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Simple_Video_Embed_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function set_locale() {
		$plugin_i18n = new Simple_Video_Embed_i18n ();
		$plugin_i18n->set_domain ( $this->get_plugin_name () );
		
		$this->loader->add_action ( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}
	
	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Simple_Video_Embed_Admin ( $this->get_plugin_name (), $this->get_version () );
		
		$this->loader->add_action ( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action ( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		// Admin options page
		$this->loader->add_action ( 'admin_menu', $plugin_admin, 'plugin_menu' );
		$this->loader->add_action ( 'admin_init', $plugin_admin, 'register_options_settings' );
		
		// mce button
		$this->loader->add_action ( 'admin_head', $plugin_admin, 'mce_add_button' );
		// $this->loader->add_action( 'admin_head', $plugin_admin, 'mce_params' );
		
		// Plugins page action link
		$this->loader->add_filter( 'plugin_action_links_' . $this->plugin_basename , $plugin_admin, 'add_plugin_action_links' );
	}
	
	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function define_public_hooks() {
		$plugin_public = new Simple_Video_Embed_Public ( $this->get_plugin_name (), $this->get_version () );
		
		$this->loader->add_action ( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action ( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		// Add Shortcode
		$this->loader->add_action ( 'init', $plugin_public, 'shortcode' );
	}
	
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since 1.0.0
	 */
	public function run() {
		$this->loader->run ();
	}
	
	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since 1.0.0
	 * @return string The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}
	
	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since 1.0.0
	 * @return Simple_Video_Embed_Loader Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}
	
	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since 1.0.0
	 * @return string The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
