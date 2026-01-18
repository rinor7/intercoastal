<?php
// Register Taxonomy: Team Categories (Admin only)
function register_team_category_taxonomy() {
    $labels = array(
        'name'              => 'Categories',
        'singular_name'     => 'Team Category',
        'search_items'      => 'Search Team Categories',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Team Categories',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => false,     // disables front-end query
        'rewrite'           => false,     // disables public URLs
        'public'            => false,     // hide completely from front-end
        'show_in_nav_menus' => false,     // not available in menus
    );

    register_taxonomy('team_category', array('team'), $args);
}
add_action('init', 'register_team_category_taxonomy');
