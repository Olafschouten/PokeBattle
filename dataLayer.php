<?php

// database connection
function dbConnect()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "PokeBattle";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

// Gets all Pokemon names
function GetAllPokemonNames()
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT 
    Id,
    Pokemon_Name
FROM Pokemons");
    $query->execute();
    $conn = null;
    return $query->fetchAll();
}

// Gets all Pokemons data
function GetAllPokemonsData()
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT
    p.Pokemon_Name,
    p.Max_Health,
    p.Resistance_Points,
    p.Weakness_Multiplier,
	ET.EnergyType_Name AS EnergyType,
    RT.EnergyType_Name AS ResistanceType,
    WT.EnergyType_Name AS WeaknessType
FROM
	Pokemons AS p
JOIN EnergyTypes AS ET ON p.EnergyType_Id = ET.Id
JOIN EnergyTypes AS RT ON p.Resistance_Type_Id = RT.Id
JOIN EnergyTypes AS WT ON p.Weakness_Type_Id = WT.Id");
    $query->execute();
    $conn = null;
    return $query->fetchAll();
}

// Gets all Pokemon attacks
function GetAllPokemonAttacks()
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT
	p.Id,
    Attacks.Attack_Name
FROM
	Pokemons AS p
JOIN Attacks ON p.Id = Attacks.Pokemon_Id");
    $query->execute();
    $conn = null;
    return $query->fetchAll();
}

// Gets all Pokemon attacks
//function GetPokemonAttacks($id)
//{
//    $conn = dbConnect();
//    $query = $conn->prepare("
//SELECT
//	p.Id,
//    Attacks.Attack_Name
//FROM
//	Pokemons AS p
//JOIN Attacks ON p.Id = Attacks.Pokemon_Id");
//    $query->execute($id);
//    $conn = null;
//    return $query->fetchAll();
//}

// Gets Pokemon stats
function GetPokemonStats($data)
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT
	*
FROM
	Pokemons
WHERE Pokemon_Name = :pokemon_name");
    $query->execute([':pokemon_name' => $data['pokemon_name']]);
    $conn = null;
    return $query->fetchAll();
}

// Gets data attack
function GetPokemonAttack($data)
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT
	*
FROM
	Attacks
WHERE Attack_Name = :attack");
    $query->execute([':attack' => $data['attack']]);
    $conn = null;
    return $query->fetchAll();
}

// Gets data form Pokemon you fight against
function GetPokemonAttackStats($data)
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT
	*
FROM
	Pokemons
WHERE Pokemon_Name = :pokemon_attack");
    $query->execute([':pokemon_attack' => $data['pokemon_attack']]);
    $conn = null;
    return $query->fetchAll();
}

// Fight functions
function ShowData($data)
{
    echo $data['pokemon_name'] . '</br>';
    echo "<pre>", var_dump(GetPokemonStats($data)), "</pre>";

    $pokemon_stats = GetPokemonStats($data);

    echo $data['attack'] . '</br>';
    echo "<pre>", var_dump(GetPokemonAttack($data)), "</pre>";

    $attack_stats = GetPokemonAttack($data);

    echo $data['pokemon_attack'] . '</br>';
    echo "<pre>", var_dump(GetPokemonAttackStats($data)), "</pre>";

    $pokemon_attack = GetPokemonAttackStats($data);

    Fight($pokemon_stats, $attack_stats, $pokemon_attack);
}

function Fight($pokemon_stats, $attack_stats, $pokemon_attack)
{
    $health = $pokemon_attack[0]['Max_Health'];
    if (!$health <= 0) {
        $health = $health - $attack_stats[0]['Resistance_Points'];
        if (!$health <= 0) {
            echo 'You won!!';
        }
        echo $health;
    } else {
        echo 'You won!';
    }
}