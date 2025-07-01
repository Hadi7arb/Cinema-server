<?php
require("../connection/connection.php");
require("../models/movies.php");

header('Content-Type: application/json'); // Ensure JSON response

$response = ["status" => 200, "message" => ""];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response["status"] = 405;
    $response["message"] = "Method Not Allowed. Only POST requests are supported.";
    echo json_encode($response);
    exit;
}

// Get raw POST data for JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate input data
// Adjust these required fields based on your 'movies' table schema
if (empty($data["title"]) || empty($data["release_date"]) || empty($data["duration"]) || empty($data["age_restriction"]) || empty($data["director_id"]) || empty($data["imageURL"])) {
    $response["status"] = 400;
    $response["message"] = "Missing required fields: title, release_date, duration, age_restriction, director_id, imageURL are required.";
    echo json_encode($response);
    exit;
}

// Basic validation for duration and director_id as integers
if (!filter_var($data["duration"], FILTER_VALIDATE_INT) || !filter_var($data["director_id"], FILTER_VALIDATE_INT)) {
    $response["status"] = 400;
    $response["message"] = "Invalid data type for duration or director_id. Must be integers.";
    echo json_encode($response);
    exit;
}

// Prepare data for insertion (ensure keys match your database column names and movies model constructor)
$movieData = [
    "title" => $data["title"],
    "release_date" => $data["release_date"],
    "duration" => (int)$data["duration"],
    "age_restriction" => $data["age_restriction"],
    "director_id" => (int)$data["director_id"],
    "imageURL" => $data["imageURL"]
];

// Create the movie
try {
    $creationSuccess = movies::create($mysqli, $movieData);

    if ($creationSuccess) {
        $response["message"] = "Movie added successfully.";
        // Optionally, you might want to return the newly created movie ID
        // $response["movie_id"] = $mysqli->insert_id;
    } else {
        $response["status"] = 500;
        $response["message"] = "Failed to add movie. Database error.";
    }
} catch (Exception $e) {
    $response["status"] = 500;
    $response["message"] = "An error occurred: " . $e->getMessage();
    error_log("Movie creation error: " . $e->getMessage());
}

echo json_encode($response);
exit;