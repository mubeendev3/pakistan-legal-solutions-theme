<?php
/**
 * Theme template for a Page with slug "about".
 *
 * WordPress loads this automatically when a published Page exists at `/about/`
 * and no other template overrides it. You do not need to pick "About Page"
 * in Page Attributes — but you still must create the Page in the admin.
 *
 * @package PakistanLegalSolutions
 */
get_header();
?>

<main id="main-content" class="site-main" role="main">

    <?php
    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/page/about-content' );
    endwhile;
    ?>

</main>

<?php
get_footer();
