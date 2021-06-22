<?php

if (! function_exists('cw2_esp_function')){
    function cw2_esp_func($atts){
        global $wpdb;

        $params = shortcode_atts(
            array("theme" => -1, "auteur" => -1),
            $atts
        );

        // requetes sql en fonction de la presence des attributs dans shortcodes
        if($params["theme"] == -1 && $params["auteur"] == -1){
            $resultat = $wpdb->get_results("SELECT * FROM citations ORDER BY RAND() LIMIT 1", ARRAY_A);
        }else if ($params["theme"] == -1 && $params["auteur"] !==-1){
            $sql = $wpdb->prepare("SELECT * FROM citations WHERE auteur = %s ORDER BY RAND() LIMIT 1", array( $params["auteur"]));
            $resultat = $wpdb->get_results($sql, ARRAY_A);
        }else if ($params["theme"] !== -1 && $params["auteur"] ==-1){
            $sql = $wpdb->prepare("SELECT * FROM citations WHERE theme = %s ORDER BY RAND() LIMIT 1", array($params["theme"]));
            $resultat = $wpdb->get_results($sql, ARRAY_A);
        }else if ($params["theme"] !== -1 && $params["auteur"] !==-1){
            $sql = $wpdb->prepare("SELECT * FROM citations WHERE theme = %s AND auteur = %s ORDER BY RAND() LIMIT 1", array($params["theme"], $params["auteur"]));
            $resultat = $wpdb->get_results($sql, ARRAY_A);
        }
        
        // affichage frontend
        ob_start();
        ?>

        <div class = "cw2-sc">    
            <p class="titre"> Citation du moment </p>
            <p> 
                <?= $resultat[0]["citation"] . " - "?> 
                <span class="auteur"><?= $resultat[0]["auteur"] ?> </span>
            
            </p>   
        </div>

        <?php
        $reponse = ob_get_clean();

        return $reponse;
    }

    add_shortcode('cw2_esp', 'cw2_esp_func');
}