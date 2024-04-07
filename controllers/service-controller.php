<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/service-model.php");

    class Service_Controller {
        public $service;

        public function __construct() {
            $this->service = new service();
        }

        //1. Hàm lấy dữ liệu tất cả dịch vụ
        public function view_all_service() {
            return $result = $this->service->view_all_service();
        }
    }
?>