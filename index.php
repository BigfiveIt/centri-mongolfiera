<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<?php if ( have_posts() ): ?>
	<div class="container mx-auto px-4 mb-16">
		<header class="page-header py-16">
			<div class="t-1 text-primary-500 font-black font-serif"><?php _e( 'Magazine', 'mongolfiera' ); ?></div>
		</header><!-- .page-header -->

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
			<?php while ( have_posts() ): the_post(); ?>
				<div>
					<?php get_template_part('template-parts/teaser-news', null, [
						'id' => get_the_ID(),
						'immagine' => get_the_post_thumbnail_url(get_the_ID(), 'medium_large'),
						'titolo' => get_the_title(),
						'link' => get_permalink(),
						'data' => get_the_date(),
						'categoria' => get_the_category()
					]); ?>
				</div>
			<?php endwhile; ?>
		</div>

		<?php mongolfiera_posts_pagination(); ?>
	</div>
	<?php endif; ?>


<?php
get_footer();
