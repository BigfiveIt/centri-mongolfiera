<?php
/**
 * The template for displaying all single posts
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
while ( have_posts() ): the_post(); 

$terms = get_the_terms( get_the_ID(), 'categoria_negozi' );
?>

<div class="container">
    <div class="lg:px-28">

        <?php 
        $logo = get_field('logo');
        $gallery = get_field('gallery');
        if($logo || $gallery):
        ?>

        <section class="negozio-gallery my-16" data-aos="fade-up">
            <?php
            
            if($logo):
            ?>
            <div class="flex justify-center">
                <figure class="negozio-logo flex justify-center items-center bg-white rounded-2xl p-10 w-[640px] h-[240px]">
                    <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="h-full w-full object-contain">
                </figure>
            </div>
            <?php endif; ?>
            <?php
            
            if($gallery):
            ?>
            
                <div class="negozio-gallery__carousel overflow-hidden mt-8 lg:mt-16">
                    <div class="swiper-wrapper">
                        <?php foreach($gallery as $image): ?>
                            <figure class="swiper-slide negozio-gallery__carousel__item aspect-21/9 rounded-3xl overflow-hidden">
                                <img class="w-full h-full object-cover" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                            </figure>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination flex justify-center gap-2 mt-8"></div>
                </div>
            
            <?php endif; ?>

        </section>
        <?php endif; ?>

        <section class="single-negozio__content my-16" data-aos="fade-up">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-16">
                <div class="col-span-1">
                    <a href="<?php echo get_post_type_archive_link('negozi'); ?>" class="btn btn-link">
                        <?php get_template_part('images/icons/arrow-left'); ?><span><?php _e('Negozi','mongolfiera'); ?></span>
                    </a>
                    <h1 class="t-3 my-4 font-bold font-serif text-primary-500"><?php the_title(); ?></h1>
                    <div class="desc-1 text-primary-500"><?php the_content(); ?></div>
                </div>
                <div class="col-span-1 lg:ps-16">
                    <div class="flex flex-col gap-4">
                        <?php if ( get_field( 'orari' ) || get_global_option('orari_negozi') ) : ?>
                            <?php
                            $orari = get_field( 'orari' ) ? get_field( 'orari' ) : get_global_option('orari_negozi');
                            get_template_part( 'template-parts/icon-contact', null, [
                                'icon'  => [
                                    'url' => get_template_directory_uri() . '/images/clock.svg',
                                    'alt' => 'Icona orario',
                                ],
                                'label' => $orari,
                                'class' => 'mb-4',
                            ] );
                            ?>
                        <?php endif; ?>
                        <?php if( get_field('telefono')):?>
                            <a class="negozio-meta group no-underline" href="tel:<?php echo get_field('telefono'); ?>">
                                <span class="negozio-meta__icon shrink-0 text-primary-500 group-hover:text-primary-400 transition-colors duration-200"><?php get_template_part('images/icons/phone'); ?></span>
                                <span class="negozio-meta__text desc-2 text-gray-600 group-hover:text-primary-400 transition-colors duration-200"><?php echo get_field('telefono'); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if( get_field('email')):?>
                            <a class="negozio-meta group no-underline" href="mailto:<?php echo get_field('email'); ?>">
                                <span class="negozio-meta__icon shrink-0 text-primary-500 group-hover:text-primary-400 transition-colors duration-200"><?php get_template_part('images/icons/mail'); ?></span>
                                <span class="negozio-meta__text desc-2 text-gray-600 group-hover:text-primary-400 transition-colors duration-200"><?php echo get_field('email'); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if( get_field('sito')):?>
                            <a class="negozio-meta group no-underline" href="<?php echo get_field('sito'); ?>" target="_blank">
                                <span class="negozio-meta__icon shrink-0 text-primary-500 group-hover:text-primary-400 transition-colors duration-200"><?php get_template_part('images/icons/globe'); ?></span>
                                <span class="negozio-meta__text desc-2 text-gray-600 group-hover:text-primary-400 transition-colors duration-200"><?php echo get_field('sito'); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if( get_field('facebook')):?>
                            <a class="negozio-meta group no-underline" href="<?php echo get_field('facebook'); ?>" target="_blank">
                                <span class="negozio-meta__icon shrink-0 text-primary-500 group-hover:text-primary-400 transition-colors duration-200"><?php get_template_part('images/icons/socials/facebook'); ?></span>
                                <span class="negozio-meta__text desc-2 text-gray-600 group-hover:text-primary-400 transition-colors duration-200"><?php echo get_field('facebook'); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if( get_field('instagram')):?>
                            <a class="negozio-meta group no-underline  group-hover:text-primary-500 transition-colors duration-200" href="<?php echo get_field('instagram'); ?>" target="_blank">
                                <span class="negozio-meta__icon shrink-0 text-primary-500 group-hover:text-primary-400 transition-colors duration-200"><?php get_template_part('images/icons/socials/instagram'); ?></span>
                                <span class="negozio-meta__text desc-2 text-gray-600 group-hover:text-primary-400 transition-colors duration-200"><?php echo get_field('instagram'); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if( get_field('click_and_collect')):?>
                            <a class="negozio-meta group no-underline" href="<?php echo get_field('click_and_collect'); ?>" target="_blank">
                                <span class="negozio-meta__icon shrink-0 text-primary-500 group-hover:text-primary-400 transition-colors duration-200"><?php get_template_part('images/icons/click_and_collect'); ?></span>
                                <span class="negozio-meta__text desc-2 text-gray-600 group-hover:text-primary-500 transition-colors duration-200"><?php echo get_field('click_and_collect'); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </section>

        <?php 
        $term_ids = wp_list_pluck( $terms, 'term_id' );
        $current_post_id = get_the_ID();
        
        $args_query = array(
            'post_type'      => 'negozi',
            'posts_per_page' => 12,
            'post__not_in'   => array( $current_post_id ),
            'tax_query'      => array(
                array(
                    'taxonomy' => 'categoria_negozi',
                    'field'    => 'term_id',
                    'terms'    => $term_ids,
                ),
            ),
        );

        $the_query = new WP_Query( $args_query );
        
        // Se ci sono meno di 12 risultati e meno di 6, aggiungi negozi casuali fino ad avere almeno 6
        if ( $the_query->found_posts < 12 && $the_query->found_posts < 6 ) {
            $posts_found = $the_query->found_posts;
            $posts_to_add = 6 - $posts_found;
            
            // Raccogli gli ID dei post già trovati (senza consumare il loop)
            $exclude_ids = array( $current_post_id );
            foreach ( $the_query->posts as $post ) {
                $exclude_ids[] = $post->ID;
            }
            
            // Query per negozi casuali (ottimizzata: no_found_rows evita il count totale)
            $args_random = array(
                'post_type'      => 'negozi',
                'posts_per_page' => $posts_to_add,
                'post__not_in'   => $exclude_ids,
                'orderby'        => 'rand',
                'no_found_rows'  => true, // Ottimizzazione: non calcola il count totale
            );
            
            $random_query = new WP_Query( $args_random );
            
            // Unisci i risultati
            if ( $random_query->have_posts() ) {
                // Aggiungi i post casuali a quelli esistenti
                $the_query->posts = array_merge( $the_query->posts, $random_query->posts );
                $the_query->post_count = count( $the_query->posts );
            }
        }
        
        if ( $the_query->have_posts() ) :
        ?>
        <section class="my-6 lg:my-28 related-negozi" data-aos="fade-up">

            <h2 class="mb-8 t-4 font-serif text-primary-500 font-bold text-center"><?php _e('I Negozi del Centro','mongolfiera');?></h2>
            <div class="related-negozi__carousel overflow-hidden pb-6">
                <div class="swiper-wrapper">
                    <?php while ( $the_query->have_posts() ) :$the_query->the_post(); ?>
                        <div class="swiper-slide">
                            <?php get_template_part('template-parts/teaser-negozio', null, [
                                'logo' => get_field('logo'),
                                'title' => get_the_title(),
                                'link' => get_permalink(),
                            ]); ?>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
                <div class="swiper-pagination flex justify-center gap-2 mt-8"></div>
            </div>
        
        </section>
        <?php endif; ?>
    </div>
</div>

<?php
endwhile;
get_footer();
