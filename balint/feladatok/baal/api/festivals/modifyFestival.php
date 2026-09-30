<?php

include("../festivalList.php");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
    $id = $_GET["id"];
    $name = $_GET["name"];
    $location = $_GET["location"];
    $start_date = $_GET["start_date"];
    $end_date = $_GET["end_date"];

    $festival = new FestivalList();

    echo json_encode($festival->modify($id, $name, $location, $start_date, $end_date));
}
else {
    http_response_code(403);
}
