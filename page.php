<?php get_header(); ?>
<div class="o-container u-margin-bottom-40">
    <div class="o-row">
        <div class="o-row__column o-row__column--span-12 o-row__column--span-9@medium">
            <main role="main">
              <?php get_template_part( 'loop', 'page' ); ?>
            </main>
        </div>
        <div class="o-row__column o-row__column--span-12 o-row__column--span-3@medium">
            <?php get_sidebar(); ?>
        </div>
        
    </div>
 </div>
<?php get_footer(); ?>