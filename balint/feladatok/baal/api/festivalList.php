<?php

include("db/conn.php");
include("festival.php");
class FestivalList {
    public $conn;
    public function __construct()
    {
        $this->conn = $GLOBALS["conn"];
    }

    public function create($id, $name, $location, $start_date, $end_date) {
        $sql = "INSERT INTO festivals(id, name, location, start_date, end_date) VALUES (" . $id . ", '". $name. "', '". $location."', '". $start_date."', '". $end_date."')";
        $result = $this->conn->multi_query($sql);    
        return $result;
    }

    public function delete($id) {
        $sql = "DELETE FROM festivals WHERE id = " . $id;
        $result = $this->conn->query($sql);
        return $result;
    }

        public function getAll() {
        $sql = "SELECT * FROM festivals";
        $result = $this->conn->query($sql); 

        $festivals = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $festivals[] = new Festival($row["id"], $row["name"], $row["location"], $row["start_date"], $row["end_date"]);
            }
        }
        return $festivals;
    }

        public function modify($id, $name, $location, $start_date, $end_date) {
        $sql = "UPDATE festivals SET name = '" . $name . "', location = '" . $location . "', start_date = '" . $start_date . "', end_date = '" . $end_date . "' WHERE id = " . $id;
        $result = $this->conn->query($sql);
        return $result;
    }
}


?>