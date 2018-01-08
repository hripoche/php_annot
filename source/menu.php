<?php

// Author: Hugues Ripoche
// Copyright (c) 2002-2011
// License: BSD Style.
// php version: 4.x

require("lib.php");

//check_connection();

?>

<html>
<head>
<title>Annot</title>
</head>

<body bgcolor="#f9f0d1">

<!--<h1> Annot: Menu </h1>-->

<ul>
    <li> Admin
         <ul> <li> <a href="login.php" target="main">Login</a>
              <li> <a href="disconnect.php" target="main">Close session</a>
         </ul>
    <li> Search locuslink
         <ul> <!--<li> <a href="extlocus2_input.php" target="main">extlocus2</a>-->
              <li> <a href="extlocus_input.php" target="main">extlocus</a>
              <li> <a href="repfiche_input.php" target="main">repfiche</a>
              <!--<li> <a href="gener_gene_input.php" target="main">gener_gene</a>-->
         </ul>
    <li> Agilent GAL arrays
         <ul> <li> <a href="add_array_input.php" target="main">Add array</a>
              <li> <a href="query_table_input.php?table=<?php print(urlencode('annot_user.array_info')); ?>" target="main">query arrays (base annot_user)</a>
              <li> <a href="query_table_input.php?table=<?php print(urlencode('annot_user.array_reporter')); ?>" target="main">query array genes (base annot_user)</a>
         </ul>
    <li> Proteomics MRM (Multiple Reaction Monitoring) database
         <ul> <li> <a href="mrm_add_file_input.php" target="main">Add protein and peptide files</a>
              <li> <a href="mrm_edit_file_input.php" target="main">Edit protein file</a>
              <li> <a href="mrm_delete_file_input.php" target="main">Delete protein file</a>
              <li> <a href="query_table_input.php?table=<?php print(urlencode('annot_mrm.protein_info')); ?>" target="main">query proteins (base annot_mrm)</a>
              <li> <a href="query_table_input.php?table=<?php print(urlencode('annot_mrm.protein_line')); ?>" target="main">query protein lines (base annot_mrm)</a>
              <li> <a href="query_table_input.php?table=<?php print(urlencode('annot_mrm.peptide_line')); ?>" target="main">query peptide lines (base annot_mrm)</a>
         </ul>
    <li> Queries
         <ul> <li> <a href="query_input.php" target="main">query</a>
              <li> <a href="query_table_input.php?table=<?php print(urlencode('annot_gene.gene_info')); ?>" target="main">query gene_info (base annot_gene)</a>
              <li> <a href="query_table_input.php?table=<?php print(urlencode('annot_gene.gene2go')); ?>" target="main">query gene2go (base annot_gene)</a>
              <li> <a href="query_table_input.php?table=<?php print(urlencode('annot_locuslink.locuslink')); ?>" target="main">query locuslink (base annot_locuslink)</a>
          </ul>
</ul>

</body>

</html>
