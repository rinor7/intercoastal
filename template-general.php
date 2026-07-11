<?php
/* Template Name: General Template */
get_header();
?>

<main id="primary" class="site-main site-intercoastal-today">

  <?php
  // Blog sections come from the "Sections" repeater (field group:
  // "General Page Template — Blog Sections"). Add/reorder/remove sections in the editor.
  // We also collect the category IDs used here so the optional catch-all section can skip them.
  $used_cat_ids = [];

  if (have_rows('general_blog_sections')) :
    while (have_rows('general_blog_sections')) : the_row();

      $cat = get_sub_field('cat'); // taxonomy field returns the category ID
      if ($cat) {
        $used_cat_ids[] = (int) (is_object($cat) ? $cat->term_id : $cat);
      }

      get_template_part('includes/blocks/block-posts-by-cat', null, [
        'cat'            => $cat,
        'uptitle'        => get_sub_field('uptitle'),
        'title'          => get_sub_field('title'),
        'subtitle'       => get_sub_field('subtitle'),
        'posts_per_page' => get_sub_field('posts_per_page') ?: 3,
      ]);

    endwhile;
  endif;

  // Optional: one extra section pulling recent posts from every OTHER category
  // not listed above. Auto-hides when there's nothing left to show.
  if (get_field('show_other_cats')) :
    get_template_part('includes/blocks/block-posts-other-cats', null, [
      'exclude_cats'   => $used_cat_ids,
      'uptitle'        => get_field('other_uptitle'),
      'title'          => get_field('other_title'),
      'subtitle'       => get_field('other_subtitle'),
      'posts_per_page' => get_field('other_posts_per_page') ?: 3,
    ]);
  endif;
  ?>

</main>

<?php
// Testimonials slider — toggled per page with the "Show testimonials section" field.
// Pages saved before this field existed have no stored value, so ACF falls back to
// the field's default (on) and they keep rendering the section.
if (get_field('show_testimonials')) :
  get_template_part('includes/blocks/block-testimonials', null, array());
endif;
?>

<?php get_footer(); ?>
