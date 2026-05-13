<?php
/**
 * Mobile navigation drawer.
 * Toggled by JavaScript in assets/js/modules/navigation.js
 */
defined( 'ABSPATH' ) || exit;
?>
<div class="mobile-menu" id="mobile-menu" aria-hidden="true" role="dialog" aria-label="<?php esc_attr_e( 'Mobile menu', 'pakistan-legal-solutions' ); ?>">
    <div class="mobile-menu__inner">

        <button type="button"
                class="mobile-menu__close"
                id="mobile-menu-close"
                aria-label="<?php esc_attr_e( 'Close menu', 'pakistan-legal-solutions' ); ?>">
            &times;
        </button>

        <?php
        wp_nav_menu( [
            'theme_location' => 'primary',
            'menu_class'     => 'mobile-menu__list',
            'container'      => false,
            'depth'          => 2,
            'fallback_cb'    => 'pls_primary_nav_fallback',
        ] );
        ?>

        <div class="mobile-menu__contact">
            <a href="tel:+924235710000" class="mobile-menu__phone">
                +92 42 3571 0000
            </a>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--primary btn--full">
                <?php esc_html_e( 'Free Consultation', 'pakistan-legal-solutions' ); ?>
            </a>
        </div>

    </div><!-- .mobile-menu__inner -->
</div><!-- .mobile-menu -->
<div class="mobile-menu-overlay" id="mobile-menu-overlay" aria-hidden="true"></div>