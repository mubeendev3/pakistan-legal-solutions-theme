<?php
/**
 * Homepage — team highlight.
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

$query = new WP_Query(
    [
        'post_type'      => 'team_member',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        'orderby'        => [ 'menu_order' => 'ASC', 'title' => 'ASC' ],
    ]
);
?>

<section class="home-team section section--sm" aria-labelledby="home-team-heading">
    <div class="container">
        <header class="section-header" data-animate="fade-up">
            <p class="section-eyebrow"><?php esc_html_e( 'Our people', 'pakistan-legal-solutions' ); ?></p>
            <h2 class="section-title" id="home-team-heading"><?php esc_html_e( 'Experienced advocates you can talk to', 'pakistan-legal-solutions' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'A collaborative bench with deep courtroom and boardroom experience—aligned around one goal: your outcome.', 'pakistan-legal-solutions' ); ?></p>
        </header>

        <?php if ( $query->have_posts() ) : ?>
            <div class="home-team__grid">
                <?php
                $pls_team_i = 0;
                while ( $query->have_posts() ) :
                    $query->the_post();
                    get_template_part(
                        'template-parts/components/attorney-card',
                        null,
                        [
                            'animate_delay' => ( $pls_team_i + 1 ) * 100,
                        ]
                    );
                    ++$pls_team_i;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php else : ?>
            <p class="lead text-center" style="max-width: 36rem; margin-inline: auto;">
                <?php esc_html_e( 'Team profiles will appear here once team members are added in WordPress. Until then, reach out and we will connect you with the right advocate for your matter.', 'pakistan-legal-solutions' ); ?>
            </p>
        <?php endif; ?>

        <p class="text-center" style="margin-top: var(--space-10);">
            <a class="btn btn--primary" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About the firm', 'pakistan-legal-solutions' ); ?></a>
        </p>
    </div>
</section>
