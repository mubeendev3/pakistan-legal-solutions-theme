<?php
/**
 * Single Practice Area Template
 *
 * @package PakistanLegalSolutions
 */
get_header();
?>

<main id="main-content" class="site-main site-main--single-pa" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
        <?php
        $post_id = get_the_ID();
        $intro   = pls_practice_area_intro_source_text( $post_id );
        $hero_sub = pls_field( 'pa_subtitle', $post_id, '' );
        if ( '' === trim( $hero_sub ) ) {
            $hero_sub = __( 'Expert legal representation in Pakistan', 'pakistan-legal-solutions' );
        }
        pls_page_hero( get_the_title(), $hero_sub );
        ?>

        <section class="pa-content">
            <div class="container">
                <div class="pa-layout">

                    <div class="pa-main">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="pa-main__image">
                                <?php the_post_thumbnail( 'card-landscape', [ 'loading' => 'eager', 'alt' => wp_strip_all_tags( get_the_title() ) ] ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="pa-main__content entry-content">
                            <?php if ( $intro ) : ?>
                                <p class="pa-intro"><?php echo esc_html( $intro ); ?></p>
                            <?php endif; ?>

                            <?php if ( pls_practice_area_has_editor_content( $post_id ) ) : ?>
                                <?php the_content(); ?>
                            <?php else : ?>
                                <div class="pa-placeholder">
                                    <?php echo pls_practice_area_placeholder_body_html( get_the_title() ); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php
                        $services = function_exists( 'get_field' ) ? get_field( 'pa_key_services', $post_id ) : null;
                        if ( $services ) :
                            ?>
                            <div class="pa-services">
                                <h3 class="pa-services__title"><?php esc_html_e( 'Key services', 'pakistan-legal-solutions' ); ?></h3>
                                <ul class="pa-services__list">
                                    <?php foreach ( $services as $service ) : ?>
                                        <li class="pa-services__item">
                                            <?php echo pls_icon( 'check' ); ?>
                                            <span><?php echo esc_html( $service['service_name'] ?? '' ); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div><!-- .pa-main -->

                    <aside class="pa-sidebar" aria-label="<?php esc_attr_e( 'Practice area sidebar', 'pakistan-legal-solutions' ); ?>">
                        <div class="sidebar-card">
                            <h3 class="sidebar-card__title"><?php esc_html_e( 'Other practice areas', 'pakistan-legal-solutions' ); ?></h3>
                            <?php
                            $other = new WP_Query(
                                [
                                    'post_type'      => 'practice_area',
                                    'posts_per_page' => -1,
                                    'post__not_in'   => [ $post_id ],
                                    'orderby'        => [ 'menu_order' => 'ASC', 'title' => 'ASC' ],
                                    'no_found_rows'  => true,
                                ]
                            );
                            ?>
                            <?php if ( $other->have_posts() ) : ?>
                                <nav class="sidebar-nav" aria-label="<?php esc_attr_e( 'Other practice areas', 'pakistan-legal-solutions' ); ?>">
                                    <ul class="sidebar-nav__list">
                                        <?php
                                        while ( $other->have_posts() ) :
                                            $other->the_post();
                                            ?>
                                            <li class="sidebar-nav__item">
                                                <a class="sidebar-nav__link" href="<?php the_permalink(); ?>">
                                                    <?php echo pls_icon( 'chevron-right' ); ?>
                                                    <?php the_title(); ?>
                                                </a>
                                            </li>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                    </ul>
                                </nav>
                            <?php else : ?>
                                <p class="sidebar-card__empty"><?php esc_html_e( 'More practice areas coming soon.', 'pakistan-legal-solutions' ); ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="sidebar-card sidebar-card--cta">
                            <h3 class="sidebar-card__title"><?php esc_html_e( 'Need legal help?', 'pakistan-legal-solutions' ); ?></h3>
                            <p class="sidebar-card__text"><?php esc_html_e( 'Talk to one of our attorneys today. First consultation is free.', 'pakistan-legal-solutions' ); ?></p>
                            <a class="btn btn--gold btn--full" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                                <?php esc_html_e( 'Book free consultation', 'pakistan-legal-solutions' ); ?>
                            </a>
                            <a class="btn btn--outline-white btn--full sidebar-card--cta__phone" href="tel:+924235710000">
                                +92 42 3571 0000
                            </a>
                        </div>
                    </aside>

                </div><!-- .pa-layout -->
            </div><!-- .container -->
        </section>

    <?php endwhile; ?>

</main>

<?php
get_footer();
