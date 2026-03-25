<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
</main>
<?php
$socialwall = get_field( 'socialwall', 'option' );
$newsletter = get_field( 'newsletter', 'option' );
$footer = get_field( 'footer', 'option' );
$nascondi_sezione_newsletter = $newsletter && isset( $newsletter['nascondi_sezione_newsletter'] ) ? (bool) $newsletter['nascondi_sezione_newsletter'] : false;
$mostra_newsletter = $newsletter && ( isset( $newsletter['titolo'] ) || isset( $newsletter['pulsante'] ) );
$mostra_newsletter = $mostra_newsletter && ! $nascondi_sezione_newsletter;
$mostra_social = $socialwall && ( isset( $socialwall['titolo'] ) || isset( $socialwall['link_instagram'] ) || isset( $socialwall['foto_social'] ) );
if ( $mostra_newsletter || $mostra_social ) :
?>
    <?php if ( $mostra_newsletter ) : ?>
    <section class="site-prefooter site-prefooter--newsletter py-16 lg:py-24 newsletter bg-white position-relative" >
        <div class="container flex flex-col gap-4 lg:gap-8 justify-center items-center">
            <?php if ( ! empty( $newsletter['titolo'] ) ) : ?>
                <h3 class="t-2 text-primary-500 text-center font-black font-serif"><?php echo esc_html( $newsletter['titolo'] ); ?></h3>
            <?php endif; ?>
            <?php if ( ! empty( $newsletter['descrizione'] ) ) : ?>
                <p class="t-5 text-primary-500 text-center text-balance"><?php echo esc_html( $newsletter['descrizione'] ); ?></p>
            <?php endif; ?>
            <?php if ( ! empty( $newsletter['pulsante']['url'] ) ) : ?>
                <a href="<?php echo esc_url( $newsletter['pulsante']['url'] ); ?>" class="btn btn-secondary hover:bg-primary-500 hover:text-secondary-500 hover:border-primary-500 px-6 py-3 flex items-center gap-2" target="<?php echo esc_attr( $newsletter['pulsante']['target'] ?? '_self' ); ?>">
                    <span><?php echo esc_html( $newsletter['pulsante']['title'] ?: 'Iscriviti alla newsletter' ); ?></span>
                </a>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if ( $mostra_social ) : ?>
    <section class="site-prefooter site-prefooter--social social-section bg-secondary-500 pt-16 md:py-0 position-relative <?php echo $mostra_newsletter ? 'mt-16 lg:mt-25' : ''; ?>">
        <?php
        $instagram_link = isset( $socialwall['link_instagram'] ) && ! empty( $socialwall['link_instagram']['url'] ) ? $socialwall['link_instagram'] : null;
        $titolo_sezione = isset( $socialwall['titolo'] ) ? $socialwall['titolo'] : '';
        $facebook_url = get_global_option( 'facebook' );
        $instagram_url = get_global_option( 'instagram' );
        $foto_social = isset( $socialwall['foto_social'] ) ? $socialwall['foto_social'] : null;
        ?>
        <div class="container flex md:flex-row flex-col gap-8">
            <div class="flex flex-col gap-8 items-start md:w-2/3 md:py-24">
                <?php if ( $instagram_link ) : ?>
                    <a href="<?php echo esc_url( $instagram_link['url'] ); ?>" target="<?php echo esc_attr( $instagram_link['target'] ?? '_self' ); ?>" class="btn btn-primary-outlined font-serif t-5 hover:bg-primary-500 hover:text-secondary-500 hover:border-primary-500"><?php echo esc_html( $instagram_link['title'] ?: $instagram_link['url'] ); ?></a>
                <?php endif; ?>
                <?php if ( $titolo_sezione ) : ?>
                    <h3 class="t-2 text-primary-500 font-medium font-serif"><?php echo esc_html( $titolo_sezione ); ?></h3>
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
            <?php if ( $foto_social && ! empty( $foto_social['url'] ) ) : ?>
            <div class="md:w-1/3 relative md:flex md:flex-col md:items-end">
                <figure class="md:absolute md:bottom-0 md:right-0">
                    <img src="<?php echo esc_url( $foto_social['url'] ); ?>" alt="<?php echo esc_attr( $foto_social['alt'] ?? '' ); ?>" loading="lazy" class="w-full h-full object-cover">
                </figure>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>
