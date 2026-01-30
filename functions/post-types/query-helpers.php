<?php
/**
 * Helper per filtri archivio per data (promozioni / eventi).
 */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mongolfiera_apply_date_archive_meta_query' ) ) {
	/**
	 * Applica a $query la meta_query e ordinamento per archivio “per data” (data_inizio/data_fine).
	 *
	 * @param WP_Query $query         Query da modificare.
	 * @param string  $today         Data oggi in formato Ymd.
	 * @param bool    $stato_passate  True per “passate”, false per attive/future.
	 */
	function mongolfiera_apply_date_archive_meta_query( $query, $today, $stato_passate ) {
		$meta_query = array( 'relation' => 'AND' );
		if ( $stato_passate ) {
			$meta_query[] = array(
				'relation' => 'OR',
				array(
					'key'     => 'data_fine',
					'value'   => $today,
					'compare' => '<',
				),
				array(
					'relation' => 'AND',
					array( 'key' => 'data_fine', 'compare' => 'NOT EXISTS' ),
					array( 'key' => 'data_inizio', 'value' => $today, 'compare' => '<' ),
				),
			);
			$query->set( 'meta_key', 'data_inizio' );
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'order', 'DESC' );
		} else {
			$meta_query[] = array(
				'relation' => 'OR',
				array(
					'key'     => 'data_fine',
					'value'   => $today,
					'compare' => '>=',
				),
				array(
					'relation' => 'AND',
					array( 'key' => 'data_fine', 'compare' => 'NOT EXISTS' ),
					array( 'key' => 'data_inizio', 'value' => $today, 'compare' => '>=' ),
				),
			);
			$query->set( 'meta_key', 'data_inizio' );
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'order', 'ASC' );
		}
		$query->set( 'meta_query', $meta_query );
	}
}
