<?php
/**
 * Theme template for a Page with slug "contact".
 *
 * WordPress loads this when a published Page exists at `/contact/`. You do not
 * need to select "Contact Page" in Page Attributes for that slug.
 *
 * @package PakistanLegalSolutions
 */
get_header();
?>

<main id="main-content" class="site-main site-main--contact" role="main">

    <?php
    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/page/contact-content' );
    endwhile;
    ?>

</main>

<?php
get_footer();
