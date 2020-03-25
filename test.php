<?php

require "simple_html_dom.php";
require 'dataLayer.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://pokemondb.net/pokedex/all");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$resulat = curl_exec($ch);
curl_close($ch);
$html = new simple_html_dom();
$html->load($resulat);

$pokemons = [];

//getData('.infocard-cell-data', 'pokemon_id');
//getData('.ent-name', 'pokemon_name');
//getData('.cell-total', 'pokemon_total_points');
//getData('.type-icon', 'energy_type'); // werkt nog niet goed met meerdere types


// Gets the data from the site and puts it in an array of data
function getData($element, $key_name)
{
    global $html;
    global $pokemons;
    $a = 0;
    $lastscraped = " ";

    foreach ($html->find("$element") as $data) {
        if ($a <= 10) {
            if ($lastscraped != $data->plaintext) {
                $pokemons[$a][$key_name] = $data->plaintext;
                $a++;
            }

            $lastscraped = $data->plaintext;
        }
    }
}

//$a = 0;
//foreach ($html->find('td.cell-icon') as $article) {
//    if ($a < 10) {
//        $item['energyType'] = $article->find('.type-grass', 0)->plaintext;
//        $item['energyType'] = $article->find('.type-poison', 0)->plaintext;
//        $articles[] = $item;
//        $a++;
//    }
//}
//
//
//echo "<pre>", var_dump($articles), "</pre>";