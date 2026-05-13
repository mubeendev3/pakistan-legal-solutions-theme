/**
 * Navigation Module
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

    // ── Sticky header ──────────────────────────────────────────────────────
    const stickyObserver = new IntersectionObserver(
        ( [ entry ] ) => {
            header.classList.toggle( 'site-header--scrolled', ! entry.isIntersecting );
        },
        { rootMargin: `-${ header.offsetHeight }px 0px 0px 0px` }
    );

    // Observe a sentinel element at the top of the page
    const sentinel = document.createElement( 'div' );
    sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px;pointer-events:none;';
    document.body.prepend( sentinel );
    stickyObserver.observe( sentinel );

    // ── Mobile menu ────────────────────────────────────────────────────────
    if ( ! toggle || ! menu ) return;

    function openMenu() {
        menu.classList.add( 'is-open' );
        menu.setAttribute( 'aria-hidden', 'false' );
        toggle.setAttribute( 'aria-expanded', 'true' );
        overlay?.classList.add( 'is-visible' );
        document.body.style.overflow = 'hidden'; // Lock scroll
        closeBtn?.focus();
    }

    function closeMenu() {
        menu.classList.remove( 'is-open' );
        menu.setAttribute( 'aria-hidden', 'true' );
        toggle.setAttribute( 'aria-expanded', 'false' );
        overlay?.classList.remove( 'is-visible' );
        document.body.style.overflow = '';
        toggle.focus();
    }

    toggle.addEventListener( 'click', openMenu );
    closeBtn?.addEventListener( 'click', closeMenu );
    overlay?.addEventListener( 'click', closeMenu );

    // Close on Escape key
    document.addEventListener( 'keydown', ( e ) => {
        if ( e.key === 'Escape' && menu.classList.contains( 'is-open' ) ) {
            closeMenu();
        }
    } );
}