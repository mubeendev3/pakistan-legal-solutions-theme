<?php
/**
 * Mobile off-canvas menu (markup lives outside .site-header; see header.php).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;
?>
<div class="mobile-menu-overlay" id="mobile-menu-overlay" aria-hidden="true"></div>

<nav class="mobile-menu" id="mobile-menu" aria-hidden="true" aria-label="<?php esc_attr_e( 'Mobile navigation', 'pakistan-legal-solutions' ); ?>">
    <div class="mobile-menu__inner">
        <button type="button" class="mobile-menu__close" id="mobile-menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'pakistan-legal-solutions' ); ?>">
            <span aria-hidden="true">&times;</span>
        </button>

        <?php
        wp_nav_menu( [
            'theme_location' => 'mobile',
            'menu_class'     => 'mobile-menu__list',
            'container'      => false,
            'depth'          => 1,
            'fallback_cb'    => 'pls_primary_nav_fallback',
        ] );
        ?>

        <div class="mobile-menu__contact">
            <a href="<?php echo esc_url( 'tel:' . pls_phone_primary_tel() ); ?>" class="mobile-menu__phone">
                <?php echo esc_html( pls_phone_primary_display() ); ?>
            </a>
            <a href="<?php echo esc_url( 'tel:' . pls_phone_secondary_tel() ); ?>" class="mobile-menu__phone">
                <?php echo esc_html( pls_phone_secondary_display() ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--primary btn--full">
                <?php esc_html_e( 'Free Consultation', 'pakistan-legal-solutions' ); ?>
            </a>
        </div>
    </div>
</nav>
