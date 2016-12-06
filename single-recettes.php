<?php get_header(); ?>
<main>
    <div class="taille">
        <?php
        while (have_posts()): the_post();
            ?>
            <?php the_post_thumbnail(); ?>
            <?php the_content(); ?>
<!--            --><?php //$custom_fields = get_post_custom(); ?>
            <?php
        endwhile
        ?>
    </div>
</main>

<?php get_footer(); ?>
