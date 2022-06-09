<header class="c-post__header">
    <?php if( is_single()){ ?>
        
        <div class ="header__category">
        <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>           
            <!--?php $cat = get_the_category(); echo $cat[0]->cat_name; ?-->
        </div>
            <h1 class="c-post__single-title">
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
            </h1>
        <?php } else { ?>
            <h1 class="c-post__title">
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
            </h1>
        <?php } ?>
            <div class="c-post__meta">
                    <?php  
                    
                    // posted by author name
                     TheFertileValley_post_meta();
                   ?>
                
            </div>


<?php
/* Jetpack Share buttons */
if ( function_exists( 'sharing_display' ) ) {
    sharing_display( '', true );
  }
 
if ( class_exists( 'Jetpack_Likes' ) ) {
    $custom_likes = new Jetpack_Likes;
    echo $custom_likes->post_likes( '' );
} ?>
</header>