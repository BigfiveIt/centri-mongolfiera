<?php
$logo = isset($args['logo']) ? $args['logo'] : null;
$title = isset($args['title']) ? $args['title'] : null;
$link = isset($args['link']) ? $args['link'] : null;
$title_tag = isset($args['title_tag']) ? $args['title_tag'] : 'h3';
?>
<article class="teaser-negozio group h-full relative">
    <figure class="teaser-negozio__icon aspect-square rounded-2xl overflow-hidden bg-white border border-secondary-500 p-[20px] lg:p-[40px] transition-all duration-300 ease-out group-hover:shadow-lg group-hover:translate-y-[-2px]">
        <?php if($logo): ?>
            <img src="<?php echo esc_url($logo['sizes']['large']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="w-full h-full object-contain" loading="lazy">
        <?php endif; ?>
    </figure>
    <div class="teaser-negozio__content">
        <<?php echo $title_tag; ?> class="teaser-negozio__title text-center mt-4 js-text-anim-off">
            <a href="<?php echo $link; ?>" class="no-underline stretched-link teaser-negozio__title-link font-semibold"><?php echo $title; ?></a>
        </<?php echo $title_tag; ?>>
    </div>
</article>