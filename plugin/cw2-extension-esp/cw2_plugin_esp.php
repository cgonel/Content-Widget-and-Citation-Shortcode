<?php
/**
 * @package cw2PluginESP
 */
/*
    Plugin Name: Content Information Widget
    Description: Un widget qui permet d'afficher de l'information sur le contenu de la page active. Il affiche les données importantes des pages et des articles.
    Author: Chris Gonel
    Version: 1.0.0
    License: MIT License
*/

/*
    MIT License

    Copyright (c) [year] [fullname]

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
*/

if (! defined('ABSPATH')){
    die('Requête invalide.');
}

// integration shortcode et plugin
require_once('cw2_esp.php');
require_once('cw2_widget.php');


// integration feuille de style
function cw2_style(){
    wp_register_style('cw2_style', plugins_url('css/cw2_style.css', __FILE__));
    wp_enqueue_style('cw2_style');
}

add_action('init', 'cw2_style');