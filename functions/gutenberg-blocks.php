<?php
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mongolfiera_carica_google_fonts' ) ) {
	function mongolfiera_carica_google_fonts() {
		wp_enqueue_style(
			'google-fonts',
			'https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Bricolage+Grotesque:ital,wght@0,200..800;1,200..800&display=swap',
			array(),
			null
		);
	}
	add_action( 'enqueue_block_assets', 'mongolfiera_carica_google_fonts' );
}

add_action( 'acf/init', 'mongolfiera_acf_register_blocks' );
if ( ! function_exists( 'mongolfiera_acf_register_blocks' ) ) {
	function mongolfiera_acf_register_blocks() {
		foreach ( glob( dirname( __DIR__, 1 ) . '/blocks/*/block.json' ) as $block ) {
			register_block_type( $block );
		}
	}
}

if ( ! function_exists( 'mongolfiera_disable_editor_for_template' ) ) {
	function mongolfiera_disable_editor_for_template( $id = false ) {
		$excluded_templates = array(
			'page-templates/page-home.php'
		);
		if ( empty( $id ) ) {
			return false;
		}
		$id       = (int) $id;
		$template = get_page_template_slug( $id );
		return in_array( $template, $excluded_templates, true );
	}
}

add_filter( 'use_block_editor_for_post_type', 'mongolfiera_disable_gutenberg_for_page', 10, 2 );
if ( ! function_exists( 'mongolfiera_disable_gutenberg_for_page' ) ) {
	function mongolfiera_disable_gutenberg_for_page( $current_status, $post_type ) {
		global $post;
		if ( $post && 'page' === $post_type && mongolfiera_disable_editor_for_template( $post->ID ) ) {
			return false;
		}
		return $current_status;
	}
}
