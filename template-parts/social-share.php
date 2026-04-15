<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$label = isset( $args['label'] ) ? $args['label'] : 'Condividi';
$permalink = isset( $args['permalink'] ) ? $args['permalink'] : get_permalink();
$title = isset( $args['title'] ) ? $args['title'] : get_the_title();

$post_url = rawurlencode( (string) $permalink );
$post_title = rawurlencode( (string) $title );
$whatsapp_text = rawurlencode( trim( (string) $title . ' ' . (string) $permalink ) );
?>

<div class="social-share border-t border-primary-500 pt-3 mt-5 flex gap-4 justify-between">
	<span class="t-5 text-primary-500 font-extrabold"><?php echo esc_html( $label ); ?></span>
	<div class="social-icons flex gap-3 text-white">
		<a href="<?php echo esc_url( 'mailto:?subject=' . $post_title . '&body=' . $post_url ); ?>" class="social-icon w-9 h-9 rounded-full bg-black p-3 flex items-center justify-center hover:bg-secondary-500 transition-colors duration-200" aria-label="Condividi via email">
			<?php get_template_part( 'images/icons/socials/email' ); ?>
		</a>
		<a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon w-9 h-9 rounded-full bg-black p-3 flex items-center justify-center hover:bg-secondary-500 transition-colors duration-200" aria-label="Condividi su Facebook">
			<?php get_template_part( 'images/icons/socials/facebook' ); ?>
		</a>
		

		<a href="<?php echo esc_url( 'https://x.com/intent/tweet?url=' . $post_url . '&text=' . $post_title ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon w-9 h-9 rounded-full bg-black p-3 flex items-center justify-center hover:bg-secondary-500 transition-colors duration-200" aria-label="Condividi su X">
			<?php get_template_part( 'images/icons/socials/x' ); ?>
		</a>

		<a href="<?php echo esc_url( 'https://wa.me/?text=' . $whatsapp_text ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon w-9 h-9 rounded-full bg-black p-2 flex items-center justify-center hover:bg-secondary-500 transition-colors duration-200" aria-label="Condividi su WhatsApp">
			<?php get_template_part( 'images/icons/socials/whatsapp' ); ?>
		</a>
	</div>
</div>

