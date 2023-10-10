<?php

function creer_table_players()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'players';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        pseudo VARCHAR(255) NOT NULL,
        pv INT NOT NULL,
        lvl INT NOT NULL,
        attk INT NOT NULL,
        xp INT NOT NULL,
        weapon_id INT NOT NULL,
        created_at TIMESTAMP NULL DEFAULT current_timestamp(),
        updated_at TIMESTAMP NULL DEFAULT NULL,
        posx INT NOT NULL DEFAULT 0,
        posy INT NOT NULL DEFAULT 0,
        avatar TEXT DEFAULT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function creer_table_ennemies()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ennemies';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        type VARCHAR(255) DEFAULT NULL,
        pv INT DEFAULT NULL,
        attk INT DEFAULT NULL,
        xp INT DEFAULT NULL,
        created_at TIMESTAMP NULL DEFAULT current_timestamp(),
        updated_at TIMESTAMP NULL DEFAULT NULL,
        avatar TEXT DEFAULT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function creer_table_treasures()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'treasures';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        posx INT NOT NULL,
        posy INT NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
        updated_at TIMESTAMP NULL DEFAULT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function creer_table_weapons()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'weapons';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nom VARCHAR(255) NOT NULL,
        bonus_force INT NOT NULL,
        points_de_vie INT NOT NULL,
        prix DECIMAL(10, 2) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function creer_table_inventories()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'inventories';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        player_id INT NOT NULL,
        weapon_id INT NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
