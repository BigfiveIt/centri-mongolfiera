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
	<div class="container mx-auto px-4 mb-16">
		<header class="page-header py-16">
			<div class="t-1 text-primary-500 leading-none font-black font-serif"><?php echo esc_html( strip_tags( get_the_archive_title() ) ); ?></div>
			<?php if ( get_the_archive_description() ) : ?>
				<div class="taxonomy-description mt-4"><?php the_archive_description(); ?></div>
			<?php endif; ?>
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

	<?php endif;?>


<?php
get_footer();
