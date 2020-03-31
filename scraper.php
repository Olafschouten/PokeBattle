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

// this works
//$a = 0;
//foreach ($html->find('td.cell-icon') as $article) {
//    if ($a < 10) {
//        $item['energyType'] = $article->find('.type-icon', 0)->plaintext;
//        if (isset($article->find('.type-icon', 1)->plaintext)) {
//            $item['energyType2'] = $article->find('.type-icon', 1)->plaintext;
//        }
//
//        $articles[] = $item;
//        $a++;
//        $pokemons[$a - 1]['EnergyTypes'] = $item;
//        $item['energyType2'] = null;
//    }
//}

getData1('.ent-name', 19);

function getData1($element, $id)
{
    global $html;
    global $pokemons;
    $a = 0;
    $lastscraped = " ";

    foreach ($html->find("$element") as $data) {
        if ($a == $id) {
            if ($lastscraped != $data->plaintext) {
                $pokemons[$a]['Pokemon name'] = $data->plaintext;

                foreach ($html->find('td.cell-icon') as $article) {
                    if ($a == $id) {
                        $item['energyType'] = $article->find('.type-icon', 0)->plaintext;
                        if (isset($article->find('.type-icon', 1)->plaintext)) {
                            $item['energyType2'] = $article->find('.type-icon', 1)->plaintext;
                        }

                        $articles[] = $item;
                        $pokemons['EnergyTypes'] = $articles[$id];
                        $item['energyType'] = null;
                        $item['energyType2'] = null;
                    }
                }
            }
            $lastscraped = $data->plaintext;
        }
        $a++;
    }
}

//echo "<pre>", var_dump($articles), "</pre>";
echo "<pre>", var_dump($pokemons), "</pre>";