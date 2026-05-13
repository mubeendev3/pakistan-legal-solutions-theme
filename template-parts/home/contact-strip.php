<?php
/**
 * Quick contact strip (phones + WhatsApp).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;
?>
<section class="contact-strip" aria-label="<?php esc_attr_e( 'Contact numbers', 'pakistan-legal-solutions' ); ?>">
    <div class="container contact-strip__inner">
        <a class="contact-strip__link" href="<?php echo esc_url( 'tel:' . pls_phone_primary_tel() ); ?>">
            <?php echo pls_icon( 'phone' ); ?>
            <span><?php echo esc_html( pls_phone_primary_display() ); ?></span>
        </a>
        <a class="contact-strip__link" href="<?php echo esc_url( 'tel:' . pls_phone_secondary_tel() ); ?>">
            <?php echo pls_icon( 'phone' ); ?>
            <span><?php echo esc_html( pls_phone_secondary_display() ); ?></span>
        </a>
        <a class="contact-strip__link contact-strip__link--wa" href="<?php echo esc_url( pls_whatsapp_chat_url() ); ?>" target="_blank" rel="noopener noreferrer">
            <?php echo pls_icon( 'whatsapp' ); ?>
            <span><?php esc_html_e( 'WhatsApp', 'pakistan-legal-solutions' ); ?></span>
        </a>
        <a class="contact-strip__link contact-strip__link--channel" href="<?php echo esc_url( pls_whatsapp_channel_url() ); ?>" target="_blank" rel="noopener noreferrer">
            <span><?php esc_html_e( 'WhatsApp channel', 'pakistan-legal-solutions' ); ?></span>
        </a>
    </div>
</section>
