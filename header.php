<!DOCTYPE html>
<html <?php language_attributes();  ?>>
<head>
    <meta charset= "<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <script src="https://kit.fontawesome.com/2abcfe5c1f.js" crossorigin="anonymous"></script> -->
</head>
<body <?php body_class(); ?>>
    <a class="u-skip-link" href="#content"><?php esc_attr_e('Skip to content', 'TheFertileValley' ); ?></a>
       <?php 
           $header_bg = get_theme_mod('TheFertileValley_header_image');
        ?>
   <header role="banner" class="u-margin-bottom-40" >
      <img class = "backimage" src="<?php echo( wp_get_attachment_url($header_bg) ); ?>" />
        <div class="c-header o-container u-flex u-align-center u-align-middle">
           
                    <div class="c-header__logo">
                        <?php if(has_custom_logo()) {
                            the_custom_logo(); ?>
                            <a class="c-header__blogname" href="<?php echo esc_url(home_url('/')); ?>"><?php
                            esc_html(bloginfo('name')); ?>
                            </a>
                        <?php  } else { ?>
                            <a class="c-header__blogname" href="<?php echo esc_url(home_url('/')); ?>"><?php
                            esc_html(bloginfo('name')); ?></a>
                        <?php } ?>
                        
                   </div>
   </div>
        <div class = "c-navigation">
            <div class= "h-container">
                <nav class="header-nav" role="navigation" aria-label="<?php esc_html_e( 'Main Navigation', 'TheFertileValley') ?>">
                    <button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
                        <?php
                        echo TheFertileValley_get_svg( array( 'icon' => 'bars' ) );
                        echo TheFertileValley_get_svg( array( 'icon' => 'close' ) );
                        _e( 'Menu', 'TheFertileValley' );
                        ?>
                    </button>
                 <?php wp_nav_menu( array(
                        'theme_location' => 'main-menu',
                        'menu_class' => 'menu u-align-center u-align-middle')); ?>
                  <div class = "shopping-cart-total">
                    <a href ="<?php echo esc_url(wc_get_page_permalink('cart')); ?>" title="<?php _e( 'View your shopping cart','TheFertileValley');?>">           
                       <!-- <i class="fas fa-shopping-cart" aria-hidden="true"></i>  -->
                       <?php echo TheFertileValley_get_svg( array( 'icon' => 'basket' ) ); ?>
                       <div class="total-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
                    </a>
                  </div>
                  <?php  get_search_form(true); ?>
                </nav>   
            </div>
        </div>
    </header>
 <div id="content">