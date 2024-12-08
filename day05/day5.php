<?php

$file = file_get_contents("day5.txt", true);
if(!$file)
  die("Colud not open input file.");

$split1 = explode("\n\n", trim($file));
$rules = explode("\n", trim($split1[0]));
$updates = explode("\n", trim($split1[1]));

/** Array of sorting rules 
 * @var array $r
*/
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

/** Array of update runs 
 * @var array $uparr
*/
$uparr = [];
foreach($updates as $u) {
  array_push($uparr, explode(",", trim($u)));
}

/** Update runs which are valid 
 * @var array $upvalid
*/
$upvalid = [];
/** Update runs which are invalid 
 * @var array $upinvalid
*/
$upinvalid = [];
foreach($uparr as $u) {
  for($i = 1; $i < count($u); $i++) {
    if(!isset($r[(string)$u[$i]])) {
      continue;
    }

    for($j = $i - 1; $j >= 0; $j--) {
      if(in_array($u[$j], $r[(string)$u[$i]])) {
        array_push($upinvalid, $u);
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

echo "Day 5 part 1: $out1\n";

foreach($upinvalid as $k=>$u) {
  $i = 1;
  while($i < count($u)) {
    for($j = $i - 1; $j >= 0; $j--) {
      if(!isset($r[(string)$u[$i]])) {
        continue;
      }
      if(in_array($u[$j], $r[(string)$u[$i]])) {
        $upfixed = array_slice($u, 0, $j);
        array_push($upfixed, $u[$i]);
        array_push($upfixed, $u[$j]);
        $upfixed = array_merge($upfixed, array_slice($u, $j + 1, $i - $j - 1));
        $upfixed = array_merge($upfixed, array_slice($u, $i + 1, count($u) - $i - 1));
        $u = $upfixed;
        $i = 1;
        continue 2;
      }
    }
    $i++;
  }
  $upinvalid[$k] = $u;
}

$out2 = 0;
foreach($upinvalid as $u) {
  $mid = $u[ceil((count($u) - 1) / 2)];
  $out2 += $mid;
}

echo "Day 5 part 2: $out2\n";
