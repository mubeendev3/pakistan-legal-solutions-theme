/**
 * Scroll Animations Module
 * Uses IntersectionObserver — no libraries needed.
 * Respects prefers-reduced-motion.
 */

export function initAnimations() {

    // Respect user's motion preference
    const prefersReducedMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    if ( prefersReducedMotion ) return;

    const animatedElements = document.querySelectorAll( '[data-animate]' );

    if ( ! animatedElements.length ) return;

    const observer = new IntersectionObserver(
        ( entries ) => {
            entries.forEach( ( entry ) => {
                if ( entry.isIntersecting ) {
                    entry.target.classList.add( 'is-animated' );
                    // Unobserve after animation fires (performance)
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

// Usage in PHP templates: add data-animate="fade-up" to any element.
// CSS handles the actual animation via .is-animated class.