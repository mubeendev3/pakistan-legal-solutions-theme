<?php
/**
 * Practice Areas listing — grid of all catalog items.
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;
?>

<section class="home-pa section pa-catalog" aria-label="<?php esc_attr_e( 'All practice areas', 'pakistan-legal-solutions' ); ?>">
    <div class="container">
        <div class="pa-grid">
            <?php
            foreach ( pls_get_practice_areas_catalog() as $item ) {
                pls_get_part(
                    'components/practice-area-card',
                    [
                        'pa_title' => $item['title'],
                        'pa_url'   => pls_practice_area_permalink( $item['slug'] ),
                        'pa_lines' => $item['lines'],
                        'pa_icon'  => $item['icon'],
                    ]
                );
            }
            ?>
        </div>
    </div>
</section>
