<?php
/**
 * Template part per i filtri delle categorie dei negozi
 * 
 * @param array $args {
 *     @type int $current_term_id ID del termine corrente (opzionale)
 *     @type string $archive_url URL dell'archivio generale dei negozi
 *     @type bool $show_all_button Mostra il pulsante "Tutti" (default: true)
 * }
 */

$current_term_id = isset($args['current_term_id']) ? $args['current_term_id'] : 0;
$archive_url = isset($args['archive_url']) ? $args['archive_url'] : get_post_type_archive_link('negozi');
$show_all_button = isset($args['show_all_button']) ? $args['show_all_button'] : true;

// Ottieni tutte le categorie dei negozi
$categorie = get_terms(array(
    'taxonomy' => 'categoria_negozi',
    'hide_empty' => true,
));

if (!empty($categorie) && !is_wp_error($categorie)): ?>
    <div class="flex flex-wrap gap-2">
        <?php if ($show_all_button): ?>
            <a href="<?php echo esc_url($archive_url); ?>" 
               class="desc-1 px-6 py-2 bg-gray-200 rounded-full transition-colors <?php echo ($current_term_id == 0) ? 'bg-primary-400 text-white hover:bg-primary-500' : ''; ?>">
                <?php _e('Tutti','mongolfiera'); ?>
            </a>
        <?php endif; ?>
        <?php foreach ($categorie as $categoria): ?>
            <a href="<?php echo esc_url(get_term_link($categoria)); ?>" 
               class="desc-1 px-6 py-2 bg-gray-200 hover:bg-primary-400 hover:text-white rounded-full transition-colors <?php echo ($current_term_id == $categoria->term_id) ? 'bg-primary-400 text-white hover:bg-primary-500' : ''; ?>">
                <?php echo esc_html($categoria->name); ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
