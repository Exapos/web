<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../vendor/autoload.php";

use Tracy\Debugger;
Debugger::enable(Debugger::DEVELOPMENT);
Debugger::$showBar = true;


require "../includes/config.local.php";

$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
        