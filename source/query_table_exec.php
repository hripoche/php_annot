<?php

// Author: Hugues Ripoche
// Copyright (c) 2002-2011
// License: BSD Style.
// php version: 4.x

require("lib.php");

check_connection();

$query = build_query_from_array($_GET);
$output_type = $_GET['output_type'];

$connexion = db_connect(NAME,PASSWORD,SERVER,BASE);

$result = db_exec_query_with_check($query,$connexion);

if ($output_type == "xls") {
  query_result_to_excel($result);
} 

if ($output_type == "html") {

?>

<html>
<head>
<title>Annot</title>
</head>

<body bgcolor="#f9f0d1">

<?php

//var_dump($_GET);

print($query);

print("<center>");
query_result_to_html_table($result);
print("</center>");

?>

</body>

</html>

<?php

}

?>
