<?php defined( 'ABSPATH' ) || exit; ?>

<section class="hero" aria-labelledby="hero-heading">

    <div class="hero__bg">
        <?php
        // If you set a featured image on the homepage, use it as hero bg
        if ( has_post_thumbnail() ) {
            $bg_url = get_the_post_thumbnail_url( get_the_ID(), 'hero-full' );
        } else {
            $bg_url = PLS_ASSETS . '/images/hero-bg.jpg';
        }
        ?>
        <div class="hero__bg-image" style="background-image: url('<?php echo esc_url( $bg_url ); ?>');" role="img" aria-label="<?php esc_attr_e( 'Courthouse columns', 'pakistan-legal-solutions' ); ?>"></div>
        <div class="hero__overlay" aria-hidden="true"></div>
    </div>

    <div class="hero__content container">
        <div class="hero__text">

            <p class="hero__eyebrow">
                <?php esc_html_e( 'Advocates & legal consultants', 'pakistan-legal-solutions' ); ?>
            </p>

            <h1 class="hero__heading" id="hero-heading">
                <?php esc_html_e( 'Trusted Legal Representation', 'pakistan-legal-solutions' ); ?>
                <span><?php esc_html_e( 'Across Pakistan', 'pakistan-legal-solutions' ); ?></span>
            </h1>

            <p class="hero__subheading">
                <?php esc_html_e( 'From family and corporate matters to tax, property, and constitutional questions—clear advice and strong representation. Client-first, every time.', 'pakistan-legal-solutions' ); ?>
            </p>

            <div class="hero__actions">
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
                   class="btn btn--gold btn--lg">
                    <?php esc_html_e( 'Book Free Consultation', 'pakistan-legal-solutions' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/practice-areas' ) ); ?>"
                   class="btn btn--outline-white btn--lg">
                    <?php esc_html_e( 'Our Practice Areas', 'pakistan-legal-solutions' ); ?>
                </a>
            </div>

            <div class="hero__stats" aria-label="<?php esc_attr_e( 'Firm statistics', 'pakistan-legal-solutions' ); ?>">
                <div class="hero__stat">
                    <span class="hero__stat-number" data-pls-counter data-target="15" data-suffix="+">15+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Years Experience', 'pakistan-legal-solutions' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number" data-pls-counter data-target="500" data-suffix="+">500+</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Cases Won', 'pakistan-legal-solutions' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number" data-pls-counter data-target="6" data-suffix="">6</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Practice Areas', 'pakistan-legal-solutions' ); ?></span>
                </div>
                <div class="hero__stat">
                    <span class="hero__stat-number" data-pls-counter data-target="100" data-suffix="%">100%</span>
                    <span class="hero__stat-label"><?php esc_html_e( 'Client First', 'pakistan-legal-solutions' ); ?></span>
                </div>
            </div>

        </div><!-- .hero__text -->
    </div><!-- .hero__content -->

</section><!-- .hero -->