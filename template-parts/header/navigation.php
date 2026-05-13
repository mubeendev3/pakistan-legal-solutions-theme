<?php
/**
 * Primary navigation.
 * Uses Walker_Nav_Menu for full control over the markup.
 */
defined( 'ABSPATH' ) || exit;
?>
<nav class="primary-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'pakistan-legal-solutions' ); ?>">
    <?php
    wp_nav_menu( [
        'theme_location'  => 'primary',
        'menu_id'         => 'primary-menu',
        'menu_class'      => 'primary-nav__list',
        'container'       => false,
        'depth'           => 2,
        'fallback_cb'     => 'pls_primary_nav_fallback',
        'items_wrap'      => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
    ] );
    ?>
</nav>