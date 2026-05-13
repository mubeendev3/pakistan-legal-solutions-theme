<?php
/**
 * Homepage — practice areas grid (from `practice_area` posts).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

$pa_index = pls_practice_areas_index_url();

$query = new WP_Query(
    [
        'post_type'      => 'practice_area',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => [ 'menu_order' => 'ASC', 'title' => 'ASC' ],
        'no_found_rows'  => true,
    ]
);
?>

<section class="home-pa section" aria-labelledby="home-pa-heading">
    <div class="container">
        <header class="section-header" data-animate="fade-up">
            <p class="section-eyebrow"><?php esc_html_e( 'Practice areas', 'pakistan-legal-solutions' ); ?></p>
            <h2 class="section-title" id="home-pa-heading"><?php esc_html_e( 'Counsel that matches the complexity of your matter', 'pakistan-legal-solutions' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Focused teams across the issues Pakistani businesses and families face most—delivered with clarity and momentum.', 'pakistan-legal-solutions' ); ?></p>
        </header>

        <div class="home-pa__grid">
            <?php if ( $query->have_posts() ) : ?>
                <?php
                $pls_pa_i = 0;
                while ( $query->have_posts() ) :
                    $query->the_post();
                    $slug = get_post_field( 'post_name', get_the_ID() );
                    $pls_pa_delay = ( ( $pls_pa_i % 3 ) + 1 ) * 100;
                    pls_get_part(
                        'components/practice-area-card',
                        [
                            'pa_title'         => get_the_title(),
                            'pa_url'           => get_permalink(),
                            'pa_lines'         => pls_practice_area_card_body_lines( get_the_ID() ),
                            'pa_icon'          => pls_practice_area_icon_key_for_slug( (string) $slug ),
                            'pa_animate_delay' => $pls_pa_delay,
                        ]
                    );
                    ++$pls_pa_i;
                endwhile;
                wp_reset_postdata();
                ?>
            <?php else : ?>
                <?php
                $pls_pa_i = 0;
                foreach ( pls_get_practice_areas_catalog() as $item ) {
                    $pls_pa_delay = ( ( $pls_pa_i % 3 ) + 1 ) * 100;
                    pls_get_part(
                        'components/practice-area-card',
                        [
                            'pa_title'         => $item['title'],
                            'pa_url'           => pls_practice_area_permalink( $item['slug'] ),
                            'pa_lines'         => $item['lines'],
                            'pa_icon'          => $item['icon'],
                            'pa_animate_delay' => $pls_pa_delay,
                        ]
                    );
                    ++$pls_pa_i;
                }
                ?>
            <?php endif; ?>
        </div>

        <p class="text-center home-pa__footer-cta">
            <a class="btn btn--outline" href="<?php echo esc_url( $pa_index ); ?>"><?php esc_html_e( 'View all practice areas', 'pakistan-legal-solutions' ); ?></a>
        </p>
    </div>
</section>
