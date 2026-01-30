<?php 
$immagine = isset($args['immagine']) ? $args['immagine'] : null;
$immagine_alt = isset($args['immagine_alt']) ? $args['immagine_alt'] : '';
$titolo = isset($args['titolo']) ? $args['titolo'] : null;
$testo = isset($args['testo']) ? $args['testo'] : null;
$cta = isset($args['cta']) ? $args['cta'] : null;
?>

<article class="card-info h-full bg-white flex flex-col rounded-2xl shadow-lg p-4 relative overflow-hidden duration-500 transition-transform hover:scale-95">
    <div class="card-info__image relative">
        <?php if ($immagine) : ?>
            <figure><img class="w-full h-full object-cover aspect-6/3 rounded-2xl" src="<?php echo esc_url($immagine); ?>" alt="<?php echo esc_attr($immagine_alt ?: $titolo); ?>" loading="lazy"></figure>
        <?php else: ?>
            <figure><img class="w-full h-full object-cover aspect-6/3 rounded-2xl" src="<?php echo get_stylesheet_directory_uri();?>/images/placeholder-800x600.png" alt="" loading="lazy"></figure>
        <?php endif; ?>
    </div>
    <div class="card-info__content py-4">
        <?php if ($titolo) : ?>
            <h3 class="card-info__title font-extrabold t-3 leading-none text-primary-500 font-serif my-5">
                <?php if ($cta && !empty($cta['url'])) : ?>
                    <a href="<?php echo esc_url($cta['url']); ?>" class="no-underline stretched-link card-info__title-link"><?php echo esc_html($titolo); ?></a>
                <?php else : ?>
                    <span class="card-info__title-text leading-none"><?php echo esc_html($titolo); ?></span>
                <?php endif; ?>
            </h3>
        <?php endif; ?>
        <?php if ($testo) : ?>
            <div class="card-info__text desc-2 text-primary-500 leading-tight"><?php echo wp_kses_post(nl2br($testo)); ?></div>
        <?php endif; ?>
    </div>
    <?php if ($cta && !empty($cta['url'])) : ?>
        <div class="card-info__cta mt-8 self-start">
            <a href="<?php echo esc_url($cta['url']); ?>" class="btn btn-primary-outlined flex items-center gap-2 no-underline"<?php echo !empty($cta['target']) ? ' target="' . esc_attr($cta['target']) . '"' : ''; ?>>
                <?php echo esc_html($cta['title']); ?>
                <span class="inline-block align-middle [&_svg]:w-10 ms-12">
                    <?php get_template_part('images/icons/long-arrow-right'); ?>
                </span>
            </a>
        </div>
    <?php endif; ?>
</article>