<?php 
$block = get_field('block-features');
$features = $block['features'] ?? [];

if ( ! ($block['disable_section'] ?? false) ):
?>

<section class="block-features" aria-label="Features Section">

    <!-- SECTION HEADER -->
    <div class="section-header">
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

    <!-- FEATURE CARDS -->
    <?php if ($features): ?>
    <div class="block-features-wrapper">

        <?php foreach ($features as $feature): 
            $page = $feature['choose_page'];
            if (!$page) continue;

            $bg = $feature['background_image']['url'] ?? '';
            $bg_overlay_color = $feature['background_overlay_color'] ?? $block['background_overlay_color'] ?? get_field('background_overlay_color') ?? '#000000a1';
        ?>
            <a href="<?php echo get_permalink($page->ID); ?>" class="feature-card">

                <?php if ($bg): ?>
                    <div class="feature-bg" style="background-image:url('<?php echo esc_url($bg); ?>')"></div>
                <?php endif; ?>

                <div class="feature-overlay" style="background-color: <?php echo esc_attr($bg_overlay_color); ?>;"></div>

                <div class="feature-content">

                    <?php if (!empty($feature['eyebrow'])): ?>
                        <span class="feature-eyebrow">
                            <?php echo esc_html($feature['eyebrow']); ?>
                        </span>
                    <?php endif; ?>

                    <!-- TITLE: allow override from ACF `title_override` -->
                    <h3 class="feature-title">
                        <?php
                            $feature_title = $feature['text'] ?? '';
                            if (!empty($feature_title)) {
                                echo esc_html($feature_title);
                            } else {
                                echo esc_html(get_the_title($page->ID));
                            }
                        ?>
                    </h3>

                    <?php if (!empty($feature['description'])): ?>
                        <p class="feature-text">
                            <?php echo esc_html($feature['description']); ?>
                        </p>
                    <?php endif; ?>

                    <span class="feature-cta">Explore</span>
                </div>

            </a>
        <?php endforeach; ?>

    </div>
    <?php endif; ?>

</section>
<?php endif; ?>
