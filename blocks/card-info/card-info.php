<?php
/**
 * Block template file: card-info.php
 *
 * Card Info Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Crea l'attributo id per l'ancora personalizzata
$id = 'card-info-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Crea la classe per className e align personalizzati
$classes = 'block-card-info';
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
    <img style="max-width:100%; height:auto" src="<?php echo get_stylesheet_directory_uri(); ?>/blocks/card-info/card-info-preview.png" alt="Preview Card Info">
</figure>
<?php else: ?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" style="<?php echo $style; ?>">
<?php
// Recupera i campi ACF
$card_info = get_field('card_info');

if ($card_info) {
    // Prepara i dati per il template part
    $immagine_url = null;
    $immagine_alt = null;
    
    if (!empty($card_info['immagine'])) {
        $immagine_url = $card_info['immagine']['url'] ?? null;
        $immagine_alt = $card_info['immagine']['alt'] ?? '';
    }
    
    $args = [
        'immagine' => $immagine_url,
        'immagine_alt' => $immagine_alt,
        'titolo' => $card_info['titolo'] ?? null,
        'testo' => $card_info['breve_testo'] ?? null,
        'cta' => $card_info['cta'] ?? null,
    ];
    
    get_template_part('template-parts/card-info', null, $args);
}
?>
</section>

<?php endif; ?>