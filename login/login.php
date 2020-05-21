<?php

require('../bootstrap.php');

$username = "Exapos"; //$_POST['username'];
$password =  "test"; //$_POST['password'];

if (!empty($username) && !empty($password)) {

  $password = sha1($password); // před hledáním, heslo zahashuju
  $sql = "SELECT * FROM register WHERE username = '$username' AND password = '$password'";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
      // údaje jsou správně
      $_SESSION['cookie'] = $cookie = $_COOKIE["PHPSESSID"];
      $sql = "UPDATE register SET cookie = '$cookie' WHERE username = '$username' AND password = '$password'";
      $conn->query($sql);
      
     }
  } else {
    echo "Invalid credentials";
  }

  $conn->close();
}
