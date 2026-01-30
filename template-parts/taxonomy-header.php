<?php
/**
 * Template part per l'header delle pagine di tassonomia
 * 
 * @param array $args {
 *     @type string $title       Titolo da mostrare
 *     @type string $description Descrizione del termine (opzionale)
 *     @type string $search_url  URL per la ricerca (opzionale, default: archivio negozi)
 * }
 */

$title = isset($args['title']) ? $args['title'] : '';
$description = isset($args['description']) ? $args['description'] : '';
$search_url = isset($args['search_url']) ? $args['search_url'] : get_post_type_archive_link('negozi');
?>

<div class="flex flex-wrap gap-4 items-center justify-between mb-8">
    <div>
        <?php if ($title): ?>
            <h1 class="t-1 font-serif text-primary-500 font-bold leading-none"><?php echo esc_html($title); ?></h1>
        <?php endif; ?>
        <?php if ($description): ?>
            <div class="taxonomy-description mt-4"><?php echo wp_kses_post($description); ?></div>
        <?php endif; ?>
    </div>
    <form action="<?php echo esc_url($search_url); ?>" method="get" class="flex items-center gap-2 border-2 border-primary-500 rounded-2xl p-2 search-form">
        <input type="hidden" name="post_type" value="negozi">
        <button type="submit"><?php get_template_part('images/icons/search'); ?></button>
        <input type="text" name="s" value="<?php echo isset($_GET['s']) ? esc_attr($_GET['s']) : ''; ?>" placeholder="<?php _e('Cerca negozio','mongolfiera');?>">
    </form>
</div>
