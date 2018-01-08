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

<?php

$date = mycurrentdate(); // from lib.php

?>

<h1>Annot : Proteomics MRM database : add file</h1>

<form enctype="multipart/form-data" action="mrm_add_file_exec1.php" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
<center>

<table cellspacing="20" cellpading="1" border="4">
<tr><td>Select ssv protein file</td>
    <td><input type="file" size="60" name="id_protein_file" value=""></td>
</tr>
<tr><td>Select ssv peptide file</td>
    <td><input type="file" size="60" name="id_peptide_file" value=""></td>
</tr>
<tr><td>Date</td>
    <td><input type="text" size="60" name="date" value="<?php print($date); ?>"></td>
</tr>
</table>
<input type="submit" value="Submit">
<input type="reset" value="Reset">
</center>
</form>

</body>

</html>
