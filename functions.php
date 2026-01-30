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
