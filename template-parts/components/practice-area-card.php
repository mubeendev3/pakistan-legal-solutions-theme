<?php
/**
 * Practice area card (static data: title, URL, two lines, icon key).
 *
 * Expected vars (via pls_get_part): $pa_title, $pa_url, $pa_lines, $pa_icon
 *
 * @package PakistanLegalSolutions
 */
defined( 'ABSPATH' ) || exit;

$pa_title = $pa_title ?? '';
$pa_url   = $pa_url ?? '#';
$pa_lines = is_array( $pa_lines ?? null ) ? $pa_lines : [];
$pa_icon  = $pa_icon ?? 'civil-law';
?>
<article class="pa-card practice-card">
    <div class="pa-card__icon" aria-hidden="true">
        <?php pls_the_pa_icon( $pa_icon ); ?>
    </div>
    <div class="pa-card__body">
        <h3 class="pa-card__title">
            <a href="<?php echo esc_url( $pa_url ); ?>"><?php echo esc_html( $pa_title ); ?></a>
        </h3>
        <div class="pa-card__excerpt pa-card__excerpt--stack">
            <?php foreach ( array_slice( $pa_lines, 0, 2 ) as $line ) : ?>
                <p><?php echo esc_html( $line ); ?></p>
            <?php endforeach; ?>
        </div>
        <div class="pa-card__actions">
            <a class="btn btn--primary btn--sm" href="<?php echo esc_url( $pa_url ); ?>">
                <?php esc_html_e( 'Learn more', 'pakistan-legal-solutions' ); ?>
            </a>
        </div>
    </div>
</article>
