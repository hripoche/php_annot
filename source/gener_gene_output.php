<?php

// Author: Hugues Ripoche
// Copyright (c) 2002-2011
// License: BSD Style.
// php version: 4.x

require("lib.php");

check_connection();

$stdout = $_SESSION['id_file'];
$output_type = $_GET['output_type'];

if ($output_type == "xls") {
  tab_delimited_to_excel($stdout);
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

tab_delimited_to_html_table($stdout);

?>

</body>

</html>

<?php
} // end html
?>
