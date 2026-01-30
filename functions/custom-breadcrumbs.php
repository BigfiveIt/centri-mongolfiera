<?php
/**
 * Custom Breadcrumbs con supporto WPML
 * Ogni lingua ha le proprie impostazioni indipendenti
 */

// ============================================================================
// ADMIN: Menu e Impostazioni
// ============================================================================

add_action('admin_menu', 'custom_breadcrumbs_menu');
add_action('admin_init', 'custom_breadcrumbs_settings_init');
add_action('admin_init', 'custom_breadcrumbs_migrate_options');

function custom_breadcrumbs_menu() {
    add_options_page(
        'Impostazioni Breadcrumbs',
        'Custom Breadcrumbs',
        'manage_options',
        'custom-breadcrumbs',
        'custom_breadcrumbs_options_page'
    );
}

function custom_breadcrumbs_options_page() {
    // Salvataggio impostazioni
    if (isset($_POST['submit'])) {
        $options = [];
        
        // Salva opzioni post types
        $post_types = get_post_types(['public' => true, '_builtin' => false], 'objects');
        foreach ($post_types as $post_type) {
            $name = $post_type->name;
            
            if (isset($_POST['custom_breadcrumbs_options'][$name])) {
                $options[$name] = sanitize_text_field($_POST['custom_breadcrumbs_options'][$name]);
            }
            
            if (isset($_POST['custom_breadcrumbs_options']['page_choice_' . $name])) {
                $options['page_choice_' . $name] = intval($_POST['custom_breadcrumbs_options']['page_choice_' . $name]);
            }
        }
        
        // Salva opzioni tassonomie (incluse category e tag)
        $taxonomies = get_taxonomies(['public' => true], 'objects');
        foreach ($taxonomies as $taxonomy) {
            $name = 'tax_' . $taxonomy->name;
            
            if (isset($_POST['custom_breadcrumbs_options'][$name])) {
                $options[$name] = sanitize_text_field($_POST['custom_breadcrumbs_options'][$name]);
            }
            
            if (isset($_POST['custom_breadcrumbs_options']['page_choice_' . $name])) {
                $options['page_choice_' . $name] = intval($_POST['custom_breadcrumbs_options']['page_choice_' . $name]);
            }
        }
        
        update_option('custom_breadcrumbs_options', $options);
        
        // Salva per lingua corrente se WPML è attivo
        $current_lang = get_wpml_current_language();
        if ($current_lang) {
            update_option('custom_breadcrumbs_options_' . $current_lang, $options);
        }
        
        echo '<div class="notice notice-success is-dismissible"><p><strong>&#10003; Impostazioni salvate con successo!</strong></p></div>';
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p class="description">Configura i percorsi dei breadcrumbs per i tuoi post type e tassonomie personalizzate.</p>
        
        <?php
        $current_lang = get_wpml_current_language();
        if ($current_lang) {
            $lang_name = strtoupper($current_lang);
            echo '<div class="notice notice-info inline" style="margin: 0 0 20px 0; padding: 12px 15px;">
                <p style="margin: 0;"><span class="dashicons dashicons-translation" style="margin-right: 5px;"></span>
                <strong>Configurazione per lingua ' . esc_html($lang_name) . '</strong> - Seleziona le pagine specifiche per questa lingua.</p>
            </div>';
        }
        ?>
        
        <form method="post" action="" style="max-width: 800px;">
            <?php
            settings_fields('custom_breadcrumbs_options');
            do_settings_sections('custom-breadcrumbs');
            submit_button('Salva le modifiche', 'primary', 'submit', false);
            ?>
        </form>
    </div>
    <style>
        .form-table th {
            padding-left: 0;
            font-weight: 600;
            color: #1d2327;
            width: 180px;
        }
        .form-table td {
            padding: 15px 0;
        }
        .custom-breadcrumb-row {
            background: #fff;
            border: 1px solid #c3c4c7;
            border-radius: 4px;
            padding: 15px 20px;
            transition: all 0.2s ease;
        }
        .custom-breadcrumb-row:hover {
            border-color: #2271b1;
            box-shadow: 0 0 0 1px #2271b1;
        }
        .custom-breadcrumb-options {
            display: flex;
            gap: 25px;
            align-items: center;
            flex-wrap: wrap;
        }
        .custom-breadcrumb-radio {
            display: flex;
            gap: 20px;
            min-width: 200px;
        }
        .custom-breadcrumb-radio label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 3px;
            transition: background 0.15s ease;
        }
        .custom-breadcrumb-radio label:hover {
            background: #f6f7f7;
        }
        .custom-breadcrumb-radio input[type="radio"] {
            margin: 0;
            cursor: pointer;
        }
        .custom-breadcrumb-radio .dashicons {
            color: #50575e;
            font-size: 18px;
            width: 18px;
            height: 18px;
        }
        .custom-breadcrumb-select {
            flex: 1;
            min-width: 280px;
        }
        .custom-breadcrumb-select select {
            width: 100%;
            max-width: 450px;
            height: 36px;
        }
        .wrap > p.description {
            font-size: 14px;
            margin: 10px 0 25px 0;
            color: #646970;
        }
        .notice.inline {
            display: block;
        }
        .notice.inline p {
            display: flex;
            align-items: center;
        }
        .notice.inline .dashicons {
            margin-top: -2px;
        }
        .section-title {
            margin: 30px 0 15px 0;
            padding: 10px 0;
            border-bottom: 2px solid #2271b1;
            color: #1d2327;
            font-size: 16px;
        }
        .section-title:first-child {
            margin-top: 0;
        }
    </style>
    <?php
}

