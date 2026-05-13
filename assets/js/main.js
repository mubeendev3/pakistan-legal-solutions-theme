/**
 * Pakistan Legal Solutions — main theme script (single classic file).
 * Intentionally not ES modules: sub-path imports often fail on WP hosts
 * (MIME/CORS/URL mismatch), which breaks navigation with no console noise for users.
 */

function prefersReducedMotion() {
    return window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
}

function initNavigation() {

    const header     = document.getElementById( 'site-header' );
    const toggle     = document.getElementById( 'mobile-menu-toggle' );
    const menu       = document.getElementById( 'mobile-menu' );
    const closeBtn   = document.getElementById( 'mobile-menu-close' );
    const overlay    = document.getElementById( 'mobile-menu-overlay' );

    if ( ! header ) return;

    if ( typeof IntersectionObserver !== 'undefined' ) {
        const stickyObserver = new IntersectionObserver(
            function( entries ) {
                var entry = entries[ 0 ];
                header.classList.toggle( 'site-header--scrolled', ! entry.isIntersecting );
            },
            { rootMargin: '-' + header.offsetHeight + 'px 0px 0px 0px' }
        );

        var sentinel = document.createElement( 'div' );
        sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px;pointer-events:none;';
        document.body.prepend( sentinel );
        stickyObserver.observe( sentinel );
    }

    if ( ! toggle || ! menu ) return;

    var mqDesktop = window.matchMedia( '(min-width: 960px)' );

    function openMenu() {
        if ( mqDesktop.matches ) return;
        menu.classList.add( 'is-open' );
        menu.setAttribute( 'aria-hidden', 'false' );
        toggle.setAttribute( 'aria-expanded', 'true' );
        if ( overlay ) {
            overlay.classList.add( 'is-visible' );
            overlay.setAttribute( 'aria-hidden', 'false' );
        }
        document.body.style.overflow = 'hidden';
        if ( closeBtn ) {
            closeBtn.focus();
        }
    }

    function closeMenu() {
        menu.classList.remove( 'is-open' );
        menu.setAttribute( 'aria-hidden', 'true' );
        toggle.setAttribute( 'aria-expanded', 'false' );
        if ( overlay ) {
            overlay.classList.remove( 'is-visible' );
            overlay.setAttribute( 'aria-hidden', 'true' );
        }
        document.body.style.overflow = '';
        if ( ! mqDesktop.matches ) {
            toggle.focus();
        }
    }

    toggle.addEventListener( 'click', openMenu );

    if ( closeBtn ) {
        closeBtn.addEventListener( 'click', function( e ) {
            e.preventDefault();
            closeMenu();
        } );
    }
    if ( overlay ) {
        overlay.addEventListener( 'click', closeMenu );
    }

    document.addEventListener( 'keydown', function( e ) {
        if ( e.key === 'Escape' && menu.classList.contains( 'is-open' ) ) {
            closeMenu();
        }
    } );

    function onViewportChange() {
        if ( mqDesktop.matches && menu.classList.contains( 'is-open' ) ) {
            closeMenu();
        }
    }
    if ( typeof mqDesktop.addEventListener === 'function' ) {
        mqDesktop.addEventListener( 'change', onViewportChange );
    } else if ( typeof mqDesktop.addListener === 'function' ) {
        mqDesktop.addListener( onViewportChange );
    }
}

function initAnimations() {

    if ( prefersReducedMotion() ) return;

    var animatedElements = document.querySelectorAll( '[data-animate]' );

    if ( ! animatedElements.length ) return;

    animatedElements.forEach( function( el ) {
        var d = el.getAttribute( 'data-delay' );
        if ( d !== null && d !== '' && ! isNaN( parseInt( d, 10 ) ) ) {
            el.style.setProperty( '--pls-reveal-delay', parseInt( d, 10 ) + 'ms' );
        }
    } );

    var observer = new IntersectionObserver(
        function( entries ) {
            entries.forEach( function( entry ) {
                if ( entry.isIntersecting ) {
                    entry.target.classList.add( 'is-animated' );
                    observer.unobserve( entry.target );
                }
            } );
        },
        {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px',
        }
    );

    animatedElements.forEach( function( el ) {
        observer.observe( el );
    } );
}

