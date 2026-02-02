<?php
$block_fields = get_field('block-image-and-content-comb') ?: [];

$comb_btn_1   = $block_fields['comb_btn_1'] ?? [];
$comb_btn_2   = $block_fields['comb_btn_2'] ?? [];
$comb_btn_1_1 = $block_fields['comb_btn_1_1'] ?? [];
$comb_btn_2_2 = $block_fields['comb_btn_2_2'] ?? [];

// content layout fields
$content_layout = $block_fields['content_layout'] ?? 'single';
$content_top    = $block_fields['content-top'] ?? '';
$content_left   = $block_fields['content-upside'] ?? '';
$content_right  = $block_fields['content-upside-double'] ?? '';

if ( ! ($block_fields['disable_section'] ?? false) ) : ?>
<section class="block-image-and-content-comb">

    <!-- TITLE ROW -->
    <div class="title-row">
        <div class="container">
            <?php
                $title_upside = $block_fields['title_upside'] ?? '';
                $title_down   = $block_fields['title_down'] ?? '';
                $txt_right    = $block_fields['txt-right'] ?? '';

                $left_filled  = ! empty($title_upside) || ! empty($title_down);
                $right_filled = ! empty($txt_right);

                $title_wrapper_class = ($left_filled && $right_filled)
                    ? 'title-row-wrapper two-cols'
                    : 'title-row-wrapper single-col';
            ?>
            <div class="<?php echo esc_attr($title_wrapper_class); ?>">
                <div class="title-left">
                    <div class="title-left-upside"><?php echo $title_upside; ?></div>
                    <div class="title-left-downside"><?php echo $title_down; ?></div>
                </div>

                <?php if ($right_filled) : ?>
                    <div class="title-right">
                        <?php echo $txt_right; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <?php
    $image = $block_fields['image'] ?? null;

    // position fields inside this block
    $img_position = $block_fields['background_position_desktop'] ?? '';
    if ( wp_is_mobile() && !empty($block_fields['background_position_mobile']) ) {
        $img_position = $block_fields['background_position_mobile'];
    }
    ?>
    <?php if ( ! empty($image) ) : ?>
    <!-- TEXT + IMAGE ROW -->
    <div class="txt-image-row">
        <div class="container">
            <?php
            // Determine column classes based on layout
            $content_col_class = ($content_layout === 'double') ? 'col-lg-6' : 'col-lg-5';
            $image_col_class   = ($content_layout === 'double') ? 'col-lg-6' : 'col-lg-7';
            ?>

            <div class="content <?php echo esc_attr($content_col_class); ?>">
                <div class="content-left">

                    <?php if ($content_layout === 'double') : ?>

                        <?php if (!empty($content_top)) : ?>
                            <div class="content-top">
                                <?php echo $content_top; ?>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo $content_left; ?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $content_right; ?>
                            </div>
                        </div>

                    <?php else : ?>
                        <?php echo $content_left; ?>
                    <?php endif; ?>

                    <?php if (
                        !empty($comb_btn_1['title']) ||
                        !empty($comb_btn_2['title'])
                    ) : ?>
                        <div class="btns">

                            <?php if (!empty($comb_btn_1['url']) && !empty($comb_btn_1['title'])) : ?>
                                <div class="default-btn default-btn-one">
                                    <a href="<?php echo esc_url($comb_btn_1['url']); ?>"
                                    class="link-btn"
                                    <?php echo !empty($comb_btn_1['target'])
                                        ? 'target="' . esc_attr($comb_btn_1['target']) . '" rel="noopener noreferrer"'
                                        : ''; ?>>
                                        <?php echo esc_html($comb_btn_1['title']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($comb_btn_2['url']) && !empty($comb_btn_2['title'])) : ?>
                                <div class="default-btn default-btn-two">
                                    <a href="<?php echo esc_url($comb_btn_2['url']); ?>"
                                    class="link-btn"
                                    <?php echo !empty($comb_btn_2['target'])
                                        ? 'target="' . esc_attr($comb_btn_2['target']) . '" rel="noopener noreferrer"'
                                        : ''; ?>>
                                        <?php echo esc_html($comb_btn_2['title']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="img <?php echo esc_attr($image_col_class); ?>">
                <img src="<?php echo esc_url($image); ?>"
                    alt=""
                    loading="lazy"
                    <?php if ( !empty($img_position) ) : ?>
                        style="object-position: <?php echo esc_attr($img_position); ?>;"
                    <?php endif; ?>>
            </div>

        </div>
    </div>
    <?php endif; ?>

     <?php $has_left_content =
            !empty($block_fields['title_up']) ||
            !empty($block_fields['title_downside']);
        $has_right_content =
            !empty($block_fields['upside-right-content']) ||
            !empty($comb_btn_1_1['title']) ||
            !empty($comb_btn_2_2['title']);
        $show_section = $has_left_content || $has_right_content;
    ?>
   <?php if ( $show_section ) : ?>

    <!-- TITLE + CONTENT ROW -->
    <div class="title-w-content-row">
        <div class="container">
            <div class="title-content-wrapper">

                <div class="title-wrapper-leftside col-lg-7">
                    <?php if (!empty($block_fields['title_up'])): ?>
                        <div class="title-leftside-up">
                            <?php echo $block_fields['title_up']; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($block_fields['title_downside'])): ?>
                        <div class="title-leftside-down">
                            <?php echo $block_fields['title_downside']; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="content-wrapper-rightside col-lg-5">
                    <?php if (!empty($block_fields['upside-right-content'])): ?>
                        <?php echo $block_fields['upside-right-content']; ?>
                    <?php endif; ?>

                    <?php if (
                        !empty($comb_btn_1_1['title']) ||
                        !empty($comb_btn_2_2['title'])
                    ) : ?>
                        <div class="btns">

                            <?php if ( ! empty($comb_btn_1_1['url']) && ! empty($comb_btn_1_1['title']) ) : ?>
                                <div class="default-btn default-btn-one">
                                    <a href="<?php echo esc_url($comb_btn_1_1['url']); ?>"
                                    class="link-btn"
                                    <?php echo ! empty($comb_btn_1_1['target'])
                                        ? 'target="' . esc_attr($comb_btn_1_1['target']) . '" rel="noopener noreferrer"'
                                        : ''; ?>>
                                        <?php echo esc_html($comb_btn_1_1['title']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty($comb_btn_2_2['url']) && ! empty($comb_btn_2_2['title']) ) : ?>
                                <div class="default-btn default-btn-two">
                                    <a href="<?php echo esc_url($comb_btn_2_2['url']); ?>"
                                    class="link-btn"
                                    <?php echo ! empty($comb_btn_2_2['target'])
                                        ? 'target="' . esc_attr($comb_btn_2_2['target']) . '" rel="noopener noreferrer"'
                                        : ''; ?>>
                                        <?php echo esc_html($comb_btn_2_2['title']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
    <?php endif; ?>


    <?php
    $img_position2 = $block_fields['background_position_desktop2'] ?? '';
    if ( wp_is_mobile() && !empty($block_fields['background_position_mobile2']) ) {
        $img_position2 = $block_fields['background_position_mobile2'];
    }
    ?>
    <?php if ( ! empty($block_fields['image_bg']) ) : ?> 
    <!-- BACKGROUND IMAGE ROW --> 
    <div class="bg-row"> 
        <div class="container"> 
            <div class="img"> 
                <img src="<?php echo esc_url($block_fields['image_bg']); ?>"
                    alt=""
                    loading="lazy"
                    <?php if ( !empty($img_position2) ) : ?>
                        style="object-position: <?php echo esc_attr($img_position2); ?>;"
                    <?php endif; ?>>
            </div> 
        </div> 
    </div> 
    <?php endif; ?>

</section>
<?php endif; ?>
