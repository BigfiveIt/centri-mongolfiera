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


	<?php
	$stato = isset( $_GET['stato'] ) ? sanitize_text_field( $_GET['stato'] ) : '';
	$archive_url_eventi = get_post_type_archive_link('eventi');
	?>

	<?php if ( have_posts() ): ?>
	<div class="container mx-auto px-4">
		<header class="page-header py-16" data-aos="fade-up">
			<div class="t-1 text-primary-500 font-black font-serif">
				<?php if ( $stato === 'passate' ) : ?>
					<?php _e('Archivio News & Eventi','mongolfiera'); ?>
				<?php else : ?>
					<?php _e('News & Eventi','mongolfiera'); ?>
				<?php endif; ?>
			</div>
		</header><!-- .page-header -->

		<?php
		$current_cat = get_queried_object();
		$current_cat_id = ( is_tax('categoria-eventi') && $current_cat ) ? $current_cat->term_id : 0;
		$categorie_eventi = get_terms(array(
			'taxonomy'   => 'categoria-eventi',
			'hide_empty' => true,
		));
		if ( ! empty($categorie_eventi) && ! is_wp_error($categorie_eventi) ) : ?>

		<?php
		// Aggiunge ?stato=passate ai link categoria se il filtro è attivo
		$all_url = $stato === 'passate' ? add_query_arg( 'stato', 'passate', $archive_url_eventi ) : $archive_url_eventi;
		?>

		<!-- Select mobile -->
		<div class="lg:hidden custom-taxonomy-select mb-6" data-taxonomy-filter="true" data-archive-url="<?php echo esc_attr($archive_url_eventi); ?>">
			<button type="button"
					class="custom-taxonomy-select__button w-full px-4 py-2 desc-1 rounded-full border-0 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary-400 flex items-center justify-between <?php echo ($current_cat_id > 0) ? 'bg-secondary-400 text-white' : 'bg-gray-200'; ?>"
					aria-expanded="false" aria-haspopup="true">
				<span class="custom-taxonomy-select__selected-text">
					<?php echo $current_cat_id > 0 ? esc_html($current_cat->name) : __('Tutte le categorie','mongolfiera'); ?>
				</span>
				<svg class="custom-taxonomy-select__icon w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
				</svg>
			</button>
			<div class="custom-taxonomy-select__dropdown hidden absolute w-full mt-2 bg-white rounded-lg shadow-lg border border-gray-200 max-h-60 overflow-y-auto">
				<a href="<?php echo esc_url($all_url); ?>"
				   class="custom-taxonomy-select__option block px-4 py-2 desc-1 no-underline transition-colors <?php echo ($current_cat_id == 0) ? 'bg-secondary-400 text-white' : 'text-gray-700 hover:bg-gray-100'; ?>">
					<?php _e('Tutte le categorie','mongolfiera'); ?>
				</a>
				<?php foreach ($categorie_eventi as $cat) : ?>
				<?php $cat_url = $stato === 'passate' ? add_query_arg( 'stato', 'passate', get_term_link($cat) ) : get_term_link($cat); ?>
				<a href="<?php echo esc_url($cat_url); ?>"
				   class="custom-taxonomy-select__option block px-4 py-2 desc-1 no-underline transition-colors <?php echo ($current_cat_id == $cat->term_id) ? 'bg-secondary-400 text-white' : 'text-gray-700 hover:bg-gray-100'; ?>">
					<?php echo esc_html($cat->name); ?>
				</a>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- Pulsanti desktop -->
		<div class="hidden lg:flex gap-2 flex-wrap mb-8" data-aos="fade-up">
			<a href="<?php echo esc_url($all_url); ?>"
			   class="desc-1 px-6 py-2 rounded-full transition-colors no-underline whitespace-nowrap <?php echo ($current_cat_id == 0) ? 'bg-secondary-400 text-white hover:bg-primary-500' : 'bg-gray-200 hover:bg-secondary-400 hover:text-white'; ?>">
				<?php _e('Tutte le categorie','mongolfiera'); ?>
			</a>
			<?php foreach ($categorie_eventi as $cat) : ?>
			<?php $cat_url = $stato === 'passate' ? add_query_arg( 'stato', 'passate', get_term_link($cat) ) : get_term_link($cat); ?>
			<a href="<?php echo esc_url($cat_url); ?>"
			   class="desc-1 px-6 py-2 rounded-full transition-colors no-underline whitespace-nowrap <?php echo ($current_cat_id == $cat->term_id) ? 'bg-secondary-400 text-white hover:bg-primary-500' : 'bg-gray-200 hover:bg-secondary-400 hover:text-white'; ?>">
				<?php echo esc_html($cat->name); ?>
			</a>
			<?php endforeach; ?>
		</div>

		<?php endif; ?>

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up">
			<?php while ( have_posts() ): the_post(); ?>
				<div>
					<?php 
					$data_inizio = get_field('data_inizio');
					$data_fine = get_field('data_fine');
					
					// Formatta la data per il teaser-event
					$data_formattata = '';
					if ( $data_inizio ) {
						if ( $data_fine ) {
							$data_formattata = 'Dal ' . $data_inizio . ' al ' . $data_fine;
						} else {
							$data_formattata = 'Dal ' . $data_inizio;
						}
					}
					
					get_template_part('template-parts/teaser-event', null, [
						'id' => get_the_ID(),
						'immagine' => get_the_post_thumbnail_url(get_the_ID(), 'medium_large'),
						'titolo' => get_the_title(),
						'link' => get_permalink(),
						'data' => $data_formattata,
						'type' => ''
					]); ?>
				</div>
			<?php endwhile; ?>
		</div>
		
		<?php mongolfiera_eventi_pagination(); ?>

		<div class="my-6 mb-12 lg:my-12 flex justify-center" data-aos="fade-up">
			<?php if ( $stato === 'passate' ) : ?>
				<a href="<?php echo esc_url( $archive_url_eventi ); ?>" class="btn btn-secondary"><?php _e('News & Eventi in corso','mongolfiera'); ?></a>
			<?php else : ?>
				<a href="<?php echo esc_url( add_query_arg( 'stato', 'passate', $archive_url_eventi ) ); ?>" class="btn btn-secondary"><?php _e('News & Eventi passati','mongolfiera'); ?></a>
			<?php endif; ?>
		</div>
	</div>

	<?php endif;?>


<?php
get_footer();
