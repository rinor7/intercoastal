<?php
/**
 * @package Intercoastal
 */
?>

<?php $classes = implode( ' ', get_body_class() ); ?>
<footer id="footer-site" class="site-footer <?php echo esc_attr( $classes ); ?>">

    <?php if ( is_page_template('template-about-us.php')) : ?>

        

    <?php endif; ?>

    <?php if (
        !is_page_template('template-general.php') &&
        !is_page_template('template-miscellaneius.php') &&
        !is_page_template('template-about-us-.php') &&
        !is_page_template('template-real-estate.php') && 
        !is_page_template('template-privacy.php')) : ?>

        <?php get_template_part('includes/blocks/block-testimonials', null, array()); ?>

    <?php endif; ?>



    <?php if ( !is_page_template('template-general.php') && !is_page_template('template-miscellaneius.php')) : ?>

        <?php get_template_part('includes/blocks/block-register', null, array()); ?>

    <?php endif; ?>

    <?php if ( is_page_template('template-general.php') || is_page_template('template-miscellaneius.php')) : ?>
        
        <?php get_template_part('includes/blocks/block-get-in-touch', null, array()); ?>

    <?php endif; ?>

    
    <?php
    $page_id = get_queried_object_id();
    $disable_section = get_field('disable_section', $page_id);
    if ( $disable_section ) {
        return;
    }
    $footer_image = get_field('image_bg', $page_id);
    $option_footer_image = get_field('footer_default_bg', 'option');
    if ( $footer_image && ! empty( $footer_image['url'] ) ) {
        $image_url    = $footer_image['url'];
        $image_source = 'page';
    } else {
        $image_url    = $option_footer_image;
        $image_source = 'default';
    }
    $bg_overlay_color = get_field('background_overlay_color', $page_id) ?: '#000000a1';
    ?>
    <?php if ( $image_url ): ?>
    <section class="footer-custom-section footer-bg--<?php echo esc_attr( $image_source ); ?>"
        style="background-image: url('<?php echo esc_url( $image_url ); ?>');">

        <span class="footer-overlay"
            style="background-color: <?php echo esc_attr( $bg_overlay_color ); ?>;">
        </span>

    </section>
    <?php endif; ?>

    <?php if ( is_page_template('template-miscellaneius.php')) : ?>
        
        <?php get_template_part('includes/blocks/block-reach-out', null, array()); ?>

    <?php endif; ?>

    <div class="site-footer-columns">
        <div class="container" id="footer">
            <div class="row">
                <div class="col-lg-12 footer-0 footer-cols">
                    <?php if(is_active_sidebar('newsletter') ) { ?>
                    <ul>
                        <?php dynamic_sidebar('newsletter');?>
                    </ul>
                    <?php } ?>
                </div>
                <div class="col-lg-3 footer-1 footer-cols">
                    <a aria-label="logo" class="logo_footer" href="<?php echo esc_url(home_url('/')); ?>">
                        <ul>
                            <?php dynamic_sidebar('footer-1');?>
                        </ul>
                    </a>
                </div>
                <div class="col-lg-9 footer-2 footer-cols">
                    <?php wp_nav_menu(
                        array(
                        'theme_location'    => 'menu-2',
                        'menu_id'        => 'secondary-menu',
                        'menu_class'        => 'footer-nav',
                        )
                        ); 
                    ?>
                </div>
            </div>

            <div class="copyrights">
                <div class="leftside">
                    <div class="copyright"><span>&copy;<?php echo date(' Y  ') ;?></span><?php if(is_active_sidebar('copyright-text') ) { ?><ul><?php dynamic_sidebar('copyright-text');?></ul><?php } ?></div>
                    <?php wp_nav_menu(
                        array(
                        'theme_location'    => 'menu-3',
                        'menu_id'        => 'copyright-menu',
                        'menu_class'        => 'copyright-nav',
                        )
                        ); 
                    ?>
                </div>
                <div class="rightside">
                    <?php if(is_active_sidebar('socials') ) { ?>
                    <ul>
                        <?php dynamic_sidebar('socials');?>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</footer>

</div><!-- #page -->


<?php wp_footer(); ?>
</body>

</html>