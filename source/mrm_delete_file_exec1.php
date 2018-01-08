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

$id_protein_file = $_POST['id_protein_file'];

$connexion = db_connect(NAME,PASSWORD,SERVER,BASE);

$query = "select user_name, user_description, date, project_name, sample_name, analysis_method, validation_method, protein_filename, peptide_filename from annot_mrm.protein_info where protein_id = " . $id_protein_file . " limit 1;";

$result = db_exec_query($query,$connexion);

$array = mysql_fetch_array($result,MYSQL_ASSOC);

$user_name = $array["user_name"];
$user_description = $array["user_description"];
$date = $array["date"];
$project_name = $array["project_name"];
$sample_name = $array["sample_name"];
$analysis_method = $array["analysis_method"];
$validation_method = $array["validation_method"];
$protein_filename = $array["protein_filename"];
$peptide_filename = $array["peptide_filename"];

$_SESSION["id_protein_file"] = $id_protein_file;

?>

<h1>Annot : Proteomics MRM database : delete file</h1>

<center>

<?php
if ($result) {
  print('<form action="mrm_delete_file_exec2.php" method="post">');
} else {
  print('<font color="#ff0000">');
  print("Error: missing protein file<br>");
  print('</font>');
}
?>

<table cellspacing="20" cellpading="1" border="4">
<tr><td>User name</td>
    <td><?php print($user_name); ?></td>
</tr>
<tr><td>User description</td>
    <td><?php print($user_description); ?></td>
</tr>
<tr><td>Date</td>
    <td><?php print($date); ?></td>
</tr>
<tr><td>Project name</td>
    <td><?php print($project_name); ?></td>
</tr>
<tr><td>Sample name</td>
    <td><?php print($sample_name); ?></td>
</tr>
<tr><td>Analysis method</td>
    <td><?php print($analysis_method); ?></td>
</tr>
<tr><td>Validation method</td>
    <td><?php print($validation_method); ?></td>
</tr>
<tr><td>Protein filename</td>
    <td><?php print($protein_filename); ?></td>
</tr>
<tr><td>Peptide filename</td>
    <td><?php print($peptide_filename); ?></td>
</tr>
</table>
<?php
if ($result) {
  print('<input type="submit" value="Submit">');
  print('<input type="reset" value="Reset">');
  print('</form>');
}
?>
</center>

</body>

</html>
