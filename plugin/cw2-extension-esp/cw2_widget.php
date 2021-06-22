<?php

class cw2_widget extends WP_Widget {
    function __construct(){
        parent::__construct(
            'cw2_widget',
            __('Content Information Widget', 'cw2_widget_domain'),
            array('description' => __('Un widget qui permet d\' afficher de l\'information sur le contenu de la page active. Affiche des données importantes des pages et des articles.',
            'cw2_widget_domain'))
        );
    }

    public function widget($args, $instance){
        $title = apply_filters('widget_title', $instance['title']);

        echo $args['before_widget'];

        if( ! empty($title) )
            echo $args['before_title'] . $title . $args['after_title'];

   
        echo cw2_widget_information();
        echo $args['after_widget'];
    }

    public function form($instance){
        if(isset($instance['title'])) $title = $instance['title'];
        else $title = __('Informations  sur  le  contenu', 'cw2_widget_domain')

        ?>
            <p>
                <label for="<?= $this->get_field_id('title');?>"><?php _e('Title'); ?></label>
                <input 
                    type="text" 
                    class="widefat" 
                    id="<?= $this->get_field_id('title')?>" 
                    name="<?= $this->get_field_name('title')?>"
                    value="<?= esc_attr($title);?>"
                />
            </p>
        <?php
    }

    public function update($new_instance, $old_instance){
        $instance = array();
        $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : "";
        return $instance;
    }
}

function cw2_load_widget(){
    register_widget("cw2_widget");
}

add_action('widgets_init', 'cw2_load_widget');

// function affichage widget selon page, article ou aucun des deux
function  cw2_widget_information(){
    if( is_page()){
        $title = get_the_title();
        $id = get_the_ID();
        $hr_modifie = get_the_modified_date();
        $nb_comments = get_comments_number();

        ob_start();
        ?>
        <p>
            <span>Titre de la page:</span> <?= $title ?>
        </p>
        <p>
            <span>ID de la page:</span> <?= $id ?>
        </p>
        <p>
            <span>Heure de la dernière modification:</span> <?= $hr_modifie ?>
        </p>
        <p>
            <span>Nombre de commentaires:</span> <?= $nb_comments ?>
        </p>

        <?php
        $resultat = ob_get_clean();

        return $resultat;

    }else if( is_single()){
        $title = get_the_title();
        $id = get_the_ID();
        $auteur = get_the_author();
        $hr_modifie = get_the_modified_date() ;
        $extrait = get_the_excerpt() ;

        ob_start();
        ?>
        <p>
            <span>Titre de l'article:</span> <?= $title ?>
        </p>
        <p>
            <span>ID de l'article:</span> <?= $id ?>
        </p>
        <p>
            <span>Auteur de l'article:</span> <?= $auteur ?>
        </p>
        <p>
            <span>Heure de la dernière modification:</span> <?= $hr_modifie ?>
        </p>
        <p>
            <span>Extrait:</span> <?= $extrait ?>
        </p>

        <?php
        $resultat = ob_get_clean();

        return $resultat;
    }else{
        $resultat = "Aucune information disponible";
    }

    return $resultat;
}