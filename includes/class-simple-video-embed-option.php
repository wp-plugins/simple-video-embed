<?php

/**
 * The file that defines default options values.
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
 *
 * This is used to define default options values.
 *
 *
 * @since 1.0.0
 * @package Simple_Video_Embed
 * @subpackage Simple_Video_Embed/includes
 * @author Almalerik <almalerik@gmail.com>
 */
class Simple_Video_Embed_Option {
	
	/**
	 * The main options values.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var array $main The defaults main options values.
	 */
	protected $main = array (
			'thumb-columns-number' => 2,
			'video-carousel-height' => 300,
			'video-carousel-left-arrow' => '<',
			'video-carousel-right-arrow' => '>',
			'thumb_title' => '1' 
	);
	
	/**
	 * The youtube options values.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var array $youtube The defaults youtube options values.
	 */
	protected $youtube = array (
			'google-public-key-v3' => '' 
	);
	
	/**
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the options, if null use the fields default init.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->main = array_merge( $this->main, get_option( 'wpsve-main', $this->main ));
		$this->youtube = get_option( 'wpsve-youtube', $this->youtube );
	}
	public function getMain() {
		return $this->main;
	}
	public function getYoutube() {
		return $this->youtube;
	}
}
