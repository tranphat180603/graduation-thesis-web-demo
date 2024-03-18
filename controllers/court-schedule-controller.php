<?php
    require_once ("../models/court-schedule-model.php");

    class Court_Schedule_Controller {
        public $court_schedule;

        public function __construct() {
            $this->court_schedule = new court_schedule();
        }

        public function view_all() {
            return $result = $this->court_schedule->view_all();
        }
    }
?>