function easeOutCubic( t ) {
    return 1 - Math.pow( 1 - t, 3 );
}

function initCounters() {
    var stats = document.querySelector( '.hero__stats' );
    if ( ! stats ) return;

    var els = stats.querySelectorAll( '[data-pls-counter][data-target]' );
    if ( ! els.length ) return;

    if ( prefersReducedMotion() ) return;

    var duration = 2000;
    var started = false;

    function formatValue( n, suffix ) {
        var s = suffix == null ? '' : String( suffix );
        if ( s === '%' ) {
            return Math.round( n ) + s;
        }
        return Math.round( n ) + s;
    }

    function run() {
        if ( started ) return;
        started = true;
        var start = null;

        function frame( ts ) {
            if ( start === null ) start = ts;
            var p = Math.min( 1, ( ts - start ) / duration );
            var e = easeOutCubic( p );
            els.forEach( function( el ) {
                var target = parseFloat( el.getAttribute( 'data-target' ) );
                var suffix = el.getAttribute( 'data-suffix' ) || '';
                if ( isNaN( target ) ) return;
                el.textContent = formatValue( target * e, suffix );
            } );
            if ( p < 1 ) {
                requestAnimationFrame( frame );
            } else {
                els.forEach( function( el ) {
                    var target = parseFloat( el.getAttribute( 'data-target' ) );
                    var suffix = el.getAttribute( 'data-suffix' ) || '';
                    if ( ! isNaN( target ) ) {
                        el.textContent = formatValue( target, suffix );
                    }
                } );
            }
        }
        requestAnimationFrame( frame );
    }

    if ( typeof IntersectionObserver === 'undefined' ) {
        run();
        return;
    }

    var io = new IntersectionObserver(
        function( entries ) {
            entries.forEach( function( entry ) {
                if ( entry.isIntersecting ) {
                    run();
                    io.disconnect();
                }
            } );
        },
        { threshold: 0.2, rootMargin: '0px' }
    );
    io.observe( stats );
}

function initScrollProgress() {
    var bar = document.getElementById( 'pls-scroll-progress' );
    if ( ! bar ) return;

    function update() {
        var doc = document.documentElement;
        var scrollTop = window.scrollY || doc.scrollTop;
        var max = ( doc.scrollHeight || 0 ) - window.innerHeight;
        var t = max > 0 ? scrollTop / max : 0;
        doc.style.setProperty( '--pls-scroll', String( Math.min( 1, Math.max( 0, t ) ) ) );
    }

    window.addEventListener( 'scroll', update, { passive: true } );
    window.addEventListener( 'resize', update, { passive: true } );
    update();
}

function initPageTransitions() {
    if ( prefersReducedMotion() ) return;

    if ( sessionStorage.getItem( 'plsPageNav' ) === '1' ) {
        sessionStorage.removeItem( 'plsPageNav' );
        document.body.classList.add( 'pls-page-enter' );
        window.setTimeout( function() {
            document.body.classList.remove( 'pls-page-enter' );
        }, 400 );
    }

    document.addEventListener(
        'click',
        function( e ) {
            if ( e.defaultPrevented || e.button !== 0 ) return;
            if ( e.metaKey || e.ctrlKey || e.shiftKey || e.altKey ) return;

            var a = e.target.closest( 'a' );
            if ( ! a || a.target === '_blank' ) return;
            if ( a.hasAttribute( 'download' ) ) return;
            if ( a.getAttribute( 'data-no-page-transition' ) !== null ) return;

            var href = a.getAttribute( 'href' );
            if ( ! href || href.charAt( 0 ) === '#' ) return;
            if ( href.indexOf( 'mailto:' ) === 0 || href.indexOf( 'tel:' ) === 0 ) return;

            var url;
            try {
                url = new URL( a.href, window.location.href );
            } catch ( err ) {
                return;
            }

            if ( url.origin !== window.location.origin ) return;
            if ( url.pathname.indexOf( '/wp-admin' ) === 0 || url.pathname.indexOf( '/wp-login.php' ) === 0 ) return;
            if ( url.pathname === window.location.pathname && url.search === window.location.search ) return;

            e.preventDefault();
            document.body.classList.add( 'pls-page-exit' );
            sessionStorage.setItem( 'plsPageNav', '1' );
            window.setTimeout( function() {
                window.location.assign( a.href );
            }, 200 );
        },
        false
    );
}

