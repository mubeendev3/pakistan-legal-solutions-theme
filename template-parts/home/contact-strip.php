<?php
/**
 * Homepage — contact summary strip.
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;
?>

<section class="contact-strip" aria-label="<?php esc_attr_e( 'Contact information', 'pakistan-legal-solutions' ); ?>">
    <div class="container contact-strip__grid">
        <div>
            <h2 class="contact-strip__heading"><?php esc_html_e( 'Visit or write to us', 'pakistan-legal-solutions' ); ?></h2>
            <p class="contact-strip__lead"><?php esc_html_e( 'Commerce Centre, MM Alam Road—convenient for meetings across Lahore and online consults nationwide.', 'pakistan-legal-solutions' ); ?></p>
        </div>
        <div class="contact-strip__block">
            <span class="contact-strip__label"><?php esc_html_e( 'Phone', 'pakistan-legal-solutions' ); ?></span>
            <a href="tel:+924235710000">+92 42 3571 0000</a>
        </div>
        <div class="contact-strip__block">
            <span class="contact-strip__label"><?php esc_html_e( 'Email & hours', 'pakistan-legal-solutions' ); ?></span>
            <a href="mailto:info@pakistanlegalsolutions.com">info@pakistanlegalsolutions.com</a>
            <span><?php esc_html_e( 'Sat–Thu · 9am–6pm PKT', 'pakistan-legal-solutions' ); ?></span>
        </div>
    </div>
</section>
