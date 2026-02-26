<?php
/**
 * Post type Eventi e filtro archivio.
 */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mongolfiera_register_post_type_eventi' ) ) {
	function mongolfiera_register_post_type_eventi() {
		$labels = array(
			'name'                  => _x( 'News & Eventi', 'Post Type General Name', 'mongolfiera' ),
			'singular_name'         => _x( 'News & Evento', 'Post Type Singular Name', 'mongolfiera' ),
			'menu_name'             => __( 'News & Eventi', 'mongolfiera' ),
			'name_admin_bar'        => __( 'News & Eventi', 'mongolfiera' ),
			'archives'              => __( 'Archivio News & Eventi', 'mongolfiera' ),
			'parent_item_colon'     => __( 'Parent News & Evento:', 'mongolfiera' ),
			'all_items'             => __( 'Tutti gli News & Eventi', 'mongolfiera' ),
			'add_new_item'          => __( 'Aggiungi Nuovo News & Evento', 'mongolfiera' ),
			'add_new'               => __( 'Aggiungi Nuovo', 'mongolfiera' ),
			'new_item'              => __( 'Nuovo News & Evento', 'mongolfiera' ),
			'edit_item'             => __( 'Modifica News & Evento', 'mongolfiera' ),
			'update_item'           => __( 'Aggiorna News & Evento', 'mongolfiera' ),
			'view_item'             => __( 'Vedi News & Evento', 'mongolfiera' ),
			'search_items'          => __( 'Cerca News & Eventi', 'mongolfiera' ),
			'not_found'             => __( 'Non Trovato', 'mongolfiera' ),
			'not_found_in_trash'    => __( 'Non Trovato nel Cestino', 'mongolfiera' ),
			'featured_image'        => __( 'Immagine in Evidenza', 'mongolfiera' ),
			'set_featured_image'    => __( 'Imposta Immagine in Evidenza', 'mongolfiera' ),
			'remove_featured_image' => __( 'Rimuovi Immagine in Evidenza', 'mongolfiera' ),
			'use_featured_image'    => __( 'Use as featured image', 'mongolfiera' ),
			'insert_into_item'      => __( 'Insert into item', 'mongolfiera' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'mongolfiera' ),
			'items_list'            => __( 'Items list', 'mongolfiera' ),
			'items_list_navigation' => __( 'Items list navigation', 'mongolfiera' ),
			'filter_items_list'     => __( 'Filter items list', 'mongolfiera' ),
		);
		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'mongolfiera' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'news-e-eventi', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-calendar',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		);
		register_post_type( 'eventi', $args );
	}
	add_action( 'init', 'mongolfiera_register_post_type_eventi', 0 );
}

if ( ! function_exists( 'mongolfiera_register_taxonomy_categoria_eventi' ) ) {
	function mongolfiera_register_taxonomy_categoria_eventi() {
		$labels = array(
			'name'              => _x( 'Categorie News & Eventi', 'Taxonomy General Name', 'mongolfiera' ),
			'singular_name'     => _x( 'Categoria', 'Taxonomy Singular Name', 'mongolfiera' ),
			'menu_name'         => __( 'Categorie', 'mongolfiera' ),
			'all_items'         => __( 'Tutte le Categorie', 'mongolfiera' ),
			'new_item_name'     => __( 'Nuova Categoria', 'mongolfiera' ),
			'add_new_item'      => __( 'Aggiungi Nuova Categoria', 'mongolfiera' ),
			'edit_item'         => __( 'Modifica Categoria', 'mongolfiera' ),
			'update_item'       => __( 'Aggiorna Categoria', 'mongolfiera' ),
			'view_item'         => __( 'Vedi Categoria', 'mongolfiera' ),
			'search_items'      => __( 'Cerca Categoria', 'mongolfiera' ),
			'not_found'         => __( 'Non Trovata', 'mongolfiera' ),
		);
		$args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => false,
			'rewrite'           => array( 'slug' => 'categoria-news-e-eventi', 'with_front' => false ),
		);
		register_taxonomy( 'categoria-eventi', array( 'eventi' ), $args );
	}
	add_action( 'init', 'mongolfiera_register_taxonomy_categoria_eventi', 0 );
}

if ( ! function_exists( 'mongolfiera_filter_eventi_archive' ) ) {
	function mongolfiera_filter_eventi_archive( $query ) {
		if ( ! is_admin() && $query->is_main_query() && ( is_post_type_archive( 'eventi' ) || is_tax( 'categoria-eventi' ) ) ) {
			$today = date( 'Ymd' );
			$stato = isset( $_GET['stato'] ) ? sanitize_text_field( wp_unslash( $_GET['stato'] ) ) : '';
			mongolfiera_apply_date_archive_meta_query( $query, $today, ( $stato === 'passate' ) );
		}
	}
	add_action( 'pre_get_posts', 'mongolfiera_filter_eventi_archive' );
}
