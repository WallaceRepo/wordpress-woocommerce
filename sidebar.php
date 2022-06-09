<aside role= "complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'TheFertileValley' ); ?>">
  <section class="c-sidebar-widget u-margin-bottom-20">
    <?php 
             /*Adding SOCIAL MENU to THEME */
        if ( has_nav_menu( 'social' ) ) : ?>
        <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'social menu', 'TheFertileValley' ); ?>">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'social',
                    'menu_class'     => 'social-links-menu',
                    'depth'          => 1,
                    'link_before'    => '<span class="screen-reader-text">',
                    'link_after'     => '</span>' . TheFertileValley_get_svg( array( 'icon' => 'chain' ) ),
                ) );
            ?>
        </nav><!-- .social-navigation -->
    <?php endif;
    ?></section>
   
    <?php 
    
    if ( is_cart() || is_checkout()) {
      dynamic_sidebar('shop-sidebar'); 
    } else {
      dynamic_sidebar('primary-sidebar');  
      dynamic_sidebar('shop-sidebar'); 
    }
  ?>
</aside>