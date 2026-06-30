<?php
// Video block (shown under the hero). Inside a container.
// - Upload a local MP4, OR paste a Vimeo link (Vimeo overrides the local upload).
// - Optional poster/background image. For Vimeo, if no poster is set we pull the
//   Vimeo thumbnail automatically.
// - Click the play button to start the video.
$video = get_field('group_video') ?: [];

if (empty($video['disable_section'])):

    $local_video = $video['video'] ?? '';        // File field, return format = URL
    $vimeo_raw   = $video['vimeo_url'] ?? '';
    $poster      = $video['poster_image'] ?? '';  // Image field, return format = array

    // Resolve poster image (field may return an array, URL string, or attachment ID).
    $poster_url = '';
    if ($poster) {
        $poster_url = is_array($poster)
            ? ($poster['url'] ?? '')
            : (is_numeric($poster) ? wp_get_attachment_image_url($poster, 'full') : $poster);
    }

    // A valid Vimeo link overrides the local upload.
    $vimeo_embed = '';
    if ($vimeo_raw && preg_match('~vimeo\.com/(?:video/)?(\d+)(?:(?:[/?&]h=)|/)?([a-zA-Z0-9]+)?~', $vimeo_raw, $m)) {
        $vimeo_id   = $m[1];
        $vimeo_hash = $m[2] ?? '';
        // Built for click-to-play: autoplay + sound on once the user presses play.
        $vimeo_embed = 'https://player.vimeo.com/video/' . $vimeo_id
            . '?autoplay=1&title=0&byline=0&portrait=0'
            . ($vimeo_hash ? '&h=' . $vimeo_hash : '');

        // No custom poster -> fall back to the Vimeo thumbnail (cached).
        if (!$poster_url && function_exists('intercoastal_vimeo_thumbnail')) {
            $poster_url = intercoastal_vimeo_thumbnail($vimeo_raw);
        }
    }

    $is_vimeo  = $vimeo_embed !== '';
    $has_video = $is_vimeo || $local_video;

    if ($has_video):
?>
<section class="block-video">
    <div class="container">
        <div class="block-video__inner<?php echo $is_vimeo ? ' is-vimeo' : ''; ?>"
            data-type="<?php echo $is_vimeo ? 'vimeo' : 'local'; ?>"
            <?php if ($is_vimeo): ?>data-embed="<?php echo esc_url($vimeo_embed); ?>"<?php endif; ?>>

            <?php if ($poster_url): ?>
                <div class="block-video__poster" style="background-image:url(<?php echo esc_url($poster_url); ?>);"></div>
            <?php endif; ?>

            <?php if (!$is_vimeo): ?>
                <video class="block-video__video" playsinline preload="none"<?php echo $poster_url ? ' poster="' . esc_url($poster_url) . '"' : ''; ?>>
                    <source src="<?php echo esc_url($local_video); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>

            <button type="button" class="block-video__play" aria-label="Play video">
                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                    <path d="M50 9.375C41.9652 9.375 34.1107 11.7576 27.43 16.2215C20.7492 20.6855 15.5422 27.0302 12.4674 34.4535C9.3926 41.8767 8.58809 50.0451 10.1556 57.9255C11.7231 65.806 15.5923 73.0447 21.2738 78.7262C26.9553 84.4077 34.194 88.2769 42.0745 89.8444C49.955 91.4119 58.1233 90.6074 65.5465 87.5326C72.9698 84.4578 79.3145 79.2508 83.7785 72.57C88.2424 65.8893 90.625 58.0349 90.625 50C90.6136 39.2291 86.3299 28.9025 78.7137 21.2863C71.0975 13.6701 60.7709 9.38637 50 9.375ZM50 84.375C43.2013 84.375 36.5552 82.3589 30.9023 78.5818C25.2494 74.8046 20.8434 69.436 18.2417 63.1547C15.6399 56.8735 14.9592 49.9619 16.2855 43.2938C17.6119 36.6257 20.8858 30.5006 25.6932 25.6932C30.5007 20.8858 36.6257 17.6119 43.2938 16.2855C49.9619 14.9591 56.8736 15.6399 63.1548 18.2416C69.436 20.8434 74.8046 25.2493 78.5818 30.9023C82.359 36.5552 84.375 43.2013 84.375 50C84.3647 59.1136 80.7397 67.8511 74.2954 74.2954C67.8511 80.7397 59.1137 84.3647 50 84.375ZM68.8438 47.3516L43.8438 31.7266C43.3708 31.431 42.8274 31.2673 42.2699 31.2526C41.7124 31.2379 41.1611 31.3727 40.6733 31.6429C40.1854 31.9132 39.7788 32.309 39.4956 32.7894C39.2123 33.2698 39.0628 33.8173 39.0625 34.375V65.625C39.0628 66.1827 39.2123 66.7302 39.4956 67.2106C39.7788 67.691 40.1854 68.0868 40.6733 68.3571C41.1611 68.6273 41.7124 68.7621 42.2699 68.7474C42.8274 68.7327 43.3708 68.569 43.8438 68.2734L68.8438 52.6484C69.2925 52.3674 69.6625 51.9769 69.919 51.5136C70.1755 51.0504 70.31 50.5295 70.31 50C70.31 49.4705 70.1755 48.9496 69.919 48.4864C69.6625 48.0231 69.2925 47.6326 68.8438 47.3516ZM45.3125 59.9883V40.0117L61.293 50L45.3125 59.9883Z" fill="currentColor"/>
                </svg>
            </button>
        </div>
    </div>
</section>
<?php
    endif;
endif;
?>
