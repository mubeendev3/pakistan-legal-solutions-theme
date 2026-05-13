<?php
/**
 * Canonical contact URLs, phones, and social links for the theme.
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

/**
 * Primary inbox for contact form and site copy.
 */
function pls_contact_email(): string {
    return apply_filters( 'pls_contact_email', 'info@pakistanlegalsolutions.com' );
}

/**
 * From-address domain for transactional mail (must exist on host).
 */
function pls_contact_mail_from_email(): string {
    return apply_filters( 'pls_contact_mail_from_email', 'noreply@pakistanlegalsolutions.com' );
}

function pls_phone_primary_display(): string {
    return '0304-1234007';
}

function pls_phone_primary_tel(): string {
    return '+923041234007';
}

function pls_phone_secondary_display(): string {
    return '0300-0029023';
}

function pls_phone_secondary_tel(): string {
    return '+923000029023';
}

function pls_whatsapp_chat_url(): string {
    return 'https://wa.me/923041234007';
}

function pls_whatsapp_channel_url(): string {
    return 'https://whatsapp.com/channel/0029VbAJveFBqbr29Xfyb22L';
}

/**
 * @return array<string, array{url:string, label:string, icon:string}>
 */
function pls_social_profiles(): array {
    return [
        'facebook'  => [
            'url'   => 'https://www.facebook.com/share/1GPeaygLK4/',
            'label' => 'Facebook',
            'icon'  => 'facebook',
        ],
        'linkedin'  => [
            'url'   => 'https://www.linkedin.com/company/pakistanlegalsolutions/',
            'label' => 'LinkedIn',
            'icon'  => 'linkedin',
        ],
        'instagram' => [
            'url'   => 'https://www.instagram.com/pakistanlegalsolutions?igsh=MXdsOGJ6ZG5lOTFl',
            'label' => 'Instagram',
            'icon'  => 'instagram',
        ],
        'youtube'   => [
            'url'   => 'https://youtube.com/@pakistanlegalsolutions?si=MVFkKk8yRq8MQsEs',
            'label' => 'YouTube',
            'icon'  => 'youtube',
        ],
        'tiktok'    => [
            'url'   => 'https://www.tiktok.com/@pakistanlegalsolutions',
            'label' => 'TikTok',
            'icon'  => 'tiktok',
        ],
        'whatsapp'  => [
            'url'   => pls_whatsapp_chat_url(),
            'label' => 'WhatsApp',
            'icon'  => 'whatsapp',
        ],
    ];
}
