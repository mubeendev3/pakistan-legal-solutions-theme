<?php
/**
 * Template Name: About Page
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php pls_page_hero(
        __( 'About Our Firm', 'pakistan-legal-solutions' ),
        __( 'Trusted legal advisors serving clients across Pakistan', 'pakistan-legal-solutions' )
    ); ?>

    <?php // Firm Story Section ?>
    <section class="about-story">
        <div class="container">
            <div class="about-story__grid">
                <div class="about-story__content">
                    <h2><?php esc_html_e( 'Our Story', 'pakistan-legal-solutions' ); ?></h2>
                    <?php the_content(); // Client edits this in WP admin ?>
                </div>
                <div class="about-story__image">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'card-landscape', [ 'loading' => 'lazy', 'alt' => __( 'Pakistan Legal Solutions team and office', 'pakistan-legal-solutions' ) ] ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php // Values Section ?>
    <section class="about-values">
        <div class="container">
            <h2 class="section-title section-title--centered">
                <?php esc_html_e( 'Our Core Values', 'pakistan-legal-solutions' ); ?>
            </h2>
            <div class="values-grid">
                <?php
                $values = [
                    [ 'icon' => 'users',     'title' => __( 'Client First',    'pakistan-legal-solutions' ), 'desc' => __( 'Every decision we make is guided by what is best for our client. Period.', 'pakistan-legal-solutions' ) ],
                    [ 'icon' => 'eye',       'title' => __( 'Transparency',    'pakistan-legal-solutions' ), 'desc' => __( 'No hidden fees. No legal jargon. Clear communication at every step.', 'pakistan-legal-solutions' ) ],
                    [ 'icon' => 'award',     'title' => __( 'Excellence',      'pakistan-legal-solutions' ), 'desc' => __( 'We hold ourselves to the highest standards of legal practice and professionalism.', 'pakistan-legal-solutions' ) ],
                    [ 'icon' => 'shield',    'title' => __( 'Integrity',       'pakistan-legal-solutions' ), 'desc' => __( 'We do what is right, even when it is difficult. Ethical practice is non-negotiable.', 'pakistan-legal-solutions' ) ],
                ];
                foreach ( $values as $value ) : ?>
                    <div class="value-card">
                        <?php echo pls_icon( esc_attr( $value['icon'] ) ); ?>
                        <h3><?php echo esc_html( $value['title'] ); ?></h3>
                        <p><?php echo esc_html( $value['desc'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php // Team Section ?>
    <section class="about-team">
        <div class="container">
            <h2 class="section-title section-title--centered">
                <?php esc_html_e( 'Meet Our Partners', 'pakistan-legal-solutions' ); ?>
            </h2>
            <?php
            $team = new WP_Query( [
                'post_type'      => 'team_member',
                'posts_per_page' => -1,
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
            ] );
            if ( $team->have_posts() ) : ?>
                <div class="team-grid team-grid--full">
                    <?php while ( $team->have_posts() ) : $team->the_post();
                        get_template_part( 'template-parts/components/attorney-card', null, [
                            'post_id' => get_the_ID(),
                            'size'    => 'large',
                        ] );
                    endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php get_template_part( 'template-parts/home/cta-banner' ); ?>

</main>

<?php get_footer(); ?>