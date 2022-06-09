<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage TheFertileValley
 * @since 1.0
 * @version 1.0
 */
 get_header(); ?>
<div class="o-container u-margin-bottom-40">
    <div class="o-row">
        <div class="o-row__column o-row__column--span-12 o-row__column--span-9@medium">
        <main role="main">
                <?php get_template_part('loop','index'); ?>
        </main>
        </div>
        <!--?php if(is_active_sidebar('primary-sidebar')) { ?-->
        <div class="o-row__column o-row__column--span-12 o-row__column--span-3@medium">
                <?php get_sidebar(); ?>
        </div>
              <!--?php} ?-->
    
    </div>
 </div>
<?php get_footer(); ?>