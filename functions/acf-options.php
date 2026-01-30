<?php
/**
 * Pagine opzioni ACF (Impostazioni Sito, Header, Footer).
 */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'acf_add_options_page' ) ) {
	return;
}

acf_add_options_page( array(
	'page_title' => 'Impostazioni Generali del Sito',
	'menu_title' => 'Impostazioni Sito',
	'menu_slug'  => 'impostazioni-generali',
	'capability' => 'edit_posts',
	'redirect'   => false,
) );

acf_add_options_sub_page( array(
	'page_title'  => 'Impostazioni Header del Sito',
	'menu_title'  => 'Header',
	'parent_slug' => 'impostazioni-generali',
) );

acf_add_options_sub_page( array(
	'page_title'  => 'Impostazioni Footer del Sito',
	'menu_title'  => 'Footer',
	'parent_slug' => 'impostazioni-generali',
) );
