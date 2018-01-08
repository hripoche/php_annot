<?php

// Author: Hugues Ripoche
// Copyright (c) 2002-2011
// License: BSD Style.
// php version: 4.x

// check connection functions

function is_connected() {
  $val = isset($_SESSION['user'])
      && isset($_SESSION['password'])
      && ($_SESSION['user'] == 'annot')
      && ($_SESSION['password'] == 'protpept');
  return $val;
}

function check_connection () {
  if (!is_connected()) {
    header("Location: login.php?msg=" . urlencode("Connection failed"));
  }
}

// database functions

define("NAME","ripoche");
define("PASSWORD","myxyz");
define("SERVER","localhost");
define("BASE","annot_go");

function db_connect ($name,$password,$server,$base) {
  $connexion = mysql_pconnect ($server,$name,$password);
  if (!$connexion) {
    echo "Connection to server $server failed\n";
    //exit;
  }
  if (!mysql_select_db ($base,$connexion)) {
    echo "Connection to base $base failed\n";
    echo mysql_errno() . " : " . mysql_error();
    //exit;
  }
  return $connexion;
}

function db_exec_query ($query,$connexion) {
  $result = mysql_query($query,$connexion);

  if ($result) {
    return $result;
  } else {
    echo "<b>Error in query:</b>" . $query . "<br>\n";
    echo mysql_errno() . " : " . mysql_error();
    //exit;
  }
}

function db_exec_query_with_check ($query,$connexion) {

  $array_forbidden = array("drop","insert","update","reset","show");

  foreach ($array_forbidden as $word) {
    if (stristr($query,$word)) {
      echo "<b>Error in query:</b>" . $query . "<br>\n";
      exit;
    }
  }

  return(db_exec_query($query,$connexion));
}

function db_next_line ($result) {
  return mysql_fetch_object($result);
}

function db_next_line_array ($result) {
  return mysql_fetch_array($result);
}

function str_to_nbsp ($string) {
  return($string == "" ? "&nbsp;" : $string);
}

function identity ($var) {
  return $var;
}

// this function is too slow !
function mrm_translate($hashtable) {
  foreach($hashtable as $key => $value) {
    if ($key == "sequence") {
      $seq = "";
      if (ereg("^\([A-Z,a-z]\)([A-Z,a-z]*)\([A-Z,a-z]\)",$value,$regs)) {
        $seq = $regs[1];
      }
      $value = '<a href="http://srv-pr2-303/millbin/msprod.cgi?msparams_dir=msparams_mill%2F&parent_mass_convert=monoisotopic&max_ms_prod_charge=1&sequence=' . $seq . '&varMods=Oxidized-Methionine&varMods=Phosphorylated-S&varMods=Phosphorylated-T&varMods=Phosphorylated-Y&it=i&it=a&it=b&it=y&it=I&it=h&it=n&it=B&user_aa_c=2&user_aa_h=3&user_aa_n=1&user_aa_o=1&user_aa_s=0&user_aa_p=0">' . $value . '</a>';
    }
    $hastable[$key] = $value;
  }
  return $hastable;
}

function query_result_to_html_table ($result) {
  $i = 1;
  print("<table border=\"1\">\n");
  while ($array = mysql_fetch_array($result,MYSQL_ASSOC)) {
    $array = mrm_translate($array); // a bit DIRTY !!!
    if ($i == 1) {
      print("<tr>\n");
      $array_keys = array_keys($array);
      foreach ($array as $key => $value) {
        print("<th>" . str_to_nbsp(stripslashes($key)) . "</th>");
      }
      print("\n</tr>\n");
    }

    print("<tr>\n");
    foreach ($array as $key => $value) {
      print("<td>" . str_to_nbsp(stripslashes($value)) . "</td>");
      //print("<td>" . str_to_nbsp($value) . "</td>");
    }
    print("\n</tr>\n");
    $i++;
  }
  print("</table>\n");
}

function query_result_to_excel ($result) {
  header("Content-type: application/vnd.ms-excel");
//  $i = 1;
//  while ($array = mysql_fetch_array($result,MYSQL_ASSOC)) {
//    if ($i == 1) {
//      $array_keys = array_keys($array);
//      foreach ($array as $key => $value) {
//        print(str_to_nbsp($key) . "\t");
//      }
//      print("\n");
//    }
//
//    foreach ($array as $key => $value) {
//      print(str_to_nbsp($value) . "\t");
//    }
//    print("\n");
//    $i++;
//  }
query_result_to_html_table($result);
}

// DYNAMIC QUERIES

// define the names (or beginning of names)
// of html variables used in queries
//
define("TABLE_TAG","q_table_name");
define("FIELD_TAG","q_field_");
define("OPERATOR_TAG","q_operator_");

// generate html interface based on table name
//
function query_on_table_to_html ($table) {
  $connexion = db_connect(NAME,PASSWORD,SERVER,BASE);
  if ($connexion) {
    $result = db_exec_query("select * from " . $table . " limit 1",$connexion);
  } else {
    print("Error: connection failed");
  }
  if ($result) {
    $array = mysql_fetch_array($result,MYSQL_ASSOC);
  } else {
    print("Error: query failed");
  }
  print("<input type='hidden' name='" . TABLE_TAG . "' value='" . $table . "'");
  print("<table border='1'>\n");
  foreach ($array as $key => $value) {
    print("<tr>\n");
    print("<td>" . $key . "</td>\n");
    print("<td><select name='" . OPERATOR_TAG . $key . "'>");
    print("    <option value='equal to'>equal to</option>");
    print("    <option value='not equal to'>not equal to</option>");
    print("    <option value='greater than'>greater than</option>");
    print("    <option value='less than'>less than</option>");
    print("    <option value='contains'>contains</option>");
    print("    <option value='does not contain'>does not contain</option>");
    print("    <option value='begins with'>begins with</option>");
    print("    <option value='ends with'>ends with</option>");
    print("</select>");
    print("</td>\n");
    print("<td><input type='text' title='" . $value ."' name='" . FIELD_TAG . $key . "'></td>\n");
    print("\n</tr>\n");
  }
  print("</table>\n");
}

