<?php 

$id = isset($args['id']) ? $args['id'] : null;
$immagine = isset($args['immagine']) ? $args['immagine'] : null;
$titolo = isset($args['titolo']) ? $args['titolo'] : null;
$data_inizio = isset($args['data_inizio']) ? $args['data_inizio'] : null;
$data_fine = isset($args['data_fine']) ? $args['data_fine'] : null;
$link = isset($args['link']) ? $args['link'] : null;

?>

<article <?php post_class('teaser-promozioni h-full bg-white flex flex-col rounded-2xl shadow-lg relative overflow-hidden transition-all duration-300 hover:scale-[0.98] hover:shadow-md'); ?> id="<?php echo esc_attr($id); ?>">
    <div class="teaser-promozioni__image relative overflow-hidden">
        <?php if ( $immagine ) : ?>
            <?php
            $post_thumbnail_id = get_post_thumbnail_id( $id );
            $alt_text          = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
            $image_data        = $post_thumbnail_id ? wp_get_attachment_image_src( $post_thumbnail_id, 'medium_large' ) : null;
            $img_w             = $image_data && ! empty( $image_data[1] ) ? (int) $image_data[1] : 768;
            $img_h             = $image_data && ! empty( $image_data[2] ) ? (int) $image_data[2] : 768;
            ?>
            <figure><img class="w-full h-full object-cover aspect-square" src="<?php echo esc_url( $immagine ); ?>" alt="<?php echo esc_attr( $alt_text ?: $titolo ); ?>" width="<?php echo esc_attr( $img_w ); ?>" height="<?php echo esc_attr( $img_h ); ?>" loading="lazy"></figure>
            <?php else : ?>
            <figure><img class="w-full h-full object-cover aspect-square" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/placeholder-800x600.png' ); ?>" alt="" width="800" height="600" loading="lazy"></figure>
        <?php endif; ?>
    </div>
    <div class="teaser-promozioni__content p-5">
        <?php if ($data_inizio && $data_fine) : ?>
            <div class="teaser-promozioni__date desc-3 text-primary-500">
                Dal
                <span><?php echo esc_html($data_inizio); ?></span>
                <?php if ($data_fine) : ?>
                al
                <span><?php echo esc_html($data_fine); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($titolo) : ?>
            <h3 class="teaser-promozioni__title font-extrabold text-primary-500 t-5">
                <a href="<?php echo esc_url($link); ?>" class="no-underline stretched-link teaser-promozioni__title-link"><?php echo esc_html($titolo); ?></a>
            </h3>
        <?php endif; ?>
    </div>
</article>