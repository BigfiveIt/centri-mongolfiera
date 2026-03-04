<?php

$id        = isset( $args['id'] ) ? $args['id'] : null;
$immagine  = isset( $args['immagine'] ) ? $args['immagine'] : null;
$titolo    = isset( $args['titolo'] ) ? $args['titolo'] : null;
$link      = isset( $args['link'] ) ? $args['link'] : null;
$data      = isset( $args['data'] ) ? $args['data'] : null;
$type      = isset( $args['type'] ) ? $args['type'] : null;
$categoria = isset( $args['categoria'] ) ? $args['categoria'] : null;

if ( ! $categoria && $id ) {
	$terms = get_the_terms( $id, 'categoria-eventi' );
	if ( $terms && ! is_wp_error( $terms ) && ! empty( $terms ) ) {
		$categoria = $terms[0];
	}
}

?>

<article <?php post_class( 'teaser-event h-full bg-white flex flex-col rounded-2xl shadow-lg lg:p-4 relative overflow-hidden' ); ?> id="<?php echo esc_attr( $id ); ?>">

	<div class="teaser-event__image relative overflow-hidden rounded-2xl">
		<?php if ( $link ) : ?>
			<a href="<?php echo esc_url( $link ); ?>" class="block teaser-event__image-link">
		<?php endif; ?>
		<?php if ( $immagine ) : ?>
			<?php
			$post_thumbnail_id = get_post_thumbnail_id( $id );
			$alt_text          = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
			$image_data        = $post_thumbnail_id ? wp_get_attachment_image_src( $post_thumbnail_id, 'medium_large' ) : null;
			$img_w             = $image_data && ! empty( $image_data[1] ) ? (int) $image_data[1] : 768;
			$img_h             = $image_data && ! empty( $image_data[2] ) ? (int) $image_data[2] : 576;
			?>
			<figure><img class="w-full h-full object-cover aspect-square" src="<?php echo esc_url( $immagine ); ?>" alt="<?php echo esc_attr( $alt_text ?: $titolo ); ?>" width="<?php echo esc_attr( $img_w ); ?>" height="<?php echo esc_attr( $img_h ); ?>" loading="lazy"></figure>
		<?php else : ?>
			<figure><img class="w-full h-full object-cover aspect-square" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/placeholder-800x600.png' ); ?>" alt="" width="800" height="600" loading="lazy"></figure>
		<?php endif; ?>
		<?php if ( $link ) : ?>
			</a>
		<?php endif; ?>
	</div>

	<div class="teaser-event__content p-4">
		<?php if ( $categoria && $categoria instanceof WP_Term ) : ?>
			<?php
			$term_link = get_term_link( $categoria );
			if ( ! is_wp_error( $term_link ) ) :
				?>
			<div class="teaser-event__category mb-1">
				<a href="<?php echo esc_url( $term_link ); ?>" class="text-secondary-500 font-bold uppercase no-underline desc-3"><?php echo esc_html( $categoria->name ); ?></a>
			</div>
			<?php endif; ?>
		<?php elseif ( $type ) : ?>
			<div class="teaser-event__type uppercase desc-3">
				<span><?php echo esc_html( $type ); ?></span>
			</div>
		<?php endif; ?>

		<?php if ( $titolo ) : ?>
			<h3 class="teaser-event__title font-black text-primary-500 t-5">
				<a href="<?php echo esc_url( $link ); ?>" class="no-underline teaser-event__title-link"><?php echo esc_html( $titolo ); ?></a>
			</h3>
		<?php endif; ?>

        <?php if ($data) : ?>
            <time class="teaser-event__date desc-3">
                <?php echo esc_html($data); ?>
            </time>
        <?php endif; ?>

    </div>
</article>