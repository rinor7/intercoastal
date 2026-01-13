<?php
/* Template Name: About Us Template */
get_header();
?>

<main id="primary" class="site-main site-about-us-template">

<?php include("includes/blocks/block-banner-all.php"); ?>

<div class="container">
    <?php the_content(); ?>
</div>

</main>

<?php get_footer(); ?>