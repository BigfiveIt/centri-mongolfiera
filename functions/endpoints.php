<?php
defined( 'ABSPATH' ) || exit;

add_action( 'rest_api_init', function () {
	register_rest_route( 'wp/v2', '/theme-classes', array(
		'methods'             => 'GET',
		'callback'            => function () {
			$styles = wp_get_global_stylesheet( array( 'variables', 'presets', 'styles' ) );
			return new WP_REST_Response( array( $styles ), 200 );
		},
		'permission_callback' => '__return_true',
	) );
});

if ( ! function_exists( 'mongolfiera_generate_gutenberg_global_styles_css' ) ) {
	function mongolfiera_generate_gutenberg_global_styles_css() {
		static $file_cache = null;
		$styles = wp_get_global_stylesheet( array( 'variables', 'presets', 'styles' ) );
		$file  = get_stylesheet_directory() . '/gutenberg-global-styles.css';
		if ( ! empty( $styles ) ) {
			if ( $file_cache === null ) {
				$file_cache = file_exists( $file ) ? file_get_contents( $file ) : '';
			}
			if ( $file_cache !== $styles ) {
				file_put_contents( $file, $styles );
				$file_cache = $styles;
			}
		}
	}
	add_action( 'after_setup_theme', 'mongolfiera_generate_gutenberg_global_styles_css' );
}
