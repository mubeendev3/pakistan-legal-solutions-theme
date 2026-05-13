<?php
/**
 * 404 Page Not Found
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">
    <section class="error-404 container">
        <div class="error-404__content">
            <p class="error-404__code" aria-hidden="true">404</p>
            <h1 class="error-404__heading">
                <?php esc_html_e( 'Page Not Found', 'pakistan-legal-solutions' ); ?>
            </h1>
            <p class="error-404__message">
                <?php esc_html_e( "Sorry, the page you're looking for doesn't exist or has been moved.", 'pakistan-legal-solutions' ); ?>
            </p>
            <div class="error-404__actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
                    <?php esc_html_e( 'Return to Homepage', 'pakistan-legal-solutions' ); ?>
                </a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--outline">
                    <?php esc_html_e( 'Contact Us', 'pakistan-legal-solutions' ); ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>