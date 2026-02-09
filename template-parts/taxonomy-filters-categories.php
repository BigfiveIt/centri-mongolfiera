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
    <?php
    // Select custom per mobile
    $select_id = 'taxonomy-filter-select-' . uniqid();
    
    // Determina il testo e l'URL della voce selezionata
    $selected_text = __('Tutti', 'mongolfiera');
    $selected_url = $archive_url;
    if ($current_term_id > 0) {
        foreach ($categorie as $cat) {
            if ($cat->term_id == $current_term_id) {
                $selected_text = $cat->name;
                $selected_url = get_term_link($cat);
                break;
            }
        }
    }
    ?>
    
    <!-- Select custom per mobile -->
    <div class="lg:hidden custom-taxonomy-select" data-taxonomy-filter="true" data-archive-url="<?php echo esc_attr($archive_url); ?>">
        <button type="button" 
                class="custom-taxonomy-select__button w-full px-4 py-2 desc-1 rounded-full border-0 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary-400 flex items-center justify-between <?php echo ($current_term_id > 0) ? 'bg-primary-400 text-white' : 'bg-gray-200'; ?>"
                aria-expanded="false"
                aria-haspopup="true">
            <span class="custom-taxonomy-select__selected-text"><?php echo esc_html($selected_text); ?></span>
            <svg class="custom-taxonomy-select__icon w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div class="custom-taxonomy-select__dropdown hidden absolute w-full mt-2 bg-white rounded-lg shadow-lg border border-gray-200 max-h-60 overflow-y-auto">
            <?php if ($show_all_button): ?>
                <a href="<?php echo esc_url($archive_url); ?>" 
                   class="custom-taxonomy-select__option block px-4 py-2 desc-1 no-underline transition-colors <?php echo ($current_term_id == 0) ? 'bg-primary-400 text-white' : 'text-gray-700 hover:bg-gray-100'; ?>"
                   data-value="<?php echo esc_url($archive_url); ?>">
                    <?php _e('Tutti','mongolfiera'); ?>
                </a>
            <?php endif; ?>
            <?php foreach ($categorie as $categoria): ?>
                <a href="<?php echo esc_url(get_term_link($categoria)); ?>" 
                   class="custom-taxonomy-select__option block px-4 py-2 desc-2 no-underline transition-colors <?php echo ($current_term_id == $categoria->term_id) ? 'bg-primary-400 text-white' : 'text-gray-700 hover:bg-gray-100'; ?>"
                   data-value="<?php echo esc_url(get_term_link($categoria)); ?>">
                    <?php echo esc_html($categoria->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Elenco flex per desktop -->
    <div class="hidden lg:flex gap-2 overflow-x-auto mx-[-1rem] px-4 lg:px-0 lg:mx-0 lg:flex-wrap">
        <?php if ($show_all_button): ?>
            <a href="<?php echo esc_url($archive_url); ?>" 
               class="desc-1 px-6 py-2 bg-gray-200 rounded-full transition-colors no-underline whitespace-nowrap <?php echo ($current_term_id == 0) ? 'bg-primary-400 text-white hover:bg-primary-500' : ''; ?>">
                <?php _e('Tutti','mongolfiera'); ?>
            </a>
        <?php endif; ?>
        <?php foreach ($categorie as $categoria): ?>
            <a href="<?php echo esc_url(get_term_link($categoria)); ?>" 
               class="desc-1 px-6 py-2 bg-gray-200 hover:bg-primary-400 hover:text-white rounded-full transition-colors no-underline whitespace-nowrap <?php echo ($current_term_id == $categoria->term_id) ? 'bg-primary-400 text-white hover:bg-primary-500' : ''; ?>">
                <?php echo esc_html($categoria->name); ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
