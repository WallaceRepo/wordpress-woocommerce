<?php $inline_styles_selectors = array (
    'a' => array(
        'color' => 'TheFertileValley_accent_colour',
    ),
    ':focus' => array(
        'outlinecolor' => 'TheFertileValley_accent_colour',
    ),
    '.c-post.sticky' => array(
        'border-left-color' => 'TheFertileValley_accent_colour',
    ),
    ' button, input[type=submit], .header-nav .menu > .menu-item:not(.mega) .sub-menu .menu-item:hover > a ' => array(
        'background-color' => 'TheFertileValley_accent_colour',
    )
 );
 $inline_styles = "";
 foreach ($inline_styles_selectors as $selector => $props){
     $inline_styles .= "{$selector} {";
        foreach ($props as $prop => $value ) {
            $inline_styles .= "{$prop}: " . sanitize_hex_color(get_theme_mod($value, '#20ddae')) . ";";
        }
     $inline_styles .="}";
 }
 //ABOVE foreach just creates below css string .
// $accent_colour = sanitize_hex_color(get_theme_mod( 'TheFertileValley_accent_colour', '#20ddae'));
// $inline_styles = "
//     a {
//         color: {$accent_colour}
//     }
//     :focus {
//         outline-color: {$accent_colour}
//     }
//     .c-post.sticky {
//         border-left-color: {$accent_colour}
//     }
//     button, input[type=submit], .header-nav .menu > .menu-item:not(.mega) .sub-menu .menu-item:hover > a {
//         background-color: {$accent_colour}
//     }
 
// "; ?>