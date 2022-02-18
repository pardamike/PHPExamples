<?php
/* @author Mike Parda
 * Animal class... parent class for creating new, generic animals
 */
class Animal
{
    // Generic variables all animals would need
    protected $name;
    protected $healthLevel;
    protected $weight;

    // All params are optional, if not set they will get the defaults defined in the contructor
    // Constructor is protected because we do not want to be making new Animals, this is just a base class and should be extended...
    // Alternativly we could make this an abstract class, so it cannot be instantiated, but that is a whole other topic
    protected function __construct($name = false, $healthLevel = false, $weight = false)
    {
        // Default name of "Le Animal" for no particular reason
        $animalName = ($name ? $name : 'Le Animal');

        // Default to healthLevel of 100
        $animalHealth = ($healthLevel ? $healthLevel : 100);

        // Default weight of 20
        $animalWeight = ($weight ? $weight : 20);

        // Ok now lets try and set up the Animal
        try {
            $this->setHealthLevel($animalHealth);
            $this->setName($animalName);
            $this->setWeight($animalWeight);
        } catch (Exception $ex) {
            echo 'Failed to create new parent Animal class, failed with message: '.$ex->getMessage();
            exit();
        }
    }

    // Basic getters and setters below should we need to change or get any of thie animals basic info:
    // Public getters
    public function getWeight()
    {
        return $this->weight;
    }

    public function getHealthLevel()
    {
        return $this->healthLevel;
    }

    public function getName()
    {
        return $this->name;
    }

    // Random function to check how the animal is doing... returns string of the animals status
    public function howAreYouDoing()
    {
        $health = $this->healthLevel;
        $status = '';
        switch (true) {
          case $health >= 70:
              $status = 'Awesome';
              break;
          case $health < 70 && $health >= 20:
              $status = 'Meh';
              break;
          case $health < 20 && $health > 0:
              $status = 'Bad';
              break;
          case $health <= 0:
              $status = 'El Muerto';
              break;
          default:
              $status = 'Error';  // In theory we should never get here
              break;
      }

        return $status;
    }

    // Protected setters so only children can use them
    protected function setWeight($newWeight)
    {
        if (gettype($newWeight) === 'integer') {
            $this->name = $newWeight;
        } else {
            throw new Exception('Weight must be an integer, type of '.gettype($newWeight).' was sent in');
        }
        $this->weight = $newWeight;
    }

    protected function setHealthLevel($newHealth)
    {
        if (gettype($newHealth) === 'integer') {
            $this->name = $newHealth;
        } else {
            throw new Exception('Health Level must be an integer, type of '.gettype($newHealth).' was sent in');
        }
        $this->healthLevel = $newHealth;
    }

    protected function setName($newName)
    {
        if (gettype($newName) === 'string') {
            $this->name = $newName;
        } else {
            throw new Exception('Name must be a string, type of '.gettype($newName).' was sent in');
        }
    }
}
