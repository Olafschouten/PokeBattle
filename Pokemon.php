<?php

class Pokemon
{
    public $firstPokemon;
    public $firstPokemonHealth;
    public $attackDamage;
    public $lastPokemon;
    public $lastPokemonHealth;
    public $CurrentHealthFirstPokemon;
    public $CurrentHealthLastPokemon;

    public function __construct($firstPokemon, $firstPokemonHealth, $attackDamage, $lastPokemon, $lastPokemonHealth)
    {
        $this->firstPokemon = $firstPokemon;
        $this->firstPokemonHealth = $firstPokemonHealth;
        $this->attackDamage = $attackDamage;
        $this->lastPokemon = $lastPokemon;
        $this->lastPokemonHealth = $lastPokemonHealth;
    }

    public function fight()
    {
        if ($this->getPopulation() === TRUE) {
            $healthStatus = $this->getPopulation();

        }
    }

    public function getPopulation()
    {
        if ($this->CurrentHealthFirstPokemon >= 1 && $this->CurrentHealthLastPokemon >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    public function attack()
    {
        $this->CurrentHealthLastPokemon = $this->CurrentHealthLastPokemon - $this->attackDamage;
        $this->CurrentHealthFirstPokemon = $this->CurrentHealthFirstPokemon - 20;

    }

















//    // Properties
//    public $name;
//    public $energyType;
//    public $max_Health;
//    public $health;
//    public $weakness;
//    public $weakness_multiplier;
//    public $resistance;
//    public $resistance_points;
//
//    // Take al the parameters and stets the public variable
//    public function __construct($name, $energyType, $Max_Health, $weakness, $weakness_multiplier, $resistance, $resistance_points)
//    {
//        $this->name = $name;
//        $this->energyType = $energyType;
//        $this->max_Health = $Max_Health;
//        $this->health = $this->max_Health;
//        $this->weakness = $weakness;
//        $this->weakness_multiplier = $weakness_multiplier;
//        $this->resistance = $resistance;
//        $this->resistance_points = $resistance_points;
//    }
//
//    // if the check pokemon is dead or not
//    public function getPopulation()
//    {
//        // returns true of false
//    }
//
//    // function where you can fight with another pokemon
//    public function attack()
//    {
//
//    }
//
//    // if the check pokemon is dead or not
//    public function getPopulationHealth()
//    {
//
//    }
//
//    // converts request to sting
//    public function __toString()
//    {
//        return json_encode($this);
//    }
}