<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/Almalerik
 * @since      1.0.0
 *
 * @package    Simple_Video_Embed
 * @subpackage Simple_Video_Embed/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package Simple_Video_Embed
 * @subpackage Simple_Video_Embed/admin
 * @author Almalerik <almalerik@gmail.com>
 */
class Simple_Video_Embed_Admin {
	
	/**
	 * The ID of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;
	
	/**
	 * The version of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $version The current version of this plugin.
	 */
	private $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name
	 *        	The name of this plugin.
	 * @param string $version
	 *        	The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Video_Embed_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Video_Embed_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style ( $this->plugin_name, plugin_dir_url ( __FILE__ ) . 'css/simple-video-embed-admin.css', array (), $this->version, 'all' );
	}
	
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Video_Embed_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Video_Embed_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		/*wp_enqueue_script ( $this->plugin_name, plugin_dir_url ( __FILE__ ) . 'js/simple-video-embed-admin.js', array (
				'jquery' 
		), $this->version, false );*/
	}
	
	/**
	 * Register the admin page options.
	 *
	 * @since 1.0.0
	 */
	public function plugin_menu() {
		add_options_page ( __ ( 'Simple Video Embed Options', $this->plugin_name ), __ ( 'Simple Video Embed', $this->plugin_name ), 'manage_options', $this->plugin_name, array (
				$this,
				'plugin_options' 
		) );
	}
	
	/**
	 * Render the admin page options.
	 *
	 * @since 1.0.0
	 */
	public function plugin_options() {
		if (! current_user_can ( 'manage_options' )) {
			wp_die ( __ ( 'You do not have sufficient permissions to access this page.', $this->plugin_name ) );
		}
		include_once ('partials/simple-video-embed-admin-display.php');
	}
	
	/**
	 * Register the admin page options settings.
	 *
	 * @since 1.0.0
	 */
	public function register_options_settings() {
		register_setting ( 'wpsve-main', 'wpsve-main' );
		register_setting ( 'wpsve-youtube', 'wpsve-youtube' );
	}
	
	/**
	 * Declare your new MCE plugin.
	 *
	 * @since 1.0.0
	 */
	public function mce_add_button() {
		// check user permissions
		if (! current_user_can ( 'edit_posts' ) && ! current_user_can ( 'edit_pages' )) {
			wp_die ( __ ( 'You do not have sufficient permissions to access this page.', $this->plugin_name ) );
		}
		// check if WYSIWYG is enabled
		if ('true' == get_user_option ( 'rich_editing' )) {
			add_filter ( 'mce_external_plugins', array (
					$this,
					'mce_add_plugin' 
			) );
			add_filter ( 'mce_buttons', array (
					$this,
					'mce_register_button' 
			) );
			add_filter ( 'mce_external_languages', array (
					$this,
					'mce_lang'
			) );
		}
	}
	
	/**
	 * Declare script for new button
	 *
	 * @since 1.0.0
	 */
	public function mce_add_plugin($plugin_array) {
		$plugin_array ['wpsve_mce_button'] = plugin_dir_url ( __FILE__ ) . 'js/simple-video-embed-mce.js';
		return $plugin_array;
	}
	
	/**
	 * Register new button in the editor.
	 *
	 * @since 1.0.0
	 */
	public function mce_register_button($buttons) {
		array_push ( $buttons, 'wpsve_mce_button' );
		return $buttons;
	}
	
	/**
	 * Translation for MCE 
	 *
	 * @since 1.0.0
	 */
	function mce_lang($locales) {
		$locales['wpsve_mce_button'] = plugin_dir_path ( __FILE__ ) . 'translations-mce.php';
		return $locales;
	}
	
	/**
	 * Return the plugin action links.  This will only be called if the plugin
	 * is active.
	 *
	 * @since 1.0.0
	 * @param array $actions associative array of action names to anchor tags
	 * @return array associative array of plugin action links
	 */
	public function add_plugin_action_links( $actions ) {
	
		$custom_actions = array(
				'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'options-general.php?page=simple-video-embed' ), __( 'Settings', $this->plugin_name ) ),
				'donate' => sprintf( '<a href="%s">%s</a>', 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=K5Z25CMCNEUDN', __( 'Donate', $this->plugin_name ) ),
				'support'   => sprintf( '<a href="%s">%s</a>', 'https://github.com/Almalerik/woocommerce-carousel-as/issues', __( 'Support', $this->plugin_name ) ),
		);
	
		// add the links to the front of the actions list
		return array_merge( $custom_actions, $actions );
	}

}
