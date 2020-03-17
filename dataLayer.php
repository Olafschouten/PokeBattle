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
SELECT Pokemon_Name
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
SELECT *
FROM Attacks");
    $query->execute();
    $conn = null;
    return $query->fetchAll();
}