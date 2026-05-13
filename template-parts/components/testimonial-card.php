<?php
/**
 * Testimonial card (expects The Loop; post title = client name).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'testimonial-card' ); ?>>
    <div class="testimonial-card__quote">
        <?php the_content(); ?>
    </div>
    <p class="testimonial-card__author"><?php the_title(); ?></p>
</article>
