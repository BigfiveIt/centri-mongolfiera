<?php
/**
 * Template part: riga contatto negozio (icona + label).
 * Parametri: icon (array con 'url' e opzionale 'alt') oppure icon (string = path get_template_part), label (testo).
 */
$icon  = isset( $args['icon'] ) ? $args['icon'] : null;
$label = isset( $args['label'] ) ? $args['label'] : '';
$class = isset( $args['class'] ) ? $args['class'] : '';

$icon_url  = is_array( $icon ) && ! empty( $icon['url'] ) ? $icon['url'] : '';
$icon_alt  = is_array( $icon ) && isset( $icon['alt'] ) ? $icon['alt'] : '';
$icon_path = is_string( $icon ) ? $icon : '';
$has_icon  = $icon_url || $icon_path;

$link = isset( $args['link'] ) ? $args['link'] : null;

if ( ! $label && ! $has_icon ) {
	return;
}

// Determina il tag da usare: <a> se link presente, altrimenti <div>
$tag = $link ? 'a' : 'div';
?>

<<?php echo $tag; ?>
	<?php if ( $link ) : ?>
		href="<?php echo esc_url( $link ); ?>"
		<?php
		// se il link contiene http, consideriamo esterno e mettiamo target="_blank"
		if (strpos($link, 'http') === 0) {
			echo ' target="_blank" rel="noopener noreferrer"';
		}
		?>
	<?php endif; ?>
	class="negozio-meta border-primary-500 bg-white <?php echo esc_attr( $class ); ?>">
	<?php if ( $has_icon ) : ?>
		<span class="negozio-meta__icon bg-primary-500 h-[75px]">
			<?php if ( $icon_url ) : ?>
				<img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_attr( $icon_alt ); ?>" class="w-9 h-9 object-contain" loading="lazy">
			<?php else : ?>
				<?php get_template_part( $icon_path ); ?>
			<?php endif; ?>
		</span>
	<?php endif; ?>
	<?php if ( $label ) : ?>
		<span class="negozio-meta__text desc-1 px-6 pe-12 text-gray-600"><?php echo wp_kses_post( $label ); ?></span>
	<?php endif; ?>
</<?php echo $tag; ?>>
