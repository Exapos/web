<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require "../vendor/autoload.php";

// "kdyby/autowired": "",
// "tracy/tracy": "^2.7",
use Tracy\Debugger;

Debugger::enable(Debugger::DEVELOPMENT);
Debugger::$showBar = true;


require "../includes/config.local.php";

$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

if (isset($_SESSION['cookie'])) { // jsem přihlášený

    $cookie = $_SESSION['cookie'];
    $sql = "SELECT * FROM register WHERE cookie = '$cookie'";

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $user = $row; // v proměnné "row" je přihlášený uživatel
        break;
    }

} else { // nejsem příhlášený, přesměruju ho na login
    header('Location: /login/index.html');
}
