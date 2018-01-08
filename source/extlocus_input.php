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

<form enctype="multipart/form-data" action="extlocus_exec.php" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<center>
<h1> Annot : extlocus  </h1>

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
           <option value="0">extlocus</option>
         </select>
    </td>
</tr>
<tr><td>Identifier type</td>
    <td> <select name="id_type">
           <option value="1">locusid</option>
           <option value="2" selected>symbol</option>
           <option value="3">NM-xxxx (XM_ NG_)+Gb</option>
           <option value="4">NT_xxxx</option>
           <option value="5">Unigene</option>
           <option value="6">Accessions</option>
           <option value="7">Symbole alias</option>
           <option value="8">Description</option>
           <option value="9">OMIM</option>
           <option value="10">Location</option>
           <option value="11">HugoId</option>
           <option value="12">HugoSymbol</option>
           <option value="13">ontologie</option>
           <option value="14">ontologie id</option>
           <option value="15">pubmed</option>
           <option value="16">XM_xxx</option>
           <option value="17">NG_xxx</option>
           <option value="18">SwissProt_Acc</option>
           <option value="19">Homologene</option>
           <option value="20">RefSeq_NP</option>
           <option value="21">Chromosome</option>
           <option value="22">Start</option>
           <option value="23">End</option>
           <option value="24">Strand</option>
           <option value="25">GdPath_coordonnees</option>
           <option value="26">Location2</option>
           <option value="27">Nbre Exons</option>
         </select>
    </td>
</tr>
<tr><td>Species</td>
    <td> <select name="species">
           <option value="H" selected>Homo sapiens</option>
           <option value="M">Mus musculus</option>
           <option value="R">Rattus norvegicus</option>
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
