<?php 
$banner = get_field('group_banner') ?: [];
if (empty($banner['disable_section'])): 
    $video_url = $banner['video'] ?? '';
    $image_url = $banner['image'] ?? '';
    $overlay_color = $banner['video_overlay_color'] ?? get_field('video_overlay_color') ?? '#000000a1';
    $bg_overlay_color = $banner['background_overlay_color'] ?? get_field('background_overlay_color') ?? '#000000a1';

    // Handle height logic
    $min_height = $banner['min_height_desktop'] ?? '';
    if (wp_is_mobile() && !empty($banner['min_height_mobile'])) {
        $min_height = $banner['min_height_mobile'];
    }
    if (is_numeric($min_height)) {
        $min_height .= 'px';
    }

    // Build style attribute for section
    $inline_style = '';
    if (!empty($min_height)) {
        $inline_style .= 'height:' . esc_attr($min_height) . ';';
    }
    if (!$video_url && $image_url) {
        $inline_style .= 'background-image:url(' . esc_url($image_url) . ');';
    }
?>
<section class="banner__section"
    <?php if (!empty($inline_style)): ?>style="<?php echo $inline_style; ?>"<?php endif; ?> aria-label="Banner">
    <?php if ($video_url): ?>
        <div class="video-wrapper">
            <video autoplay muted loop playsinline preload="auto" class="banner-video">
                <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="overlay" style="background-color: <?php echo esc_attr( $overlay_color ); ?>;"></div>
        </div>
    <?php else: ?>
        <div class="image-overlay" style="background-color: <?php echo esc_attr( $bg_overlay_color ); ?>;"></div>
    <?php endif; ?>

    <div class="container">
        <div class="row">
           <?php
            // Removed content width and alignment options — default to single column.
            ?>
            <div class="centerized-content">
                <?php if (!empty($banner['title'])): ?>
                    <h1><?php echo esc_html($banner['title']); ?></h1>
                <?php endif; ?>

                <?php if (!empty($banner['subtitle'])): ?>
                    <p><?php echo $banner['subtitle']; ?></p>
                <?php endif; ?>

                <?php
                // Minimal: use only ACF Link field `button_link_1`.
                // Expecting the Link field to return an array with 'url' and 'title'.
                $btn = $banner['button_link_1'] ?? null;
                if (!empty($btn) && is_array($btn) && !empty($btn['url']) && !empty($btn['title'])): ?>
                    <div class="default-btn">
                        <a href="<?php echo esc_url($btn['url']); ?>" class="link-btn" <?php echo !empty($btn['target']) ? 'target="' . esc_attr($btn['target']) . '" rel="noopener noreferrer"' : ''; ?>>
                            <?php echo esc_html($btn['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>