<?php
require("../connection/connection.php");

$query = "CREATE TABLE bookings(
    booking_id INT(11) AUTO_INCREMENT primary key,
    time DATETIME NOT NULL,
    capacity INT NOT NULL,
    screen_size VARCHAR(255) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL
    /*FOREIGN KEY (id) REFERENCES users(id),
    FOREIGN KEY (showing_id) REFERENCES showings(showing_id),
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(payment_method_id)*/
    )";

$execute = $mysqli->prepare($query);
if ($execute->execute()){
    echo "Table created successfully";
}
$execute->close();
$mysqli->close();

