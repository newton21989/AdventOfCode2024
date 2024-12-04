<?php
$l1 = [];
$l2 = [];

$file = file_get_contents("day1.txt", true);
if(!$file)
  die("Colud not open input file.");

$lines = explode("\n", trim($file));

foreach($lines as $line) {
  $l = explode("   ", trim($line));
  //echo "$line = " . $l[0] . ", " . $l[1] . "\n";
  if(!is_null($l[0]) && !is_null($l[1])) {
    array_push($l1, $l[0]);
    array_push($l2, $l[1]);
  }
}

//var_dump($l1, $l2);

//part 2
$freqs = [];
foreach($l2 as $l) {
  if(!key_exists((string)$l, $freqs)) {
    $freqs[$l] = 0;
  }
  $freqs[(string)$l]++;
}

$ans2 = 0;
foreach($l1 as $l) {
  $freq = $freqs[(string)$l] ?? 0;
  $ans2 += $l * $freq;
}

//part 1
array_multisort($l1);
array_multisort($l2);

$ans = 0;
foreach($l1 as $k=>$l) {
  $ans += abs($l - $l2[$k]);
}

echo "Day 1 part 1 answer: $ans\n";
echo "Day 1 part 2 answer: $ans2\n";
