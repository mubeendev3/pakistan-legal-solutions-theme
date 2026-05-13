/**
 * Scroll animations + counters (ES module copy — theme loads main.js).
 * Respects prefers-reduced-motion.
 */

function prefersReducedMotion() {
    return window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
}

function easeOutCubic( t ) {
    return 1 - Math.pow( 1 - t, 3 );
}

export function initAnimations() {
    if ( prefersReducedMotion() ) return;

    const animatedElements = document.querySelectorAll( '[data-animate]' );
    if ( ! animatedElements.length ) return;

    animatedElements.forEach( ( el ) => {
        const d = el.getAttribute( 'data-delay' );
        if ( d !== null && d !== '' && ! isNaN( parseInt( d, 10 ) ) ) {
            el.style.setProperty( '--pls-reveal-delay', `${ parseInt( d, 10 ) }ms` );
        }
    } );

    const observer = new IntersectionObserver(
        ( entries ) => {
            entries.forEach( ( entry ) => {
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

    animatedElements.forEach( ( el ) => observer.observe( el ) );
}

export function initCounters() {
    const stats = document.querySelector( '.hero__stats' );
    if ( ! stats ) return;

    const els = stats.querySelectorAll( '[data-pls-counter][data-target]' );
    if ( ! els.length ) return;

    if ( prefersReducedMotion() ) return;

    const duration = 2000;
    let started = false;

    function formatValue( n, suffix ) {
        const s = suffix == null ? '' : String( suffix );
        if ( s === '%' ) {
            return `${ Math.round( n ) }${ s }`;
        }
        return `${ Math.round( n ) }${ s }`;
    }

    function run() {
        if ( started ) return;
        started = true;
        let start = null;

        function frame( ts ) {
            if ( start === null ) start = ts;
            const p = Math.min( 1, ( ts - start ) / duration );
            const e = easeOutCubic( p );
            els.forEach( ( el ) => {
                const target = parseFloat( el.getAttribute( 'data-target' ) );
                const suffix = el.getAttribute( 'data-suffix' ) || '';
                if ( isNaN( target ) ) return;
                el.textContent = formatValue( target * e, suffix );
            } );
            if ( p < 1 ) {
                requestAnimationFrame( frame );
            } else {
                els.forEach( ( el ) => {
                    const target = parseFloat( el.getAttribute( 'data-target' ) );
                    const suffix = el.getAttribute( 'data-suffix' ) || '';
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

    const io = new IntersectionObserver(
        ( entries ) => {
            entries.forEach( ( entry ) => {
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
