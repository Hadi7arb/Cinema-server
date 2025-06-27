<?php
require("../connection/connection.php");

$query = "ALTER TABLE payment_methods
          ADD COLUMN user_id INT NOT NULL, 
          ADD CONSTRAINT fk_user_id_payment_methods
          FOREIGN KEY (user_id) REFERENCES users(id) 
          ON DELETE CASCADE";

$execute = $mysqli->prepare($query);

$execute->close();
$mysqli->close();
