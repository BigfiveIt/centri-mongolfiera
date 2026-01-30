<?php
/**
 * Post type Promozioni, tassonomia Categoria Promozioni e filtro archivio.
 */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mongolfiera_register_taxonomy_categoria_promozioni' ) ) {
	function mongolfiera_register_taxonomy_categoria_promozioni() {
		$labels = array(
			'name'                       => _x( 'Categoria Promozioni', 'Taxonomy General Name', 'mongolfiera' ),
			'singular_name'              => _x( 'Categoria Promozione', 'Taxonomy Singular Name', 'mongolfiera' ),
			'menu_name'                  => __( 'Categoria Promozioni', 'mongolfiera' ),
			'all_items'                  => __( 'Tutte le Categorie', 'mongolfiera' ),
			'parent_item'                => __( 'Parent Item', 'mongolfiera' ),
			'parent_item_colon'          => __( 'Parent Item:', 'mongolfiera' ),
			'new_item_name'              => __( 'Nuova Categoria', 'mongolfiera' ),
			'add_new_item'               => __( 'Aggiungi Nuova Categoria', 'mongolfiera' ),
			'edit_item'                  => __( 'Modifica Categoria', 'mongolfiera' ),
			'update_item'                => __( 'Aggiorna Categoria', 'mongolfiera' ),
			'view_item'                  => __( 'Vedi Categoria', 'mongolfiera' ),
			'separate_items_with_commas' => __( 'Separa con virgole', 'mongolfiera' ),
			'add_or_remove_items'        => __( 'Aggiungi o rimuovi', 'mongolfiera' ),
			'choose_from_most_used'      => __( 'Scegli tra i più usati', 'mongolfiera' ),
			'popular_items'              => __( 'Categorie popolari', 'mongolfiera' ),
			'search_items'               => __( 'Cerca categorie', 'mongolfiera' ),
			'not_found'                  => __( 'Non trovato', 'mongolfiera' ),
			'no_terms'                   => __( 'Nessuna categoria', 'mongolfiera' ),
			'items_list'                 => __( 'Lista categorie', 'mongolfiera' ),
			'items_list_navigation'      => __( 'Navigazione lista', 'mongolfiera' ),
		);
		$args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => 'categoria-promozioni' ),
		);
		register_taxonomy( 'categoria_promozioni', array( 'promozioni' ), $args );
	}
	add_action( 'init', 'mongolfiera_register_taxonomy_categoria_promozioni', 0 );
}

if ( ! function_exists( 'mongolfiera_register_post_type_promozioni' ) ) {
	function mongolfiera_register_post_type_promozioni() {
		$labels = array(
			'name'                  => _x( 'Promozioni', 'Post Type General Name', 'mongolfiera' ),
			'singular_name'         => _x( 'Promozione', 'Post Type Singular Name', 'mongolfiera' ),
			'menu_name'             => __( 'Promozioni', 'mongolfiera' ),
			'name_admin_bar'        => __( 'Promozioni', 'mongolfiera' ),
			'archives'              => __( 'Archivio Promozioni', 'mongolfiera' ),
			'parent_item_colon'     => __( 'Parent Promozione:', 'mongolfiera' ),
			'all_items'             => __( 'Tutte le Promozioni', 'mongolfiera' ),
			'add_new_item'          => __( 'Aggiungi Nuova Promozione', 'mongolfiera' ),
			'add_new'               => __( 'Aggiungi Nuovo', 'mongolfiera' ),
			'new_item'              => __( 'Nuova Promozione', 'mongolfiera' ),
			'edit_item'             => __( 'Modifica Promozione', 'mongolfiera' ),
			'update_item'           => __( 'Aggiorna Promozione', 'mongolfiera' ),
			'view_item'             => __( 'Vedi Promozione', 'mongolfiera' ),
			'search_items'          => __( 'Cerca Promozioni', 'mongolfiera' ),
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
			'rewrite'            => array( 'slug' => 'promozioni', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-calendar',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'taxonomies'         => array( 'categoria_promozioni' ),
		);
		register_post_type( 'promozioni', $args );
	}
	add_action( 'init', 'mongolfiera_register_post_type_promozioni', 0 );
}

if ( ! function_exists( 'mongolfiera_filter_promozioni_archive' ) ) {
	function mongolfiera_filter_promozioni_archive( $query ) {
		if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'promozioni' ) ) {
			$today = date( 'Ymd' );
			$stato = isset( $_GET['stato'] ) ? sanitize_text_field( wp_unslash( $_GET['stato'] ) ) : '';
			mongolfiera_apply_date_archive_meta_query( $query, $today, ( $stato === 'passate' ) );
		}
	}
	add_action( 'pre_get_posts', 'mongolfiera_filter_promozioni_archive' );
}
