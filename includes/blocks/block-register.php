<?php
        $page_id = get_queried_object_id();
        /**
         * PAGE / TEMPLATE FIELDS (override)
         */
        $page_disable = get_field('register_disable', $page_id);
        $page_content = get_field('content', $page_id);
        $page_btn_1   = get_field('register_button_1', $page_id);
        $page_btn_2   = get_field('register_button_2', $page_id);

        /**
         * GLOBAL (OPTIONS) FIELDS
         */
        $opt_disable = get_field('register_disable', 'option');
        $opt_content = get_field('content', 'option');
        $opt_btn_1   = get_field('register_button_1', 'option');
        $opt_btn_2   = get_field('register_button_2', 'option');

        /**
         * Detect override
         */
        $is_override = (
            $page_disable !== null ||
            ! empty($page_content) ||
            ! empty($page_btn_1['url']) ||
            ! empty($page_btn_2['url'])
        );
        /**
         * FINAL VALUES (page overrides option)
         */
        $register_disable = ($page_disable !== null) ? $page_disable : $opt_disable;
        $register_content = ! empty($page_content) ? $page_content : $opt_content;
        $register_btn_1   = ! empty($page_btn_1['url']) ? $page_btn_1 : $opt_btn_1;
        $register_btn_2   = ! empty($page_btn_2['url']) ? $page_btn_2 : $opt_btn_2;
    ?>
    <?php if ( ! $register_disable && ( $register_content || $register_btn_1 || $register_btn_2 ) ): ?>
        <section class="register-section<?php echo $is_override ? ' register-section--override' : ''; ?>">
            <div class="container">
                <div class="register-inner">

                    <div class="register-left">
                        <?php if ( $register_content ): ?>
                            <?php echo wp_kses_post( $register_content ); ?>
                        <?php endif; ?>
                    </div>

                    <div class="register-right">

                        <?php if ( ! empty($register_btn_1['url']) && ! empty($register_btn_1['title']) ): ?>
                            <div class="default-btn default-btn-one">
                                <a href="<?php echo esc_url($register_btn_1['url']); ?>"
                                class="link-btn"
                                <?php echo !empty($register_btn_1['target']) ? 'target="' . esc_attr($register_btn_1['target']) . '" rel="noopener noreferrer"' : ''; ?>>
                                    <?php echo esc_html($register_btn_1['title']); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty($register_btn_2['url']) && ! empty($register_btn_2['title']) ): ?>
                            <div class="default-btn default-btn-two">
                                <a href="<?php echo esc_url($register_btn_2['url']); ?>"
                                class="link-btn"
                                <?php echo !empty($register_btn_2['target']) ? 'target="' . esc_attr($register_btn_2['target']) . '" rel="noopener noreferrer"' : ''; ?>>
                                    <?php echo esc_html($register_btn_2['title']); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </section>
    <?php endif; ?>