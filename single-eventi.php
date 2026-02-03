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
	<div class="container py-16">
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:px-28" data-aos="fade-up">
			<div>
				<figure><?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover aspect-square']); ?></figure>
				<div class="social-share border-t border-primary-500 pt-3 mt-5 flex gap-4 justify-between">
					<span class="t-5 text-primary-500 font-extrabold">Condividi</span>
					<div class="social-icons flex gap-3 text-white">
						<?php
						$post_url = urlencode( get_permalink() );
						$post_title = urlencode( get_the_title() );
						?>
						<a href="mailto:?subject=<?php echo esc_attr( $post_title ); ?>&body=<?php echo esc_url( get_permalink() ); ?>" class="social-icon w-9 h-9 rounded-full bg-black p-3 flex items-center justify-center hover:bg-primary-400 transition-colors duration-200" aria-label="Condividi via email">
							<?php get_template_part('images/icons/socials/email'); ?>
						</a>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $post_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon w-9 h-9 rounded-full bg-black p-3 flex items-center justify-center hover:bg-primary-400 transition-colors duration-200" aria-label="Condividi su Facebook">
							<?php get_template_part('images/icons/socials/facebook'); ?>
						</a>
						<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_url( $post_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon w-9 h-9 rounded-full bg-black p-3 flex items-center justify-center hover:bg-primary-400 transition-colors duration-200" aria-label="Condividi su LinkedIn">
							<?php get_template_part('images/icons/socials/linkedin'); ?>
						</a>
						<a href="https://x.com/intent/tweet?url=<?php echo esc_url( $post_url ); ?>&text=<?php echo esc_attr( $post_title ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon w-9 h-9 rounded-full bg-black p-3 flex items-center justify-center hover:bg-primary-400 transition-colors duration-200" aria-label="Condividi su X">
							<?php get_template_part('images/icons/socials/x'); ?>
						</a>
					</div>
				</div>
			</div>
			<div class="flex flex-col gap-4">
				<a href="<?php echo get_post_type_archive_link('eventi'); ?>" class="btn btn-link">
					<?php get_template_part('images/icons/arrow-left'); ?><span>Eventi</span>
				</a>
				<?php
				$data_inizio_single = get_field( 'data_inizio' );
				$data_fine_single = get_field( 'data_fine' );
				
				if ( $data_inizio_single ) : 
					$data_display = $data_fine_single 
						? 'Dal ' . $data_inizio_single . ' al ' . $data_fine_single 
						: 'Dal ' . $data_inizio_single;
				?>
					<time class="text-primary-500 desc-1"><?php echo esc_html( $data_display ); ?></time>
				<?php endif; ?>
				<h1 class="t-1 text-primary-500 leading-none font-black font-serif"><?php the_title(); ?></h1>
				<div class="text-prmary-500 t-5"><?php the_content(); ?></div>
			</div>
		</div>
	</div>

	<?php
	$today = date( 'Ymd' );
	$altri_eventi = new WP_Query( [
		'post_type'      => 'eventi',
		'posts_per_page' => 6,
		'post__not_in'   => [ get_the_ID() ],
		'meta_query'     => [
			'relation' => 'OR',
			[
				'key'     => 'data_fine',
				'value'   => $today,
				'compare' => '>=',
			],
			[
				'relation' => 'AND',
				[
					'key'     => 'data_fine',
					'compare' => 'NOT EXISTS',
				],
				[
					'key'     => 'data_inizio',
					'value'   => $today,
					'compare' => '>=',
				],
			],
		],
		'meta_key'       => 'data_inizio',
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
	] );
	?>

	<?php if ( $altri_eventi->have_posts() ) : ?>
		<section class="my-10 lg:my-20 altre-eventi" data-aos="fade-up">
			<div class="container">
				<h2 class="mb-8 t-4 font-serif text-primary-500 font-bold text-center">Altri eventi</h2>
				<div class="altre-eventi__carousel overflow-hidden py-6">
					<div class="swiper-wrapper">
						<?php while ( $altri_eventi->have_posts() ) : $altri_eventi->the_post(); ?>
							<div class="swiper-slide">
								<?php
								$data_inizio = get_field( 'data_inizio' );
								$data_fine = get_field( 'data_fine' );
								
								// Formatta la data per il teaser-event
								$data_formattata = '';
								if ( $data_inizio ) {
									if ( $data_fine ) {
										$data_formattata = 'Dal ' . $data_inizio . ' al ' . $data_fine;
									} else {
										$data_formattata = 'Dal ' . $data_inizio;
									}
								}
								
								get_template_part( 'template-parts/teaser-event', null, [
									'id'          => get_the_ID(),
									'immagine'    => get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ),
									'titolo'      => get_the_title(),
									'link'        => get_permalink(),
									'data'        => $data_formattata,
									'type'        => ''
								] );
								?>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
					<div class="swiper-pagination flex justify-center gap-1 mt-8"></div>
				</div>
			</div>
		</section>
	<?php endif; ?>
<?php endwhile; ?>


<?php
get_footer();
