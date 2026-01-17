<section class="block-team" aria-label="Team Section">

<div class="container">
    <?php
    $terms = get_terms([
        'taxonomy' => 'team_category',
        'hide_empty' => true,
    ]);
    ?>

    <?php if ($terms && !is_wp_error($terms)): ?>

    <!-- DESKTOP TABS -->
    <div class="team-tabs desktop-only">
        <?php foreach ($terms as $i => $term): ?>
            <button class="team-tab <?php echo $i === 0 ? 'is-active' : ''; ?>"
                    data-index="<?php echo $i; ?>">
                <?php echo esc_html($term->name); ?>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- MOBILE CATEGORY SWIPER -->
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

    <!-- CONTENT -->
    <div class="team-content">

        <!-- DESKTOP CONTENT -->
        <?php foreach ($terms as $i => $term): ?>
            <div class="team-panel desktop-only <?php echo $i === 0 ? 'is-active' : ''; ?>"
                 data-index="<?php echo $i; ?>">

                <?php
                $q = new WP_Query([
                    'post_type' => 'team',
                    'posts_per_page' => -1,
                    'tax_query' => [[
                        'taxonomy' => 'team_category',
                        'terms' => $term->term_id,
                    ]]
                ]);
                ?>

                <?php if ($q->have_posts()): ?>
                    <div class="team-grid">
                        <?php while ($q->have_posts()): $q->the_post(); ?>

                            <article class="team-member">

                                <?php if (has_post_thumbnail()): ?>
                                    <div class="team-thumbnail">
                                        <?php the_post_thumbnail('medium'); // You can change size ?>
                                    </div>
                                <?php endif; ?>

                                <h3 class="team-name"><?php the_title(); ?></h3>

                                <?php 
                                $position = get_field('position');
                                if ($position): ?>
                                    <p class="team-position"><?php echo esc_html($position); ?></p>
                                <?php endif; ?>

                                <div class="description"><?php the_content(); ?></div>

                                <?php 
                                $social_links = [
                                    [
                                        'url'  => get_field('social_media_1'),
                                        'icon' => get_field('social_1_icon'),
                                    ],
                                    [
                                        'url'  => get_field('social_media_2'),
                                        'icon' => get_field('social_2_icon'),
                                    ],
                                    [
                                        'url'  => get_field('social_media_3'),
                                        'icon' => get_field('social_3_icon'),
                                    ],
                                    [
                                        'url'  => get_field('social_media_4'),
                                        'icon' => get_field('social_4_icon'),
                                    ],
                                ];
                                $social_links = array_filter($social_links, fn($item) => !empty($item['url']));

                                if ($social_links): ?>
                                    <div class="team-social">
                                        <?php foreach ($social_links as $item): 
                                            $icon_url = is_array($item['icon']) ? $item['icon']['url'] : $item['icon']; // ACF returns array for image field
                                            ?>
                                            <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener noreferrer">
                                                <?php if ($icon_url): ?>
                                                    <img src="<?php echo esc_url($icon_url); ?>" alt="Social Icon">
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

        <!-- MOBILE CONTENT SWIPER -->
        <div class="team-content-swiper mobile-only swiper js-team-content-swiper">
            <div class="swiper-wrapper">

                <?php foreach ($terms as $term): ?>
                    <div class="swiper-slide">

                        <?php
                        $q = new WP_Query([
                            'post_type' => 'team',
                            'posts_per_page' => -1,
                            'tax_query' => [[
                                'taxonomy' => 'team_category',
                                'terms' => $term->term_id,
                            ]]
                        ]);
                        ?>

                        <?php if ($q->have_posts()): ?>
                            <div class="team-grid">
                                <?php while ($q->have_posts()): $q->the_post(); ?>

                                    <article class="team-member">

                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="team-thumbnail">
                                                <?php the_post_thumbnail('medium'); // You can change size ?>
                                            </div>
                                        <?php endif; ?>

                                        <h3 class="team-name"><?php the_title(); ?></h3>

                                        <?php 
                                        $position = get_field('position');
                                        if ($position): ?>
                                            <p class="team-position"><?php echo esc_html($position); ?></p>
                                        <?php endif; ?>

                                        <div class="description"><?php the_content(); ?></div>

                                        <?php 
                                        $social_links = [
                                            [
                                                'url'  => get_field('social_media_1'),
                                                'icon' => get_field('social_1_icon'),
                                            ],
                                            [
                                                'url'  => get_field('social_media_2'),
                                                'icon' => get_field('social_2_icon'),
                                            ],
                                            [
                                                'url'  => get_field('social_media_3'),
                                                'icon' => get_field('social_3_icon'),
                                            ],
                                            [
                                                'url'  => get_field('social_media_4'),
                                                'icon' => get_field('social_4_icon'),
                                            ],
                                        ];
                                        $social_links = array_filter($social_links, fn($item) => !empty($item['url']));

                                        if ($social_links): ?>
                                            <div class="team-social">
                                                <?php foreach ($social_links as $item): 
                                                    $icon_url = is_array($item['icon']) ? $item['icon']['url'] : $item['icon']; // ACF returns array for image field
                                                    ?>
                                                    <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener noreferrer">
                                                        <?php if ($icon_url): ?>
                                                            <img src="<?php echo esc_url($icon_url); ?>" alt="Social Icon">
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

            </div>
        </div>

    </div>

    <?php endif; ?>
</div>
</section>
