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

<h1>Annot : Proteomics MRM database : delete file</h1>

<form action="mrm_delete_file_exec1.php" method="post">
<center>

<table cellspacing="20" cellpading="1" border="4">
<tr><td>protein file id</td>
    <td><input type="text" size="60" name="id_protein_file" value=""></td>
</tr>
</table>
<input type="submit" value="Submit">
<input type="reset" value="Reset">
</center>
</form>

</body>

</html>
