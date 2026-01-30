<?php
defined( 'ABSPATH' ) || exit;

add_filter( 'wpcf7_form_elements', 'do_shortcode' );

if ( ! function_exists( 'mongolfiera_privacy_shortcode' ) ) {
	function mongolfiera_privacy_shortcode( $atts ) {
		$a = shortcode_atts( array(
			'class' => '',
		), $atts );
		return '<a class="' . esc_attr( $a['class'] ) . ' iubenda-nostyle no-brand iubenda-embed" rel="nofollow" href="' . esc_url( get_global_option( 'privacy_policy' ) ) . '" target="_blank">' . esc_html__( 'Privacy Policy', 'mongolfiera' ) . '</a>';
	}
	add_shortcode( 'privacy_link', 'mongolfiera_privacy_shortcode' );
}
