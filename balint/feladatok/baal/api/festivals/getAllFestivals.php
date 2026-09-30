<?php

include("../festivalList.php");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $festival = new FestivalList();
    echo json_encode($festival->getAll());

}

else {
    http_response_code(403);
}