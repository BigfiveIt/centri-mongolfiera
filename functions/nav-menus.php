<?php
/**
 * Registrazione menu di navigazione.
 */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mongolfiera_register_nav_menu' ) ) {
	function mongolfiera_register_nav_menu() {
		register_nav_menus( array(
			'primary-menu'  => __( 'Primary Menu', 'mongolfiera' ),
			'footer-menu-1'  => __( 'Footer Menu 1', 'mongolfiera' ),
			'footer-menu-2'  => __( 'Footer Menu 2', 'mongolfiera' ),
			'footer-menu-3'  => __( 'Footer Menu 3', 'mongolfiera' ),
		) );
	}
	add_action( 'after_setup_theme', 'mongolfiera_register_nav_menu', 0 );
}
