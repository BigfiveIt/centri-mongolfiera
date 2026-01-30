<?php
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'mongolfiera_pagination' ) ) {
	function mongolfiera_pagination( $args = array(), $class = 'pagination' ) {
		if ( ! isset( $args['total'] ) && $GLOBALS['wp_query']->max_num_pages <= 1 ) {
			return;
		}
		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => __( '&laquo;', 'mongolfiera' ),
				'next_text'          => __( '&raquo;', 'mongolfiera' ),
				'type'               => 'array',
				'current'            => max( 1, get_query_var( 'paged' ) ),
				'screen_reader_text'  => __( 'Posts navigation', 'mongolfiera' ),
			)
		);
		$links = paginate_links( $args );
		if ( ! $links ) {
			return;
		}
		?>
		<nav aria-labelledby="posts-nav-label">
			<h2 id="posts-nav-label" class="screen-reader-text"><?php echo esc_html( $args['screen_reader_text'] ); ?></h2>
			<ul class="<?php echo esc_attr( $class ); ?>">
				<?php foreach ( $links as $key => $link ) : ?>
					<li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
						<?php echo str_replace( 'page-numbers', 'page-link', $link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
		<?php
	}
}

if ( ! function_exists( 'mongolfiera_add_pagination_links' ) ) {
	function mongolfiera_add_pagination_links() {
		global $wp_query;
		$paged    = max( 1, get_query_var( 'paged' ) );
		$max_page = $wp_query->max_num_pages;
		if ( $max_page <= 1 ) {
			return;
		}
		if ( $paged > 1 ) {
			echo '<link rel="prev" href="' . esc_url( get_pagenum_link( $paged - 1 ) ) . '" />' . "\n";
		}
		if ( $paged < $max_page ) {
			echo '<link rel="next" href="' . esc_url( get_pagenum_link( $paged + 1 ) ) . '" />' . "\n";
		}
	}
	add_action( 'wp_head', 'mongolfiera_add_pagination_links', 99 );
}

/**
 * Paginazione generica per CPT e post: calcola prev/next e usa template-part.
 *
 * @param array $args {
 *   @type string      $post_type   Slug post type (es. 'promozioni', 'eventi'). Se null usa get_pagenum_link.
 *   @type string      $param_stato Nome parametro stato (es. 'stato') da preservare nell'URL. Solo se post_type.
 *   @type string      $class_nav   Classe CSS del nav.
 *   @type string      $aria_label  Testo aria-label.
 *   @type string      $current_text Testo "Pagina %s" (già tradotto).
 * }
 */
if ( ! function_exists( 'mongolfiera_cpt_pagination' ) ) {
	function mongolfiera_cpt_pagination( $args = array() ) {
		global $wp_query;
		$paged    = max( 1, get_query_var( 'paged' ) );
		$max_page = $wp_query->max_num_pages;
		if ( $max_page <= 1 ) {
			return;
		}
		$args = wp_parse_args( $args, array(
			'post_type'   => null,
			'param_stato' => 'stato',
			'class_nav'   => 'pagination-nav',
			'aria_label'  => __( 'Paginazione', 'mongolfiera' ),
			'current_text' => __( 'Pagina %s', 'mongolfiera' ),
		) );
		$prev_url = '';
		$next_url = '';
		if ( $args['post_type'] ) {
			$base_url = get_post_type_archive_link( $args['post_type'] );
			$stato   = isset( $_GET[ $args['param_stato'] ] ) ? sanitize_text_field( wp_unslash( $_GET[ $args['param_stato'] ] ) ) : '';
			if ( $stato === 'passate' ) {
				$base_url = add_query_arg( $args['param_stato'], 'passate', $base_url );
			}
			if ( $paged > 1 ) {
				$prev_url = $paged > 2 ? add_query_arg( 'paged', $paged - 1, $base_url ) : $base_url;
			}
			if ( $paged < $max_page ) {
				$next_url = add_query_arg( 'paged', $paged + 1, $base_url );
			}
		} else {
			$prev_url = $paged > 1 ? get_pagenum_link( $paged - 1 ) : '';
			$next_url = $paged < $max_page ? get_pagenum_link( $paged + 1 ) : '';
		}
		get_template_part( 'template-parts/pagination-nav', null, array(
			'prev_url'     => $prev_url,
			'next_url'     => $next_url,
			'paged'        => $paged,
			'class_nav'    => $args['class_nav'],
			'aria_label'   => $args['aria_label'],
			'current_text' => $args['current_text'],
		) );
	}
}

if ( ! function_exists( 'mongolfiera_promozioni_pagination' ) ) {
	function mongolfiera_promozioni_pagination() {
		mongolfiera_cpt_pagination( array(
			'post_type'   => 'promozioni',
			'param_stato' => 'stato',
			'class_nav'   => 'promozioni-pagination',
			'aria_label'  => __( 'Paginazione promozioni', 'mongolfiera' ),
		) );
	}
}

if ( ! function_exists( 'mongolfiera_posts_pagination' ) ) {
	function mongolfiera_posts_pagination() {
		mongolfiera_cpt_pagination( array(
			'post_type'   => null,
			'class_nav'   => 'posts-pagination',
			'aria_label'  => __( 'Paginazione articoli', 'mongolfiera' ),
			'current_text' => __( 'Pagina %s', 'mongolfiera' ),
		) );
	}
}

if ( ! function_exists( 'mongolfiera_eventi_pagination' ) ) {
	function mongolfiera_eventi_pagination() {
		mongolfiera_cpt_pagination( array(
			'post_type'   => 'eventi',
			'param_stato' => 'stato',
			'class_nav'   => 'eventi-pagination',
			'aria_label'  => __( 'Paginazione eventi', 'mongolfiera' ),
		) );
	}
}
