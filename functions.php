<?php
// Supprime la barre d’outils (code HTML généré par WordPress plus concis)
add_action('after_setup_theme', 'plus_admin_bar');
function plus_admin_bar()
{
    show_admin_bar(false);
}

// définit que notre thème supporte (préfère) les balises html5
add_theme_support('html5');
/* Voir : http://codex.wordpress.org/add_theme_support
   Pour d’autres fonctionnalités optionnelles des thèmes */
// A ajouter en plus du 'supports' => array( ..,'thumbnail',..) pour pouvoir saisir l'image "à la une" dans l'interface d'un type personnalisé.
add_theme_support('post-thumbnails');

//empêcher l'éditeur wysiwyg d'ajouter des balises <p> et <br> :
//sur les fichiers 'content'
/*remove_filter( 'the_content', 'wpautop' );*/
//sur les fichiers 'exerpt'
remove_filter('the_excerpt', 'wpautop');


// notre thème permet à l’utilisateur de saisir des menus dans l’interface d’administration
/*add_theme_support('menus');
/*
 * Définit le nom des menus que l’utilisateur pourra ajouter
 */
/*register_nav_menus(array(
    // une ligne pour chaque menu : identifiant et nom affiché
    'principale' => 'Navigation principale',
));
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
    /* Pour le JavaScript : http://codex.wordpress.org/Function_Reference/wp_enqueue_script
       Il est possible de spécifier que ses scripts dépendent de jQuery,
       WordPress ajoutera automatiquement les dépendances.
    */
}

//Page Slug Body Class
function add_slug_body_class($classes)
{
    global $post;
    if (isset($post)) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}

add_filter('body_class', 'add_slug_body_class');/*
 * Ajout type personnalisé
 */
add_action('init', 'ajout_post_types');
function ajout_post_types()
{
    // répétez pour chaque type : lui donner un nom ici 'recettes'
    register_post_type('recettes',
        // options, voir documentation
        array(
            // Le nom au pluriel
            'label' => 'Recettes',
            // visible Eg. 'true'
            'public' => true,
            // Si l’on veut des pages listant ce type Eg. 'true'
            'has_archive' => true,
            // Les Champs de formulaire qui seront saisis et affichés. Eg. Titre et Contenu. 'thumbnail' pour une image à la une (voir add_theme_support('post-thumbnails');)
            'supports' => array('title', 'editor', 'thumbnail'),
            // Pour l’ajout de Champs personnalisé voir le plug-in Meta Box.
        )
    );
    // Mettre en commentaire la ligne qui suit après avoir testé le bon fonctionnement.
    flush_rewrite_rules(false);
}

/*
 * Ajout de taxonomie personnalisé
 */
add_action('init', 'ajout_taxonomy');
function ajout_taxonomy()
{
    // répétez pour chaque taxonomie : lui donner un nom ici 'competences'
    register_taxonomy('competences',
        // le type ou les types classés par cette taxonomie (séparé par des virgules)
        array('projet'),
        // options, voir documentation
        array(
            'label' => __('Compétences'), // Au minimum fixer son nom affiché ('label')
            'hierarchical' => true // Tag (false) ou  Category (true)
        )
    );
    // Mettre en commentaire la ligne qui suit après avoir testé le bon fonctionnement.
    flush_rewrite_rules(false);
}

/*
 * Ajout de champs personnalisés (avec le plug-in Meta Box à installer)
 * http://metabox.io/docs/define-fields/
 * https://github.com/rilwis/meta-box/blob/master/demo/demo.php
 */
