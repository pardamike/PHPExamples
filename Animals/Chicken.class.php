<?php
/* @author Mike Parda
 * Chicken class for creating new chickens, child to Animal class
 */
require_once __DIR__.DIRECTORY_SEPARATOR.'Animal.class.php';

class Chicken extends Animal
{
    // Private class variables because these only apply to this class and we do not want them changed manually when the class is used
    private $sound;          // String
    private $isFreeRange;    // Bool
    private $isHappy;        // Bool
    private $maxEggs;        // Int
    const DEFAULT_START_EGGS = 30;
    const DEFAULT_ADD_EGGS = 10;
    const DEFAULT_MINUS_EGGS = 10;

    // Params for parent are optional since the parent class will set them if they are not sent in or are sent incorrectly
    // We will assume child class (Chicken) has params that are sent in, will do some error handeling if they are not
    public function __construct($sound, $isFreeRange, $isHappy, $name = false, $healthLevel = false, $weight = false)
    {
        parent::__construct($name, $healthLevel, $weight);

        // Set the Chicken up... handle any inproper inputs for each variable
        try {
            $this->setSound($sound);
            $this->setIsFreeRange($isFreeRange);
            $this->setIsHappy($isHappy);
            $this->setMaxEggs(self::DEFAULT_START_EGGS);
        } catch (Exception $ex) {
            echo 'Exception thrown in class Chicken with message: '.$ex->getMessage();
            exit();
        }
    }

    // Generic and boring setters and getters for the Chicken class
    // Setters (private so that they cannot be called in the code, they must be changed with certain public methods of this class)
    private function setSound($sound)
    {
        if (gettype($sound) === 'string') {
            $this->sound = $sound;
        } else {
            throw new Exception('Sound must be a string, type of '.gettype($sound).' was sent in.');
        }
    }

    private function setIsHappy($isHappy)
    {
        if (gettype($isHappy) === 'boolean') {
            $this->isHappy = $isHappy;
        } else {
            throw new Exception('Happiness must be a boolean, type of '.gettype($isHappy).' was sent in.');
        }
    }

    private function setIsFreeRange($isFreeRange)
    {
        if (gettype($isFreeRange) === 'boolean') {
            $this->isFreeRange = $isFreeRange;
        } else {
            throw new Exception('Free range variable must be a boolean, type of '.gettype($isFreeRange).' was sent in.');
        }
    }

    private function setMaxEggs($eggCount)
    {
        if (gettype($eggCount) === 'integer') {
            $this->maxEggs = $eggCount;
        } else {
            throw new Exception('Max eggs variable must be an integer, type of '.gettype($eggCount).' was sent in.');
        }
    }

    // Getters are all public becauae we dont care if anyone else sees them
    public function getSound()
    {
        return $this->sound;
    }

    public function getIsHappy()
    {
        return $this->isHappy;
    }

    public function getIsFreeRange()
    {
        return $this->isFreeRange;
    }

    public function getMaxEggs()
    {
        return $this->maxEggs;
    }
    // END of setters and getters

    // Ok now some fun class-specific methods that we can use in our code

    // When the chicken becomes happy, it will lay more eggs, this method should only be accessible by this class and is private
    // This is private because we only want to have this function called inside this class
    private function makeHappy()
    {
        $this->setMaxEggs(($this->getMaxEggs() + self::DEFAULT_ADD_EGGS));
        $this->setIsHappy(true);
    }

    // When the chicken becomes unhappy, it will lay less eggs, this method should only be accessible by this class and is private
    // This is private because we only want to have this function called inside this class
    private function makeUnhappy()
    {
        $this->setMaxEggs(($this->getMaxEggs() - self::DEFAULT_MINUS_EGGS));
        $this->setIsHappy(false);
    }

    // Calculate the max eggs a chicken can lay, free range chickens can lay 2X as many eggs
    public function howManyEggsCanYouLay()
    {
        return $this->getIsFreeRange() ? ($this->getMaxEggs() * 2) : $this->getMaxEggs();
    }

    public function teachNewNoise($newNoise)
    {
        try {
            $this->setSound($newNoise);
        } catch (Exception $ex) {
            echo 'Exception thrown in class Chicken with message: '.$ex->getMessage();
        }
    }

    /*
     * Makes the chicken lay eggs, returns an object with the egg laying results:
     * eggsLaid = number of eggs chicken laid
     * message = result of egg laying
     * result = boolean of the result
     * NOTE*** if chicken is free range it can lay 2X more eggs, and if it has become unhappy too many times, it will not lay eggs
     * Also laying eggs will cause the chicken to lay less egds next time
     */
    public function layEggs()
    {
        $result = new stdClass();
        // Check and see if the chicken can lay eggs (if you have made it unhappy too much, it will not lay eggs)
        if ($this->maxEggs <= 0) {
            $result->eggsLaid = 0;
            $result->message = '<br>The chicken is refusing to lay eggs.  Feed it or make it free range to increase egg production<br>';
            $result->result = false;
        } else {
            // Chicken can only lay up to its max eggs... if it is free range it will lay 2X more eggs
            $numberOfEggs = rand(1, $this->howManyEggsCanYouLay());

            $result->eggsLaid = $numberOfEggs;
            $result->message = "<br>The chicken has laid $numberOfEggs eggs!<br>";
            $result->result = true;

            // Laying eggs is laborous... the chicken is not happy about this
            $this->makeUnhappy();
        }

        return $result;
    }

    public function feedChicken()
    {
        // Chickens enjoy food, now it is happy but also getting fatter
        $this->setWeight(($this->getWeight() + 5));
        $this->makeHappy();
    }

    // Make it a free range chicken, and thus it will be happy
    public function setFree()
    {
        if (!$this->getIsFreeRange()) {
            $this->makeHappy();
            $this->setIsFreeRange(true);
        }
    }

    // Putting it in a cage makes it not happy
    public function putInCage()
    {
        if ($this->getIsFreeRange()) {
            $this->makeUnhappy();
            $this->setIsFreeRange(false);
        }
    }

    // Let the chicken make its noise
    public function makeNoise()
    {
        return $this->getSound().'!!!';
    }

    // Rename the chicken
    public function reNameChicken($newName)
    {
        parent::setName($newName);
    }

    // Eat the chicken?...
    public function cookChicken()
    {
        echo '<hr>Cooking chicken...<br>';
        parent::setHealthLevel(0);
        $this->setIsHappy(false);
        $this->maxEggs = 0;
        $this->setSound('None');
        $this->setIsFreeRange(false);
        echo parent::howAreYouDoing();
        exit(); // Irony
    }
}
