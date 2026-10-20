<?php
if (!defined('ABSPATH')) { exit; }
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('post-thumbnails');
    register_nav_menus(['primary' => 'Main navigation']);
});
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('uh-gcs', get_stylesheet_uri(), [], '2.0.0');
});
add_action('init', function () {
    // The site-setup plugin is the sole content seeder; the theme owns presentation.
    if (!is_admin() && get_option('blog_public') !== '0') {
        // Do not modify indexing or authentication during normal rendering.
    }
});
function uh_gcs_navigation() {
    $links = [
        'About' => 'about',
        'Membership' => 'membership',
        'Careers' => 'careers',
        'Resources' => 'resources',
        'News' => 'news',
    ];
    echo '<nav class="nav" aria-label="Main navigation"><div class="wrap"><ul>';
    foreach ($links as $label => $slug) {
        $url = home_url('/' . $slug . '/');
        $active = is_page($slug) || (is_home() && $slug === 'news');
        echo '<li' . ($active ? ' class="current-menu-item"' : '') . '><a href="' . esc_url($url) . '"' . ($active ? ' aria-current="page"' : '') . '>' . esc_html($label) . '</a></li>';
    }
    echo '</ul></div></nav>';
}
function uh_gcs_cards(array $items) {
    echo '<div class="cards">';
    foreach ($items as $item) {
        echo '<section class="card"><h3><a href="' . esc_url(home_url('/' . $item[1] . '/')) . '">' . esc_html($item[0]) . '</a></h3><p>' . esc_html($item[2]) . '</p></section>';
    }
    echo '</div>';
}

/**
 * Retrieve images held in the service's WordPress media library. Media is
 * editorial content, and therefore belongs to the site rather than a build.
 */
function uh_gcs_media_url(string $asset): string {
    static $cache = [];
    if (isset($cache[$asset])) { return $cache[$asset]; }
    $items = get_posts([
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'meta_key' => '_uh_gcs_asset',
        'meta_value' => $asset,
        'posts_per_page' => 1,
        'fields' => 'ids',
        'suppress_filters' => true,
    ]);
    $cache[$asset] = $items ? (wp_get_attachment_url($items[0]) ?: '') : '';
    return $cache[$asset];
}
