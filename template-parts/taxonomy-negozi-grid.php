<?php
/**
 * Template part per la griglia dei negozi
 */

if (have_posts()): ?>
    <div class="taxonomy-negozi-grid grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 lg:px-28">
        <?php while (have_posts()): the_post(); ?>
            <div data-aos="fade-up">
                <?php get_template_part('template-parts/teaser-negozio', null, [
                    'logo' => get_field('logo'),
                    'title' => get_the_title(),
                    'link' => get_permalink(),
                ]); ?>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="text-center py-12" data-aos="fade-up">
        <p class="text-gray-500 text-lg"><?php _e('Nessun negozio trovato.', 'mongolfiera'); ?></p>
    </div>
<?php endif; ?>
