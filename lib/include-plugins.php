<?php require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'TheFertileValley_register_required_plugins' );
function TheFertileValley_register_required_plugins() {
    $plugin = array(
        array(
            'name' => 'TheFertileValley metaboxes',
            'slug' => 'TheFertileValley-metaboxes',
            'source'=> get_template_directory_uri() . '/lib/plugins/TheFertileValley-metaboxes.zip',
            'required'=> true,
            'version' => '1.0.0',
            'force_activation'=> false,
            'force_deactivation'=> false
        ),
        array(
            'name' => 'TheFertileValley post types',
            'slug' => 'TheFertileValley-post-types',
            'source'=> get_template_directory_uri() . '/lib/plugins/TheFertileValley-post-types.zip',
            'required'=> true,
            'version' => '1.0.0',
            'force_activation'=> false,
            'force_deactivation'=> false
        )
    );
    $config = array(
    );
     tgmpa($plugin, $config);
} ?>