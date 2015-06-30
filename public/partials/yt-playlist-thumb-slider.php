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


	<div class="wpsve-wrapper-with-margin">
		<div class="owl-carousel owl-carousel-{playerapiid}">
	<?php
	if (array_key_exists( 'items', $this->api_data )) {
		$i = 0;
		foreach ( $this->api_data ['items'] as $item ) {
			$snippet = $item ['snippet'];
			?>
			<div class="wpsve-item"
				onClick="wpsvePlayers['{playerapiid}'].playVideoAt(<?php echo $i;?>);">
				<div class="wpsve-thumb">
					<img src="<?php echo $snippet['thumbnails']['default']['url']; ?>" />
				</div>
				<?php if ($this->template_params ['thumb_title'] == '1') {?>
				<div class="wpsve-desc">
		 	    	<?php esc_attr_e ($snippet['title']); ?>
		 	    </div>
				<?php }?>
			</div>
	<?php $i++; }} ?>
	
		</div>
	</div>
    <?php
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

<script>
jQuery(document).ready(function() {
	jQuery(".owl-carousel-{playerapiid}").owlCarousel({
		margin : 10,
		loop : true,
		center : true,
		lazyLoad : false,
		responsiveClass : true,
		nav : true,
		dotsEach : true,
		navText : [ '{wpsve-video-carousel-left-arrow}', '{wpsve-video-carousel-right-arrow}' ],
		responsive : {
			480 : {
				items : 2
			},
			600 : {
				items : 4
			}
		}
	});
});
</script>

