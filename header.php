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
    <header id="masthead" class="site-header">
        <div class="container mx-auto px-4 h-full">
            <div class="flex items-center justify-between h-full py-2">
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
                            <a href="<?php echo $newsletter; ?>" class="btn btn-primary xl:px-8">Newsletter</a>
                        <?php endif; ?>
                    </div>
                    <div class="site-header__menu-trigger xl:hidden"><?php get_template_part('images/icons/menu') ?></div>
                </div>
            </div>
        </div><!--/.container-->
    </header>

    <main id="content" class="site-main">