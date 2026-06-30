<?php 
$banner = get_field('group_banner') ?: [];

if (empty($banner['disable_section'])): 

    $video_url  = $banner['video'] ?? '';
    $image_url  = $banner['image'] ?? '';

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

    if (!$video_url && $image_url) {
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
    <?php else: ?>

        <div class="image-overlay" style="background-color: <?php echo esc_attr( $bg_overlay_color ); ?>;"></div>
    <?php endif; ?>

    <?php
    // Homepage hero image (field group attached to the front page).
    // Shows a single image centered over the banner, front page only, when the toggle is on.
    $hero_image = '';
    if (is_front_page() && function_exists('get_field')) {
        $front_id = (int) get_option('page_on_front');
        if (get_field('show_hero_image_on_homepage', $front_id)) {
            $hero_image = get_field('homepage_hero_image', $front_id);
        }
    }

    if ($hero_image):
        // Image field may return an array, URL string, or attachment ID depending on its setting.
        $hero_image_url = is_array($hero_image) ? ($hero_image['url'] ?? '') : (is_numeric($hero_image) ? wp_get_attachment_image_url($hero_image, 'full') : $hero_image);
        $hero_image_alt = is_array($hero_image) ? ($hero_image['alt'] ?? '') : '';
        if ($hero_image_url):
    ?>
        <div class="banner__hero-image">
            <img src="<?php echo esc_url($hero_image_url); ?>" alt="<?php echo esc_attr($hero_image_alt); ?>">
        </div>
    <?php endif; endif; ?>

    <?php
    // Resolve the title first so we can decide whether the content block renders at all.
    // Treat whitespace-only / &nbsp; custom titles as empty so we don't render a blank <h1>.
    $custom_title = trim(str_replace("\xc2\xa0", ' ', strip_tags($banner['title'] ?? '')));
    if ($custom_title !== '') {
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