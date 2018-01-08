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

$stdin = $_SESSION["gal_file"];
$array_gal = $_SESSION["gal_array"];
$filename = $_SESSION["filename"];
$user_name = $_POST["user_name"];
$user_description = $_POST["user_description"];

if (file_exists($stdin)) {

  $connexion = db_connect(NAME,PASSWORD,SERVER,BASE);

  $query = "insert into annot_user.array_info(user_name,user_description,filename,type,blockcount,blocktype,url,supplier,array_name) values(";
  $query .= "'" . addslashes($user_name) . "',";
  $query .= "'" . addslashes($user_description) . "',";
  $query .= "'" . addslashes($filename) . "',";
  $query .= "'" . addslashes($array_gal["Type"]) . "',";
  $query .= "'" . addslashes($array_gal["BlockCount"]) . "',";
  $query .= "'" . addslashes($array_gal["BlockType"]) . "',";
  $query .= "NULL,";
  $query .= "'" . addslashes($array_gal["Supplier"]) . "',";
  $query .= "'" . addslashes($array_gal["ArrayName"]) . "')";

  $result = db_exec_query($query,$connexion);

  // get array_id

  $query = "select max(array_id) as array_id from annot_user.array_info";
  $result = db_exec_query($query,$connexion);
  $array = mysql_fetch_array($result,MYSQL_ASSOC);
  $array_id = $array["array_id"];
//print("<br>array_id: " . $array_id);

  // loop over lines

  $array_lines = file($stdin);

  $i = 1;
  $limit = count($array_lines);
  foreach ($array_lines as $line) {

    if (ereg("^\"Block\"\t\"Column\"\t\"Row\"\t\"Name\"\t\"ID\"\t\"RefNumber\"\t\"ControlType\"\t\"GeneName\"\t\"TopHit\"\t\"Description\"",$line,$regs)) {
      $limit = $i;
    }

    if ($i > $limit) {
      $line = ereg_replace("\"","",$line);
      list($block,$column,$row,$name,$id,$refnumber,$controltype,$genename,$tophit,$description) = split("\t",$line);
      $query = "insert into annot_user.array_reporter(array_id,block,array_column,array_row,name,gal_id,ref_number,control_type,gene_name,top_hit,description) values (";

      $query .= "'" . addslashes($array_id) . "',";
      $query .= "'" . addslashes($block) . "',";
      $query .= "'" . addslashes($column) . "',";
      $query .= "'" . addslashes($row) . "',";
      $query .= "'" . addslashes($name) . "',";
      $query .= "'" . addslashes($id) . "',";
      $query .= "'" . addslashes($refnumber) . "',";
      $query .= "'" . addslashes($controltype) . "',";
      $query .= "'" . addslashes($genename) . "',";
      $query .= "'" . addslashes($tophit) . "',";
      $query .= "'" . addslashes($description) . "')";

      $result = db_exec_query($query,$connexion);
    }
    $i++;
  }

  // delete file
  //
  unlink($stdin);
}

?>

<h1>Annot : add array</h1>

<h2>Array inserted</h2>
<br>
array id: <?php print($array_id); ?>
<br>
number of reporters: <?php print($i - $limit - 1); ?>

</body>

</html>
