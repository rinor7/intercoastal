<?php
get_header();
?>

	<main id="primary" class="site-default site-page-default">

		<?php get_template_part('includes/blocks/block-banner-all', null, array()); ?>

		<?php get_template_part('includes/blocks/block-image-and-content-comb', null, array()); ?>

		<?php get_template_part('includes/blocks/block-features-four', null, array()); ?>

		<?php
		$page_content = get_the_content();
		if ( trim( $page_content ) !== '' ) : ?>
			<div class="container site-page-content">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>

	</main><!-- #main -->


<?php get_footer(); ?>