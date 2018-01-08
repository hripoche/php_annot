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

<form enctype="multipart/form-data" action="extlocus2_exec.php" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<center>
<h1> Annot : extlocus2 </h1>

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
           <option value="0">extlocus2</option>  
         </select>
    </td>
</tr>
<tr><td>Identifier type</td>
    <td> <select name="id_type">
           <option value="0">locusid</option>
           <option value="1" selected>symbol</option>
           <option value="2">NM-xxxx (XM_ NG_)</option>
           <option value="3">NT_xxxx</option>
           <option value="4">Unigene</option>
           <option value="5">Accessions</option>
           <option value="6">Symbole alias</option>
           <option value="7">produit</option>
           <option value="8">OMIM</option>
           <option value="9">Location</option>
           <option value="10">domaine</option>
           <option value="11">domaine id pfam</option>
           <option value="12">ontologie</option>
           <option value="13">ontologie identifieur</option>
           <option value="14">pubmed</option>
           <option value="15">XM_xxx</option>
           <option value="16">NG_xxx</option>
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
