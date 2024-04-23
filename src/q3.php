<?php

// Assumption: for the simplicity of the task and because it is not obvious from description
// I will assume that the tree is NOT nested


$locations = array(
  3 => array("Building1", 2),
  2 => array("Area1", 1),
  0 => array("Floor1", 3),
  1 => array("City1"),
  4 => array("Room1", 0),

  13 => array("Building2", 12),
  12 => array("Area2", 11),
  14 => array("Room2", 10),
  10 => array("Floor2", 13),
  11 => array("City2")
);


class LocationItem
{
  public int $itemKey;
  public string $itemName;
  public bool $isParent;
  public int $childKey;
}

$locationsNew = [];
foreach($locations as $key => $location) {
  $tmp = new LocationItem();
  $tmp->itemKey = $key;
  $tmp->itemName = $location[0];
  $tmp->isParent = count($location) == 1;
  $locationsNew[$key] = $tmp;
}

foreach($locations as $key => $location) {
  if(count($location) > 1) {
    $locationsNew[$location[1]]->childKey = $key;
  }
}

foreach($locationsNew as $location) {

  if($location->isParent){
    while(isset($location->childKey)) {
      echo $location->itemName . ' -> ';
      $location = $locationsNew[$location->childKey];
    }
    echo $location->itemName;
    echo '<br>';
  }
}
