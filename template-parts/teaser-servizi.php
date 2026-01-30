<?php
$immagine_url = isset($args['immagine_url']) ? $args['immagine_url'] : null;
$immagine_alt = isset($args['immagine_alt']) ? $args['immagine_alt'] : null;
$titolo = isset($args['titolo']) ? $args['titolo'] : null;
$testo = isset($args['testo']) ? $args['testo'] : null;
$cta = isset($args['cta']) ? $args['cta'] : null;
?>
<article class="teaser-servizi h-full bg-white flex flex-col gap-4 rounded-2xl shadow-lg p-4 relative overflow-hidden">
    <?php if ($immagine_url) : ?>
        <figure class="teaser-servizi__image relative">
            <img class="w-full h-full object-contain aspect-video" src="<?php echo esc_url($immagine_url); ?>" alt="<?php echo esc_attr($immagine_alt ?: $titolo); ?>" loading="lazy">
        </figure>
    <?php endif; ?>
    <div class="teaser-servizi__content flex flex-col justify-between gap-12">
        <div class="teaser-servizi__title-container">
            <h3 class="teaser-servizi__title font-medium t-5 text-primary-500"><?php echo esc_html($titolo); ?></h3>
            <?php if ($testo) : ?>
                <div class="desc-2 text-primary-500"><?php echo esc_html($testo); ?></div>
            <?php endif; ?>
        </div>
        <?php if ($cta) : ?>   
            <a href="<?php echo esc_url($cta['url']); ?>" class="btn btn-primary-outlined justify-between stretched-link">
                <span><?php echo esc_html($cta['title']); ?></span>
                <svg width="24" height="24" viewBox="0 0 32 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30.9399 9.70028L22.6199 0.340279C22.1852 -0.102532 21.5534 -0.0984702 21.1492 0.267157C20.7451 0.632785 20.7105 1.33357 21.0761 1.73777L27.8522 9.35889H1.04C0.46514 9.35889 0 9.82405 0 10.3989C0 10.9737 0.465156 11.4389 1.04 11.4389H27.8522L21.0761 19.06C20.7105 19.4642 20.7572 20.1528 21.1492 20.5306C21.5575 20.9247 22.2542 20.8617 22.6199 20.4575L30.9399 11.0975C31.3075 10.5836 31.2628 10.1492 30.9399 9.70028Z" fill="#292929"/>
                </svg>
            </a>
        <?php endif; ?>
    </div>
    
</article>