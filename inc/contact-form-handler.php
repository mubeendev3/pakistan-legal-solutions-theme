<?php
/**
 * Contact Form AJAX Handler
 * Processes form submissions securely.
 * Responds with JSON — consumed by contact-form.js
 */
defined( 'ABSPATH' ) || exit;

// Handle for both logged-in and non-logged-in users
add_action( 'wp_ajax_pls_contact_form',        'pls_handle_contact_form' );
add_action( 'wp_ajax_nopriv_pls_contact_form', 'pls_handle_contact_form' );

function pls_handle_contact_form(): void {

    // ── 1. Verify nonce ────────────────────────────────────────────────────
    if ( ! check_ajax_referer( 'pls_contact_form', 'nonce', false ) ) {
        wp_send_json_error( [ 'message' => __( 'Security check failed. Please reload the page and try again.', 'pakistan-legal-solutions' ) ], 403 );
    }

    // ── 2. Honeypot check (spam bot trap) ──────────────────────────────────
    if ( ! empty( $_POST['website'] ) ) {
        // Silently succeed (don't tell bots they were caught)
        wp_send_json_success( [ 'message' => __( 'Thank you! We will be in touch soon.', 'pakistan-legal-solutions' ) ] );
    }

    // ── 3. Rate limiting (simple: 3 submissions per hour per IP) ──────────
    $ip         = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $rate_key   = 'pls_form_rate_' . md5( $ip );
    $rate_count = (int) get_transient( $rate_key );

    if ( $rate_count >= 3 ) {
        wp_send_json_error( [ 'message' => __( 'Too many submissions. Please wait an hour before trying again, or call us directly.', 'pakistan-legal-solutions' ) ], 429 );
    }

    // ── 4. Sanitize and validate inputs ───────────────────────────────────
    $name          = sanitize_text_field( $_POST['name']          ?? '' );
    $email         = sanitize_email(      $_POST['email']         ?? '' );
    $phone         = sanitize_text_field( $_POST['phone']         ?? '' );
    $practice_area = sanitize_text_field( $_POST['practice_area'] ?? '' );
    $message       = sanitize_textarea_field( $_POST['message']   ?? '' );

    $errors = [];

    if ( strlen( $name ) < 2 )                 $errors[] = 'Name is required.';
    if ( ! is_email( $email ) )                $errors[] = 'Valid email is required.';
    if ( strlen( $phone ) < 7 )                $errors[] = 'Phone number is required.';
    if ( empty( $practice_area ) )             $errors[] = 'Practice area is required.';
    if ( strlen( $message ) < 10 )             $errors[] = 'Please provide more detail about your matter.';

    if ( ! empty( $errors ) ) {
        wp_send_json_error( [ 'message' => implode( ' ', $errors ) ], 422 );
    }

    // ── 5. Build and send email ────────────────────────────────────────────
    $to       = pls_contact_email();
    $from_web = pls_contact_mail_from_email();
    if ( ! is_email( $to ) ) {
        $to = get_option( 'admin_email' );
    }
    $subject  = sprintf(
        '[Pakistan Legal Solutions] New Inquiry: %s — %s',
        ucfirst( str_replace( '-', ' ', $practice_area ) ),
        $name
    );

    $body  = "New contact form submission from " . wp_parse_url( home_url(), PHP_URL_HOST ) . "\n";
    $body .= "=================================================\n\n";
    $body .= "Name:          {$name}\n";
    $body .= "Email:         {$email}\n";
    $body .= "Phone:         {$phone}\n";
    $body .= "Practice Area: {$practice_area}\n\n";
    $body .= "Message:\n{$message}\n\n";
    $body .= "=================================================\n";
    $body .= 'Submitted: ' . wp_date( 'F j, Y \a\t g:i a T' ) . "\n";
    $body .= 'IP Address: ' . esc_html( $ip ) . "\n";
    $body .= 'Page: ' . esc_html( wp_get_referer() ?: 'Unknown' ) . "\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: Pakistan Legal Solutions Website <' . $from_web . '>',
        "Reply-To: {$name} <{$email}>",
    ];

    $sent = wp_mail( $to, $subject, $body, $headers );

    // ── 6. Send auto-reply to client ───────────────────────────────────────
    if ( $sent ) {
        $reply_subject = __( 'Your Inquiry Has Been Received — Pakistan Legal Solutions', 'pakistan-legal-solutions' );
        $reply_body    = sprintf(
            "Dear %s,\n\nThank you for contacting Pakistan Legal Solutions.\n\n" .
            "We have received your inquiry regarding %s and one of our attorneys will contact you within 24 hours.\n\n" .
            "If your matter is urgent, please call us at %s or %s.\n\n" .
            "Kind regards,\nPakistan Legal Solutions\n" .
            "MM Alam Road, Gulberg IV, Lahore, Pakistan\n" .
            "%s\n",
            esc_html( $name ),
            esc_html( ucfirst( str_replace( '-', ' ', $practice_area ) ) ),
            esc_html( pls_phone_primary_display() ),
            esc_html( pls_phone_secondary_display() ),
            esc_html( pls_phone_primary_display() . ' · ' . pls_phone_secondary_display() . ' · ' . pls_contact_email() )
        );
        wp_mail(
            $email,
            $reply_subject,
            $reply_body,
            [
                'Content-Type: text/plain; charset=UTF-8',
                'From: Pakistan Legal Solutions <' . $from_web . '>',
            ]
        );
    }

    // ── 7. Increment rate limit counter ───────────────────────────────────
    set_transient( $rate_key, $rate_count + 1, HOUR_IN_SECONDS );

    // ── 8. Respond ────────────────────────────────────────────────────────
    if ( $sent ) {
        wp_send_json_success( [
            'message' => sprintf(
                /* translators: %s: submitter first name */
                __( 'Thank you, %s! Your message has been received. We will contact you within 24 hours.', 'pakistan-legal-solutions' ),
                esc_html( $name )
            ),
        ] );
    } else {
        wp_send_json_error(
            [
                'message' => sprintf(
                    /* translators: %s: primary phone display */
                    __( 'Message could not be sent. Please call us at %s.', 'pakistan-legal-solutions' ),
                    esc_html( pls_phone_primary_display() )
                ),
            ],
            500
        );
    }
}
