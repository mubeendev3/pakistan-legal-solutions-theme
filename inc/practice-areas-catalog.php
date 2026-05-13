<?php
/**
 * Canonical list of practice areas (slugs align with CPT `practice_area` posts).
 *
 * @package PakistanLegalSolutions
 */

defined( 'ABSPATH' ) || exit;

require_once PLS_INC . '/practice-area-icons.php';

/**
 * URL for the Practice Areas index (prefers a published Page with slug `practice-areas`).
 */
function pls_practice_areas_index_url(): string {
    $page = get_page_by_path( 'practice-areas', OBJECT, 'page' );
    if ( $page instanceof WP_Post && 'publish' === $page->post_status ) {
        return get_permalink( $page );
    }
    return trailingslashit( home_url( 'practice-areas' ) );
}

/**
 * Permalink for a single practice area CPT, or a pretty URL until the post exists.
 */
function pls_practice_area_permalink( string $slug ): string {
    static $map = null;
    if ( null === $map ) {
        $map = [];
        $ids = get_posts(
            [
                'post_type'      => 'practice_area',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'fields'         => 'ids',
            ]
        );
        foreach ( $ids as $id ) {
            $name = get_post_field( 'post_name', $id );
            if ( $name ) {
                $map[ $name ] = get_permalink( (int) $id );
            }
        }
    }
    if ( isset( $map[ $slug ] ) ) {
        return $map[ $slug ];
    }
    return trailingslashit( home_url( 'practice-areas/' . $slug ) );
}

/**
 * Ordered catalog: slug, icon key, title, two short lines (Pakistan / international context).
 *
 * @return array<int, array{slug:string, icon:string, title:string, lines:array{0:string,1:string}}>
 */
