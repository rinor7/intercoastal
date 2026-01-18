<section class="blogs__section">

    <?php if (is_page_template('template-general.php') || is_page_template('template-miscellaneius.php')): ?>
        <div class="section-header">
             <?php 
            $section_uptitle = get_field('section_uptitle-news');
            if ($section_uptitle) : ?>
                <div class="section-header-uptitle">
                    <?php echo wp_kses_post($section_uptitle); ?>
                </div>
            <?php endif; ?>
            <?php 
            $section_title = get_field('title_section-news');
            if ($section_title) : ?>
                <div class="section-header-title">
                    <?php echo wp_kses_post($section_title); ?>
                </div>
            <?php endif; ?>
            <?php 
            $section_subtitle = get_field('subtitle_section-news');
            if ($section_subtitle) : ?>
                <div class="section-header-subtitle">
                    <?php echo wp_kses_post($section_subtitle); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row"> <!-- grid wrapper for 3 columns -->
            <?php 
            $args = array(
                'posts_per_page' => 3,
                'category_name'  => 'news'
            ); 
            $the_query = new WP_Query($args);
            if($the_query->have_posts()) : 
                while ($the_query->have_posts()) : $the_query->the_post(); 
            ?>
                <div class="blog__item col-lg-4">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="blog__image">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="blog__item-content">
                        <div class="blog__meta">
                         <?php 
                        // Get post tags
                        $tags = get_the_terms( get_the_ID(), 'post_tag' ); // 'post_tag' is the taxonomy for tags
                        if ( $tags && ! is_wp_error( $tags ) ) : ?>
                            <span class="blog__tag"><?php echo esc_html( $tags[0]->name ); ?></span>
                        <?php endif; ?>
                        <span class="blog__readtime">3 min read</span> <!-- static for now -->
                    </div>

                    <h3 class="blog__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <div class="blog__excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                    </div>

                    <a class="blog__readmore" href="<?php the_permalink(); ?>">READ MORE &rarr;</a>
                    </div>
                </div>
            <?php 
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>

        <div class="blogs__viewall">
            <a class="btn-all" href="/news">VIEW ALL</a>
        </div>
    </div>
</section>
