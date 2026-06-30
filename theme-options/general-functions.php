<?php
// Add a body class on the front page when the header logo is hidden
// (mirrors the "Hide logo on homepage" toggle used in header.php).
function intercoastal_logo_hidden_body_class( $classes ) {
    if (
        is_front_page()
        && function_exists('get_field')
        && get_field('hide_logo_on_homepage', (int) get_option('page_on_front'))
    ) {
        $classes[] = 'home-logo-hidden';
    }
    return $classes;
}
add_filter('body_class', 'intercoastal_logo_hidden_body_class');

// Remove WP Block ( Patterns from Appearance )
function remove_wp_block_menu() {
    remove_submenu_page( 'themes.php', 'edit.php?post_type=wp_block' );
}
add_action('admin_init', 'remove_wp_block_menu', 100);

// Disable Theme FileEditor from Appearance
// function disable_theme_file_editor() {
//     if ( ! defined('DISALLOW_FILE_EDIT') ) {
//         define('DISALLOW_FILE_EDIT', true);
//     }
// }
// add_action('init', 'disable_theme_file_editor');

//Remove Comments Option from Admin Menu 
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');
// Remove comments from the admin bar
function df_remove_comments_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'df_remove_comments_admin_bar');
// Remove comments and trackbacks support from post types
function df_remove_comment_support() {
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('init', 'df_remove_comment_support', 100);
// Redirect any user trying to access comments page
function df_redirect_comments_page() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'df_redirect_comments_page');
// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
// Hide existing comments
function df_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_hide_existing_comments', 10, 2);

//Function for rendering section headers
function strip_outer_p_tags($content) {
    // Remove outer <p> tags if they exist, but keep inner tags
    if (preg_match('#^<p>(.*)</p>$#is', trim($content), $matches)) {
        return $matches[1];
    }
    return $content;
}

function render_section_header($field_group_name) {
    $fields = get_field($field_group_name, get_the_ID());
    if (!$fields) return;

    $title = $fields['title_section'] ?? '';
    $subtitle = $fields['subtitle_section'] ?? '';

    // Get margins (number only, add px automatically)
    $margin_desktop = !empty($fields['margin_bottom_desktop']) ? $fields['margin_bottom_desktop'] . 'px' : '6px';
    $margin_mobile  = !empty($fields['margin_bottom_mobile'])  ? $fields['margin_bottom_mobile'] . 'px'  : '6px';

    if ($title || $subtitle) {
        echo '<div class="section-header" style="margin-bottom:' . esc_attr($margin_desktop) . ';">';

        if ($title) {
            echo '<div class="section-header-title">' . wp_kses_post(strip_outer_p_tags($title)) . '</div>';
        }

        if ($subtitle) {
            echo '<div class="section-header-subtitle">' . wp_kses_post(strip_outer_p_tags($subtitle)) . '</div>';
        }

        echo '</div>';

        // Output mobile-specific CSS
        if ($margin_mobile !== $margin_desktop) {
            echo '<style>
                @media (max-width: 991.98px) {
                    .section-header { margin-bottom: ' . esc_attr($margin_mobile) . ' !important; }
                }
            </style>';
        }
    }
}

//Theme Settings Menu 
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Global Settings',
        'menu_title'    => 'Global Settings',
        'menu_slug'     => 'global-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

// Enable pagination for post type archives
function enable_post_type_archive_pagination() {
    add_rewrite_rule(
        '^([^/]+)/page/([0-9]+)/?$',
        'index.php?post_type=$matches[1]&paged=$matches[2]',
        'top'
    );
}
add_action('init', 'enable_post_type_archive_pagination');

// Modify main query for post type archives to limit posts
function modify_post_type_archive_query($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive()) {
            $query->set('posts_per_page', 3);
        }
    }
}
add_action('pre_get_posts', 'modify_post_type_archive_query');


//Redirect TAGs into Hompage URL:
// Disable public tag archive pages
// add_action('template_redirect', function() {
//     if (is_tag()) {
//         // Option 1: redirect to homepage
//         wp_redirect(home_url());
//         exit;

//         // Option 2: show 404
//         // global $wp_query;
//         // $wp_query->set_404();
//         // status_header(404);
//         // get_template_part(404);
//         // exit;
//     }
// });

// Disable author archive pages
add_action('template_redirect', function() {
    if (is_author()) {
        wp_redirect(home_url());
        exit;
    }
});

// Function to add post type post categories into select drop down on acf
add_filter('acf/load_field/name=misc_blog_cat_1', 's25_load_post_categories_into_select');
add_filter('acf/load_field/name=misc_blog_cat_2', 's25_load_post_categories_into_select');

function s25_load_post_categories_into_select($field) {
    $field['choices'] = [];
    $field['choices'][''] = '— Select category —';

    $terms = get_terms([
        'taxonomy'   => 'category',
        'hide_empty' => false,
        'exclude'    => [ get_option('default_category') ], // 🚫 exclude Uncategorized
        'orderby'    => 'name',
        'order'      => 'ASC',
    ]);

    if (!is_wp_error($terms) && $terms) {
        foreach ($terms as $term) {
            $field['choices'][$term->slug] = $term->name;
        }
    }

    return $field;
}


// Count time of read - used ofr blog posts
/**
 * Estimate reading time in minutes from post content.
 * ~200 words per minute by default.
 */
function s25_get_read_time_minutes($post_id = 0, $wpm = 200) {
    $post_id = $post_id ? (int) $post_id : get_the_ID();
    if (!$post_id) return 1;

    $content = get_post_field('post_content', $post_id);

    // Strip shortcodes + tags, count words
    $text  = wp_strip_all_tags(strip_shortcodes($content));
    $words = str_word_count($text);

    $wpm = max(50, (int) $wpm);
    $minutes = (int) ceil($words / $wpm);

    return max(1, $minutes);
}

/**
 * Fetch a Vimeo video's thumbnail URL via the public oEmbed endpoint.
 * Cached in a transient for 12h so we don't make an HTTP request on every page load.
 * Returns '' on failure (private/deleted video, network error, etc.) — that empty
 * value is also cached so a broken link doesn't hit the network repeatedly.
 */
function intercoastal_vimeo_thumbnail($vimeo_url, $width = 1280) {
    if (empty($vimeo_url)) {
        return '';
    }

    $cache_key = 'ic_vimeo_thumb_' . md5($vimeo_url . '|' . (int) $width);
    $cached    = get_transient($cache_key);
    if ($cached !== false) {
        return $cached; // '' is a valid (cached) result
    }

    $endpoint = add_query_arg(
        array('url' => $vimeo_url, 'width' => (int) $width),
        'https://vimeo.com/api/oembed.json'
    );

    $thumb    = '';
    $response = wp_remote_get($endpoint, array('timeout' => 5));
    if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
        $data = json_decode(wp_remote_retrieve_body($response), true);
        if (!empty($data['thumbnail_url'])) {
            $thumb = $data['thumbnail_url'];
        }
    }

    set_transient($cache_key, $thumb, 12 * HOUR_IN_SECONDS);
    return $thumb;
}
