<?php
defined( 'ABSPATH' ) || exit;

function pls_enqueue_scripts(): void {

    // ── Styles ─────────────────────────────────────────────────────────────

    // Google Fonts — loaded from Google CDN
    // For GDPR compliance, self-host instead (see /assets/fonts/)
    wp_enqueue_style(
        'pls-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'pls-main',
        PLS_ASSETS . '/css/main.css',
        [ 'pls-google-fonts' ],
        PLS_VERSION
    );

    // ── Scripts ────────────────────────────────────────────────────────────

    // Deregister jQuery from footer (we use vanilla JS)
    // wp_deregister_script( 'jquery' );
    // Note: Some plugins need jQuery. Deregister carefully.

    // Main JS — loaded in footer, deferred
    wp_enqueue_script(
        'pls-main',
        PLS_ASSETS . '/js/main.js',
        [], // no dependencies
        PLS_VERSION,
        [ 'in_footer' => true, 'strategy' => 'defer' ]
    );

    // Pass PHP data to JavaScript (AJAX URL, nonce, etc.)
    wp_localize_script( 'pls-main', 'plsData', [
        'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
        'nonce'     => wp_create_nonce( 'pls_nonce' ),
        'homeUrl'   => home_url(),
        'themeUrl'  => PLS_URI,
        'isHome'    => is_front_page() ? 'true' : 'false',
    ] );

    // Page-specific scripts (only load where needed)
    $is_contact_page = is_page_template( 'template-contact.php' ) || is_page( 'contact' );
    if ( $is_contact_page ) {
        wp_enqueue_script(
            'pls-contact',
            PLS_ASSETS . '/js/modules/contact-form.js',
            [ 'pls-main' ],
            PLS_VERSION,
            [ 'in_footer' => true, 'strategy' => 'defer' ]
        );
    }
}
add_action( 'wp_enqueue_scripts', 'pls_enqueue_scripts' );

// Remove Gutenberg block styles (we don't use them)
function pls_dequeue_block_styles(): void {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'pls_dequeue_block_styles', 100 );

// ── Critical CSS (inline above-the-fold styles) ────────────────────────────
function pls_inline_critical_css(): void {
    $critical_file = PLS_DIR . '/assets/css/critical.css';
    if ( file_exists( $critical_file ) ) {
        echo '<style id="pls-critical">';
        echo file_get_contents( $critical_file ); // phpcs:ignore
        echo '</style>';
    }
}
add_action( 'wp_head', 'pls_inline_critical_css', 1 );

// ── Preload key resources ──────────────────────────────────────────────────
function pls_preload_resources(): void {
    // Preload hero image on homepage
    if ( is_front_page() ) {
        echo '<link rel="preload" as="image" href="' . esc_url( PLS_ASSETS . '/images/hero-bg.jpg' ) . '" fetchpriority="high">' . "\n";
    }
    // Preload self-hosted primary font (only when the file exists).
    $inter_woff2 = PLS_DIR . '/assets/fonts/inter-400.woff2';
    if ( file_exists( $inter_woff2 ) ) {
        echo '<link rel="preload" as="font" type="font/woff2" href="' . esc_url( PLS_ASSETS . '/fonts/inter-400.woff2' ) . '" crossorigin>' . "\n";
    }
}
add_action( 'wp_head', 'pls_preload_resources', 2 );