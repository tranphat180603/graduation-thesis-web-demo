<?php
    require_once "../models/court.php";

    class Court {
        public $court;

        public function _construct() {
            $this->court = new court();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng court để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>