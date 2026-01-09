<?php
/**
 * @package Base Theme
 */
?>

<footer id="footer-site" class="site-footer">
    <div class="site-footer-columns">
        <div class="container" id="foooter">
            <div class="row">
                <div class="col-lg-3 footer-1">
                    <a aria-label="logo" class="logo_footer" href="<?php echo esc_url(home_url('/')); ?>">
                        <ul>
                            <?php dynamic_sidebar('footer-1');?>
                        </ul>
                    </a>
                </div>
                <div class="col-lg-3 footer-2">
                    <ul>
                        <?php dynamic_sidebar('footer-2');?>
                    </ul>
                </div>
                <div class="col-lg-3 footer-3">
                    <ul>
                        <?php dynamic_sidebar('footer-3');?>
                    </ul>
                </div>
                <div class="col-lg-3 footer-4">
                    <ul>
                        <?php dynamic_sidebar('footer-4');?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="site-footer-copyrights">
        <div class="container">
            <p>&copy;<?php echo date(' Y  ') ;?>All rights Reserved. <a href="/">Base Theme</a> </p>
        </div>
    </div>
</footer>


</div><!-- #page -->


<?php wp_footer(); ?>
</body>

</html>