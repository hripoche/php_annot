<?php

$source_dir = "http://www.godatabase.org/dev/database/archive/latest/";
$target_dir = "/db/gosql/";

function list_directory ($directory) {
  if ($dir = opendir($directory)) {
    while ($file = readdir($dir)) {
      if (!is_dir($file)) {
        $list_of_files[] = $file;
      }
    }
  }
  closedir($dir);
  return $list_of_files;
}

$array = list_directory($source_dir);

foreach ($array as $filename) {
  $source_file = $source_dir . $filename;
  $target_file = $target_dir . $filename;
  if (copy($source_file,$target_file)) {
    print("copy ok: " . $file . "\n");
  } else {
    print("error copying: " . $file . "\n");
  }
}

?>
