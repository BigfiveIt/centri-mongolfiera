<?php
/**
 * The template for displaying all single posts
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php while ( have_posts() ): the_post(); ?>
	<section class="my-16">
		<div class="container">
			<div class="lg:px-28">
				<?php if(has_post_thumbnail()): ?>
					<figure>
						<img class="w-full h-full object-cover aspect-video rounded-2xl" src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
					</figure>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php 
	
	?>
	<section class="is-layout-constrained my-16 text-primary-500 desc-1">
		<a href="<?php echo get_post_type_archive_link(get_post_type()); ?>" class="btn btn-link">
			<?php get_template_part('images/icons/arrow-left'); ?><span><?php _e('Magazine','mongolfiera'); ?></span>
		</a>
		<h1 class="t-3 my-4 font-bold font-serif text-primary-500 leading-none"><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</section>

	<?php
	// Post correlati (stessa categoria, escluso il post corrente)
	$current_id = get_the_ID();
	$categories = get_the_category( $current_id );
	$cat_ids = array();
	if ( ! empty( $categories ) ) {
		foreach ( $categories as $cat ) {
			$cat_ids[] = $cat->term_id;
		}
	}
	$related_args = array(
		'post_type'      => 'post',
		'posts_per_page' => 6,
		'post__not_in'   => array( $current_id ),
		'orderby'        => 'rand',
	);
	if ( ! empty( $cat_ids ) ) {
		$related_args['category__in'] = $cat_ids;
	}
	$related_query = new WP_Query( $related_args );
	?>
	<?php if ( $related_query->have_posts() ) : ?>
	<section class="py-16">
		<div class="container">
			<h2 class="t-3 text-primary-500 leading-none text-center font-black font-serif mb-8 lg:mb-12"><?php esc_html_e( 'Potrebbero interessarti', 'mongolfiera' ); ?></h2>
			<?php
			$related_count = $related_query->post_count;
			$pagination_class = ( $related_count <= 3 ) ? 'hidden' : '';
			?>
			<div class="news-carousel overflow-hidden pb-6">
				<div class="swiper-wrapper">
					<?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
						<div class="swiper-slide">
							<?php
							get_template_part( 'template-parts/teaser-news', null, array(
								'id'        => get_the_ID(),
								'immagine'  => get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ),
								'titolo'    => get_the_title(),
								'link'      => get_permalink(),
								'data'      => get_the_date( 'd/m/Y' ),
								'categoria' => get_the_category(),
							) );
							?>
						</div>
					<?php endwhile; ?>
				</div>
				<div class="swiper-pagination flex justify-center gap-2 mt-8 <?php echo esc_attr( $pagination_class ); ?>"></div>
			</div>
		</div>
	</section>
	<?php wp_reset_postdata(); ?>
	<?php endif; ?>

<?php endwhile; ?>


<?php
get_footer();
