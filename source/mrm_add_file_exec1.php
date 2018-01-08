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

$stdin_protein = tempnam("$temp_dir","annot_mrm_add_file_protein_");
$stdin_peptide = tempnam("$temp_dir","annot_mrm_add_file_peptide_");

//print_r($_FILES);

move_uploaded_file($_FILES['id_protein_file']['tmp_name'], $stdin_protein);
move_uploaded_file($_FILES['id_peptide_file']['tmp_name'], $stdin_peptide);

$ssv_protein_file_lines = file($stdin_protein);
$ssv_peptide_file_lines = file($stdin_peptide);

// to read project name from protein file
$pname = "";

$ssv_protein_ok = false;
foreach ($ssv_protein_file_lines as $line) {
  if (ereg("^;([a-z,A-Z,0-9,\\,\-]*) numSpectra;[a-z,A-Z,0-9,\\,\-]* meanIntensity; protein_mw; protein_pI; species; accession_number; accession_numbers; coverage_maps; percentCoverage; percentCoverages; numPepsUnique; scoreUnique; scoresUnique; heavyOverLightRatio; stddevHeavyOverLightRatio; numHLRatios; groupNum; numSubgroups; entry_name",$line,$regs)) {
    $ssv_protein_ok = true;
    $pname = $regs[1];
  } else {
    $ssv_protein_ok = false;
  }
  if ($ssv_protein_ok) break;
}

$ssv_peptide_ok = false;
foreach ($ssv_peptide_file_lines as $line) {
  if (ereg("^number; filename; parent_charge; score; percent_scored_peak_intensity; deltaApexRetentionTimeSec; totalIntensity; numMergedScans; sequence; modifications; H/L; retentionTimeMin; parent_m_over_z; matched_parent_mass; peptide_pI; protein_mw; protein_pI; species; accession_number; entry_name",$line,$regs)) {
    $ssv_peptide_ok = true;
  } else {
    $ssv_peptide_ok = false;
  }
  if ($ssv_peptide_ok) break;
}

$protein_filename = $_FILES['id_protein_file']['name'];
$peptide_filename = $_FILES['id_peptide_file']['name'];

//ereg("([a-z,A-Z,0-9,\_,\-, ]*)\.ssv",$protein_filename,$regs);

$user_name = "";
$user_description = "";
$date = $_POST["date"];
$project_name = $pname;
$sample_name = "";
$analysis_method = "";
$validation_method = "";

$date_ok = mycheckdate($date); // from lib.php

$_SESSION["ssv_protein_file"] = $stdin_protein;
$_SESSION["protein_filename"] = $protein_filename;
//
$_SESSION["ssv_peptide_file"] = $stdin_peptide;
$_SESSION["peptide_filename"] = $peptide_filename;
//
$_SESSION["date"] = $date;

?>

<h1>Annot : Proteomics MRM database : add file</h1>

<center>
<?php
if ($ssv_protein_ok && $ssv_peptide_ok && $date_ok) {
  print('<form action="mrm_add_file_exec2.php" method="post">');
} else {
  print('<font color="#ff0000">');
  if (!$ssv_protein_ok) {
    print("Error: bad format for protein file<br>");
    if (file_exists($stdin_protein)) {
      unlink($stdin_protein);
    }
  }
  if (!$ssv_peptide_ok) {
    print("Error: bad format for peptide file<br>");
    if (file_exists($stdin_peptide)) {
      unlink($stdin_peptide);
    }
  }
  if (!$date_ok) {
    print("Error: bad format for date<br>");
  }
  print('</font>');
}
?>

<table cellspacing="20" cellpading="1" border="4">
<tr><td>Protein filename</td>
    <td><?php print($protein_filename); ?></td>
</tr>
<tr><td>Peptide filename</td>
    <td><?php print($peptide_filename); ?></td>
</tr>
<tr><td>User name</td>
    <td><input type="text" name="user_name" size="30" value="<?php print($user_name); ?>"></td>
</tr>
<tr><td>User description</td>
    <td><input type="text" size="60" name="user_description" value="<?php print($user_description); ?>"></td>
</tr>
<tr><td>Date</td>
    <td><?php print($date); ?></td>
</tr>
<tr><td>Project name</td>
    <td><input type="text" size="60" name="project_name" value="<?php print($project_name); ?>"></td>
</tr>
<tr><td>Sample name</td>
    <td><input type="text" size="60" name="sample_name" value="<?php print($sample_name); ?>"></td>
</tr>
<tr><td>Analysis method</td>
    <td><textarea name="analysis_method" rows="5" cols="60"><?php print($analysis_method); ?></textarea></td>
</tr>
<tr><td>Validation method</td>
    <td><textarea name="validation_method" rows="5" cols="60"><?php print($validation_method); ?></textarea></td>
</tr>
</table>
<?php
if ($ssv_protein_ok && $ssv_peptide_ok && $date_ok) {
  print('<input type="submit" value="Submit">');
  print('<input type="reset" value="Reset">');
  print('</form>');
}
?>
</center>

</body>

</html>