function custom_breadcrumbs_settings_init() {
    register_setting('custom_breadcrumbs_options', 'custom_breadcrumbs_options');
    
    // Sezione Post Types
    add_settings_section(
        'custom_breadcrumbs_post_types',
        '<span class="section-title">Post Type Personalizzati</span>',
        'custom_breadcrumbs_main_text',
        'custom-breadcrumbs'
    );
    
    $post_types = get_post_types(['public' => true, '_builtin' => false], 'objects');
    foreach ($post_types as $post_type) {
        add_settings_field(
            'custom_breadcrumbs_page_choice_' . $post_type->name,
            $post_type->labels->name,
            'custom_breadcrumbs_page_choice_render',
            'custom-breadcrumbs',
            'custom_breadcrumbs_post_types',
            [
                'post_type' => $post_type->name,
                'type' => 'post_type',
                'has_archive' => $post_type->has_archive
            ]
        );
    }
    
    // Sezione Tassonomie (incluse category e tag)
    $taxonomies = get_taxonomies(['public' => true], 'objects');
    if (!empty($taxonomies)) {
        add_settings_section(
            'custom_breadcrumbs_taxonomies',
            '<span class="section-title">Tassonomie Personalizzate</span>',
            'custom_breadcrumbs_taxonomies_text',
            'custom-breadcrumbs'
        );
        
        foreach ($taxonomies as $taxonomy) {
            $is_base_taxonomy = in_array($taxonomy->name, ['category', 'post_tag'], true);
            // Ottieni i post types associati alla tassonomia
            $associated_post_types = $taxonomy->object_type;
            $associated_labels = [];
            foreach ($associated_post_types as $pt) {
                $pt_obj = get_post_type_object($pt);
                if ($pt_obj) {
                    $associated_labels[] = $pt_obj->labels->name;
                }
            }
            
            add_settings_field(
                'custom_breadcrumbs_tax_' . $taxonomy->name,
                $taxonomy->labels->name . '<br><small style="color:#646970;">(' . implode(', ', $associated_labels) . ')</small>',
                'custom_breadcrumbs_taxonomy_choice_render',
                'custom-breadcrumbs',
                'custom_breadcrumbs_taxonomies',
                [
                    'taxonomy' => $taxonomy->name,
                    'type' => 'taxonomy',
                    'associated_post_types' => $associated_post_types,
                    'is_base_taxonomy' => $is_base_taxonomy
                ]
            );
        }
    }
}

