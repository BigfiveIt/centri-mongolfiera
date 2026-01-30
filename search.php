<?php
/**
 * The template for displaying search results pages
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php if ( have_posts() ) : ?>
	<div class="container mx-auto px-4 mb-16">
		<header class="page-header py-16">
			<div class="t-1 text-primary-500 leading-none font-black font-serif">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Risultati di ricerca per: %s', 'mongolfiera' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</div>
		</header><!-- .page-header -->

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
			<?php while ( have_posts() ) : the_post(); ?>
				<div>
					<?php get_template_part( 'template-parts/teaser-news', null, [
						'id'        => get_the_ID(),
						'immagine'  => get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ),
						'titolo'    => get_the_title(),
						'link'      => get_permalink(),
						'data'      => get_the_date(),
						'categoria' => get_the_category(),
						'autore'    => get_the_author(),
					] ); ?>
				</div>
			<?php endwhile; ?>
		</div>

		<?php mongolfiera_posts_pagination(); ?>
	</div>
<?php else : ?>
	<div class="container mx-auto px-4 mb-16">
		<header class="page-header py-16">
			<div class="t-1 text-primary-500 leading-none font-black font-serif">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Risultati di ricerca per: %s', 'mongolfiera' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</div>
		</header><!-- .page-header -->

		<p class="text-center text-gray-500"><?php _e( 'Nessun risultato trovato.', 'mongolfiera' ); ?></p>
	</div>
<?php endif; ?>

<?php
get_footer();
