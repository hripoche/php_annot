<?php

// Author: Hugues Ripoche
// Copyright (c) 2002-2011
// License: BSD Style.
// php version: 4.x

session_destroy();

    header("Location: login.php?msg=" . urlencode("You have been disconnected"));

?>
