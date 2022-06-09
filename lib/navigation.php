<?php
function TheFertileValley_register_menus(){
     register_nav_menus( array(
         'main-menu' => esc_html__('Main Menu', 'TheFertileValley'),
         'footer-menu' => esc_html__('Footer Menu', 'TheFertileValley'),
         'mobile-menu' => esc_html__('Mobile Menu', 'TheFertileValley'),
         'social' => esc_html__('Social Menu', 'TheFertileValley')
     ));
}
add_action( 'init', 'TheFertileValley_register_menus' );
function TheFertileValley_aria_hasdropdown($atts, $item, $args){
    if($args -> theme_location == 'main-menu'){
        if(in_array('menu-item-has-children', $item->classes)){
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'TheFertileValley_aria_hasdropdown', 10, 3);
function TheFertileValley_submenu_button($dir = 'down', $title){
    $caret =  TheFertileValley_get_svg( array( 'icon' => $dir ) );
    $button = '<button class="menu-button">';
    $button .= '<span class = "u-screen-reader-text menu-button-show">' . sprintf(esc_html__('Show %s 
    submenu', 'TheFertileValley'), $title) . '</span>';
    $button .= '<span aria-hidden="true" class = "u-screen-reader-text menu-button-hide">' . sprintf(esc_html__('Hide %s 
    submenu', 'TheFertileValley'), $title) . '</span>';
    //$button .= '<i class="fa fa-angle-' . $dir . '" aria-hidden="true"></i>';
    $button .=  $caret;
    $button .='</button>';
    return $button;
}
function TheFertileValley_submenu_icons( $title ) {
    $icon = '<svg class = "submenu-svg"></svg>';
    $icon .= '<span class = "submenu-icon-text">' . $title . '</span>';
    return $icon;
}
/* Adding ICONS TO MENU => WP provides filters in order to filter each navigation */
function TheFertileValley_dropdown_icon( $title, $item, $args, $depth) {
 if($args->theme_location == 'main-menu') { 
    $submenu_icons =TheFertileValley_mega_submenu_icons();
   if(in_array('menu-item-has-children', $item->classes)) {
        if($depth == 0) {
              $title .= TheFertileValley_submenu_button('down', $title);
        } else { 
                 //$title .= TheFertileValley_submenu_button('right', $title);
               // $title = TheFertileValley_submenu_icons( $title);
               // $submenu_icons =TheFertileValley_mega_submenu_icons();
               foreach ( $submenu_icons as $attr => $value ) {
              // var_dump($title);
                    if ($title === $attr  ) {
              $svgtag = TheFertileValley_get_svg( array( 'icon' => esc_attr( $value ) ) );    
                  $title =  $svgtag . '<span class = "title-' . $value . '">' . $title . '</span>';           
                        }
                    }
                }
            }
       }
 return $title;
}
add_filter('nav_menu_item_title', 'TheFertileValley_dropdown_icon', 10, 4 );
?>