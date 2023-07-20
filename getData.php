<?php

$connection = 'localhost';
$username = 'root';
$password = '';
$dbname = 'Graphic';

$conn = new mysqli( $connection, $username, $password , $dbname); 

$sql = "SELECT id, Data FROM data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Data: " . $row["Data"].  "<br>";
  }
} else {
  echo "0 results";
}




?>