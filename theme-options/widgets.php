<?php

function standard_widgets_init() {
	register_sidebar(
		array('name'          => esc_html__( 'Logo Header', 'intercoastal' ),
			'id'            => 'widget-1',
			'description'   => esc_html__( 'Add widgets here to appear in your site logo.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Logo Footer', 'intercoastal' ),
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
		array('name'          => esc_html__( 'Footer Contact', 'intercoastal' ),
			'id'            => 'footer-contact',
			'description'   => esc_html__( 'Add contact info widgets here to appear in the special footer contact area.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
	register_sidebar(
		array('name'          => esc_html__( 'Copyright Text', 'intercoastal' ),
			'id'            => 'copyright-text',
			'description'   => esc_html__( 'Add contact info widgets here to appear in the special footer contact area.', 'intercoastal' ),
			'before_widget' => '<div class="widget-wrapper">',
			'after_widget'  => '</div>',
			'before_title'  => '<span class="widget-title">',
			'after_title'   => '</span>',)
	);
}
add_action( 'widgets_init', 'standard_widgets_init' );