<?php
/* Template Name: Marketplace Template */
get_header();
?>

<main id="primary" class="site-main site-marketplace">

<?php get_template_part('includes/blocks/block-banner-all', null, array()); ?>

<div class="container the__content">
    <?php the_content(); ?>
</div>

</main>

<?php get_footer(); ?>