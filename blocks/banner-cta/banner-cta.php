<?php
/**
 * Block template file: banner-cta.php
 *
 * Banner CTA Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Crea l'attributo id per l'ancora personalizzata
$id = 'banner-cta-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Crea la classe per className e align personalizzati
$classes = 'block-banner-cta';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
if(!empty($block['backgroundColor'])) {
    $classes .= ' bg-' . $block['backgroundColor'];
}
$style = '';
if (!empty($block['style'])) {
    $styles = wp_style_engine_get_styles(['spacing' => $block['style']['spacing']]);
    if (!empty($styles['css'])) {
        $style = $styles['css'];
    }
}
?>

<?php 
// Block preview
if( !empty( $block['data']['_is_preview'] ) ): ?>
<figure>
    <img style="max-width:100%; height:auto" src="<?php echo get_stylesheet_directory_uri(); ?>/blocks/banner-cta/banner-cta-preview.png" alt="Preview Banner CTA">
</figure>
<?php else: ?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" style="<?php echo $style; ?>">
<?php
// Recupera i campi ACF
$banner_cta = get_field('banner_cta');

if ( $banner_cta ) {
    $immagine_url = null;
    $immagine_alt = '';
    $immagine_w   = 0;
    $immagine_h   = 0;
    if ( ! empty( $banner_cta['immagine'] ) ) {
        $immagine_url = $banner_cta['immagine']['url'] ?? null;
        $immagine_alt = $banner_cta['immagine']['alt'] ?? '';
        $immagine_w   = isset( $banner_cta['immagine']['width'] ) ? (int) $banner_cta['immagine']['width'] : 0;
        $immagine_h   = isset( $banner_cta['immagine']['height'] ) ? (int) $banner_cta['immagine']['height'] : 0;
    }
    $args = array(
        'immagine_url'   => $immagine_url,
        'immagine_alt'   => $immagine_alt,
        'immagine_width' => $immagine_w,
        'immagine_height' => $immagine_h,
        'titolo'         => $banner_cta['titolo'] ?? null,
        'testo'          => $banner_cta['breve_testo'] ?? null,
        'cta'            => $banner_cta['cta'] ?? null,
        'fetchpriority'  => 'high',
    );
    get_template_part( 'template-parts/banner-cta', null, $args );
}
?>
</section>

<?php endif; ?>