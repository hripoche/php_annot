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

<form enctype="multipart/form-data" action="gener_gene_exec.php" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<center>
<h1> Annot : gener_gene </h1>

<table cellspacing="20" cellpading="1" border="4">
<tr><td>Select identifier file</td>
    <td><input type="file" size="60" name="id_file"
               value=""></td>
</tr>
<tr><td>... and/or paste identifiers</td>
    <td>
<textarea rows="15" cols="20" name="id_list" value="">
</textarea>
    </td>
</tr>
<tr><td>Annotation program</td>
    <td> <select name="program">
           <option value="1">gener_gene</option>  
         </select>
    </td>
</tr>
<tr><td>Identifier type</td>
    <td> <select name="id_type">
           <option value="1">symbol</option>
         </select>
    </td>
</tr>
<tr><td>Output</td>
    <td> <select name="ext">
           <option value="2">2</option>
           <option value="h">hugo</option>
           <option value="hs">hugo + swissprot</option>
           <option value="pw">pathways</option>
         </select>
    </td>
</tr>
<tr><td>Result as</td>
    <td><select name="output_type">
        <option value="html">html table</option>
        <option value="xls">excel</option>
        </select>
    </td>
</tr>
</table>
<input type="submit" value="Submit">
<input type="reset" value="Reset">
</center>
</form>

</body>

</html>
