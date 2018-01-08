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

$stdin_protein = $_SESSION["ssv_protein_file"];
$protein_filename = $_SESSION["protein_filename"];
//
$stdin_peptide = $_SESSION["ssv_peptide_file"];
$peptide_filename = $_SESSION["peptide_filename"];
//
$user_name = $_POST["user_name"];
$user_description = $_POST["user_description"];
$date = $_SESSION["date"];
$project_name = $_POST["project_name"];
$sample_name = $_POST["sample_name"];
$analysis_method = $_POST["analysis_method"];
$validation_method = $_POST["validation_method"];

if (file_exists($stdin_protein) && file_exists($stdin_peptide)) {

  $connexion = db_connect(NAME,PASSWORD,SERVER,BASE);

  $query = "insert into annot_mrm.protein_info(user_name,user_description,date,project_name,sample_name,analysis_method,validation_method,protein_filename,peptide_filename) values(";
  $query .= "'" . addslashes($user_name) . "',";
  $query .= "'" . addslashes($user_description) . "',";
  $query .= "'" . addslashes($date) . "',";
  $query .= "'" . addslashes($project_name) . "',";
  $query .= "'" . addslashes($sample_name) . "',";
  $query .= "'" . addslashes($analysis_method) . "',";
  $query .= "'" . addslashes($validation_method) . "',";
  $query .= "'" . addslashes($protein_filename) . "',";
  $query .= "'" . addslashes($peptide_filename) . "')";

  $result = db_exec_query($query,$connexion);

  // get protein_id

  $query = "select max(protein_id) as protein_id from annot_mrm.protein_info";
  $result = db_exec_query($query,$connexion);
  $array = mysql_fetch_array($result,MYSQL_ASSOC);
  $protein_id = $array["protein_id"];
//print("<br>protein_id: " . $protein_id);

  // loop over protein lines

  $ssv_protein_file_lines = file($stdin_protein);

  $protein_i = 0;
  $protein_limit = count($ssv_protein_file_lines);
  foreach ($ssv_protein_file_lines as $line) {

    if (ereg("^;[a-z,A-Z,0-9,\\,\-]* numSpectra;[a-z,A-Z,0-9,\\,\-]* meanIntensity; protein_mw; protein_pI; species; accession_number; accession_numbers; coverage_maps; percentCoverage; percentCoverages; numPepsUnique; scoreUnique; scoresUnique; heavyOverLightRatio; stddevHeavyOverLightRatio; numHLRatios; groupNum; numSubgroups; entry_name",$line,$regs)) {
      $protein_limit = $protein_i;
    }

    if ($protein_i > $protein_limit) {
      $line = ereg_replace("\"","",$line);

      // $none non utilise
      list($none,$num_spectra,$mean_intensity,$protein_mw,$protein_pi,$species,$accession_number,$none,$none,$percent_coverage,$none,$num_peps_unique,$score_unique,$none,$heavy_over_light_ratio,$stddev_heavy_over_light_ratio,$num_hl_ratios,$group_num,$num_subgroups,$entry_name) = split(";",$line);

      $query = "insert into annot_mrm.protein_line(protein_id,protein_line_id,num_spectra,mean_intensity,protein_mw,protein_pi,species,accession_number,percent_coverage,num_peps_unique,score_unique,heavy_over_light_ratio,stddev_heavy_over_light_ratio,num_hl_ratios,group_num,num_subgroups,entry_name) values (";

      $protein_line_id = $protein_i;

      $query .= "'" . addslashes($protein_id) . "',";
      $query .= "'" . addslashes($protein_line_id) . "',";
      $query .= "'" . addslashes($num_spectra) . "',";
      $query .= "'" . addslashes($mean_intensity) . "',";
      $query .= "'" . addslashes($protein_mw) . "',";
      $query .= "'" . addslashes($protein_pi) . "',";
      $query .= "'" . addslashes($species) . "',";
      $query .= "'" . addslashes($accession_number) . "',";
      $query .= "'" . addslashes($percent_coverage) . "',";
      $query .= "'" . addslashes($num_peps_unique) . "',";
      $query .= "'" . addslashes($score_unique) . "',";
      $query .= "'" . addslashes($heavy_over_light_ratio) . "',";
      $query .= "'" . addslashes($stddev_heavy_over_light_ratio) . "',";
      $query .= "'" . addslashes($num_hl_ratios) . "',";
      $query .= "'" . addslashes($group_num) . "',";
      $query .= "'" . addslashes($num_subgroups) . "',";
      $query .= "'" . addslashes($entry_name) . "')";

      $result = db_exec_query($query,$connexion);
    }
    $protein_i++;
  }

  // loop over peptide lines

  $ssv_peptide_file_lines = file($stdin_peptide);

  $peptide_i = -1; // skip first blank line
  $peptide_limit = count($ssv_peptide_file_lines);
  foreach ($ssv_peptide_file_lines as $line) {

    if (ereg("^number; filename; parent_charge; score; percent_scored_peak_intensity; deltaApexRetentionTimeSec; totalIntensity; numMergedScans; sequence; modifications; H/L; retentionTimeMin; parent_m_over_z; matched_parent_mass; peptide_pI; protein_mw; protein_pI; species; accession_number; entry_name",$line,$regs)) {
      $peptide_limit = $peptide_i;
    }

    if ($peptide_i > $peptide_limit) {
      $line = ereg_replace("\"","",$line);

      // $none non utilise
      list($none,$filename,$parent_charge,$score,$percent_scored_peak_intensity,$none,$total_intensity,$none,$sequence,$modifications,$hl,$retention_time_min,$parent_m_over_z,$matched_parent_mass,$peptide_pi,$protein_mw,$protein_pi,$species,$accession_number,$entry_name) = split(";",$line);

      $query = "insert into annot_mrm.peptide_line(protein_id,peptide_line_id,filename,parent_charge,score,percent_scored_peak_intensity,total_intensity,sequence,modifications,hl,retention_time_min,parent_m_over_z,matched_parent_mass,peptide_pi,protein_mw,protein_pi,species,accession_number,entry_name) values (";

      $peptide_line_id = $peptide_i;

      $query .= "'" . addslashes($protein_id) . "',";
      $query .= "'" . addslashes($peptide_line_id) . "',";
      $query .= "'" . addslashes($filename) . "',";
      $query .= "'" . addslashes($parent_charge) . "',";
      $query .= "'" . addslashes($score) . "',";
      $query .= "'" . addslashes($percent_scored_peak_intensity) . "',";
      $query .= "'" . addslashes($total_intensity) . "',";
      $query .= "'" . addslashes($sequence) . "',";
      $query .= "'" . addslashes($modifications) . "',";
      $query .= "'" . addslashes($hl) . "',";
      $query .= "'" . addslashes($retention_time_min) . "',";
      $query .= "'" . addslashes($parent_m_over_z) . "',";
      $query .= "'" . addslashes($matched_parent_mass) . "',";
      $query .= "'" . addslashes($peptide_pi) . "',";
      $query .= "'" . addslashes($protein_mw) . "',";
      $query .= "'" . addslashes($protein_pi) . "',";
      $query .= "'" . addslashes($species) . "',";
      $query .= "'" . addslashes($accession_number) . "',";
      $query .= "'" . addslashes($entry_name) . "')";

      $result = db_exec_query($query,$connexion);
    }
    $peptide_i++;
  }

  // delete protein file
  //
  unlink($stdin_protein);

  // delete peptide file
  //
  unlink($stdin_peptide);
}

?>

<h1>Annot : Proteomics MRM database : add file</h1>

<h2>Array inserted</h2>
<br>
protein id: <?php print($protein_id); ?>
<br>
number of protein lines (with header): <?php print($protein_i - $protein_limit); ?>
<br>
number of peptide lines (with header): <?php print($peptide_i - $peptide_limit); ?>

</body>

</html>
