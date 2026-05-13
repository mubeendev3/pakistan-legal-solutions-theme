/**
 * Pakistan Legal Solutions — main theme script (single classic file).
 * Intentionally not ES modules: sub-path imports often fail on WP hosts
 * (MIME/CORS/URL mismatch), which breaks navigation with no console noise for users.
 */

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

    var prefersReducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    if ( prefersReducedMotion ) return;

    var animatedElements = document.querySelectorAll( '[data-animate]' );

    if ( ! animatedElements.length ) return;

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

document.addEventListener( 'DOMContentLoaded', function() {
    initNavigation();
    initAnimations();
    initSmoothScroll();
    initWhatsappFloat();
} );
