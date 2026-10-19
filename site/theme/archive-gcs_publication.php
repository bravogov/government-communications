<?php
/** Searchable, topic-filtered professional publications archive. */
get_header();
$term = isset($_GET['topic']) ? sanitize_title(wp_unslash($_GET['topic'])) : '';
$kind = isset($_GET['resource_type']) ? sanitize_title(wp_unslash($_GET['resource_type'])) : '';
$words = isset($_GET['query']) ? sanitize_text_field(wp_unslash($_GET['query'])) : '';
$paged = max(1, get_query_var('paged', 1));
$tax = ['relation' => 'AND'];
if ($term && term_exists($term, 'gcs_topic')) {
    $tax[] = ['taxonomy' => 'gcs_topic', 'field' => 'slug', 'terms' => $term];
}
if ($kind && term_exists($kind, 'gcs_resource_type')) {
    $tax[] = ['taxonomy' => 'gcs_resource_type', 'field' => 'slug', 'terms' => $kind];
}
$args = ['post_type' => 'gcs_publication', 'post_status' => 'publish', 'posts_per_page' => 10, 'paged' => $paged, 's' => $words];
if (count($tax) > 1) $args['tax_query'] = $tax;
$listing = new WP_Query($args);
$topics = get_terms(['taxonomy' => 'gcs_topic', 'hide_empty' => true]);
$types = get_terms(['taxonomy' => 'gcs_resource_type', 'hide_empty' => true]);
?>
<main id="main"><div class="wrap">
<div class="crumbs"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a> › <a href="<?php echo esc_url(home_url('/resources/')); ?>">Resources</a> › Publications</div>
<h1>Publications</h1>
<p class="lead">Find professional guidance and resources to help you plan, deliver and evaluate government communications.</p>
<form class="filters" role="search" action="<?php echo esc_url(get_post_type_archive_link('gcs_publication')); ?>" method="get">
<div class="filter-grid"><div><label for="publication-query">Search publications</label><input type="search" id="publication-query" name="query" value="<?php echo esc_attr($words); ?>" placeholder="Search publications"></div>
<div><label for="publication-topic">Select by topic</label><select id="publication-topic" name="topic"><option value="">All topics</option>
<?php if (!is_wp_error($topics)): foreach ($topics as $item): ?>
<option value="<?php echo esc_attr($item->slug); ?>" <?php selected($term, $item->slug); ?>><?php echo esc_html($item->name); ?></option>
<?php endforeach; endif; ?></select></div>
<div><label for="publication-type">Select by resource type</label><select id="publication-type" name="resource_type"><option value="">All types</option>
<?php if (!is_wp_error($types)): foreach ($types as $item): ?>
<option value="<?php echo esc_attr($item->slug); ?>" <?php selected($kind, $item->slug); ?>><?php echo esc_html($item->name); ?></option>
<?php endforeach; endif; ?></select></div></div>
<button class="button" type="submit">Apply filters</button>
<a class="reset" href="<?php echo esc_url(get_post_type_archive_link('gcs_publication')); ?>">Clear all filters</a>
</form>
<p class="results-count" aria-live="polite"><?php echo esc_html(number_format_i18n($listing->found_posts)); ?> publications found</p>
<ul class="posts publications-list">
<?php if ($listing->have_posts()): while ($listing->have_posts()): $listing->the_post(); ?>
<li><p class="meta"><?php echo esc_html(implode(', ', wp_list_pluck(get_the_terms(get_the_ID(), 'gcs_resource_type') ?: [], 'name')) ?: 'Publication'); ?>
 &nbsp;<?php echo esc_html(get_the_date('j F Y')); ?></p>
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<p><?php echo esc_html(get_the_excerpt()); ?></p></li>
<?php endwhile; else: ?><li><p>No publications match your filters. Try a different search or <a href="<?php echo esc_url(get_post_type_archive_link('gcs_publication')); ?>">clear the filters</a>.</p></li><?php endif; ?>
</ul>
<?php echo paginate_links(['total' => max(1, $listing->max_num_pages), 'current' => $paged, 'add_args' => array_filter(['query' => $words, 'topic' => $term, 'resource_type' => $kind]), 'prev_text' => 'Previous', 'next_text' => 'Next', 'type' => 'list']); ?>
<?php wp_reset_postdata(); ?>
</div></main>
<?php get_footer(); ?>
