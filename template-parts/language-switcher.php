<?php
/**
 * Template part per il language switcher WPML
 * Mostra lo switcher solo se esistono traduzioni della pagina corrente
 * 
 * @param array $args {
 *     @type string $id_prefix      Prefisso per gli ID univoci (default: '')
 *     @type string $trigger_class  Classi CSS per il trigger (default: '')
 *     @type string $list_class     Classi CSS per la lista (default: '')
 * }
 */

$args = isset($args) ? $args : [];
$id_prefix = isset($args['id_prefix']) ? $args['id_prefix'] : '';
$trigger_class = isset($args['trigger_class']) ? $args['trigger_class'] : '';
$list_class = isset($args['list_class']) ? $args['list_class'] : '';

if ( function_exists('icl_object_id') && function_exists('icl_get_languages') && defined( 'ICL_LANGUAGE_CODE' ) ) :  
    // Recupera solo le lingue con traduzione disponibile per questa pagina
    // skip_missing=1 esclude automaticamente le lingue senza traduzione
    $languages = icl_get_languages('skip_missing=1&orderby=code');
    
    // Verifica se ci sono almeno 2 lingue disponibili (inclusa quella corrente)
    if (empty($languages) || count($languages) < 2) {
        // Se non ci sono almeno 2 lingue con traduzione, non mostrare lo switcher
        return;
    }
    
    // Verifica che la lingua corrente sia presente
    if (!isset($languages[ICL_LANGUAGE_CODE])) {
        return;
    }
    
    $current_language = $languages[ICL_LANGUAGE_CODE]['native_name'];
    
    // Conta quante lingue alternative ci sono (escludendo quella corrente)
    $other_languages = array_filter($languages, function($lang) {
        return !$lang['active'];
    });
    
    // Mostra lo switcher solo se ci sono altre lingue disponibili oltre a quella corrente
    if ( !empty($current_language) && !empty($other_languages) ) : ?>
        <div class="lang-switcher relative">
            <button type="button" class="font-bold flex gap-2 lg:gap-3 items-center cursor-pointer no-underline border-0 bg-transparent p-0 <?php echo esc_attr($trigger_class); ?> lang-switcher__trigger" data-lang-target="#<?php echo esc_attr($id_prefix); ?>langSwitcher" aria-expanded="false" aria-controls="<?php echo esc_attr($id_prefix); ?>langSwitcher">
                <?php get_template_part( 'images/icons/globe' ) ;?> 
                <span><?php echo esc_html($current_language); ?></span>
                <?php get_template_part( 'images/icons/chevron','down' ) ;?>
            </button>
            <div class="lang-switcher__dropdown absolute top-full left-0 z-10 mt-2" id="<?php echo esc_attr($id_prefix); ?>langSwitcher" style="min-width: 150px;">
                <ul class="lang-switcher__list <?php echo esc_attr($list_class); ?> rounded-b py-2 px-3 list-none m-0 shadow-lg">
                    <?php 
                    foreach($languages as $l){
                        if (!$l['active']) {
                            $translated_url = has_filter('wpml_permalink') ? apply_filters('wpml_permalink', $l['url'], $l['language_code']) : $l['url'];
                            $link_class = strpos($list_class, 'bg-primary') !== false ? 'text-white' : 'text-primary';
                            echo '<li class=""><a href="' . esc_url($translated_url) . '" class="' . esc_attr($link_class) . ' no-underline flex items-center justify-between hover:opacity-75">' . esc_html($l['native_name']) . '<img class="ml-2" width="20px" height="15px" src="'. esc_url($l['country_flag_url']) .'" alt="' . esc_attr($l['native_name']) . '" /></a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    <?php endif; 
endif; ?>
