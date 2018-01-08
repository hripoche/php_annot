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
$species = $_POST['species'];

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

$basedir = "/export/home/www/htdocs/php/annot/";

$tmpdir = tmpdir($basedir . "tmp","repfiche");
if (!$tmpdir) {
  print("tmpdir failed!\n");
}

if ($program == "0") {
  $BIN="/export/home/www/htdocs/php/annot/bin/repfiche";
  $command = "/usr/bin/dos2unix $stdin $stdin ; $BIN $stdin -t $id_type -sp $species -html -dir $tmpdir 2> $stderr";
}

print($command . "\n");
exec($command);

// stderr
$array_lines = file($stderr);
print("<pre>");
foreach($array_lines as $line) {
  print("$line\n");
}
print("</pre>");

$array_lines = file($stdout);

$_SESSION['id_file'] = $stdout;

chmod($tmpdir,0777);

$list = list_directory($tmpdir,"\.html$");

?>

<?php

# htmldir = tmpdir - basedir = tmp/repfiche???
$htmldir = substr($tmpdir,strlen($basedir),strlen($tmpdir)-strlen($basedir));

print("htmldir=$htmldir");

print("<ul>\n");

foreach ($list as $val) {
  print ("<li><a href=\"$htmldir/$val\">$val</a>\n");
}

print("</ul>\n");

?>

</body>

</html>
