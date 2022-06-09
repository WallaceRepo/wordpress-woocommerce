<?php 
require_once( 'lib/customize.php');
require_once('lib/helper.php');
require_once('lib/enqueue-assets.php');
require_once('lib/sidebars.php');
require_once( 'lib/theme-support.php');
require_once( 'lib/navigation.php');
require_once( 'lib/comment-callback.php');
require_once( 'lib/most-recent-widget.php');
require_once( 'lib/icon-functions.php');
require_once( 'lib/breadcrumb.php');
function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_filter('register_post_type_args', 'TheFertileValley_filter_portfolio', 10, 2);
function TheFertileValley_filter_portfolio($args, $post_type) {
    if($post_type === 'TheFertileValley_portfolio') {
        $args['rewrite']['slug'] = get_theme_mod('TheFertileValley_portfolio_slug', 'portfolio');
    }
    return $args;
}
add_action('customize_save_after', 'TheFertileValley_customize_save_after');
add_action('init', 'TheFertileValley_flush_rewrite', 99999);
function TheFertileValley_flush_rewrite() {
      if(get_theme_mod('TheFertileValley_flush_flag', false)) {
          flush_rewrite_rules();
          set_theme_mod('TheFertileValley_flush_flag', false);
      }
}
function TheFertileValley_customize_save_after() {
    $old = get_post_type_object('TheFertileValley_portfolio')->rewrite['slug'];
    $new = get_theme_mod('TheFertileValley_postfolio_slug', 'portfolio');
    if( $old !== $new){
          set_theme_mod('TheFertileValley_flush_flag', true);
      }
}
if(!isset($content_width)) {
    $content_width = 800;
}
function TheFertileValley_content_width() {
    global $content_width;
    global $post;
    if(is_single() && $post->post_type === 'post') {
        $layout = TheFertileValley_meta( $post->ID, '_TheFertileValley_post_layout', 'full' );
        $sidebar = is_active_sidebar( 'primary-sidebar' );
        if($layout === 'sidebar' && !$sidebar) {
            $layout = 'full';
        }
        $content_width = $layout === 'full' ? 800 : 738;
    }
}
add_action('template_redirect', 'TheFertileValley_content_width');
function TheFertileValley_image_sizes( $sizes, $size, $image_src, $image_meta, $attachement_id) {
    $width = $size[0];
    global $content_width;
    global $post;
    $layout = 'full';
    if(is_single() && $post->post_type === 'post') {
        $layout = TheFertileValley_meta( $post->ID, '_TheFertileValley_post_layout', 'full' );
        $sidebar = is_active_sidebar( 'primary-sidebar' );
        if($layout === 'sidebar' && !$sidebar) {
            $layout = 'full';
        }
    }
    if( $content_width <= $width){
        if($layout === 'full') {
            $sizes = '(max-width: 862px) calc(100vw - 1.25rem*2 - 0,625rem*2 - 2px), ' . $content_width . 'px';
        } elseif ($layout === 'sidebar') {
            $sizes = '(max-width:640px) calc(100vw - 1.25rem*2 - 0.62rem*2 - 2px), (max-widthL 1200px) calc(100vw - 33.3333vw - 0.625rem*2 -1.25rem*2 - 0.625rem*2 - 2px), ' . $content_width . 'px';
        }
    } else {
        $sizes = '(max-width: ' . ($width + 62) . 'px) calc(100vw - 1.25rem*2 - 0.62rem*2 - 2px), ' . $width . 'px';
    }
    return $sizes;
}
add_filter('wp_calculate_image_sizes', 'TheFertileValley_image_sizes', 10, 5);
function TheFertileValley_handle_delete_post() {
    if( isset($_GET['action']) && $_GET['action'] === 'TheFertileValley_delete_post' ) {
      if(!isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], 'TheFertileValley_deletepost' . $_GET['post'] )) {
            return;
        }
         $post_id = isset($_GET['post']) ? $_GET['post'] : null;
         $post = get_post((int) ($post_id));
            if(empty($post)) {
                return;
            }
            if(!current_user_can('delete_post', $post_id)) {
                return;
            }
          wp_trash_post($post_id);
          wp_safe_redirect( home_url());
          die;
    }
}
add_action('init', 'TheFertileValley_handle_delete_post');
     /****************************************************** 
                 POPULAR POST Adding
      ******************************************************* */
     function my_popular_posts($post_id) {
        $count_key = 'popular_posts';
        $count = get_post_meta($post_id, $count_key, true);
        if ($count == '') {
            $count = 0;
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        } else {
            $count++;
            update_post_meta($post_id, $count_key, $count);
        }
    }
    function my_track_posts($post_id) {
        if (!is_single()) return;
        if (empty($post_id)) {
            global $post;
            $post_id = $post->ID;
        }
        my_popular_posts($post_id);
    }
    add_action('wp_head', 'my_track_posts');
   function my_add_views_column($defaults) {
        $defaults['post_views'] = 'View Count';
        return $defaults;
    }
    add_filter( 'manage_posts_columns', 'my_add_views_column');
   function my_display_views($column_name) {
        if ( $column_name === 'post_views'){
            echo (int) get_post_meta( get_the_ID(), 'popular_posts', true );
        }
    }
    add_action('manage_posts_custom_column', 'my_display_views', 5, 2);
  /****************************************************** 
                Showing popular post of admin post column to widget area
      ******************************************************* 
    /**
 * Adds Popular_post_Widget widget.
 */
