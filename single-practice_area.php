<?php
/**
 * Single Practice Area Template
 * WordPress uses this automatically for practice_area post type.
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php pls_page_hero(
            get_the_title(),
            pls_field( 'pa_subtitle', get_the_ID(), __( 'Expert legal representation in Pakistan', 'pakistan-legal-solutions' ) )
        ); ?>

        <section class="pa-content">
            <div class="container">
                <div class="pa-layout">

                    <div class="pa-main">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="pa-main__image">
                                <?php the_post_thumbnail( 'card-landscape', [ 'loading' => 'eager', 'alt' => get_the_title() ] ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="pa-main__content entry-content">
                            <?php the_content(); ?>
                        </div>

                        <?php // ACF: Key services list ?>
                        <?php
                        $services = get_field( 'pa_key_services' );
                        if ( $services ) : ?>
                            <div class="pa-services">
                                <h3><?php esc_html_e( 'Our Services Include', 'pakistan-legal-solutions' ); ?></h3>
                                <ul class="pa-services__list">
                                    <?php foreach ( $services as $service ) : ?>
                                        <li>
                                            <?php echo pls_icon( 'check' ); ?>
                                            <?php echo esc_html( $service['service_name'] ); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div><!-- .pa-main -->

                    <aside class="pa-sidebar">
                        <?php // Other practice areas ?>
                        <div class="pa-sidebar__widget">
                            <h3><?php esc_html_e( 'Other Practice Areas', 'pakistan-legal-solutions' ); ?></h3>
                            <?php
                            $other = new WP_Query( [
                                'post_type'      => 'practice_area',
                                'posts_per_page' => -1,
                                'post__not_in'   => [ get_the_ID() ],
                                'orderby'        => 'menu_order',
                                'order'          => 'ASC',
                            ] );
                            if ( $other->have_posts() ) : ?>
                                <ul class="pa-sidebar__list">
                                    <?php while ( $other->have_posts() ) : $other->the_post(); ?>
                                        <li>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo pls_icon( 'chevron-right' ); ?>
                                                <?php the_title(); ?>
                                            </a>
                                        </li>
                                    <?php endwhile; wp_reset_postdata(); ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <?php // Consultation CTA ?>
                        <div class="pa-sidebar__cta">
                            <h3><?php esc_html_e( 'Need Legal Help?', 'pakistan-legal-solutions' ); ?></h3>
                            <p><?php esc_html_e( 'Talk to one of our attorneys today. First consultation is free.', 'pakistan-legal-solutions' ); ?></p>
                            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--primary btn--full">
                                <?php esc_html_e( 'Book Free Consultation', 'pakistan-legal-solutions' ); ?>
                            </a>
                            <a href="tel:+924235710000" class="btn btn--outline btn--full" style="margin-top: 10px;">
                                +92 42 3571 0000
                            </a>
                        </div>
                    </aside>

                </div><!-- .pa-layout -->
            </div><!-- .container -->
        </section>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>