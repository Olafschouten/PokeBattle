<?php

include "simple_html_dom.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://pokemondb.net/pokedex/all");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$resulat = curl_exec($ch);
curl_close($ch);
$html = new simple_html_dom();
$html->load($resulat);

$pokemons = [];

getData('.infocard-cell-data', 'pokemon_id');
getData('.ent-name', 'pokemon_name');

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

echo "<pre>", var_dump($pokemons), "</pre>";