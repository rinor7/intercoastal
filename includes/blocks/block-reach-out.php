<?php
    // Reach-out section: left WYSIWYG + widget, right CF7 shortcode (simple)
    $footer_reach_out_content       = get_field('footer_reach_out_content', 'option');
    $footer_reach_out_disable       = get_field('footer_reach_out_disable', 'option');
    $footer_reach_out_cf7_shortcode = get_field('footer_reach_out_cf7_shortcode', 'option');

    if ( $footer_reach_out_disable ) {
        return;
    }
?>

<?php if ( $footer_reach_out_content || is_active_sidebar('footer-contact') || $footer_reach_out_cf7_shortcode ): ?>
    <section class="footer-reach-out" aria-label="Reach Out" id="reach-out">
        <div class="container">
            <div class="row footer-contact-inner">
                <div class="col-lg-6 footer-contact-left">
                    <?php if ( $footer_reach_out_content ): ?>
                        <?php echo wp_kses_post( $footer_reach_out_content ); ?>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar('footer-contact') ): ?>
                        <div class="footer-contact-widget">
                            <?php dynamic_sidebar('footer-contact'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-6 footer-contact-right">
                    <?php if ( $footer_reach_out_cf7_shortcode ): ?>
                        <div class="footer-cf7-shortcode">
                            <?php echo do_shortcode( $footer_reach_out_cf7_shortcode ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>