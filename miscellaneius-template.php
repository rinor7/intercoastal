<?php
/* Template Name: Miscellaneius Template */
get_header();
?>

<main id="primary" class="site-main site-miscellaneius-template">

<?php get_template_part('includes/blocks/block-banner-all', null, array()); ?>

<?php get_template_part('includes/blocks/blogs-blog', null, array()); ?>

<?php get_template_part('includes/blocks/blogs-updates', null, array()); ?>

</main>

<?php get_footer(); ?>