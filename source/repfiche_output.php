<?php

// Author: Hugues Ripoche
// Copyright (c) 2002-2011
// License: BSD Style.
// php version: 4.x

require("lib.php");

check_connection();

$dir = "tmp/test";

$list = list_directory($dir,".html$");

?>

<html>
<head>
<title>Annot</title>
</head>

<body bgcolor="#f9f0d1">

<h1> Annot </h1>

<?php
print("<ul>\n");
foreach ($list as $val) {
  print ("<li><a href=\"$val\">$val</a>\n");
}
print("</ul>\n");
?>

<a href="tmp/test/">menu</a>

</body>

</html>
