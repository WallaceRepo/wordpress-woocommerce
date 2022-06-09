<footer class="c-post__footer">
    <?php 
        if(has_category()) {
            echo '<div class ="c-post__cats">';
            /* translators: used between categories */
            $cats_list = get_the_category_list(esc_html(', ', 'TheFertileValley' ));
            /* translators: used between categories list */
            printf(esc_html__( 'Filed Under: %s', 'TheFertileValley'), $cats_list);
            echo "</div>";
        }

        if(has_tag()){
            echo '<div class="c-post__tags">';
            $tags_list = get_the_tag_list( '<ul><li>', '</li><li>', '</li></ul>');
            printf(esc_html__( 'Tagged With: %s', 'TheFertileValley'), $tags_list);
           // echo $tags_list;
            echo "</div>";
        }
    ?>
</footer>