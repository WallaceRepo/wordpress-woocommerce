<?php get_header(); ?>   
        <header class="category-page-header">
            <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            <?php the_archive_title('<h1>', '</h1>'); ?>
            <?php the_archive_description('<p>', '</p>'); 
            ?>
        </header>
 <?php
 $term = get_queried_object();
 if(!($term->parent == 0)) {
   $children = get_terms( $term->taxonomy, array(
        'parent'    => $term->term_id,
        'hide_empty' => true ) );
     if($children){
       $args = array(
        'post_type'   => 'post',
        'post_status' => 'publish',
        'cat'         => $term->term_id
         );  
        } else {
       $args = array(
         'post_type'   => 'post',
         'post_status' => 'publish',
         'cat'         => $term->cat_ID
               );
        }
   } 
else {
       $args = array(
         'post_status' => 'publish',
               );
 } 
 ?>
<section class= "mason"> 
 <div class="grid">  
  <?php
    $scheduled = new WP_Query( $args );
   
    if ( $scheduled->have_posts() ) :  ?>
     
        <?php while( $scheduled->have_posts() ) : $scheduled->the_post() ?>
         <div class="grid-item">
            <a id = "card" class = "c_cont" href = "<?php the_permalink() ?>">
              <figure>
                <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
                  <img src="<?php echo $url ?>" />
                    <figcaption>
                      <?php echo '<p>'. get_the_category( $id )[0]->name .'</p>'; ?>
                        <h6><?php the_title(); ?></h6>
                    </figcaption>
              </figure>
            </a>
        </div>
     
      <?php endwhile ?>
       <?php wp_reset_postdata(); ?>
   </div>
</section>     
      <?php else : 
       ?> <!-- Content If No Posts -->
        
        <?php
        get_template_part('template-parts/post/content', 'none');   
     
      endif;


  //var_dump($term);
 
 
 





get_footer(); ?>