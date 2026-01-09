<?php
function update_attachment_alt_tags() {
    $media_query = new WP_Query(
        array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
        )
    );

    foreach ($media_query->posts as $post) {
        $thumbnail_name = basename(get_attached_file($post->ID));
        if (empty(get_post_meta($post->ID, '_wp_attachment_image_alt', true))) {
            $thumbnail_name = str_replace('-', ' ', $thumbnail_name);
            $thumbnail_name = str_replace('_', ' ', $thumbnail_name);
            $thumbnail_name = explode('.', $thumbnail_name)[0]; // Remove file extension
            $thumbnail_name = ucfirst(strtolower($thumbnail_name)); // Capitalize the first letter
            update_post_meta($post->ID, '_wp_attachment_image_alt', $thumbnail_name);
        }
    }

    echo "Alt tags updated!";
}

// Add an admin menu item to trigger the function
add_action('admin_menu', 'add_alt_tags_update_menu');

function add_alt_tags_update_menu() {
    add_menu_page(
        'Update Alt Tags',
        'Update Alt Tags',
        'manage_options',
        'update-alt-tags',
        'update_alt_tags_admin_page'
    );
}

// Admin page to trigger the function
function update_alt_tags_admin_page() {
    if (isset($_POST['update_alt_tags'])) {
        update_attachment_alt_tags();
    }

    echo '<div class="wrap">';
    echo '<h2>Update Alt Tags for Attachments</h2>';
    echo '<form method="post">';
    echo '<input type="submit" name="update_alt_tags" value="Update Alt Tags" class="button-primary">';
    echo '</form>';
    echo '</div>';
}