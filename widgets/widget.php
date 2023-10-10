<?php

class Jeu_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'jeu_widget',
            'Widget de QuestMaster Pro',
            array('description' => 'Un widget pour afficher QuestMaster sur la page d\'accueil.')
        );
    }

    public function widget($args, $instance)
    {
        echo '<div class="jeu-widget">';
        include plugin_dir_path(__FILE__) . '../treasure-hunt-php/index.php'; // Inclure le modèle du jeu
        echo '</div>';
    }

    public function form($instance)
    {
        // Code pour le formulaire de configuration du widget (s'il y en a)
    }

    public function update($new_instance, $old_instance)
    {
        // Code pour mettre à jour les options du widget
    }
}

function enregistrer_widget_jeu()
{
    register_widget('Jeu_Widget');
}
add_action('widgets_init', 'enregistrer_widget_jeu');
