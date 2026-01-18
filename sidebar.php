<?php
// here is added get_sidebar
if ( is_active_sidebar( 'footer-1' ) ) : ?>
	<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</aside><!-- #secondary -->
<?php endif; ?>