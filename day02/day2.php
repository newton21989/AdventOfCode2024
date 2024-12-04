<?php
/**
 * Determine whether unusual data is safe.
 * @param Array $line Array of readings
 * @return bool
 */
function is_safe($line) {
  $dir = "";
  for($i = 1; $i < count($line); $i++) {
    $mag = $line[$i] - $line[$i-1];
    if(abs($mag) > 3 or $mag == 0) {
      return false;
    }
    
    if($mag > 0) {
      $thisdir = "incr";
    }
    elseif($mag < 0) {
      $thisdir = "decr";
    }

    if($i == 1) {
      $dir = $thisdir;
    }
    elseif($thisdir != $dir) {
      return false;
    }
  }
  return true;
}

$file = file_get_contents("day2.txt", true);
if(!$file)
  die("Colud not open input file.");

$lines = explode("\n", trim($file));

$out = 0;
foreach($lines as $line) {
  $l = explode(" ", trim($line));
  if(is_safe($l)) {
    $out++;
  }
}

echo "Day 2 part 1: $out\n";