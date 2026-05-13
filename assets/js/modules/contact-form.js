/**
 * Contact Form Module
 * - Client-side validation
 * - AJAX submission (no page reload)
 * - Success/error states
 * - Loading state on button
 */

function initContactForm() {

    const form     = document.getElementById( 'contact-form' );
    const submit   = document.getElementById( 'cf-submit' );
    const response = document.getElementById( 'form-response' );

    if ( ! form ) return;

    // ── Validation ─────────────────────────────────────────────────────────
    const validators = {
        name:          ( v ) => v.trim().length >= 2,
        email:         ( v ) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test( v ),
        phone:         ( v ) => /^[\d\s\+\-\(\)]{7,22}$/.test( v.trim() ),
        practice_area: ( v ) => v !== '',
        message:       ( v ) => v.trim().length >= 10,
    };

    const errorMessages = {
        name:          'Please enter your full name.',
        email:         'Please enter a valid email address.',
        phone:         'Please enter a valid phone number.',
        practice_area: 'Please select a practice area.',
        message:       'Please describe your matter (at least 10 characters).',
    };

    function validateField( input ) {
        const name    = input.name;
        const value   = input.value;
        const isValid = validators[ name ] ? validators[ name ]( value ) : true;
        const errorEl = input.closest( '.form-field' )?.querySelector( '.form-error' );

        input.classList.toggle( 'is-invalid', ! isValid );
        input.classList.toggle( 'is-valid', isValid );

        if ( errorEl ) {
            errorEl.textContent = isValid ? '' : ( errorMessages[ name ] || 'This field is required.' );
        }

        return isValid;
    }

    // Validate on blur (user leaves field)
    form.querySelectorAll( 'input, select, textarea' ).forEach( ( input ) => {
        input.addEventListener( 'blur', () => validateField( input ) );
    } );

    // ── Submission ─────────────────────────────────────────────────────────
    form.addEventListener( 'submit', async ( e ) => {
        e.preventDefault();

        // Validate all fields
        const inputs    = form.querySelectorAll( 'input:not([type="hidden"]):not([name="website"]), select, textarea' );
        const allValid  = [ ...inputs ].map( validateField ).every( Boolean );

        if ( ! allValid ) {
            // Focus first invalid field
            form.querySelector( '.is-invalid' )?.focus();
            return;
        }

        // Set loading state
        submit.disabled = true;
        submit.querySelector( '.btn-text' ).style.display    = 'none';
        submit.querySelector( '.btn-loading' ).style.display = 'inline';
        response.textContent = '';
        response.className   = 'form-response';

        try {
            const formData = new FormData( form );
            const res      = await fetch( form.action, {
                method: 'POST',
                body:   formData,
            } );

            const data = await res.json();

            if ( data.success ) {
                response.textContent = data.data.message || 'Thank you! We will be in touch within 24 hours.';
                response.classList.add( 'form-response--success' );
                form.reset();
                form.querySelectorAll( '.is-valid' ).forEach( ( el ) => el.classList.remove( 'is-valid' ) );
            } else {
                throw new Error( data.data?.message || 'Submission failed.' );
            }

        } catch ( err ) {
            response.textContent = err.message || 'Something went wrong. Please call us directly.';
            response.classList.add( 'form-response--error' );
        } finally {
            submit.disabled = false;
            submit.querySelector( '.btn-text' ).style.display    = 'inline';
            submit.querySelector( '.btn-loading' ).style.display = 'none';
            response.scrollIntoView( { behavior: 'smooth', block: 'nearest' } );
        }
    } );
}

document.addEventListener( 'DOMContentLoaded', initContactForm );