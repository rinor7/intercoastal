<?php
/* Template Name: Livestyle Template */
get_header();
?>

<main id="primary" class="site-main site-livestyle-template">

<?php get_template_part('includes/blocks/block-banner-all', null, array()); ?>

<?php get_template_part('includes/blocks/block-image-and-content-comb', null, array()); ?>

<?php get_template_part('includes/blocks/block-features-four', null, array()); ?>

<?php get_template_part('includes/blocks/block-features', null, array()); ?>

</main>

<?php get_footer(); ?>