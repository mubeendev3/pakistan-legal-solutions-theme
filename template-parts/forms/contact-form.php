<?php
/**
 * Contact Form HTML
 * Submission handled by inc/contact-form-handler.php via WordPress AJAX.
 */
defined( 'ABSPATH' ) || exit;

// Show success/error messages after non-JS form submit
$form_sent  = isset( $_GET['sent'] )  && '1' === $_GET['sent'];
$form_error = isset( $_GET['error'] ) && '1' === $_GET['error'];
?>

<?php if ( $form_sent ) : ?>
    <div class="form-notice form-notice--success" role="alert">
        <strong><?php esc_html_e( 'Thank you!', 'pakistan-legal-solutions' ); ?></strong>
        <?php esc_html_e( 'Your message has been received. We will contact you within 24 hours.', 'pakistan-legal-solutions' ); ?>
    </div>
<?php endif; ?>

<?php if ( $form_error ) : ?>
    <div class="form-notice form-notice--error" role="alert">
        <?php esc_html_e( 'Something went wrong. Please try again or call us directly.', 'pakistan-legal-solutions' ); ?>
    </div>
<?php endif; ?>

<form
    class="contact-form"
    id="contact-form"
    action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
    method="POST"
    novalidate>

    <?php // Security nonces — ALWAYS include these ?>
    <input type="hidden" name="action" value="pls_contact_form">
    <input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'pls_contact_form' ) ); ?>">

    <?php // Honeypot field — spam bots fill this in, humans don't ?>
    <div class="form-honeypot" aria-hidden="true" style="display:none;">
        <label for="website">Leave this empty</label>
        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
    </div>

    <div class="form-grid">

        <div class="form-field">
            <label for="cf-name" class="form-label">
                <?php esc_html_e( 'Full Name', 'pakistan-legal-solutions' ); ?>
                <span class="form-required" aria-label="required">*</span>
            </label>
            <input type="text"
                   id="cf-name"
                   name="name"
                   class="form-input"
                   required
                   autocomplete="name"
                   placeholder="<?php esc_attr_e( 'Ahmad Ali Khan', 'pakistan-legal-solutions' ); ?>">
            <span class="form-error" role="alert"></span>
        </div>

        <div class="form-field">
            <label for="cf-email" class="form-label">
                <?php esc_html_e( 'Email Address', 'pakistan-legal-solutions' ); ?>
                <span class="form-required" aria-label="required">*</span>
            </label>
            <input type="email"
                   id="cf-email"
                   name="email"
                   class="form-input"
                   required
                   autocomplete="email"
                   placeholder="you@email.com">
            <span class="form-error" role="alert"></span>
        </div>

        <div class="form-field">
            <label for="cf-phone" class="form-label">
                <?php esc_html_e( 'Phone Number', 'pakistan-legal-solutions' ); ?>
                <span class="form-required" aria-label="required">*</span>
            </label>
            <input type="tel"
                   id="cf-phone"
                   name="phone"
                   class="form-input"
                   required
                   autocomplete="tel"
                   placeholder="0304-1234007">
            <span class="form-error" role="alert"></span>
        </div>

        <div class="form-field">
            <label for="cf-practice-area" class="form-label">
                <?php esc_html_e( 'Practice Area', 'pakistan-legal-solutions' ); ?>
                <span class="form-required" aria-label="required">*</span>
            </label>
            <select id="cf-practice-area" name="practice_area" class="form-select" required>
                <option value=""><?php esc_html_e( 'Select a practice area', 'pakistan-legal-solutions' ); ?></option>
                <option value="family-law"><?php esc_html_e( 'Family Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="tax-law"><?php esc_html_e( 'Tax Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="property-law"><?php esc_html_e( 'Property Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="corporate-law"><?php esc_html_e( 'Corporate Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="labor-law"><?php esc_html_e( 'Labor Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="constitutional-law"><?php esc_html_e( 'Constitutional Law', 'pakistan-legal-solutions' ); ?></option>
                <option value="other"><?php esc_html_e( 'Other / General Inquiry', 'pakistan-legal-solutions' ); ?></option>
            </select>
            <span class="form-error" role="alert"></span>
        </div>

        <div class="form-field form-field--full">
            <label for="cf-message" class="form-label">
                <?php esc_html_e( 'Brief Description of Your Matter', 'pakistan-legal-solutions' ); ?>
                <span class="form-required" aria-label="required">*</span>
            </label>
            <textarea id="cf-message"
                      name="message"
                      class="form-textarea"
                      required
                      rows="5"
                      placeholder="<?php esc_attr_e( 'Please describe your legal matter briefly...', 'pakistan-legal-solutions' ); ?>"></textarea>
            <span class="form-error" role="alert"></span>
        </div>

    </div><!-- .form-grid -->

    <div class="form-footer">
        <button type="submit" class="btn btn--primary btn--lg" id="cf-submit">
            <span class="btn-text"><?php esc_html_e( 'Send My Inquiry', 'pakistan-legal-solutions' ); ?></span>
            <span class="btn-loading" aria-hidden="true" style="display:none;">
                <?php esc_html_e( 'Sending...', 'pakistan-legal-solutions' ); ?>
            </span>
        </button>
        <p class="form-privacy">
            <?php esc_html_e( 'Your information is confidential and protected by attorney-client privilege.', 'pakistan-legal-solutions' ); ?>
        </p>
    </div>

    <div class="form-response" id="form-response" role="alert" aria-live="polite"></div>

</form>