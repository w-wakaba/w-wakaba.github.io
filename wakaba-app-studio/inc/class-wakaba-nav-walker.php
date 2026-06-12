<?php
class Wakaba_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= '<a href="' . $item->url . '" class="nav-link">' . $item->title . '</a>';
    }
}

class Wakaba_Mobile_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= '<a href="' . $item->url . '" class="mobile-nav-link" onclick="toggleMobileMenu()">' . $item->title . '</a>';
    }
} 