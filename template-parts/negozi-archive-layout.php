<?php
/**
 * Template part per il layout comune delle pagine archivio/tassonomia negozi
 * 
 * @param array $args {
 *     @type string $title                Titolo della pagina
 *     @type string $description          Descrizione (opzionale)
 *     @type string $search_url           URL per la ricerca
 *     @type int    $current_tag_id       ID del tag corrente (0 se nessuno)
 *     @type int    $current_category_id  ID della categoria corrente (0 se nessuno)
 * }
 */

$title = isset($args['title']) ? $args['title'] : '';
$description = isset($args['description']) ? $args['description'] : '';
$search_url = isset($args['search_url']) ? $args['search_url'] : get_post_type_archive_link('negozi');
$current_tag_id = isset($args['current_tag_id']) ? $args['current_tag_id'] : 0;
$current_category_id = isset($args['current_category_id']) ? $args['current_category_id'] : 0;
$archive_url = get_post_type_archive_link('negozi');
?>

<section class="my-6 lg:my-16 z-50 relative" data-aos="fade-up">
    <div class="container">
        <?php get_template_part('template-parts/taxonomy-header', null, [
            'title' => $title,
            'description' => $description,
            'search_url' => $search_url,
        ]); ?>
        
        <?php get_template_part('template-parts/taxonomy-filters-tags', null, [
            'current_term_id' => $current_tag_id,
        ]); ?>
        
        <?php get_template_part('template-parts/taxonomy-filters-categories', null, [
            'current_term_id' => $current_category_id,
            'archive_url' => $archive_url,
            'show_all_button' => true,
        ]); ?>
    </div>
</section>

<section class="my-6 lg:my-28" data-aos="fade-up">
    <div class="container">
        <?php get_template_part('template-parts/taxonomy-negozi-grid'); ?>
    </div>
</section>

<?php $mappa_negozi = get_global_option('mappa_negozi'); ?>
<?php $virtual_tour = get_global_option('virtual_tour'); ?>
<?php if ($mappa_negozi || $virtual_tour) : ?>
<section class="my-8 lg:my-28" data-aos="fade-up">
    <div class="container">
        <div class="flex justify-center gap-4 lg:gap-8 flex-wrap">
            <?php if ($mappa_negozi) : ?>
            <a href="<?php echo esc_url($mappa_negozi); ?>" class="btn btn-primary-light w-full lg:w-[220px]">
                <?php _e('Mappa dei negozi','mongolfiera'); ?>
            </a>
            <?php endif; ?>
            <?php if ($virtual_tour) : ?>
            <a href="<?php echo esc_url($virtual_tour); ?>" class="btn btn-primary w-full lg:w-[220px]">
                <?php _e('Virtual Tour 3D','mongolfiera'); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>