function custom_breadcrumbs_taxonomies_text() {
    echo '<p class="description">Configura il percorso dei breadcrumbs per le tassonomie. Puoi scegliere di mostrare l\'archivio del post type associato o una pagina specifica come genitore del termine.</p>';
}

function custom_breadcrumbs_main_text() {
    if (defined('WP_DEBUG') && WP_DEBUG && current_user_can('manage_options')) {
        custom_breadcrumbs_debug_info();
    }
}

function custom_breadcrumbs_page_choice_render($args) {
    $options = get_custom_breadcrumbs_options();
    $pages = get_pages();
    $post_type = $args['post_type'];
    $has_archive = isset($args['has_archive']) ? $args['has_archive'] : true;
    
    $archive_checked = isset($options[$post_type]) && $options[$post_type] == 'archive' ? 'checked' : '';
    $page_checked = isset($options[$post_type]) && $options[$post_type] == 'page' ? 'checked' : '';
    
    echo '<div class="custom-breadcrumb-row">
        <div class="custom-breadcrumb-options">
            <div class="custom-breadcrumb-radio">';
    
    if ($has_archive) {
        echo '<label>
                    <input type="radio" name="custom_breadcrumbs_options[' . esc_attr($post_type) . ']" value="archive" ' . $archive_checked . '>
                    <span class="dashicons dashicons-archive"></span> Archivio
                </label>';
    }
    
    echo '<label>
                    <input type="radio" name="custom_breadcrumbs_options[' . esc_attr($post_type) . ']" value="page" ' . $page_checked . '>
                    <span class="dashicons dashicons-admin-page"></span> Pagina
                </label>
            </div>
            
            <div class="custom-breadcrumb-select">
                <select name="custom_breadcrumbs_options[page_choice_' . esc_attr($post_type) . ']" class="regular-text">
                    <option value="">-- Seleziona una pagina --</option>';
    
    foreach ($pages as $page) {
        $selected = isset($options['page_choice_' . $post_type]) && $options['page_choice_' . $post_type] == $page->ID ? 'selected' : '';
        echo '<option value="' . esc_attr($page->ID) . '" ' . $selected . '>' . esc_html($page->post_title) . '</option>';
    }
    
    echo '</select>
            </div>
        </div>
    </div>';
}

function custom_breadcrumbs_taxonomy_choice_render($args) {
    $options = get_custom_breadcrumbs_options();
    $pages = get_pages();
    $taxonomy = $args['taxonomy'];
    $option_key = 'tax_' . $taxonomy;
    $associated_post_types = isset($args['associated_post_types']) ? $args['associated_post_types'] : [];
    $is_base_taxonomy = !empty($args['is_base_taxonomy']);
    
    $archive_checked = isset($options[$option_key]) && $options[$option_key] == 'archive' ? 'checked' : '';
    $page_checked = isset($options[$option_key]) && $options[$option_key] == 'page' ? 'checked' : '';
    
    // Verifica se almeno un post type associato ha un archivio
    $has_archive = $is_base_taxonomy; // per category/tag permettiamo sempre la scelta archivio
    if (!$has_archive) {
        foreach ($associated_post_types as $pt) {
            $pt_obj = get_post_type_object($pt);
            if ($pt_obj && $pt_obj->has_archive) {
                $has_archive = true;
                break;
            }
        }
    }
    
    echo '<div class="custom-breadcrumb-row">
        <div class="custom-breadcrumb-options">
            <div class="custom-breadcrumb-radio">';
    
    if ($has_archive) {
        $archive_label = $is_base_taxonomy ? 'Archivio Blog' : 'Archivio CPT';
        echo '<label>
                    <input type="radio" name="custom_breadcrumbs_options[' . esc_attr($option_key) . ']" value="archive" ' . $archive_checked . '>
                    <span class="dashicons dashicons-archive"></span> ' . esc_html($archive_label) . '
                </label>';
    }
    
    echo '<label>
                    <input type="radio" name="custom_breadcrumbs_options[' . esc_attr($option_key) . ']" value="page" ' . $page_checked . '>
                    <span class="dashicons dashicons-admin-page"></span> Pagina
                </label>
            </div>
            
            <div class="custom-breadcrumb-select">
                <select name="custom_breadcrumbs_options[page_choice_' . esc_attr($option_key) . ']" class="regular-text">
                    <option value="">-- Seleziona una pagina --</option>';
    
    foreach ($pages as $page) {
        $selected = isset($options['page_choice_' . $option_key]) && $options['page_choice_' . $option_key] == $page->ID ? 'selected' : '';
        echo '<option value="' . esc_attr($page->ID) . '" ' . $selected . '>' . esc_html($page->post_title) . '</option>';
    }
    
    echo '</select>
            </div>
        </div>
    </div>';
}

