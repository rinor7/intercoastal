<?php
/* Template Name: About Us Template */
get_header();
?>

<main id="primary" class="site-main site-about-us-template">

<?php get_template_part('includes/blocks/block-banner-all', null, array()); ?>


<?php
$page_id = get_the_ID(); // Current page ID

$cta_disable   = get_field('simple-section-with-buttons_disable', $page_id);
$cta_icon      = get_field('simple-section-with-buttons_icon', $page_id); // <-- new icon field
$cta_uptitle   = get_field('simple-section-with-buttons_uptitle', $page_id);
$cta_heading   = get_field('simple-section-with-buttons_heading', $page_id);
$cta_text      = get_field('simple-section-with-buttons_text', $page_id);
$cta_button_1  = get_field('simple-section-with-buttons_button', $page_id);
$cta_button_2  = get_field('simple-section-with-buttons_button_2', $page_id);

if ( $cta_disable ) {
    return;
}

if ( $cta_heading || $cta_text || $cta_button_1 || $cta_button_2 || $cta_icon ) :
?>
<section class="simple-section-with-buttons">
    <div class="container">
        <div class="simple-section-with-buttons__inner">

            <?php if ( $cta_icon ) : ?>
                <div class="simple-section-with-buttons__icon">
                    <img 
                        src="<?php echo esc_url( $cta_icon['url'] ); ?>" 
                        alt="<?php echo esc_attr( $cta_icon['alt'] ); ?>" 
                    />
                </div>
            <?php endif; ?>

            <?php if ( $cta_uptitle ) : ?>
                <h2 class="simple-section-with-buttons__uptitle">
                    <?php echo esc_html( $cta_uptitle ); ?>
                </h2>
            <?php endif; ?>
            
            <?php if ( $cta_heading ) : ?>
                <h2 class="simple-section-with-buttons__title">
                    <?php echo esc_html( $cta_heading ); ?>
                </h2>
            <?php endif; ?>

            <?php if ( $cta_text ) : ?>
                <div class="simple-section-with-buttons__text">
                    <?php echo wp_kses_post( $cta_text ); ?>
                </div>
            <?php endif; ?>

            <div class="btns">
                <?php if ( $cta_button_1 ) : ?>
                    <div class="default-btn default-btn-one">
                        <a 
                            href="<?php echo esc_url( $cta_button_1['url'] ); ?>"
                            class="link-btn"
                            target="<?php echo esc_attr( $cta_button_1['target'] ?: '_self' ); ?>"
                        >
                            <?php echo esc_html( $cta_button_1['title'] ); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if ( $cta_button_2 ) : ?>
                    <div class="default-btn default-btn-two">
                        <a 
                            href="<?php echo esc_url( $cta_button_2['url'] ); ?>"
                            class="link-btn"
                            target="<?php echo esc_attr( $cta_button_2['target'] ?: '_self' ); ?>"
                        >
                            <?php echo esc_html( $cta_button_2['title'] ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>


<?php get_template_part('includes/blocks/block-image-and-content-comb', null, array()); ?>


<?php get_template_part('includes/blocks/block-team', null, array()); ?>


</main>

<?php get_footer(); ?>