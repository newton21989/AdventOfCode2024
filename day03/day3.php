<?php

$file = file_get_contents("day3.txt", true);
if(!$file)
  die("Colud not open input file.");

$m = [];
preg_match_all('/do\(\)|don\'t\(\)|mul\((\d+),(\d+)\)/', trim($file), $m);

//var_dump($m);

$out1 = 0;
foreach($m[0] as $k=>$n) {
  //ignore part 2 nonsense for now
  if($n == "do()" || $n == "don't()") {
    continue; }
  //echo $m[1][$k] . " * " . $m[2][$k] . "\n";
  $out1 += $m[1][$k] * $m[2][$k];
}

$out2 = 0;
$do = true;
foreach($m[0] as $k=>$n) {
  if($n == "do()") {
    $do = true; }
  elseif($n == "don't()") {
    $do = false; }
  elseif(str_starts_with($n, "mul(") && $do) {
    $out2 += $m[1][$k] * $m[2][$k];
  }
}

echo "Day 3 part 1 answer: $out1\n";
echo "Day 3 part 2 answer: $out2\n";
