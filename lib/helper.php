<?php if(!function_exists('TheFertileValley_post_meta')) {
     /* translators: %s: Post date */
    function TheFertileValley_post_meta() {
//     printf(esc_html__('%s', 'TheFertileValley'),
//     '<a href="' .  esc_url(get_permalink())  . '"><time datetime="' . esc_attr(get_the_date('c')) .
//      '">' . esc_html(get_the_date()) . '</time></a>'
// );
//post last update or posted date
$u_time = get_the_time('U');
$u_modified_time = get_the_modified_time('U');
if ($u_modified_time >= $u_time + 86400) {
esc_html_e( 'Last updated: ', 'TheFertileValley' );
the_modified_time('M j, Y'); }
else {esc_html_e( 'Published on ', 'TheFertileValley' ); the_time('F jS, Y');} 
    // translators: %s: Post Author 
  printf(
        esc_html__(' By %s', 'TheFertileValley'),
'<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'
  ); 
 }
}
function TheFertileValley_readmore_link(){
        /* translators: %s: Post title */
      echo '<a class="c-post__readmore" href="' . esc_url(get_the_permalink()) . '" title="' . the_title_attribute(['echo' => false]) . '">';
      printf(
      wp_kses(
         __(' [ Read more... <span class="u-screen-reader-text"> About %s</span>]', 'TheFertileValley'),
       [
             'span' => [
                   'class' => []
             ]
       ] 
       
       ),
         get_the_title()
      );
    echo '</a>';
 }
 // This is for USEr ROLES chapter how to allow deleting post to certain user.
function TheFertileValley_delete_post() {
        $url = add_query_arg([
          'action'=> 'TheFertileValley_delete_post', 
          'post' => get_the_ID(),
          'nonce'=> wp_create_nonce('TheFertileValley_deletepost' . get_the_ID() )], home_url());

    if(current_user_can('delete_post', get_the_ID())) {
          //var_dump(current_user_can('delete_posts', get_the_ID()));
          return "<a href='" .esc_url($url) . "'>" . esc_html__('Delete Post','TheFertileValley' ) . "</a>";
    }
}
function TheFertileValley_meta($id, $key, $default) {
  $value = get_post_meta( $id, $key, true);
    if(!$value && $default) {
      return $default;
    }
     return $value;
}
 // Create excerpt link to change length of post 
function TheFertileValley_excerpt_length ($length){
  return 35;
}
  add_filter('excerpt_length', 'TheFertileValley_excerpt_length');
?>