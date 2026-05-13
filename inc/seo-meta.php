<?php
/**
 * Custom SEO meta tags and Open Graph.
 * Works alongside Yoast SEO plugin.
 * These only output if Yoast is not handling them.
 */
defined( 'ABSPATH' ) || exit;

function pls_schema_markup(): void {
    // Law firm structured data (JSON-LD)
    // This helps Google understand your business and show rich results.
    if ( is_front_page() ) :
        $schema = [
            '@context'    => 'https://schema.org',
            '@type'       => 'LegalService',
            'name'        => get_bloginfo( 'name' ),
            'description' => get_bloginfo( 'description' ),
            'url'         => home_url(),
            'logo'        => [
                '@type' => 'ImageObject',
                'url'   => PLS_ASSETS . '/images/logo.png',
            ],
            'address' => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => '2nd Floor, Commerce Centre, MM Alam Road, Gulberg III',
                'addressLocality' => 'Lahore',
                'addressRegion'   => 'Punjab',
                'postalCode'      => '54660',
                'addressCountry'  => 'PK',
            ],
            'telephone'       => '+92-304-1234007, +92-300-0029023',
            'openingHours'    => [ 'Sa-Th 09:00-18:00' ],
            'priceRange'      => '$$',
            'areaServed'      => 'Pakistan',
            'serviceType'     => [
                'Family Law', 'Tax Law', 'Property Law',
                'Corporate Law', 'Labor Law', 'Constitutional Law',
            ],
        ];
        printf(
            '<script type="application/ld+json">%s</script>' . "\n",
            wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES )
        );
    endif;
}
add_action( 'wp_head', 'pls_schema_markup' );