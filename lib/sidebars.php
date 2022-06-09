<?php /****************************************************** 
                 Registering Widget Area.
      ******************************************************* */
/***
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function TheFertileValley_sidebar_widgets(){
    register_sidebar(array(
        'id' => 'primary-sidebar',
        'name' => esc_html__('Primary Sidebar', 'TheFertileValley'),
        'description' => esc_html__('This sidebar appears in the blog posts page.','TheFertileValley'),
        'before_widget' => '<section id="%1$s" class="c-sidebar-widget u-margin-bottom-20 %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h5 class="widget-title">',
        'after_title'=> '</h5>'
    ));
}
$footer_layout = sanitize_text_field(get_theme_mod('TheFertileValley_footer_layout', '3,3,3,3'));
$footer_layout = preg_replace('/\s+/','', $footer_layout);
$columns = explode(',', $footer_layout); 
$footer_bg = TheFertileValley_sanitize_footer_bg(get_theme_mod('TheFertileValley_footer_bg', 'dark'));
$widget_theme = '';
 if($footer_bg == 'light'){
     $widget_theme = 'c-footer-widget--dark';
 } else {
    $widget_theme = 'c-footer-widget--light';
 }
 foreach($columns as $i => $column) {
    register_sidebar( array(
        'id' => 'footer-sidebar-' . ($i + 1),
        'name' => sprintf(esc_html__('Footer Widgets Column %s', 'TheFertileValley'), $i + 1),
        'desciption' => esc_html__('Footer Widgets', 'TheFertileValley' ),
        'before_widget' => '<section id="%1$s" class="c-footer-widget' . $widget_theme . ' %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h5>',
        'after_title'=> '</h5>'
    ));
 }
add_action('widgets_init', 'TheFertileValley_sidebar_widgets');
/****************************************************** 
                 Registering Widget Area for SHOP-Sidebar.
 ******************************************************* */
      /**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function TheFertileValley_shop_sidebar_widgets(){
    register_sidebar(array(
        'id' => 'shop-sidebar',
        'name' => esc_html__('Shop Sidebar', 'TheFertileValley'),
        'description' => esc_html__('This sidebar appears in the shop related page.','TheFertileValley'),
        'before_widget' => '<section id="%1$s" class="c-sidebar-widget u-margin-bottom-20 %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h5 class="widget-title">',
        'after_title'=> '</h5>'
    ));
}
add_action('widgets_init', 'TheFertileValley_shop_sidebar_widgets'); 
?>