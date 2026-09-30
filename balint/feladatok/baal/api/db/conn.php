<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feladat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $sql = "SELECT * FROM festivals";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $insert = "INSERT INTO festivals(id, name, location, start_date) VALUES
         (1, 'Nadasdy Nap', 'Csepreg, Hungary', '2026.09.22'),
         (2, 'Sziget Festival', 'Budapest, Hungary', '2026.08.05'),
         (3, 'Balaton Sound', 'Zamárdi, Hungary', '2026.07.02'),
         (4, 'Volt Festival', 'Sopron, Hungary', '2026.06.25'),
         (5, 'B my Lake Festival', 'Velence, Hungary', '2026.07.09'),
         (6, 'EFOTT Festival', 'Velence, Hungary', '2026.07.15'),
         (7, 'Fishing on Orfű', 'Orfű, Hungary', '2026.06.18'),
         (8, 'Strand Festival', 'Zamárdi, Hungary', '2026.07.16'),
         (9, 'Campus Festival', 'Debrecen, Hungary', '2026.08.12'),
         (10, 'Kolorádó Festival', 'Pécs, Hungary', '2026.07.23');";
         $result = $conn->multi_query($insert);
    }
}