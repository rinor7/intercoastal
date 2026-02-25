<?php
// Register Custom Post Type: Team Members
function register_team_post_type() {
    $labels = array(
        'name'                  => 'Team Members',
        'singular_name'         => 'Team Member',
        'menu_name'             => 'Team Members',
        'name_admin_bar'        => 'Team Member',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add Team Member',
        'edit_item'             => 'Edit Team Member',
        'new_item'              => 'New Team Member',
        'view_item'             => 'View Team Member',
        'search_items'          => 'Search Team Members',
        'not_found'             => 'No Team Members found',
        'not_found_in_trash'    => 'No Team Members found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,       // hide from front-end
        'show_ui'            => true,        // show in admin
        'show_in_menu'       => true,
        'has_archive'        => false,
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes'),
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-groups',
        'exclude_from_search'=> true,
        'publicly_queryable' => false,
        'show_in_nav_menus'  => false,
    );

    register_post_type('team', $args);
}
add_action('init', 'register_team_post_type');
