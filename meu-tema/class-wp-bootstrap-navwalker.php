<?php
class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="dropdown-menu">';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';
        
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $output .= '<li class="' . esc_attr($class_names) . '">';

        $attributes = ' class="nav-link"';
        if (in_array('dropdown', $classes)) {
            $attributes = ' class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false"';
        }

        $item_output = $args->before;
        $item_output .= '<a href="' . esc_attr($item->url) . '"' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}