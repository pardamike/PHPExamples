<?php
/* @author Mike Parda
 * Some basic testing you can run in the browser
 */
require_once 'Chicken.class.php';

$Chicken = new Chicken('kaw kaaaaw', true, true);

echo $Chicken->howAreYouDoing();
echo '<br>';
echo $Chicken->makeNoise();
$Chicken->reNameChicken('John');
echo '<br>';
echo $Chicken->getName();
$Chicken->teachNewNoise('cokadoodledoooo');
echo '<br>';
echo $Chicken->makeNoise();
echo '<br>';
echo $Chicken->howManyEggsCanYouLay();
echo $Chicken->putInCage();
echo '<br>';
echo $Chicken->howManyEggsCanYouLay();
echo $Chicken->setFree();
echo '<br>';
echo $Chicken->howManyEggsCanYouLay();
$layEggs = $Chicken->layEggs();
echo $layEggs->message;
$layEggs = $Chicken->layEggs();
echo $layEggs->message;
$layEggs = $Chicken->layEggs();
echo $layEggs->message;
$layEggs = $Chicken->layEggs();
echo $layEggs->message;
$layEggs = $Chicken->layEggs();
echo $layEggs->message;
$Chicken->feedChicken();
$Chicken->feedChicken();
$Chicken->feedChicken();
$layEggs = $Chicken->layEggs();
echo $layEggs->message;
$layEggs = $Chicken->layEggs();
echo $layEggs->message;
$Chicken->cookChicken();
