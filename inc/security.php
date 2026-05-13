<?php
defined( 'ABSPATH' ) || exit;

// ── Remove WordPress fingerprints ──────────────────────────────────────────
remove_action( 'wp_head', 'wp_generator' );           // Remove WP version
remove_action( 'wp_head', 'rsd_link' );               // Remove RSD link
remove_action( 'wp_head', 'wlwmanifest_link' );       // Remove WLW manifest
remove_action( 'wp_head', 'wp_shortlink_wp_head' );   // Remove shortlink
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );

// ── Disable XML-RPC (common attack vector) ─────────────────────────────────
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_xmlrpc_server_class', '__return_false' );

// ── Disable file editing from WP Admin ────────────────────────────────────
// Also add this to wp-config.php: define('DISALLOW_FILE_EDIT', true);

// ── Hide login page hint ───────────────────────────────────────────────────
function pls_obscure_login_error(): string {
    return __( 'Invalid credentials.', 'pakistan-legal-solutions' );
}
add_filter( 'login_errors', 'pls_obscure_login_error' );

// ── Limit login attempts (basic) ───────────────────────────────────────────
// Use Wordfence plugin for proper brute force protection.

// ── Remove WordPress version from scripts/styles ──────────────────────────
function pls_remove_version_query( string $src ): string {
    if ( strpos( $src, '?ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'style_loader_src',  'pls_remove_version_query', 9999 );
add_filter( 'script_loader_src', 'pls_remove_version_query', 9999 );

// ── Add security headers ───────────────────────────────────────────────────
// Better done at Nginx/Apache level on Hostinger, but this helps too:
function pls_security_headers(): void {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1; mode=block' );
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
}
add_action( 'send_headers', 'pls_security_headers' );

// ── Disable REST API for unauthenticated users (optional, stricter) ────────
// Uncomment if you don't need public REST API access:
// add_filter( 'rest_authentication_errors', function( $result ) {
//     if ( ! is_user_logged_in() ) {
//         return new WP_Error( 'rest_not_logged_in', 'You must be logged in.', [ 'status' => 401 ] );
//     }
//     return $result;
// } );