/**
 * Navigation Module (ES module copy — theme loads logic from ../main.js instead).
 * - Sticky header on scroll
 * - Mobile menu open/close
 * - Keyboard accessibility (Escape to close)
 * - Body scroll lock when mobile menu is open
 */

export function initNavigation() {

    const header     = document.getElementById( 'site-header' );
    const toggle     = document.getElementById( 'mobile-menu-toggle' );
    const menu       = document.getElementById( 'mobile-menu' );
    const closeBtn   = document.getElementById( 'mobile-menu-close' );
    const overlay    = document.getElementById( 'mobile-menu-overlay' );

    if ( ! header ) return;

    // ── Sticky header (skip if unsupported — do not block mobile menu init) ─
    if ( typeof IntersectionObserver !== 'undefined' ) {
        const stickyObserver = new IntersectionObserver(
            ( [ entry ] ) => {
                header.classList.toggle( 'site-header--scrolled', ! entry.isIntersecting );
            },
            { rootMargin: `-${ header.offsetHeight }px 0px 0px 0px` }
        );

        const sentinel = document.createElement( 'div' );
        sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px;pointer-events:none;';
        document.body.prepend( sentinel );
        stickyObserver.observe( sentinel );
    }

    // ── Mobile menu ────────────────────────────────────────────────────────
    if ( ! toggle || ! menu ) return;

    const mqDesktop = window.matchMedia( '(min-width: 960px)' );

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
        closeBtn.addEventListener( 'click', ( e ) => {
            e.preventDefault();
            closeMenu();
        } );
    }
    if ( overlay ) {
        overlay.addEventListener( 'click', closeMenu );
    }

    document.addEventListener( 'keydown', ( e ) => {
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
