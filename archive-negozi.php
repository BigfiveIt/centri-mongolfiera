<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$archive_url = get_post_type_archive_link('negozi');

get_template_part('template-parts/negozi-archive-layout', null, [
    'title' => __('I Negozi del Centro','mongolfiera'),
    'description' => '',
    'search_url' => $archive_url,
    'current_tag_id' => 0,
    'current_category_id' => 0,
]);

get_footer();