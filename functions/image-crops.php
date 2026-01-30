<?php
defined( 'ABSPATH' ) || exit;

add_image_size( 'hero-slider', 1400, 660, true );

add_filter( 'image_size_names_choose', 'mongolfiera_custom_image_sizes' );
if ( ! function_exists( 'mongolfiera_custom_image_sizes' ) ) {
	function mongolfiera_custom_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'hero-slider' => __( 'Hero Slider', 'mongolfiera' ),
		) );
	}
}
