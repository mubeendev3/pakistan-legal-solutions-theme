<?php
/**
 * Homepage — practice areas grid.
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

$archive = get_post_type_archive_link( 'practice_area' ) ?: home_url( '/practice-areas/' );

$fallback = [
    [
        'title' => __( 'Corporate & commercial', 'pakistan-legal-solutions' ),
        'excerpt' => __( 'Contracts, compliance, disputes, and day-to-day counsel for growing businesses.', 'pakistan-legal-solutions' ),
        'url' => $archive,
    ],
    [
        'title' => __( 'Family & civil', 'pakistan-legal-solutions' ),
        'excerpt' => __( 'Sensitive matters handled with care—mediation where possible, litigation when necessary.', 'pakistan-legal-solutions' ),
        'url' => $archive,
    ],
    [
        'title' => __( 'Property & real estate', 'pakistan-legal-solutions' ),
        'excerpt' => __( 'Title diligence, transactions, landlord–tenant issues, and project documentation.', 'pakistan-legal-solutions' ),
        'url' => $archive,
    ],
    [
        'title' => __( 'Tax & regulatory', 'pakistan-legal-solutions' ),
        'excerpt' => __( 'Advisory and representation before authorities—structured, defensible positions.', 'pakistan-legal-solutions' ),
        'url' => $archive,
    ],
    [
        'title' => __( 'Constitutional & public law', 'pakistan-legal-solutions' ),
        'excerpt' => __( 'Fundamental rights, judicial review, and high-stakes public interest questions.', 'pakistan-legal-solutions' ),
        'url' => $archive,
    ],
    [
        'title' => __( 'Dispute resolution', 'pakistan-legal-solutions' ),
        'excerpt' => __( 'Strategic litigation and negotiation aimed at outcomes that protect what matters most.', 'pakistan-legal-solutions' ),
        'url' => $archive,
    ],
];

$query = new WP_Query(
    [
        'post_type'      => 'practice_area',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'orderby'        => [ 'menu_order' => 'ASC', 'date' => 'DESC' ],
    ]
);
?>

<section class="home-pa section" aria-labelledby="home-pa-heading">
    <div class="container">
        <header class="section-header">
            <p class="section-eyebrow"><?php esc_html_e( 'Practice areas', 'pakistan-legal-solutions' ); ?></p>
            <h2 class="section-title" id="home-pa-heading"><?php esc_html_e( 'Counsel that matches the complexity of your matter', 'pakistan-legal-solutions' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Focused teams across the issues Pakistani businesses and families face most—delivered with clarity and momentum.', 'pakistan-legal-solutions' ); ?></p>
        </header>

        <div class="home-pa__grid">
            <?php if ( $query->have_posts() ) : ?>
                <?php
                while ( $query->have_posts() ) :
                    $query->the_post();
                    get_template_part( 'template-parts/components/practice-card' );
                endwhile;
                wp_reset_postdata();
                ?>
            <?php else : ?>
                <?php foreach ( $fallback as $item ) : ?>
                    <article class="pa-card">
                        <div class="pa-card__body">
                            <h3 class="pa-card__title">
                                <a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
                            </h3>
                            <p class="pa-card__excerpt"><?php echo esc_html( $item['excerpt'] ); ?></p>
                            <a class="pa-card__link" href="<?php echo esc_url( $item['url'] ); ?>"><?php esc_html_e( 'Learn more', 'pakistan-legal-solutions' ); ?></a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <p class="text-center" style="margin-top: var(--space-10);">
            <a class="btn btn--outline" href="<?php echo esc_url( $archive ); ?>"><?php esc_html_e( 'View all practice areas', 'pakistan-legal-solutions' ); ?></a>
        </p>
    </div>
</section>