function pls_get_practice_areas_catalog(): array {
    return [
        [
            'slug'  => 'civil-law',
            'icon'  => 'civil-law',
            'title' => __( 'Civil Law', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Suits, specific performance, and damages under the Contract Act 1872 and the Code of Civil Procedure, 1908.', 'pakistan-legal-solutions' ),
                __( 'We align courtroom strategy with arbitration and cross-border enforcement where your counterparty or assets are abroad.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'constitutional-law',
            'icon'  => 'constitutional-law',
            'title' => __( 'Constitutional Law', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Fundamental rights, judicial review, and public-law remedies before superior courts under the Constitution of Pakistan.', 'pakistan-legal-solutions' ),
                __( 'Advice on legislative competence, service matters, and high-stakes questions touching federal–provincial relations.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'business-formation',
            'icon'  => 'business-formation',
            'title' => __( 'Business Formation', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'SECP incorporation, sole proprietorships, partnerships (including LLPs), and branch or liaison structures for foreign investors.', 'pakistan-legal-solutions' ),
                __( 'Cap tables, founder agreements, and governance that stay credible with banks, regulators, and future joint-venture partners.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'banking-finance',
            'icon'  => 'banking-finance',
            'title' => __( 'Banking & Finance', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Facility agreements, security perfection, and recovery forums—including banking courts and restructuring conversations.', 'pakistan-legal-solutions' ),
                __( 'Support on syndicated finance, Islamic banking structures, and documentation that satisfies SBP expectations and offshore lenders.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'taxation',
            'icon'  => 'taxation',
            'title' => __( 'Taxation', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Income tax, sales tax, and federal excise before the FBR, appellate tribunals, and high courts on substantial questions of law.', 'pakistan-legal-solutions' ),
                __( 'Cross-border withholding, treaty positions, and transfer-pricing documentation for groups with regional or global footprints.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'cyber-crime',
            'icon'  => 'cyber-crime',
            'title' => __( 'Cyber Crime', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Offences and investigations under the Prevention of Electronic Crimes Act, 2016, including data breaches and online fraud.', 'pakistan-legal-solutions' ),
                __( 'Incident response, preservation of digital evidence, and coordination with platforms and agencies across jurisdictions.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'family-law',
            'icon'  => 'family-law',
            'title' => __( 'Family Law', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Khula, dissolution, custody, maintenance, and succession matters under the Muslim Family Laws Ordinance and related statutes.', 'pakistan-legal-solutions' ),
                __( 'Sensitive negotiation first—measured litigation when needed—including Hague and foreign-element issues where they arise.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'sports-law',
            'icon'  => 'sports-law',
            'title' => __( 'Sports Law', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Player and coach contracts, federation rules, image rights, and disciplinary proceedings before domestic sports tribunals.', 'pakistan-legal-solutions' ),
                __( 'Sponsorship, broadcasting, and agency deals with wording that holds up against FIFA, ICC, or league regulations abroad.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'white-collar-crime',
            'icon'  => 'white-collar-crime',
            'title' => __( 'White Collar Crime', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'NAB, FIA, and anti-corruption investigations—defence and compliance steps that protect individuals and corporate reputations.', 'pakistan-legal-solutions' ),
                __( 'Parallel exposure to AML/CFT inquiries and cross-border mutual legal assistance requires disciplined, early legal strategy.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'contract-drafting',
            'icon'  => 'contract-drafting',
            'title' => __( 'Contract Drafting', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Supply, distribution, services, NDAs, and joint ventures drafted for enforceability in Pakistani courts and arbitration.', 'pakistan-legal-solutions' ),
                __( 'English and bilingual clauses, governing law choices, and dispute-resolution ladders that match how you actually do business.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'corporate-law',
            'icon'  => 'corporate-law',
            'title' => __( 'Corporate Law', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Board procedures, shareholder rights, dividends, and SECP filings for public and closely held companies.', 'pakistan-legal-solutions' ),
                __( 'M&A, joint ventures, and corporate reorganization with due diligence tuned to sector regulators and international counterparties.', 'pakistan-legal-solutions' ),
            ],
        ],
        [
            'slug'  => 'ip-law',
            'icon'  => 'ip-law',
            'title' => __( 'IP Law (Intellectual Property)', 'pakistan-legal-solutions' ),
            'lines' => [
                __( 'Trademarks, copyrights, and designs before IPO Pakistan; licensing and franchising for domestic and export brands.', 'pakistan-legal-solutions' ),
                __( 'Enforcement against infringement online and offline, including border measures and coordination with foreign IP counsel.', 'pakistan-legal-solutions' ),
            ],
        ],
    ];
}

/**
 * Icon key for inline SVG (matches keys in pls_the_pa_icon()).
 */
function pls_practice_area_icon_key_for_slug( string $slug ): string {
    foreach ( pls_get_practice_areas_catalog() as $row ) {
        if ( $row['slug'] === $slug ) {
            return $row['icon'];
        }
    }
    return $slug;
}

/**
 * Intro paragraph for single template: ACF card excerpt, then post excerpt.
 */
function pls_practice_area_intro_source_text( int $post_id ): string {
    if ( function_exists( 'get_field' ) ) {
        $acf = trim( wp_strip_all_tags( (string) get_field( 'pa_card_excerpt', $post_id ) ) );
        if ( $acf !== '' ) {
            return $acf;
        }
    }
    $excerpt = get_the_excerpt( $post_id );
    if ( $excerpt ) {
        return trim( wp_strip_all_tags( $excerpt ) );
    }
    return '';
}

/**
 * Up to two lines for cards (homepage / listing).
 *
 * @return array{0:string,1:string}
 */
function pls_practice_area_card_body_lines( int $post_id ): array {
    $acf_raw = function_exists( 'get_field' ) ? (string) get_field( 'pa_card_excerpt', $post_id ) : '';
    $acf_txt = trim( wp_strip_all_tags( $acf_raw ) );
    if ( $acf_txt !== '' ) {
        $parts = preg_split( '/\r\n|\r|\n/', $acf_raw, -1, PREG_SPLIT_NO_EMPTY );
        $parts = array_values(
            array_filter(
                array_map(
                    static function ( $p ) {
                        return trim( wp_strip_all_tags( (string) $p ) );
                    },
                    is_array( $parts ) ? $parts : []
                )
            )
        );
        if ( count( $parts ) >= 2 ) {
            return [ $parts[0], $parts[1] ];
        }
        if ( count( $parts ) === 1 ) {
            $sentences = preg_split( '/(?<=[.!?])\s+/', $parts[0], 3, PREG_SPLIT_NO_EMPTY );
            if ( is_array( $sentences ) && count( $sentences ) >= 2 ) {
                return [ trim( $sentences[0] ), trim( $sentences[1] ) ];
            }
            return [ $parts[0], '' ];
        }
    }

    $excerpt = get_the_excerpt( $post_id );
    if ( ! $excerpt ) {
        $excerpt = (string) get_post_field( 'post_content', $post_id );
        $excerpt = wp_trim_words( wp_strip_all_tags( $excerpt ), 40, '' );
    } else {
        $excerpt = wp_strip_all_tags( $excerpt );
    }
    $excerpt = trim( $excerpt );

    if ( $excerpt !== '' ) {
        $sentences = preg_split( '/(?<=[.!?])\s+/', $excerpt, 3, PREG_SPLIT_NO_EMPTY );
        if ( is_array( $sentences ) && count( $sentences ) >= 2 ) {
            return [ trim( $sentences[0] ), trim( $sentences[1] ) ];
        }
        $words = preg_split( '/\s+/', $excerpt, -1, PREG_SPLIT_NO_EMPTY );
        if ( is_array( $words ) && count( $words ) > 12 ) {
            $half = (int) ceil( count( $words ) / 2 );
            return [
                implode( ' ', array_slice( $words, 0, $half ) ),
                implode( ' ', array_slice( $words, $half ) ),
            ];
        }
        return [ $excerpt, '' ];
    }

    $slug = (string) get_post_field( 'post_name', $post_id );
    foreach ( pls_get_practice_areas_catalog() as $row ) {
        if ( $row['slug'] === $slug ) {
            return $row['lines'];
        }
    }

    return [
        __( 'Strategic advice and representation tailored to your situation in Pakistan and across borders where your matter reaches.', 'pakistan-legal-solutions' ),
        '',
    ];
}

/**
 * Whether the block editor body has user-visible text.
 */
function pls_practice_area_has_editor_content( int $post_id ): bool {
    $raw = (string) get_post_field( 'post_content', $post_id );
    return strlen( trim( wp_strip_all_tags( $raw ) ) ) > 0;
}

/**
 * Default body HTML when the practice area post content is empty.
 */
function pls_practice_area_placeholder_body_html( string $title ): string {
    $p1 = sprintf(
        /* translators: %s: practice area title */
        __( 'Pakistan Legal Solutions advises clients on %s with an emphasis on clear strategy, disciplined documentation, and positions that stand up before regulators and courts.', 'pakistan-legal-solutions' ),
        $title
    );
    $p2 = __(
        'Whether your matter is domestic or has a cross-border element, we help you understand risk, preserve evidence, and choose a proportionate path—in negotiation, arbitration, or litigation.',
        'pakistan-legal-solutions'
    );
    return '<p>' . esc_html( $p1 ) . '</p><p>' . esc_html( $p2 ) . '</p>';
}
