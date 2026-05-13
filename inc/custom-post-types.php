<?php
defined( 'ABSPATH' ) || exit;

function pls_register_post_types(): void {

    // ── Practice Areas ─────────────────────────────────────────────────────
    register_post_type( 'practice_area', [
        'labels' => [
            'name'               => __( 'Practice Areas',       'pakistan-legal-solutions' ),
            'singular_name'      => __( 'Practice Area',        'pakistan-legal-solutions' ),
            'add_new_item'       => __( 'Add Practice Area',    'pakistan-legal-solutions' ),
            'edit_item'          => __( 'Edit Practice Area',   'pakistan-legal-solutions' ),
            'view_item'          => __( 'View Practice Area',   'pakistan-legal-solutions' ),
            'all_items'          => __( 'All Practice Areas',   'pakistan-legal-solutions' ),
            'search_items'       => __( 'Search Practice Areas','pakistan-legal-solutions' ),
            'not_found'          => __( 'No practice areas found.', 'pakistan-legal-solutions' ),
        ],
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true,        // Enables Gutenberg editor
        'query_var'           => true,
        'rewrite'             => [ 'slug' => 'practice-areas', 'with_front' => false ],
        'capability_type'     => 'post',
        // Archive disabled so a Page with slug `practice-areas` can host the listing template without rewrite clashes. Singles remain at /practice-areas/{slug}/.
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-portfolio',
        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes' ],
        'delete_with_user'    => false,
    ] );

    // ── Team Members ───────────────────────────────────────────────────────
    register_post_type( 'team_member', [
        'labels' => [
            'name'          => __( 'Team Members',       'pakistan-legal-solutions' ),
            'singular_name' => __( 'Team Member',        'pakistan-legal-solutions' ),
            'add_new_item'  => __( 'Add Team Member',    'pakistan-legal-solutions' ),
            'edit_item'     => __( 'Edit Team Member',   'pakistan-legal-solutions' ),
            'all_items'     => __( 'All Team Members',   'pakistan-legal-solutions' ),
        ],
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => [ 'slug' => 'team', 'with_front' => false ],
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'page-attributes' ],
    ] );

    // ── Testimonials ───────────────────────────────────────────────────────
    register_post_type( 'testimonial', [
        'labels' => [
            'name'          => __( 'Testimonials',      'pakistan-legal-solutions' ),
            'singular_name' => __( 'Testimonial',       'pakistan-legal-solutions' ),
            'add_new_item'  => __( 'Add Testimonial',   'pakistan-legal-solutions' ),
            'all_items'     => __( 'All Testimonials',  'pakistan-legal-solutions' ),
        ],
        'public'             => false,    // Not publicly visible (used in queries only)
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => [ 'title', 'editor' ],
    ] );
}
add_action( 'init', 'pls_register_post_types' );