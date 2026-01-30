<?php
/**
 * Block template file: icon-contact.php
 *
 * Icon Contact Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Crea l'attributo id per l'ancora personalizzata
$id = 'icon-contact-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Crea la classe per className e align personalizzati
$classes = 'block-icon-contact';
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
    <img style="max-width:100%; height:auto" src="<?php echo get_stylesheet_directory_uri(); ?>/blocks/icon-contact/icon-contact-preview.png" alt="Preview Icon Contact">
</figure>
<?php else: ?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" style="<?php echo $style; ?>">
<?php
// Recupera i campi ACF
$icon_contact = get_field('icon_contact');

if ($icon_contact) {
    // Prepara i dati per il template part
    $icon_url = null;
    $icon_alt = null;
    $link = null;
    
    if (!empty($icon_contact['icon'])) {
        $icon_url = $icon_contact['icon']['url'] ?? null;
        $icon_alt = $icon_contact['icon']['alt'] ?? '';
    }
    
    $args = [
        'icon' => [
            'url' => $icon_url,
            'alt' => $icon_alt,
        ],
        'label' => $icon_contact['label'] ?? null,
        'class' => 'inline-flex',
        'link' => $icon_contact['link'] ?? null,
    ];
    
    get_template_part('template-parts/icon-contact', null, $args);
}
?>
</section>

<?php endif; ?>