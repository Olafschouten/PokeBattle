<?php

require_once 'Pokemon.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokeBattle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="bg-dark">
<div class="d-flex justify-content-center">
    <div class="w-75 bg-white p-4">
        <h1>Choose your Pokemon</h1>
        <form method="post" action="route.php?url=Pokemon/Fight">
            <table>
                <?php require "dataLayer.php";
                $pokemons = GetAllPokemonNames(); ?>
                <p>Choose your Pokemon: <select name="pokemon_name" required>
                        <?php foreach ($pokemons as $pokemon) { ?>
                            <option value="<?php echo $pokemon['Id']; ?>"><?php echo $pokemon['Pokemon_Name']; ?></option>
                        <?php } ?>
                    </select></p>
                <p>Attack</p>
                <p>Choose a Pokemon to play against: <select name="pokemon_name_against" required>
                        <?php foreach ($pokemons as $pokemon) { ?>
                            <option value="<?php echo $pokemon['Id']; ?>"><?php echo $pokemon['Pokemon_Name']; ?></option>
                        <?php } ?>
                    </select></p>
            </table>
            <input type="submit" value="Fight"/>
        </form>

        <form action="">
            <table>
                <p>Choose an attack: <select name="pokemon_attack" required>
                        <?php $attacks = GetAllPokemonAttacks();
                        foreach ($attacks as $attack) { ?>
                            <option value="<?php echo $attack['Id']; ?>"><?php echo $attack['Attack_Name']; ?></option>
                        <?php } ?>
                    </select></p>
                <input type="submit" value="Choosse"/>
            </table>
        </form>

        <div>
            <?php $pokemons = GetAllPokemonsData();
            foreach ($pokemons as $pokemon) {
                echo '<hr>';
                echo ' Pokemon_Name: ' . $pokemon['Pokemon_Name'] . '<br>';
                echo ' EnergyType: ' . $pokemon['EnergyType'] . '<br>';
                echo ' Max_Health: ' . $pokemon['Max_Health'] . '<br>';
                echo ' Health: ' . $pokemon['Max_Health'] . '<br>';
                echo ' Resistance_Points: ' . $pokemon['Resistance_Points'] . '<br>';
                echo ' ResistanceType: ' . $pokemon['ResistanceType'] . '<br>';
                echo ' WeaknessType: ' . $pokemon['WeaknessType'] . '<br>';
                echo ' Weakness_Multiplier: ' . $pokemon['Weakness_Multiplier'] . '<br>';

                $specifickPokemon = new Pokemon($pokemon['Pokemon_Name'], $pokemon['EnergyType'], $pokemon['Max_Health'], $pokemon['WeaknessType'], $pokemon['Weakness_Multiplier'], $pokemon['ResistanceType'], $pokemon['Resistance_Points']);


            }
            ?>
        </div>
    </div>
</div>
</body>
</html>