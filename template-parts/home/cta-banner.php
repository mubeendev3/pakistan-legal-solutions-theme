<?php
/**
 * Homepage — primary CTA band.
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;
?>

<section class="cta-banner" aria-labelledby="cta-banner-heading">
    <div class="container cta-banner__inner">
        <div>
            <h2 class="cta-banner__title" id="cta-banner-heading"><?php esc_html_e( 'Ready for clear advice and decisive action?', 'pakistan-legal-solutions' ); ?></h2>
            <p class="cta-banner__text"><?php esc_html_e( 'Tell us what you are facing. We will respond with a practical path forward—usually within one business day.', 'pakistan-legal-solutions' ); ?></p>
        </div>
        <div class="cta-banner__actions">
            <a class="btn btn--gold btn--lg" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Book free consultation', 'pakistan-legal-solutions' ); ?></a>
            <a class="btn btn--outline-white btn--lg" href="<?php echo esc_url( 'tel:' . pls_phone_primary_tel() ); ?>"><?php esc_html_e( 'Call the office', 'pakistan-legal-solutions' ); ?></a>
        </div>
    </div>
</section>
