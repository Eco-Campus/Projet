<?php get_header(); ?>

<?php
while ( have_posts() ): the_post();
    ?>
    <?php the_content(); ?>
    <?php
endwhile
?>
<?php $custom_fields = get_post_custom(); ?>
<!--<p><a href="--><?php //echo esc_url($custom_fields["projet"][0]) ?><!--">lien du projet</a></p>-->

<?php get_footer(); ?>
