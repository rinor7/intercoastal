<?php 

function custom_post_type() {
    register_post_type('Team', array(
        'labels' => array('name' => 'Team Members'),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
        'taxonomies' => array('team_category'), //if you need "Uncategorized" category, replace "custom_taxonomy" with "category"
        'menu_position' => 8,
        'menu_icon' => 'dashicons-welcome-add-page',
    ));
}
add_action('init', 'custom_post_type');
