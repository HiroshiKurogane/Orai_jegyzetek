<?php

include("../festivalList.php");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $id = $_GET["id"];

    $festival = new FestivalList();

    echo json_encode($festival->delete($id));
}
else {
    http_response_code(403);
}
