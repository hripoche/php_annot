<?php

// Author: Hugues Ripoche
// Copyright (c) 2002-2011
// License: BSD Style.
// php version: 4.x

$db_gene = "/db/gene/";

// structure

$gene_metadata = "gene_metadata.txt";

$array_lines = file($gene_metadata);

foreach ($array_lines as $key => $value) {
  $array_item = split("\t",$value);
  $array_files['name'] = $array_item[0];
  $array_files['filename'] = $db_gene . $array_item[1] . "/" . $array_item[0];
  $array_files['fields'] = array();
}

?>