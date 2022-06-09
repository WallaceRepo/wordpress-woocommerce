<?php 
   $footer_bg = TheFertileValley_sanitize_footer_bg(get_theme_mod('TheFertileValley_footer_bg', 'dark'));
    $site_info = get_theme_mod('TheFertileValley_site_info', '');
?>
<?php 
    if($site_info){
?>
<div class="c-site-info c-site-info--<?php echo $footer_bg; ?>">
             <div class = "divider-shape divider-shape-top">
                    <?php echo TheFertileValley_get_svg( array( 'icon' => 'divider' ) ); ?>
             </div>
    <div class="o-container">
        <div class="o-row">
            <div class="o-row__column o-row__column--span-12">
         
              <!-- <span class = "terms-policy">Terms of Use|Privacy Policy|FAQ</span> -->
        
            
               <?php
                    $allowed = array('a' => array(
                        'href' => array(),
                        'title' => array()
                    ));
                    echo wp_kses($site_info, $allowed); 
                    
               ?> 
          
            </div>
        </div>
    </div>
 </div>
    <?php } ?>
 