<?php
$titolo         = isset( $args['titolo'] ) ? $args['titolo'] : null;
$testo          = isset( $args['testo'] ) ? $args['testo'] : null;
$cta            = isset( $args['cta'] ) ? $args['cta'] : null;
$immagine_url   = isset( $args['immagine_url'] ) ? $args['immagine_url'] : null;
$immagine_alt   = isset( $args['immagine_alt'] ) ? $args['immagine_alt'] : null;
$immagine_w     = isset( $args['immagine_width'] ) ? (int) $args['immagine_width'] : 0;
$immagine_h     = isset( $args['immagine_height'] ) ? (int) $args['immagine_height'] : 0;
$fetchpriority  = isset( $args['fetchpriority'] ) && $args['fetchpriority'] === 'high' ? 'high' : 'auto';
?>
<section class="banner-cta grid grid-cols-1 md:grid-cols-2 my-8 lg:my-16 align-center rounded-2xl shadow-lg overflow-hidden bg-white">
    <?php if ( $immagine_url ) : ?>
        <figure class="banner-cta__image relative h-full col-span-1  overflow-hidden xl:pe-12">
            <img class="w-full h-full object-cover aspect-video md:aspect-4/1 rounded-2xl" src="<?php echo esc_url( $immagine_url ); ?>" alt="<?php echo esc_attr( $immagine_alt ?: $titolo ); ?>"<?php echo $immagine_w && $immagine_h ? ' width="' . esc_attr( $immagine_w ) . '" height="' . esc_attr( $immagine_h ) . '"' : ''; ?> loading="lazy" fetchpriority="<?php echo esc_attr( $fetchpriority ); ?>">
        </figure>
    <?php endif; ?>
    <div class="col-span-1 grid grid-cols-1 xl:grid-cols-3 gap-8 md:py-18 p-8 xl:pe-12">
        <div class="banner-cta__content col-span-2">
            <h2 class="banner-cta__title t-2 text-primary-500 font-black font-serif"><?php echo esc_html($titolo); ?></h2>
            <div class="banner-cta__description desc-2 text-primary-500 mt-4"><?php echo esc_html($testo); ?></div>
        </div>
        <?php if ($cta) : ?>
            <div class="flex justify-end items-center">
                <a href="<?php echo esc_url($cta['url']); ?>" class="btn btn-secondary px-12" target="<?php echo esc_attr($cta['target']); ?>"><?php echo esc_html($cta['title']); ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>