<?php function TheFertileValley_theme_support(){

    add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-list', 'comment-form', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('custom-logo', array(
        'height' => 200,
        'width' => 600,
        'flex-height' => true,
        'flex-width' => true
    ));
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ));
    add_theme_support('align-wide');
    add_image_size('TheFertileValley-blog-image', 1200, 0);
    add_theme_support('editor-styles');
    add_editor_style('dist/assets/css/editor.css');
     /* Removing html margin-top that localhost wordpress adds */
    add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
   
    add_theme_support( 'automatic-feed-links' );

}
add_action('after_setup_theme', 'TheFertileValley_theme_support');
?>