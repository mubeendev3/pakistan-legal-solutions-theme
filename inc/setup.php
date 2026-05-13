<?php
/**
 * Theme setup: add_theme_support, image sizes, content width.
 */
defined( 'ABSPATH' ) || exit;

function pls_theme_setup(): void {

    // Let WordPress handle the <title> tag
    add_theme_support( 'title-tag' );

    // Enable featured images
    add_theme_support( 'post-thumbnails' );

    // Custom logo support
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => [ 'site-title', 'site-description' ],
    ] );

    // HTML5 markup support
    add_theme_support( 'html5', [
        'comment-list', 'comment-form', 'search-form',
        'gallery', 'caption', 'style', 'script',
    ] );

    // Wide and full alignment support (for Gutenberg blocks if ever used)
    add_theme_support( 'align-wide' );

    // Editor color palette (keeps Gutenberg consistent with theme)
    add_theme_support( 'editor-color-palette', [
        [ 'name' => 'Brand Maroon',  'slug' => 'brand-maroon',  'color' => '#8B1A1A' ],
        [ 'name' => 'Brand Gold',    'slug' => 'brand-gold',    'color' => '#C4962A' ],
        [ 'name' => 'Dark',          'slug' => 'dark',          'color' => '#1A1A1A' ],
        [ 'name' => 'White',         'slug' => 'white',         'color' => '#FFFFFF' ],
    ] );

    // Disable WordPress emoji scripts (reduces page weight)
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );

    // Custom image sizes
    add_image_size( 'hero-full',        1920, 1080, true );
    add_image_size( 'hero-mobile',       768,  512, true );
    add_image_size( 'card-landscape',    800,  533, true );
    add_image_size( 'card-portrait',     600,  800, true );
    add_image_size( 'attorney-portrait', 480,  640, true );
    add_image_size( 'thumbnail-square',  400,  400, true );
    add_image_size( 'og-image',         1200,  630, true );

    // Make theme translation-ready
    load_theme_textdomain( 'pakistan-legal-solutions', PLS_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'pls_theme_setup' );

// Content width (WordPress standard)
function pls_content_width(): void {
    $GLOBALS['content_width'] = 1200;
}
add_action( 'after_setup_theme', 'pls_content_width', 0 );