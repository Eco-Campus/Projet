<!doctype html>
<html  lang=fr>
<head>
	<meta charset=UTF-8>
	<meta name=viewport content="width=device-width, initial-scale=1.0">
	<meta name=theme-color content=#BAE468>
	<meta name=msapplication-navbutton-color content=#BAE468>
	<meta name=apple-mobile-web-app-status-bar-style content=#BAE468>
	<title><?php wp_title(''); ?></title>
	<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:400,700|Lato|Noto+Serif:400,400i"
		  rel=stylesheet>
    <?php wp_head(); ?>
</head>

<body <?php body_class($class_name); ?>>
<header>
	<nav id=mobile>
        <span onclick=openNav();><img
				src=http://paniersgarnis.ecocampus-asso.fr/wp-content/uploads/2016/11/hamburger.png
				alt=Hamburger></span>
		<div id=mySidenav class=sidenav>
			<a href=javascript:void(0) class=closebtn onclick=closeNav();>&times;</a>
			<a href="<?php echo get_permalink(get_page_by_title('Boutique')); ?>">Boutique</a>
			<a href="<?php echo get_permalink(get_page_by_title('Recettes')); ?>">Recettes</a>
			<a href="<?php echo get_permalink(get_page_by_title('À Propos')); ?>">À propos</a>
			<a href="<?php echo get_permalink(get_page_by_title('F.A.Q.')); ?>">F.A.Q.</a>
			<a href="<?php echo get_permalink(get_page_by_title('Panier')); ?>">Ma commande <img
					src=http://paniersgarnis.ecocampus-asso.fr/wp-content/uploads/2016/11/shopping_white.png
					alt=Panier></a>


			<!-- Permet de savoir si l'utilisateur est connecté ou pas pour modifier le menu déroulant. Si il est connecté il aura juste accès à "Mon Compte"
            et s'il ne l'est pas il aura accès à Connexion-->

            <?php if (is_user_logged_in()): ?>
				<a href="<?php echo get_permalink(get_page_by_title('Mon Compte')); ?>">Mon compte</a>
            <?php else: ?>
				<a href="<?php echo get_permalink(get_page_by_title('Mon Compte')); ?>">Connexion</a>
            <?php endif ?>

			<a href="<?php echo get_permalink(get_page_by_title('Mentions légales')); ?>">Mentions légales</a>
		</div>
		<a href="<?php echo esc_url(home_url()); ?>"><img
				src=http://paniersgarnis.ecocampus-asso.fr/wp-content/uploads/2016/11/logo_eco.png
				alt="Logo Ecocampus"></a>
	</nav>

	<nav id=ordi>
		<div class=conteneur960>
			<a href="<?php echo esc_url(home_url()); ?>"><img
					src="http://paniersgarnis.ecocampus-asso.fr/wp-content/uploads/2016/11/logo_eco.png"
					alt="Logo de l'association Eco-Campus" title="Logo de l'association Eco-Campus"></a>
			<div class="menu">
				<a href="<?php echo esc_url(home_url()); ?>">Accueil</a>
				<a href="<?php echo get_permalink(get_page_by_title('Boutique')); ?>">Boutique</a>
				<a href="<?php echo get_permalink(get_page_by_title('Recettes')); ?>">Recettes</a>
				<a href="<?php echo get_permalink(get_page_by_title('À Propos')); ?>">À Propos</a>
			</div>
			<div class="menu">
				<a href="<?php echo get_permalink(get_page_by_title('Panier')); ?>">Commande</a>

				<!-- Permet de savoir si l'utilisateur est connecté ou pas pour modifier le menu fixe. Si il est connecté il aura juste accès à "Mon Compte"
            et s'il ne l'est pas il aura accès à Connexion-->

                <?php if (is_user_logged_in()): ?>
					<a href="<?php echo get_permalink(get_page_by_title('Mon Compte')); ?>">Mon compte</a>
                <?php else: ?>
					<a href="<?php echo get_permalink(get_page_by_title('Mon Compte')); ?>">Connexion</a>
                <?php endif ?>
			</div>
			<a href="https://www.facebook.com/Eco-Campus-LAssociation-1725197324371735/?fref=nf&pnref=story"><img
					src=http://paniersgarnis.ecocampus-asso.fr/wp-content/uploads/2017/03/ecocampus.jpg
					alt="Eco-Campus FB"></a>
		</div>
	</nav>

	<!-- Choisi aléatoirement une image parmis une liste pour la transformer en fond de l'en-tête de toutes les pages sauf page d'accueil. Utilisation du php car l'image est choisie avant
     le chargement de la page ce qui permet d'améliorer les temps de chargement-->
    <?php
    $bg = array('http://paniersgarnis.ecocampus-asso.fr/wp-content/uploads/2016/11/background_2.jpg', 'http://paniersgarnis.ecocampus-asso.fr/wp-content/uploads/2016/12/image_fond_raisin.jpg', 'http://paniersgarnis.ecocampus-asso.fr/wp-content/uploads/2016/12/image_fond_plat.jpg', 'http://paniersgarnis.ecocampus-asso.fr/wp-content/uploads/2016/12/image_fond_planche.jpg', 'http://paniersgarnis.ecocampus-asso.fr/wp-content/uploads/2016/12/image_fond_fraises.jpg'); // images to choose from
    $i = rand(0, count($bg) - 1); // Génère un nombre aléatoire en fonction de la taille du tableau
    $selectedBg = $bg[$i]; // Définit la variable en fonction de l'image qui à été choisie.
    ?>

	<style type="text/css">
		.titre2 {
			background-image: url('<?php echo $selectedBg; ?>');
		}
	</style>

	<div class=titre2>
		<div class=titrage>
			<p>Boutique</p>
		</div>
	</div>
</header>

<?php
///**
// * The Template for displaying product archives, including the main shop page which is a post type archive
// *
// * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
// *
// * HOWEVER, on occasion WooCommerce will need to update template files and you
// * (the theme developer) will need to copy the new files to your theme to
// * maintain compatibility. We try to do this as little as possible, but it does
// * happen. When this occurs the version of the template file will be bumped and
// * the readme will list any important changes.
// *
// * @see 	    https://docs.woocommerce.com/document/template-structure/
// * @author 		WooThemes
// * @package 	WooCommerce/Templates
// * @version     2.0.0
// */
//
//if ( ! defined( 'ABSPATH' ) ) {
//	exit; // Exit if accessed directly
//}
//
//get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>



			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' ); ?>
