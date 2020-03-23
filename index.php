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
</head>
<body class="bg-dark">
<div class="d-flex justify-content-center">
    <div class="w-75 bg-white p-4">
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

        <div>
            <?php
            if (!isset($_POST['fight'])) {
                $pokemons = GetAllPokemonsData();
                foreach ($pokemons

                         as $pokemon) {
                    echo '<hr>';
                    echo 'Name: ' . $pokemon['Pokemon_Name'] . '<br>';

                    ?>
                    <p>
                        <?php echo 'EnergyType : ';?>
                        <button style="background-color: <?php echo $pokemon['Color'] ?>;"><?php echo $pokemon['EnergyType'] ?></button>
                    </p>
                    <img src="https://img.pokemondb.net/artwork/large/<?php echo strtolower($pokemon['Pokemon_Name']); ?>.jpg"
                         alt="<?php echo strtolower($pokemon['Pokemon_Name']); ?>" style="max-width: 100px;">
                    <p>
                        <?php echo 'WeaknessType : ';
                        if ($pokemon['WeaknessType'] === 'Grass') { ?>
                            <button style="background-color: #7c5;"><?php echo $pokemon['WeaknessType'] ?></button>
                        <?php } else if ($pokemon['WeaknessType'] === 'Fire') { ?>
                            <button style="background-color: #f42;"><?php echo $pokemon['WeaknessType'] ?></button>
                            <?php
                        } else if ($pokemon['WeaknessType'] === 'Electric') { ?>
                            <button style="background-color: #fc3;"><?php echo $pokemon['WeaknessType'] ?></button>
                            <?php
                        } else if ($pokemon['WeaknessType'] === 'Water') { ?>
                            <button style="background-color: #39f;"><?php echo $pokemon['WeaknessType'] ?></button>
                            <?php
                        } else { ?>
                            <button><?php echo $pokemon['WeaknessType'] ?></button>
                        <?php }

                        ?>
                    </p>
                    <p>
                        <?php echo 'ResistanceType : ';
                        if ($pokemon['ResistanceType'] === 'Grass') { ?>
                            <button style="background-color: #7c5;"><?php echo $pokemon['ResistanceType'] ?></button>
                        <?php } else if ($pokemon['ResistanceType'] === 'Fire') { ?>
                            <button style="background-color: #f42;"><?php echo $pokemon['ResistanceType'] ?></button>
                            <?php
                        } else if ($pokemon['ResistanceType'] === 'Electric') { ?>
                            <button style="background-color: #fc3;"><?php echo $pokemon['ResistanceType'] ?></button>
                            <?php
                        } else if ($pokemon['ResistanceType'] === 'Water') { ?>
                            <button style="background-color: #39f;"><?php echo $pokemon['ResistanceType'] ?></button>
                            <?php
                        } else { ?>
                            <button><?php echo $pokemon['ResistanceType'] ?></button>
                        <?php } ?>
                    </p>
                    <?php

                    //                    echo ' Max_Health: ' . $pokemon['Max_Health'] . '<br>';
                    //                    echo ' Health: ' . $pokemon['Max_Health'] . '<br>';
                    //                    echo ' Resistance_Points: ' . $pokemon['Resistance_Points'] . '<br>';
                    //                    echo ' ResistanceType: ' . $pokemon['ResistanceType'] . '<br>';
                    //                    echo ' WeaknessType: ' . $pokemon['WeaknessType'] . '<br>';
                    //                    echo ' Weakness_Multiplier: ' . $pokemon['Weakness_Multiplier'] . '<br>';
                }
            } else {
                $yourPokemonData = GetPokemonData($_POST['your_pokemon_id']);

                $againstPokemonData = GetPokemonData($_POST['against_pokemon_id']);

                $attackData = GetAttackData($_POST['attack_id']);

//                echo "<pre>", var_dump($attackData), "</pre>";

                $yourPokemon = new Pokemon($yourPokemonData);
                $againstPokemon = new Pokemon($againstPokemonData);

                $yourPokemon->fight($againstPokemon, $attackData);
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>