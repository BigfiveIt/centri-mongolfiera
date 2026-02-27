<?php
$logo = isset($args['logo']) ? $args['logo'] : null;
$title = isset($args['title']) ? $args['title'] : null;
$link = isset($args['link']) ? $args['link'] : null;
?>
<article class="teaser-negozio group h-full relative">
    <figure class="teaser-negozio__icon aspect-square rounded-2xl overflow-hidden bg-white border border-secondary-500 p-14 transition-all duration-300 ease-out group-hover:shadow-lg group-hover:translate-y-[-2px]">
        <?php if($logo): ?>
            <img src="<?php echo esc_url($logo['sizes']['large']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="w-full h-full object-contain" loading="lazy">
        <?php endif; ?>
    </figure>
    <div class="teaser-negozio__content">
        <h3 class="teaser-negozio__title text-center mt-4">
            <a href="<?php echo $link; ?>" class="no-underline stretched-link teaser-negozio__title-link font-semibold"><?php echo $title; ?></a>
        </h3>
    </div>
</article>