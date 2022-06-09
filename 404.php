<?php get_header(); ?>
<div class="o-container u-margin-bottom-40">
    <div class="o-row">
        <div class="o-row__column o-row__column--span-12">
            <main role="main">
                <p class= "content-none"><?php esc_html_e('0 results found for your search. Please try another search term', 'TheFertileValley') ?></p>
                
                <?php get_search_form(); ?>
            </main>
        </div>
    </div>
</div>
<?php get_footer(); ?>