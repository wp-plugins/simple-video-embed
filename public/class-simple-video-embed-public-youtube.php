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
 *
 * @package Simple_Video_Embed
 * @subpackage Simple_Video_Embed/public
 * @author Almalerik <almalerik@gmail.com>
 */
class Sve_Youtube {
	
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
	 * This parameter specifies a the video type.
	 * Valid parameter values are video (default) and playlist.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $type Valid parameter values are video and playlist.
	 */
	private $type = 'video';
	
	/**
	 * This parameter specifies the video or playlist id.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $id Video or playlist id.
	 */
	private $id;
	
	/**
	 * This parameter indicates whether the video controls will
	 * automatically hide after a video begins playing.
	 * Supported values are:
	 *
	 * 2 (default) � If the player has a 16:9 or 4:3 aspect ratio,
	 * the video progress bar and player controls display or hide
	 * automatically. Otherwise, those controls are visible
	 * throughout the video.
	 *
	 * 1 � Regardless of the player's dimensions, the video progress
	 * bar and player controls display or hide automatically.
	 *
	 * 0 � Regardless of the player's dimensions, the video progress
	 * bar and player controls are visible throughout the video.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var integer $autohide The video controls hide mode.
	 */
	private $autohide = 2;
	
	/**
	 * This parameter specifies whether the initial video will
	 * automatically start to play when the player loads.
	 *
	 * Supported
	 * values are 0 or 1. The default value is 0.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var integer $autoplay The autoplay mode.
	 */
	private $autoplay = 0;
	
	/**
	 * This parameter indicates whether the video player controls
	 * are displayed.
	 * For IFrame embeds that load a Flash player, it also defines
	 * when the controls display in the player as well as when the
	 * player will load. Supported values are:
	 *
	 * controls=0 � Player controls do not display in the player.
	 * For IFrame embeds, the Flash player loads immediately.
	 *
	 * controls=1 (default) � Player controls display in the player.
	 * For IFrame embeds, the controls display immediately and the
	 * Flash player also loads immediately.
	 *
	 * controls=2 � Player controls display in the player.
	 * For IFrame embeds, the controls display and the Flash player
	 * loads after the user initiates the video playback.
	 *
	 * Note: The parameter values 1 and 2 are intended to provide an
	 * identical user experience, but controls=2 provides a
	 * performance improvement over controls=1 for IFrame embeds.
	 * Currently, the two values still produce some visual differences
	 * in the player, such as the video title's font size. However,
	 * when the difference between the two values becomes completely
	 * transparent to the user, the default parameter value may change
	 * from 1 to 2.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var integer $controls The video controls display mode.
	 */
	private $controls = 1;
	
	/**
	 * Setting the parameter's value to 1 enables the player to be
	 * controlled via IFrame or JavaScript Player API calls.
	 * The default value is 0, which means that the player cannot be
	 * controlled using those APIs.
	 *
	 * For more information on the IFrame API and how to use it,
	 * see the <a href="https://developers.google.com/youtube/iframe_api_reference">IFrame API documentation</a>.
	 * (The JavaScript Player API has already been deprecated.)
	 *
	 * @since 1.0.0
	 * @access private
	 * @var integer $enablejsapi Enable or disable iframe control throw javascript.
	 */
	private $enablejsapi = 0;
	
	/**
	 * This parameter provides an extra security measure for the IFrame
	 * API and is only supported for IFrame embeds.
	 * If you are using the IFrame API, which means you are setting the
	 * enablejsapi parameter value to 1, you should always specify your
	 * domain as the origin parameter value.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $origin Domain as the origin parameter value.
	 */
	private $origin;
	
	/**
	 * Setting this parameter to 0 prevents the fullscreen button from displaying in the player.
	 * The default value is 1, which causes the fullscreen button to display.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var integer $fs Enable or disable fullscreen mode.
	 */
	private $fs = 1;
	
