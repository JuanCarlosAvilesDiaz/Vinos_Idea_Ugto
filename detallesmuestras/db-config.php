<?php

/*$host = "vineyards-project-gto.cmlporp0gipp.us-east-2.rds.amazonaws.com";
$port = "3306";
$dbname = "viñedos_ideagto";
$username = "admin";
$password = "Ka3rMorhen18";*/

// $host = "localhost";
// $port = "3308";
// $dbname = "viñedos_ideagto";
// $username = "root";
// $password = "root";

$host = "localhost";
$port = "3306";
$dbname = "viñedos_ideagto";
$username = "susana.avila";
$password = "M4Sus@v1l4";
  
  try {
      $connection = new PDO("mysql:host=$host; port=$port; dbname=$dbname", $username, $password);
      // Set the PDO error mode to exception
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  } catch (PDOException $exception) {
      echo "Connection failed: " . $exception->getMessage();
  }

?>