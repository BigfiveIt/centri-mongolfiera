<?php
/**
 * Nav prev/next per paginazione CPT e post.
 * Richiede $args: prev_url, next_url, paged, class_nav, aria_label, current_text (con %s per numero pagina).
 */
defined( 'ABSPATH' ) || exit;

$prev_url   = isset( $args['prev_url'] ) ? $args['prev_url'] : '';
$next_url   = isset( $args['next_url'] ) ? $args['next_url'] : '';
$paged      = isset( $args['paged'] ) ? (int) $args['paged'] : 1;
$class_nav  = isset( $args['class_nav'] ) ? $args['class_nav'] : 'pagination-nav';
$aria_label = isset( $args['aria_label'] ) ? $args['aria_label'] : __( 'Paginazione', 'mongolfiera' );
$current_text = isset( $args['current_text'] ) ? $args['current_text'] : __( 'Pagina %s', 'mongolfiera' );

$clip_id = 'clip0_pagination_' . wp_unique_id();
$svg_prev = '<path d="M0 6.49845C0.00928571 6.68421 0.0773809 6.83282 0.164048 6.92569L5.73548 12.808C5.99238 13.065 6.37619 13.0557 6.61143 12.8328C6.84667 12.6099 6.85905 12.1919 6.63619 11.9567L2.06143 7.12074H12.381C12.7245 7.12074 13 6.8452 13 6.50155C13 6.15789 12.7245 5.88235 12.381 5.88235H2.06143L6.63619 1.04025C6.85905 0.804952 6.84048 0.396284 6.61143 0.164086C6.37619 -0.0743044 5.95833 -0.0464406 5.73548 0.188853L0.164048 6.07121C0.0154762 6.21981 0.00928571 6.34984 0 6.49845Z" fill="#04972A"/>';
$svg_next = '<g clip-path="url(#' . esc_attr( $clip_id ) . ')"><path d="M13 6.50155C12.9907 6.31579 12.9226 6.16719 12.836 6.07431L7.26452 0.191954C7.00762 -0.0650123 6.62381 -0.0557245 6.38857 0.167185C6.15333 0.390095 6.14095 0.808053 6.36381 1.04335L10.9386 5.87926L0.619048 5.87926C0.275476 5.87926 5.98576e-07 6.1548 5.68533e-07 6.49845C5.38489e-07 6.84211 0.275476 7.11765 0.619048 7.11765L10.9386 7.11765L6.36381 11.9598C6.14095 12.195 6.15952 12.6037 6.38857 12.8359C6.62381 13.0743 7.04167 13.0464 7.26452 12.8111L12.836 6.9288C12.9845 6.78019 12.9907 6.65016 13 6.50155Z" fill="#04972A"/></g><defs><clipPath id="' . esc_attr( $clip_id ) . '"><rect width="13" height="13" fill="white" transform="translate(13 13) rotate(-180)"/></clipPath></defs>';
?>
<?php
$base = esc_attr( $class_nav );
$prev_class = $base . '__prev flex items-center';
$next_class = $base . '__next flex items-center';
$current_class = $base . '__current desc-2 text-primary-400';
?>
<nav class="<?php echo $base; ?> flex items-center justify-center gap-4 my-6 lg:my-12" aria-label="<?php echo esc_attr( $aria_label ); ?>">
	<?php if ( $prev_url ) : ?>
		<a href="<?php echo esc_url( $prev_url ); ?>" class="<?php echo esc_attr( $prev_class ); ?>" aria-label="<?php esc_attr_e( 'Pagina precedente', 'mongolfiera' ); ?>">
			<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><?php echo $svg_prev; ?></svg>
		</a>
	<?php else : ?>
		<span class="<?php echo esc_attr( $prev_class ); ?> opacity-30" aria-hidden="true">
			<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><?php echo $svg_prev; ?></svg>
		</span>
	<?php endif; ?>

	<span class="<?php echo esc_attr( $current_class ); ?>">
		<?php echo esc_html( sprintf( $current_text, $paged ) ); ?>
	</span>

	<?php if ( $next_url ) : ?>
		<a href="<?php echo esc_url( $next_url ); ?>" class="<?php echo esc_attr( $next_class ); ?>" aria-label="<?php esc_attr_e( 'Pagina successiva', 'mongolfiera' ); ?>">
			<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><?php echo $svg_next; ?></svg>
		</a>
	<?php else : ?>
		<span class="<?php echo esc_attr( $next_class ); ?> opacity-30" aria-hidden="true">
			<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><?php echo $svg_next; ?></svg>
		</span>
	<?php endif; ?>
</nav>