	/**
	 * The list parameter, in conjunction with the listType parameter,
	 * identifies the content that will load in the player.
	 *
	 * If the listType parameter value is search, then the list parameter
	 * value specifies the search query.
	 *
	 * If the listType parameter value is user_uploads, then the list
	 * parameter value identifies the YouTube channel whose uploaded videos
	 * will be loaded.
	 *
	 * If the listType parameter value is playlist, then the list parameter value
	 * specifies a YouTube playlist ID. In the parameter value, you need to prepend
	 * the playlist ID with the letters PL as shown in the example below.
	 *
	 * Example:
	 * http://www.youtube.com/embed?listType=playlist&list=PLC77007E23FF423C6
	 *
	 * Note: If you specify values for the list and listType parameters, the
	 * IFrame embed URL does not need to specify a video ID.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $list Identifies the content that will load in the player.
	 */
	private $list;
	
	/**
	 * The listType parameter, in conjunction with the list parameter,
	 * identifies the content that will load in the player.
	 * Valid parameter values are playlist, search, and user_uploads.
	 *
	 * If you specify values for the list and listType parameters,
	 * the IFrame embed URL does not need to specify a video ID.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $listType Valid parameter values are playlist, search, and user_uploads.
	 */
	private $listType;
	
	/**
	 * In the case of a single video player, a setting of 1 causes the player
	 * to play the initial video again and again.
	 * In the case of a playlist player (or custom player), the player plays the
	 * entire playlist and then starts again at the first video.
	 *
	 * Supported values are 0 and 1, and the default value is 0.
	 *
	 * Note:
	 * This parameter has limited support in the AS3 player and in IFrame embeds,
	 * which could load either the AS3 or HTML5 player. Currently, the loop parameter
	 * only works in the AS3 player when used in conjunction with the playlist parameter.
	 * To loop a single video, set the loop parameter value to 1 and set the playlist
	 * parameter value to the same video ID already specified in the Player API URL:
	 * http://www.youtube.com/v/VIDEO_ID?version=3&loop=1&playlist=VIDEO_ID
	 *
	 * @since 1.0.0
	 * @access private
	 * @var integer $loop Enable or disable video loop mode.
	 */
	private $loop = 0;
	
	/**
	 * This setting is used in conjunction with the JavaScript API.
	 * The value can be any alphanumeric string.
	 * See the
	 * <a href="https://developers.google.com/youtube/js_api_reference">JavaScript API documentation</a> for details.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $playerapiid Optional player Id pass to onYouTubePlayerReady callback function.
	 */
	private $playerapiid;
	
	/**
	 * This parameter specifies a comma-separated list of video IDs to play.
	 * If you specify a value, the first video that plays will be the VIDEO_ID
	 * specified in the URL path, and the videos specified in the playlist parameter
	 * will play thereafter.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $playlist Comma-separated list of video IDs to play.
	 */
	private $playlist;
	
	/**
	 * This parameter specifies the template to use for HTML playlist iframe result.
	 * Valid parameter values are no_thumb (default), 'video_slider', 'thumb_slider', 'thumb_col'.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $template HTML Template.
	 */
	private $template = 'no_thumb';
	
	/**
	 * This parameter store template settings view and dafaults value.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array $template_params Template view parameters.
	 */
	public $template_params;
	
	/**
	 * This parameter store youtube admin options.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array $template_params Youtube admin options.
	 */
	public $youtube_options;
	
	/**
	 * The Google Youtube Api Version 3 url.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $url The Google Youtube Api Version 3 url.
	 */
	private $url = "https://www.googleapis.com/youtube/v3/";
	
	/**
	 * This parameter has the json api call data.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var json $api_data Json Api call Data.
	 */
	private $api_data;
	
	/**
	 * Initialize the class and set its id.
	 *
	 * @since 1.0.0
	 * @param string $id
	 *        	The id of the video or playlist.
	 */
	public static function withId($id) {
		$yt = new Sve_Youtube();
		$yt->id = $id;
		$yt->playerapiid = $id;
		$option = new Simple_Video_Embed_Option();
		$yt->template_params = $option->getMain();
		$yt->youtube_options = $option->getYoutube();
		return $yt;
	}
	
