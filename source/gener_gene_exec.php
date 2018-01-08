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

$stdin = tempnam("$temp_dir","annot_stdin_");

//echo '<pre>';
//if (move_uploaded_file($_FILES['id_file']['tmp_name'], $stdin)) {
//   echo "Le fichier est valide, et a été téléchargé
//           avec succès. Voici plus d'informations :\n";
//   print_r($_FILES);
//} else {
//   echo "Attaque par upload potentielle. Voici plus d'informations :\n";
//   print_r($_FILES);
//}
//print_r($_POST);
//echo '</pre>';

move_uploaded_file($_FILES['id_file']['tmp_name'], $stdin);

$id_list = $_POST['id_list'];
$program = $_POST['program'];
$id_type = $_POST['id_type'];
$ext = $_POST['ext'];
$output_type = $_POST['output_type'];

$array_id = split("\n",$id_list);

$handle = fopen($stdin,"a");
foreach($array_id as $id) {
  fwrite($handle,"$id\n");
}
fclose($handle);

$stdout = tempnam("$temp_dir","annot_stdout_");
$stderr = tempnam("$temp_dir","annot_stderr_");

chmod($stdin,0777);
chmod($stdout,0777);
chmod($stderr,0777);

if ($program == "1") {
  $BIN="/usr/local/bio/bin/gener_gene.pl";
  $command = "dos2unix $stdin $stdin ; $BIN $stdin > $stdout 2> $stderr";
}

//print($command . "\n");
exec($command);

// stderr
$array_lines = file($stderr);
print("<pre>");
foreach($array_lines as $line) {
  print("$line\n");
}
print("</pre>");

//print(tab_delimited_to_html_table($stdout));

//$array_lines = file($stdout);

$_SESSION['id_file'] = $stdin . "_" . $ext;

header("Location: gener_gene_output.php?output_type=" . urlencode($output_type));

?>

</body>
</html>
