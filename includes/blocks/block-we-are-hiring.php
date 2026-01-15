<?php
// Simple CTA section (Options)
$cta_disable = get_field('cta_simple_disable', 'option');
$cta_heading = get_field('cta_simple_heading', 'option');
$cta_text    = get_field('cta_simple_text', 'option');
$cta_button  = get_field('cta_simple_button', 'option');


if ( $cta_disable ) {
    return;
}

if ( $cta_heading || $cta_text || $cta_button ) :
?>
<section class="simple-cta">
    <div class="container">
        <div class="simple-cta__inner">
            
            <?php if ( $cta_heading ) : ?>
                <h2 class="simple-cta__title">
                    <?php echo esc_html( $cta_heading ); ?>
                </h2>
            <?php endif; ?>

            <?php if ( $cta_text ) : ?>
                <div class="simple-cta__text">
                    <?php echo wp_kses_post( $cta_text ); ?>
                </div>
            <?php endif; ?>

            <?php if ( $cta_button ) : ?>
                <a 
                    href="<?php echo esc_url( $cta_button['url'] ); ?>"
                    class="link-btn"
                    target="<?php echo esc_attr( $cta_button['target'] ?: '_self' ); ?>"
                >
                    <?php echo esc_html( $cta_button['title'] ); ?>
                </a>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php endif; ?>
