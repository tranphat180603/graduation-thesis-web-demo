<?php
    require_once "../models/court-model.php";

    class Court_Controller {
        public $court;

        public function __construct() {
            $this->court = new court();
        }
        
        //1. Hàm lấy dữ liệu tất cả sân
        public function view_all_court() {
            return $result = $this->court->view_all_court();
        }
    }
?>