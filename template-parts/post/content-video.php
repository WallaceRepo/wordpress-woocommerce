<?php 
    $content = apply_filters('the_content', get_the_content());
    $videos = get_media_embedded_in_content($content, array('video', 'object', 'embed', 'iframe'));
    //var_dump( $videos);
?>
<article <?php post_class('c-post u-margin-bottom-20'); ?>>
   
    <div class="c-post__inner">

        <?php if(get_the_post_thumbnail() !== '' && empty($videos) || is_single()) { ?>
            <div class="c-post__thumbnail">
                <?php the_post_thumbnail('TheFertileValley-blog-image'); ?>
            </div>
        <?php } ?>
        <?php  if( !is_single() && !empty($videos)){ ?>
            <div class="c-post__video">
                <?php if(strpos($videos[0], '<iframe') !== false) { ?>
                    <div class="u-responsive-video">
                        <?php } ?>
                        <?php echo $videos[0]; ?>
                        <?php if(strpos($videos[0], '<iframe') !== false) { ?>
                    </div>
                <?php } ?>
            </div>
       <?php } ?>

       <?php get_template_part('template-parts/post/header'); ?>

        <?php if( is_single()){ ?>
            <div class="c-post__content">
                <?php the_content();
                    wp_link_pages();
                ?>
            </div>
        <?php } else { ?>
            <div class="c-post__excerpt">
                <?php the_excerpt(); ?>
            </div>
        <?php } ?>

        <?php if( is_single()){ ?> 
            <?php get_template_part('template-parts/post/footer'); ?>
               
        <?php } ?>
        
        <?php if( !is_single()){ TheFertileValley_readmore_link(); } ?>
        <!--?php TheFertileValley_readmore_link(); ?-->
        <!--?php echo TheFertileValley_delete_post() ?-->
        <!--?php var_dump(get_post_meta(get_the_ID(), 'price')); ?-->
    </div>
</article>