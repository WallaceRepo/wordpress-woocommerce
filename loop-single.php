<?php if(have_posts()){ ?>
    <?php while(have_posts()) { ?>
            <?php the_post(); ?>
            <?php get_template_part('template-parts/post/content', get_post_format() ); ?>
            <?php
                  // checkbox on admin customiser parts single blog option
            // if(get_theme_mod( 'TheFertileValley_display_author_info', true )) {
            //     get_template_part('template-parts/single/author' );
            // }
            ?>
            <?php // this calls parent theme's file
                   get_template_part('template-parts/single/singlenavigation' );
                  //child theme's singlenavigation.php file is being called
                 //get_template_part('template-parts/singlenavigation' );
                  ?>
            <?php 
              // checkbox on admin customiser parts single blog option
            //  if(get_theme_mod( 'TheFertileValley_display_comment_box', true )) {
            //         if( comments_open() || get_comments_number()) {
            //             comments_template();
            //         }
            //  }
            ?>
        <?php }   ?>
     <?php } else {    ?>
    <?php get_template_part('template-parts/post/content', 'none'); ?>
<?php }  ?>