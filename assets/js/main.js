/**
 * Pakistan Legal Solutions theme — main JavaScript
 * Imports and initializes all modules.
 * 
 * Uses vanilla ES6+. No jQuery. No build step required.
 * This file is loaded deferred in the footer via wp_enqueue_script.
 */

import { initNavigation } from './modules/navigation.js';
import { initAnimations } from './modules/animations.js';
import { initSmoothScroll } from './modules/smooth-scroll.js';

document.addEventListener( 'DOMContentLoaded', () => {
    initNavigation();
    initAnimations();
    initSmoothScroll();
} );