<?php
/**
 * Template Name: Practice Areas Page
 *
 * Assign to a Page (recommended slug: practice-areas). Individual services
 * are `practice_area` posts with slugs listed in inc/practice-areas-catalog.php.
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="main-content" class="site-main site-main--practice-areas" role="main">
    <?php
    while ( have_posts() ) :
        the_post();
        pls_page_hero(
            get_the_title(),
            get_the_excerpt() ?: __( 'Twelve focused teams across civil, corporate, regulatory, and cross-border matters—delivered with clarity.', 'pakistan-legal-solutions' )
        );
        get_template_part( 'template-parts/page/practice-areas-content' );
        $content = get_post_field( 'post_content', get_the_ID() );
        if ( $content ) :
            ?>
            <section class="section pa-catalog-intro">
                <div class="container entry-content">
                    <?php the_content(); ?>
                </div>
            </section>
            <?php
        endif;
    endwhile;
    ?>

    <?php get_template_part( 'template-parts/home/cta-banner' ); ?>
</main>

<?php
get_footer();
