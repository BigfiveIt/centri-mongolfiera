<?php
/**
 * Template part per i filtri dei tag dei negozi
 * 
 * @param array $args {
 *     @type int $current_term_id ID del termine corrente (opzionale)
 * }
 */

$current_term_id = isset($args['current_term_id']) ? $args['current_term_id'] : 0;

// Ottieni tutti i tag dei negozi
$tags = get_terms(array(
    'taxonomy' => 'tag_negozi',
    'hide_empty' => true,
));

if (!empty($tags) && !is_wp_error($tags)): ?>
    <div class="flex flex-wrap gap-2 mb-4">
        <?php foreach ($tags as $tag): ?>
            <a href="<?php echo esc_url(get_term_link($tag)); ?>" 
               class="desc-1 px-6 py-2 rounded-full transition-colors <?php echo ($current_term_id == $tag->term_id) ? 'bg-primary-400 text-white hover:bg-primary-500' : 'bg-primary-500 hover:bg-primary-400 text-white'; ?>">
                <?php echo esc_html($tag->name); ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
