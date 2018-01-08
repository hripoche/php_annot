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

//$uploaddir = '/var/www/uploads/';
$temp_dir = '/tmp/';

$stdin = tempnam("$temp_dir","annot_add_array_");

//print_r($_FILES);

move_uploaded_file($_FILES['id_file']['tmp_name'], $stdin);

$array_lines = file($stdin);

$gal_ok = false;
foreach ($array_lines as $line) {

  if (ereg("^\"([a-z,A-Z]*)=([a-z,A-Z,0-9,\., ]*)\"",$line,$regs)) {
    $array_gal[$regs[1]] = $regs[2];
  }

  if (ereg("^\"Block\"\t\"Column\"\t\"Row\"\t\"Name\"\t\"ID\"\t\"RefNumber\"\t\"ControlType\"\t\"GeneName\"\t\"TopHit\"\t\"Description\"",$line,$regs)) {
    $gal_ok = true;
  } else {
    $gal_ok = false;
  }

  if ($gal_ok) break;
}

$filename = $_FILES['id_file']['name'];
ereg("([a-z,A-Z,0-9,\_, ]*)\.gal",$filename,$regs);
$user_name = $regs[1];
$user_description = $array_gal["ArrayName"];

$_SESSION["gal_file"] = $stdin;
$_SESSION["gal_array"] = $array_gal;
$_SESSION["filename"] = $filename;

?>

<h1>Annot : add array</h1>

<center>
<?php
if ($gal_ok) {
  print('<form action="add_array_exec2.php" method="post">');
} else {
  print('<font color="#ff0000">');
  print("Error: bad format for GAL file");
  print('</font>');
  if (file_exists($stdin)) {
    unlink($stdin);
  }
}
?>

<table cellspacing="20" cellpading="1" border="4">
<?php
foreach($array_gal as $key => $val) {
  print("<tr><td>" . $key . "</td>\n");
  print("    <td>" . $val . "</td>\n");
  print("</tr>\n");
}
?>
<tr><td>Filename</td>
    <td><?php print($filename); ?></td>
</tr>
<tr><td>User Name</td>
    <td><input type="text" name="user_name" size="30" value="<?php print($user_name); ?>"></td>
</tr>
<tr><td>User Description</td>
    <td><input type="text" size="60" name="user_description" value="<?php print($user_description); ?>"></td>
</tr>
</table>
<?php
if ($gal_ok) {
  print('<input type="submit" value="Submit">');
  print('<input type="reset" value="Reset">');
  print('</form>');
}
?>
</center>

</body>

</html>
