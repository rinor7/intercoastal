<?php
$block_fields = get_field('block-image-and-content-comb-rev') ?: [];
$comb_btn_1 = $block_fields['comb_btn_1'] ?? [];
$comb_btn_2 = $block_fields['comb_btn_2'] ?? [];
if (! ($block_fields['disable_section'] ?? false) ): ?>
<section class="block-image-and-content-comb-rev">

     <div class="title-row">
        <div class="container">
            <?php
                $title_upside = $block_fields['title_upside'] ?? '';
                $title_down = $block_fields['title_down'] ?? '';
                $txt_right = $block_fields['txt-right'] ?? '';
                $left_filled = ! empty($title_upside) || ! empty($title_down);
                $right_filled = ! empty($txt_right);
                $title_wrapper_class = ($left_filled && $right_filled) ? 'title-row-wrapper two-cols' : 'title-row-wrapper single-col';
            ?>
            <div class="<?php echo esc_attr($title_wrapper_class); ?>">
                <div class="title-left">
                    <div class="title-left-upside"><?php echo ( get_field('block-image-and-content-comb-rev')['title_upside'] );?></div>
                    <div class="title-left-downside"><?php echo ( get_field('block-image-and-content-comb-rev')['title_down'] );?></div>
                </div>
                <?php if ($right_filled): ?>
                <div class="title-right">
                    <?php echo ( get_field('block-image-and-content-comb-rev')['txt-right'] );?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="txt-image-row">
        <div class="container">
            <div class="img col-lg-7">
                <img src="<?php echo ( get_field('block-image-and-content-comb-rev')['image'] );?>" alt="Background"
                    loading=“lazy”>
            </div>
            <div class="content col-lg-5">
                <div class="content-left">
                    <div class="content-wrapper">
                        <div class="up-title"><?php echo ( get_field('block-image-and-content-comb-rev')['content-upside1'] );?></div>
                        <div class="middle-title"><?php echo ( get_field('block-image-and-content-comb-rev')['content-upside2'] );?></div>
                        <div class="down-title"><?php echo ( get_field('block-image-and-content-comb-rev')['content-upside3'] );?></div>
                    </div>
                    <div class="btns">
                        <?php if ( ! empty($comb_btn_1['url']) && ! empty($comb_btn_1['title']) ): ?>
                            <div class="default-btn default-btn-one">
                                <a href="<?php echo esc_url($comb_btn_1['url']); ?>"
                                class="link-btn"
                                <?php echo !empty($comb_btn_1['target']) ? 'target="' . esc_attr($comb_btn_1['target']) . '" rel="noopener noreferrer"' : ''; ?>>
                                    <?php echo esc_html($comb_btn_1['title']); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty($comb_btn_2['url']) && ! empty($comb_btn_2['title']) ): ?>
                            <div class="default-btn default-btn-two">
                                <a href="<?php echo esc_url($comb_btn_2['url']); ?>"
                                class="link-btn"
                                <?php echo !empty($comb_btn_2['target']) ? 'target="' . esc_attr($comb_btn_2['target']) . '" rel="noopener noreferrer"' : ''; ?>>
                                    <?php echo esc_html($comb_btn_2['title']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
</section>
<?php endif; ?>