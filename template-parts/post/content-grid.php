<li class="grid-item">
    <a id = "card" class = "c_cont" href = "<?php the_permalink() ?>">
        <figure>
        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
        <img src="<?php echo $url ?>" />
        <figcaption>
            <div class = "post-categories">
                <div>
                    <?php echo '<p>'. get_the_category( $id )[0]->name .'</p>'; ?></div>
                </div>
            <h6><?php the_title(); ?></h6>
            <!--?php the_date(); ?-->
        </figcaption>
        </figure>
    </a>
</li>