function build_query_from_array ($array) {
  $query = "select * from " . $array[TABLE_TAG] . " ";
  $where_clause = "";
  $i = 1;
  foreach ($array as $key => $value) {
//error_log("key:" . $key);
//error_log("value:" . $value);
    if (ereg("^" . FIELD_TAG . "([a-z,A-Z,0-9,_]*)",$key,$regs)) {
      $field_name = $regs[1];
      $field_value = trim($value);
      $field_operator = $array[OPERATOR_TAG . $field_name];
//error_log("field_name:" . $field_name);
//error_log("field_value:" . $field_value);
//error_log("field_operator:" . $field_operator);
      
      if ($field_value != "") {
        $where_clause .= ($i == 1 ? "where " : "and ");
        $where_clause .= $field_name;
        if ($field_operator == "equal to") {
          $where_clause .= " = '" . $field_value . "' ";
        }
        if ($field_operator == "not equal to") {
          $where_clause .= " <> '" . $field_value . "' ";
        }
        if ($field_operator == "greater than") {
          $where_clause .= " > " . $field_value . " ";
        }
        if ($field_operator == "less than") {
          $where_clause .= " < " . $field_value . " ";
        }
        if ($field_operator == "contains") {
          $where_clause .= " like '%" . $field_value . "%' ";
        }
        if ($field_operator == "does not contain") {
          $where_clause .= " not like '%" . $field_value . "%' ";
        }
        if ($field_operator == "begins with") {
          $where_clause .= " like '" . $field_value . "%' ";
        }
        if ($field_operator == "ends with") {
          $where_clause .= " like '%" . $field_value . "' ";
        }
        $i++;
      }
    }
  }
  $query .= $where_clause;
  return($query);
}

// file functions

function tab_delimited_to_excel ($filename) {
  header("Content-type: application/vnd.ms-excel");
  $array_lines = file($filename);
  foreach ($array_lines as $i => $line) {
    print("$line");
  }
}

function tab_delimited_to_excel_with_filter ($filename,$array_line_filter,$array_column_filter) {
  header("Content-type: application/vnd.ms-excel");
  $array_lines = file($filename);
  $result = "";
  foreach ($array_lines as $i => $line) {
    if (in_array($i,$array_line_filter)) {
      $array_tab = split("\t",$line);
      foreach ($array_tab as $j => $tab) {
        if (in_array($j,$array_column_filter)) {
          $result .= "$tab\t";
        }
      }
      $result .= "\n";
    }
  }
  print($result);
}


function tab_delimited_to_html_table ($filename) {
  $array_lines = file($filename);
  $result = "<table border='1'>\n";
  foreach ($array_lines as $i => $line) {
    $result .= "<tr>\n";
    $array_tab = split("\t",$line);
    foreach ($array_tab as $j => $tab) {
      $result .= "<td>" . str_to_nbsp($tab) . "</td>";
    }
    $result .= "</tr>\n";
  }
  $result .= "</table>\n";
  print($result);
}

function tab_delimited_to_html_table_with_filter ($filename,$array_line_filter,$array_column_filter) {
  $array_lines = file($filename);
  $result = "<table border='1'>\n";
  foreach ($array_lines as $i => $line) {
    if (in_array($i,$array_line_filter)) {
      $result .= "<tr>\n";
      $array_tab = split("\t",$line);
      foreach ($array_tab as $j => $tab) {
        if (in_array($j,$array_column_filter)) {
          $result .= "<td>" . str_to_nbsp($tab) . "</td>";
        }
      }
      $result .= "</tr>\n";
    }
  }
  $result .= "</table>\n";
  print($result);
}

// A TESTER
function starts_with ($haystack,$needle) {
  return(strpos($haystack,$needle) == 0);
}

function list_directory ($directory,$regexp) {
  $data_dir="/export/home"; // to avoid reading anywhere on the file system ...
  if (substr($directory,0,12) == $data_dir) {
    if ($dir = opendir($directory)) {
      while ($file = readdir($dir)) {
        if (!is_dir($file) && ereg($regexp,$file)) {
          $list_of_files[] = $file;
        }
      }
      closedir($dir);
    }
  }
  return $list_of_files;
}

function tmpdir($path, $prefix)
{
       // Use PHP's tmpfile function to create a temporary
       // directory name. Delete the file and keep the name.
       $tempname = tempnam($path,$prefix);
       if (!$tempname)
               return false;

       if (!unlink($tempname))
               return false;

       // Create the temporary directory and returns its name.
       if (mkdir($tempname))
               return $tempname;

       return false;
}

// return date formatted for mysql
function mycurrentdate() {
  return date("Y-m-d",time());
}

// test date format eg. $datestring = currentdate();
function mycheckdate($datestring) {
  list($year,$month,$day) = split("-",$datestring,3);
  return checkdate($month,$day,$year);
}

?>
