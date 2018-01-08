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

$id_protein_file = $_SESSION["id_protein_file"];
//
$user_name = $_POST["user_name"];
$user_description = $_POST["user_description"];
//$date = $_SESSION["date"];
//$project_name = $_POST["project_name"];
$sample_name = $_POST["sample_name"];
$analysis_method = $_POST["analysis_method"];
$validation_method = $_POST["validation_method"];

$connexion = db_connect(NAME,PASSWORD,SERVER,BASE);

$query = "update annot_mrm.protein_info set";
$query .= " user_name = '" . addslashes($user_name) . "',";
$query .= " user_description = '" . addslashes($user_description) . "',";
//$query .= " date = '" . addslashes($date) . "',";
//$query .= " project_name = '" . addslashes($project_name) . "',";
$query .= " sample_name = '" . addslashes($sample_name) . "',";
$query .= " analysis_method = '" . addslashes($analysis_method) . "',";
$query .= " validation_method = '" . addslashes($validation_method) . "'";
//$query .= " protein_filename = '" . addslashes($protein_filename) . "',";
//$query .= " peptide_filename = '" . addslashes($peptide_filename) . "',";
$query .= " where protein_id = " . $id_protein_file . " limit 1;";

$result = db_exec_query($query,$connexion);

?>

<h1>Annot : Proteomics MRM database : edit file</h1>

<h2>Protein file updated</h2>

</body>

</html>
