<?php
defined( 'ABSPATH' ) || exit;

function pls_register_menus(): void {
    register_nav_menus( [
        'primary'    => __( 'Primary Navigation',    'pakistan-legal-solutions' ),
        'footer-1'   => __( 'Footer Column 1',       'pakistan-legal-solutions' ),
        'footer-2'   => __( 'Footer Column 2',       'pakistan-legal-solutions' ),
        'mobile'     => __( 'Mobile Navigation',     'pakistan-legal-solutions' ),
    ] );
}
add_action( 'after_setup_theme', 'pls_register_menus' );