	/**
	 * Initialize the class, set its id and params.
	 *
	 * @since 1.0.0
	 * @param string $id
	 *        	The id of the video or playlist.
	 * @param array $param
	 *        	A array with the youtube object parameter.
	 * @param string $uniqueId
	 *        	A value to append to the end of playerapiid to ensure that it will be unique
	 */
	public static function withParams($id, $params, $uniqueId) {
		$yt = Sve_Youtube::withId( $id );
		$yt->playerapiid .= '-' . $uniqueId;
		if (is_array( $params )) {
			if (isset( $params ['type'] )) {
				$yt->type = $params ['type'];
			}
			if (isset( $params ['autohide'] )) {
				$yt->autohide = $params ['autohide'];
			}
			if (isset( $params ['autoplay'] )) {
				$yt->autoplay = $params ['autoplay'];
			}
			if (isset( $params ['controls'] )) {
				$yt->controls = $params ['controls'];
			}
			if (isset( $params ['enablejsapi'] )) {
				$yt->enablejsapi = $params ['enablejsapi'];
			}
			if (isset( $params ['origin'] )) {
				$yt->origin = $params ['origin'];
			}
			if (isset( $params ['fs'] )) {
				$yt->fs = $params ['fs'];
			}
			if (isset( $params ['list'] )) {
				$yt->list = $params ['list'];
			}
			if (isset( $params ['listType'] )) {
				$yt->listType = $params ['listType'];
			}
			if (isset( $params ['loop'] )) {
				$yt->loop = $params ['loop'];
			}
			if (isset( $params ['playlist'] )) {
				$yt->playlist = $params ['playlist'];
			}
			if (isset( $params ['template'] )) {
				$yt->template = $params ['template'];
			}
			
			foreach ( $yt->template_params as $key => $value ) {
				if (isset( $params [$key] )) {
					$yt->template_params [$key] = $params [$key];
				}
			}
		}
		return $yt;
	}
	
	/**
	 * Return the file template
	 *
	 * @since 1.0.0
	 */
	private function getTemplate() {
		if ($this->type == 'video') {
			return 'partials/yt-single-video.php';
		}
		
		switch ($this->template) {
			case 'video_slider' :
				wp_enqueue_script( "simple-video-embed-carousel", plugin_dir_url( __FILE__ ) . 'js/owl.carousel.js', array (
						'jquery' 
				), "1.0", false );
				$this->enablejsapi = 1;
				$this->autoplay = 1;
				// get api data
				$this->api_data = $this->playlistItemsList( 'contentDetails', null, null );
				return 'partials/yt-playlist-video-slider.php';
				break;
			case 'thumb_slider' :
				wp_enqueue_script( "simple-video-embed-carousel", plugin_dir_url( __FILE__ ) . 'js/owl.carousel.js', array (
						'jquery' 
				), "1.0", false );
				$this->enablejsapi = 1;
				// get api data
				$this->api_data = $this->playlistItemsList( 'snippet', null, null );
				return 'partials/yt-playlist-thumb-slider.php';
				break;
			case "thumb_col" :
				wp_enqueue_script( "simple-video-embed-unveil", plugin_dir_url( __FILE__ ) . 'js/jquery.unveil.js', array (
						'jquery' 
				), "1.0", false );
				$this->enablejsapi = 1;
				// get api data
				$this->api_data = $this->playlistItemsList( 'snippet', null, null );
				return 'partials/yt-playlist-thumb-columns.php';
				break;
			default :
				return 'partials/yt-playlist-no-thumb.php';
		}
	}
	
