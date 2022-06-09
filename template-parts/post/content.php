<article <?php post_class('c-post u-margin-bottom-20'); ?>>
   
    <div class="c-post__inner">
       <?php get_template_part('template-parts/post/header'); ?>
        <?php if(get_the_post_thumbnail() !== '') { ?>
            <div class="c-post__thumbnail">
                <?php the_post_thumbnail('TheFertileValley-blog-image'); ?>
            </div>
        <?php } ?>

        <?php if( is_single()){ ?>
            <div class="c-post__content">
                <?php the_content();
                    wp_link_pages();
                ?>
            </div>
        <?php } else { ?>
            <div class="c-post__excerpt">
            <p><?php echo get_the_excerpt(); ?><span> ...</span><?php if( !is_single()){ TheFertileValley_readmore_link(); } ?></p>
            </div>
                      
                <!--Adding Category and tags *************************************** -->

         <?php if ( is_object_in_taxonomy( get_post_type(), 'category' ) ) : // Hide category text when not supported ?>
				<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'TheFertileValley' ) );
				if ( $categories_list ) :
					?>
			<span class="cat-links">
					<?php
					printf( __( '<span class="%1$s">Category: </span> %2$s', 'TheFertileValley' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
					$show_sep = true;
					?>
			</span>
				<?php endif; // End if categories ?>
			<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'category' ) ?>

			
			<?php if ( is_object_in_taxonomy( get_post_type(), 'post_tag' ) ) : // Hide tag text when not supported ?>
				<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'TheFertileValley' ) );
				if ( $tags_list ) :
					if ( $show_sep ) :
						?>
			<span class="sep"> | </span>
					<?php endif; // End if $show_sep ?>
			<span class="tag-links">
					<?php
					printf( __( '<span class="%1$s">Tagged with </span> %2$s', 'TheFertileValley' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
					$show_sep = true;
					?>
			</span>
				<?php endif; // End if $tags_list ?>
			<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'post_tag' ) ?>



        <?php } ?>

        <?php if( is_single()){ ?> 
            <?php get_template_part('template-parts/post/footer'); ?>
               
        <?php } ?>
        
        
        <!--?php TheFertileValley_readmore_link(); ?-->
        <!--?php echo TheFertileValley_delete_post() ?-->
        <!--?php var_dump(get_post_meta(get_the_ID(), 'price')); ?-->
    </div>
</article>