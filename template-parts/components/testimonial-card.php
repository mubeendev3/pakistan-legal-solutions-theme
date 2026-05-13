<?php
/**
 * Testimonial card (expects The Loop; post title = client name).
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

$pls_t_args     = isset( $args ) && is_array( $args ) ? $args : [];
$pls_t_delay    = isset( $pls_t_args['animate_delay'] ) ? (int) $pls_t_args['animate_delay'] : 0;
$pls_t_delay_at = $pls_t_delay > 0 ? ' data-delay="' . esc_attr( (string) $pls_t_delay ) . '"' : '';
?>

<article <?php post_class( 'testimonial-card' ); ?> data-animate="fade-up"<?php echo $pls_t_delay_at; ?>>
    <div class="testimonial-card__quote">
        <?php the_content(); ?>
    </div>
    <p class="testimonial-card__author"><?php the_title(); ?></p>
</article>
