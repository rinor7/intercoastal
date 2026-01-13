<?php

function standard_widgets_init() {
	register_sidebar(
		array('name'          => esc_html__( 'Logo', 'intercoastal' ),
			'id'            => 'widget-1',
			'description'   => esc_html__( 'Add widgets here to appear in your site logo.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
	// register_sidebar(
	// 	array('name'          => esc_html__( 'Widget 2', 'standard' ),
	// 		'id'            => 'widget-2',
	// 		'before_widget' => '<div class="widget-wrapper">',
	// 		'after_widget'  => '</div>',
	// 		'before_title'  => '<span class="widget-title">',
	// 		'after_title'   => '</span>',)
	// ); 
	// register_sidebar(
	// 	array('name'          => esc_html__( 'Widget 3', 'standard' ),
	// 		'id'            => 'widget-3',
	// 		'before_widget' => '<div class="widget-wrapper">',
	// 		'after_widget'  => '</div>',
	// 		'before_title'  => '<span class="widget-title">',
	// 		'after_title'   => '</span>',)
	// );
	// register_sidebar(
	// 	array('name'          => esc_html__( 'Widget 4', 'standard' ),
	// 		'id'            => 'widget-4',
	// 		'before_widget' => '<div class="widget-wrapper">',
	// 		'after_widget'  => '</div>',
	// 		'before_title'  => '<span class="widget-title">',
	// 		'after_title'   => '</span>',)
	// );
	// register_sidebar(
	// 	array('name'          => esc_html__( 'Widget 5', 'standard' ),
	// 		'id'            => 'widget-5',
	// 		'before_widget' => '<div class="widget-wrapper">',
	// 		'after_widget'  => '</div>',
	// 		'before_title'  => '<span class="widget-title">',
	// 		'after_title'   => '</span>',)
	// );
	register_sidebar(
		array('name'          => esc_html__( 'Widget 6', 'intercoastal' ),
			'id'            => 'widget-6',
			'description'   => esc_html__( 'Add widgets here to appear in your site footer.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Footer Column 1', 'intercoastal' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here to appear in your site footer.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Newsletter', 'intercoastal' ),
			'id'            => 'newsletter',
			'description'   => esc_html__( 'Add widgets here to appear in your site footer.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Social Media', 'intercoastal' ),
			'id'            => 'socials',
			'description'   => esc_html__( 'Add widgets here to appear in your site footer.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Footer Column 4', 'intercoastal' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here to appear in your site footer.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Footer Contact', 'intercoastal' ),
			'id'            => 'footer-contact',
			'description'   => esc_html__( 'Add contact info widgets here to appear in the special footer contact area.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Contact Form 1', 'intercoastal' ),
			'id'            => 'cf-1',
			'description'   => esc_html__( 'Add widgets here to appear in your site CF7.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
}
add_action( 'widgets_init', 'standard_widgets_init' );