<?php endif; ?>

    <footer class="site-footer bg-primary-500 text-white py-20" id="colophon">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="col-span-1 order-2 lg:order-1">
                    <div class="site-footer__logo flex justify-center lg:justify-start max-w-[250px] mx-auto lg:mx-0"><?php the_custom_logo(); ?></div>
                    <?php if ($footer &&$footer['credits']): ?>
                        <div class="desc-2 mt-4 lg:mt-8 text-center lg:text-left">
                            <?php echo wp_kses_post($footer['credits']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="desc-2 mt-4 font-bold text-center lg:text-left">
                        <?php if(get_global_option('telefono')): ?>
                            <a href="tel:<?php echo get_global_option('telefono'); ?>">Tel: <?php echo get_global_option('telefono'); ?></a>
                        <?php endif; ?>
                        <span class="text-secondary-500 mx-1">|</span>
                        <?php if(get_global_option('email')): ?>
                            <a href="mailto:<?php echo get_global_option('email'); ?>"><?php echo get_global_option('email'); ?></a>
                        <?php endif; ?>
                    </div>
                    <?php if (get_global_option('privacy_policy') || get_global_option('cookie_policy')): ?>
                        <div class="desc-3 mt-5 flex gap-2 justify-center lg:justify-start">
                            <?php if(get_global_option('privacy_policy')): ?>
                                <a href="<?php echo get_global_option('privacy_policy'); ?>">Policy</a>
                            <?php endif; ?>
                            <span class="text-secondary-500 mx-1">|</span>
                            <?php if(get_global_option('cookie_policy')): ?>
                                <a href="<?php echo get_global_option('cookie_policy'); ?>">Cookie Policy</a>
                            <?php endif; ?>
                            <span class="text-secondary-500 mx-1">|</span>
                            <a href='#' class='iubenda-cs-preferences-link'>Preferenze Privacy</a>
                        </div>
                    <?php endif; ?>
                    <?php if ($footer && $footer['logo_credits']): ?>
                        <a class="site-footer__copyright flex justify-center lg:justify-start mt-4" href="<?php echo esc_url($footer['logo_credits_link'] ? $footer['logo_credits_link'] : '#'); ?>" <?php echo $footer['logo_credits_link'] ? 'target="_blank"' : ''; ?>>
                            <img src="<?php echo esc_url($footer['logo_credits']['url']); ?>" alt="<?php echo esc_attr($footer['logo_credits']['alt'] ? $footer['logo_credits']['alt'] : 'Credits'); ?>" width="160" height="70">
                        </a>
                    <?php endif; ?>

                </div>
                <div class="col-span-1 order-1 lg:order-2">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="col-span-1">
                            <div class="site-footer__menu">
                                <?php 
                                $menu_location = 'footer-menu-1';
                                $locations = get_nav_menu_locations();

                                if (isset($locations[$menu_location])) {
                                    $menu_id = $locations[$menu_location];
                                    $menu_object = wp_get_nav_menu_object($menu_id);
                                    $menu_name = $menu_object->name;
                                    echo '<h4 class="site-footer__menu-title">' . esc_html($menu_name) . '</h4>';
                                } 
                                ?>
                                <?php 
                                wp_nav_menu( array(
                                    'theme_location'  => 'footer-menu-1',
                                    'menu_class' => 'footer-menu-2 site-footer__menu-items',
                                    'container' => false,
                                    'depth' => 1
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <div class="site-footer__menu">
                                <?php 
                                $menu_location = 'footer-menu-2';
                                $locations = get_nav_menu_locations();

                                if (isset($locations[$menu_location])) {
                                    $menu_id = $locations[$menu_location];
                                    $menu_object = wp_get_nav_menu_object($menu_id);
                                    $menu_name = $menu_object->name;
                                    echo '<h4 class="site-footer__menu-title">' . esc_html($menu_name) . '</h4>';
                                } 
                                ?>
                                <?php 
                                wp_nav_menu( array(
                                    'theme_location'  => 'footer-menu-2',
                                    'menu_class' => 'footer-menu-2 site-footer__menu-items',
                                    'container' => false,
                                    'depth' => 1
                                ));
                                ?>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <div class="site-footer__menu">
                                <?php 
                                $menu_location = 'footer-menu-3';
                                $locations = get_nav_menu_locations();

                                if (isset($locations[$menu_location])) {
                                    $menu_id = $locations[$menu_location];
                                    $menu_object = wp_get_nav_menu_object($menu_id);
                                    $menu_name = $menu_object->name;
                                    echo '<h4 class="site-footer__menu-title">' . esc_html($menu_name) . '</h4>';
                                } 
                                ?>
                                <?php 
                                wp_nav_menu( array(
                                    'theme_location'  => 'footer-menu-3',
                                    'menu_class' => 'footer-menu-2 site-footer__menu-items',
                                    'container' => false,
                                    'depth' => 1
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </footer><!-- /.site-footer -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

