<?php
 $dbhost="localhost";
 $dbuser="root";
 $dbpass="doki";
 $dbname="EMDCFIT";
 
 $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

 
 if(!$conn)
 {
    die("No hay conexion: ".mysqli_connect_error());
 }
$conn->commit();
return $conn;
?>
