<?php

require 'Pokemon.php';
require "dataLayer.php";

//$pikachu->attack($charmeleon);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokeBattle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark">
<div class="d-flex justify-content-center">
    <div class="bg-white p-4 container">
        <h1>Choose your Pokemon</h1>
        <form method="post" action="index.php">
            <table>
                <p>Choose your Pokemon:
                    <label>
                        <select name="your_pokemon_id" required>
                            <?php $pokemons = GetAllPokemonNames();
                            foreach ($pokemons as $pokemon) { ?>
                                <option value="<?php echo $pokemon['Id']; ?>"><?php echo $pokemon['Pokemon_Name']; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                </p>

                <p>Choose an attack:
                    <label>
                        <select name="attack_id" required>
                            <?php $attacks = GetAllPokemonAttacks();
                            foreach ($attacks as $attack) { ?>
                                <option value="<?php echo $attack['Id']; ?>"><?php echo $attack['Attack_Name']; ?></option>
                                <?php
                            } ?>
                        </select>
                    </label>
                </p>

                <p>Attack</p>

                <p>Choose a Pokemon to play against:
                    <label>
                        <select name="against_pokemon_id" required>
                            <?php foreach ($pokemons as $pokemon) { ?>
                                <option value="<?php echo $pokemon['Id']; ?>"><?php echo $pokemon['Pokemon_Name']; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                </p>
            </table>
            <input type="submit" name="fight" value="Fight"/>
        </form>

        <div class="row">
            <?php
            if (!isset($_POST['fight'])) {
                $pokemons = GetAllPokemonsData();
                foreach ($pokemons as $pokemon) { ?>
                    <div class="pokemon_item col-sm">
                        <p>
                            <?php
                            echo '<hr>';
                            echo 'Name: ' . $pokemon['Pokemon_Name'] . '<br>';
                            echo 'EnergyType : '; ?>
                            <button class="btn"
                                    style="background-color: <?php echo $pokemon['Color'] ?>;"><?php echo $pokemon['EnergyType'] ?></button>
                        </p>
                        <img src="https://img.pokemondb.net/artwork/large/<?php echo strtolower($pokemon['Pokemon_Name']); ?>.jpg"
                             alt="<?php echo strtolower($pokemon['Pokemon_Name']); ?>" style="max-height: 100px;">
                        <p>
                            <?php echo 'WeaknessType : '; ?>
                            <button class="btn"
                                    style="background-color: <?php echo $pokemon['Color'] ?>;"><?php echo $pokemon['WeaknessType'] ?></button>
                        </p>
                        <p>
                            <?php echo 'ResistanceType : '; ?>
                            <button class="btn"
                                    style="background-color: <?php echo $pokemon['Color'] ?>;"><?php echo $pokemon['ResistanceType'] ?></button>
                        </p>
                    </div>
                <?php } ?>

            <?php } else {
                $yourPokemonData = GetPokemonData($_POST['your_pokemon_id']);

                $againstPokemonData = GetPokemonData($_POST['against_pokemon_id']);

                $attackData = GetAttackData($_POST['attack_id']);

//                echo "<pre>", var_dump($attackData), "</pre>";

                $yourPokemon = new Pokemon($yourPokemonData);
                $againstPokemon = new Pokemon($againstPokemonData);

                $yourPokemon->fight($againstPokemon, $attackData);
            } ?>
        </div>
    </div>
</div>
</body>
</html>