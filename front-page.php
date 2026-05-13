<?php
/**
 * Homepage Template
 * WordPress uses this when Settings → Reading → Homepage is set to a static page.
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php get_template_part( 'template-parts/home/hero' ); ?>
    <?php get_template_part( 'template-parts/home/trust-bar' ); ?>
    <?php get_template_part( 'template-parts/home/contact-strip' ); ?>
    <?php get_template_part( 'template-parts/home/practice-areas' ); ?>
    <?php get_template_part( 'template-parts/home/why-choose-us' ); ?>
    <?php get_template_part( 'template-parts/home/attorneys' ); ?>
    <?php get_template_part( 'template-parts/home/testimonials' ); ?>
    <?php get_template_part( 'template-parts/home/cta-banner' ); ?>

</main>

<?php get_footer(); ?>