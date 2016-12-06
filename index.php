<?php get_header(); ?>

<main>
    <div class="taille">
<?php
while (have_posts()): the_post();
    ?>
    <?php
     echo apply_filters('the_content',$wp_query->post->post_content);?>
    <?php
endwhile
?>
</div>
</main>
<?php get_footer(); ?>
