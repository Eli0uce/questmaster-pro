<div class="wrap">
    <h2>Paramètres de Mon Plugin</h2>
    <form method="post" action="options.php">
        <?php settings_fields('mon_plugin_options'); ?>
        <?php do_settings_sections('mon_plugin_options'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Activer le jeu</th>
                <td>
                    <input type="checkbox" name="activer_jeu" value="1" <?php checked(get_option('activer_jeu'), 1); ?> />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Page pour afficher le jeu</th>
                <td>
                    <?php
                    $pages = get_pages();
                    ?>
                    <select name="page_jeu">
                        <option value="0" <?php selected(get_option('page_jeu', 0), 0); ?>>Page d'accueil</option>
                        <?php
                        foreach ($pages as $page) {
                            echo '<option value="' . $page->ID . '" ' . selected(get_option('page_jeu'), $page->ID, false) . '>' . $page->post_title . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>