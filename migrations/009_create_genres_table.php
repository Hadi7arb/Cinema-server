<?php
require("../connection/connection.php");

$query = "CREATE TABLE genres(
    genre_id INT(11) AUTO_INCREMENT primary key,
    genre_name VARCHAR(255) NOT NULL UNIQUE
    )";

$execute = $mysqli->prepare($query);
if ($execute->execute()){
    echo "Table created successfully";
}
$execute->close();
$mysqli->close();