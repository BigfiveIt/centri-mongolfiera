<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>


	<?php if ( have_posts() ): ?>
	<div class="container mx-auto px-4">
		<header class="page-header py-16" data-aos="fade-up">
			<div class="t-1 text-primary-500 leading-none font-black font-serif"><?php _e('Promozioni','mongolfiera'); ?></div>
		</header><!-- .page-header -->

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up">
			<?php while ( have_posts() ): the_post(); ?>
				<div>
					<?php 
					$data_inizio = get_field('data_inizio');
					$data_fine = get_field('data_fine');
					get_template_part('template-parts/teaser-promozioni', null, [
						'id' => get_the_ID(),
						'immagine' => get_the_post_thumbnail_url(get_the_ID(), 'medium_large'),
						'titolo' => get_the_title(),
						'link' => get_permalink(),
						'data_inizio' => $data_inizio ? $data_inizio : '',
						'data_fine' => $data_fine ? $data_fine : ''
					]); ?>
				</div>
			<?php endwhile; ?>
		</div>
		
		<?php mongolfiera_promozioni_pagination(); ?>

		<?php
		$stato = isset( $_GET['stato'] ) ? sanitize_text_field( $_GET['stato'] ) : '';
		?>
		<div class="my-6 lg:my-12 flex justify-center" data-aos="fade-up">
			<?php if ( $stato === 'passate' ) : ?>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'promozioni' ) ); ?>" class="btn btn-primary-light">Promozioni Attive</a>
			<?php else : ?>
				<a href="<?php echo esc_url( add_query_arg( 'stato', 'passate', get_post_type_archive_link( 'promozioni' ) ) ); ?>" class="btn btn-primary-light">Archivio Promozioni</a>
			<?php endif; ?>
		</div>
	</div>

	<?php endif;?>


<?php
get_footer();
