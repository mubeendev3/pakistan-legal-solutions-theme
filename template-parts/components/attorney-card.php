<?php
/**
 * Team member card (expects The Loop).
 *
 * Optional $args['animate_delay'] when loaded via get_template_part().
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

$role = has_excerpt() ? get_the_excerpt() : __( 'Advocate', 'pakistan-legal-solutions' );

$pls_card_args    = isset( $args ) && is_array( $args ) ? $args : [];
$pls_anim_delay   = isset( $pls_card_args['animate_delay'] ) ? (int) $pls_card_args['animate_delay'] : 0;
$pls_delay_attr = $pls_anim_delay > 0 ? ' data-delay="' . esc_attr( (string) $pls_anim_delay ) . '"' : '';
$pls_view_profile = __( 'View Profile', 'pakistan-legal-solutions' );
?>

<article <?php post_class( 'attorney-card' ); ?> data-animate="fade-up"<?php echo $pls_delay_attr; ?>>
    <div class="attorney-card__photo-wrap">
        <div class="attorney-card__photo">
            <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                    <?php the_post_thumbnail( 'attorney-portrait', [ 'loading' => 'lazy', 'alt' => '' ] ); ?>
                </a>
            <?php endif; ?>
        </div>
        <a class="attorney-card__profile-hit" href="<?php the_permalink(); ?>" tabindex="-1">
            <span class="attorney-card__profile-label"><?php echo esc_html( $pls_view_profile ); ?></span>
        </a>
    </div>
    <h3 class="attorney-card__name">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>
    <p class="attorney-card__role"><?php echo esc_html( wp_strip_all_tags( $role ) ); ?></p>
</article>
