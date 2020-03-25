<?php
// ------------ Data base connect ------------ //

// Database connection
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


// ------------ Get all ------------ //

// Get all Pokemon names
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

// Get all Pokemons data
function GetAllPokemonsData()
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT
    p.Pokemon_Name,
    p.Max_Health,
    p.Resistance_Points,
    p.Weakness_Multiplier,
	ET.EnergyType_Name 	AS EnergyType,
    ETC.Color 			AS EnergyTypeColor,
    RT.EnergyType_Name 	AS ResistanceType,
    RTC.Color 			AS ResistanceTypeColor,
    WT.EnergyType_Name 	AS WeaknessType,
    WTC.Color 			AS WeaknessTypeColor
FROM
	Pokemons AS p
JOIN EnergyTypes AS ET 	ON p.EnergyType_Id 		= ET.Id
JOIN EnergyTypes AS ETC ON p.EnergyType_Id 		= ETC.Id
JOIN EnergyTypes AS RT 	ON p.Resistance_Type_Id = RT.Id
JOIN EnergyTypes AS RTC ON p.Resistance_Type_Id	= RTC.Id
JOIN EnergyTypes AS WT 	ON p.Weakness_Type_Id 	= WT.Id
JOIN EnergyTypes AS WTC ON p.Weakness_Type_Id	= WTC.Id");
    $query->execute();
    $conn = null;
    return $query->fetchAll();
}

// Get all Pokemon attacks
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

function GetAllEnergyTypes()
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT 
    EnergyType_Name
FROM EnergyTypes");
    $query->execute();
    $conn = null;
    return $query->fetchAll();
}


// ------------ Get Data ------------ //

// Get attack data
function GetAttackData($attack_id)
{
    $conn = dbConnect();
    $query = $conn->prepare("
SELECT
	*
FROM
	Attacks
WHERE Id = :Id");
    $query->execute([':Id' => $attack_id]);
    $conn = null;
    return $query->fetchAll();
}

// Get Pokemon data by id
function GetPokemonData($pokemon_id)
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
JOIN EnergyTypes AS WT ON p.Weakness_Type_Id = WT.Id
WHERE p.Id = :Id");
    $query->execute([':Id' => $pokemon_id]);
    $conn = null;
    return $query->fetchAll();
}