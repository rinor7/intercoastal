<?php 
$banner = get_field('group_banner') ?: [];

if (empty($banner['disable_section'])): 

    $video_url  = $banner['video'] ?? '';
    $image_url  = $banner['image'] ?? '';

    // Vimeo support: paste a vimeo.com/player.vimeo.com URL (or iframe embed) into the `vimeo_url` field.
    $vimeo_raw   = $banner['vimeo_url'] ?? '';
    $vimeo_embed = '';
    if ($vimeo_raw && preg_match('~vimeo\.com/(?:video/)?(\d+)(?:(?:[/?&]h=)|/)?([a-zA-Z0-9]+)?~', $vimeo_raw, $m)) {
        $vimeo_id   = $m[1];
        $vimeo_hash = $m[2] ?? '';
        $vimeo_embed = 'https://player.vimeo.com/video/' . $vimeo_id
            . '?background=1&autoplay=1&loop=1&muted=1&autopause=0'
            . ($vimeo_hash ? '&h=' . $vimeo_hash : '');
    }

    $overlay_color    = $banner['video_overlay_color'] ?? get_field('video_overlay_color') ?? '#000000a1';
    $bg_overlay_color = $banner['background_overlay_color'] ?? get_field('background_overlay_color') ?? '#000000a1';

    // Height logic
    $min_height = $banner['min_height_desktop'] ?? '';
    if (wp_is_mobile() && !empty($banner['min_height_mobile'])) {
        $min_height = $banner['min_height_mobile'];
    }
    if (is_numeric($min_height)) {
        $min_height .= 'px';
    }

    // Background position logic
    $bg_position = $banner['background_position_desktop'] ?? '';
    if (wp_is_mobile() && !empty($banner['background_position_mobile'])) {
        $bg_position = $banner['background_position_mobile'];
    }

    // Build inline style
    $inline_style = '';

    if (!empty($min_height)) {
        $inline_style .= 'height:' . esc_attr($min_height) . ';';
    }

    if (!$video_url && !$vimeo_embed && $image_url) {
        $inline_style .= 'background-image:url(' . esc_url($image_url) . ');';

        if (!empty($bg_position)) {
            $inline_style .= 'background-position:' . esc_attr($bg_position) . ';';
        }
    }
?>
<section class="banner__section"
    <?php if (!empty($inline_style)): ?>
        style="<?php echo $inline_style; ?>"
    <?php endif; ?>
    aria-label="Banner">

    <?php if ($video_url): ?>
        <div class="video-wrapper">
            <video autoplay muted loop playsinline preload="auto" class="banner-video">
                <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="overlay" style="background-color: <?php echo esc_attr($overlay_color); ?>;"></div>
        </div>
    <?php elseif ($vimeo_embed):
        // Fallback shown if the Vimeo video is private/deleted or fails to load.
        // Uses the banner image if set, otherwise the theme default bg.webp.
        $fallback_bg = $image_url ?: get_template_directory_uri() . '/assets/img/bg.webp';
    ?>
        <div class="video-wrapper is-vimeo" style="background-image:url(<?php echo esc_url($fallback_bg); ?>);">
            <iframe src="<?php echo esc_url($vimeo_embed); ?>"
                frameborder="0"
                allow="autoplay; fullscreen; picture-in-picture"
                allowfullscreen
                title="Banner video"></iframe>
            <div class="overlay" style="background-color: <?php echo esc_attr($overlay_color); ?>;"></div>
        </div>
    <?php else: ?>

        <div class="image-overlay" style="background-color: <?php echo esc_attr( $bg_overlay_color ); ?>;"></div>
    <?php endif; ?>

    <?php
    // Resolve the title first so we can decide whether the content block renders at all.
    if (!empty($banner['title'])) {
        $title = $banner['title'];
        $title_class = 'is-custom-title';
    } elseif (is_front_page()) {
        // Homepage: no page-title fallback, so the title doesn't show over the banner video.
        $title = '';
        $title_class = '';
    } else {
        $title = get_the_title();
        $title_class = 'is-page-title';
    }

    // Only build the content container if there's something to show
    // (title, subtitle, or a valid button). Avoids an empty box over the video.
    $btn = $banner['button_link_1'] ?? null;
    $has_button = !empty($btn) && is_array($btn) && !empty($btn['url']) && !empty($btn['title']);
    $has_content = !empty($title) || !empty($banner['subtitle']) || $has_button;

    if ($has_content): ?>
    <div class="container">
        <div class="row">
            <div class="centerized-content">
                <?php if (!empty($title)): ?>
                    <h1 class="<?php echo esc_attr($title_class); ?>">
                        <?php echo esc_html($title); ?>
                    </h1>
                <?php endif; ?>

                <?php if (!empty($banner['subtitle'])): ?>
                    <p><?php echo $banner['subtitle']; ?></p>
                <?php endif; ?>

                <?php if ($has_button): ?>
                    <div class="default-btn">
                        <a href="<?php echo esc_url($btn['url']); ?>" class="link-btn" <?php echo !empty($btn['target']) ? 'target="' . esc_attr($btn['target']) . '" rel="noopener noreferrer"' : ''; ?>>
                            <?php echo esc_html($btn['title']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php
    $show_address = $banner['show_address_line'] ?? false;
    $address_link = $banner['address_link'] ?? null;

    if ($show_address && !empty($address_link['url']) && !empty($address_link['title'])) :
    ?>
        <div class="banner-address">
            <a href="<?php echo esc_url($address_link['url']); ?>"
            <?php echo !empty($address_link['target']) ? 'target="' . esc_attr($address_link['target']) . '" rel="noopener noreferrer"' : ''; ?>>
                <span class="icon-location"></span>
                <span class="address-text">
                    <?php echo esc_html($address_link['title']); ?>
                </span>
            </a>
        </div>
    <?php endif; ?>


</section>
<?php endif; ?>