// ============================================================================
// UTILITY: Helper Functions
// ============================================================================

/**
 * Helper function per ottenere la lingua corrente WPML
 * Compatibile con WPML moderno (usa filter invece di funzione deprecata)
 */
function get_wpml_current_language() {
    if (function_exists('apply_filters')) {
        $lang = apply_filters('wpml_current_language', null);
        if ($lang) {
            return $lang;
        }
    }
    // Fallback per compatibilità con vecchie versioni WPML
    if (function_exists('icl_get_current_language')) {
        return icl_get_current_language();
    }
    return null;
}

function get_custom_breadcrumbs_options() {
    static $options_cache = null;
    
    if ($options_cache !== null) {
        return $options_cache;
    }
    
    $options = get_option('custom_breadcrumbs_options', []);
    
    $current_lang = get_wpml_current_language();
    if ($current_lang) {
        $lang_options = get_option('custom_breadcrumbs_options_' . $current_lang, []);
        
        if (!empty($lang_options)) {
            $options_cache = $lang_options;
            return $lang_options;
        }
        
        // Migrazione automatica se non esistono opzioni per la lingua corrente
        if (!empty($options)) {
            update_option('custom_breadcrumbs_options_' . $current_lang, $options);
        }
    }
    
    $options_cache = $options;
    return $options;
}

function custom_breadcrumbs_migrate_options() {
    $current_lang = get_wpml_current_language();
    if (!$current_lang) {
        return;
    }
    
    $lang_options = get_option('custom_breadcrumbs_options_' . $current_lang, []);
    $global_options = get_option('custom_breadcrumbs_options', []);
    
    if (empty($lang_options) && !empty($global_options)) {
        update_option('custom_breadcrumbs_options_' . $current_lang, $global_options);
    }
}

function custom_breadcrumbs_debug_info() {
    $lang = get_wpml_current_language() ?: 'N/A';
    $options = get_custom_breadcrumbs_options();
    
    echo '<div class="notice notice-warning inline" style="margin: 0 0 20px 0; padding: 12px 15px; background: #fcf8e3; border-left-color: #f0ad4e;">
        <p style="margin: 0 0 10px 0;"><span class="dashicons dashicons-info" style="margin-right: 5px;"></span><strong>Debug Mode</strong></p>
        <p style="margin: 5px 0; font-size: 12px;"><strong>Lingua:</strong> ' . esc_html($lang) . '</p>';
    
    foreach ($options as $key => $value) {
        if (strpos($key, 'page_choice_') === 0) {
            $post_type = str_replace('page_choice_', '', $key);
            echo '<p style="margin: 5px 0; font-size: 12px;"><strong>' . esc_html($post_type) . ':</strong> ID ' . $value . ' (' . esc_html(get_the_title($value)) . ')</p>';
        }
    }
    
    echo '</div>';
}

// ============================================================================
// FRONTEND: Breadcrumbs Output
// ============================================================================

// Hook per outputtare JSON-LD nello head
add_action('wp_head', 'custom_breadcrumbs_json_ld');

