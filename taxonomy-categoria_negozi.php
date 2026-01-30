<?php
/**
 * Template per la visualizzazione degli archivi delle categorie dei negozi
 *
 * @package Mongolfiera
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$term = get_queried_object();
if (!$term || !isset($term->term_id)) {
    wp_die(__('Termine non trovato', 'mongolfiera'));
}

$term_id = isset($term->term_id) ? $term->term_id : 0;
$term_name = isset($term->name) ? $term->name : '';
$term_description = term_description($term_id, 'categoria_negozi');

get_template_part('template-parts/negozi-archive-layout', null, [
    'title' => $term_name,
    'description' => $term_description,
    'search_url' => get_term_link($term),
    'current_tag_id' => 0,
    'current_category_id' => $term_id,
]);

get_footer();
