<?php
/**
 * Practice Areas Archive
 * Accessible at: /practice-areas/
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php pls_page_hero(
        __( 'Our Practice Areas', 'pakistan-legal-solutions' ),
        __( 'Expert legal services across all major areas of Pakistani law', 'pakistan-legal-solutions' )
    ); ?>

    <section class="pa-archive">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <div class="pa-grid">
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/components/practice-card' );
                    endwhile; ?>
                </div>
            <?php else : ?>
                <p><?php esc_html_e( 'No practice areas found.', 'pakistan-legal-solutions' ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <?php get_template_part( 'template-parts/home/cta-banner' ); ?>

</main>

<?php get_footer(); ?>