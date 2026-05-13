<?php
/**
 * Site Header
 * Used on every page via get_header().
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php // Preconnect to Google Fonts for faster load ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php // Favicons — generate all sizes at realfavicongenerator.net ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( PLS_ASSETS ); ?>/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( PLS_ASSETS ); ?>/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( PLS_ASSETS ); ?>/images/favicon-16x16.png">
    <link rel="manifest" href="<?php echo esc_url( PLS_ASSETS ); ?>/images/site.webmanifest">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content">
    <?php esc_html_e( 'Skip to main content', 'pakistan-legal-solutions' ); ?>
</a>

<header class="site-header" id="site-header" role="banner">
    <div class="site-header__inner container">

        <?php // Logo ?>
        <div class="site-header__logo">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo-text" rel="home">
                    <?php bloginfo( 'name' ); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php // Primary Navigation — outputs from template part ?>
        <?php get_template_part( 'template-parts/header/navigation' ); ?>

        <?php // CTA Button ?>
        <div class="site-header__cta">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
               class="btn btn--primary btn--sm"
               aria-label="<?php esc_attr_e( 'Book a consultation', 'pakistan-legal-solutions' ); ?>">
                <?php esc_html_e( 'Free Consultation', 'pakistan-legal-solutions' ); ?>
            </a>
        </div>

        <?php // Mobile menu toggle ?>
        <button type="button"
                class="mobile-menu-toggle"
                id="mobile-menu-toggle"
                aria-expanded="false"
                aria-controls="mobile-menu"
                aria-label="<?php esc_attr_e( 'Open menu', 'pakistan-legal-solutions' ); ?>">
            <span class="mobile-menu-toggle__bar"></span>
            <span class="mobile-menu-toggle__bar"></span>
            <span class="mobile-menu-toggle__bar"></span>
        </button>

    </div><!-- .site-header__inner -->

</header><!-- .site-header -->

<?php
// Off-canvas markup lives outside .site-header so position:fixed is viewport-relative
// (backdrop-filter on the header creates a fixed containing block for descendants).
get_template_part( 'template-parts/header/mobile-menu' );
?>