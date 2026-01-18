<?php

// //create ACF field with type Text and name icon to add icons on nav item, same for image
// function my_wp_nav_menu_objects($items, $args) {
//     foreach ($items as &$item) {
//         $icon = get_field('icon', $item);
// 		$custom_text_field = get_post_meta($item->ID, 'custom_text_field', true);
//         $image_image_url = get_field('image-nav', $item);
//         if ($icon) { // Add font-awesome icon
//             $item->title .= ' <i class="fab ' . $icon . '"></i>';
//         }
// 		// if ($custom_text_field) { // Add custom text field
//         //     $item->title .= ' <span class="custom-text-menu-item">' . esc_html($custom_text_field) . '</span>';
//         // }
//         if ($image_image_url) {// Add image style - svg is not supported
//             $item->title .= ' <div style="background-image: url(' . esc_url($image_image_url) . ');" class="image-on-menu-item"></div>';
//         }
//     }
//     return $items;
// }
// add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);


class Mega_Menu_Walker extends Walker_Nav_Menu {

    private $mega_items   = [];
    private $current_mega = null;
    private $is_mobile;

    public function __construct() {
        $this->is_mobile = wp_is_mobile();
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

        $is_mega = in_array( 'is-mega', (array) $item->classes );

        /*
         |--------------------------------------------------------------------------
         | MOBILE: hide all top-level items
         |--------------------------------------------------------------------------
         */
        if ( $this->is_mobile && $depth === 0 ) {
            // Do nothing – submenu will be rendered later
            if ( $is_mega ) {
                $this->current_mega = $item;
                $this->mega_items   = [];
            }
            return;
        }

        /*
         |--------------------------------------------------------------------------
         | DESKTOP: Mega menu parent
         |--------------------------------------------------------------------------
         */
        if ( $depth === 0 && $is_mega ) {

            $this->current_mega = $item;
            $this->mega_items   = [];

            $output .= '<li class="menu-item is-mega">';
            $output .= '<a href="' . esc_url( $item->url ?: '#' ) . '">';
            $output .= esc_html( $item->title );
            $output .= '</a>';

            return;
        }

        /*
         |--------------------------------------------------------------------------
         | Collect mega submenu items
         |--------------------------------------------------------------------------
         */
        if ( $depth === 1 && $this->current_mega ) {
            $this->mega_items[] = $item;
            return;
        }

        /*
         |--------------------------------------------------------------------------
         | Normal desktop items
         |--------------------------------------------------------------------------
         */
        if ( $depth === 0 ) {
            $output .= '<li class="menu-item">';
            $output .= '<a href="' . esc_url( $item->url ) . '">';
            $output .= esc_html( $item->title );
            $output .= '</a>';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {

        /*
         |--------------------------------------------------------------------------
         | MOBILE: render ONLY mega submenu
         |--------------------------------------------------------------------------
         */
        if ( $this->is_mobile && $depth === 0 && $this->current_mega && $item->ID === $this->current_mega->ID ) {

           $output .= '<div class="mobile-mega-menu">';

            $output .= '<ul class="mobile-mega-submenu">';
            foreach ( $this->mega_items as $sub ) {
                $output .= '<li>';
                $output .= '<a href="' . esc_url( $sub->url ) . '">';
                $output .= esc_html( $sub->title );
                $output .= '</a>';
                $output .= '</li>';
            }
            $output .= '</ul>';

            // Mobile image
            $image = function_exists('get_field') ? get_field('mega_image', $item->ID) : null;
            if ( $image ) {
                $output .= '<div class="mobile-mega-image">';
                $output .= '<img src="' . esc_url( $image['url'] ) . '" alt="">';
                $output .= '</div>';
            }

            $output .= '</div>';

            $this->current_mega = null;
            return;
        }

        /*
         |--------------------------------------------------------------------------
         | DESKTOP: close mega menu
         |--------------------------------------------------------------------------
         */
        if ( ! $this->is_mobile && $depth === 0 && $this->current_mega && $item->ID === $this->current_mega->ID ) {

            $total = count( $this->mega_items );
            $half  = ceil( $total / 2 );
            $cols  = array_chunk( $this->mega_items, $half );

            $output .= '<div class="mega-menu">';
            $output .= '<div class="mega-menu-inner">';
            $output .= '<div class="mega-cols">';

            foreach ( $cols as $col ) {
                $output .= '<ul class="mega-col">';
                foreach ( $col as $sub ) {
                    $output .= '<li><a href="' . esc_url( $sub->url ) . '">' . esc_html( $sub->title ) . '</a></li>';
                }
                $output .= '</ul>';
            }

            $output .= '</div>';

            // Image column
            $image = function_exists( 'get_field' ) ? get_field( 'mega_image', $item->ID ) : null;
            if ( $image ) {
                $output .= '<div class="mega-image">';
                $output .= '<img src="' . esc_url( $image['url'] ) . '" alt="">';
                $output .= '</div>';
            }

            $output .= '</div></div>';
            $output .= '</li>';

            $this->current_mega = null;
            return;
        }

        /*
         |--------------------------------------------------------------------------
         | Close normal desktop items
         |--------------------------------------------------------------------------
         */
        if ( ! $this->is_mobile && $depth === 0 ) {
            $output .= '</li>';
        }
    }
}

