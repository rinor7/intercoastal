<?php
get_header();

// Get current tag
$current_tag = get_queried_object();
?>

<main id="primary" class="site-archive site-author-archive">

    <section class="blogs__section">
        <div class="container">
            <?php if ($current_tag) : ?>
                <div class="section-header">
                    <div class="section-header-title">
                        <?php echo esc_html($current_tag->name); ?>
                    </div>
                    <?php if ($current_tag->description) : ?>
                        <div class="section-header-subtitle">
                            <?php echo wp_kses_post($current_tag->description); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post(); ?>
                        <div class="blog__item col-lg-4 col-md-6 col-sm-12">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog__image">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="blog__item-content">
                                <h3 class="blog__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="blog__excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </div>
                                <a class="blog__readmore" href="<?php the_permalink(); ?>">
                                    <?php echo esc_html(get_field('blog_read_more_text', 'option') ?: 'READ MORE'); ?>
                                </a>
                            </div>
                        </div>
                    <?php endwhile;
                else : ?>
                    <p>No posts found in this tag.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
