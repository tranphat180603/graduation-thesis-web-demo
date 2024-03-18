<?php
    require_once "../models/court-type-model.php";

    class Court_Type_Controller {
        public $court_type;

        public function __construct() {
            $this->court_type = new court_type();
        }

        public function view_all_court_type() {
            return $result = $this->court_type->view_all_court_type();
        }
    }
?>