function custom_breadcrumbs_json_ld() {
    $breadcrumbs = custom_breadcrumbs_get_data();
    
    if (empty($breadcrumbs) || count($breadcrumbs) < 2) {
        return;
    }
    
    $json_ld = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => []
    ];
    
    foreach ($breadcrumbs as $index => $crumb) {
        $item = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $crumb['name']
        ];
        
        // L'ultimo elemento non ha bisogno dell'URL (item)
        if (isset($crumb['url']) && !empty($crumb['url'])) {
            $item['item'] = $crumb['url'];
        }
        
        $json_ld['itemListElement'][] = $item;
    }
    
    echo '<script type="application/ld+json">' . wp_json_encode($json_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}

function custom_breadcrumbs_get_data() {
    global $post;
    
    $breadcrumbs = [];
    $options = get_custom_breadcrumbs_options();
    
    // Home
    $breadcrumbs[] = [
        'name' => __('Home', 'mongolfiera'),
        'url' => get_home_url()
    ];
    
    // Verifica tassonomie PRIMA di is_archive() perché is_tax() restituisce true anche quando is_archive() è true
    if (is_tax() || is_category() || is_tag()) {
        $tax_breadcrumbs = get_taxonomy_breadcrumbs_data($options);
        $breadcrumbs = array_merge($breadcrumbs, $tax_breadcrumbs);
    } elseif (is_singular()) {
        $post_type = get_post_type_object($post->post_type);
        
        if ($post->post_type == 'post') {
            $blog_breadcrumbs = get_blog_breadcrumbs_data();
            $breadcrumbs = array_merge($breadcrumbs, $blog_breadcrumbs);
        } else {
            $cpt_breadcrumbs = get_custom_post_type_breadcrumbs_data($post_type, $options);
            $breadcrumbs = array_merge($breadcrumbs, $cpt_breadcrumbs);
        }
    } elseif (is_archive()) {
        $archive_breadcrumbs = get_archive_breadcrumbs_data();
        $breadcrumbs = array_merge($breadcrumbs, $archive_breadcrumbs);
    } elseif (is_404()) {
        $breadcrumbs[] = [
            'name' => __('404 - Pagina non trovata', 'mongolfiera'),
            'url' => null
        ];
    }
    
    return $breadcrumbs;
}

function custom_breadcrumbs() {
    $breadcrumbs = custom_breadcrumbs_get_data();
    
    if (empty($breadcrumbs)) {
        return;
    }
    
    echo '<ul class="breadcrumbs">';
    
    foreach ($breadcrumbs as $index => $crumb) {
        breadcrumb_separator();
        
        $is_last = ($index === count($breadcrumbs) - 1);
        
        if ($is_last || empty($crumb['url'])) {
            echo '<li><span>' . esc_html($crumb['name']) . '</span></li>';
        } else {
            echo '<li><a href="' . esc_url($crumb['url']) . '">' . esc_html($crumb['name']) . '</a></li>';
        }
    }
    
    echo '</ul>';
}

// Helper per renderizzare un breadcrumb item (mantenuto per retrocompatibilità se usato altrove)
function breadcrumb_item($url, $title, $position, $is_last = false) {
    breadcrumb_separator();
    
    if ($is_last) {
        echo '<li><span>' . esc_html($title) . '</span></li>';
    } else {
        echo '<li><a href="' . esc_url($url) . '">' . esc_html($title) . '</a></li>';
    }
}

function breadcrumb_item_current($title, $position) {
    breadcrumb_separator();
    echo '<li><span>' . esc_html($title) . '</span></li>';
}

function breadcrumb_separator() {
    static $first = true;
    if ($first) {
        $first = false;
        return;
    }
    echo '<li>&raquo;</li>';
}

