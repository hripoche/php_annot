<?php

// Author: Hugues Ripoche
// Copyright (c) 2002-2011
// License: BSD Style.
// php version: 4.x

require("lib.php");

check_connection();

?>

<html>
<head>
<title>Annot</title>
</head>

<body bgcolor="#f9f0d1">

<h1>Annot : query table</h1>

<form action="query_table_exec.php" method="get">
<center>

<table cellspacing="20" cellpading="1" border="4">
<tr><td>query</td>
    <td>
<?php
$table = $_GET["table"];
query_on_table_to_html($table);
?>
    </td>
</tr>
<tr><td>Result as</td>
    <td><select name="output_type">
        <option value="html">html table</option>
        <option value="xls">excel</option>
        </select>
    </td>
</tr>
</table>
<input type="submit" value="Submit">
<input type="reset" value="Reset">
</center>
</form>

</body>

</html>
