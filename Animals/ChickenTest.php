<?php
/* @author Mike Parda
 * Ok now some basic unit testing somewhat set up for PHPUNIT... 
 * Full disclaimer: I did not run this at all, these are just examples of roughly how some simple test cases would look
 */
require_once 'Chicken.class.php';
use PHPUnit\Framework\TestCase;
class ChickenTest extends TestCase
{
    public function testChickenCreation()
    {
        $this->assertInstanceOf(Chicken::class, new Chicken("kaw kaw", true, true));
    }
    
    public function testSomeChickenAttributes() 
    {
        $this->assertObjectHasAttribute('name', Chicken::class);
        $this->assertObjectHasAttribute('sound', Chicken::class);
        $this->assertObjectHasAttribute('isHappy', Chicken::class);
        $this->assertObjectHasAttribute('weight', Chicken::class);
    }
    
    public function testChickenRename() 
    {
        $Chicken = new Chicken("kaw kaw", true, true);
        $Chicken->reNameChicken("Mike");
        $this->expectOutputString('Mike');
        print $Chicken->getName();
    }
    
    public function testEggLaying() 
    {
        $Chicken = new Chicken("kaw kaw", true, true);
        $eggResult = $Chicken->layEggs();
        // Should always lay eggs because the chick is initialized with an egg laying capability of 30 eggs
        $this->assertTrue($eggResult->result);
    }
    
    public function testFreeRangeIsBool() 
    {
        $Chicken = new Chicken("kaw kaw", true, true);
        $this->assertInternalType('boolean', $Chicken->getIsFreeRange());
    }
}
