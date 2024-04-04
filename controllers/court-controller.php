<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/court-model.php");

    class Court_Controller {
        public $court;

        public function __construct() {
            $this->court = new court();
        }
        
        //1. Hàm lấy dữ liệu tất cả sân
        public function view_all_court() {
            return $result = $this->court->view_all_court();
        }

        //2. Hàm hiển thị tổng số lượng sân theo loại sân
        public function view_court_by_court_type($court_type_id) {
            return $result = $this->court->view_court_by_court_type($court_type_id);
        }
    }
?>