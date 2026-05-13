<?php
/**
 * Practice Areas listing — grid from `practice_area` posts (fallback: catalog).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

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

<section class="home-pa section pa-catalog" aria-label="<?php esc_attr_e( 'All practice areas', 'pakistan-legal-solutions' ); ?>">
    <div class="container">
        <div class="pa-grid">
            <?php if ( $query->have_posts() ) : ?>
                <?php
                while ( $query->have_posts() ) :
                    $query->the_post();
                    $slug = get_post_field( 'post_name', get_the_ID() );
                    pls_get_part(
                        'components/practice-area-card',
                        [
                            'pa_title' => get_the_title(),
                            'pa_url'   => get_permalink(),
                            'pa_lines' => pls_practice_area_card_body_lines( get_the_ID() ),
                            'pa_icon'  => pls_practice_area_icon_key_for_slug( (string) $slug ),
                        ]
                    );
                endwhile;
                wp_reset_postdata();
                ?>
            <?php else : ?>
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
            <?php endif; ?>
        </div>
    </div>
</section>
