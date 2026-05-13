<?php
/**
 * Pakistan Legal Solutions Theme — functions.php
 *
 * This file bootstraps the theme. All logic lives in /inc/ files.
 * Keeping this file minimal makes it easy to find and debug anything.
 *
 * @package PakistanLegalSolutions
 * @version 1.0.0
 * @author  Mubeen Mehmood
 */

// Security: prevent direct file access
defined( 'ABSPATH' ) || exit;

// ─── Constants ────────────────────────────────────────────────────────────────
define( 'PLS_VERSION',    wp_get_theme()->get( 'Version' ) );
define( 'PLS_DIR',        get_template_directory() );
define( 'PLS_URI',        get_template_directory_uri() );
define( 'PLS_ASSETS',     PLS_URI . '/assets' );
define( 'PLS_INC',        PLS_DIR . '/inc' );

// ─── Core Theme Setup ─────────────────────────────────────────────────────────
require_once PLS_INC . '/setup.php';         // add_theme_support, image sizes
require_once PLS_INC . '/menus.php';         // register_nav_menus
require_once PLS_INC . '/enqueue.php';       // wp_enqueue_scripts
require_once PLS_INC . '/practice-areas-catalog.php';
require_once PLS_INC . '/helpers.php';       // utility functions

// ─── Content ──────────────────────────────────────────────────────────────────
require_once PLS_INC . '/custom-post-types.php';
require_once PLS_INC . '/custom-taxonomies.php';

// ─── ACF (load only if plugin is active) ─────────────────────────────────────
if ( function_exists( 'acf_add_local_field_group' ) ) {
    require_once PLS_INC . '/acf-fields.php';
}

// ─── Forms & AJAX ─────────────────────────────────────────────────────────────
require_once PLS_INC . '/contact-form-handler.php';
require_once PLS_INC . '/ajax-handlers.php';

// ─── Security ─────────────────────────────────────────────────────────────────
require_once PLS_INC . '/security.php';

// ─── SEO ──────────────────────────────────────────────────────────────────────
require_once PLS_INC . '/seo-meta.php';