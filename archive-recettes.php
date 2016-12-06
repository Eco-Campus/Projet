<?php get_header(); ?>

    <main>
        <div class="taille">
            <div class="grille">
                <?php
                while (have_posts()): the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3>
                        <?php the_post_thumbnail(); ?></a>
                    <?php
                endwhile
                ?>
            </div>
        </div>
    </main>
<?php get_footer(); ?>