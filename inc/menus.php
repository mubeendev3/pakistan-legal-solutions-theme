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

/**
 * Default primary links when no menu is assigned in Appearance → Menus.
 *
 * @param array<string, mixed> $args wp_nav_menu arguments as array.
 */
function pls_primary_nav_fallback( array $args = [] ): void {
    $menu_class = isset( $args['menu_class'] ) ? (string) $args['menu_class'] : 'primary-nav__list';
    if ( ! empty( $args['menu_id'] ) ) {
        $menu_id = (string) $args['menu_id'];
    } else {
        $menu_id = str_contains( $menu_class, 'mobile-menu' ) ? 'mobile-fallback-menu' : 'primary-menu';
    }
    $pa_url     = get_post_type_archive_link( 'practice_area' ) ?: home_url( '/practice-areas/' );

    $links = [
        [ 'label' => __( 'Home', 'pakistan-legal-solutions' ), 'url' => home_url( '/' ) ],
        [ 'label' => __( 'Practice Areas', 'pakistan-legal-solutions' ), 'url' => $pa_url ],
        [ 'label' => __( 'About', 'pakistan-legal-solutions' ), 'url' => home_url( '/about/' ) ],
        [ 'label' => __( 'Contact', 'pakistan-legal-solutions' ), 'url' => home_url( '/contact/' ) ],
    ];

    echo '<ul id="' . esc_attr( $menu_id ) . '" class="' . esc_attr( $menu_class ) . '" role="menubar">';
    foreach ( $links as $link ) {
        echo '<li class="menu-item"><a href="' . esc_url( $link['url'] ) . '">' . esc_html( $link['label'] ) . '</a></li>';
    }
    echo '</ul>';
}

/**
 * Default footer column links when no menu is assigned.
 *
 * @param array<string, mixed> $args wp_nav_menu arguments as array.
 */
function pls_footer_nav_fallback( array $args = [] ): void {
    $menu_class = isset( $args['menu_class'] ) ? (string) $args['menu_class'] : 'site-footer__nav';
    $location   = isset( $args['theme_location'] ) ? (string) $args['theme_location'] : '';
    $pa_url     = get_post_type_archive_link( 'practice_area' ) ?: home_url( '/practice-areas/' );

    $links = [];
    if ( 'footer-1' === $location ) {
        $links = [
            [ 'label' => __( 'About Us', 'pakistan-legal-solutions' ), 'url' => home_url( '/about/' ) ],
            [ 'label' => __( 'Our Team', 'pakistan-legal-solutions' ), 'url' => home_url( '/about/#team' ) ],
            [ 'label' => __( 'Contact', 'pakistan-legal-solutions' ), 'url' => home_url( '/contact/' ) ],
            [ 'label' => __( 'Book Consultation', 'pakistan-legal-solutions' ), 'url' => home_url( '/contact/' ) ],
        ];
    } elseif ( 'footer-2' === $location ) {
        $links = [
            [ 'label' => __( 'All Practice Areas', 'pakistan-legal-solutions' ), 'url' => $pa_url ],
            [ 'label' => __( 'Corporate & Commercial', 'pakistan-legal-solutions' ), 'url' => $pa_url ],
            [ 'label' => __( 'Family & Civil', 'pakistan-legal-solutions' ), 'url' => $pa_url ],
            [ 'label' => __( 'Property & Tax', 'pakistan-legal-solutions' ), 'url' => $pa_url ],
        ];
    }

    if ( ! $links ) {
        return;
    }

    echo '<ul class="' . esc_attr( $menu_class ) . '">';
    foreach ( $links as $link ) {
        echo '<li><a href="' . esc_url( $link['url'] ) . '">' . esc_html( $link['label'] ) . '</a></li>';
    }
    echo '</ul>';
}