// Funzioni per raccogliere dati breadcrumb (per JSON-LD)
function get_blog_breadcrumbs_data() {
    global $post;
    $breadcrumbs = [];
    
    $blog_page_id = get_option('page_for_posts');
    
    if ($blog_page_id) {
        $breadcrumbs[] = [
            'name' => get_the_title($blog_page_id),
            'url' => get_permalink($blog_page_id)
        ];
    }
    
    $categories = get_the_category();
    if (!empty($categories)) {
        $category = $categories[0];
        $breadcrumbs[] = [
            'name' => $category->name,
            'url' => get_category_link($category->term_id)
        ];
    }
    
    $breadcrumbs[] = [
        'name' => get_the_title(),
        'url' => null
    ];
    
    return $breadcrumbs;
}

function get_custom_post_type_breadcrumbs_data($post_type, $options) {
    global $post;
    $breadcrumbs = [];
    $has_custom_parent = false;
    
    // Archivio o pagina personalizzata
    if (isset($options[$post_type->name]) && $options[$post_type->name] == 'archive' && $post_type->has_archive) {
        $breadcrumbs[] = [
            'name' => $post_type->labels->name,
            'url' => get_post_type_archive_link($post_type->name)
        ];
        $has_custom_parent = true;
    } elseif (isset($options[$post_type->name]) && $options[$post_type->name] == 'page' && isset($options['page_choice_' . $post_type->name])) {
        $page_breadcrumbs = get_page_hierarchy_data($options['page_choice_' . $post_type->name]);
        $breadcrumbs = array_merge($breadcrumbs, $page_breadcrumbs);
        $has_custom_parent = true;
    }
    
    // Genitore/figli se non c'è già un parent personalizzato
    if (!$has_custom_parent && $post->post_parent) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        foreach ($ancestors as $ancestor) {
            $breadcrumbs[] = [
                'name' => get_the_title($ancestor),
                'url' => get_permalink($ancestor)
            ];
        }
    }
    
    $breadcrumbs[] = [
        'name' => get_the_title(),
        'url' => null
    ];
    
    return $breadcrumbs;
}

function get_page_hierarchy_data($page_id) {
    $breadcrumbs = [];
    
    // Mostra genitori
    $ancestors = get_post_ancestors($page_id);
    if (!empty($ancestors)) {
        foreach (array_reverse($ancestors) as $ancestor) {
            $breadcrumbs[] = [
                'name' => get_the_title($ancestor),
                'url' => get_permalink($ancestor)
            ];
        }
    }
    
    // Mostra pagina selezionata
    $breadcrumbs[] = [
        'name' => get_the_title($page_id),
        'url' => get_permalink($page_id)
    ];
    
    return $breadcrumbs;
}

function get_taxonomy_breadcrumbs_data($options) {
    $term = get_queried_object();
    $breadcrumbs = [];
    
    if (!$term || !isset($term->taxonomy)) {
        return $breadcrumbs;
    }
    
    $taxonomy = $term->taxonomy;
    $option_key = 'tax_' . $taxonomy;
    
    // Gestione genitore breadcrumb per tassonomie custom
    if (isset($options[$option_key])) {
        if ($options[$option_key] == 'archive') {
            $taxonomy_obj = get_taxonomy($taxonomy);
            $is_base_taxonomy = in_array($taxonomy, ['category', 'post_tag'], true);

            if ($is_base_taxonomy) {
                // Per category/tag usa la pagina del blog se esiste, altrimenti la home
                $blog_page_id = get_option('page_for_posts');
                if ($blog_page_id) {
                    $breadcrumbs[] = [
                        'name' => get_the_title($blog_page_id),
                        'url' => get_permalink($blog_page_id)
                    ];
                } else {
                    $breadcrumbs[] = [
                        'name' => __('Articoli', 'mongolfiera'),
                        'url' => get_home_url()
                    ];
                }
            } else {
                // Usa l'archivio del post type associato
                if ($taxonomy_obj && !empty($taxonomy_obj->object_type)) {
                    $post_type = $taxonomy_obj->object_type[0];
                    $post_type_obj = get_post_type_object($post_type);
                    
                    if ($post_type_obj && $post_type_obj->has_archive) {
                        $breadcrumbs[] = [
                            'name' => $post_type_obj->labels->name,
                            'url' => get_post_type_archive_link($post_type)
                        ];
                    }
                }
            }
        } elseif ($options[$option_key] == 'page' && isset($options['page_choice_' . $option_key])) {
            // Usa la pagina selezionata
            $page_breadcrumbs = get_page_hierarchy_data($options['page_choice_' . $option_key]);
            $breadcrumbs = array_merge($breadcrumbs, $page_breadcrumbs);
        }
    }
    
    // Termini genitori della tassonomia (gerarchia interna)
    $ancestors = array_reverse(get_ancestors($term->term_id, $term->taxonomy));
    foreach ($ancestors as $ancestor_id) {
        $ancestor_term = get_term($ancestor_id, $term->taxonomy);
        if ($ancestor_term && !is_wp_error($ancestor_term)) {
            $breadcrumbs[] = [
                'name' => $ancestor_term->name,
                'url' => get_term_link($ancestor_term)
            ];
        }
    }
    
    // Termine corrente
    $breadcrumbs[] = [
        'name' => $term->name,
        'url' => null
    ];
    
    return $breadcrumbs;
}

