<?php
require("../connection/connection.php");
require("../models/showings.php");
require("../models/movies.php"); // To potentially get movie details with showings

header('Content-Type: application/json');

$response = ["status" => 200, "message" => ""];
// Check for movie_id parameter to filter showings by a specific movie
if (isset($_GET["movie_id"])) {
    $movieId = $_GET["movie_id"];

    // Basic validation for integer
    if (!filter_var($movieId, FILTER_VALIDATE_INT)) {
        $response["status"] = 400;
        $response["message"] = "Invalid movie_id. Must be an integer.";
        echo json_encode($response);
        exit;
    }

    $showings = showings::findByMovieId($mysqli, (int)$movieId);
    if (empty($showings)) {
        $response["status"] = 404;
        $response["message"] = "No showings found for this movie ID.";
        echo json_encode($response);
        exit;
    }

    $response["showings"] = [];
    foreach ($showings as $showing) {
        $response["showings"][] = $showing->toArray();
    }
} else {
    // If no movie_id is provided, fetch all showings
    $showings = showings::all($mysqli);

    if (empty($showings)) {
        $response["status"] = 404;
        $response["message"] = "No showings available.";
        echo json_encode($response);
        exit;
    }

    $response["showings"] = [];
    foreach ($showings as $showing) {
        $response["showings"][] = $showing->toArray();
    }
}

echo json_encode($response);
exit;