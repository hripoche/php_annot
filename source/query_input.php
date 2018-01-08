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

<h1> Annot : query </h1>

<h2>Available databases with example queries :</h2>
<ul>
<li><a href="http://www.godatabase.org/dev/database/">Information on GO database (<b>annot_go</b>)</a>
<li><a href="gene_schema.sql">Schema of GENE database (<b>annot_gene</b>)</a>
    <ul> <li> select * from annot_gene.gene2refseq where tax_id = 9
    </ul>
<li><a href="locuslink_schema.sql">Schema of LOCUSLINK database (<b>annot_locuslink</b>)</a>
<li><a href="mrm_schema.sql">Schema of MRM (Multiple Reaction Monitoring) proteomics database (<b>annot_mrm</b>)</a>
    <ul> <li> select * from annot_mrm.protein_info
         <li> select * from annot_mrm.protein_line where accession_number = "Q14568"
         <li> select * from annot_mrm.peptide_line where accession_number = "Q14568"
         <li> select count(distinct accession_number) from annot_mrm.protein_line
         <li> select count(distinct sequence) from annot_mrm.peptide_line
         <li> select accession_number,score_unique from annot_mrm.protein_line
    </ul>
</ul>

<form action="query_exec.php" method="post">
<center>

<table cellspacing="20" cellpading="1" border="4">
<tr><td>SQL query</td>
    <td>
<textarea rows="15" cols="60" name="query" value="">
</textarea>
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