/*add_filter('rwmb_meta_boxes', 'ajout_meta_boxes');
function ajout_meta_boxes($meta_boxes)
{
    // Répetez pour chaque "boîte" (groupes de champs)
    $meta_boxes[] = array(
        // le titre de la boîte
        'title' => 'Recette',
        // le type ou les types ou sera affiché cette "boîte" (séparé par des virgules)
        'pages' => array('recettes'),
        // La liste des champs de formulaire affiché par la "boîte"
        'fields' => array(
            // Répeter pour chaque champ : ses options
            array(
                // Son nom affiché
                'name' => 'Titre Ingrédients',
                // Un identifiant unique, utilisé pour lire la valeur en PHP
                'id' => 'title_ingredients',
                // son type
                'type' => 'text',
            ),
            // Répeter pour chaque champ : ses options
            array(
                // Son nom affiché
                'name' => 'Ingrédients',
                // Un identifiant unique, utilisé pour lire la valeur en PHP
                'id' => 'ingredients',
                // son type
                'type' => 'wysiwyg',
            ),
            array(
                // Son nom affiché
                'name' => 'Titre Préparation',
                // Un identifiant unique, utilisé pour lire la valeur en PHP
                'id' => 'title_preparations',
                // son type
                'type' => 'text',
            ),
            array(
                // Son nom affiché
                'name' => 'Préparation',
                // Un identifiant unique, utilisé pour lire la valeur en PHP
                'id' => 'preparation',
                // son type
                'type' => 'wysiwyg',
            ),
            array(
                // Son nom affiché
                'name' => 'Titre Panier Associé',
                // Un identifiant unique, utilisé pour lire la valeur en PHP
                'id' => 'title_panier',
                // son type
                'type' => 'text',
            ),
            array(
                // Son nom affiché
                'name' => 'Panier associé',
                // Un identifiant unique, utilisé pour lire la valeur en PHP
                'id' => 'panier_associe',
                // son type
                'type' => 'wysiwyg',
            ),
        )
    );
    return $meta_boxes;
}*/

/*
 * Change les requêtes de WordPress
 * http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
*/
add_filter('pre_get_posts', 'modifie_requete_wp');
function modifie_requete_wp($query)
{
    // Est appelé pour chaque page. Testez si c'est la requête que vous voulez changer.
    // Test si page d'accueil (front-page.php)
    if ($query->is_home()) {
        // Limite à un résultat
        $query->query_vars['posts_per_page'] = 1;
    }
}

/**
 * Definit une taille personalisé d'image
 * http://codex.wordpress.org/Function_Reference/add_image_size
 */
add_image_size('portrait', 60, 100, true);
add_image_size('paysage', 120, 50, false);
/**
 * Pour aider à trouver les templates à utiliser
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
    // en commentaire dans le code HTML
    echo("<!--\n$affiche_debug\n-->");
    // Par JS dans la console
    $json_debug = json_encode($affiche_debug);
    echo("<script>console.log($json_debug)</script>");
}

// Laisser ce code dans le rendu final. Le mettre en commentaire APRES que j'ai noté.
add_action('wp_footer', 'debug_template');

// Partie WooCommerce

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}

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

add_action('init', 'jk_remove_wc_breadcrumbs');
function jk_remove_wc_breadcrumbs()
{
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}

add_filter('woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text');    // 2.1 +

function woo_archive_custom_cart_button_text()
{

    return __('Ajouter à ma commande', 'woocommerce');

}

function show_alert_adherents()
{
    echo '<div class="alert"><p>Tarif adhérents</p><p>7€ pour les adhérents à l\'association Eco-Campus</p></div>';
}

add_action('woocommerce_after_shop_loop_item', 'show_alert_adherents', 20);

// Hook in
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

// Our hooked in function - $fields is passed via the filter!
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

add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
function woo_rename_tabs($tabs)
{

    $tabs['description']['title'] = __('Recette');        // Rename the description tab
    $tabs['reviews']['title'] = __('Avis');                // Rename the avis tab

    return $tabs;

}

add_filter('gettext', 'register_text');
add_filter('ngettext', 'register_text');
function register_text($translated)
{
    $translated = str_ireplace('S\'enregistrer', 'Inscription', $translated);
    return $translated;
}

// Rôles

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
// Add a custom user role

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