<?php get_header(); ?>

<main>
    <div class="erreur">
            <img
                src="https://mmi-projet.pu-pm.univ-fcomte.fr/projets-co1617/projet1617_10/wp/wp-content/uploads/2016/11/logo_eco.png"
                alt="Logo Ecocampus">
            <p>Nous sommes désolé, la page que vous avez demandée n’a pas été trouvée.</p>
            <p>Il se peut que le lien que vous avez utilisé soit rompu ou que vous ayez tapé l’adresse (URL)
                incorrectement.</p>
            <a class='bouton' href="<?php echo esc_url(home_url()); ?>">Retourner sur à l'accueil</a>
    </div>
</main>
<?php get_footer(); ?>
