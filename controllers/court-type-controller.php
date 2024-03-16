<?php
    require_once "../models/court_type.php";

    class Court_type {
        public $court_type;

        public function _construct() {
            $this->court_type = new court_type();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng court_type để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>