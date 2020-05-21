<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../vendor/autoload.php";

use Tracy\Debugger;
Debugger::enable(Debugger::DEVELOPMENT);
Debugger::$showBar = true;


require "../includes/config.local.php";

$username = $_POST['username'];
$password =  $_POST['password'];
$email =  $_POST['email'];
$confirm_password = $_POST['confirm_password'];

include '../registration/index.html';

if (!empty ($username) || !empty($password) || !empty($confirm_password) || !empty($email)) {
    if ($_POST["password"] === $_POST["confirm_password"]) {
        // success!
        //connection
        $conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);
        if (mysqli_connect_error()) {
            die('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
        } else {
            $SELECT = 'SELECT email From register Where email = ? Limit 1';
            $INSERT = 'INSERT Into register (username, password, email) values(?, ?, ?)';

            //prepare statement
            $stmt = $conn ->prepare($SELECT);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            $rnum = $stmt->num_rows;

            if (!$rnum) {
                $stmt->close();

                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param('sss', $username, sha1($password), $email);
                $stmt->execute();
                echo 'You have been registered succesfully';
            }  elseif($rnum) {
                echo 'Someone already registered using this email';
            } else {
                echo 'All field are required';
                die();
            }
        }
    } else {
        echo 'Your passwords are not same'.$_POST["password"]. ' x ' .$_POST["confirm_password"];
        
        die();
    }
}
