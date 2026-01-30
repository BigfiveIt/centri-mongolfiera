<?php
/**
 * Block template file: orari.php
 *
 * Orari Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Crea l'attributo id per l'ancora personalizzata
$id = 'orari-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Crea la classe per className e align personalizzati
$classes = 'block-orari';
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
    <img style="max-width:100%; height:auto" src="<?php echo get_stylesheet_directory_uri(); ?>/blocks/orari/orari-preview.png" alt="Preview Orari">
</figure>
<?php else: ?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>" style="<?php echo $style; ?>">
<?php
// Recupera i campi dalle Global Options
$orari_negozi = get_global_option('orari_negozi');
$orari_ipermercato = get_global_option('orari_ipermercato');
$orari = get_field('orari');
$orari_override = $orari && $orari['descrizione'] ? $orari['descrizione'] : null;
?>

    <div class="desc-1 text-primary-500">
        <?php if($orari_override): ?>
            <?php echo $orari_override; ?>
        <?php else: ?>
            <?php if($orari_negozi): ?>
                <p class="mb-4">
                <strong class="uppercase"><?php _e('Tutti i negozi', 'mongolfiera'); ?></strong><br>
                <?php echo $orari_negozi; ?>
                </p>
            <?php endif; ?>
            <?php if($orari_ipermercato): ?>
                <p>
                <strong class="uppercase"><?php _e('Ipermercato', 'mongolfiera'); ?></strong><br>
                <?php echo $orari_ipermercato; ?>
                </p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>