function initSmoothScroll() {
    /* Reserved for anchor smooth-scroll behaviour */
}

function initWhatsappFloat() {
    var btn = document.getElementById( 'pls-whatsapp-float' );
    if ( ! btn ) return;

    function onScroll() {
        if ( window.scrollY > 300 ) {
            btn.classList.add( 'is-visible' );
        } else {
            btn.classList.remove( 'is-visible' );
        }
    }

    window.addEventListener( 'scroll', onScroll, { passive: true } );
    onScroll();
}

function initHeroConsultForm() {
    var form    = document.getElementById( 'hero-consult-form' );
    var card    = form ? form.closest( '.hero-consult-card' ) : null;
    var submit  = document.getElementById( 'hero-consult-submit' );
    var errEl   = document.getElementById( 'hero-consult-error' );
    var okEl    = document.getElementById( 'hero-consult-success' );
    var txtSpan = submit ? submit.querySelector( '.hero-consult-card__submit-text' ) : null;
    var loadSpan = submit ? submit.querySelector( '.hero-consult-card__submit-loading' ) : null;

    if ( ! form || ! card || ! submit || ! errEl || ! okEl ) return;

    var ajaxUrl = typeof plsData !== 'undefined' && plsData.ajaxUrl ? plsData.ajaxUrl : form.action;

    function phoneOk( v ) {
        return /^[\d\s\+\-\(\)]{7,22}$/.test( String( v ).trim() );
    }

    function validate() {
        var name = form.querySelector( '[name="name"]' );
        var phone = form.querySelector( '[name="phone"]' );
        var area = form.querySelector( '[name="practice_area"]' );
        var msg = form.querySelector( '[name="message"]' );
        if ( ! name || ! phone || ! area || ! msg ) return false;
        if ( name.value.trim().length < 2 ) {
            errEl.textContent = 'Please enter your full name.';
            errEl.hidden = false;
            return false;
        }
        if ( ! phoneOk( phone.value ) ) {
            errEl.textContent = 'Please enter a valid phone number.';
            errEl.hidden = false;
            return false;
        }
        if ( ! area.value ) {
            errEl.textContent = 'Please select a practice area.';
            errEl.hidden = false;
            return false;
        }
        if ( msg.value.trim().length < 10 ) {
            errEl.textContent = 'Please describe your matter (at least 10 characters).';
            errEl.hidden = false;
            return false;
        }
        errEl.textContent = '';
        errEl.hidden = true;
        return true;
    }

    form.addEventListener( 'submit', function( e ) {
        e.preventDefault();
        if ( ! validate() ) return;

        submit.disabled = true;
        if ( txtSpan ) txtSpan.hidden = true;
        if ( loadSpan ) loadSpan.removeAttribute( 'hidden' );

        var fd = new FormData( form );

        fetch( ajaxUrl, {
            method: 'POST',
            body: fd,
        } )
            .then( function( res ) {
                return res.json();
            } )
            .then( function( data ) {
                if ( data.success ) {
                    card.classList.add( 'is-success' );
                    okEl.removeAttribute( 'hidden' );
                    errEl.hidden = true;
                    errEl.textContent = '';
                } else {
                    errEl.textContent = ( data.data && data.data.message ) ? data.data.message : 'Something went wrong. Please try again.';
                    errEl.hidden = false;
                }
            } )
            .catch( function() {
                errEl.textContent = 'Something went wrong. Please call us directly.';
                errEl.hidden = false;
            } )
            .finally( function() {
                submit.disabled = false;
                if ( txtSpan ) txtSpan.hidden = false;
                if ( loadSpan ) loadSpan.setAttribute( 'hidden', '' );
            } );
    } );
}

document.addEventListener( 'DOMContentLoaded', function() {
    initScrollProgress();
    initPageTransitions();
    initNavigation();
    initAnimations();
    initCounters();
    initSmoothScroll();
    initWhatsappFloat();
    initHeroConsultForm();
} );
