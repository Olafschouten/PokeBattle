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
    }

    // Getters
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

    // Setters
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $energyType
     */
    public function setEnergyType($energyType)
    {
        $this->energyType = $energyType;
    }

    /**
     * @param mixed $max_Health
     */
    public function setMaxHealth($max_Health)
    {
        $this->max_Health = $max_Health;
    }

    /**
     * @param mixed $health
     */
    public function setHealth($health)
    {
        $this->health = $health;
    }

    /**
     * @param mixed $weakness
     */
    public function setWeakness($weakness)
    {
        $this->weakness = $weakness;
    }

    /**
     * @param mixed $weakness_multiplier
     */
    public function setWeaknessMultiplier($weakness_multiplier)
    {
        $this->weakness_multiplier = $weakness_multiplier;
    }

    /**
     * @param mixed $resistance
     */
    public function setResistance($resistance)
    {
        $this->resistance = $resistance;
    }

    /**
     * @param mixed $resistance_points
     */
    public function setResistancePoints($resistance_points)
    {
        $this->resistance_points = $resistance_points;
    }

    public function fight($againstPokemon, $attack)
    {
        if (!isset($_SESSION['pokemon_health'])) {
            $_SESSION['pokemon_health'] = $this->health;
            $_SESSION['against_pokemon_health'] = $againstPokemon->getHealth();
            $_SESSION['round_count'] = 1;
        }

        while ($_SESSION['against_pokemon_health'] >= 1 && $_SESSION['pokemon_health'] >= 1) {
            if (!$_SESSION['against_pokemon_health'] <= 0) {
                if ($this->energyType == $againstPokemon->getWeakness()) {
                    $_SESSION['against_pokemon_health'] = $_SESSION['against_pokemon_health'] - ($attack[0]['Hit_Points'] * 1.3);
                } else if ($this->energyType == $againstPokemon->getResistance()) {
                    $_SESSION['against_pokemon_health'] = $_SESSION['against_pokemon_health'] - ($attack[0]['Hit_Points'] * 0.7);
                } else {
                    $_SESSION['against_pokemon_health'] = $_SESSION['against_pokemon_health'] - $attack[0]['Hit_Points'];
                }
                echo '<br>';

                $_SESSION['pokemon_health'] = $_SESSION['pokemon_health'] - 10;

                if ($_SESSION['against_pokemon_health'] <= 0) {
                    $_SESSION['against_pokemon_health'] = 0;
                    echo 'You won!' . '<br>';
                } else if ($_SESSION['pokemon_health'] <= 0) {
                    $_SESSION['pokemon_health'] = 0;
                    echo 'You loose!' . '<br>';
                }
                echo 'Round: ' . $_SESSION['round_count'] . '<br>';
                echo 'Your pokemon: ' . $_SESSION['pokemon_health'] . ' Health' . '</br>';
                echo 'Pokemon you play against: ' . $_SESSION['against_pokemon_health'] . ' Health' . '</br>';
                $_SESSION['round_count']++;
            }
        }
    }

//    public function getPopulation($againstPokemon)
//    {
//        if ($this->health >= 1 && $againstPokemon->getHealth() >= 1) {
//            echo $againstPokemon->getHealth() . '<br>';
//            return TRUE;
//        } else {
//            echo $againstPokemon->getHealth() . '<br>';
//            return FALSE;
//        }
//    }
}