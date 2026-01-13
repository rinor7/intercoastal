<?php
/* Template Name: Home */
get_header();
?>

<main id="primary" class="site-main">

<?php get_template_part('includes/blocks/block-banner-all', null, array()); ?>

<?php get_template_part('includes/blocks/block-image-and-text', null, array()); ?>

<?php get_template_part('includes/blocks/block-features', null, array()); ?>

<?php get_template_part('includes/blocks/block-image-and-content-comb-rev', null, array()); ?>

</main>

<?php get_footer(); ?>