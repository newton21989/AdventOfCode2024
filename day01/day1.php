<?php
$l1 = [];
$l2 = [];

$file = file_get_contents("day1.txt", true);
if(!$file)
  die("Colud not open input file.");

$lines = explode("\n", $file);
foreach($lines as $line) {
  $l = explode("   ", $line);
  //echo "$line = " . $l[0] . ", " . $l[1] . "\n";
  if(!is_null($l[0]) && !is_null($l[1])) {
    array_push($l1, $l[0]);
    array_push($l2, $l[1]);
  }
}

//var_dump($l1, $l2);

array_multisort($l1);
array_multisort($l2);

$ans = 0;
foreach($l1 as $k=>$l) {
  $ans += abs($l - $l2[$k]);
}

echo "Day 1 part 1 answer: $ans";
