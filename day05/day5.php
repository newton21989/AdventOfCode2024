<?php

$file = file_get_contents("day5.txt", true);
if(!$file)
  die("Colud not open input file.");

$split1 = explode("\n\n", trim($file));
$rules = explode("\n", trim($split1[0]));
$updates = explode("\n", trim($split1[1]));

$r = [];
foreach($rules as $rule) {
  $exp = explode("|", trim($rule));
  if(!isset($r[(string)$exp[0]])) {
    $r[(string)$exp[0]] = [$exp[1]];
  }
  else {
    array_push($r[(string)$exp[0]], $exp[1]);
  }
}

$uparr = [];
foreach($updates as $u) {
  array_push($uparr, explode(",", trim($u)));
}

$upvalid = [];
foreach($uparr as $u) {
  for($i = 1; $i < count($u); $i++) {
    for($j = $i - 1; $j >= 0; $j--) {
      if(in_array($u[$j], $r[(string)$u[$i]])) {
        continue 3;
      }
    }
  }
  array_push($upvalid, $u);
}

$out1 = 0;
foreach($upvalid as $u) {
  $mid = $u[ceil((count($u) - 1) / 2)];
  $out1 += $mid;
}

echo "Day 5 part 1: $out1";
