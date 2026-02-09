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
$socialwall = get_field('socialwall', 'option');
$newsletter = get_field('newsletter', 'option');
$footer = get_field('footer', 'option'); 
    if($socialwall && $socialwall['titolo'] && $newsletter && $newsletter['titolo']):
?>
    <section class="site-prefooter">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <?php if($socialwall && $socialwall['titolo']): ?>
                <div class="flex flex-col gap-4 lg:gap-8 text-center p-4 lg:px-12 lg:py-24 py-12 bg-linear-to-t from-[#2EA338] to-[#C6D41F]">
                    <div class="">
                        <h4 class="text-white t-3 font-medium font-serif"><?php echo $socialwall['titolo']; ?></h4>
                        <?php if($socialwall['link_instagram']): ?>
                            <a href="<?php echo $socialwall['link_instagram']['url']; ?>" class="text-white t-5 block mt-4 btn btn-link justify-center font-normal">
                                <?php echo $socialwall['link_instagram']['title']; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="social-icons justify-center flex gap-4">
                        <?php if(get_global_option('facebook')): ?>
                            <a href="#" class="social-icon w-[40px] h-[40px] rounded-full bg-white p-3 flex items-center justify-center hover:bg-primary-500 transition-colors duration-200 text-primary-500 hover:text-white">
                                <?php get_template_part('images/icons/socials/facebook'); ?>
                            </a>
                        <?php endif; ?>
                        <?php if(get_global_option('instagram')): ?>
                            <a href="#" class="social-icon w-[40px] h-[40px] rounded-full bg-white p-2 flex items-center justify-center hover:bg-primary-500 transition-colors duration-200 text-primary-500 hover:text-white">
                                <?php get_template_part('images/icons/socials/instagram'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($newsletter && $newsletter['titolo']): ?>
                <div class="flex flex-col gap-4 lg:gap-8 text-center p-4 lg:px-12 lg:py-24 py-12 bg-linear-to-b from-[#2EA338] to-[#C6D41F]">
                    <h4 class="text-white t-3 font-medium font-serif"><?php echo $newsletter['titolo']; ?></h4>
                    <p class="text-white t-5 block text-balance"><?php echo $newsletter['descrizione']; ?></p>
                    <?php if($newsletter['pulsante']): ?>
                        <div class="flex justify-center">
                            <a href="<?php echo $newsletter['pulsante']['url']; ?>" class="btn btn-transparent">
                                <span><?php echo $newsletter['pulsante']['title']; ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <footer class="site-footer bg-primary-500 text-white py-20" id="colophon">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="col-span-1 order-2 lg:order-1">
                    <div class="site-footer__logo flex justify-center lg:justify-start"><?php the_custom_logo(); ?></div>
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

