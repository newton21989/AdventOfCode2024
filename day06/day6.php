<?php

$file = file_get_contents("day6.txt", true);
if(!$file)
  die("Colud not open input file.");

$rows = explode("\n", trim($file));

class map {
  private $map;

  function get() {
    return $this->map;
  }

  function getObstacle($y, $x) {
    if($this->map[$y][$x] == "#") {
      return true;
    }
    else {
      return false;
    }
  }

  function walk($coord) {
    $this->map[$coord["y"]][$coord["x"]] = "X";
  }

  function update($coord, $symbol) {
    $this->map[$coord["y"]][$coord["x"]] = $symbol;
  }

  function coveredArea() {
    $count = 0;
    foreach($this->map as $y) {
      foreach($y as $x) {
        if($x == "X") {
          $count++;
        }
      }
    }
    return $count;
  }

  function findGuard() {
    foreach($this->map as $k=>$y) {
      $x = array_search("^", $y);
      if($x) {
        return ["x"=>$x, "y"=>$k];
      }
    }
  }

  function __construct($rows) {
    $map = [];
    foreach($rows as $row) {
      $rowarr = str_split(trim($row));
      array_push($map, $rowarr);
    }
    $this->map = $map;
  }
}

class guard {
  /** Grid coords
   * @var array $location[row][col]
   */
  private $location;

  /** Direction of travel
   * @var string $direction "^"|">"|"<"|"v"
   */
  private $direction;

  /** Map of room
   * @var map $map
   */
  private $map;

  function getObstacle() {
    if($this->direction == "^") {
      return $this->map->getObstacle($this->location["y"] - 1, $this->location["x"]);
    }
    elseif($this->direction == "v") {
      return $this->map->getObstacle($this->location["y"] + 1, $this->location["x"]);
    }
    elseif($this->direction == "<") {
      return $this->map->getObstacle($this->location["y"], $this->location["x"] - 1);
    }
    elseif($this->direction == ">") {
      return $this->map->getObstacle($this->location["y"], $this->location["x"] + 1);
    }
  }

  function turn() {
    if($this->direction == "^") {
      $this->direction = ">";
    }
    elseif($this->direction == ">") {
      $this->direction = "v";
    }
    elseif($this->direction == "v") {
      $this->direction = "<";
    }
    elseif($this->direction == "<") {
      $this->direction = "^";
    }
  }

  function move() {
    if($this->getObstacle()) {
      $this->turn();
    }

    $this->map->walk($this->location);
  
    if($this->direction == "^") {
      $this->location["y"]--;
    }
    elseif($this->direction == "v") {
      $this->location["y"]++;
    }
    elseif($this->direction == "<") {
      $this->location["x"]--;
    }
    elseif($this->direction == ">") {
      $this->location["x"]++;
    }

    //$this->map->update($this->location, $this->direction);
  }

  function isInRoom() {
    if($this->location["y"] < 0) {
      return false;
    }
    elseif($this->location["y"] >= count($this->map->get())) {
      return false;
    }
    elseif($this->location["x"] < 0) {
      return false;
    }
    elseif($this->location["x"] >= count($this->map->get()[0])) {
      return false;
    }
    else {
      return true;
    }
  }

  /**
   * @param array $location [$row, $col]
   * @param string $direction "^"|">"|"<"|"v"
   */
  function __construct($location, $direction, $map) {
    $this->direction = $direction;
    $this->location["x"] = $location["x"];
    $this->location["y"] = $location["y"];
    $this->map = $map;
  }
}

$map = new map($rows);
$guard = new guard($map->findGuard(), "^", $map);

while($guard->isInRoom()) {
  $guard->move();
}

echo "Day 6 part 1: " . $map->coveredArea() . "\n";
