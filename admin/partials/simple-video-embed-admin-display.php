<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/Almalerik
 * @since      1.0.0
 *
 * @package    Simple_Video_Embed
 * @subpackage Simple_Video_Embed/admin/partials
 */
?>
<?php

$active_tab = isset( $_GET ['tab'] ) ? $_GET ['tab'] : 'general';
?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	
	<p><span class="dashicons dashicons-heart"></span><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=K5Z25CMCNEUDN" target="_blank">Help this plugin, make a donation!</a></p>
	<p><span class="dashicons dashicons-megaphone"></span><a href="https://github.com/Almalerik/wp-simple-video-embed/issues" target="_blank">Issues</a></p>
	<h2 class="nav-tab-wrapper">
		<a href="?page=simple-video-embed&tab=general"
			class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General</a>
		<a href="?page=simple-video-embed&tab=youtube"
			class="nav-tab <?php echo $active_tab == 'youtube' ? 'nav-tab-active' : ''; ?>">Youtube</a>
	</h2>

	<form action="options.php" method="POST">
    
    <?php
				$option = new Simple_Video_Embed_Option( $this->plugin_name, $this->version );
				switch ($active_tab) {
					case "youtube" :
						settings_fields( 'wpsve-youtube' );
						do_settings_sections( 'wpsve-youtube' );
						?>
	    <table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="wpsve-google-public-key-v3"><?php _e('Google Public Api Key (V3)', $this->plugin_name )  ?></label>
					</th>
					<td><input name="wpsve-youtube[google-public-key-v3]" type="text"
						id="wpsve-google-public-key-v3"
						value="<?php echo esc_attr( $option -> getYoutube()['google-public-key-v3'] ); ?>"
						class="regular-text"></td>
				</tr>
			</tbody>
		</table>
	<?php
						break;
					default :
						settings_fields( 'wpsve-main' );
						do_settings_sections( 'wpsve-main' );
						?>
	    <table class="form-table">
			<tbody>
				<tr>
					<td style="width: 300px;"><label for="default-thumb-columns-number"><?php _e('Default thumbnail columns number', $this->plugin_name )  ?></label>
					</td>
					<td><input name="wpsve-main[thumb-columns-number]" type="text"
						id="default-thumb-columns-number"
						value="<?php echo esc_attr( $option -> getMain()['thumb-columns-number']); ?>"
						class="small-text"></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<th style="width: auto;"><h3><?php _e('Carousel', $this->plugin_name ); ?></h3></th>
					<td></td>
				</tr>
				<tr>
					<td style="width: auto;"><label for="wpsve-video-carousel-height"><?php _e('Video carousel default height', $this->plugin_name )  ?></label>
					</td>
					<td><input name="wpsve-main[video-carousel-height]"
						type="text" id="wpsve-video-carousel-height"
						value="<?php echo esc_attr(  $option -> getMain()['video-carousel-height'] ); ?>"
						class="small-text">px</td>
				</tr>
				<tr>
					<td style="width: auto;"><label
						for="wpsve-video-carousel-left-arrow"><?php _e('Carousel left arrow (html enabled)', $this->plugin_name )  ?></label>
					</td>
					<td><input name="wpsve-main[video-carousel-left-arrow]"
						type="text" id="wpsve-video-carousel-left-arrow"
						value="<?php echo esc_attr(  $option -> getMain()['video-carousel-left-arrow'] ); ?>"
						class="large-text"></td>
				</tr>
				<tr>
					<td style="width: auto;"><label
						for="wpsve-video-carousel-right-arrow"><?php _e('Carousel right arrow (html enabled)', $this->plugin_name )  ?></label>
					</td>
					<td><input name="wpsve-main[video-carousel-right-arrow]"
						type="text" id="wpsve-video-carousel-right-arrow"
						value="<?php echo esc_attr(  $option -> getMain()['video-carousel-right-arrow'] ); ?>"
						class="large-text"></td>
				</tr>
			</tbody>
		</table>
	<?php
				}
				submit_button( __( 'Save', $this->plugin_name ) );
				?>
    </form>
</div>