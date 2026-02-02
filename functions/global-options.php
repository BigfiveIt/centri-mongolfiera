<?php 

/**
 * La funzione set_global_options() recupera i valori dei campi ACF annidati
 * nelle opzioni generali e li memorizza in un array associativo globale.
 * Viene eseguita durante l'evento 'after_setup_theme'.
 */

if ( function_exists( 'get_field' ) ) {
    if ( ! function_exists( 'set_global_options' ) ) {
    function set_global_options() {
        global $global_options;

        // Cache con transient per migliorare le performance
        $cached = get_transient('mongolfiera_global_options');
        if ($cached !== false) {
            $global_options = $cached;
            return;
        }

        // Recupera il campo 'contatti' dalle opzioni generali
        $contatti = get_field('contatti', 'option');

        // Estrai i campi annidati
        $instagram = isset($contatti['instagram']) ? $contatti['instagram'] : '';
        $facebook = isset($contatti['facebook']) ? $contatti['facebook'] : '';
        $twitter = isset($contatti['twitter']) ? $contatti['twitter'] : '';
        $youtube = isset($contatti['youtube']) ? $contatti['youtube'] : '';
        $linkedin = isset($contatti['linkedin']) ? $contatti['linkedin'] : '';
        $telefono = isset($contatti['telefono']) ? $contatti['telefono'] : '';
        $email = isset($contatti['email']) ? $contatti['email'] : '';
        $indirizzo = isset($contatti['indirizzo']) ? $contatti['indirizzo'] : '';

        // Recupera il campo 'puntamenti' dalle opzioni generali
        $puntamenti = get_field('puntamenti','option');
        $privacy_policy = isset($puntamenti['privacy_policy']) ? $puntamenti['privacy_policy'] : '';
        $cookie_policy = isset($puntamenti['cookie_policy']) ? $puntamenti['cookie_policy'] : '';
        $informativa_policy = isset($puntamenti['informativa_policy']) ? $puntamenti['informativa_policy'] : '';
        $virtual_tour = isset($puntamenti['virtual_tour']) ? $puntamenti['virtual_tour'] : '';
        $mappa_negozi = isset($puntamenti['mappa_negozi']) ? $puntamenti['mappa_negozi'] : '';
        $newsletter = isset($puntamenti['newsletter']) ? $puntamenti['newsletter'] : '';

        $orari = get_field('orari','option');
        $orari_negozi = isset($orari['orari_negozi']) ? $orari['orari_negozi'] : '';
        $orari_ipermercato = isset($orari['orari_ipermercato']) ? $orari['orari_ipermercato'] : '';


        // Salva i valori in un array associativo
        $global_options = array(
            'instagram' => $instagram,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'youtube' => $youtube,
            'linkedin' => $linkedin,
            'telefono' => $telefono,
            'email' => $email,
            'indirizzo' => $indirizzo,
            'privacy_policy' => $privacy_policy,
            'cookie_policy' => $cookie_policy,
            'informativa_policy' => $informativa_policy,
            'orari_negozi' => $orari_negozi,
            'orari_ipermercato' => $orari_ipermercato,
            'virtual_tour' => $virtual_tour,
            'mappa_negozi' => $mappa_negozi,
            'newsletter' => $newsletter,
        );

        // Salva in cache per 1 ora
        set_transient('mongolfiera_global_options', $global_options, HOUR_IN_SECONDS);
    }
    }
    add_action('init', 'set_global_options');

    // Pulisci cache quando le opzioni ACF vengono aggiornate
    add_action('acf/save_post', function($post_id) {
        if ($post_id === 'options') {
            delete_transient('mongolfiera_global_options');
        }
    }, 20);


    /**
     * La funzione get_global_option() accetta il nome di un'opzione come parametro
     * e restituisce il valore corrispondente dall'array globale $global_options.
     * Se l'opzione specificata non esiste, restituisce null.
     *
     * @param string $option_name Nome dell'opzione da recuperare.
     * @return mixed Il valore dell'opzione richiesta o null se l'opzione non esiste.
     */

    if ( ! function_exists( 'get_global_option' ) ) {
    function get_global_option( $option_name ) {
        global $global_options;
        return isset( $global_options[ $option_name ] ) ? $global_options[ $option_name ] : null;
    }
    }
}