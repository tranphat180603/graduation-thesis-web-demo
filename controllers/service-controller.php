<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/service-model.php");

    class Service_Controller {
        public $service;

        public function __construct() {
            $this->service = new service();
        }

        public function laugh() {
            //các hàm để điều hướng từ views đến model của đối tượng service để làm việc với database,
            //cũng như lấy data từ model đổ lên views
        }
    }
?>