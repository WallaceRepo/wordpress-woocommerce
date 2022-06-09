<?php function TheFertileValley_customize_register( $wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('', array(

             'settings' => array('blogname'),
             'selector'=> '.c-header__blogname',
             'container_inclusive'=> false,
             'render_callback'=> function(){
                bloginfo('name');
             }
       ));
  /*###################### Single Blog Page SETTINGS #################*/
       $wp_customize->add_section('TheFertileValley_single_blog_options', array(
        'title' => esc_html__('Single Blog Options', 'TheFertileValley'),
        'description' => esc_html__('You can change single blog options from here.', 'TheFertileValley' ),
        'active_callback' => 'TheFertileValley_show_single_blog_section'
      ));
      $wp_customize->add_setting('TheFertileValley_display_author_info', array(
            'default' => true,
            'transport' => 'postMessage',
            'sanitize_callback' => 'TheFertileValley_sanitize_checkbox'
      ));
      $wp_customize->add_control('TheFertileValley_display_author_info', array(
          'type' => 'checkbox',
          'label'=> esc_html__('Show Author Info', 'TheFertileValley'),
          'section' => 'TheFertileValley_single_blog_options'
      ));
      function TheFertileValley_show_single_blog_section(){
           global $post;
           return is_single() && $post->post_type === 'post';
      }
      function TheFertileValley_sanitize_checkbox( $checked){
          return (isset($checked) && $checked === true) ? true : false;
      }
        /* Single Blog Page SETTINGS -- adding checkbox for comment box to show or not*/
      $wp_customize->add_setting('TheFertileValley_display_comment_box', array(
            'default' => true,
            'transport' => 'postMessage',
            'sanitize_callback' => 'TheFertileValley_sanitize_comment_checkbox'
      ));
      function TheFertileValley_sanitize_comment_checkbox( $clicked){
        return (isset($clicked) && $clicked === true) ? true : false;
    }
      $wp_customize->add_control('TheFertileValley_display_comment_box', array(
        'type' => 'checkbox',
        'label'=> esc_html__('Show Comment Box', 'TheFertileValley'),
        'section' => 'TheFertileValley_single_blog_options'
      ));
   /*######################GENERAL SETTINGS #################*/
         $wp_customize->add_section('TheFertileValley_general_options', array(
            'title' => esc_html__('General Options', 'TheFertileValley'),
            'description' => esc_html__('You can change general options from here.', 'TheFertileValley' )
          ));
        $wp_customize -> add_setting('TheFertileValley_accent_colour', array(
               'default'=>'#20ddae',
               'transport' => 'postMessage',
               'sanitize_callback' => 'sanitize_hex_color'
         ));
         $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'TheFertileValley_accent_colour', array(
            'label' => __( 'Accent Color', 'TheFertileValley' ),
            'section' => 'TheFertileValley_general_options',
          ) ) );
        $wp_customize->add_setting( 'TheFertileValley_portfolio_slug', array(
            'default'           => 'portfolio',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'TheFertileValley_portfolio_slug', array(
            'type'    => 'text',
            'label'    => esc_html__( 'Portfolio Slug', 'TheFertileValley' ),
            'description' => esc_html__( 'Will appear in the archive url', 'TheFertileValley' ),
            'section'  => 'TheFertileValley_general_options',
        ));
  /*###################### AUTHOR IMAGE SETTINGS  #################*/
    $wp_customize->add_section('TheFertileValley_author_image_options', array(
        'title' => esc_html__('Author Image Options', 'TheFertileValley'),
        'description' => esc_html__('You can change author image options from here.', 'TheFertileValley' ),
        'priority' => 30,
    ));
    $wp_customize->add_setting('TheFertileValley_author_image', array(
        'default' => '',
        'sanitize_callback' => 'absint',
       
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'TheFertileValley_author_image', array(
        'label' => __( 'Author Image', 'TheFertileValley' ),
        'section' => 'TheFertileValley_author_image_options',
        'mime_type' => 'image',
    ) ) ); 
  /*###################### HEADER SETTINGS for BACKGROUND IMAGE  #################*/
       $wp_customize->add_section('TheFertileValley_header_options', array(
            'title' => esc_html__('Header Options', 'TheFertileValley'),
            'description' => esc_html__('You can change header options from here.', 'TheFertileValley' ),
            'priority' => 30,
        ));
        $wp_customize->add_setting('TheFertileValley_header_image', array(
            'default' => '',
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'TheFertileValley_header_image', array(
            'label' => __( 'Header Image', 'TheFertileValley' ),
            'section' => 'TheFertileValley_header_options',
            'mime_type' => 'image',
         ) ) );
       /*###################### FOOTER SETTINGS #################*/
    $wp_customize->selective_refresh->add_partial('TheFertileValley_footer_partial', array(
       'settings' => array('TheFertileValley_site_info', 'TheFertileValley_footer_bg'),
        'selector'=> '#footer',
        'container_inclusive'=> false,
        'render_callback'=> function(){
            get_template_part('template-parts/footer/widgets');
            get_template_part('template-parts/footer/info');
        }
      ));
    $wp_customize->add_section('TheFertileValley_footer_options', array(
        'title' => esc_html__('Footer Options', 'TheFertileValley'),
        'description' => esc_html__('You can change footer options from here.', 'TheFertileValley' ),
        'priority' => 105,
    ));
   $wp_customize->add_setting('TheFertileValley_site_info', array(
            'default' => '',
            'sanitize_callback' => 'TheFertileValley_sanitize_site_info',
            'transport' => 'postMessage'
    ));
   $wp_customize->add_control('TheFertileValley_site_info', array(
            'type' => 'text',
            'label' => esc_html__( 'Site Info', 'TheFertileValley'),
            'section' => 'TheFertileValley_footer_options'
    ));
    $wp_customize->add_setting('TheFertileValley_footer_bg', array(
        'default' => 'dark',
        'transport' => 'postMessage', 
        'sanitize_callback'=> 'TheFertileValley_sanitize_footer_bg'
    ));
    $wp_customize->add_control('TheFertileValley_footer_bg', array(
        'type'=> 'select',
        'label' => esc_html__('Footer Background', 'TheFertileValley'),
        'choices' => array(
            'light' => esc_html__('Light', 'TheFertileValley'),
            'dark' => esc_html__('Dark', 'TheFertileValley'),
        ),
        'section' => 'TheFertileValley_footer_options'
    ));
    $wp_customize->add_setting('TheFertileValley_footer_layout', array(
        'default' => '3,3,3,3',
        'transport' => 'postMessage', 
        'sanitize_callback'=> 'sanitize_text_field',
        'validate_callback' => 'TheFertileValley_validate_footer_layout'
    ));
    $wp_customize->add_control('TheFertileValley_footer_layout', array(
        'type' => 'text',
        'label' => esc_html__( 'Footer_Layout', 'TheFertileValley'),
        'section' => 'TheFertileValley_footer_options'
));
}
add_action('customize_register','TheFertileValley_customize_register');
function TheFertileValley_validate_footer_layout( $validity, $value) {
    if(!preg_match('/^([1-9]|1[012])(,([1-9]|1[012]))*$/', $value)) {
        $validity->add('invalid_footer_layout', esc_html__( 'Footer layout is invalid', 'TheFertileValley' ));
    }
    return $validity;
}
function TheFertileValley_sanitize_footer_bg($input){
    $valid = array('light', 'dark');
    if( in_array($input, $valid, true)){
        return $input;
    }
    return 'dark';
}
function TheFertileValley_sanitize_site_info($input ){
    $allowed = array('a' => array(
        'href' => array(),
        'title' => array()
    ));
    return wp_kses($input, $allowed);
} ?>