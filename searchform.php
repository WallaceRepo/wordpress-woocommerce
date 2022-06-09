<div class = "search-icon-form">
<?php echo TheFertileValley_get_svg( array( 'icon' => 'search' ) ); ?>
</div> 
  <div id = "fullscreensearch">
    <div class= "search-close">X</div>   
      <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ) ?>">
  
        <label class="c-search-form__label">
       
           <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'TheFertileValley' ) 
           ?></span>
           <p>Hit enter to search</p>
           <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'TheFertileValley' )
           ?>" value="<?php echo esc_attr(get_search_query()) ?>" name="s" />
          </label>
      </form>
</div>