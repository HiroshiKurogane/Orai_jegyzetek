<?php

include("../festivalList.php");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $festival = new FestivalList();
    echo json_encode($festival->create($id, $name, $location, $start_date, $end_date));
}
else {
    http_response_code(403);
}