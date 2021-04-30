<?php

//  notation Snake cas nb_produit <> notation CAMEL case nbProduit
if (! function_exists('nb_produit')) {
    function nb_produit($nb) 
    {
        if ($nb > 1) {
            return "$nb produits"; 
        } else {
            return "$nb produit"; 
        }
    }    
}

//  applique le séparateur de millier dans le prix 
if (! function_exists('set_thousands')) {
    function set_thousands ($nb, $env=0)
    {
        $number = number_format($nb, 0, "", " "); 
        if ($env == 0) {
            $number .= env('APP_CHANGE'); 
        } else {
            //     
        }
        return $number; 
    }
}

//  tronque la chaîne de caractères 
if (! function_exists('get_substring')) {
    function get_substring ($string, $length=0) 
    {
        return ($length > 0) ? substr ($string , 0, $length) : $string; 
    }
}