class Popular_post_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'popular_post_widget', // Base ID
			esc_html__( 'TRENDING NOW', 'TheFertileValley' ), // Name
			array( 'description' => esc_html__( 'Displays the 5 most popular posts', 'TheFertileValley' ), ) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        // Here is custom query for posts with popular_post to be pulled from database.
            $query_args = array (
                'post_type' => 'post',
                'posts_per_page' => 5,
                'meta_key' => 'popular_posts',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts' => true
            );
      // The Query
        $the_query = new WP_Query( $query_args );
          // The Loop
        if ( $the_query->have_posts() ) {
            echo '<ul>';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                ?>
                <li class = "widget__list">
                    <a class = "cont_thumbnail" href="<?php the_permalink(); ?>">
                        <div class ="widget__category">
                           <?php $cat = get_the_category(); echo $cat[0]->cat_name; ?>
                         
                        </div>
                        <div class="widget__title">             
                            <?php echo esc_html( get_the_title() ); ?>
                        </div>  
                    </a>
                </li> <?php
            } 
            echo '</ul>';
            /* Restore original Post Data */
            wp_reset_postdata();
        } else {
            // no posts found
        }
       // Restore original Post Data
	    wp_reset_postdata();
    }
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Popular Posts', 'TheFertileValley' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'TheFertileValley' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}
} // class Foo_Widget
//This sample widget can then be registered in the 'widgets_init' hook:
// register Foo_Widget widget
function register_popular_posts_widget() {
    register_widget( 'popular_post_widget' );
}
add_action( 'widgets_init', 'register_popular_posts_widget' );
/****************************************************** 
                 WOOCOMMERCE SUPPORT Adding
      ******************************************************* */
function TheFertileValley_add_woocommerce_support() {
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => 800,
            'single_image_width'    => 800,
            'gallery_thumbnail_image_width' => 800,
    
            'product_grid'          => array(
                'default_rows'    => 6,
                'min_rows'        => 6,
                'max_rows'        => 12,
                'default_columns' => 4,
                'min_columns'     => 2,
                'max_columns'     => 5,
            ),
        ) );
    }
add_action( 'after_setup_theme', 'TheFertileValley_add_woocommerce_support' );
/****************************************************** 
        ADD GOOGLE ANALYTICS JS Scripts to the <HEAD></HEAD> part of website 
*********************************************************************************/
function google_analytics_head_script() { ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144554356-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-144554356-1');
</script>  
<?php }
add_action( 'wp_head', 'google_analytics_head_script' );
/****************************************************** 
        ADD GOOGLE AdSense JS Scripts to the <HEAD></HEAD> part of website 
*********************************************************************************/
//	<!-- Your HTML goes here -->
//<!-- Global site tag (gtag.js) - Google Analytics -->
function google_adsense_head_script() { ?>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
   (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3992841176647518",
    enable_page_level_ads: true
  }); 
</script>
    <?php }
    add_action( 'wp_head', 'google_adsense_head_script' );
/**
 * Show cart contents / total Ajax
 After adding the code, update the file and refresh the frontend of site. You will see the cart count and total in the header. 
 */
function iconic_cart_count_fragments( $fragments ) {
    $fragments['div.total-cart-count'] = '<div class="total-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>';
    return $fragments;
}
 add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

/**Remove shop page title - WooCommerce Shop
 ** compatible    WooCommerce 3.5.7 */
 add_filter( 'woocommerce_show_page_title', 'bbloomer_hide_shop_page_title' );
 function bbloomer_hide_shop_page_title( $title ) {
    if ( is_shop() ) $title = false;
    return $title;
 }
 
 /* Change Product Thumbnails to side columns */
 add_filter ( 'storefront_product_thumbnail_columns', 'bbloomer_change_gallery_columns_storefront' );
 
 function bbloomer_change_gallery_columns_storefront() {
      return 1; 
 }
/*Move the Sharing and Like buttons */
 function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 add_action( 'loop_start', 'jptweak_remove_share' );




