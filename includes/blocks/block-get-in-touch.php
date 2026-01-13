<?php
        // Options-only contact section: left content from options, right is a widget area
        $footer_contact_content = get_field('footer_contact_content', 'option');

        // Respect an options-level disable switch. If true, skip rendering entirely.
        $footer_contact_disable = get_field('footer_contact_disable', 'option');
        if ( $footer_contact_disable ) {
            return;
        }
    ?>

    <?php if ( $footer_contact_content || is_active_sidebar('footer-contact') ): ?>
        <section class="footer-contact-section">
            <div class="container">
                <div class="row footer-contact-inner">
                    <div class="col-lg-8 footer-contact-left">
                        <?php if ( $footer_contact_content ): ?>
                            <?php echo wp_kses_post( $footer_contact_content ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4 footer-contact-right">
                        <?php if ( is_active_sidebar('footer-contact') ): ?>
                            <?php dynamic_sidebar('footer-contact'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>