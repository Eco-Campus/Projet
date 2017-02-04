<!DOCTYPE html>
<html xmlns:og=http://ogp.me/ns# lang=fr>
<head>
    <meta property=og:title content="Le site officiel des Paniers de l'Association Eco-Campus."/>
    <meta property=og:type content=website/>
    <meta property=og:url content=https://mmi-projet.pu-pm.univ-fcomte.fr/projets-co1617/projet1617_10/index.html/>
    <meta property=og:image
          content=https://mmi-projet.pu-pm.univ-fcomte.fr/projets-co1617/projet1617_10/image-interface/ecocampus.png/>
    <meta property=og:site_name content="Les Paniers Garnis d'Eco-Campus !"/>
    <meta charset=UTF-8>
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta name=theme-color content=#BAE468>
    <meta name=msapplication-navbutton-color content=#BAE468>
    <meta name=apple-mobile-web-app-status-bar-style content=#BAE468>
    <title>Eco Campus</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:400,700|Lato|Noto+Serif:400,400i"
          rel=stylesheet>
    <meta name=keywords
          content="eco campus, panier garnis, panier légumes, belfort légumes, belfort panier légumes, belfort panier garni légumes, belfort panier legumes, belfort panier garni legumes, panier légumes eco campus">
    <?php wp_head(); ?>
</head>
<body id=index>
<header>
    <nav id=mobile>
        <span onclick=openNav()><img
                src=https://mmi-projet.pu-pm.univ-fcomte.fr/projets-co1617/projet1617_10/wp/wp-content/uploads/2016/11/hamburger.png
                alt=Hamburger></span>
        <div id=mySidenav class=sidenav>
            <a href=javascript:void(0) class=closebtn onclick=closeNav()>&times;</a>
            <a href="<?php echo get_permalink(get_page_by_title('Boutique')); ?>">Boutique</a>
            <a href="<?php echo get_permalink(get_page_by_title('Recettes')); ?>">Recettes</a>
            <a href="<?php echo get_permalink(get_page_by_title('À Propos')); ?>">À propos</a>
            <a href="<?php echo get_permalink(get_page_by_title('F.A.Q.')); ?>">F.A.Q.</a>
            <a href="<?php echo get_permalink(get_page_by_title('Panier')); ?>">Ma commande <img
                    src=https://mmi-projet.pu-pm.univ-fcomte.fr/projets-co1617/projet1617_10/wp/wp-content/uploads/2016/11/shopping_white.png
                    alt=Panier></a>


            <?php if (is_user_logged_in()): ?>
                <a href="<?php echo get_permalink(get_page_by_title('Mon Compte')); ?>">Mon compte</a>
            <?php else: ?>
                <a href="<?php echo get_permalink(get_page_by_title('Mon Compte')); ?>">Connexion</a>
            <?php endif ?>


            <a href="<?php echo get_permalink(get_page_by_title('Mentions légales')); ?>">Mentions légales</a>
        </div>
        <a href="<?php echo esc_url(home_url()); ?>"><img
                src=https://mmi-projet.pu-pm.univ-fcomte.fr/projets-co1617/projet1617_10/wp/wp-content/uploads/2016/11/logo_eco.png
                alt="Logo Ecocampus"></a>
    </nav>

    <nav id=ordi>
        <div class=conteneur960>
            <a href="<?php echo esc_url(home_url()); ?>"><img
                    src="https://mmi-projet.pu-pm.univ-fcomte.fr/projets-co1617/projet1617_10/wp/wp-content/uploads/2016/11/logo_eco.png"
                    alt="Logo de l'association Eco-Campus" title="Logo de l'association Eco-Campus"></a>
            <div class="menu">
                <a href="<?php echo esc_url(home_url()); ?>">Accueil</a>
                <a href="<?php echo get_permalink (get_page_by_title('Boutique')); ?>">Boutique</a>
                <a href="<?php echo get_permalink(get_page_by_title('Recettes')); ?>">Recettes</a>
                <a href="<?php echo get_permalink(get_page_by_title('À Propos')); ?>">À Propos</a>
            </div>
            <div class="menu">
                <a href="<?php echo get_permalink(get_page_by_title('Panier')); ?>">Commande</a>

                <?php if (is_user_logged_in()): ?>
                    <a href="<?php echo get_permalink(get_page_by_title('Mon Compte')); ?>">Mon compte</a>
                <?php else: ?>
                    <a href="<?php echo get_permalink(get_page_by_title('Mon Compte')); ?>">Connexion</a>
                <?php endif ?>
            </div>
            <a href="https://www.facebook.com/Eco-Campus-LAssociation-1725197324371735/?fref=nf&pnref=story"><img
                    src=https://mmi-projet.pu-pm.univ-fcomte.fr/projets-co1617/projet1617_10/wp/wp-content/uploads/2016/11/ecocampus.png
                    alt="Eco-Campus FB"></a>
        </div>
    </nav>
    <div class=titre>
        <div class=titrage>
            <h1>Les paniers qui vous<br>donnent envie de bien manger !</h1>
            <a class="bouton" href="<?php echo get_permalink (get_page_by_title('Boutique')); ?>">Découvrez nos paniers</a>
        </div>
    </div>
</header>

<main>
    <div class="taille">


<?php

while (have_posts()): the_post();
    ?>
    <?php the_content(); ?>
    <?php
endwhile
?>
</div>
</main>
<?php get_footer(); ?>