<?php
/**
 * About page body (expects The Loop: `the_post()` has been called).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

pls_page_hero(
    get_the_title(),
    __( 'Trusted legal advisors serving clients across Pakistan—with clarity, discretion, and resolve.', 'pakistan-legal-solutions' )
);
?>

<section class="about-story" aria-labelledby="about-story-heading">
    <div class="container about-story__grid">
        <div class="about-story__content">
            <p class="about-story__eyebrow"><?php esc_html_e( 'Who we are', 'pakistan-legal-solutions' ); ?></p>
            <h2 class="about-story__title" id="about-story-heading"><?php esc_html_e( 'Our story', 'pakistan-legal-solutions' ); ?></h2>
            <div class="about-story__prose entry-content">
                <?php
                $content = get_post_field( 'post_content', get_the_ID() );
                if ( trim( (string) $content ) !== '' ) {
                    the_content();
                } else {
                    ?>
                    <p><?php esc_html_e( 'Pakistan Legal Solutions is a Lahore-based practice built around one idea: clients deserve counsel that is rigorous, readable, and relentlessly practical. We work across corporate, family, property, tax, and constitutional matters—always with a bias toward outcomes you can live with.', 'pakistan-legal-solutions' ); ?></p>
                    <p><?php esc_html_e( 'Edit this page in WordPress to replace this placeholder with your firm history, leadership notes, and milestones.', 'pakistan-legal-solutions' ); ?></p>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="about-story__image">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php
                the_post_thumbnail(
                    'card-landscape',
                    [
                        'loading' => 'lazy',
                        'alt'     => esc_attr( get_the_title() . ' — ' . __( 'Pakistan Legal Solutions', 'pakistan-legal-solutions' ) ),
                    ]
                );
                ?>
            <?php else : ?>
                <div class="about-story__placeholder" role="img" aria-label="<?php esc_attr_e( 'Firm imagery placeholder', 'pakistan-legal-solutions' ); ?>">
                    <?php esc_html_e( 'Set a featured image on this page to showcase your office or team.', 'pakistan-legal-solutions' ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="about-mission" aria-labelledby="about-mission-heading">
    <div class="container about-mission__inner">
        <h2 class="sr-only" id="about-mission-heading"><?php esc_html_e( 'Mission', 'pakistan-legal-solutions' ); ?></h2>
        <blockquote class="about-mission__quote" cite="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php esc_html_e( 'We protect what you have built—your business, your family, your reputation—through preparation, precision, and principled advocacy.', 'pakistan-legal-solutions' ); ?>
        </blockquote>
        <span class="about-mission__cite"><?php esc_html_e( 'Our commitment', 'pakistan-legal-solutions' ); ?></span>
    </div>
</section>

<section class="about-stats" aria-label="<?php esc_attr_e( 'Firm at a glance', 'pakistan-legal-solutions' ); ?>">
    <div class="container about-stats__grid">
        <div class="about-stats__item">
            <span class="about-stats__number">15+</span>
            <span class="about-stats__label"><?php esc_html_e( 'Years experience', 'pakistan-legal-solutions' ); ?></span>
        </div>
        <div class="about-stats__item">
            <span class="about-stats__number">500+</span>
            <span class="about-stats__label"><?php esc_html_e( 'Matters handled', 'pakistan-legal-solutions' ); ?></span>
        </div>
        <div class="about-stats__item">
            <span class="about-stats__number">6</span>
            <span class="about-stats__label"><?php esc_html_e( 'Practice areas', 'pakistan-legal-solutions' ); ?></span>
        </div>
        <div class="about-stats__item">
            <span class="about-stats__number">100%</span>
            <span class="about-stats__label"><?php esc_html_e( 'Client first', 'pakistan-legal-solutions' ); ?></span>
        </div>
    </div>
</section>

<section class="about-values section" aria-labelledby="about-values-heading">
    <div class="container">
        <header class="section-header">
            <p class="section-eyebrow"><?php esc_html_e( 'Principles', 'pakistan-legal-solutions' ); ?></p>
            <h2 class="section-title" id="about-values-heading"><?php esc_html_e( 'Our core values', 'pakistan-legal-solutions' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'The standards we hold ourselves to—before strategy, before filings, and long after the hearing ends.', 'pakistan-legal-solutions' ); ?></p>
        </header>

        <div class="about-values__grid">
            <?php
            $values = [
                [
                    'badge' => '1',
                    'title' => __( 'Client first', 'pakistan-legal-solutions' ),
                    'desc'  => __( 'Every decision we make is guided by what is best for our client—clarity, cost awareness, and outcomes you can defend.', 'pakistan-legal-solutions' ),
                ],
                [
                    'badge' => '2',
                    'title' => __( 'Transparency', 'pakistan-legal-solutions' ),
                    'desc'  => __( 'No hidden fees and no fog. We explain risk in plain language, with timelines and options you can compare.', 'pakistan-legal-solutions' ),
                ],
                [
                    'badge' => '3',
                    'title' => __( 'Excellence', 'pakistan-legal-solutions' ),
                    'desc'  => __( 'We invest in research, drafting, and courtroom readiness—because small details decide big cases.', 'pakistan-legal-solutions' ),
                ],
                [
                    'badge' => '4',
                    'title' => __( 'Integrity', 'pakistan-legal-solutions' ),
                    'desc'  => __( 'Ethical practice is non-negotiable. We tell you what the law allows—even when it is not what you hoped to hear.', 'pakistan-legal-solutions' ),
                ],
            ];
            foreach ( $values as $value ) :
                ?>
                <article class="about-value-card">
                    <div class="about-value-card__badge" aria-hidden="true"><?php echo esc_html( $value['badge'] ); ?></div>
                    <h3 class="about-value-card__title"><?php echo esc_html( $value['title'] ); ?></h3>
                    <p class="about-value-card__text"><?php echo esc_html( $value['desc'] ); ?></p>
                </article>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</section>

<section class="about-team section" id="team" aria-labelledby="about-team-heading">
    <div class="container">
        <header class="section-header">
            <p class="section-eyebrow"><?php esc_html_e( 'People', 'pakistan-legal-solutions' ); ?></p>
            <h2 class="section-title" id="about-team-heading"><?php esc_html_e( 'Meet our team', 'pakistan-legal-solutions' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Experienced advocates and consultants aligned around practical, high-trust representation.', 'pakistan-legal-solutions' ); ?></p>
        </header>

        <?php
        $team = new WP_Query(
            [
                'post_type'      => 'team_member',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
                'orderby'        => [ 'menu_order' => 'ASC', 'title' => 'ASC' ],
            ]
        );
        if ( $team->have_posts() ) :
            ?>
            <div class="about-team__grid">
                <?php
                while ( $team->have_posts() ) :
                    $team->the_post();
                    get_template_part( 'template-parts/components/attorney-card' );
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <?php
        else :
            ?>
            <p class="about-team__empty"><?php esc_html_e( 'Team profiles will appear here once you add team members in WordPress. Until then, contact us and we will connect you with the right advocate for your matter.', 'pakistan-legal-solutions' ); ?></p>
            <?php
        endif;
        ?>

        <div class="about-team__actions">
            <a class="btn btn--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Book a consultation', 'pakistan-legal-solutions' ); ?></a>
            <a class="btn btn--outline" href="<?php echo esc_url( pls_practice_areas_index_url() ); ?>"><?php esc_html_e( 'Explore practice areas', 'pakistan-legal-solutions' ); ?></a>
        </div>
    </div>
</section>

<?php
get_template_part( 'template-parts/home/cta-banner' );
