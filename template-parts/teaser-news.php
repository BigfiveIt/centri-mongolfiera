<?php 

$id = isset($args['id']) ? $args['id'] : null;
$immagine = isset($args['immagine']) ? $args['immagine'] : null;
$titolo = isset($args['titolo']) ? $args['titolo'] : null;
$link = isset($args['link']) ? $args['link'] : null;
$data = isset($args['data']) ? $args['data'] : null;
$categoria = isset($args['categoria']) ? $args['categoria'] : null;

?>

<article <?php post_class('teaser-news h-full bg-white flex flex-col rounded-2xl shadow-lg p-4 relative overflow-hidden transition-all duration-300 hover:scale-[0.98] hover:shadow-md h-full'); ?> id="<?php echo esc_attr($id); ?>">
    
    <div class="teaser-news__image relative">
        <?php if ($immagine) : ?>
            <?php
            $post_thumbnail_id = get_post_thumbnail_id( $id );
            $alt_text          = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
            $image_data        = $post_thumbnail_id ? wp_get_attachment_image_src( $post_thumbnail_id, 'medium_large' ) : null;
            $img_w             = $image_data && ! empty( $image_data[1] ) ? (int) $image_data[1] : 768;
            $img_h             = $image_data && ! empty( $image_data[2] ) ? (int) $image_data[2] : 576;
            ?>
            <figure><img class="w-full h-full object-cover aspect-square rounded-xl" src="<?php echo esc_url( $immagine ); ?>" alt="<?php echo esc_attr( $alt_text ?: $titolo ); ?>" width="<?php echo esc_attr( $img_w ); ?>" height="<?php echo esc_attr( $img_h ); ?>" loading="lazy"></figure>
            <?php else : ?>
            <figure><img class="w-full h-full object-cover aspect-square rounded-xl" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/placeholder-800x600.png' ); ?>" alt="" width="800" height="600" loading="lazy"></figure>
        <?php endif; ?>
    </div>

    <div class="teaser-news__content p-4">
        

        <?php if ($titolo) : ?>
            <h3 class="teaser-news__title uppercase font-bold t-5 text-primary-500">
                <a href="<?php echo esc_url($link); ?>" class="no-underline stretched-link teaser-news__title-link"><?php echo esc_html($titolo); ?></a>
            </h3>
        <?php endif; ?>

        <div class="teaser-news__meta flex items-center gap-2">
            <?php if ($data) : ?>
                <time class="teaser-news__date desc-3 text-primary-500">
                    <?php echo esc_html($data); ?>
                </time>
            <?php endif; ?>
        </div>

    </div>
</article>