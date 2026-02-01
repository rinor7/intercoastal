<?php
/* Template Name: General Template */
get_header();
?>

<main id="primary" class="site-main site-general-template">

<?php get_template_part('includes/blocks/block-testimonials', null, array()); ?>

 <?php
  // Section 1
  get_template_part('includes/blocks/block-posts-by-cat', null, [
    'cat' => get_field('misc_blog_cat_1'),
    'uptitle' => get_field('misc_blog_uptitle_1'),
    'title' => get_field('misc_blog_title_1'),
    'subtitle' => get_field('misc_blog_subtitle_1'),
    'posts_per_page' => 3,
  ]);
  ?>
  
</main>

<?php get_footer(); ?>