<?php 

function menu_setup() {
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Main Header Menu', 'intercoastal' ),
			'menu-2' => esc_html__( 'Footer Main Menu', 'intercoastal' ),
			'menu-3' => esc_html__( 'Footer Copyright Menu', 'intercoastal' ),
		)
	);
}
add_action( 'after_setup_theme', 'menu_setup' );