<?php
/**
 * The template for displaying 404 pages (not found)
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>


<div class="page-header py-32">
	<div class="container flex flex-col gap-4 justify-center items-center">
		<h1 class="t-1 font-bold text-primary-500 page-header__title font-serif" >404</h1>
		<div class="t-3 text-primary-500"><?php _e('Pagina non trovata','mongolfiera')?></div>
		<a href="<?php echo home_url(); ?>" class="btn btn-secondary"><?php _e('Torna alla home','mongolfiera')?></a>
	</div>
</div>

<?php
get_footer();
