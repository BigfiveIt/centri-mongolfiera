<?php
defined( 'ABSPATH' ) || exit;

// Core tema
require_once 'functions/theme-supports.php';
require_once 'functions/assets.php';

// Registrazioni (CPT, tassonomie, blocchi)
require_once 'functions/post-types/query-helpers.php';
require_once 'functions/post-types/negozi.php';
require_once 'functions/post-types/promozioni.php';
require_once 'functions/post-types/eventi.php';
require_once 'functions/gutenberg-blocks.php';

// Opzioni e utilità
require_once 'functions/global-options.php';
require_once 'functions/acf-options.php';
require_once 'functions/nav-menus.php';
require_once 'functions/image-crops.php';
require_once 'functions/pagination.php';
require_once 'functions/shortcodes.php';
require_once 'functions/utilities.php';

// Admin e frontend
require_once 'functions/dashboard.php';
require_once 'functions/custom-breadcrumbs.php';
require_once 'functions/endpoints.php';


add_filter('wp_all_import_is_enabled_stream_filter', 'wpai_wp_all_import_is_enabled_stream_filter', 10, 1);
function wpai_wp_all_import_is_enabled_stream_filter($enable_strem_filter) {
    return FALSE;
}

add_filter('wp_all_import_csv_to_xml_remove_non_ascii_characters', 'wpai_wp_all_import_csv_to_xml_remove_non_ascii_characters', 10, 1);
function wpai_wp_all_import_csv_to_xml_remove_non_ascii_characters($remove_non_ascii_characters) {
    return FALSE;
}