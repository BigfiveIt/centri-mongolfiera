<?php
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mongolfiera_bottom_admin_bar' ) ) {
	function mongolfiera_bottom_admin_bar() {
		if ( is_user_logged_in() ) {
			?>
			<style>
				div#wpadminbar { top: auto; bottom: 0; position: fixed; }
				.ab-sub-wrapper { bottom: 32px; }
				html[lang] { margin-top: 0 !important; margin-bottom: 32px !important; }
				@media screen and (max-width: 782px) {
					.ab-sub-wrapper { bottom: 46px; }
					html[lang] { margin-bottom: 46px !important; }
				}
			</style>
			<?php
		}
	}
	add_action( 'wp_head', 'mongolfiera_bottom_admin_bar', 100 );
}

if ( ! function_exists( 'mongolfiera_mostra_banner_se_nascosto_da_motori' ) ) {
	function mongolfiera_mostra_banner_se_nascosto_da_motori() {
		if ( get_option( 'blog_public' ) == '0' ) {
			add_action( 'admin_notices', 'mongolfiera_banner_nascosto_da_motori' );
		}
	}
	add_action( 'admin_init', 'mongolfiera_mostra_banner_se_nascosto_da_motori' );
}

if ( ! function_exists( 'mongolfiera_banner_nascosto_da_motori' ) ) {
	function mongolfiera_banner_nascosto_da_motori() {
		echo '<div class="notice notice-error" style="background-color: red; color: white; border-color:red; border-left-color: #dc3232;"><p>Motori di ricerca disattivati. <a href="' . esc_url( admin_url( 'options-reading.php' ) ) . '" style="color: white; text-decoration: underline;">Attivare?</a></p></div>';
	}
}

if ( ! function_exists( 'mongolfiera_custom_login_logo' ) ) {
	function mongolfiera_custom_login_logo() {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		$image_url      = isset( $image[0] ) ? $image[0] : null;
		echo '<style type="text/css">
			h1 a { background-image:url(' . esc_url( $image_url ) . ') !important; background-size:contain !important; width: 240px !important; height:80px !important; }
			body.login { display:grid !important; place-items: center; background-color: #f4f4f4; }
			#login form { box-shadow: 0 2px 34px 0 rgb(34 34 34 / 11%) !important; }
			#login #nav a, #login #backtoblog a, .dashicons.dashicons-translation{ color:gray; }
		</style>';
	}
	add_action( 'login_head', 'mongolfiera_custom_login_logo' );
}

if ( ! function_exists( 'mongolfiera_login_logo_url' ) ) {
	function mongolfiera_login_logo_url( $url ) {
		return trailingslashit( get_home_url() );
	}
	add_filter( 'login_headerurl', 'mongolfiera_login_logo_url' );
}
