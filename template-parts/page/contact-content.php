<?php
/**
 * Contact page body (expects The Loop: `the_post()` has been called).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

pls_page_hero(
    get_the_title(),
    __( 'Schedule a confidential consultation. We respond quickly with clear next steps.', 'pakistan-legal-solutions' )
);
?>

<section class="contact-intro section section--sm" aria-labelledby="contact-intro-heading">
    <div class="container">
        <header class="section-header">
            <p class="section-eyebrow"><?php esc_html_e( 'Get in touch', 'pakistan-legal-solutions' ); ?></p>
            <h2 class="section-title" id="contact-intro-heading"><?php esc_html_e( 'Tell us what you need', 'pakistan-legal-solutions' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Use the form for a written inquiry, or call the office during business hours for urgent matters.', 'pakistan-legal-solutions' ); ?></p>
        </header>
        <?php
        $intro = get_post_field( 'post_content', get_the_ID() );
        if ( trim( (string) $intro ) !== '' ) :
            ?>
            <div class="contact-intro__prose entry-content">
                <?php the_content(); ?>
            </div>
            <?php
        endif;
        ?>
    </div>
</section>

<section class="contact-panel section" aria-label="<?php esc_attr_e( 'Contact form and office details', 'pakistan-legal-solutions' ); ?>">
    <div class="container">
        <div class="contact-layout">

            <div class="contact-layout__form">
                <div class="contact-card">
                    <h2 class="contact-card__title"><?php esc_html_e( 'Send a message', 'pakistan-legal-solutions' ); ?></h2>
                    <p class="contact-card__lead"><?php esc_html_e( 'Briefly describe your matter. We will route it to the right advocate and reply as soon as possible.', 'pakistan-legal-solutions' ); ?></p>
                    <?php get_template_part( 'template-parts/forms/contact-form' ); ?>
                </div>
            </div>

            <aside class="contact-layout__info" aria-labelledby="contact-office-heading">
                <div class="contact-card contact-card--accent">
                    <h2 class="contact-card__title" id="contact-office-heading"><?php esc_html_e( 'Our office', 'pakistan-legal-solutions' ); ?></h2>
                    <p class="contact-card__lead"><?php esc_html_e( 'Commerce Centre, MM Alam Road — meetings by appointment.', 'pakistan-legal-solutions' ); ?></p>

                    <ul class="contact-info">
                        <li class="contact-info__item">
                            <span class="contact-info__icon" aria-hidden="true"><?php echo pls_icon( 'map-pin' ); ?></span>
                            <div>
                                <span class="contact-info__label"><?php esc_html_e( 'Address', 'pakistan-legal-solutions' ); ?></span>
                                <p class="contact-info__text">
                                    <?php esc_html_e( '2nd Floor, Commerce Centre', 'pakistan-legal-solutions' ); ?><br>
                                    <?php esc_html_e( 'MM Alam Road, Gulberg IV', 'pakistan-legal-solutions' ); ?><br>
                                    <?php esc_html_e( 'Lahore 54660, Pakistan', 'pakistan-legal-solutions' ); ?>
                                </p>
                            </div>
                        </li>
                        <li class="contact-info__item">
                            <span class="contact-info__icon" aria-hidden="true"><?php echo pls_icon( 'phone' ); ?></span>
                            <div>
                                <span class="contact-info__label"><?php esc_html_e( 'Phone', 'pakistan-legal-solutions' ); ?></span>
                                <p class="contact-info__text"><a href="<?php echo esc_url( 'tel:' . pls_phone_primary_tel() ); ?>"><?php echo esc_html( pls_phone_primary_display() ); ?></a></p>
                                <p class="contact-info__text"><a href="<?php echo esc_url( 'tel:' . pls_phone_secondary_tel() ); ?>"><?php echo esc_html( pls_phone_secondary_display() ); ?></a></p>
                                <p class="contact-info__text">
                                    <a href="<?php echo esc_url( pls_whatsapp_chat_url() ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'WhatsApp', 'pakistan-legal-solutions' ); ?></a>
                                </p>
                                <p class="contact-info__text">
                                    <a href="<?php echo esc_url( pls_whatsapp_channel_url() ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'WhatsApp channel', 'pakistan-legal-solutions' ); ?></a>
                                </p>
                            </div>
                        </li>
                        <li class="contact-info__item">
                            <span class="contact-info__icon" aria-hidden="true"><?php echo pls_icon( 'mail' ); ?></span>
                            <div>
                                <span class="contact-info__label"><?php esc_html_e( 'Email', 'pakistan-legal-solutions' ); ?></span>
                                <p class="contact-info__text">
                                    <a href="<?php echo esc_url( 'mailto:' . pls_contact_email() ); ?>"><?php echo esc_html( pls_contact_email() ); ?></a>
                                </p>
                            </div>
                        </li>
                        <li class="contact-info__item">
                            <span class="contact-info__icon" aria-hidden="true"><?php echo pls_icon( 'clock' ); ?></span>
                            <div>
                                <span class="contact-info__label"><?php esc_html_e( 'Hours', 'pakistan-legal-solutions' ); ?></span>
                                <p class="contact-info__text"><?php esc_html_e( 'Saturday – Thursday: 9am – 6pm PKT', 'pakistan-legal-solutions' ); ?></p>
                                <p class="contact-info__text"><?php esc_html_e( 'Friday: closed', 'pakistan-legal-solutions' ); ?></p>
                            </div>
                        </li>
                    </ul>

                    <div class="contact-map">
                        <?php
                        $map_embed = 'https://www.openstreetmap.org/export/embed.html?bbox=74.3400%2C31.5120%2C74.3580%2C31.5255&layer=mapnik&marker=31.5188%2C74.3490';
                        ?>
                        <iframe
                            title="<?php esc_attr_e( 'Office map — Commerce Centre, Lahore', 'pakistan-legal-solutions' ); ?>"
                            src="<?php echo esc_url( $map_embed ); ?>"
                            width="100%"
                            height="260"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="contact-map__frame"></iframe>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>

<section class="contact-trust" aria-label="<?php esc_attr_e( 'What to expect', 'pakistan-legal-solutions' ); ?>">
    <div class="container contact-trust__grid">
        <div class="contact-trust__item">
            <span class="contact-trust__title"><?php esc_html_e( 'Confidential', 'pakistan-legal-solutions' ); ?></span>
            <p class="contact-trust__text"><?php esc_html_e( 'Your inquiry is treated as confidential. Do not include bank passwords or highly sensitive documents in the first message.', 'pakistan-legal-solutions' ); ?></p>
        </div>
        <div class="contact-trust__item">
            <span class="contact-trust__title"><?php esc_html_e( 'Fast triage', 'pakistan-legal-solutions' ); ?></span>
            <p class="contact-trust__text"><?php esc_html_e( 'We aim to respond within one business day for most matters—sooner when deadlines are tight.', 'pakistan-legal-solutions' ); ?></p>
        </div>
        <div class="contact-trust__item">
            <span class="contact-trust__title"><?php esc_html_e( 'Clear next steps', 'pakistan-legal-solutions' ); ?></span>
            <p class="contact-trust__text"><?php esc_html_e( 'If we are not the right fit, we will say so honestly and point you in a better direction when we can.', 'pakistan-legal-solutions' ); ?></p>
        </div>
    </div>
</section>

<?php
get_template_part( 'template-parts/home/cta-banner' );
