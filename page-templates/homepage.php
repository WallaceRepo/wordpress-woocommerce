<?php 
/*
Template Name: Home Page
*/
?>
 <?php get_template_part('template-parts/header/header-home'); ?>
<div class="p-container u-margin-bottom-40">
   <div class="p-row">
     <div class="p-row__column p-row__column--span-12 p-row__column--span-12@medium">
       <?php get_template_part( 'loop', 'page' ); ?>
   </div>
   </div>
 </div>
<?php get_footer(); ?>