<?php
/**
 * Template Name: Contact Page
 * Registers this file as a selectable template in WP Admin → Page → Template.
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php pls_page_hero(
        __( 'Contact Us', 'pakistan-legal-solutions' ),
        __( 'Schedule a free consultation with our legal team', 'pakistan-legal-solutions' )
    ); ?>

    <section class="contact-section">
        <div class="container">
            <div class="contact-layout">

                <?php // Left: Form ?>
                <div class="contact-layout__form">
                    <h2 class="contact-layout__heading">
                        <?php esc_html_e( 'Send Us a Message', 'pakistan-legal-solutions' ); ?>
                    </h2>
                    <?php get_template_part( 'template-parts/forms/contact-form' ); ?>
                </div>

                <?php // Right: Info ?>
                <div class="contact-layout__info">
                    <h2 class="contact-layout__heading">
                        <?php esc_html_e( 'Our Office', 'pakistan-legal-solutions' ); ?>
                    </h2>

                    <div class="contact-info">
                        <div class="contact-info__item">
                            <?php echo pls_icon( 'map-pin' ); ?>
                            <div>
                                <strong><?php esc_html_e( 'Address', 'pakistan-legal-solutions' ); ?></strong>
                                <p>2nd Floor, Commerce Centre<br>MM Alam Road, Gulberg III<br>Lahore 54660, Pakistan</p>
                            </div>
                        </div>
                        <div class="contact-info__item">
                            <?php echo pls_icon( 'phone' ); ?>
                            <div>
                                <strong><?php esc_html_e( 'Phone', 'pakistan-legal-solutions' ); ?></strong>
                                <p><a href="tel:+924235710000">+92 42 3571 0000</a></p>
                                <p><a href="https://wa.me/923001234567">WhatsApp: +92 300 123 4567</a></p>
                            </div>
                        </div>
                        <div class="contact-info__item">
                            <?php echo pls_icon( 'mail' ); ?>
                            <div>
                                <strong><?php esc_html_e( 'Email', 'pakistan-legal-solutions' ); ?></strong>
                                <p><a href="mailto:info@pakistanlegalsolution.com">info@pakistanlegalsolution.com</a></p>
                            </div>
                        </div>
                        <div class="contact-info__item">
                            <?php echo pls_icon( 'clock' ); ?>
                            <div>
                                <strong><?php esc_html_e( 'Office Hours', 'pakistan-legal-solutions' ); ?></strong>
                                <p>Saturday – Thursday: 9am – 6pm<br>Friday: Closed (Jumu'ah)</p>
                            </div>
                        </div>
                    </div>

                    <?php // Google Maps Embed ?>
                    <div class="contact-map">
                        <iframe
                            title="<?php esc_attr_e( 'Pakistan Legal Solutions — office location', 'pakistan-legal-solutions' ); ?>"
                            src="https://www.google.com/maps/embed?pb=REPLACE_WITH_YOUR_EMBED_URL"
                            width="100%"
                            height="280"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                </div><!-- .contact-layout__info -->

            </div><!-- .contact-layout -->
        </div><!-- .container -->
    </section>

</main>

<?php get_footer(); ?>