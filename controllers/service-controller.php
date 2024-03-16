<?php
    require_once "../models/service.php";

    class Service {
        public $service;

        public function _construct() {
            $this->service = new service();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng service để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>