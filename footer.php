<footer>
    <div class="taille">
        <div class=ecocampus>
            <h3>Eco-Campus l'association</h3>
            <a href="https://www.facebook.com/Eco-Campus-LAssociation-1725197324371735/?fref=nf&pnref=story"><img
                    src=https://mmi-projet.pu-pm.univ-fcomte.fr/projets-co1617/projet1617_10/wp/wp-content/uploads/2016/11/ecocampus.png alt=EcoCampus_Logo></a>
            <p><span class=gras>"Eco-Campus : Les paniers garnis"</span> est un projet de l'association <span
                    class=gras>Eco-Campus</span> de Belfort. Tout droits réservés.</p>
        </div>
        <div class="pages">
            <h3>Pages</h3>
            <ul>
                <li><a href="<?php echo get_permalink(get_page_by_title('Boutique')); ?>">Boutique</a></li>
                <li><a href="<?php echo get_permalink(get_page_by_title('Recettes')); ?>">Recettes</a></li>
                <li><a href="<?php echo get_permalink(get_page_by_title('Mon Compte')); ?>">Mon Compte</a></li>
                <li><a href="<?php echo get_permalink(get_page_by_title('A Propos')); ?>">À propos</a></li>
                <li><a href="<?php echo get_permalink(get_page_by_title('F.A.Q.')); ?>">F.A.Q.</a></li>
                <li><a href="<?php echo get_permalink(get_page_by_title('Mentions légales')); ?>">Mentions légales</a></li>
            </ul>
        </div>
    <div class="fb">
        <h3>Page Facebook</h3>
        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FEco-Campus-LAssociation-1725197324371735%2F%3Ffref%3Dts&width=63&layout=box_count&action=like&show_faces=true&share=true&height=65&appId" width="63" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    </div>

    <div class="contact">
        <h3>Contact</h3>
        <ul>
            <li>Eco-Campus l'association</li>
            <li>IUT de Belfort</li>
            <li>19 avenue du maréchal Juin</li>
            <li>90000 Belfort</li>
            <li><a href="mailto:contact@ecocampus.fr">contact@ecocampus.fr</a></li>
        </ul>
    </div>
    </div>
</footer>
<script>function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px"
    }
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0"
    }
    ;</script>

<?php wp_footer(); ?>

</body>
</html>