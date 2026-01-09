<?php 
global $header_type; // required to access global variable

// Ensure textdomain is loaded for 404 page
if (!is_textdomain_loaded('intercoastal')) {
    load_theme_textdomain('intercoastal', get_template_directory() . '/languages');
}

get_header();
?>

<main id="primary" class="site-404">
    <div class="fof">
        <h1><?php _e( 'Error 404', 'intercoastal'); ?></h1>
    </div>
</main><!-- #main -->