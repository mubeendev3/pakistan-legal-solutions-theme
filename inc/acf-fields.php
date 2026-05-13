<?php
/**
 * ACF Field Groups — registered via PHP so they travel with the theme.
 * Requires Advanced Custom Fields plugin (free).
 */
defined( 'ABSPATH' ) || exit;

// ── Practice Area Fields ───────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'      => 'group_practice_area',
    'title'    => 'Practice Area Details',
    'fields'   => [
        [
            'key'           => 'field_pa_subtitle',
            'label'         => 'Page Subtitle',
            'name'          => 'pa_subtitle',
            'type'          => 'text',
            'instructions'  => 'Short subtitle shown under the page title (max 80 characters)',
        ],
        [
            'key'           => 'field_pa_icon',
            'label'         => 'Icon Name',
            'name'          => 'pa_icon',
            'type'          => 'text',
            'instructions'  => 'SVG icon name from sprite (e.g. "scale", "building", "users")',
        ],
        [
            'key'           => 'field_pa_key_services',
            'label'         => 'Key Services',
            'name'          => 'pa_key_services',
            'type'          => 'repeater',
            'button_label'  => 'Add Service',
            'sub_fields'    => [
                [
                    'key'   => 'field_pa_service_name',
                    'label' => 'Service Name',
                    'name'  => 'service_name',
                    'type'  => 'text',
                ],
            ],
        ],
        [
            'key'           => 'field_pa_card_excerpt',
            'label'         => 'Card Excerpt',
            'name'          => 'pa_card_excerpt',
            'type'          => 'textarea',
            'rows'          => 3,
            'instructions'  => 'Short description shown on practice area cards (max 120 characters)',
        ],
    ],
    'location' => [
        [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'practice_area' ] ],
    ],
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
] );

// ── Team Member Fields ─────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_team_member',
    'title'  => 'Attorney Details',
    'fields' => [
        [
            'key'   => 'field_tm_title',
            'label' => 'Job Title',
            'name'  => 'tm_title',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_tm_credentials',
            'label' => 'Academic Credentials',
            'name'  => 'tm_credentials',
            'type'  => 'text',
            'instructions' => 'e.g. LLB (Punjab), LLM (London School of Economics)',
        ],
        [
            'key'   => 'field_tm_experience',
            'label' => 'Years of Experience',
            'name'  => 'tm_experience',
            'type'  => 'number',
        ],
        [
            'key'   => 'field_tm_phone',
            'label' => 'Direct Phone',
            'name'  => 'tm_phone',
            'type'  => 'text',
        ],
        [
            'key'   => 'field_tm_email',
            'label' => 'Direct Email',
            'name'  => 'tm_email',
            'type'  => 'email',
        ],
        [
            'key'   => 'field_tm_linkedin',
            'label' => 'LinkedIn URL',
            'name'  => 'tm_linkedin',
            'type'  => 'url',
        ],
    ],
    'location' => [
        [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'team_member' ] ],
    ],
] );

// ── Testimonial Fields ─────────────────────────────────────────────────────
acf_add_local_field_group( [
    'key'    => 'group_testimonial',
    'title'  => 'Testimonial Details',
    'fields' => [
        [
            'key'   => 'field_t_client_name',
            'label' => 'Client Name',
            'name'  => 't_client_name',
            'type'  => 'text',
        ],
        [
            'key'     => 'field_t_case_type',
            'label'   => 'Case Type',
            'name'    => 't_case_type',
            'type'    => 'select',
            'choices' => [
                'family-law'        => 'Family Law',
                'tax-law'           => 'Tax Law',
                'property-law'      => 'Property Law',
                'corporate-law'     => 'Corporate Law',
                'labor-law'         => 'Labor Law',
                'constitutional'    => 'Constitutional Law',
            ],
        ],
        [
            'key'   => 'field_t_rating',
            'label' => 'Star Rating',
            'name'  => 't_rating',
            'type'  => 'number',
            'min'   => 1,
            'max'   => 5,
            'default_value' => 5,
        ],
        [
            'key'   => 'field_t_location',
            'label' => 'Client City',
            'name'  => 't_location',
            'type'  => 'text',
        ],
    ],
    'location' => [
        [ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'testimonial' ] ],
    ],
] );