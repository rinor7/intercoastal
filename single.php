<?php
get_header(); 
?>

	<main id="primary" class="site-single single-page">

	<div class="intro">
		<img src="<?php the_post_thumbnail_url();?>" alt="">
	</div>
	
	<div class="container">
		<div class="content">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</div>
		

	</main><!-- #main -->



<?php get_footer(); ?>