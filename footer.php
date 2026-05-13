<?php
/**
 * Site Footer
 */
?>

<footer class="site-footer" id="site-footer" role="contentinfo">

    <div class="site-footer__main">
        <div class="container">
            <div class="site-footer__grid">

                <?php // Column 1: Firm info ?>
                <div class="site-footer__col site-footer__col--brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo">
                        <img src="<?php echo esc_url( PLS_ASSETS ); ?>/images/logo-white.svg"
                             alt="<?php bloginfo( 'name' ); ?>"
                             width="200" height="60" loading="lazy">
                    </a>
                    <p class="site-footer__tagline">
                        <?php esc_html_e( 'Trusted legal guidance for clients across Pakistan. Your rights, our commitment.', 'pakistan-legal-solutions' ); ?>
                    </p>
                    <div class="site-footer__social">
                        <a href="https://facebook.com/pakistanlegalsolution" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <?php echo pls_icon( 'facebook' ); ?>
                        </a>
                        <a href="https://linkedin.com/company/pakistanlegalsolution" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <?php echo pls_icon( 'linkedin' ); ?>
                        </a>
                        <a href="https://wa.me/923001234567" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                            <?php echo pls_icon( 'whatsapp' ); ?>
                        </a>
                    </div>
                </div>

                <?php // Column 2: Quick Links ?>
                <div class="site-footer__col">
                    <h3 class="site-footer__heading"><?php esc_html_e( 'Quick Links', 'pakistan-legal-solutions' ); ?></h3>
                    <?php
                    wp_nav_menu( [
                        'theme_location' => 'footer-1',
                        'menu_class'     => 'site-footer__nav',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => 'pls_footer_nav_fallback',
                    ] );
                    ?>
                </div>

                <?php // Column 3: Practice Areas ?>
                <div class="site-footer__col">
                    <h3 class="site-footer__heading"><?php esc_html_e( 'Practice Areas', 'pakistan-legal-solutions' ); ?></h3>
                    <?php
                    wp_nav_menu( [
                        'theme_location' => 'footer-2',
                        'menu_class'     => 'site-footer__nav',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => 'pls_footer_nav_fallback',
                    ] );
                    ?>
                </div>

                <?php // Column 4: Contact info ?>
                <div class="site-footer__col">
                    <h3 class="site-footer__heading"><?php esc_html_e( 'Contact Us', 'pakistan-legal-solutions' ); ?></h3>
                    <address class="site-footer__address">
                        <p>
                            <?php echo pls_icon( 'map-pin' ); ?>
                            2nd Floor, Commerce Centre<br>
                            MM Alam Road, Gulberg IV<br>
                            Lahore 54660, Pakistan
                        </p>
                        <p>
                            <?php echo pls_icon( 'phone' ); ?>
                            <a href="tel:+924235710000">+92 42 3571 0000</a>
                        </p>
                        <p>
                            <?php echo pls_icon( 'mail' ); ?>
                            <a href="mailto:info@pakistanlegalsolutions.com">info@pakistanlegalsolutions.com</a>
                        </p>
                        <p>
                            <?php echo pls_icon( 'clock' ); ?>
                            Sat–Thu: 9am – 6pm PKT
                        </p>
                    </address>
                </div>

            </div><!-- .site-footer__grid -->
        </div><!-- .container -->
    </div><!-- .site-footer__main -->

    <div class="site-footer__bottom">
        <div class="container site-footer__bottom-inner">
            <div class="site-footer__bottom-row">
                <p class="site-footer__copy">
                    &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
                    <?php bloginfo( 'name' ); ?>.
                    <?php esc_html_e( 'All rights reserved.', 'pakistan-legal-solutions' ); ?>
                </p>
                <nav class="site-footer__legal" aria-label="<?php esc_attr_e( 'Legal links', 'pakistan-legal-solutions' ); ?>">
                    <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">
                        <?php esc_html_e( 'Privacy Policy', 'pakistan-legal-solutions' ); ?>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/disclaimer' ) ); ?>">
                        <?php esc_html_e( 'Disclaimer', 'pakistan-legal-solutions' ); ?>
                    </a>
                </nav>
            </div>
            <p class="site-footer__credits">
                <?php esc_html_e( 'Website developed by', 'pakistan-legal-solutions' ); ?>
                <a href="<?php echo esc_url( 'https://www.linkedin.com/in/mubeendeveloper/' ); ?>"
                   class="site-footer__credits-link"
                   target="_blank"
                   rel="noopener noreferrer"><?php esc_html_e( 'Mubeen Mehmood', 'pakistan-legal-solutions' ); ?></a>
            </p>
        </div>
    </div><!-- .site-footer__bottom -->

</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>