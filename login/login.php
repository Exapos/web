<?php

require('../bootstrap.php');

$username = "Exapos";//$_POST['username'];
$password =  "123";//$_POST['password'];


if (!empty($username) && !empty($password)) {
    
    $sql = "SELECT * FROM register WHERE username = '$username'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
     
      while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. $row["username"]. "<br>";
      }
    } else {
      echo "0 results";
    } 

    $conn->close();
    
    
}
bdump($conn);
bdump($sql);
bdump($stmt);