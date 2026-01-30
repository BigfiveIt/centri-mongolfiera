<?php
/**
 * Post type Negozi e tassonomie (Categoria Negozi, Tag Negozi).
 */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mongolfiera_register_post_type_negozi' ) ) {
	function mongolfiera_register_post_type_negozi() {
		$labels = array(
			'name'                  => _x( 'Negozi', 'Post Type General Name', 'mongolfiera' ),
			'singular_name'         => _x( 'Negozio', 'Post Type Singular Name', 'mongolfiera' ),
			'menu_name'             => __( 'Negozi', 'mongolfiera' ),
			'name_admin_bar'        => __( 'Negozi', 'mongolfiera' ),
			'archives'              => __( 'Archivio Negozi', 'mongolfiera' ),
			'parent_item_colon'     => __( 'Parent Negozi:', 'mongolfiera' ),
			'all_items'             => __( 'Tutti Negozi', 'mongolfiera' ),
			'add_new_item'          => __( 'Aggiungi Nuovo Negozio', 'mongolfiera' ),
			'add_new'               => __( 'Aggiungi Nuovo', 'mongolfiera' ),
			'new_item'              => __( 'Nuovo Negozio', 'mongolfiera' ),
			'edit_item'             => __( 'Modifica Negozio', 'mongolfiera' ),
			'update_item'           => __( 'Aggiorna Negozio', 'mongolfiera' ),
			'view_item'             => __( 'Vedi Negozio', 'mongolfiera' ),
			'search_items'          => __( 'Cerca Negozi', 'mongolfiera' ),
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
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'negozi', 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-cart',
			'supports'           => array( 'title', 'editor', 'excerpt' ),
			'taxonomies'         => array( 'categoria_negozi', 'tag_negozi' ),
		);
		register_post_type( 'negozi', $args );
	}
	add_action( 'init', 'mongolfiera_register_post_type_negozi', 0 );
}

if ( ! function_exists( 'mongolfiera_register_taxonomy_categoria_negozi' ) ) {
	function mongolfiera_register_taxonomy_categoria_negozi() {
		$labels = array(
			'name'                       => _x( 'Categoria Negozi', 'Taxonomy General Name', 'mongolfiera' ),
			'singular_name'              => _x( 'Categoria Negozio', 'Taxonomy Singular Name', 'mongolfiera' ),
			'menu_name'                  => __( 'Categoria Negozi', 'mongolfiera' ),
			'all_items'                  => __( 'Tutte le Categorie', 'mongolfiera' ),
			'parent_item'                => __( 'Parent Item', 'mongolfiera' ),
			'parent_item_colon'          => __( 'Parent Item:', 'mongolfiera' ),
			'new_item_name'              => __( 'New Item Name', 'mongolfiera' ),
			'add_new_item'               => __( 'Aggiungi Nuova Categoria', 'mongolfiera' ),
			'edit_item'                  => __( 'Modifica Categoria', 'mongolfiera' ),
			'update_item'                => __( 'Aggiorna Categoria', 'mongolfiera' ),
			'view_item'                  => __( 'Vedi Categoria', 'mongolfiera' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'mongolfiera' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'mongolfiera' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'mongolfiera' ),
			'popular_items'              => __( 'Popular Items', 'mongolfiera' ),
			'search_items'               => __( 'Search Items', 'mongolfiera' ),
			'not_found'                  => __( 'Not Found', 'mongolfiera' ),
			'no_terms'                   => __( 'No items', 'mongolfiera' ),
			'items_list'                 => __( 'Items list', 'mongolfiera' ),
			'items_list_navigation'      => __( 'Items list navigation', 'mongolfiera' ),
		);
		$args = array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => 'categoria-negozi' ),
		);
		register_taxonomy( 'categoria_negozi', array( 'negozi' ), $args );
	}
	add_action( 'init', 'mongolfiera_register_taxonomy_categoria_negozi', 0 );
}

if ( ! function_exists( 'mongolfiera_register_taxonomy_tag_negozi' ) ) {
	function mongolfiera_register_taxonomy_tag_negozi() {
		$labels = array(
			'name'                       => _x( 'Tag Negozi', 'Taxonomy General Name', 'mongolfiera' ),
			'singular_name'              => _x( 'Tag Negozio', 'Taxonomy Singular Name', 'mongolfiera' ),
			'menu_name'                  => __( 'Tag Negozi', 'mongolfiera' ),
			'all_items'                  => __( 'Tutti i Tag', 'mongolfiera' ),
			'parent_item'                => __( 'Parent Item', 'mongolfiera' ),
			'parent_item_colon'          => __( 'Parent Item:', 'mongolfiera' ),
			'new_item_name'              => __( 'Nuovo Tag', 'mongolfiera' ),
			'add_new_item'               => __( 'Aggiungi Nuovo Tag', 'mongolfiera' ),
			'edit_item'                  => __( 'Modifica Tag', 'mongolfiera' ),
			'update_item'                => __( 'Aggiorna Tag', 'mongolfiera' ),
			'view_item'                  => __( 'Vedi Tag', 'mongolfiera' ),
			'separate_items_with_commas' => __( 'Separa i tag con virgole', 'mongolfiera' ),
			'add_or_remove_items'        => __( 'Aggiungi o rimuovi tag', 'mongolfiera' ),
			'choose_from_most_used'      => __( 'Scegli tra i più usati', 'mongolfiera' ),
			'popular_items'              => __( 'Tag Popolari', 'mongolfiera' ),
			'search_items'               => __( 'Cerca Tag', 'mongolfiera' ),
			'not_found'                  => __( 'Non Trovato', 'mongolfiera' ),
			'no_terms'                   => __( 'Nessun tag', 'mongolfiera' ),
			'items_list'                 => __( 'Lista tag', 'mongolfiera' ),
			'items_list_navigation'      => __( 'Navigazione lista tag', 'mongolfiera' ),
		);
		$args = array(
			'labels'            => $labels,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'rewrite'           => array( 'slug' => 'tag-negozi' ),
		);
		register_taxonomy( 'tag_negozi', array( 'negozi' ), $args );
	}
		add_action( 'init', 'mongolfiera_register_taxonomy_tag_negozi', 0 );
}

/**
 * Mostra tutti i negozi negli archivi (archivio CPT e tassonomie).
 */
if ( ! function_exists( 'mongolfiera_negozi_archive_show_all' ) ) {
	function mongolfiera_negozi_archive_show_all( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}
		if ( is_post_type_archive( 'negozi' ) || is_tax( 'tag_negozi' ) || is_tax( 'categoria_negozi' ) ) {
			$query->set( 'posts_per_page', -1 );
		}
	}
	add_action( 'pre_get_posts', 'mongolfiera_negozi_archive_show_all' );
}
