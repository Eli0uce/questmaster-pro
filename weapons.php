<?php

if (isset($_POST['ajouter_arme'])) {
    $nom = sanitize_text_field($_POST['nom']);
    $bonus_force = intval($_POST['bonus_force']);
    $points_de_vie = intval($_POST['points_de_vie']);
    $prix = floatval($_POST['prix']);

    // Validation des données (ajoutez des vérifications personnalisées si nécessaire)

    // Insertion des données dans la base de données
    global $wpdb;
    $table_name = $wpdb->prefix . 'weapons';

    $wpdb->insert(
        $table_name,
        array(
            'nom' => $nom,
            'bonus_force' => $bonus_force,
            'points_de_vie' => $points_de_vie,
            'prix' => $prix,
        )
    );

    // Affichez un message de succès
    echo '<div class="updated"><p>Arme ajoutée avec succès!</p></div>';
}

// Affichez le formulaire d'ajout d'armes
?>
<div class="wrap">
    <h2>Gestion des Armes</h2>
    <h3>Ajouter une Arme</h3>
    <form method="post" action="">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Nom de l'Arme</th>
                <td><input type="text" name="nom" required></td>
            </tr>
            <tr valign="top">
                <th scope="row">Bonus de Force</th>
                <td><input type="number" name="bonus_force" required></td>
            </tr>
            <tr valign="top">
                <th scope="row">Points de Vie</th>
                <td><input type="number" name="points_de_vie" required></td>
            </tr>
            <tr valign="top">
                <th scope="row">Prix</th>
                <td><input type="number" step="0.01" name="prix" required></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="ajouter_arme" class="button-primary" value="Ajouter Arme">
        </p>
    </form>
</div>
<?php

// Récupérez toutes les armes depuis la base de données
global $wpdb;
$table_name = $wpdb->prefix . 'weapons';
$armes = $wpdb->get_results("SELECT * FROM $table_name");

// Affichez le tableau des armes
if (!empty($armes)) {
    echo '<h3>Liste des Armes</h3>';
    echo '<table class="widefat">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nom de l\'Arme</th>';
    echo '<th>Bonus de Force</th>';
    echo '<th>Points de Vie</th>';
    echo '<th>Prix</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($armes as $arme) {
        echo '<tr>';
        echo '<td>' . esc_html($arme->nom) . '</td>';
        echo '<td>' . esc_html($arme->bonus_force) . '</td>';
        echo '<td>' . esc_html($arme->points_de_vie) . '</td>';
        echo '<td>' . esc_html($arme->prix) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>Aucune arme n\'a été trouvée.</p>';
}
