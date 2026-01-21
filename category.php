<?php
get_header();
// Get current category
$current_category = get_queried_object();
?>

<main id="primary" class="site-archive site-blog-category">

<section class="blogs__section">
    <div class="container">

        <?php if ($current_category) : ?>
                <div class="section-header">
                    <div class="section-header-title">
                        <?php echo esc_html($current_category->name); ?>
                    </div>
                    <?php if ($current_category->description) : ?>
                        <div class="section-header-subtitle">
                            <?php echo wp_kses_post($current_category->description); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <div class="row">
            <?php
            // Get the current category
            $current_category = get_queried_object();
            if ( $current_category && ! is_wp_error( $current_category ) ) :
                $args = [
                    'posts_per_page' => -1, // or 4 for 4 boxes
                    'cat'            => $current_category->term_id,
                ];

                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        
                        <div class="blog__item col-lg-3 col-md-6 col-sm-12">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="blog__image">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="blog__item-content">
                                <div class="blog__meta">
                                    <?php 
                                    $tags = get_the_terms( get_the_ID(), 'post_tag' );
                                    if ( $tags && ! is_wp_error( $tags ) ) : ?>
                                        <span class="blog__tag"><?php echo esc_html( $tags[0]->name ); ?></span>
                                    <?php endif; ?>
                                    <span class="blog__readtime">3 min read</span>
                                </div>

                                <h3 class="blog__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <div class="blog__excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </div>

                                <a class="blog__readmore" href="<?php the_permalink(); ?>">
                                    <?php echo esc_html( get_field('blog_read_more_text', 'option') ?: 'READ MORE' ); ?>
                                    <span>
                                        <svg width="4" height="7" viewBox="0 0 4 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.697388 0.129886L3.37439 2.80689C3.43639 2.86889 3.48405 2.93555 3.51739 3.00689C3.55072 3.07822 3.56705 3.15655 3.56639 3.24189C3.56572 3.32722 3.54905 3.40555 3.51639 3.47689C3.48372 3.54822 3.43605 3.61489 3.37339 3.67689L0.696387 6.35389C0.659054 6.39055 0.616054 6.42155 0.567387 6.44689C0.51872 6.47155 0.466388 6.48389 0.410388 6.48389C0.298388 6.48389 0.202054 6.44722 0.121387 6.37389C0.0407202 6.29922 0.00038674 6.20155 0.00038675 6.08089L0.000387246 0.403886C0.000387257 0.282553 0.0417212 0.184887 0.124388 0.110887C0.207054 0.0368874 0.303055 -0.000112819 0.412388 -0.000112809C0.440388 -0.000112807 0.535054 0.0432198 0.696387 0.129886" fill="white"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>

                    <?php endwhile; 
                endif; 
                wp_reset_postdata();
            endif; ?>
        </div>



    </div>
</section>



</main>

<?php get_footer(); ?>