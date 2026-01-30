<?php
/**
 * Template per la visualizzazione dei risultati di ricerca per i negozi
 *
 * @package Mongolfiera
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$search_query = get_search_query();
$archive_url = get_post_type_archive_link('negozi');

$title = sprintf(
    /* translators: %s: query term */
    __( 'Risultati ricerca negozi: "%s"', 'mongolfiera' ),
    esc_html($search_query)
);

get_template_part('template-parts/negozi-archive-layout', null, [
    'title' => $title,
    'description' => '',
    'search_url' => $archive_url,
    'current_tag_id' => 0,
    'current_category_id' => 0,
]);

get_footer();
