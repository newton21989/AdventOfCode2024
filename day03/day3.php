<?php

$file = file_get_contents("day3.txt", true);
if(!$file)
  die("Colud not open input file.");

$m = [];
preg_match_all('/mul\((\d+),(\d+)\)/', trim($file), $m);

//var_dump($m);

$out1 = 0;
foreach($m[0] as $k=>$n) {
  //echo $m[1][$k] . " * " . $m[2][$k] . "\n";
  $out1 += $m[1][$k] * $m[2][$k];
}

echo "Day 3 part 1 answer: $out1";
