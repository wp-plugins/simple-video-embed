<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/Almalerik
 * @since      1.0.0
 *
 * @package    Simple_Video_Embed
 * @subpackage Simple_Video_Embed/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package Simple_Video_Embed
 * @subpackage Simple_Video_Embed/public
 * @author Almalerik <almalerik@gmail.com>
 */
class Simple_Video_Embed_Public {
	
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
	static $get_url_contents;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name
	 *        	The name of the plugin.
	 * @param string $version
	 *        	The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	
	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/simple-video-embed-public.css', array (), $this->version, 'all' );
	}
	
	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-video-embed-public.js', array (
				'jquery' 
		), $this->version, true );
	}
	
	/**
	 * Shortcode wpsve init
	 *
	 * @since 1.0.0
	 */
	public function shortcode($atts) {
		
		/**
		 * Shortcode wpsve definition
		 */
		function wpsve_shortcode($atts) {
			
			// Attributes
			extract( shortcode_atts( array (
					'object' => '',
					'type' => '',
					'id' => '',
					'autoplay' => '',
					'template' => '',
					'height' => '',
					'col' => '',
					'thumb_title' => ''
			), $atts ) );
			
			// Code
			static $uniqueId = 0;
			$uniqueId ++;
			if (array_key_exists( 'height', $atts )) {
				$atts ['video-carousel-height'] = $atts ['height'];
			}
			if (array_key_exists( 'col', $atts )) {
				$atts ['thumb-columns-number'] = $atts ['col'];
			}
			switch ($atts ['object']) {
				case 'youtube' :
					$yt = Sve_Youtube::withParams( $atts ['id'], $atts, $uniqueId );
					break;
			}
			
			return $yt->getHtml();
		}
		
		add_shortcode( "wpsve", "wpsve_shortcode" );
	}
	public static function get_url_contents($url) {
		if (function_exists( 'file_get_contents' )) {
			$result = @file_get_contents( $url );
		}
		if ($result == '') {
			$ch = curl_init();
			$timeout = 30;
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
			curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
			$result = curl_exec( $ch );
			curl_close( $ch );
		}
		
		return $result;
	}
}

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-simple-video-embed-public-youtube.php';
