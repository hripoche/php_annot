<?php

// Author: Hugues Ripoche
// Copyright (c) 2002-2011
// License: BSD Style.
// php version: 4.x

require("lib.php");

check_connection();

$stdout = $_SESSION['id_file'];
$array_column_filter = $_GET['columns'];
$search = $_GET['search'];
$output_type = $_GET['output_type'];

$array_lines = file($stdout);
foreach($array_lines as $key => $value) {
  if ($search != "") {
    if (stristr($value,$search)) {
      $array_line_filter[] = $key;
    }
  } else {
    $array_line_filter[] = $key;
  }
}

if ($output_type == "xls") {
  tab_delimited_to_excel_with_filter($stdout,$array_line_filter,$array_column_filter);
}

if ($output_type == "html") {

?>

<html>
<head>
<title>Annot</title>
</head>

<body bgcolor="#f9f0d1">

<h1> Annot </h1>

<?php

tab_delimited_to_html_table_with_filter($stdout,$array_line_filter,$array_column_filter);

?>

</body>

</html>

<?php
} // end html
?>
