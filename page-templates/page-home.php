<?php
/**
 * Template Name: TPL Home
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<?php while ( have_posts() ): the_post(); ?>

    <?php $mostra_hero_slider = get_field( 'mostra_hero_slider' ); ?>
    <?php $mostra_infobox_icone = get_field( 'mostra_infobox_icone' ); ?>

    <section class="hero">
        <div class="lg:container mx-auto relative">
            <?php if ( $mostra_hero_slider ) : ?>
            <div class="hero-slider overflow-hidden relative" data-aos="fade">
                <div class="swiper-wrapper">
                    <?php while ( have_rows( 'hero_slider' ) ) : the_row(); ?>
                        <?php
                        $immagine_slide = get_sub_field( 'immagine_slide' );
                        $immagine_slide_mobile = get_sub_field( 'immagine_slide_mobile' );
                        $slide_link = get_sub_field( 'link' );
                        $link_url = $slide_link && isset( $slide_link['url'] ) ? $slide_link['url'] : '';
                        $link_target = $slide_link && isset( $slide_link['target'] ) && $slide_link['target'] ? $slide_link['target'] : '_self';
                        ?>
                        <div class="swiper-slide">
                        <?php if ( $immagine_slide && $immagine_slide_mobile ) : ?>
                            <?php if ( $link_url ) : ?><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php endif; ?>
                                <picture>
                                    <source media="(min-width:768px)" srcset="<?php echo esc_url( $immagine_slide['url'] ); ?>">
                                    <img src="<?php echo esc_url( $immagine_slide_mobile['sizes']['medium_large'] ); ?>" alt="<?php echo esc_attr( $immagine_slide_mobile['alt'] ? $immagine_slide_mobile['alt'] : $immagine_slide['alt'] ); ?>" class="w-full h-full object-cover lg:rounded-3xl aspect-square md:aspect-1400/660">
                                </picture>
                            <?php if ( $link_url ) : ?></a><?php endif; ?>
                        <?php elseif ( $immagine_slide ) : ?>
                            <figure>
                                <?php if ( $link_url ) : ?><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php endif; ?>
                                    <img src="<?php echo esc_url( $immagine_slide['sizes']['medium_large'] ); ?>" alt="<?php echo esc_attr( $immagine_slide['alt'] ); ?>" class="w-full h-full object-cover lg:rounded-3xl aspect-4/3 md:aspect-1400/660" />
                                <?php if ( $link_url ) : ?></a><?php endif; ?>
                            </figure>
                        <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-pagination flex justify-center gap-2 mt-6"></div>
            </div>
            <?php endif; ?>

            <?php if ( $mostra_infobox_icone ) : ?>
            <div class="info-box py-16 flex flex-col gap-12" data-aos="fade-up">

                <?php if ( get_field( 'info_box_icone_title' ) ) : ?>
                    <div class="t-2 text-primary-500 text-center font-serif"><?php echo  get_field( 'info_box_icone_title' ); ?></div>
                <?php endif; ?>

                <?php if ( have_rows( 'info_box_items' ) ) : ?>
                <div class="flex flex-wrap justify-center gap-4">
                    <?php while ( have_rows( 'info_box_items' ) ) : the_row(); ?>
                        <?php $icona = get_sub_field( 'icona' ); ?>
                        <?php $link = get_sub_field( 'link' ); ?>
                        <?php if ( $link ) : ?>
                        <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ); ?>" class="btn btn-primary-outlined">
                            <?php if ( $icona ) : ?>
                                <figure><img src="<?php echo esc_url( $icona['url'] ); ?>" alt="<?php echo esc_attr( $icona['alt'] ); ?>" class="w-6 h-6 object-contain" loading="lazy" /></figure>
                            <?php endif; ?>
                            <span class="font-bold text-primary-500 leading-none"><?php echo esc_html( $link['title'] ); ?></span>
                        </a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
                  
       
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php
    $griglia_wall = get_field( 'griglia_wall' );
    $grid_items = isset( $griglia_wall['grid_items'] ) ? $griglia_wall['grid_items'] : [];
    ?>

    <?php if ( get_field( 'mostra_griglia_wall' ) ) : ?>
    <section class="my-16" data-aos="fade-up">
        <div class="container">
            <div class="page-grid-wall">
                <?php foreach ( $grid_items as $grid_item ) : ?>
                    <?php
                    $grid_image = isset( $grid_item['immagine'] ) ? $grid_item['immagine'] : null;
                    $grid_link = isset( $grid_item['link'] ) ? $grid_item['link'] : null;
                    ?>
       
                    <a href="<?php echo esc_url( $grid_link['url'] ); ?>" target="<?php echo esc_attr( $grid_link['target'] ); ?>" class="page-grid-wall-item block h-36 lg:h-96 overflow-hidden relative">

                        <figure class="h-full w-full">
                            <?php if ( $grid_image ) : ?>
                                <img src="<?php echo esc_url( $grid_image['url'] ); ?>" alt="<?php echo esc_attr( $grid_image['alt'] ); ?>" class="h-full w-full object-cover" loading="lazy">
                            <?php endif; ?>
                        </figure>
                        <div class="absolute inset-0 p-4 lg:p-8 flex flex-col justify-end page-grid-wall-item__content z-10">
                            <?php if ( $grid_link['title'] ) : ?>
                                <div class="t-4 lg:t-2 text-white font-medium font-serif tracking-tight"><?php echo esc_html( $grid_link['title'] ); ?></div>
                            <?php endif; ?>
                        </div>
                    </a>

                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    $fascia_numeri_icone = get_field( 'fascia_numeri_icone' );
    $stats_items = isset( $fascia_numeri_icone['stats_items'] ) ? $fascia_numeri_icone['stats_items'] : [];
    ?>

    <?php if ( get_field( 'mostra_fascia_numeri_icone' ) ) : ?>
    <section class="my-16" data-aos="fade-up">
        <div class="container">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <?php foreach ( $stats_items as $item ) : ?>
                <?php
                $stat_icon = isset( $item['icona'] ) ? $item['icona'] : null;
                $stat_numero = isset( $item['numero'] ) ? $item['numero'] : '';
                $stat_etichetta = isset( $item['etichetta'] ) ? $item['etichetta'] : '';
                $stat_suffisso= isset( $item['suffisso'] ) ? $item['suffisso'] : '';
                ?>
                <div class="flex items-center gap-4">
                    <figure class="w-12 h-12 lg:w-24 lg:h-24 bg-secondary-500 rounded-full p-3 lg:p-5 shrink-0">
                        <?php if ( $stat_icon ) : ?>
                            <img src="<?php echo esc_url( $stat_icon['url'] ); ?>" alt="<?php echo esc_attr( $stat_icon['alt'] ); ?>" class="w-full h-full object-contain" loading="lazy">
                        <?php endif; ?>
                    </figure>
                    <div class="flex flex-col gap-1">
                        <?php if ( $stat_numero ) : ?>
                            <div class="t-3 text-primary-500 font-serif font-bold leading-none">
                                <span class="number-count" data-end="<?php echo esc_attr( $stat_numero ); ?>"><?php echo esc_html( $stat_numero ); ?></span>
                                <?php if ( $stat_suffisso ) : ?>
                                    <span><?php echo esc_html( $stat_suffisso ); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( $stat_etichetta ) : ?>
                            <div class="desc-1 text-primary-500 leading-none"><?php echo esc_html( $stat_etichetta ); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    $fascia_divertimento = get_field( 'fascia_divertimento' );
    $divertimento_sfondo = isset( $fascia_divertimento['sfondo'] ) ? $fascia_divertimento['sfondo'] : null;
    $divertimento_titolo = isset( $fascia_divertimento['titolo'] ) ? $fascia_divertimento['titolo'] : '';
    $divertimento_titolo_enfasi = isset( $fascia_divertimento['titolo_enfasi'] ) ? $fascia_divertimento['titolo_enfasi'] : '';
    $divertimento_cta = isset( $fascia_divertimento['cta'] ) ? $fascia_divertimento['cta'] : null;
    $divertimento_cta_url = isset( $divertimento_cta['url'] ) ? $divertimento_cta['url'] : '';
    $divertimento_cta_target = isset( $divertimento_cta['target'] ) && $divertimento_cta['target'] ? $divertimento_cta['target'] : '_self';
    $divertimento_cards = isset( $fascia_divertimento['cards'] ) ? $fascia_divertimento['cards'] : [];
    ?>

    <?php if ( get_field( 'mostra_fascia_divertimento' ) ) : ?>
    <section class="py-16 lg:py-24 overflow-hidden bg-cover bg-center section-divertimento" data-aos="fade-up" style="background-image: url(<?php echo esc_url( $divertimento_sfondo['url'] ); ?>);">
        <div class="container flex flex-col lg:flex-row gap-8 md:gap-16">
            <div class="w-full lg:w-2/5 self-center">
                <?php if ( $divertimento_titolo || $divertimento_titolo_enfasi ) : ?>
                    <div class="t-1 font-serif text-balance text-white">
                        <?php if ( $divertimento_titolo_enfasi ) : ?>
                            <b><span class="text-secondary-500"><?php echo esc_html( $divertimento_titolo_enfasi ); ?></span></b>
                        <?php endif; ?>
                        <?php if ( $divertimento_titolo ) : ?>
                            <br><?php echo esc_html( $divertimento_titolo ); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $divertimento_cta_url ) : ?>
                    <a href="<?php echo esc_url( $divertimento_cta_url ); ?>" class="btn btn-secondary mt-8 lg:mt-12 hidden lg:inline-flex" target="<?php echo esc_attr( $divertimento_cta_target ); ?>">
                        <span><?php echo esc_html( $divertimento_cta['title'] ? $divertimento_cta['title'] : 'Scopri' ); ?></span>
                        <svg width="32" height="21" viewBox="0 0 32 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M30.9399 9.70028L22.6199 0.340279C22.1852 -0.102532 21.5534 -0.0984702 21.1492 0.267157C20.7451 0.632785 20.7105 1.33357 21.0761 1.73777L27.8522 9.35889H1.04C0.46514 9.35889 0 9.82405 0 10.3989C0 10.9737 0.465156 11.4389 1.04 11.4389H27.8522L21.0761 19.06C20.7105 19.4642 20.7572 20.1528 21.1492 20.5306C21.5575 20.9247 22.2542 20.8617 22.6199 20.4575L30.9399 11.0975C31.3075 10.5836 31.2628 10.1492 30.9399 9.70028Z" fill="#2B463A"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
            <div class="w-full lg:w-3/5">
                <div class="divertimento-carousel">
                    <div class="swiper-wrapper">
                        <?php foreach ( $divertimento_cards as $card ) : ?>
                        <?php
                        $card_label = isset( $card['label'] ) ? $card['label'] : '';
                        $card_image = isset( $card['immagine'] ) ? $card['immagine'] : null;
                        $card_title = isset( $card['titolo'] ) ? $card['titolo'] : '';
                        $card_description = isset( $card['descrizione'] ) ? $card['descrizione'] : '';
                        ?>
                        <div class="swiper-slide">

                            <div class="divertimento-carousel-card bg-white rounded-2xl overflow-hidden p-6 flex flex-col mb-5">
                                <div class="flex justify-center">
                                    <?php if ( $card_label ) : ?>
                                        <div class="divertimento-carousel-card__label py-4 px-6 bg-primary-500 text-secondary-500 uppercase desc-4 font-bold text-center rounded-full">
                                            <?php echo esc_html( $card_label ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <figure class="grow flex flex-col justify-center">
                                    <?php if ( $card_image ) : ?>
                                        <img src="<?php echo esc_url( $card_image['url'] ); ?>" alt="<?php echo esc_attr( $card_image['alt'] ); ?>" class="w-full h-full object-contain" loading="lazy">
                                    <?php endif; ?>
                                </figure>
                            
                            </div>

                            <?php if ( $card_title ) : ?>
                                <div class="desc-2 font-black text-secondary-500 uppercase"><?php echo esc_html( $card_title ); ?></div>
                            <?php endif; ?>
                            <?php if ( $card_description ) : ?>
                                <div class="desc-3 font-semibold text-white"><?php echo wp_kses_post( $card_description ); ?></div>
                            <?php endif; ?>

                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-navigation flex justify-end gap-4 mt-8 text-white">
                        <div class="swiper-button-prev"><?php get_template_part('images/icons/arrow-left'); ?></div>
                        <div class="swiper-button-next"><?php get_template_part('images/icons/arrow-right'); ?></div>
                    </div>
                </div>
                <div class="flex lg:hidden">
                    <?php if ( $divertimento_cta_url ) : ?>
                        <a href="<?php echo esc_url( $divertimento_cta_url ); ?>" class="btn btn-secondary mt-8 lg:mt-12" target="<?php echo esc_attr( $divertimento_cta_target ); ?>">
                            <span><?php echo esc_html( $divertimento_cta['title'] ? $divertimento_cta['title'] : 'Scopri' ); ?></span>
                            <svg width="32" height="21" viewBox="0 0 32 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M30.9399 9.70028L22.6199 0.340279C22.1852 -0.102532 21.5534 -0.0984702 21.1492 0.267157C20.7451 0.632785 20.7105 1.33357 21.0761 1.73777L27.8522 9.35889H1.04C0.46514 9.35889 0 9.82405 0 10.3989C0 10.9737 0.465156 11.4389 1.04 11.4389H27.8522L21.0761 19.06C20.7105 19.4642 20.7572 20.1528 21.1492 20.5306C21.5575 20.9247 22.2542 20.8617 22.6199 20.4575L30.9399 11.0975C31.3075 10.5836 31.2628 10.1492 30.9399 9.70028Z" fill="#2B463A"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
    </section>
    <?php endif; ?>
    

    <?php
    $fascia_brand = get_field( 'fascia_brand' );
    $brand_titolo = isset( $fascia_brand['titolo'] ) ? $fascia_brand['titolo'] : '';
    $brand_logos = isset( $fascia_brand['brand_logos'] ) ? $fascia_brand['brand_logos'] : [];
    $brand_cta = isset( $fascia_brand['cta'] ) ? $fascia_brand['cta'] : null;
    $brand_cta_url = isset( $brand_cta['url'] ) ? $brand_cta['url'] : '';
    $brand_cta_target = isset( $brand_cta['target'] ) && $brand_cta['target'] ? $brand_cta['target'] : '_self';
    ?>

    <?php if ( get_field( 'mostra_fascia_brand' ) ) : ?>
    <section class="bg-white py-16 lg:py-24" data-aos="fade-up">
        <div class="container">
            <?php if ( $brand_titolo ) : ?>
                <div class="t-2 text-primary-500 text-center font-black font-serif"><?php echo esc_html( $brand_titolo ); ?></div>
            <?php endif; ?>
            <?php if ( ! empty( $brand_logos ) ) : ?>
                <div class="brand-carousel overflow-hidden my-8 lg:my-16">
                    <div class="swiper-wrapper items-center">
                        <?php foreach ( $brand_logos as $brand_logo ) : ?>
                            <?php $logo = isset( $brand_logo['logo'] ) ? $brand_logo['logo'] : null; ?>
                            <div class="swiper-slide">
                                <figure class="w-full lg:h-[100px] h-[70px]">
                                    <?php if ( $logo ) : ?>
                                        <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" class="w-full h-full object-contain" loading="lazy">
                                    <?php endif; ?>
                                </figure>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ( $brand_cta_url ) : ?>
                <div class="flex justify-center">
                    <a href="<?php echo esc_url( $brand_cta_url ); ?>" class="btn btn-white border border-primary-500 self-center lg:self-start" target="<?php echo esc_attr( $brand_cta_target ); ?>">
                        <span><?php echo esc_html( $brand_cta['title'] ? $brand_cta['title'] : 'Tutti i negozi' ); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php
    $social_wall = get_field( 'social_wall' );
    if ( ! is_array( $social_wall ) ) {
        $social_wall = [];
    }
    $social_titolo = isset( $social_wall['titolo'] ) ? $social_wall['titolo'] : '';
    $social_handle = isset( $social_wall['handle_link'] ) ? $social_wall['handle_link'] : null;
    $social_shortcode = isset( $social_wall['shortcode'] ) ? trim( (string) $social_wall['shortcode'] ) : '';
    $social_facebook = isset( $social_wall['facebook_url'] ) ? $social_wall['facebook_url'] : '';
    $social_instagram = isset( $social_wall['instagram_url'] ) ? $social_wall['instagram_url'] : '';
    $has_social_content = $social_titolo || $social_shortcode || $social_facebook || $social_instagram;
    ?>

    <?php if ( get_field( 'mostra_social_wall' ) ) : ?>
    <section class="py-16 bg-secondary-500 social-wall">
        <div class="container" data-aos="fade-up">
            <div class="flex gap-8 flex-col lg:flex-row justify-between items-center mb-8">
                <div class="text-center lg:text-left">
                    <?php if ( $social_titolo ) : ?>
                        <div class="t-2 text-primary-500 font-black font-serif"><?php echo esc_html( $social_titolo ); ?></div>
                    <?php endif; ?>
                    <?php if ( $social_handle && ! empty( $social_handle['url'] ) ) : ?>
                        <a href="<?php echo esc_url( $social_handle['url'] ); ?>" class="text-primary-400 t-5 block" target="<?php echo esc_attr( ! empty( $social_handle['target'] ) ? $social_handle['target'] : '_self' ); ?>">
                            <?php echo esc_html( ! empty( $social_handle['title'] ) ? $social_handle['title'] : '' ); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="social-icons flex gap-4 justify-center lg:justify-start">
                    <a href="<?php echo $social_facebook ? esc_url( $social_facebook ) : '#'; ?>" class="social-icon w-[40px] h-[40px] rounded-full bg-white p-3 flex items-center justify-center hover:bg-primary-500 transition-colors duration-200 text-primary-500 hover:text-white" <?php echo $social_facebook ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                        <?php get_template_part( 'images/icons/socials/facebook' ); ?>
                    </a>
                    <a href="<?php echo $social_instagram ? esc_url( $social_instagram ) : '#'; ?>" class="social-icon w-[40px] h-[40px] rounded-full bg-white p-2 flex items-center justify-center hover:bg-primary-500 transition-colors duration-200 text-primary-500 hover:text-white" <?php echo $social_instagram ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                        <?php get_template_part( 'images/icons/socials/instagram' ); ?>
                    </a>
                </div>
            </div>
            <?php if ( $social_shortcode ) : ?>
                <div class="social-wall-grid">
                    <?php echo do_shortcode( $social_shortcode ); ?>
                </div>
            <?php endif; ?>
        </div>
        
    </section>
    <img src="<?php echo get_template_directory_uri(); ?>/images/bg-circle-big-yellow.svg" alt="Circle" class="social-wall-bg w-full">
    <?php endif; ?>

    <?php
    $fascia_servizi = get_field( 'fascia_servizi' );
    $servizi_titolo = isset( $fascia_servizi['titolo'] ) ? $fascia_servizi['titolo'] : '';
    $servizi_descrizione = isset( $fascia_servizi['descrizione'] ) ? $fascia_servizi['descrizione'] : '';
    $servizi_cta = isset( $fascia_servizi['cta'] ) ? $fascia_servizi['cta'] : null;
    $servizi_cta_url = isset( $servizi_cta['url'] ) ? $servizi_cta['url'] : '';
    $servizi_cta_target = isset( $servizi_cta['target'] ) && $servizi_cta['target'] ? $servizi_cta['target'] : '_self';
    $servizi_items = isset( $fascia_servizi['servizi_items'] ) ? $fascia_servizi['servizi_items'] : [];
    ?>

    <?php if ( get_field( 'mostra_fascia_servizi' ) ) : ?>
    <section class="py-16" data-aos="fade-up">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-36 lg:px-28">
                <div class="flex flex-col gap-6 justify-center">
                    <?php if ( $servizi_titolo ) : ?>
                        <div class="t-2 font-serif text-primary-500 text-balance font-black"><?php echo esc_html( $servizi_titolo ); ?></div>
                    <?php endif; ?>
                    <?php if ( $servizi_descrizione ) : ?>
                        <div class="desc-2 mb-8 text-primary-500">
                            <?php echo wp_kses_post( $servizi_descrizione ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $servizi_cta_url ) : ?>
                        <a href="<?php echo esc_url( $servizi_cta_url ); ?>" class="btn btn-white border-white self-center lg:self-start hidden lg:flex" target="<?php echo esc_attr( $servizi_cta_target ); ?>">
                            <span><?php echo esc_html( $servizi_cta['title'] ? $servizi_cta['title'] : 'Vedi tutti' ); ?></span>
                            <svg width="32" height="21" viewBox="0 0 32 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M30.9399 9.70028L22.6199 0.340279C22.1852 -0.102532 21.5534 -0.0984702 21.1492 0.267157C20.7451 0.632785 20.7105 1.33357 21.0761 1.73777L27.8522 9.35889H1.04C0.46514 9.35889 0 9.82405 0 10.3989C0 10.9737 0.465156 11.4389 1.04 11.4389H27.8522L21.0761 19.06C20.7105 19.4642 20.7572 20.1528 21.1492 20.5306C21.5575 20.9247 22.2542 20.8617 22.6199 20.4575L30.9399 11.0975C31.3075 10.5836 31.2628 10.1492 30.9399 9.70028Z" fill="#2B463A"/>
                            </svg>
                        </a>
                    <?php endif; ?>

                </div>
                <div class="flex flex-col justify-center gap-6">
                    <?php foreach ( $servizi_items as $servizio ) : ?>
                        <?php
                        $servizio_image = isset( $servizio['immagine'] ) ? $servizio['immagine'] : null;
                        $servizio_titolo = isset( $servizio['titolo'] ) ? $servizio['titolo'] : '';
                        $servizio_descrizione = isset( $servizio['descrizione'] ) ? $servizio['descrizione'] : '';
                        ?>
                        <div class="grid grid-cols-3 gap-4 px-4 lg:px-8 py-4 rounded-2xl shadow-lg overflow-hidden bg-white items-center">
                            <figure class="w-full h-full col-span-1 pe-4 lg:pe-8">
                                <?php if ( $servizio_image ) : ?>
                                    <img src="<?php echo esc_url( $servizio_image['url'] ); ?>" alt="<?php echo esc_attr( $servizio_image['alt'] ); ?>" class="w-full h-full object-contain" loading="lazy">
                                <?php endif; ?>
                            </figure>
                            <div class="col-span-2">
                                <?php if ( $servizio_titolo ) : ?>
                                    <div class="t-5 font-medium mb-2 text-primary-500"><?php echo esc_html( $servizio_titolo ); ?></div>
                                <?php endif; ?>
                                <?php if ( $servizio_descrizione ) : ?>
                                    <div class="desc-3 text-primary-500 leading-tight"><?php echo wp_kses_post( $servizio_descrizione ); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if ( $servizi_cta_url ) : ?>
                        <a href="<?php echo esc_url( $servizi_cta_url ); ?>" class="btn btn-white self-center lg:self-start flex lg:hidden" target="<?php echo esc_attr( $servizi_cta_target ); ?>">
                            <span><?php echo esc_html( $servizi_cta['title'] ? $servizi_cta['title'] : 'Vedi tutti' ); ?></span>
                            <svg width="32" height="21" viewBox="0 0 32 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M30.9399 9.70028L22.6199 0.340279C22.1852 -0.102532 21.5534 -0.0984702 21.1492 0.267157C20.7451 0.632785 20.7105 1.33357 21.0761 1.73777L27.8522 9.35889H1.04C0.46514 9.35889 0 9.82405 0 10.3989C0 10.9737 0.465156 11.4389 1.04 11.4389H27.8522L21.0761 19.06C20.7105 19.4642 20.7572 20.1528 21.1492 20.5306C21.5575 20.9247 22.2542 20.8617 22.6199 20.4575L30.9399 11.0975C31.3075 10.5836 31.2628 10.1492 30.9399 9.70028Z" fill="#2B463A"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    

    <?php
    $news_eventi = get_field( 'news_eventi' );
    $news_title = isset( $news_eventi['titolo'] ) ? $news_eventi['titolo'] : 'News & Eventi';
    $numero_eventi = isset( $news_eventi['numero_eventi'] ) ? (int) $news_eventi['numero_eventi'] : 6;
    $numero_eventi = $numero_eventi > 0 ? $numero_eventi : 6;
    $news_cta = isset( $news_eventi['cta'] ) ? $news_eventi['cta'] : null;
    $news_cta_url = ( $news_cta && isset( $news_cta['url'] ) && $news_cta['url'] ) ? $news_cta['url'] : get_post_type_archive_link( 'eventi' );
    $news_cta_target = ( $news_cta && isset( $news_cta['target'] ) && $news_cta['target'] ) ? $news_cta['target'] : '_self';
    ?>

    <?php if ( get_field( 'mostra_news_eventi' ) ) : ?>
    <section class="py-16 bg-primary-500 section-news-eventi" data-aos="fade-up">
        <div class="container">
            <div class="t-2 text-secondary-500 text-center font-black font-serif mb-8 lg:mb-12"><?php echo esc_html( $news_title ); ?></div>
            <?php
            $today = date( 'Ymd' );
            
            // Prima cerca eventi futuri (attivi)
            $eventi_futuri = new WP_Query( [
                'post_type'      => 'eventi',
                'posts_per_page' => $numero_eventi,
                'meta_query'     => [
                    'relation' => 'OR',
                    [
                        'key'     => 'data_fine',
                        'value'   => $today,
                        'compare' => '>=',
                    ],
                    [
                        'relation' => 'AND',
                        [
                            'key'     => 'data_fine',
                            'compare' => 'NOT EXISTS',
                        ],
                        [
                            'key'     => 'data_inizio',
                            'value'   => $today,
                            'compare' => '>=',
                        ],
                    ],
                ],
                'meta_key'       => 'data_inizio',
                'orderby'        => 'meta_value',
                'order'          => 'ASC',
            ] );
            
            $eventi_passati = null;
            $limite_passati = min( 3, $numero_eventi );
            
            // Se non ci sono eventi futuri, mostra solo 3 eventi passati
            if ( ! $eventi_futuri->have_posts() ) {
                $eventi_passati = new WP_Query( [
                    'post_type'      => 'eventi',
                    'posts_per_page' => $limite_passati,
                    'meta_query'     => [
                        'relation' => 'OR',
                        [
                            'key'     => 'data_fine',
                            'value'   => $today,
                            'compare' => '<',
                        ],
                        [
                            'relation' => 'AND',
                            [
                                'key'     => 'data_fine',
                                'compare' => 'NOT EXISTS',
                            ],
                            [
                                'key'     => 'data_inizio',
                                'value'   => $today,
                                'compare' => '<',
                            ],
                        ],
                    ],
                    'meta_key'       => 'data_inizio',
                    'orderby'        => 'meta_value',
                    'order'          => 'DESC',
                ] );
            } elseif ( $eventi_futuri->found_posts < $numero_eventi ) {
                // Se ci sono eventi futuri ma meno del totale, aggiungi eventi passati
                $eventi_da_aggiungere = $numero_eventi - $eventi_futuri->found_posts;
                $eventi_passati = new WP_Query( [
                    'post_type'      => 'eventi',
                    'posts_per_page' => $eventi_da_aggiungere,
                    'meta_query'     => [
                        'relation' => 'OR',
                        [
                            'key'     => 'data_fine',
                            'value'   => $today,
                            'compare' => '<',
                        ],
                        [
                            'relation' => 'AND',
                            [
                                'key'     => 'data_fine',
                                'compare' => 'NOT EXISTS',
                            ],
                            [
                                'key'     => 'data_inizio',
                                'value'   => $today,
                                'compare' => '<',
                            ],
                        ],
                    ],
                    'meta_key'       => 'data_inizio',
                    'orderby'        => 'meta_value',
                    'order'          => 'DESC',
                ] );
            }
            
            // Conta il numero totale di eventi
            $totale_eventi = 0;
            if ( $eventi_futuri->have_posts() ) {
                $totale_eventi += $eventi_futuri->found_posts;
            }
            if ( isset( $eventi_passati ) && $eventi_passati->have_posts() ) {
                $totale_eventi += $eventi_passati->found_posts;
            }
            
            // Nascondi paginazione se ci sono 3 o meno eventi
            $pagination_class = ( $totale_eventi <= $limite_passati ) ? 'hidden' : '';
            ?>
            <div class="news-carousel overflow-hidden">
                <div class="swiper-wrapper">
                    <?php if ( $eventi_futuri->have_posts() ) : ?>
                        <?php while ( $eventi_futuri->have_posts() ) : $eventi_futuri->the_post(); ?>
                            <div class="swiper-slide">
                                <?php
                                $data_inizio = get_field( 'data_inizio' );
                                $data_fine = get_field( 'data_fine' );
                                
                                // Formatta la data per il teaser-event
                                $data_formattata = '';
                                if ( $data_inizio ) {
                                    if ( $data_fine ) {
                                        $data_formattata = 'Dal ' . $data_inizio . ' al ' . $data_fine;
                                    } else {
                                        $data_formattata = 'Dal ' . $data_inizio;
                                    }
                                }
                                
                                get_template_part( 'template-parts/teaser-event', null, [
                                    'id'          => get_the_ID(),
                                    'immagine'    => get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ),
                                    'titolo'      => get_the_title(),
                                    'link'        => get_permalink(),
                                    'data'        => $data_formattata,
                                    'type'        => ''
                                ] );
                                ?>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                    
                    <?php if ( isset( $eventi_passati ) && $eventi_passati->have_posts() ) : ?>
                        <?php while ( $eventi_passati->have_posts() ) : $eventi_passati->the_post(); ?>
                            <div class="swiper-slide">
                                <?php
                                $data_inizio = get_field( 'data_inizio' );
                                $data_fine = get_field( 'data_fine' );
                                
                                // Formatta la data per il teaser-event
                                $data_formattata = '';
                                if ( $data_inizio ) {
                                    if ( $data_fine ) {
                                        $data_formattata = 'Dal ' . $data_inizio . ' al ' . $data_fine;
                                    } else {
                                        $data_formattata = 'Dal ' . $data_inizio;
                                    }
                                }
                                
                                get_template_part( 'template-parts/teaser-event', null, [
                                    'id'          => get_the_ID(),
                                    'immagine'    => get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ),
                                    'titolo'      => get_the_title(),
                                    'link'        => get_permalink(),
                                    'data'        => $data_formattata,
                                    'type'        => ''
                                ] );
                                ?>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
                <div class="swiper-pagination flex justify-center gap-2 mt-8 <?php echo esc_attr( $pagination_class ); ?>"></div>
            </div>
            <div class="flex justify-center mt-8">
                <a href="<?php echo esc_url( $news_cta_url ); ?>" class="btn btn-secondary-outlined px-6 py-3 flex items-center gap-2" target="<?php echo esc_attr( $news_cta_target ); ?>">
                    <span><?php echo esc_html( $news_cta && $news_cta['title'] ? $news_cta['title'] : 'Tutti gli eventi' ); ?></span>
                </a>
            </div>
        </div>
        
    </section>
    <img src="<?php echo get_template_directory_uri(); ?>/images/bg-circle-big-green.svg" alt="Circle" class="section-news-eventi-bg w-full">
    <?php endif; ?>


    <?php 
    $mostra_newsletter = get_field( 'mostra_newsletter' );
    $newsletter = get_field( 'newsletter' );
    $newsletter_pre_titolo = isset( $newsletter['pre_titolo'] ) ? $newsletter['pre_titolo'] : '';
    $newsletter_titolo = isset( $newsletter['titolo'] ) ? $newsletter['titolo'] : '';
    $newsletter_cta = isset( $newsletter['cta'] ) ? $newsletter['cta'] : null;
    $newsletter_cta_url = ( $newsletter_cta && isset( $newsletter_cta['url'] ) && $newsletter_cta['url'] ) ? $newsletter_cta['url'] : get_post_type_archive_link( 'newsletter' );
    $newsletter_cta_target = ( $newsletter_cta && isset( $newsletter_cta['target'] ) && $newsletter_cta['target'] ) ? $newsletter_cta['target'] : '_self';
    ?>
    <?php if ( $mostra_newsletter ) : ?>
    <section class="py-16 lg:py-24 newsletter bg-white">
        <div class="container flex flex-col gap-4 lg:gap-8 justify-center items-center">
            <?php if ( $newsletter_pre_titolo ) : ?>
                <div class="t-5 text-primary-500 text-center font-medium font-serif"><?php echo esc_html( $newsletter_pre_titolo ); ?></div>
            <?php endif; ?>
            <?php if ( $newsletter_titolo ) : ?>
                <div class="t-2 text-primary-500 text-center font-black font-serif"><?php echo esc_html( $newsletter_titolo ); ?></div>
            <?php endif; ?>
            <?php if ( $newsletter_cta_url ) : ?>
                <a href="<?php echo esc_url( $newsletter_cta_url ); ?>" class="btn btn-secondary hover:bg-primary-500 hover:text-secondary-500 hover:border-primary-500 px-6 py-3 flex items-center gap-2" target="<?php echo esc_attr( $newsletter_cta_target ); ?>">
                    <span><?php echo esc_html( $newsletter_cta && $newsletter_cta['title'] ? $newsletter_cta['title'] : 'Iscriviti alla newsletter' ); ?></span>
                </a>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php 
    $mostra_social = get_field( 'mostra_social' );
    $social_box = get_field( 'social_box' );
    ?>

    <section class="social-section bg-secondary-500 pt-16 lg:py-0 position-relative">
        <?php
        $instagram_link = isset( $social_box['instagram'] ) ? $social_box['instagram'] : null;
        $titolo_sezione = isset( $social_box['titolo_sezione'] ) ? $social_box['titolo_sezione'] : '';
        $facebook_url = isset( $social_box['facebook_url'] ) ? $social_box['facebook_url'] : '';
        $instagram_url = isset( $social_box['instagram_url'] ) ? $social_box['instagram_url'] : '';
        $foto_social = isset( $social_box['foto_social'] ) ? $social_box['foto_social'] : null;
        ?>
        <div class="container flex lg:flex-row flex-col gap-8">
            <div class="flex flex-col gap-8 items-start lg:w-2/3 lg:py-24">
                <?php if ( $instagram_link && ! empty( $instagram_link['url'] ) ) : ?>
                    <a href="<?php echo esc_url( $instagram_link['url'] ); ?>" target="<?php echo esc_attr( $instagram_link['target'] ?? '_self' ); ?>" class="btn btn-primary-outlined font-serif t-5 hover:bg-primary-500 hover:text-secondary-500 hover:border-primary-500"><?php echo esc_html( $instagram_link['title'] ?: $instagram_link['url'] ); ?></a>
                <?php endif; ?>
                <?php if ( $titolo_sezione ) : ?>
                    <div class="t-2 text-primary-500 font-medium font-serif"><?php echo $titolo_sezione; ?></div>
                <?php endif; ?>
                <div class="flex gap-6 social-section__icons">
                    <?php if ( $facebook_url ) : ?>
                        <a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="noopener noreferrer" class="bg-white p-2 rounded-full aspect-square w-14 h-14 flex items-center justify-center text-primary-500 [&_svg]:fill-primary-500 hover:bg-primary-500 hover:text-secondary-500 hover:[&_svg]:fill-secondary-500 transition-colors"><?php get_template_part( 'images/icons/socials/facebook' ); ?></a>
                    <?php endif; ?>
                    <?php if ( $instagram_url ) : ?>
                        <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer" class="bg-white p-2 rounded-full aspect-square w-14 h-14 flex items-center justify-center text-primary-500 [&_svg]:fill-primary-500 hover:bg-primary-500 hover:text-secondary-500 hover:[&_svg]:fill-secondary-500 transition-colors"><?php get_template_part( 'images/icons/socials/instagram' ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ( $foto_social ) : ?>
            <div class="lg:w-1/3 relative">
                <figure class="lg:absolute lg:bottom-0 lg:right-0">
                    <img src="<?php echo esc_url( $foto_social['url'] ); ?>" alt="<?php echo esc_attr( $foto_social['alt'] ); ?>" class="w-full h-full object-cover">
                </figure>
            </div>
            <?php endif; ?>
        </div>
    </section>




<?php endwhile; ?>


<?php
get_footer();
