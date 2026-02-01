<?php 
$block = get_field('block-features-four');
$features = $block['features'] ?? [];
$layout_type = $block['layout_type'] ?? 'default';

if ( ! ($block['disable_section'] ?? false) ):
?>

<section class="block-features-four" aria-label="Features Block">

    <!-- SECTION HEADER -->
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

    <!-- FEATURE CARDS -->
    <?php if ($features): ?>
        <div class="block-features-four-wrapper <?php echo $layout_type === 'gallery' ? 'gallery-layout' : ''; ?>">
            <?php 
            $i = 0; // feature index
            foreach ($features as $feature): 
                $page = $feature['choose_page'];
                if (!$page) continue;

                $bg = $feature['background_image']['url'] ?? '';
                $bg_overlay_color = $feature['background_overlay_color'] ?? $block['background_overlay_color'] ?? '#000000a1';

                // default
                $is_full = false;

                if ($layout_type === 'gallery') {
                    $is_full = ($i % 3 === 0);

                    // Start row
                    if ($is_full) echo '<div class="feature-row full-row">';
                    elseif ($i % 3 === 1) echo '<div class="feature-row">';
                }
            ?>
                <div class="feature-card <?php echo $is_full ? 'full-width' : 'half-width'; ?>">
                    <?php if ($bg): ?>
                        <div class="feature-bg" style="background-image:url('<?php echo esc_url($bg); ?>')"></div>
                    <?php endif; ?>
                    <div class="feature-overlay" style="background-color: <?php echo esc_attr($bg_overlay_color); ?>;"></div>
                    <div class="feature-content">
                        <?php if (!empty($feature['eyebrow'])): ?>
                            <span class="feature-eyebrow"><?php echo esc_html($feature['eyebrow']); ?></span>
                        <?php endif; ?>
                        <h3 class="feature-title">
                            <?php 
                            $feature_title = $feature['text'] ?? '';
                            echo !empty($feature_title) ? esc_html($feature_title) : esc_html(get_the_title($page->ID)); 
                            ?>
                        </h3>
                        <?php if (!empty($feature['description'])): ?>
                            <p class="feature-text"><?php echo esc_html($feature['description']); ?></p>
                        <?php endif; ?>

                        <!-- CTA button: only this is a link -->
                        <?php if (!empty($feature['cta_text'])): ?>
                            <a href="<?php echo get_permalink($page->ID); ?>" class="feature-cta">
                                <?php echo esc_html($feature['cta_text']); ?>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>
            <?php 
                $i++;

                // Close row
                if ($layout_type === 'gallery') {
                    $close_row = false;
                    if ($is_full) $close_row = true; // full row after 1
                    elseif ($i % 3 === 0) $close_row = true; // 2x2 row after 2 items
                    if ($close_row) echo '</div>';
                }
            endforeach; 
            ?>
        </div>

<?php 
// Optional "View All" button for gallery
if ($layout_type === 'gallery') {
    $gallery_link = $block['gallery_button_link'] ?? [];
    if (!empty($gallery_link['url'])):
        $link_url = esc_url($gallery_link['url']);
        $link_title = !empty($gallery_link['title']) ? esc_html($gallery_link['title']) : 'View All';
        $link_target = !empty($gallery_link['target']) ? esc_attr($gallery_link['target']) : '_self';
?>
    <div class="block-features-gallery-button">
        <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>" class="ling-btn">
            <?php echo $link_title; ?>
        </a>
    </div>
<?php 
    endif;
}
?>
<?php endif; ?>





</section>
<?php endif; ?>
