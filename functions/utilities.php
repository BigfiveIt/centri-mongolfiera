<?php
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mongolfiera_current_year_shortcode' ) ) {
	function mongolfiera_current_year_shortcode( $atts ) {
		return date( 'Y' );
	}
	add_shortcode( 'current_year', 'mongolfiera_current_year_shortcode' );
}

if ( ! function_exists( 'mongolfiera_yoast_metabox_priority' ) ) {
	function mongolfiera_yoast_metabox_priority() {
		return 'low';
	}
	add_filter( 'wpseo_metabox_prio', 'mongolfiera_yoast_metabox_priority' );
}

add_filter( 'rank_math/metabox/priority', function( $priority ) {
	return 'low';
});

if ( ! function_exists( 'mongolfiera_excerpt' ) ) {
	function mongolfiera_excerpt( $limit, $postid = null ) {
		if ( $postid === null ) {
			$postid = get_the_ID();
		}
		$excerpt_text = get_the_excerpt( $postid );
		if ( empty( $excerpt_text ) ) {
			return '';
		}
		$excerpt = explode( ' ', $excerpt_text, $limit + 1 );
		if ( count( $excerpt ) > $limit ) {
			array_pop( $excerpt );
			$excerpt = implode( ' ', $excerpt ) . '...';
		} else {
			$excerpt = implode( ' ', $excerpt );
		}
		$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
		return $excerpt;
	}
}

add_filter( 'wpcf7_autop_or_not', '__return_false' );

if ( ! function_exists( 'mongolfiera_generate_random_string' ) ) {
	function mongolfiera_generate_random_string( $minWords = 30, $maxWords = 60 ) {
		$words = array(
			'Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur',
			'adipiscing', 'elit', 'sed', 'do', 'eiusmod', 'tempor',
			'incididunt', 'ut', 'labore', 'et', 'dolore', 'magna', 'aliqua',
		);
		$wordCount     = rand( $minWords, $maxWords );
		$selectedWords = array();
		for ( $i = 0; $i < $wordCount; $i++ ) {
			$randomIndex     = array_rand( $words );
			$selectedWords[] = $words[ $randomIndex ];
		}
		return implode( ' ', $selectedWords );
	}
}

if ( ! function_exists( 'mongolfiera_phone_cleaner' ) ) {
	function mongolfiera_phone_cleaner( $phonenumber ) {
		$notvalidevalue = array( ' ', '.' );
		return str_replace( $notvalidevalue, '', (string) $phonenumber );
	}
}

/**
 * Filtra la query di ricerca per mostrare solo negozi quando si è nelle pagine di archivio/tassonomia negozi
 */
if ( ! function_exists( 'mongolfiera_filter_search_negozi' ) ) {
	function mongolfiera_filter_search_negozi( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}
		if ( ! isset( $_GET['s'] ) || empty( $_GET['s'] ) ) {
			return;
		}
		if ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'negozi' ) {
			$query->set( 'post_type', 'negozi' );
			return;
		}
		if ( is_post_type_archive( 'negozi' ) || is_tax( 'tag_negozi' ) || is_tax( 'categoria_negozi' ) ) {
			$query->set( 'post_type', 'negozi' );
		}
	}
	add_action( 'pre_get_posts', 'mongolfiera_filter_search_negozi' );
}

/**
 * Usa il template unificato per le ricerche dei negozi
 */
if ( ! function_exists( 'mongolfiera_search_negozi_template' ) ) {
	function mongolfiera_search_negozi_template( $template ) {
		if ( ! is_search() ) {
			return $template;
		}
		if ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'negozi' ) {
			$new_template = locate_template( array( 'archive-negozi-search.php' ) );
			if ( $new_template ) {
				return $new_template;
			}
		}
		return $template;
	}
	add_filter( 'template_include', 'mongolfiera_search_negozi_template' );
}
