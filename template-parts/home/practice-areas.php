<?php
/**
 * Homepage — practice areas grid (canonical twelve from catalog).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

$pa_index = pls_practice_areas_index_url();
?>

<section class="home-pa section" aria-labelledby="home-pa-heading">
    <div class="container">
        <header class="section-header">
            <p class="section-eyebrow"><?php esc_html_e( 'Practice areas', 'pakistan-legal-solutions' ); ?></p>
            <h2 class="section-title" id="home-pa-heading"><?php esc_html_e( 'Counsel that matches the complexity of your matter', 'pakistan-legal-solutions' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Focused teams across the issues Pakistani businesses and families face most—delivered with clarity and momentum.', 'pakistan-legal-solutions' ); ?></p>
        </header>

        <div class="home-pa__grid">
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

        <p class="text-center" style="margin-top: var(--space-10);">
            <a class="btn btn--outline" href="<?php echo esc_url( $pa_index ); ?>"><?php esc_html_e( 'View all practice areas', 'pakistan-legal-solutions' ); ?></a>
        </p>
    </div>
</section>