function get_archive_breadcrumbs_data() {
    $breadcrumbs = [];
    
    if (is_post_type_archive()) {
        $post_type = get_queried_object();
        $breadcrumbs[] = [
            'name' => $post_type->labels->name,
            'url' => null
        ];
    } elseif (is_date()) {
        if (is_year()) {
            $breadcrumbs[] = [
                'name' => get_the_date('Y'),
                'url' => null
            ];
        } elseif (is_month()) {
            $breadcrumbs[] = [
                'name' => get_the_date('F Y'),
                'url' => null
            ];
        } elseif (is_day()) {
            $breadcrumbs[] = [
                'name' => get_the_date(),
                'url' => null
            ];
        }
    } elseif (is_author()) {
        $author = get_queried_object();
        $breadcrumbs[] = [
            'name' => $author->display_name,
            'url' => null
        ];
    }
    
    return $breadcrumbs;
}

// Funzioni di rendering HTML (mantenute per retrocompatibilità)
// Ottimizzate per riutilizzare le funzioni get_*_data() esistenti
function render_blog_breadcrumbs(&$position) {
    $breadcrumbs = get_blog_breadcrumbs_data();
    foreach ($breadcrumbs as $crumb) {
        if (!empty($crumb['url'])) {
            breadcrumb_item($crumb['url'], $crumb['name'], $position++);
        } else {
            breadcrumb_item_current($crumb['name'], $position);
        }
    }
}

function render_custom_post_type_breadcrumbs($post_type, $options, &$position) {
    $breadcrumbs = get_custom_post_type_breadcrumbs_data($post_type, $options);
    foreach ($breadcrumbs as $crumb) {
        if (!empty($crumb['url'])) {
            breadcrumb_item($crumb['url'], $crumb['name'], $position++);
        } else {
            breadcrumb_item_current($crumb['name'], $position);
        }
    }
}

function render_page_hierarchy($page_id, &$position) {
    $breadcrumbs = get_page_hierarchy_data($page_id);
    foreach ($breadcrumbs as $crumb) {
        breadcrumb_item($crumb['url'], $crumb['name'], $position++);
    }
}

function render_taxonomy_breadcrumbs($options, &$position) {
    $breadcrumbs = get_taxonomy_breadcrumbs_data($options);
    foreach ($breadcrumbs as $crumb) {
        if (!empty($crumb['url'])) {
            breadcrumb_item($crumb['url'], $crumb['name'], $position++);
        } else {
            breadcrumb_item_current($crumb['name'], $position);
        }
    }
}

function render_archive_breadcrumbs(&$position) {
    $breadcrumbs = get_archive_breadcrumbs_data();
    foreach ($breadcrumbs as $crumb) {
        breadcrumb_item_current($crumb['name'], $position);
    }
}
