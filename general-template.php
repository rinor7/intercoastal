<?php
/* Template Name: General Template */
get_header();
?>

<main id="primary" class="site-main site-general-template">

<?php get_template_part('includes/blocks/block-testimonials', null, array()); ?>

<?php get_template_part('includes/blocks/blogs', null, array()); ?>

</main>

<?php get_footer(); ?>