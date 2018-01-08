<?php

// Author: Hugues Ripoche
// Copyright (c) 2002-2011
// License: BSD Style.
// php version: 4.x

// "session_start()" inutile car session.auto_start = 1 dans php.ini

$_SESSION['user'] = $_POST['user'];
$_SESSION['password'] = $_POST['password'];

header("Location: choice.php");

?>
