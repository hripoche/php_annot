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

$connexion = db_connect(NAME,PASSWORD,SERVER,BASE);

$result = db_exec_query("delete from annot_mrm.protein_info where protein_id = " . $id_protein_file . ";",$connexion);
$result = db_exec_query("delete from annot_mrm.protein_line where protein_id = " . $id_protein_file . ";",$connexion);
$result = db_exec_query("delete from annot_mrm.peptide_line where protein_id = " . $id_protein_file . ";",$connexion);

?>

<h1>Annot : Proteomics MRM database : delete file</h1>

<h2>Protein file deleted</h2>

</body>

</html>
