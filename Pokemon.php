<?php

class Pokemon
{
    // Properties
    private $name = '';
    private $energyType = '';
    private $max_Health = 0;
    private $health = 0;
    private $weakness = '';
    private $weakness_multiplier = 0;
    private $resistance = '';
    private $resistance_points = 0;

    public function __construct($data)
    {
        $this->name = $data[0]['Pokemon_Name'];
        $this->energyType = $data[0]['EnergyType'];
        $this->max_Health = $data[0]['Max_Health'];
        $this->health = $data[0]['Max_Health'];
        $this->weakness = $data[0]['WeaknessType'];
        $this->weakness_multiplier = $data[0]['Weakness_Multiplier'];
        $this->resistance = $data[0]['ResistanceType'];
        $this->resistance_points = $data[0]['Resistance_Points'];
        $_SESSION['health'] = 50;
    }

    // All getter functions
    public function getName()
    {
        return $this->name;
    }

    public function getEnergyType()
    {
        return $this->energyType;
    }

    public function getMaxHealth()
    {
        return $this->max_Health;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getWeakness()
    {
        return $this->weakness;
    }

    public function getWeaknessMultiplier()
    {
        return $this->weakness_multiplier;
    }

    public function getResistance()
    {
        return $this->resistance;
    }

    public function getResistancePoints()
    {
        return $this->resistance_points;
    }

    public function fight($againstPokemon, $attack)
    {
        $againstPokemonHealth = $againstPokemon->getHealth() - $attack[0]['Hit_Points'];
        $this->health = $this->health - 15;


//        echo $againstPokemonHealth . '<br>';

        if ($this->getPopulation($againstPokemon) === TRUE) {
            echo ' The game isnt over jet' . '<br>';
        }
    }

    public function getPopulation($againstPokemon)
    {
        if ($this->health >= 1 && $againstPokemon->getHealth() >= 1) {
            echo $againstPokemon->getHealth() . '<br>';
            return TRUE;
        } else {
            echo $againstPokemon->getHealth() . '<br>';
            return FALSE;
        }
    }
}