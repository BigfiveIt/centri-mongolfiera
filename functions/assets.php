<?php
/**
 * Enqueue e gestione asset del tema (CSS, JS, codice header/footer da opzioni).
 */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mongolfiera_enqueue_assets' ) ) {
	function mongolfiera_enqueue_assets() {
		$the_theme = wp_get_theme();
		wp_enqueue_style(
			'mongolfiera-styles',
			get_stylesheet_directory_uri() . '/dist/theme.css',
			array(),
			$the_theme->get( 'Version' )
		);
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script(
			'mongolfiera-scripts',
			get_stylesheet_directory_uri() . '/dist/theme.js',
			array(),
			$the_theme->get( 'Version' ),
			true
		);
	}
	add_action( 'wp_enqueue_scripts', 'mongolfiera_enqueue_assets', 100 );
}

if ( ! function_exists( 'mongolfiera_add_header_code' ) ) {
	function mongolfiera_add_header_code() {
		if ( ! function_exists( 'get_field' ) ) {
			return;
		}
		$codici = get_field( 'codici', 'option' );
		if ( empty( $codici['codice_header'] ) ) {
			return;
		}
		echo wp_kses( $codici['codice_header'], array(
			'script' => array(
				'type' => array(),
				'src' => array(),
				'async' => array(),
				'defer' => array(),
				'charset' => array(),
			),
			'noscript' => array(),
			'style' => array(),
			'link' => array(
				'rel' => array(),
				'href' => array(),
				'type' => array(),
			),
			'meta' => array(
				'name' => array(),
				'content' => array(),
				'property' => array(),
			),
		) );
	}
	add_action( 'wp_head', 'mongolfiera_add_header_code', 20 );
}

if ( ! function_exists( 'mongolfiera_add_footer_code' ) ) {
	function mongolfiera_add_footer_code() {
		if ( ! function_exists( 'get_field' ) ) {
			return;
		}
		$codici = get_field( 'codici', 'option' );
		if ( empty( $codici['codice_footer'] ) ) {
			return;
		}
		echo wp_kses( $codici['codice_footer'], array(
			'script' => array(
				'type' => array(),
				'src' => array(),
				'async' => array(),
				'defer' => array(),
				'charset' => array(),
			),
			'noscript' => array(),
			'style' => array(),
			'link' => array(
				'rel' => array(),
				'href' => array(),
				'type' => array(),
			),
			'meta' => array(
				'name' => array(),
				'content' => array(),
				'property' => array(),
			),
		) );
	}
	add_action( 'wp_footer', 'mongolfiera_add_footer_code', 20 );
}

if ( ! function_exists( 'mongolfiera_add_getresponse_analytics' ) ) {
	/**
	 * Stampa lo script GetResponse Analytics nel tag <head>.
	 */
	function mongolfiera_add_getresponse_analytics() {
		?>
		<!-- GetResponse Analytics -->
		<script type="text/javascript">
			(function(m, o, n, t, e, r, _){
				m['__GetResponseAnalyticsObject'] = e;m[e] = m[e] || function() {(m[e].q = m[e].q || []).push(arguments)};
				r = o.createElement(n);_ = o.getElementsByTagName(n)[0];r.async = 1;r.src = t;r.setAttribute('crossorigin', 'use-credentials');_.parentNode .insertBefore(r, _);
			})(window, document, 'script', 'https://newsletter.digitalsvicom.it/script/51d7bba0-0e7b-46f6-9e81-7c61b500c60d/ga.js', 'GrTracking');
		</script>
		<!-- End GetResponse Analytics -->
		<?php
	}
	add_action( 'wp_head', 'mongolfiera_add_getresponse_analytics', 30 );
}