	/**
	 * Return the url for the iframe
	 *
	 * @since 1.0.0
	 */
	public function getUrl() {
		$url = "https://www.youtube.com/embed";
		
		if ($this->type == 'video') {
			$url .= '/' . $this->id . "?";
		} else {
			$url .= '?listType=playlist&list=' . $this->id . "&";
		}
		
		$url .= 'autohide=' . $this->autohide;
		$url .= '&autoplay=' . $this->autoplay;
		$url .= '&controls=' . $this->controls;
		if ($this->enablejsapi != 0) {
			$url .= '&enablejsapi=' . $this->enablejsapi;
			$url .= '&version=3';
			$url .= '&origin=' . $this->origin;
		}
		
		if ($this->fs == 0) {
			$url .= '&fs=' . $this->fs;
		}
		
		// Add also playlist for Google loop implementation problem
		if ($this->loop == 1) {
			$url .= '&loop=' . $this->loop;
			if ($this->type == 'video') {
				$url .= '&playlist=' . $this->id;
			}
		}
		
		if ($this->playerapiid != null) {
			$url .= '&playerapiid=' . $this->playerapiid;
		}
		return $url;
	}
	
	/**
	 * Return the html to embed
	 *
	 * @since 1.0.0
	 */
	public function getHtml() {
		ob_start();
		include ($this->getTemplate());
		$html = ob_get_clean();
		
		$html = str_replace( "{id}", $this->id, $html );
		$html = str_replace( "{playerapiid}", $this->playerapiid, $html );
		$html = str_replace( "{url}", $this->getUrl(), $html );
		$html = str_replace( "{wpsve-video-carousel-left-arrow}", $this->template_params ['video-carousel-left-arrow'], $html );
		$html = str_replace( "{wpsve-video-carousel-right-arrow}", $this->template_params ['video-carousel-right-arrow'], $html );
		$html = str_replace( "{wpsve-video-carousel-height}", $this->template_params ['video-carousel-height'], $html );
		
		return $html;
	}
	
	/**
	 * Get data from url passed as parameter
	 *
	 * @since 1.0.0
	 * @param string $url
	 *        	Url to fetch data
	 * @return string Fetched data
	 */
	private function get_url_contents($url) {
		
		$result = wp_remote_get( $url, array( 'timeout' => 120, 'httpversion' => '1.1' ) );
		
		if ($result != '' && array_key_exists('body', $result)) {
			$result = $result['body'];
		} else {
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
		}
		return $result;
	}
	
	/**
	 * Call Youtube API playlistItems List.
	 * If maxResults is null return all data.
	 *
	 * @since 1.0.0
	 */
	public function playlistItemsList($part, $maxResults, $pageToken) {
		$result = Array ();
	
		$apiUrl = $this->url . "playlistItems?key=" . $this->youtube_options ['google-public-key-v3'] . "&playlistId=" . $this->id . "&part=" . $part;
	
		$getAll = false;
		if (! isset( $maxResults )) {
			$getAll = true;
			$maxResults = 10;
		}
		$apiUrl .= "&maxResults=" . $maxResults;
	
		if (isset( $pageToken )) {
			$apiUrl .= "&pageToken=" . $pageToken;
		}
	
		$json_data = $this->get_url_contents( $apiUrl );
		$result = json_decode( $json_data, true );
		if ($getAll && isset( $result ["nextPageToken"] )) {
			$json = $this->playlistItemsList( $this->id, $part, null, $result ["nextPageToken"] );
			if (isset( $json ["items"] )) {
				$result ["items"] = array_merge( $result ["items"], $json ["items"] );
			}
		}
		return $result;
	}
	
	/*
	 * 
	 */
	public function toArray() {
		$result = array ();
		$result ['id'] = $this->id;
		$result ['type'] = $this->type;
		$result ['autohide'] = $this->autohide;
		$result ['autoplay'] = $this->autoplay;
		$result ['controls'] = $this->controls;
		$result ['enablejsapi'] = $this->enablejsapi;
		$result ['origin'] = $this->origin;
		$result ['fs'] = $this->fs;
		
		$result ['list'] = $this->list;
		$result ['listType'] = $this->listType;
		$result ['loop'] = $this->loop;
		return get_object_vars( $this );
	}
}
