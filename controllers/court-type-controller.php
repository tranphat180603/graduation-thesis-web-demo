<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-type-model.php");

    class Court_Type_Controller {
        public $court_type;

        public function __construct() {
            $this->court_type = new court_type();
        }
        
        //1. Hàm hiển thị tất cả loại sân
        public function view_all_court_type() {
            return $result = $this->court_type->view_all_court_type();
        }

        public function view_court() {
            return $result = $this->court_type->view_count_court_type();
        }

        //3. Hiển thị loại sân theo id
        public function view_court_type_by_id($court_type_id) {
            return $result = $this->court_type->getCourtTypeByID($court_type_id);
        }
    }
?>