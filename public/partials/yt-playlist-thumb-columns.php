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
		<iframe class="wpsve-iframe wpsve-youtube-iframe" id="{playerapiid}"
			src="{url}" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	</div>


<?php
if (array_key_exists( 'items', $this->api_data )) {
	$col_class = "wpsve-column_1_of_" . $this->template_params ['thumb-columns-number'] . " wpsve-col-" . $this->template_params ['thumb-columns-number'];
	// Chunk json array
	$col_data = array_chunk( $this->api_data ['items'], $this->template_params ['thumb-columns-number'] );
	$i = 0;
	foreach ( $col_data as $row ) {
		?>
	<div class="wpsve-section wpsve-group">
<?php
		foreach ( $row as $col ) {
			$snippet = $col ['snippet'];
			?>	
	<div class="wpsve-item wpsve-col <?php echo $col_class;?>"
			onClick="wpsvePlayers['{playerapiid}'].playVideoAt(<?php echo $i;?>);jQuery('html, body').animate({scrollTop: (jQuery('#{playerapiid}').offset().top)},500);">
			<div class="wpsve-thumb">
				<img
					src="<?php echo plugin_dir_url ( __FILE__ ) ?>../img/video-thumb-placeholder.jpg"
					data-src="<?php echo $snippet['thumbnails']['medium']['url']; ?>" 
					title="<?php echo $snippet['title']; ?>"
					alt="<?php echo $snippet['title']; ?>" />
			</div>
			<?php if ($this->template_params ['thumb_title'] == '1') {?>
			<div class="wpsve-desc">
 	    		<?php echo $snippet['title']; ?>
 	    	</div>
 	    	<?php }?>
		</div>	
<?php
			$i ++;
		}
		
		?>	
	</div>
	<?php
	}
}

if (array_key_exists( 'error', $this->api_data )) {
    $api_data = $this->api_data;
?>
<div id="message" class="wpsve-error">
<b>Google Api Error:</b> <?php echo $api_data['error']['message'];?>
</div>
<?php
}
?>	
</div>