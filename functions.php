<?php
/**
 * Supprime la barre d’outils (code HTML généré par WordPress plus concis)
 * */
add_action('after_setup_theme', 'plus_admin_bar');
function plus_admin_bar()
{
    show_admin_bar(false);
}

/** Définit que notre thème supporte (préfère) les balises html5
 * Meilleure compatibilité avec les navigateurs
 * */

add_theme_support('html5');

/**
 * Permet de mettre des "images à la une" aux articles
 */

add_theme_support('post-thumbnails');

/** Empêche l'éditeur wysiwyg d'ajouter des balises <p> et <br> :
 * sur les fichiers 'exerpt'
 * */
remove_filter('the_excerpt', 'wpautop');

/*
 * Ajoute les fichiers CSS, ils seront écrits par 'wp_head' juste avant la balise de fin de HEAD.
 */
add_action('wp_enqueue_scripts', 'ajout_scripts');
function ajout_scripts()
{
    /* répétez la ligne qui suit pour chaque fichier CSS en modifiant :
       'typo-couleur'           un identifiant (unique pour chaque style)
       '/css/typo-couleur.css'  le chemin relatif à la racine du thème
    */
    wp_enqueue_style('typographies-couleur', get_stylesheet_directory_uri() . '/css/typographies-couleur.css');
    wp_enqueue_style('styles-graphique', get_stylesheet_directory_uri() . '/css/styles-graphiques.css');
    wp_enqueue_style('woocommerce', get_stylesheet_directory_uri() . '/css/woocommerce.css');
}

/** Permet de générer une classe aux différents body des pages
 * */

function add_slug_body_class($classes)
{
    global $post;
    if (isset($post)) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
/*
 * Ajout type personnalisé
 */

add_filter('body_class', 'add_slug_body_class');

/**
 * Permet d'ajouter différents types de posts que l'on personnalise
 */

add_action('init', 'ajout_post_types');
function ajout_post_types()
{
    /**
     * répétez pour chaque type : lui donner un nom ici 'recettes'
     */
    
    register_post_type('recettes',
        array(
            /** Le nom au pluriel */
            'label' => 'Recettes',
            /** visible ou pas */
            'public' => true,
            /** Si l’on veut des pages listant ce type 'true' */
            'has_archive' => true,
            /** Les Champs de formulaire qui seront saisis et affichés. Eg. Titre et Contenu. 'thumbnail' pour une image à la une */
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
    /** Mettre en commentaire la ligne qui suit après avoir testé le bon fonctionnement. */
    flush_rewrite_rules(false);
}

/*
 * Change les requêtes de WordPress
*/
add_filter('pre_get_posts', 'modifie_requete_wp');
function modifie_requete_wp($query)
{
    /** Est appelé pour chaque page. Testez si c'est la requête que vous voulez changer.
    * Test si page d'accueil (front-page.php)*/
    
    if ($query->is_home()) {
        // Limite à un résultat
        $query->query_vars['posts_per_page'] = 1;
    }
}

/**
 * Definit une taille personalisé d'image
 */

add_image_size('portrait', 60, 100, true);
add_image_size('paysage', 120, 50, false);

/**
 * Pour aider à trouver les templates à utiliser
 * Indique dans la console quel template est utilisé pour la page en cours
 */
function debug_template()
{
    global $template;
    $affiche_template = print_r($template, true);
    $affiche_body_class = print_r(get_body_class(), true);
    $affiche_debug = <<<EOD
Fichier de template :
$affiche_template
Body class
$affiche_body_class
EOD;
    /** en commentaire dans le code HTML*/
    echo("<!--\n$affiche_debug\n-->");
    /** Par JS dans la console */
    $json_debug = json_encode($affiche_debug);
    echo("<script>console.log($json_debug)</script>");
}

/** Permet d'appeler la fonction de débuggage et de savoir quel template est utilisé. */
add_action('wp_footer', 'debug_template');

// Partie WooCommerce

/** Indique que le thème est supporté par Woocommerce */

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}

/** Ajout d'un wrapper personnalisé qui enveloppe le contenu principal d'un main et d'un div taille */

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start()
{
    echo '<main><div class="taille">';
}

function my_theme_wrapper_end()
{
    echo '</div></main>';
}

/** Supprime la navigation générée par Woocommerce avant le contenu principal */

add_action('init', 'jk_remove_wc_breadcrumbs');
function jk_remove_wc_breadcrumbs()
{
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}

/** Modifie le texte du bouton ajouter au panier */

add_filter('woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text');    // 2.1 +

function woo_archive_custom_cart_button_text()
{

    return __('Ajouter à ma commande', 'woocommerce');

}

/** Ajout d'un section alerte pour les tarifs adhérents après chaque produit */

function show_alert_adherents()
{
    echo '<div class="alert"><p>Tarif adhérents</p><p>7€ pour les adhérents à l\'association Eco-Campus</p></div>';
}

add_action('woocommerce_after_shop_loop_item', 'show_alert_adherents', 20);

/** Suppression des champs inutiles sur la page commande */

add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

function custom_override_checkout_fields($fields)
{
    unset($fields['billing']['billing_company']);
    $fields['order']['order_comments']['placeholder'] = 'Commentaires concernant le retrait de votre commande, ex : sur l\'heure de votre passage';
    $fields['shipping']['shipping_hour'] = array(
        'label' => __('Heure de retrait', 'woocommerce'),
        'placeholder' => _x('Phone', 'placeholder', 'woocommerce'),
        'required' => false,
        'class' => array('form-row-wide'),
        'clear' => true
    );

    return $fields;
}

/**
 * Permet de changer le nom des onglets dans les pages single-product (ici recette et avis)
 */
add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
function woo_rename_tabs($tabs)
{

    $tabs['description']['title'] = __('Recette');        // Rename the description tab
    $tabs['reviews']['title'] = __('Avis');                // Rename the avis tab

    return $tabs;

}

/** Permet de modifier le texte des boutons sur la page connexion/inscription */

add_filter('gettext', 'register_text');
add_filter('ngettext', 'register_text');
function register_text($translated)
{
    $translated = str_ireplace('S\'enregistrer', 'Inscription', $translated);
    return $translated;
}

// Rôles

/** Suppression des rôles inutiles pour la boutique */

if (get_role('subscriber')) {
    remove_role('subscriber');
}
if (get_role('author')) {
    remove_role('author');
}
if (get_role('contributor')) {
    remove_role('contributor');
}
if (get_role('editor')) {
    remove_role('editor');
}

/** Ajout du rôle adhérent qui permet un rabais sur les prix des produits marqués avec le plugin Price per role */

$result = add_role('adherent', __(

    'Adhérent'),

    array(

        'read' => true, // true allows this capability
        'edit_posts' => false, // Allows user to edit their own posts
        'edit_pages' => false, // Allows user to edit pages
        'edit_others_posts' => false, // Allows user to edit others posts not just their own
        'create_posts' => false, // Allows user to create new posts
        'manage_categories' => false, // Allows user to manage post categories
        'publish_posts' => false, // Allows the user to publish, otherwise posts stays in draft mode
        'edit_themes' => false, // false denies this capability. User can’t edit your theme
        'install_plugins' => false, // User cant add new plugins
        'update_plugin' => false, // User can’t update any plugins
        'update_core' => false // user cant perform core updates
    )

);