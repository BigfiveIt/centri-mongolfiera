<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Bricolage+Grotesque:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<div class="site" id="page">
<?php
$orari_negozi = get_global_option( 'orari_negozi' );
$instagram_url = get_global_option( 'instagram' );
$facebook_url  = get_global_option( 'facebook' );
$mostra_topbar = $orari_negozi || $instagram_url || $facebook_url;
if ( $mostra_topbar ) :
?>
    <div class="site-topbar bg-secondary-500 text-primary-500">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center justify-between gap-2 py-2">
                <div class="flex items-center gap-2 shrink-0 desc-2">
                    <?php if ( $orari_negozi ) : ?>
                        <span class="site-topbar__icon [&_svg]:w-5 [&_svg]:h-5 shrink-0 [&_svg]:fill-primary-500 [&_svg]:stroke-primary-500"><?php get_template_part( 'images/icons/clock' ); ?></span>
                        <span class="font-bold uppercase tracking-wide"><?php esc_html_e( 'Orari', 'mongolfiera' ); ?></span>
                        <span class="site-topbar__orari"><?php echo esc_html( wp_strip_all_tags( $orari_negozi ) ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="flex items-center gap-3">
                    <?php if ( $facebook_url ) : ?>
                        <a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="noopener noreferrer" class="text-primary-500 hover:text-primary-400 transition-colors [&_svg]:w-5 [&_svg]:h-5 [&_svg]:fill-current" aria-label="<?php esc_attr_e( 'Facebook', 'mongolfiera' ); ?>"><?php get_template_part( 'images/icons/socials/facebook' ); ?></a>
                    <?php endif; ?>
                    <?php if ( $instagram_url ) : ?>
                        <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer" class="text-primary-500 hover:text-primary-400 transition-colors [&_svg]:w-5 [&_svg]:h-5 [&_svg]:fill-current" aria-label="<?php esc_attr_e( 'Instagram', 'mongolfiera' ); ?>"><?php get_template_part( 'images/icons/socials/instagram' ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
    <header id="masthead" class="site-header">
        <div class="container mx-auto px-4 h-full">
            <div class="flex items-center justify-between h-full py-4">
                <div class="site-header__logo h-full">
                    <?php the_custom_logo(); ?>
                </div>
                <div class="flex gap-4 md:gap-5 items-center h-full">
                    <div class="site-header__menu">
                        <?php wp_nav_menu( array(
                            'theme_location'  => 'primary-menu',
                            'menu_class' => '',
                            'container' => false
                        ) );?>
                        <?php 
                        $newsletter = get_global_option('newsletter');
                        if ($newsletter) : ?>
                            <div class="site-header__newsletter px-4 lg:px-0">
                                <a href="<?php echo $newsletter; ?>" class="btn btn-primary xl:px-8 w-full lg:w-auto">Newsletter</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="site-header__menu-trigger xl:hidden"><?php get_template_part('images/icons/menu') ?></div>
                </div>
            </div>
        </div><!--/.container-->
    </header>

    <main id="content" class="site-main">