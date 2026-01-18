<?php
/**
 * BLOCK: Team
 */

/* ------------------------------------
 * 1. Get block fields
 * ------------------------------------ */
$block = get_field('block-team');

/* ------------------------------------
 * 2. Disable via ACF toggle
 * ------------------------------------ */
if ( ! empty($block['disable_section']) ) {
    return;
}

/* ------------------------------------
 * 3. Ensure post type exists
 * ------------------------------------ */
if ( ! post_type_exists('team') ) {
    return;
}

/* ------------------------------------
 * 4. Check if team posts exist
 * ------------------------------------ */
$has_team_posts = get_posts([
    'post_type'      => 'team',
    'posts_per_page' => 1,
    'fields'         => 'ids',
]);

if ( empty($has_team_posts) ) {
    return;
}

/* ------------------------------------
 * 5. Get valid categories
 * ------------------------------------ */
$terms = get_terms([
    'taxonomy'   => 'team_category',
    'hide_empty' => true,
    'meta_key'   => 'order',        // ACF field for category order
    'orderby'    => 'meta_value_num',
    'order'      => 'ASC',
]);

if ( empty($terms) || is_wp_error($terms) ) {
    return;
}
?>

<section class="block-team" aria-label="Team Section">

    <div class="container">
        <div class="section-header">

            <?php if (!empty($block['section_uptitle'])): ?>
                <div class="section-header-uptitle">
                    <?php echo wp_kses_post($block['section_uptitle']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($block['section_title'])): ?>
                <div class="section-header-title">
                    <?php echo wp_kses_post($block['section_title']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($block['section_subtitle'])): ?>
                <div class="section-header-subtitle">
                    <?php echo wp_kses_post($block['section_subtitle']); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="container container-slider">
        <!-- DESKTOP TABS -->
        <div class="team-tabs desktop-only">
            <?php foreach ($terms as $i => $term): ?>
                <button
                    class="team-tab <?php echo $i === 0 ? 'is-active' : ''; ?>"
                    data-index="<?php echo esc_attr($i); ?>">
                    <?php echo esc_html($term->name); ?>
                </button>
            <?php endforeach; ?>
        </div>
        <!-- MOBILE TABS -->
        <div class="team-tabs-swiper mobile-only swiper js-team-tabs-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($terms as $term): ?>
                    <div class="swiper-slide">
                        <?php echo esc_html($term->name); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-prev team-tabs-prev"></div>
            <div class="swiper-button-next team-tabs-next"></div>
            <div class="swiper-pagination team-tabs-pagination"></div>
        </div>
        <!-- ================= CONTENT ================= -->
        <div class="team-content">
            <!-- DESKTOP CONTENT -->
            <?php foreach ($terms as $i => $term): ?>
                <div
                    class="team-panel desktop-only <?php echo $i === 0 ? 'is-active' : ''; ?>"
                    data-index="<?php echo esc_attr($i); ?>">

                    <?php
                    $q = new WP_Query([
                        'post_type'      => 'team',
                        'posts_per_page' => -1,
                        'tax_query'      => [[
                            'taxonomy' => 'team_category',
                            'terms'    => $term->term_id,
                        ]],
                    ]);
                    ?>

                    <?php if ($q->have_posts()): ?>
                        <div class="team-grid">
                            <?php while ($q->have_posts()): $q->the_post(); ?>

                                <article class="team-member">

                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="team-thumbnail">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <h3 class="team-name"><?php the_title(); ?></h3>

                                    <?php if ($position = get_field('position')): ?>
                                        <p class="team-position"><?php echo esc_html($position); ?></p>
                                    <?php endif; ?>

                                    <div class="description">
                                        <?php the_content(); ?>
                                    </div>

                                    <?php
                                    $social_links = array_filter([
                                        ['url' => get_field('social_media_1'), 'icon' => get_field('social_1_icon')],
                                        ['url' => get_field('social_media_2'), 'icon' => get_field('social_2_icon')],
                                        ['url' => get_field('social_media_3'), 'icon' => get_field('social_3_icon')],
                                        ['url' => get_field('social_media_4'), 'icon' => get_field('social_4_icon')],
                                    ], fn($item) => !empty($item['url']));
                                    ?>

                                    <?php if ($social_links): ?>
                                        <div class="team-social">
                                            <?php foreach ($social_links as $item): 
                                                $icon = is_array($item['icon']) ? $item['icon']['url'] : $item['icon'];
                                            ?>
                                                <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener">
                                                    <?php if ($icon): ?>
                                                        <img src="<?php echo esc_url($icon); ?>" alt="">
                                                    <?php endif; ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                </article>

                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

            <!-- MOBILE CONTENT -->
            <div class="team-content-swiper mobile-only swiper js-team-content-swiper">
                <div class="swiper-wrapper">

                    <?php foreach ($terms as $term): ?>
                        <div class="swiper-slide">

                            <?php
                            $q = new WP_Query([
                                'post_type'      => 'team',
                                'posts_per_page' => -1,
                                'tax_query'      => [[
                                    'taxonomy' => 'team_category',
                                    'terms'    => $term->term_id,
                                ]],
                            ]);
                            ?>

                            <?php if ($q->have_posts()): ?>
                                <div class="team-grid">
                                    <?php while ($q->have_posts()): $q->the_post(); ?>

                                        <article class="team-member">
                                            <?php if (has_post_thumbnail()): ?>
                                                <div class="team-thumbnail">
                                                    <?php the_post_thumbnail('medium'); ?>
                                                </div>
                                            <?php endif; ?>

                                            <h3 class="team-name"><?php the_title(); ?></h3>

                                            <?php if ($position = get_field('position')): ?>
                                                <p class="team-position"><?php echo esc_html($position); ?></p>
                                            <?php endif; ?>

                                            <div class="description"><?php the_content(); ?></div>
                                        </article>

                                    <?php endwhile; wp_reset_postdata(); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </div>

    </div>

</section>
