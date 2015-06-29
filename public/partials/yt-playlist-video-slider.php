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
	<div class="wpsve-wrapper-with-margin">
		<div class="owl-video-carousel owl-carousel-{playerapiid}">
	<?php
	if (array_key_exists( 'items', $this->api_data )) {
		foreach ( $this->api_data ['items'] as $item ) {
			$contentDetails = $item ['contentDetails'];
			$param = $this->toArray();
			$param ["type"] = 'video';
			$param ["autoplay"] = 1;
			$param ["loop"] = 0;
			$s = Sve_Youtube::withParams( $item ['contentDetails'] ["videoId"], $param, "1" );
			?>
			<div class="item-video" data-merge="3">
				<a class="owl-video" href="<?php echo $s->getUrl(); ?>"></a>
			</div>
	<?php
		}
	}
	?>
		</div>
	</div>
	<script>
		jQuery(document).ready(function() {
			jQuery(".owl-carousel-{playerapiid}").owlCarousel({
					margin : 10,
					items : 1,
					video : true,
					loop : true,
					center : true,
					lazyLoad : true,
					merge: true,
					nav : true,
					videoHeight: '{wpsve-video-carousel-height}',
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
			jQuery('.item-video').css('height', '{wpsve-video-carousel-height}px');
			jQuery('.owl-carousel-{playerapiid} .owl-prev').css('top',( {wpsve-video-carousel-height}/2 - jQuery('.owl-carousel-{playerapiid} .owl-prev').height()) +'px');
			jQuery('.owl-carousel-{playerapiid} .owl-next').css('top',( {wpsve-video-carousel-height}/2 - jQuery('.owl-carousel-{playerapiid} .owl-next').height()) +'px');
			
			});
	</script>

</div>

