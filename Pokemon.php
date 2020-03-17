<?php

class Pokemon
{
    // Properties
    public $name;
    public $energyType;
    public $max_Health;
    public $health;
//    public $attacks;
    public $weakness;
    public $weakness_multiplier;
    public $resistance;
    public $resistance_points;

    // Take al the parameters and stets the public variable
    public function __construct($name, $energyType, $Max_Health, $weakness, $weakness_multiplier, $resistance, $resistance_points)
    {
        $this->name = $name;
        $this->energyType = $energyType;
        $this->max_Health = $Max_Health;
        $this->health = $this->max_Health;
//        $this->attacks = $attacks;
        $this->weakness = $weakness;
        $this->weakness_multiplier = $weakness_multiplier;
        $this->resistance = $resistance;
        $this->resistance_points = $resistance_points;
    }

    // if the check pokemon is dead or not
    public function getPopulation()
    {
        // returns true of false
    }

    // function where you can fight with another pokemon
    public function fight()
    {

    }

    // converts request to sting
    public function __toString()
    {
        return json_encode($this);
    }
}