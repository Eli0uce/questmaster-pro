<?php
/*
Plugin Name: QuestMaster Pro
Description: Un plugin pour activer QuestMaster Pro sur une page de votre site. Ce plugin vous permet de créer et gérer un jeu de rôle (JdR) sur votre site WordPress. Il inclut des fonctionnalités telles que la gestion des joueurs, des ennemis, des trésors, des armes, et bien plus encore.
Version: 1.0
Author: Elias Dupin-Gilet
*/

// Code du plugin ici

// Activation du plugin
register_activation_hook(__FILE__, 'activer_mon_plugin');

// mon-plugin.php

// Inclure le fichier des fonctions de création de table
include_once(plugin_dir_path(__FILE__) . 'create-tables.php');

// Enregistrez les fonctions de création de table pour l'activation
register_activation_hook(__FILE__, 'creer_table_players');
register_activation_hook(__FILE__, 'creer_table_ennemies');
register_activation_hook(__FILE__, 'creer_table_treasures');
register_activation_hook(__FILE__, 'creer_table_weapons');
register_activation_hook(__FILE__, 'creer_table_inventories');


function activer_mon_plugin()
{
    add_option('activer_jeu', false);
    add_option('page_jeu', 0); // Page par défaut : 0 (page d'accueil)
}

// Ajoutez une page de paramètres au menu d'administration
add_action('admin_menu', 'ajouter_settings');

function ajouter_settings()
{
    add_menu_page('Paramètres de QuestMaster Pro', 'QuestMaster Pro', 'manage_options', 'settings', 'afficher_settings');
}

// Affichez la page de paramètres
function afficher_settings()
{
    include 'settings.php';
}

// Ajoutez un menu d'administration pour gérer les armes
add_action('admin_menu', 'ajouter_menu_armes');

function ajouter_menu_armes()
{
    add_submenu_page('settings', 'Gérer les armes', 'Armes', 'manage_options', 'weapons', 'afficher_page_armes');
}

// Affichez la page de gestion des armes
function afficher_page_armes()
{
    include 'weapons.php';
}

// Ajoutez un menu d'administration pour la documentation
add_action('admin_menu', 'ajouter_menu_doc');

function ajouter_menu_doc()
{
    add_submenu_page('settings', 'Voir la documentation', 'Documentation', 'manage_options', 'documentation', 'afficher_page_doc');
}

// Affichez la page de gestion des armes
function afficher_page_doc()
{
    include 'documentation.php';
}

// Enregistrez les options
add_action('admin_init', 'enregistrer_options');

function enregistrer_options()
{
    register_setting('mon_plugin_options', 'activer_jeu');
    register_setting('mon_plugin_options', 'page_jeu');
}

// Créez un widget pour le jeu
include 'widgets/widget.php';

// Affichez le widget sur la page d'accueil
function afficher_widget_jeu()
{
    $page_jeu = get_option('page_jeu', 0);

    if (get_option('activer_jeu', false) && (is_page($page_jeu) || (is_home() && $page_jeu == 0))) {
        the_widget('Jeu_Widget');
    }
}
add_action('wp_footer', 'afficher_widget_jeu');