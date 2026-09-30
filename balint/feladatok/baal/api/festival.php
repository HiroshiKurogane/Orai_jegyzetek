<?php

class Festival {
    public $id;
    public $name;
    public $location;
    public $start_date;
    public $end_date;
    public function __construct($id, $name, $location, $start_date, $end_date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

}