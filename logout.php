<?php

require_once  ("./methods/database.php");
require_once ("./methods/session.php");

$session->logout();

header("location:./login.php");
?>