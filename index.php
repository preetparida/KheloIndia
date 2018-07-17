<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once ("methods/init.php");
require_once ("methods/session.php");

if(!$_SESSION['ID'] && !$_SESSION['ROLE']){
    header("location:login.php");
}
?>